<?php

namespace App\Livewire\Dashboard\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class NotificationsArea extends Component
{
    public $notifications;

    public function render()
    {
        $this->notifications = Auth::user()->notifications()->latest()->take(5)->get();
        return view('livewire.dashboard.components.notifications-area', [
            'notifications' => $this->notifications
        ]);
    }

    public function readAllNotifications()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return $this->skipRender();
    }

    #[On('exportComplete')]
    public function exportComplete()
    {
        sleep(20);
        $this->render();
    }

    public function pollNotifications()
    {
        $latestNotifications = Auth::user()->notifications()->latest()->take(5)->get();
        if ($this->notifications != $latestNotifications) {
            $this->notifications = $latestNotifications;
        } else{
            $this->skipRender();
        }
        
    }
}
