<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailToCandidate extends Mailable
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
       
        return $this->from('no-reply@puninar.com')->subject('Admin E-recruitment - Call Interview')->markdown('emails.sendEmailToCandidate')->with([
                        'candidate' => $this->candidate['candidate'],
                        'address' => $this->candidate['address'],
                        'job' => $this->candidate['job'],
                        'interview_process' => $this->candidate['interview_process'],
                        'date_process' => $this->candidate['date_process'],
                        'time_process'=>$this->candidate['time_process'],
                        'candidate_id'=>$this->candidate['candidate_id'],
                        'ktp_no'=>$this->candidate['ktp_no'],
                        'msg'=>$this->candidate['msg']
                    ]);
    }
}
