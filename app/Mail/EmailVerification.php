<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $notifiable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifiable)
    {
        $this->notifiable = $notifiable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.verify.user', [
            'url' => $this->verificationUrl(),
            'notifiable' => $this->notifiable,
        ])->subject('Please verify your email');
    }

    /**
     * Build the verification URL
     * 
     * @return URL
     */
    protected function verificationUrl()
    {
        /*  */
        return URL::temporarySignedRoute(
            /* route */
            'verification.verify',
            /* added expires */
            Carbon::now()->addMinutes(
                Config::get('auth.verification.expire', 60)
            ),
            [
                /* params in method get */
                'id' => $this->notifiable->getKey(),
                'hash' => sha1($this->notifiable->getEmailForVerification())
            ]
        );
    }
}
