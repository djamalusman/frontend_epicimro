<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }


    public function build()
    {
        return $this->subject('Registrasi Berhasil')
                    ->view('template2.viewsendforgotpassword')
                    ->with([
                        'user' => $this->user,
                        'token' => $this->token
                    ]);
    }
}
