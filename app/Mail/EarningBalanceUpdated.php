<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EarningBalanceUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $amount = 0;
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Video Earning deposit to your Earning Balance')
            ->with([
                'greeting' => 'Deposit to Earning Balance',
                'body' => "Successfully added : $" . $this->amount . ",  with your Earning amount, you can check your balance and contact with support center of " . env('APP_NAME') . " if you have any queries"
            ])
            ->markdown('emails.email_sample_1');
    }
}
