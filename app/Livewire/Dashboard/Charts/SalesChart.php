<?php

namespace App\Livewire\Dashboard\Charts;

use Carbon\Carbon;
use App\Models\Payment;
use Livewire\Component;
use App\Exports\ServiceExport;
use App\Services\ExportService;

class SalesChart extends Component
{
    public $salesData;
    public $salesFilterData;
    public $previousMonthSales;
    public $previousTotalAmount;
    public $percentageChange;
    public $trend;
    public $refoundedPayments;
    public $totalAmount;
    public $salesChartInfo;
    public $dateRange = 7;
    public $exportMessage;

    public function mount()
    {
        $this->updateChartData();
    }

    /**
     * Atualiza os dados do gráfico e as métricas com base no intervalo de datas.
     */
    public function updateChartData()
    {
        $referenceDate = Carbon::now()->subDays($this->dateRange)->startOfDay();

        // Define o filtro de data para vendas no intervalo atual
        $this->salesFilterData = $referenceDate->copy();

        // Obter as vendas finalizadas no intervalo atual
        $this->salesData = Payment::whereDate('updated_at', '>=', $this->salesFilterData)
            ->where('status', 'finalized')
            ->get();

        // Total de vendas no intervalo atual
        $this->totalAmount = $this->salesData->sum('amount');

        // Obter vendas do intervalo anterior
        $previousStart = $referenceDate->copy()->subDays($this->dateRange * 2);
        $previousEnd = $referenceDate->copy()->subDays($this->dateRange);
        $this->previousMonthSales = Payment::whereBetween('updated_at', [$previousStart, $previousEnd])
            ->where('status', 'finalized')
            ->get();

        // Total de vendas no intervalo anterior
        $this->previousTotalAmount = $this->previousMonthSales->sum('amount');

        // Calcular a diferença percentual entre os intervalos
        $this->percentageChange = $this->previousTotalAmount > 0
            ? (($this->totalAmount - $this->previousTotalAmount) / $this->previousTotalAmount) * 100
            : 100;

        // Definir a tendência de vendas
        $this->trend = $this->percentageChange >= 0 ? 'up' : 'down';

        // Obter pagamentos estornados no intervalo atual
        $this->refoundedPayments = Payment::whereDate('updated_at', '>=', $this->salesFilterData)
            ->where('status', 'refounded')
            ->get(['amount']);

        // Consultas para séries de dados agrupadas por data
        $salesSeries = $this->getSeriesData('finalized', 'amount', $referenceDate);
        $profitSeries = $this->getSeriesData('finalized', 'profit_tax', $referenceDate);
        $refoundedSeries = $this->getSeriesData('refounded', 'amount', $referenceDate);

        // Extrair e formatar as datas para o eixo X no formato "d M" em português
        $categories = collect();
        foreach (range(0, $this->dateRange - 1) as $i) {
            $date = $referenceDate->copy()->addDays($i);
            $categories->push($date->translatedFormat('d M'));
        }

        // Atualizar os dados do gráfico
        $this->salesChartInfo = [
            'categories' => $categories->unique()->values(),
            'series' => [
                [
                    'name' => 'Transitado',
                    'data' => $salesSeries->pluck('total_amount'),
                ],
                [
                    'name' => 'Lucro',
                    'data' => $profitSeries->pluck('total_amount'),
                ],
                [
                    'name' => 'Estornado',
                    'data' => $refoundedSeries->pluck('total_amount'),
                ],
            ],
        ];
    }


    
    /**
     * Helper para obter dados da série de pagamentos agrupados por data e aplicando o intervalo.
     *
     * @param string $status Status do pagamento.
     * @param string $field Campo a ser somado (amount ou profit_tax).
     * @param \Carbon\Carbon $startDate Data inicial do intervalo.
     * @return \Illuminate\Support\Collection
     */
    private function getSeriesData(string $status, string $field, Carbon $startDate)
    {
        $endDate = Carbon::now()->endOfDay();

        return Payment::where('status', $status)
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->selectRaw('DATE(updated_at) as date, SUM(' . $field . ') as total_amount')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    /**
     * Atualiza o intervalo de datas e recarrega os dados.
     */
    public function updateDateRange($range)
    {
        $this->dateRange = $range;
        $this->updateChartData();
    }

    public function render()
    {
        return view('livewire.dashboard.charts.sales-chart');
    }

    public function exportSales() {
        $this->exportMessage = ExportService::export(ServiceExport::class, 'Dados dos serviços');
        $this->dispatch('exportComplete');
    }
}
