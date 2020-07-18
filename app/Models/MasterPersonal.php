<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MasterPersonal extends Model
{
    //

    public static function family($candidate_id)
    {
         return DB::table('e_recruit.tr_family')->where('candidate_id',$candidate_id)->count();
    }


    public static function emergency_contact($candidate_id)
    {
         return DB::table('e_recruit.tr_emergency_contact')->where('candidate_id',$candidate_id)->count();
    }


    public static function education_background($candidate_id)
    {
         return DB::table('e_recruit.tr_education_background')->where('candidate_id',$candidate_id)->count();
    }  

    public static function course_information($candidate_id)
    {
         return DB::table('e_recruit.tr_course_information')->where('candidate_id',$candidate_id)->count();
    }

    public static function skill($candidate_id)
    {
         return DB::table('e_recruit.tr_skill')->where('candidate_id',$candidate_id)->count();
    }

    public static function language_skill($candidate_id)
    {
         return DB::table('e_recruit.tr_language_skill')->where('candidate_id',$candidate_id)->count();
    }

    public static function org_information($candidate_id)
    {
         return DB::table('e_recruit.tr_org_information')->where('candidate_id',$candidate_id)->count();
    }

    public static function job_experience($candidate_id)
    {
         return DB::table('e_recruit.tr_job_experience')->where('candidate_id',$candidate_id)->count();
    }

    public static function job_interest($candidate_id)
    {
         return DB::table('e_recruit.tr_job_interest')->where('candidate_id',$candidate_id)->count();
    }
}
