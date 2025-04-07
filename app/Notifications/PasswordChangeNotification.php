<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordChangeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $userName;
    public $accessDetails;

    public function __construct($name, $accessDetails)
    {
        $this->userName = $name;
        $this->accessDetails = $accessDetails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('LivePRO - Alteração de senha da sua conta')
            ->greeting('Olá ' . $this->userName . '!')
            ->line('Nós detectamos uma alteração de senha da sua conta no LivePRO!')
            ->line('Caso não seja você que tenha feito essa alteração, recomendamos alterar imediatamente sua senha de acesso')
            ->line('Acesso com o endereço IP ' . $this->accessDetails['ip'] . ' , localizado em' . $this->accessDetails['city'] . ', ' . $this->accessDetails['region_code'] . ' - ' . $this->accessDetails['country'] . '. Sistema operacional: ' . $this->accessDetails['platform'] . '. Data e hora do acesso: ' . $this->accessDetails['date'] . '.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'image' => '<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12.356 3.066a1 1 0 0 0-.712 0l-7 2.666A1 1 0 0 0 4 6.68a17.695 17.695 0 0 0 2.022 7.98 17.405 17.405 0 0 0 5.403 6.158 1 1 0 0 0 1.15 0 17.406 17.406 0 0 0 5.402-6.157A17.694 17.694 0 0 0 20 6.68a1 1 0 0 0-.644-.949l-7-2.666Z"/>
            </svg>',

            'title' => 'Alteração de senha da sua conta',

            'body' => 'A senha da sua conta foi alterada. Caso não seja você que tenha feito essa alteração, recomendamos alterar imediatamente sua senha de acesso',
        ];
    }
}
