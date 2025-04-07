<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Exports\ServiceExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\ExportReadyNotification;

class ExportService
{
    public static function export($exportedClass, $fileName)
    {
        try {
            // Gerar um nome de arquivo aleatório
            $filePath = 'dashboard/exports/' . Str::random(30) . '.xlsx';

            // Armazenar o arquivo exportado
            Excel::store(new $exportedClass, $filePath, 'public');

            // Notificar o usuário que a exportação está pronta
            Auth::user()->notify(new ExportReadyNotification($fileName, $filePath));

            return 'A exportação foi iniciada e será processada em breve';
        } catch (Log $e) {
            return 'Erro ao processar a exportação';
        }
    }
}
