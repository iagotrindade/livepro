<?php

namespace App\Livewire\Dashboard\Components;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\DocumentValidation;
use App\Models\ProfessionalDocument;
use App\Notifications\DocValidationAssignNotification;
use App\Notifications\DocValidationFinalizedNotification;

class DocumentValidationArea extends Component
{
    public $documents;
    public $justifications = [];

    public function render()
    {
        return view('livewire.dashboard.components.document-validation-area');
    }


    public function mount(Request $request)
    {
        $this->documents = ProfessionalDocument::where('user_id', $request->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($this->documents as $document) {
            $validation = $document->documentValidation;

            if ($validation && $validation->justification) {
                $this->justifications[$validation->id] = $validation->justification;
            }
        }
    }

    public function assignValidation($professionalId)
    {
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

    public function evaluateDocument($documentValidationId, $status)
    {
        if ($status === 'invalidated') {
            // Verifica se há justificativa para este ID
            if (empty($this->justifications[$documentValidationId])) {
                $this->addError('justification', 'A justificativa é obrigatória para invalidar o documento.');
                return;
            }
        }

        $validation = DocumentValidation::findOrFail($documentValidationId);
        $validation->status = $status;
        $validation->justification = $status === 'invalidated' ? $this->justifications[$documentValidationId] : null;
        $validation->save();

        session()->flash('message', 'Documento avaliado com sucesso.');
    }

    public function finalizeValidation($professionalId)
    {
        $professional = User::findOrFail($professionalId);

        if ($professional->notificationPreferences && $professional->notificationPreferences->new_messages) {
            $professional->notify(new DocValidationFinalizedNotification($professional));
        }

        session()->flash('message', 'Validação de documentos finalizada com sucesso.');
        return redirect()->route('dashboard.doc.validation', ['id' => $professionalId]);
    }
}
