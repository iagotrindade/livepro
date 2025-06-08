<?php

namespace App\Livewire\Dashboard\Components;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;


class NewsletterArea extends Component
{
    use WithFileUploads;

    public $template;
    public $subject;
    public $content;

    public $files = [];
    public $filesData = [];

    public array $groups;

    public $permissionGroups;

    public $scheduledDate;
    public $scheduledTime;

    public $newTag = [];
    public $tags = [];
    
    public function render()
    {
        return view('livewire.dashboard.components.newsletter-area');
    }

    public function mount()
    {
        $this->permissionGroups = Role::all();

        $this->scheduledDate = now()->format('Y-m-d');
        $this->scheduledTime = Carbon::now()->addHour(1)->format('H:i');
    }

    public function updated($groups)
    {
        foreach ($this->files as $index => $file) {
            if ($file->isValid()) {

                // Nome original com extensão
                $this->filesData[$index]['originalName'] = $file->getClientOriginalName(); 

                // Apenas a extensão
                $this->filesData[$index]['extension'] = $file->getClientOriginalExtension(); 
                
                // Tamanho em Megabytes
                $this->filesData[$index]['size'] = round($file->getSize() / 1024 / 1024, 2); // Tamanho em MB
            }
        }
    }

    public function removeFile($index)
    {
        unset($this->files[$index]);
        unset($this->filesData[$index]);

        // Reindexa o array para evitar gaps no índice
        $this->files = array_values($this->files);
        $this->filesData = array_values($this->filesData);
    }

    public function addNewTag()
    {
        if (!empty($this->newTag)) {
            $this->tags[] = $this->newTag;
            $this->newTag = []; // Limpa o campo após adicionar
        }
    }

    public function removeTag($index)
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags); // Reindexa o array para evitar gaps no índice
    }

    public function scheduleNewsletter()
    {
        $this->validate([
            'template' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduledDate' => 'required|date',
            'scheduledTime' => 'required|date_format:H:i',
            'files.*' => 'file|max:10240', // Limite de 10MB por arquivo
        ]);

        // Lógica para agendar a newsletter
        // ...

        session()->flash('message', 'Newsletter agendada com sucesso!');
    }
}
