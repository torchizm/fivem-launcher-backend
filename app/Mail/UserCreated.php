<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The temporary password.
     *
     * @var String
     */
    protected $userPassword;

    /**
     * The login url.
     *
     * @var String
     */
    protected $loginUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userPassword, $loginUrl)
    {
        $this->userPassword = $userPassword;
        $this->loginUrl = $loginUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.userCreated')->with([
            'password' => $this->userPassword,
            'url' => $this->loginUrl,
            ]);
    }
}
