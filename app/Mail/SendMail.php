<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

   
     public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->subject('User Account Verification Mail From Daxlinks')
                    ->view('mail.VerificationMail');


            // return $this->subject('Testing mails')
            //         ->from('jimohsherifdeen6@gmail.com')
            //         ->view('test_file');
    }
}
