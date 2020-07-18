<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrJobFptkLog extends Model
{
    //
    protected $table = 'e_recruit.tr_job_fptk_log';
    public $timestamps = false;

    public function jobFptk()
    {
    	return $this->belongsTo(JobFptk::class,'request_job_number','request_job_number');
    }
}
