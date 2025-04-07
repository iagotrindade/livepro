<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AuditLoginLogoutListener
{
    public function handle($event)
    {
        $action = $event instanceof Login ? 'login' : 'logout';

        DB::table('audit_logs')->insert([
            'user_id' => $event->user->id ?? null,
            'entity_id' => '1',
            'entity_type' => 'App\Models\User', 
            'entity_name' => '-',
            'event' => $action,
            'ip_address' => Request::ip() ?? 'N/A',
            'user_agent' => Request::header('User-Agent') ?? 'N/A',
            'created_at' => now(),
        ]);
    }
}
