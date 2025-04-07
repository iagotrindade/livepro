<?php

namespace App\Livewire\Dashboard\Tables;

use Carbon\Carbon;
use App\Models\Support;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\SupportExport;
use App\Services\ExportService;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\ExportReadyNotification;

class SupportsTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $searchTerm = '';      // Termo de busca
    public $totalAmount;          // Quantidade total
    public $statusFilters = [];   // Filtros de status selecionados
    public $startDate = null;     // Data inicial do filtro
    public $endDate = null;       // Data final do filtro
    public $exportMessage = '';
    public function render()
    {
        // Inicializa a query básica
        $query = Support::with('user');

        // Aplica o termo de busca, se existir
        if (!empty($this->searchTerm)) {
            $query->where('protocol', 'like', '%' . $this->searchTerm . '%')
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('email', 'like', '%' . $this->searchTerm . '%'); // Filtra pelo nome ou email do usuário
                });
        }

        // Aplica os filtros de status, se existirem
        if (!empty($this->statusFilters)) {
            $query->whereIn('status', $this->statusFilters);
        }

        // Aplica o filtro de intervalo de datas, se existir
        if (!empty($this->startDate) && !empty($this->endDate)) {
            $start = Carbon::createFromFormat('d/m/Y', $this->startDate)->startOfDay();
            $end = Carbon::createFromFormat('d/m/Y', $this->endDate)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }

        // Pagina os resultados
        $supports = $query->paginate(10);

        // Calcula o total de `amount` apenas para os itens exibidos na página atual
        $currentPageTotal = $supports->getCollection()->sum(function ($schedule) {
            return $schedule->payment->amount ?? 0;
        });

        return view('livewire.dashboard.tables.supports-table', [
            'supports' => $supports,
            'currentPageTotal' => $currentPageTotal,
        ]);
    }

    public function search($term)
    {
        $this->resetPage();
        $this->searchTerm = $term;
    }

    public function filter($status)
    {
        // Adiciona ou remove o filtro dependendo do estado do checkbox
        if (in_array($status, $this->statusFilters)) {
            $this->statusFilters = array_diff($this->statusFilters, [$status]); // Remove o filtro
        } else {
            $this->statusFilters[] = $status; // Adiciona o filtro
        }

        $this->resetPage();
    }

    public function filterByDate($start, $end)
    {
        $this->resetPage();

        // Define as datas do filtro
        $this->startDate = $start;
        $this->endDate = $end;
    }

    public function exportSupports()
    {
        $this->exportMessage = ExportService::export(SupportExport::class, 'Dados dos chamados de suporte');
        $this->dispatch('exportComplete');
    }
}
