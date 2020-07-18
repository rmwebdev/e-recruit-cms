<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmationAttending extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $candidate;
    public function __construct($candidate)
    {
        //
        $this->candidate = $candidate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('no-reply@puninar.com')->subject('Admin E-recruitment - Kehadiran Kandidat')
        ->markdown('emails.SendConfirmationAttending')
        ->with(
            [
                'requester_name' => $this->candidate['requester_name'],
                'name'=>$this->candidate['name'],
                'process'=>$this->candidate['process'],
            ]
        );
    }
}
