<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PromotionalNotification extends Notification
{
    use Queueable;
    public string $message;
    public string $title;

    /**
     * Create a new notification instance.
     */
    public function __construct($message,$title)
    {
         $this->message=$message;
         $this->title=$title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
         return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
   

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
       return [
           'title' => $this->title,
            'body' => $this->message,
            'url' => url('/offers'),
        ];
    }
}
