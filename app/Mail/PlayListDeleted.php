<?php

namespace App\Mail;

use App\UserPlayList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlayListDeleted extends Mailable implements ShouldQueue
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
            ->subject('Play List Deleted!')
            ->with([
                'greeting' => 'Successfully Play List Deleted!',
                'body' => "Your have successfully deleted the play list is : " . $this->playList->name,
            ])
            ->markdown('emails.email_sample_1');
    }
}
