<?php

namespace App\Livewire\Dashboard\Components;

use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;

class SalesDetails extends Component
{
    public $salesData;

    public function render()
    {
        $currentPeriodSales = Payment::where('type', 'call')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
            ->get();

        // Soma o valor total das vendas no período atual
        $currentPeriodTotal = $currentPeriodSales->sum('amount'); // Substitua 'amount' pelo campo correto

        // Obtém as vendas de 31 a 60 dias atrás
        $previousPeriodSales = Payment::where('type', 'call')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(60))
            ->whereDate('created_at', '<', Carbon::now()->subDays(30))
            ->get();

        // Soma o valor total das vendas no período anterior
        $previousPeriodTotal = $previousPeriodSales->sum('amount'); // Substitua 'amount' pelo campo correto

        // Calcula a diferença percentual
        $percentageChange = 0;
        if ($previousPeriodTotal > 0) {
            $percentageChange = (($currentPeriodTotal - $previousPeriodTotal) / $previousPeriodTotal) * 100;
        } else {
            $percentageChange = $currentPeriodTotal > 0 ? 100 : 0;
        }

        // Adiciona os dados ao estado do componente
        $this->salesData['sales'] = $currentPeriodSales;
        $this->salesData['percentageChange'] = round($percentageChange, 2); // Formata para 2 casas decimais

        return view('livewire.dashboard.components.sales-details');
    }
}
