<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class RecallNotification extends Notification
{
    use Queueable;
    protected $type;
    protected $user;
    protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($type,$user,$data)
    {
        //
        $this->type = $type;
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        #return ['mail','database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $view = 'recalls.emails.nuevo-recall';
        if($this->type == 'new'){
            $view = 'recalls.emails.nuevo-recall';
        }
        return (new MailMessage)
        ->subject('Nuevo recall')
        ->view($view, ['user' => $this->user,'data' => $this->data]);
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
    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'type' => 'recall-nuevo',
            'tittle' => 'Nuevo recall creado N° '.$this->data->id,
            'message' => NULL,#'Usted debe indicar si el problema presentado se repite en su local',
            'url' => route('respuestaRecall',$this->data->id), // Puedes personalizar la URL según tus necesidades
        ]);
    }
}
