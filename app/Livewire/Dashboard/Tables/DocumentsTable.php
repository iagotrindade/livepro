<?php

namespace App\Livewire\Dashboard\Tables;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Validation\Rules\Enum;
use App\Enums\DocumentType;

class DocumentsTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public $name;
    public $type;
    public $is_mandatory = false;
    public $description;

    public $documentEdited;

    public $editedName;
    public $editedType;
    public $editedIs_mandatory;
    public $editedDescription;

    public $deletedDoc;

    public function render()
    {
        $documents = Document::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);
        return view('livewire.dashboard.tables.documents-table', [
            'documents' => $documents
        ]);
    }

    public function loadUpdateDoc($documentId)
    {
        $this->documentEdited = Document::find($documentId);

        if (!$this->documentEdited) {
            session()->flash('error', 'Documento não encontrado!');
            return;
        }

        $this->editedName = $this->documentEdited->name;
        $this->editedType = $this->documentEdited->type;
        $this->editedIs_mandatory = (bool) $this->documentEdited->is_mandatory;
        $this->editedDescription = $this->documentEdited->description;
    }

    public function updateDocumentAction()
    {
        $this->validate([
            'editedName' => 'required|string|max:255',
            'editedType' => ['required', new Enum(DocumentType::class)],
            'editedIs_mandatory' => 'boolean',
            'editedDescription' => 'nullable|string|max:1000',
        ]);

        if ($this->documentEdited) {
            $this->documentEdited->update([
                'name' => $this->editedName,
                'type' => $this->editedType->value,
                'is_mandatory' => $this->editedIs_mandatory,
                'description' => $this->editedDescription,
            ]);

            session()->flash('message', 'Documento atualizado com sucesso.');
        } else {
            session()->flash('error', 'Documento não encontrado.');
        }

        return redirect()->route('dashboard.docs');
    }

    public function addDocumentAction()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'is_mandatory' => 'boolean',
            'description' => 'nullable|string|max:1000',
        ]);

        Document::create([
            'name' => $this->name,
            'type' => $this->type,
            'is_mandatory' => $this->is_mandatory,
            'description' => $this->description,
        ]);

        return redirect()->route('dashboard.docs')
            ->with('message', 'Documento adicionado com sucesso.');
    }

    public function loadDeleteDoc($documentId)
    {
        $this->deletedDoc = Document::find($documentId);

        if (!$this->deletedDoc) {
            session()->flash('error', 'Usuário não encontrado!');
            return;
        }
    }

    public function deleteDoc()
    {
        if ($this->deletedDoc) {
            $this->deletedDoc->delete();
            session()->flash('message', 'Documento excluído com sucesso.');
            return redirect(request()->header('Referer'));
        } else {
            session()->flash('error', 'Documento não encontrado.');
        }
    }
}
