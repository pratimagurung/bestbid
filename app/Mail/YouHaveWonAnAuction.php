<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class YouHaveWonAnAuction extends Mailable
{
    use Queueable, SerializesModels;

    public $message, $auction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $auction)
    {
        $this->message = $message;
        $this->auction = $auction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auctionwon');
    }
}
