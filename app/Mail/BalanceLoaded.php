<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BalanceLoaded extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $chargesAmount = 0;
    public function __construct($chargesAmount)
    {
        $this->chargesAmount = $chargesAmount;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Balance Loaded Successfully')
            ->with([
                'greeting' => 'Success!',
                'body' => "Successfully added : $" . $this->chargesAmount . ",  to your account, you can check your balance and contact with support center of " . env('APP_NAME') . " if you have any queries"
            ])
            ->markdown('emails.email_sample_1');
    }
}
