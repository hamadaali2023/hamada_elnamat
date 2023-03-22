<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
class UserNewNotification extends Notification
{
    use Queueable;

    private $post;
    public function __construct(User $post)
    {
        $this->post= $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {
        return[
            'id'=>    $this->post->id,
            'title'=> $this->post->name,
            'data'=>  $this->post->created_at
        ];
    }   
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
