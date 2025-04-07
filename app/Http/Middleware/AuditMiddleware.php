<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuditMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Verifica se a requisição é uma requisição AJAX (usada pelo Livewire) ou se a URL contém 'livewire'
        if (!$request->ajax() && !$this->isLivewireRequest($request) && !$request->has('page')) {
            DB::table('audit_logs')->insert([
                'user_id' => Auth::id() ?? null,
                'entity_id' => Auth::id() ?? 1,
                'entity_type' => 'App\Models\User',
                'entity_name' => '-',
                'event' => 'accessed',
                'url' => $request->fullUrl(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
            ]);
        }

        return $response;
    }

    /**
     * Verifica se a requisição é uma requisição Livewire.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function isLivewireRequest($request)
    {
        return $request->is('livewire/*');
    }
}
