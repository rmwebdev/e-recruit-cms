<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    //

    protected  $table = 'e_recruit.tr_candidate';
    protected $primaryKey = 'candidate_id';
    protected $guarded = []; 
	public $timestamps = false;


	public function assessment()
	{
		return $this->hasMany(TRAssessment::class,'candidate_id');
	}


	public function history()
	{
		return $this->belongsTo(TrHistoryProcess::class,'candidate_id','candidate_id');
	}


	public function job_fptk()
	{
		return $this->belongsTo(JobFptk::class,'job_fptk_id','job_fptk_id');
	}


}
