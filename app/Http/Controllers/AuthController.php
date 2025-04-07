<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AccessToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\AccessDetailsService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Session\Session;
use App\Notifications\AccountAcessNotification;
use App\Notifications\SendAccessTokenNotification;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        // PÁGINA DE CADASTRO
    }

    public function processRegistration(Request $request)
    {
        // AÇÃO DE CADASTRO
    }

    public function authenticateUser(Request $request)
    {
        // VALIDA O FORMULÁRIO 
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);

        // SALVA O REMEMBER EM COOKIE CASO SEJA TRUE E O EMAIL DO USUÁRIO PARA ENVIAR PRO FOMULÁRIO DE CONFIRMAÇÃO
        $remember = $request->has('remember');
        Cookie::queue(Cookie::make('remember', $remember, 15, '/', null, true, true, false, 'Strict'));
        Cookie::queue(Cookie::make('auth_email', $request->email, 15, '/', null, true, true, false, 'Strict'));

        // VERIFICAR O LOGIN DO USUÁRIO ESTA CORRETO COM O BANCO
        $user = User::where('email', $request->email)->first();

        AccessDetailsService::generateAccessDetails($request);

        if ($user && Hash::check($request->password, $user->password)) {
            // VERIFICA SE EXISTE ALGUM CÓDIGO E SE SIM ALTERA PARA USADO 
            $accessToken = AccessToken::where('user_id', $user->id);

            if ($accessToken) {
                $accessToken->update([
                    'used' => true,
                ]);
            }

            // CRIAR HASH DO CÓDIGO DE AUTENTICAÇÃO NO DB E MANDAR CÓDIGO VIA EMAIL
            $accessToken = strval(mt_rand(100000, 999999));

            AccessToken::create([
                'user_id' => $user->id,
                'token' => Hash::make($accessToken),
                'expires_at' => Carbon::now()->addMinutes(15)
            ]);

            $accessDetails =  AccessDetailsService::generateAccessDetails($request);

            $user->notify(new SendAccessTokenNotification($accessToken, $user->name, $accessDetails));

            // REDIRECIONAR PARA CONFIRMAÇÃO DE LOGIN
            return redirect(route('confirm.signin'));
        } else {
            return back()->withErrors(['email' => 'E-mail ou senha inválidos']);
        }
    }

    public function showTwoFactorForm(Request $request)
    {
        // RECUPERA O EMAIL DO USUÁRIO A PARTIR DO COOKIE
        $userEmail = $request->cookie('auth_email');

        // VERIFICA SE O COOKIE AINDA EXISTE E SE SIM RECUPERA O USUÁRIO
        if (empty($userEmail)) {
            return back()->withErrors(['error' => 'Email não encontrado.']);
        }

        return view('auth.confirm-signin', [
            "userEmail" => $userEmail
        ]);
    }

    public function verifyTwoFactorCode(Request $request)
    {
        // VALIDA SE FOI RECEBIDO UM ARRAY COM OS NÚMEROS DO ACCESSTOKEN
        $request->validate([
            'numbers' => 'array|between:0,9'
        ]);

        // COMPILA O ACCESSTOKEN
        /*$accessToken = '';
        foreach ($request->numbers as $number) {
            $accessToken =  $accessToken . $number;
        }*/

        $accessToken = $request->token;

        // RECUPERA O USUÁRIO A PARTIR DO COOKIE E SEU ÚLTIMO TOKEN DE ACESSO GERADO
        $user = User::where('email', $request->cookie('auth_email'))->first();
        $lastToken = $user->accessTokens->last();

        // VERIFICA SE O TOKEN EXISTE, SE É CORRETO E SE A AUTENTICAÇÃO AINDA NÃO FOI USADA
        if ($lastToken && Hash::check($accessToken, $lastToken->token) && !$lastToken->used) {
            Auth::login($user);

            $lastToken->update(['used' => true]);

            // GERA OS DETALHES DO ACESSO ENVIA NOTIFICAÇÃO VIA EMAIL
            $accessDetails =  AccessDetailsService::generateAccessDetails($request);
            $user->notify(new AccountAcessNotification($user, $accessDetails));

            return redirect($user->role === 'client' || $user->role === 'professional' ? 'home' : 'dashboard');
        }

        return redirect(route('confirm.signin'))->withErrors(['code' => 'Código incorreto ou expirado']);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // PROCESSA O RETORNO APÓS AUTENTICAÇÃO
    public function handleGoogleCallback(Request $request)
    {
        try {
            $userGoogle = Socialite::driver('google')->stateless()->user();
            $localUser = User::where('email', $userGoogle->getEmail())->first();

            if (!$localUser) {
                // CRIA UM NOVO USUÁRIO SE NÃO EXISTIR ELE NO DB
                $localUser = User::create([
                    'name' => $userGoogle->getName(),
                    'email' => $userGoogle->getEmail(),
                    'email_verify_at' => now(),
                    'status' => 'active',
                ]);
            }

            // LOGA O USUÁRIO
            Auth::login($localUser);

            $accessDetails =  AccessDetailsService::generateAccessDetails($request);
            $localUser->notify(new AccountAcessNotification($localUser, $accessDetails));

            // MANDA O USUÁRIO PARA ALTERAR A SENHA, PARA HOME OU PARA O DASHBOARD
            return !$localUser->password 
                ? redirect(route('create.first.password')) 
                : redirect($localUser->role === 'client' || $localUser->role === 'professional' ? 'home' : 'dashboard');

        } catch (\Exception $e) {
            // EM CASO DE ERRO RETORNA A PÁGINA DE LOGIN
            return redirect('/login')->withErrors(['login' => 'Falha ao autenticar com o Google.']);
        }
    }

    public function createFirstPassword()
    {
        return view('auth.create-first-password');
    }

    public function showPasswordResetForm()
    {
        return view('auth.reset-password');
    }

    public function sendPasswordResetLink(Request $request)
    {
        // AÇÃO DE SOLICITAR RESET DE SENHA POR EMAIL
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function changePasswordForm($email, $token) {
        $userEmail = Str::replace('email=', '', $email);
        $userToken = Str::replace('token=', '', $token);

        User::where('email', $userEmail)->first();

        return view('auth.change-password', [
            'email' => $userEmail,
            'token' => $userToken
        ]);
    }

    public function changePasswordAction(Request $request) {
        // AÇÃO DE ALTERAR A SENHA
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout()
    {
        if (Auth::check()) {

            // REALIZA O LOGOUT
            Auth::logout();

            // REDIRECIONA PARA A PÁGINA INICIAL
            return redirect(route('login'))->with('status', 'Você saiu com sucesso!');
        }
    }
}
