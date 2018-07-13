<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterSuccessfully extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @param $email Email of new user
     * @param $password Random password
     *
     * @return void
     */
    public function __construct($email, $password)
    {
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
        return $this->markdown('emails.register.successfully')
                    ->with([
                        'email' => $this->email,
                        'password' => $this->password,
                    ]);;
    }
}
