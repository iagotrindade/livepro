<?php

namespace App\Livewire\Dashboard\Components;

use Livewire\Component;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ServiceArea extends Component
{
    public $schedule;

    public $status;
    public $resolution;

    public function render(Request $request)
    {   
        return view('livewire.dashboard.components.service-area');
    }

    public function mount(Request $request)
    {
        $this->schedule = Schedule::find($request->id);
        $this->status = $this->schedule->dispute->status->value ?? '';
    }

    public function submitResolution()
    {
        $this->validate([
            'status' => 'required|in:open,under_analysis,in_review,granted,dismissed',
            'resolution' => 'required|string|max:255',
        ]);

        $this->schedule->dispute->update([
            'status' => $this->status,
            'resolution' => $this->resolution,
        ]);

        session()->flash('message', 'Resolução enviada com sucesso!');
    }
}
