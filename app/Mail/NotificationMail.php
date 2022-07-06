<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "KUSASOFT";
    public $name;
    public $email;
    public $password;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$password){
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notificacion');
    }
}
