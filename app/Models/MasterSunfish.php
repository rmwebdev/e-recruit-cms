<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MasterSunfish extends Model
{
    //

    public static function family()
    {
         return DB::table('e_recruit.tm_family')->select('id','name')->get();
    }

    public static function religion()
    {
         return DB::table('e_recruit.tm_religion')->select('id','name')->get();
    } 

    public static function occupation()
    {
         return DB::table('e_recruit.tm_occupation')->select('id','name')->get();
    }   

    public static function education()
    {
         return DB::table('e_recruit.tm_education')
         ->select('id','name')
         ->where('delete_time',NULL)
         ->orderBy('id','asc')
         ->get();
    }

    public static function major()
    {
         return DB::table('e_recruit.tm_major2')->select('id','name')->orderBy('id','asc')->get();
    }

    public static function list_school()
    {
         return DB::table('e_recruit.tm_list_school')->select('id','name')->orderBy('name','asc')->get();
    }

    public static function language()
    {
         return DB::table('e_recruit.tm_language')->select('id','name')->get();
    }


    public static function state()
    {
         return DB::table('e_recruit.tm_state')->select('id','name')->get();
    }

    public static function city()
    {
         return DB::table('e_recruit.tm_city')->select('id','name')->get();
    }

    public static function skill()
    {
         return DB::table('e_recruit.tm_skill')->select('id','name')->get();
    }

    public static function resign_cause()
    {
         return DB::table('e_recruit.tm_resign_cause')->select('id','name')->get();
    }    

    public static function point()
    {
         return DB::table('e_recruit.tm_resign_cause')->select('id','name')->get();
    }

    public static function getListSchool($param)
    {
        $getListSchool = DB::table('e_recruit.tm_list_school')->where('name','like','%'.ucfirst($param).'%')->get();
        $institution;
        if($getListSchool->isEmpty())
        {
            $institution =  'Other';
        }
        else
        {
            $institution =  $param;
        }

        return $institution;
    }


}
