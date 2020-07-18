<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TRAssessment extends Model
{
    //
    protected $table = 'e_recruit.tr_assessment';
    protected $primaryKey = 'asses_answer_id';

    public function candidate()
    {
    	return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
