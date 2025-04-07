<?php

namespace App\Livewire\Dashboard\Components;

use Livewire\Component;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ServiceArea extends Component
{
    public $schedule;

    public function render(Request $request)
    {   
        $this->schedule = Schedule::find($request->id);
        
        return view('livewire.dashboard.components.service-area');
    }
}
