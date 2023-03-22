<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notifaction extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // return $this->from('hamadaali221133@gmail.com')
        //         ->view('emails.forgot');
        // dd($this->data['email']);
        $address = "info@alnamat.com";
        $subject = 'رساله من النمط المتقدم';
        $name = 'elnamat';

        return $this->view('emails.notifaction')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'new_report' => $this->data]);
    }
}
