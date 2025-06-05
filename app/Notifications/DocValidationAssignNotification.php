<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocValidationAssignNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $document;

    public function __construct($document)
    {
        $this->document = $document;
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
        $url = url('/documentos/' . $this->document->id);

        return (new MailMessage)
            ->subject('LivePRO - Validação de documento Atribuída a um Agente de Suporte')
            ->greeting('Olá ' . $this->document->professionalDocument->user->name . '!')
            ->line('Informamos que sua validação de documentos já se encontra com um de nossos Agentes de Suporte LivePRO!')
            ->line('Em breve você receberá uma resposta com o resultado da validação.')
            ->line('Acesse a avaliação clicando no botão abaixo!')
            ->action('Seus Documentos', $url);
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
            <path fill-rule="evenodd" d="M9 2a1 1 0 0 0-1 1H6a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2a1 1 0 0 0-1-1H9Zm1 2h4v2h1a1 1 0 1 1 0 2H9a1 1 0 0 1 0-2h1V4Zm5.707 8.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
            </svg>',

            'title' => 'Validação de documento Atribuída a um Agente de Suporte',

            'body' => 'Informamos que sua validação de documentos já se encontra com um de nossos Agentes de Suporte LivePRO! Em breve você receberá uma resposta com o resultado da validação.',
        ];
    }
}
