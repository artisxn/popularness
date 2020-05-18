<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VideoDeleted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $video;
    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Video Removed')
            ->with([
                'greeting' => 'Delete!',
                'body' => "Your video title of : " . $this->video->title . ",  has been removed, you can contact with support center of " . env('APP_NAME') . " if you have any queries"
            ])
            ->markdown('emails.email_sample_1');
    }
}
