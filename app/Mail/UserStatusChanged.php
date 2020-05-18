<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserStatusChanged extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $greeting = 'Congratulations!';

        $statusMessage = "Activated, now you can all perform all operation based on your type and package";

        if ($this->user->staus == 0) {
            $greeting = 'Hello!';
            $statusMessage = "In Activated, contact with support team for activate your account";
        } elseif ($this->user->staus == 2) {
            $greeting = 'Hello!';
            $statusMessage = "suspended, you can't access all operation properly, you may contact with support team";
        }

        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Popularness Account Status')
            ->with([
                'greeting' => $greeting,
                'body' => "Your account has been " . $statusMessage,
            ])
            ->markdown('emails.email_sample_1');
    }
}
