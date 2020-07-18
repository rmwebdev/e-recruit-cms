<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailFailedProcess extends Mailable
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
        return $this->from('no-reply@puninar.com')->subject('Admin E-recruitment - Recruitment Announcement')
        ->markdown('emails.SendEmailFailed')
        ->with(
            [
                'name_holder' => $this->candidate['name_holder'],
                'requester_email'=>$this->candidate['requester_email'],
                'request_job_number'=>$this->candidate['request_job_number'],
                'process'=>$this->candidate['process'],
                'requester_name'=>$this->candidate['requester_name'],
                'required_date_fptk'=>$this->candidate['required_date_fptk'],
                'email_candidate' => $this->candidate['email_candidate'],
                'position_name'=>$this->candidate['position_name'],
                'result'=>$this->candidate['result'],
            ]
        );
    }
}
