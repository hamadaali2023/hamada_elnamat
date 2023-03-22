<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReport extends Mailable
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
        $address = $this->data['email'];
        $subject = $this->data['subject'];
        $name = 'منصة النمط';

        return $this->view('emails.sendreport')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'new_report' => $this->data]);
    }
}
