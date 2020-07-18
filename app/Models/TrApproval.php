<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrApproval extends Model
{
    //
    protected $table = 'e_recruit.tr_approval';
    protected $primaryKey = 'approval_id';

    public function user()
    {
    	return $this->hasOne(User::class,'user_id','user_id');
    }

    public function fptk()
    {
    	return $this->hasOne(JobFptk::class,'job_fptk_id','job_fptk_id');
    }

}
