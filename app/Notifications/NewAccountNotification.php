<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAccountNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $password;
    public $name;
    /**
     * Create a new notification instance.
     */
    public function __construct($password, $name)
    {
        $this->password = $password;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('LivePRO - Nova conta de acesso criada para você')
            ->greeting('Olá ' . $this->name . '!')
            ->line('Sua conta de acesso ao LivePRO foi criada!')
            ->line('Utilize o código ' . $this->password . ' para realizar o primeiro acesso.')
            ->line('Caso não seja ' . $this->name . ', pedimos gentilmente que desconsidere este email');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
