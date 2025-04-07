<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;

class IpLocationService
{
    public static function generateSessionData($session)
    {
        $session = (array) $session;
        $apiKey = env('IPINFO_API_KEY');
        $isMobile = self::isMobile($session['user_agent'] ?? '');

        try {
            $response = Http::get("https://ipinfo.io/{" . $session['ip_address'] . "}/json?token={$apiKey}");
            $responseData = $response->json();
        } catch (\Exception $e) {
            // Loga o erro para monitoramento
            Log::error("Erro ao acessar IP API: " . $e->getMessage());
            $responseData = [];
        }

        // Usar a biblioteca Jenssegers\Agent para detectar o navegador e o sistema operacional
        $agent = new Agent();
        $agent->setUserAgent($session['user_agent']);
        $browser = $agent->browser();
        $platform = $agent->platform();

        // Garante que cada item tenha um valor mesmo se a resposta for vazia
        return [
            'id' => $session['id'],
            'ip_address' => $session['ip_address'],
            'platform' => "$browser em um $platform",
            'country' => $responseData['country'] ?? 'Desconhecido',
            'region_code' => $responseData['region'] ?? '',
            'city' => $responseData['city'] ?? '',
            'device_icon' => $isMobile ? '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M5 4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4Zm12 12V5H7v11h10Zm-5 1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
            </svg>'
            :
            '<svg class="w-6 h-6 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
            'last_activity' => $session['last_activity'] ?? 'Atividade não registrada',
        ];
    }

    /**
     * Determina se o dispositivo é mobile com base no user_agent.
     */
    private static function isMobile(string $userAgent): bool
    {
        $mobileKeywords = ['Mobile', 'Android', 'iPhone', 'iPad', 'Windows Phone'];
        foreach ($mobileKeywords as $keyword) {
            if (stripos($userAgent, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }
}
