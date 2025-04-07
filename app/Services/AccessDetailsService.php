<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AccessDetailsService
{
    public static function generateAccessDetails(Request $request)
    {
        $apiKey = env('IPINFO_API_KEY');
        
        // GERA OS DETALHES DO ACESSO
        $ip = $request->ip();

        try {
            $response = Http::get("https://ipinfo.io/{" . $ip . "}/json?token={$apiKey}");
            $responseData = $response->json();
        } catch (\Exception $e) {
            // Loga o erro para monitoramento
            Log::error("Erro ao acessar IP API: " . $e->getMessage());
            $responseData = [];
        }

        // Garante que cada item tenha um valor mesmo se a resposta for vazia
        return [
            'ip' => $request->header('X-Forwarded-For') ?? $ip,
            'platform' => $_SERVER['HTTP_SEC_CH_UA_PLATFORM'] ?? 'Desconhecido',
            'country' => $responseData['country'] ?? 'Desconhecido',
            'region_code' => $responseData['region'] ?? '',
            'city' => $responseData['city'] ?? '',
            'date' => now()->format('d/m/Y H:i'),
        ];
    }
}
