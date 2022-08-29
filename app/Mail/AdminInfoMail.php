<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminInfoMail extends Mailable 
{
    use Queueable, SerializesModels;


    public $admin;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin,$password)
    {
        //
        $this->admin = $admin;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.admin',[
            'admin' => $this->admin,
            'password' => $this->password
        ]);
    }
}
