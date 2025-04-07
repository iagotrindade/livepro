<?php

use App\Http\Controllers\AuditController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;

// ROTAS DE AUTENTICAÇÃO E RECUPERAÇÃO
Route::middleware(['guest'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        // LOGIN
        Route::view('/entrar', 'auth.signin')->name('login');
        Route::post('/entrar/acao', 'authenticateUser')->name('signin.action');

        // LOGIN COM GOOGLE
        Route::get('/auth/redirect/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
        Route::get('/auth/callback/google', [AuthController::class, 'handleGoogleCallback']);

        // CONFIRMAR LOGIN
        Route::get('/confirmar/entrada', 'showTwoFactorForm')->name('confirm.signin');
        Route::post('/confirmar/entrada/acao', 'verifyTwoFactorCode')->name('confirm.signin.action');

        // REGISTRAR-SE
        Route::get('/registrar', 'showRegistrationForm')->name('signup');
        Route::post('/registrar/acao', 'processRegistration')->name('signup.action');

        // RECUPERAR E ALTERAR SENHA
        Route::get('/primeira/senha', 'choseFirstPassword')->name('chose.first.password');

        Route::get('/recuperar/senha', 'showPasswordResetForm')->name('password.reset.form');
        Route::post('/recuperar/senha/acao', 'sendPasswordResetLink')->name('send.reset.password');

        Route::get('alterar/senha/{email}/{token}', 'changePasswordForm')->name('password.reset');
        Route::post('alterar/senha/acao', 'changePasswordAction')->name('password.reset.action');
    });
});

// ROTAS DO PÚBLICAS DO SITE 
Route::get('/home', [SiteController::class, 'index'])->name('home');


// ROTAS DO SITE E DASHBOARD (USUÁRIOS AUTENTICADOS)
Route::middleware(['auth'])->group(function () {
    // SITE -> HOME
    Route::controller(HomeController::class)->group(function () {});

    // DASHBOARD -> HOME
    Route::view('/dashboard', 'dashboard.home')->name('dashboard');

    // DASHBOARD -> NOTIFICATIONS
    Route::view('/dashboard/notificacoes', 'dashboard.notifications', ['breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => url('dashboard')],
        ['label' => 'Notificações', 'url' => url('notificacoes')],
    ]])->name('notifications');

    // DASHBOARD -> USERS
    Route::middleware(['can:viewUsers'])->group(function () {
        Route::view('/dashboard/usuarios', 'dashboard.users', ['breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => url('dashboard')],
            ['label' => 'Usuários', 'url' => url('usuarios')],
        ]])->name('users');

        Route::view('usuario', 'user')->name('user');
    });

    // DASHBOARD -> PERMISSIONS
    Route::middleware(['can:viewPermissions'])->group(function () {
        Route::view('/dashboard/permissoes', 'dashboard.permissions', ['breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => url('dashboard')],
            ['label' => 'Permissões', 'url' => url('permissoes')],
        ]])->name('permissions');
    });

    //DASHBOARD -> AUDIT LOGS
    Route::middleware(['can:viewPermissions'])->group(function () {
        Route::view('/dashboard/auditora', 'dashboard.audit', ['breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => url('dashboard')],
            ['label' => 'Auditoria', 'url' => url('auditoria')],
        ]])->name('audit');
    });

    //DASHBOARD -> PROFILE
    Route::view('/dashboard/perfil', 'dashboard.profile', ['breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => url('dashboard')],
        ['label' => 'Perfil', 'url' => url('dashboard/perfil')],
    ]])->name('dashboard.profile');

    //DASHBOARD -> TOP USERS
    Route::middleware(['can:viewMarketing'])->group(function () {
        Route::view('/dashboard/top/usuarios', 'dashboard.top-users', ['breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => url('dashboard')],
            ['label' => 'Top Usuários', 'url' => url('dashboard/top/usuarios')],
        ]])->name('dashboard.top.users');
    });

    //DASHBOARD -> SUPPORT
    Route::middleware(['can:viewSupport'])->group(function () {
        Route::view('/dashboard/suporte', 'dashboard.supports', ['breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => url('dashboard')],
            ['label' => 'Suporte', 'url' => url('dashboard/suporte')],
        ]])->name('dashboard.supports');
    });

    //DASHBOARD -> REPORTS -> SALES
    Route::middleware(['can:viewFinancial'])->group(function () {
        Route::view('/dashboard/relatorios/vendas', 'dashboard.reports.sales', ['breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => url('dashboard')],
            ['label' => 'Relatórios', 'url' => url('dashboard/relatorios/vendas')],
            ['label' => 'Vendas', 'url' => url('dashboard/relatorios/vendas')],
        ]])->name('dashboard.reports.sales');
    });

    //DASHBOARD -> REPORTS -> DOCUMENTS
    Route::middleware(['can:viewDocs'])->group(function () {
        Route::view('/dashboard/relatorios/documentos', 'dashboard.reports.docs-validation', ['breadcrumbs' => [
            ['label' => 'Dashboard', 'url' => url('dashboard')],
            ['label' => 'Relatórios', 'url' => url('dashboard/relatorios/documentos')],
            ['label' => 'Avaliação de documentos', 'url' => url('dashboard/relatorios/documentos')],
        ]])->name('dashboard.reports.documents');
    });

    //DASHBOARD -> SERVICE
    Route::view('/dashboard/servico/{id}', 'dashboard.service', ['breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => url('dashboard')],
        ['label' => 'Serviço', 'url' => url('/dashboard/servico/{id}')],
    ]])->name('dashboard.service');

    // LOGOUT
    Route::controller(AuthController::class)->group(function () {
        Route::get('criar/primeira/senha', 'createFirstPassword')->name('create.first.password');
        Route::get('/sair', 'logout')->name('logout');
    });
});
