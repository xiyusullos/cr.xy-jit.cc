<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationEmail extends Mailable
{
    // use Queueable, SerializesModels;

    public $userName;
    public $verifyCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $verifyCode)
    {
        $this->userName = $userName;
        $this->verifyCode = $verifyCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registration')
            ->with([
                'userName' => $this->userName,
                'verifyCode' => $this->verifyCode,
            ]);
    }
}
