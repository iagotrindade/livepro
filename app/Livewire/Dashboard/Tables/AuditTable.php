<?php

namespace App\Livewire\Dashboard\Tables;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\AuditLog;
use App\Exports\AuditExport;
use Livewire\WithPagination;
use App\Services\ExportService;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\ExportReadyNotification;

class AuditTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $filter = [];
    public $startDate;
    public $endDate;
    public $exportMessage = '';
    public function render()
    {
        $audits = AuditLog::where(function ($query) {
            $query->where('entity_name', 'like', '%' . $this->search . '%')
                ->orWhere('url', 'like', '%' . $this->search . '%')
                ->orWhereHas('user', function ($userQuery) {
                    $userQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
        })
            ->when(!empty($this->filter), function ($query) {
                $query->whereIn('event', $this->filter);
            })
            ->when(!empty($this->startDate) && !empty($this->endDate), function ($query) {
                $query->whereBetween('created_at', [
                    Carbon::createFromFormat('d/m/Y', $this->startDate)->startOfDay(),
                    Carbon::createFromFormat('d/m/Y', $this->endDate)->endOfDay(),
                ]);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('livewire.dashboard.tables.audit-table', [
            'audits' => $audits,
        ]);
    }


    public function filterByEvent($event)
    {
        if (in_array($event, $this->filter)) {
            $this->filter = array_diff($this->filter, [$event]);
        } else {
            $this->filter[] = $event;
        }
        // Resetar a paginação
        $this->resetPage();
    }

    public function exportAudits()
    {
        $this->exportMessage = ExportService::export(AuditExport::class, 'Dados de auditoria');
        $this->dispatch('exportComplete');
    }
}
