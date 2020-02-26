<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class passwordResetNotification extends Notification
{
    use Queueable;

    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->line(Lang::getFromJson('Este correo te lo EnVia iMenu tu App para buscar tu mejor comida'))
            ->greeting('Hola')
            ->subject(Lang::getFromJson('Correo para cambiar su contraseña'))
            ->line(Lang::getFromJson('Ud a recibido este correo para cambiar su contraseña de cuenta de iMenu.'))
            ->action(Lang::getFromJson('Cambiar su contraseña'), url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(Lang::getFromJson('Este link para cambiar su contraseña durara unos cuantos minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::getFromJson('Si no necesita cambiar la contraseña no realice ninguna acción, muchas gracias por utilizar nuestra aplicación iMenu'))
            ->salutation('Saludos, '. config('app.name'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
