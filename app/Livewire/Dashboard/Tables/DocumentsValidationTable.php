<?php

namespace App\Livewire\Dashboard\Tables;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ExportService;
use App\Models\DocumentValidation;
use Livewire\WithoutUrlPagination;
use App\Models\ProfessionalDocument;
use App\Exports\DocumentValidationExport;
use App\Notifications\DocValidationAssignNotification;

class DocumentsValidationTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $searchTerm = '';
    public $totalAmount;
    public $statusFilters = [];
    public $startDate = null;
    public $endDate = null;
    public $exportMessage = '';
    public function render()
    {
        // Inicializa a query básica
        $query = DocumentValidation::whereHas('professionalDocument.user')
            ->with('professionalDocument.user');

        // Aplica o termo de busca, se existir
        if (!empty($this->searchTerm)) {
            $query->where('protocol', 'like', '%' . $this->searchTerm . '%')
                ->orWhereHas('professionalDocument.user', function ($q) {
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
        $documentsValidations = $query->paginate(10);

        // Calcula o total de `amount` apenas para os itens exibidos na página atual
        $currentPageTotal = $documentsValidations->getCollection()->sum(function ($schedule) {
            return $schedule->payment->amount ?? 0;
        });

        return view('livewire.dashboard.tables.documents-validation-table', [
            'documentsValidations' => $documentsValidations,
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

    public function exportDocumentValidation()
    {
        $this->exportMessage = ExportService::export(DocumentValidationExport::class, 'Dados da validação de documentos');
        $this->dispatch('exportComplete');
    }

    public function assignValidation($professionalId) {
        $professional = User::findOrFail($professionalId);

        $documents = ProfessionalDocument::where('user_id', $professionalId)->get();

        foreach ($documents as $document) {
            // Atribui o agente de suporte ao documento
            $document->documentValidation->update(['support_agent_id' => auth()->user()->id]);

            // Atualiza o status do documento para "Em Andamento"
            $document->documentValidation->update(['status' => 'in_progress']);
        }

        if ($professional->notificationPreferences && $professional->notificationPreferences->new_messages) {
            $professional->notify(new DocValidationAssignNotification($professional));
        }
        
        return redirect()->route('dashboard.doc.validation', ['id' => $professionalId]);
    }
}
