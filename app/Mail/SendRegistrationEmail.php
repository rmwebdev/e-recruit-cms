<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistrationEmail extends Mailable
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
        return $this->from('no-reply@puninar.com')->subject('Admin E-recruitment - Account Activation')
        ->markdown('emails.SendRegistrationEmail')
        ->with(['candidate' => $this->candidate['candidate'],'password'=>$this->candidate['password'],'candidate_id'=>$this->candidate['candidate_id']]);
    }
}
