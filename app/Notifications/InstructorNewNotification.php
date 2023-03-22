<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Instructor;
use DateTime;
use Carbon\Carbon;
class InstructorNewNotification extends Notification
{
    use Queueable;

    private $userId;
    private $title;
    private $message;
    public function __construct($userId,$title,$message)
    {
        $this->userId= $userId;
        $this->title= $title;
        $this->message=$message;
         
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();
        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");

         return[
            'userId'=> $this->userId,
            'title'=> $this->title,
            'message'=>  $this->message,
            'date'=> $todayDate,
            'time'=>  $timenow,
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
