<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyEmail extends VerifyEmailBase
{
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }
        return (new MailMessage)
            ->subject('Overenie e-mailu')
            ->greeting('Dobrý deň!')
            ->line('Ďakujeme za registráciu. Na overenie vašej e-mailovej adresy kliknite na tlačidlo nižšie.')
            ->action(
            'Overiť',
                $this->verificationUrl($notifiable)
            )
            ->line('Ak ste si účet nevytvorili, nie sú potrebné žiadne ďalšie kroky.')
            ->salutation("\r\n\r\n S pozdravom,  \r\n Marketplace");
    }
}