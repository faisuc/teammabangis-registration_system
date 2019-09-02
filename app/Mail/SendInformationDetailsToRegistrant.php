<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInformationDetailsToRegistrant extends Mailable
{
    use Queueable, SerializesModels;

    public $personalInformation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($personalInformation)
    {
        $this->personalInformation = $personalInformation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Registrant Information')->markdown('mail.send-information-details-to-registrant');
    }
}
