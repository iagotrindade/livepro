<?php

namespace App\Livewire\Dashboard\Components;

use App\Models\Support;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use App\Notifications\SupportAssignNotification;
use App\Notifications\SupportAnsweredNotification;

class SupportArea extends Component
{
    use WithFileUploads;

    public $support;
    public $status;
    public $files = [];
    public $filesData = [];
    public $resolution = "Sua Mensagem aqui...

Atenciosamente,
Seu nome, Agente de Suporte Livepro.app";

    public function render()
    {
        return view('livewire.dashboard.components.support-area');
    }

    public function mount(Request $request)
    {
        $this->support = Support::find($request->id);
        $this->status = $this->support->status;
    }

    public function updated($files)
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

    public function updateStatus()
    {
        $this->support->update(['status' => $this->status]);

        // Atualiza o componente para refletir a mudança de status
        $this->dispatch('statusUpdated', ['status' => $this->status]);
    }

    public function assignTicket() {
        // Atualiza o agente de suporte do ticket
        $this->support->update(['support_agent_id' => auth()->user()->id]);

        // Atualiza o status do ticket para "Em Andamento"
        $this->support->update(['status' => 'in_progress']);

        // Se as preferências de notificações de novas mensagens estiverem ativadas, encaminhar email e notificação para o usuário se o usuário
        
        if ($this->support->user->notificationPreferences &&  $this->support->user->notificationPreferences->new_messages) {
            $this->support->user->notify(new SupportAssignNotification( $this->support));
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

    public function sendResponse(Request $request)
    {
        $this->validate([
            'resolution' => 'required|string|max:1000',
            'files.*' => 'nullable|file|max:10240', // 10MB max for each file
        ]);

        // Handle file uploads
        if (!empty($this->files)) {
            // Zip the files if there are multiple
            if (is_array($this->files)) {
                $zip = new \ZipArchive();

                //Create random zip file name

                $zipFileName = 'support_' . $this->support->protocol . '_' . time() . '.zip';

                $zip->open(storage_path('app/public/support_files/' . $zipFileName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

                foreach ($this->files as $file) {
                    if ($file->isValid()) {
                        $zip->addFile($file->getRealPath(), $file->getClientOriginalName());
                    }
                }

                $zip->close();
                $fileName = $zipFileName;
            }
        } else {
            $fileName = "";
        }

        $this->support->update([
            'resolution' => $this->resolution,
            'status' => 'resolved',
            'support_files' => $fileName,
            'closed_at' => now(),
        ]);

        // Notifica o usuário que o ticket foi respondido caso as preferências de notificações de novas mensagens estiverem ativadas
        if ($this->support->user->notificationPreferences &&  $this->support->user->notificationPreferences->new_messages) {
            $this->support->user->notify(new SupportAnsweredNotification($this->support));
        }

        return redirect()->route('dashboard.support', $this->support->id)
            ->with('success', 'Resposta enviada com sucesso!');
    }
}
