<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrHistoryProcess extends Model
{
    //
    protected $table = 'e_recruit.tr_history_process';
    protected $primaryKey = 'history_process_id';
    public $timestamps = false;


    public function candidate()
    {
    	return $this->belongsTo(Candidate::class,'candidate_id');
    }


    public function job_fptk()
    {
    	return $this->hasManyThrough(TrHistoryProcess::class,Candidate::class,'candidate_id','job_fptk_id');
    }
    
}
