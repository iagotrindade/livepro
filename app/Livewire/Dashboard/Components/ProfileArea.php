<?php

namespace App\Livewire\Dashboard\Components;

use Carbon\Carbon;
use App\Models\Image;
use App\Models\Review;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\ReviewDispute;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Services\IpLocationService;
use App\Services\DecryptDataService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Services\AccessDetailsService;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Tables\UserPermissions;
use App\Notifications\PasswordChangeNotification;
use App\Notifications\UpdateAccountNotification;
use Illuminate\Contracts\Encryption\DecryptException;

class ProfileArea extends Component
{
    use WithFileUploads;

    public $user;

    public $accessDetails;

    #[Validate('image', onUpdate: false)]
    public $avatar;

    #[Validate('required|string|max:255|min:3')]
    public $name;

    #[Validate('required|string|min:11|unique:users,cpf_cnpj')]
    public $cpf_cnpj;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:8')]
    public $phone;

    public $birthdate;
    public $biography;
    public $memberSince;

    public $newPasswordRules = [];

    #[Validate('required|min:8')]
    public $current_password;

    public $password;

    #[Validate('required|min:8')]
    public $password_confirmation;

    public $userSessions = [];
    public $roles;
    public $userRole;
    public $sessionDeletedId = null;
    
    public $disputedReview;

    #[Validate('required|min:50', as: 'descrição')]
    public $disputeReason;

    public function mount(Request $request)
    {
        $this->user = auth()->user();
        $this->userRole = (isset($this->user) && $this->user->roles->isNotEmpty())
            ? $this->user->roles->first()->name
            : '';

        $this->name = $this->user->name;
        $this->cpf_cnpj = DecryptDataService::decryptData($this->user->cpf_cnpj);
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->birthdate = Carbon::parse($this->user->birthdate)->format('d/m/Y');
        $this->biography = $this->user->biography;
        $this->memberSince = $this->user->created_at->diffForHumans();

        $this->roles = Role::all();

        $this->accessDetails = AccessDetailsService::generateAccessDetails($request);   
    }

    public function render()
    {
        // Obter informações da sessão
        $this->userSessions = [];
        $sessions = DB::table('sessions')->where('user_id', $this->user->id)->get();

        foreach ($sessions as $session) {
            $sessionArray = (array) $session;

            if (isset($sessionArray['ip_address'])) {
                $this->userSessions[] = IpLocationService::generateSessionData($sessionArray);
            }
        }

        return view('livewire.dashboard.components.profile-area');
    }

    public function updated($avatar, $value)
    {
        if (!empty($this->avatar)) {
            $this->validate([
                'avatar' => 'image', // 1MB Max
            ]);
            $this->saveAvatar();
        }
    }

    public function saveAvatar()
    {
        if ($this->user->avatar && $this->user->avatar->file) {
            Storage::disk('public')->delete($this->user->avatar->file);
        }

        $avatarPath = $this->avatar->store('assets/images/avatars', 'public');

        if ($this->user->avatar) {
            // Update with the new avatar
            $this->user->avatar->update([
                'file' => $avatarPath,
            ]);

            $this->user->notify(new UpdateAccountNotification($this->user->name, $this->accessDetails));
        } else {
            // Create a new avatar
            $this->user->avatar()->create([
                'user_id' => $this->user->id,
                'file' => $avatarPath,
            ]);
        }

        return redirect()->route('dashboard.profile');
    }

    public function deleteAvatar()
    {
        // Delete the old avatar if it exists
        if ($this->user->avatar && $this->user->avatar->file) {
            Storage::disk('public')->delete($this->user->avatar->file);
        }

        // Update with the new avatar
        $this->user->avatar->delete();
    }

    public function changePermission()
    {
        $this->authorize('editPermissions');

        $this->user->removeRole($this->user->roles[0]->name);
        $this->user->assignRole($this->userRole);
        $this->userRole = '';

        session()->flash('permissionMessage', 'O seu cargo foi alterado');
        $this->user->notify(new UpdateAccountNotification($this->user->name, $this->accessDetails));
        return redirect()->route('dashboard.profile');
    }

    public function prepareRevokeSession($id)
    {
        $this->sessionDeletedId = $id;
    }

    public function revokeSession()
    {
        if ($this->sessionDeletedId) {
            DB::table('sessions')->where('id', $this->sessionDeletedId)->delete();

            $this->sessionDeletedId = null;

            session()->flash('sessionMessage', 'Sessão encerrada com sucesso');

            return redirect()->route('dashboard.profile');
        }
    }

    public function changeNotificationPreferences($type)
    {
        $notificationPreferences = $this->user->notificationPreferences;

        $currentValue = $notificationPreferences->$type;
        $newValue = $currentValue == 1 ? 0 : 1;

        $notificationPreferences->update([
            $type => $newValue
        ]);
    }

    public function saveGeneralData()
    {
        $this->user->update([
            'name' => $this->name,
            'cpf_cnpj' => Crypt::encryptString($this->cpf_cnpj),
            'email' => $this->email,
            'phone' => $this->phone,
            'birthdate' => Carbon::createFromFormat('d/m/Y', $this->birthdate),
            'biography' => $this->biography,
        ]);

        session()->flash('generalDataMessage', 'Suas informações foram atualizadas com sucesso');

        $this->user->notify(new UpdateAccountNotification($this->user->name, $this->accessDetails));
    }

    public function updatedPassword()
    {
        $password = $this->password ?? '';
        $passwordLength = strlen($password);

        // Calcula a força da senha com base no comprimento
        $this->newPasswordRules['length'] = match (true) {
            $passwordLength >= 8 => 4,
            $passwordLength >= 5 => 3,
            $passwordLength >= 3 => 2,
            $passwordLength >= 1 => 1,
            default => 0,
        };

        // Verifica critérios adicionais
        $this->newPasswordRules['uppercase'] = preg_match('/[A-Z]/', $password) > 0;
        $this->newPasswordRules['lowercase'] = preg_match('/[a-z]/', $password) > 0;
        $this->newPasswordRules['symbols'] = preg_match('/[\W_]/', $password) > 0; // Corrigido para incluir "_"
        $this->newPasswordRules['recommended_length'] = $passwordLength >= 12;
    }

    public function changePassword()
    {
        // Valida os campos antes de qualquer operação
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'A nova senha e a confirmação devem coincidir.',
        ]);

        // Verifica se a senha atual está correta
        if (Hash::check($this->current_password, $this->user->password)) {
            $this->user->update([
                'password' => bcrypt($this->password),
            ]);

            session()->flash('passwordMessage', 'Sua senha foi atualizada com sucesso');

            $this->user->notify(new PasswordChangeNotification($this->user->name, $this->accessDetails));
            
        } else {
            $this->addError('current_password', 'A senha atual está incorreta.');
        }
    }

    public function setDisputedReview($id) {
        $this->disputedReview = Review::find($id);
    }

    public function disputReview() {
        $this->validate([
            'disputeReason' => 'required|min:50',
        ]);

        if ($this->disputedReview) {
            ReviewDispute::create([
                'review_id' => $this->disputedReview->id,
                'reason' => $this->disputeReason,
                'status' => 'open',
            ]);

            $this->disputedReview->update([
                'status' => 'under_analysis',
            ]);

            session()->flash('reviewMessage', 'A sua solicitação foi enviada para análise');
        }
    }
}
