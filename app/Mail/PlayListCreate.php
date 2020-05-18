<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlayListCreate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $playList;
    public function __construct($playList)
    {
        $this->playList = $playList;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Create New Play List')
            ->with([
                'greeting' => 'Congratulations!',
                'body' => "Your have created a new Play List is:" . $this->playList->name . ", you can added any video in the Play List.",
            ])
            ->markdown('emails.email_sample_1');
    }
}
