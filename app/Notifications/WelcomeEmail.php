<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;  
use Illuminate\Support\Facades\Hash; 
// use Queueable;

class WelcomeEmail extends Notification
{
    // use Queueable;
    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;
    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {  
        return (new MailMessage)
            ->subject(Lang::get('Welcome to '.env('APP_NAME', 'Black Girls Film School'))) 
            ->line(Lang::get('We are pleased to have you on our platform.')) 
            ->line(Lang::get('If you did not create an account, no further action is required.'));
    }
  
    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
