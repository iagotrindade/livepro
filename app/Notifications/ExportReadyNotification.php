<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;

class ExportReadyNotification extends Notification
{
    use Queueable;

    protected $fileName;
    protected $filePath;

    public function __construct($fileName, $filePath)
    {
        $this->fileName = $fileName;
        $this->filePath = $filePath;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Sua exportação está pronta')
            ->line('O arquivo "' . $this->fileName . '" está pronto para download.')
            ->action('Baixar Arquivo', url('/storage/' . $this->filePath));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'image' => '<a href="' . url('/storage/' . $this->filePath) . '"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"    width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/></svg></a>',

            'title' => 'Exportação de arquivo concluída',

            'body' => 'O arquivo "' . $this->fileName . '" está pronto para download',

            'url' => url('/storage/' . $this->filePath),

            'download' => true,
        ];
    }
}
