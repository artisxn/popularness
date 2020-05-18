<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VideoUploaded extends Mailable implements ShouldQueue
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
            ->subject('New video uploaded')
            ->with([
                'greeting' => 'Congratulations!',
                'body' => "Your have uploaded a new video with title of : " . $this->video->title . ", you can publish/un-publish/delete and necessary action from your video panel.",
            ])
            ->markdown('emails.email_sample_1');
    }
}
