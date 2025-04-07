<?php

namespace App\Livewire\Dashboard\Charts;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\DocumentValidation;

class DocumentsChart extends Component
{
    public $dateRange = 7; // Intervalo padrão de 7 dias

    public function updateDateRange($range)
    {
        $this->dateRange = $range; // Atualiza o intervalo
    }

    public function render()
    {
        // Define as datas de início e fim com base no intervalo escolhido
        $startDate = $this->dateRange === 0
            ? Carbon::today()->startOfDay()
            : Carbon::now()->subDays($this->dateRange)->startOfDay();

        $endDate = Carbon::now()->endOfDay();

        // Filtra os documentos com base no intervalo
        $documents = DocumentValidation::whereBetween('created_at', [$startDate, $endDate])->get();

        // Conta e calcula as porcentagens por status
        $totalDocuments = $documents->count();
        $documentsData = $documents->groupBy('status')->map(function ($group) use ($totalDocuments) {
            return $totalDocuments > 0 ? ($group->count() / $totalDocuments * 100) : 0;
        });

        // Formata os dados para o gráfico
        $chartData = [
            'labels' => $documentsData->keys()->toArray(), // Nomes dos status
            'values' => $documentsData->values()->map(fn($value) => round($value, 2))->toArray(), // Porcentagens arredondadas
        ];

        return view('livewire.dashboard.charts.documents-chart', [
            'chartData' => $chartData,
        ]);
    }
}
