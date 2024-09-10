<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingChangeDate extends Mailable
{
    use Queueable, SerializesModels;

    public $ebooking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ebooking)
    {
        $this->ebooking = $ebooking;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Penukaran Tempahan Bilik Mesyuarat')
                    ->view('emails.booking_aproval')
                    ->with([
                        'ebooking' => $this->ebooking,
                    ]);
    }
}
