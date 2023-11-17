<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ReclamosRespuestasNotification extends Notification
{
    use Queueable;
    protected $reclamo;
    protected $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$reclamo)
    {
        //
        $this->user = $user;
        $this->reclamo = $reclamo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            /* ->subject('Nuevo reclamo')
            ->line('Se ha creado un nuevo reclamo.')
            ->action('Ver Reclamo', url(''))
            ->line('Gracias por utilizar nuestra plataforma.'); */
                                ->subject('Nuevo reclamo')
                                ->view('reclamos.emails.notificar-respuesta-reclamo', ['user' => $this->user,'reclamo' => $this->reclamo]); 
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reclamo_id' => 1,
            'message' => 'Nuevo reclamo creado',
            'url' => 'a', // Puedes personalizar la URL según tus necesidades
        ];
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'type' => 'reclamo-notificar-respuestas',
            'tittle' => 'Nuevo reclamo creado N° '.$this->reclamo->id,
            'message' => 'Usted debe indicar si el problema presentado se repite en su local',
            'url' => route('procesoReclamo',$this->reclamo->id).'#localesConProblemaDiv', // Puedes personalizar la URL según tus necesidades
        ]);
    }
}
