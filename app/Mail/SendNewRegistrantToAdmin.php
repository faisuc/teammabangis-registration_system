<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewRegistrantToAdmin extends Mailable
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
        return $this->subject('New Registrant')->markdown('mail.send-new-registrant-to-admin');
    }
}
