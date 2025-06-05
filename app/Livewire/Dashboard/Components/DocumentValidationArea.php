<?php

namespace App\Livewire\Dashboard\Components;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\DocumentValidation;
use App\Models\ProfessionalDocument;

class DocumentValidationArea extends Component
{
    public $documents;
    
    public function render()
    {
        return view('livewire.dashboard.components.document-validation-area');
    }

    public function mount(Request $request)
    {
        $this->documents = ProfessionalDocument::where('user_id', $request->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
