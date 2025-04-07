<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\UserComposer;
use App\Livewire\Tables\UserPermissions;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Observers\AuditObserver;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $modelPath = app_path('Models');

        // Registra o observer em todos os modelos da pasta
        foreach (File::allFiles($modelPath) as $file) {
            $model = '\\App\\Models\\' . pathinfo($file->getFilename(), PATHINFO_FILENAME);

            if (class_exists($model) && is_subclass_of($model, \Illuminate\Database\Eloquent\Model::class)) {
                $model::observe(AuditObserver::class);
            }
        }

        Role::observe(AuditObserver::class);
        ModelsPermission::observe(AuditObserver::class);
        

        View::composer('*', UserComposer::class);

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return url('alterar/senha/email=' . $user->email . '/token=' . $token);
        });
    }
}
