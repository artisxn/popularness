<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DepositBalanceDeducted extends Mailable implements ShouldQueue
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
            ->subject('Video donation successfully done')
            ->with([
                'greeting' => 'Deducted donated amount from Deposit Balance',
                'body' => "Successfully deducted : $" . $this->amount . ",  from your Deposit balance, you can check your balance and contact with support center of " . env('APP_NAME') . " if you have any queries"
            ])
            ->markdown('emails.email_sample_1');
    }
}
