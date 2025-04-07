<?php

namespace App\Livewire\Dashboard\Tables;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;

class TopUsersTable extends Component
{
    public $topClients;
    public $topProfessionals;
    public $referenceDate;

    public function mount()
    {
        // Inicializa a data de referência como "lastThirty" (início do mês atual)
        $this->changeReferenceDate('lastThirty');
    }

    public function render()
    {
        return view('livewire.dashboard.tables.top-users-table');
    }

    public function changeReferenceDate($date)
    {
        // Define a data de referência com base na opção escolhida
        switch ($date) {
            case 'yesterday':
                $this->referenceDate = Carbon::yesterday();
                break;

            case 'today':
                $this->referenceDate = Carbon::today();
                break;

            case 'lastSeven':
                $this->referenceDate = Carbon::now()->subDays(7);
                break;

            case 'lastThirty':
                $this->referenceDate = Carbon::now()->subDays(30);
                break;

            case 'lastNinety':
                $this->referenceDate = Carbon::now()->subDays(90);
                break;
        }

        $referenceDate = $this->referenceDate;

        // Top 5 clientes com mais pagamentos no período definido
        $this->topClients = User::whereHas('clientPayments', function ($query) use ($referenceDate) {
            $query->where('status', 'finalized')
                  ->whereDate('updated_at', '>=', $referenceDate);
        })
        ->withSum(['clientPayments as total_monthly_amount' => function ($query) use ($referenceDate) {
            $query->where('status', 'finalized')
                  ->whereDate('updated_at', '>=', $referenceDate);
        }], 'amount')
        ->orderBy('total_monthly_amount', 'desc')
        ->limit(5)
        ->get();

        // Top 5 profissionais com mais pagamentos no período definido
        $this->topProfessionals = User::whereHas('professionalPayments', function ($query) use ($referenceDate) {
            $query->where('status', 'finalized')
                  ->whereDate('updated_at', '>=', $referenceDate);
        })
        ->withSum(['professionalPayments as total_monthly_amount' => function ($query) use ($referenceDate) {
            $query->where('status', 'finalized')
                  ->whereDate('updated_at', '>=', $referenceDate);
        }], 'amount')
        ->orderBy('total_monthly_amount', 'desc')
        ->limit(5)
        ->get();
    }
}
