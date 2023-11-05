<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
//custom
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\ResetPassword;

class MailResetPasswordNotification extends Notification{
    use Queueable;
    protected $pageUrl;
    public $token;/*** Create a new notification instance.** @return void*/
    public function __construct($token){
        //parent::__construct($token);
            $this->token = $token;
        $this->pageUrl = 'localhost:8000';
        // we can set whatever we want here, or use .env to set environmental variables
    }

    public function via($notifiable){
        return ['mail'];
    }

//     public function toMail($notifiable){
//         if (static::$toMailCallback) {
//             return call_user_func(static::$toMailCallback, $notifiable, $this->token);
//         }
//         return (new MailMessage)
//         ->subject(Lang::getFromJson('Reset application Password v1'))
//         ->line(Lang::getFromJson('You are receiving this email because we received a password reset request for your account.'))
//         ->action(Lang::getFromJson('Reset Password'), $this->pageUrl."?token=".$this->token)
//         ->line(Lang::getFromJson('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
//         ->line(Lang::getFromJson('If you did not request a password reset, no further action is required.'));}
//
public function toMail($notifiable)
{
    $urlToResetForm = "https://127.0.0.1:8000/password/forgot-password?token=". $this->token;
    return (new MailMessage)
        ->subject('Hey! Reset Password Notification')
        ->line('You requested here you go!')
        ->action('Reset Password',$urlToResetForm)
        ->line('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')])
        ->line('If you did not request a password reset, no further action is required. Token: ==>'. $this->token);

}
}
