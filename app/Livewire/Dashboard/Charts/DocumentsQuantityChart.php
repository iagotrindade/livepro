<?php

namespace App\Livewire\Dashboard\Charts;

use Livewire\Component;
use App\Models\ProfessionalDocument;
use Illuminate\Support\Facades\Storage;

class DocumentsQuantityChart extends Component
{
    public $chartData;
    public function loadChartData()
    {
        $folders = ProfessionalDocument::pluck('folder_path');
        $totalFiles = 0;
        $totalSize = 0;
        $filesByDay = array_fill_keys($this->getLast7Days(), 0); // Inicializa a contagem por dia

        foreach ($folders as $folder) {
            $folderPath = $folder; // Caminho relativo ao disco 'public'

            if (Storage::disk('public')->exists($folderPath)) {
                $files = Storage::disk('public')->allFiles($folderPath); // Acessa o disco correto
                $totalFiles += count($files);

                foreach ($files as $file) {
                    $totalSize += Storage::disk('public')->size($file);
                }
            }
        }

        // Consulta os arquivos criados nos últimos 7 dias diretamente no banco de dados
        $documents = ProfessionalDocument::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        // Atualiza os dados do array `filesByDay`
        foreach ($documents as $document) {
            $filesByDay[$document->date] = $document->count;
        }

        // Converte o tamanho total para uma unidade apropriada
        $formattedSize = $this->formatSizeUnits($totalSize);

        $this->chartData = [
            'totalFiles' => $totalFiles,
            'totalSize' => $formattedSize, // Tamanho formatado
            'filesByDay' => $filesByDay,   // Quantidade de arquivos por dia
        ];
    }

    /**
     * Formata o tamanho para uma unidade adequada.
     *
     * @param int $size Tamanho em bytes
     * @return string Tamanho formatado com unidade
     */
    private function formatSizeUnits($size)
    {
        if ($size >= 1073741824) { // Maior ou igual a 1 GB
            return number_format($size / 1073741824, 2) . ' GB';
        } elseif ($size >= 1048576) { // Maior ou igual a 1 MB
            return number_format($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) { // Maior ou igual a 1 KB
            return number_format($size / 1024, 2) . ' KB';
        } else { // Menor que 1 KB (em bytes)
            return $size . ' bytes';
        }
    }

    /**
     * Retorna os últimos 7 dias da semana atual.
     *
     * @return array Lista de datas no formato 'Y-m-d'
     */
    private function getLast7Days()
    {
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $dates[] = date('Y-m-d', strtotime("-$i days"));
        }
        return array_reverse($dates); // Retorna em ordem cronológica
    }

    public function render()
    {
        $this->loadChartData();

        return view('livewire.dashboard.charts.documents-quantity-chart', [
            'chartData' => $this->chartData,
        ]);
    }
}
