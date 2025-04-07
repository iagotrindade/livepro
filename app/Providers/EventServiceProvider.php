<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Os eventos e seus listeners correspondentes.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\AuditLoginLogoutListener::class,
        ],
        \Illuminate\Auth\Events\Logout::class => [
            \App\Listeners\AuditLoginLogoutListener::class,
        ],
    ];

    /**
     * Registra qualquer serviço adicional relacionado a eventos.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determina se os eventos devem ser descobertos automaticamente.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
