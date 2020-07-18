<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tm_candidate_submission extends Model
{
    protected $table = 'e_recruit.tm_candidate_submission';
    protected $primaryKey = 'candidate_submission_id';
    public $timestamps = false;
}
