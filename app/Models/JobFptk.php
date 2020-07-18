<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class JobFptk extends Model
{
    //

    protected $table = 'e_recruit.tr_job_fptk';
    protected $primaryKey = 'job_fptk_id';
    public $timestamps = false;

    public function candidate()
    {
    	return $this->belongsTo(Candidate::class,'job_fptk_id','job_fptk_id');
    }    

    public function user()
    {
        return $this->hasOne(User::class,'username','requester_name');
    } 



    public function jobLog()
    {
    	return $this->hasMany(TrJobFptkLog::class,'request_job_number','request_job_number');
    }

    public static function source_data($year="",$division="",$requester_name="")
    { 
        $where = ['division'=>$division,'requester_name'=>$requester_name];
          $result =  DB::table('e_recruit.tr_candidate as a')
         ->select(DB::raw('count(*) as count_candidate'),'source')
         ->join('e_recruit.tr_job_fptk as b','a.job_fptk_id','=','b.job_fptk_id');
            if(!empty($division) && !empty($requester_name))   
            {
                $result = $result->where($where);    
            }
            else if(!empty($where['division']))
            {   

                $result = $result->where('division',$division);    
            }
            elseif (!empty($where['requester_name'])) 
            {
                $result = $result->where('requester_name',$requester_name);
            }    
        
         return $result->where('process','HIRED')
            ->where('result','PASSED')
            ->whereYear('received_date',$year)
            ->groupBy('source')->get();
    }

    public static function source_data_all($year="",$division="",$requester_name="")
    {
         $result = DB::table('e_recruit.tr_candidate as a')
         ->select(DB::raw('count(*) as count_candidate'),'source')
        ->join('e_recruit.tr_job_fptk as b','a.job_fptk_id','=','b.job_fptk_id');
        $where = ['division'=>$division,'requester_name'=>$requester_name];

       if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }    
    
 
        return $result->whereNotNull('source')
        ->groupBy('source')
        ->whereYear('received_date',$year)
        ->get();
    }

    // =================== fullfillment employee =======================

    public static function open($year,$division,$requester_name)
    {
        $result = JobFptk::where('is_closed','open');
         $result =$result->whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];


        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }    
        
        return $result->where('status','approved')->count();
    } 

    public static function closed($year="",$division="",$requester_name="")
    {

        $result = JobFptk::where('is_closed','closed');
        $result = $result->whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }    
        
        return $result->where('status','approved')->count();
    }    
    public static function drop($year="",$division="",$requester_name="")
    {
        $result = JobFptk::where('drop','yes');
         $result =$result->whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
           $result =  $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }    
        
        return $result->count();
    }    
    public static function rejected($year="",$division="",$requester_name="")
    {
        $result = JobFptk::where('status','rejected');
        $result = $result->whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }    
        
        return $result->count();
    }    


    // =================== fullfillment non employee =======================

    public static function new_non_employee($year="",$division="",$requester_name="",$subco="")
    {
        $result = JobFptk::query();
        $result = $result->where('type_fptk','outsource')->where('status','new')->where('delete_time',NULL)->where('is_closed',NULL);
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];


        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }
        elseif(!empty($subco))  
        {
            $result = $result->where($where2);
        }
        
        // return $result->where('status','open')->count();
        return $result->whereYear('required_date_fptk',$year)->count();
    }  

    public static function open_non_employee($year="",$division="",$requester_name="",$subco="")
    {
        $result = JobFptk::query();
        $result = $result->where('type_fptk','outsource')->where('status','open')->where('delete_time',NULL)->where('is_closed',NULL);
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];


        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }
        elseif(!empty($subco))  
        {
            $result = $result->where($where2);
        }
        
        // return $result->where('status','open')->count();
        return $result->whereYear('required_date_fptk',$year)->count();
    }    

    public static function draft_non_employee($year="",$division="",$requester_name="",$subco="")
    {
        $result = JobFptk::query();
        $result = $result->where('type_fptk','outsource')->where('status','draft')->where('delete_time',NULL)->where('is_closed',NULL);
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];


        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }
        elseif(!empty($subco))  
        {
            $result = $result->where($where2);
        }
        
        // return $result->where('status','open')->count();
        return $result->whereYear('required_date_fptk',$year)->count();
    }  

    public static function closed_non_employee($year="",$division="",$requester_name="",$subco="")
    {

        $result = JobFptk::where('is_closed','closed')->where('delete_time',NULL);
        $result =$result->where('type_fptk','outsource');
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        } 
        elseif(!empty($subco))  
        {
            $result = $result->where($where2);
        }  
        
        return $result->whereYear('required_date_fptk',$year)->count();

    }    
    
     public static function drop_non_employee($year="",$division="",$requester_name="",$subco="")
     {
         $result = JobFptk::where('status','drop');
         $result =$result->where('type_fptk','outsource');
         $where = ['division'=>$division,'requester_name'=>$requester_name];
         $where2 = ['subco'=>$subco];

         if(!empty($division) && !empty($requester_name))   
         {
            $result =  $result->where($where);    
         }
         else if(!empty($where['division']))
         {   

             $result = $result->where('division',$division);    
         }
         elseif (!empty($where['requester_name'])) 
         {
             $result = $result->where('requester_name',$requester_name);
         }   
         elseif(!empty($subco))  
         {
             $result = $result->where($where2);
         }  
        
         return $result->count();
     }    

    public static function rejected_non_employee($year="",$division="",$requester_name="",$subco="")
    {
        $result = JobFptk::where('status','rejected')->where('delete_time',NULL);
        $result =$result->where('type_fptk','outsource');
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }    
        elseif(!empty($subco))  
        {
            $result = $result->where($where2);
        } 
        
        return $result->whereYear('required_date_fptk',$year)->count();
    }    



    ///===================================  End Non employee     =================================

    public static function jenis_kelamin_hired($year="",$division="",$requester_name="")
    {
        $result =  DB::table('e_recruit.tr_candidate as a')
         ->leftjoin('e_recruit.tr_job_fptk as b','a.job_fptk_id','=','b.job_fptk_id')
        ->select(DB::raw('count(a.gender) as tot_gender,a.gender'))
         ->whereYear('received_date',$year);
         $where = ['division'=>$division,'requester_name'=>$requester_name];

            if(!empty($division) && !empty($requester_name))   
            {
                $result = $result->where($where);    
            }
            else if(!empty($where['division']))
            {   

                $result = $result->where('division',$division);    
            }
            elseif (!empty($where['requester_name'])) 
            {
                $result = $result->where('requester_name',$requester_name);
            }    
        
         return $result->where('process','HIRED')
            ->whereNotNull('a.gender')
            // ->where('result','HIRED')
            ->groupBy('a.gender')->get();
    }    
    public static function jenis_kelamin_all($year="",$division="",$requester_name="")
    {

         $result =  DB::table('e_recruit.tr_candidate as a')
         ->leftjoin('e_recruit.tr_job_fptk as b','a.job_fptk_id','=','b.job_fptk_id')
        ->select(DB::raw('count(a.gender) as tot_gender,a.gender'))
         ->whereYear('received_date',$year);
         $where = ['division'=>$division,'requester_name'=>$requester_name];

            if(!empty($division) && !empty($requester_name))   
            {
                $result = $result->where($where);    
            }
            else if(!empty($where['division']))
            {   

                $result = $result->where('division',$division);    
            }
            elseif (!empty($where['requester_name'])) 
            {
                $result = $result->where('requester_name',$requester_name);
            }    
        
         return $result->whereNotNull('a.gender')
            ->groupBy('a.gender')->get();  

    }    
    
	public static function universitas_hired($year="",$division="",$requester_name="")
    {
        $result =  DB::table('e_recruit.tr_candidate as a')
         ->leftjoin('e_recruit.tr_job_fptk as b','a.job_fptk_id','=','b.job_fptk_id')
        ->select(DB::raw('count(a.edu_university) as tot_university,a.edu_university'))
         ->whereYear('received_date',$year);
         $where = ['division'=>$division,'requester_name'=>$requester_name];

            if(!empty($division) && !empty($requester_name))   
            {
               $result =  $result->where($where);    
            }
            else if(!empty($where['division']))
            {   

                $result = $result->where('division',$division);    
            }
            elseif (!empty($where['requester_name'])) 
            {
                $result = $result->where('requester_name',$requester_name);
            }    
        
         return $result->whereNotNull('a.edu_university')
            ->where('process','HIRED')
            ->groupBy('a.edu_university')->get();  

    }    
    
    public static function universitas_all($year="",$division="",$requester_name="")
    {
        $result =  DB::table('e_recruit.tr_candidate as a')
         ->leftjoin('e_recruit.tr_job_fptk as b','a.job_fptk_id','=','b.job_fptk_id')
        ->select(DB::raw('count(a.edu_university) as tot_university,a.edu_university'))
         ->whereYear('received_date',$year);
         $where = ['division'=>$division,'requester_name'=>$requester_name];

            if(!empty($division) && !empty($requester_name))   
            {
                $result = $result->where($where);    
            }
            else if(!empty($where['division']))
            {   

                $result = $result->where('division',$division);    
            }
            elseif (!empty($where['requester_name'])) 
            {
                $result = $result->where('requester_name',$requester_name);
            }    
        
         return $result->groupBy('a.edu_university')
            ->orderBy('tot_university','desc')
            ->take(30)
            ->get(); 

    }



    public static function position_name_hired($year="",$division="",$requester_name="")
    {

        $result = JobFptk::with('candidate')
                ->whereHas('candidate', function ($query){
                    $query->where('process','=','HIRED');
                })
                ->select(DB::raw('count(position_name) as tot_position_name,position_name'))
                ->whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }  
        return $result->groupBy('position_name')
        ->take(30)
        ->get();
    }    
    public static function position_name_all($year="",$division="",$requester_name="")
    {
        $result = JobFptk::with('candidate')
                    ->select(DB::raw('count(position_name) as tot_position_name,position_name'))
                    ->whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result =  $result->where('requester_name',$requester_name);
        }  
         return $result->groupBy('position_name')
        ->take(30)
        ->get();
    }    
    public static function reason_hiring_hired($year="",$division="",$requester_name="")
    {

         $result =  JobFptk::with('candidate')
                ->whereHas('candidate', function ($query){
                    $query->where('process','=','HIRED');
                })
                ->select(DB::raw('count(request_reason) as tot_request_reason,request_reason'))
                ->whereYear('received_date_fptk',$year);
                $where = ['division'=>$division,'requester_name'=>$requester_name];

            if(!empty($division) && !empty($requester_name))   
            {
               $result =  $result->where($where);    
            }
            else if(!empty($where['division']))
            {   

                $result = $result->where('division',$division);    
            }
            elseif (!empty($where['requester_name'])) 
            {
                $result = $result->where('requester_name',$requester_name);
            }  

            return $result->groupBy('request_reason')->get();
    }    
    public static function reason_hiring_all($year="",$division="",$requester_name="")
    {
         $result =  JobFptk::with('candidate')
                ->select(DB::raw('count(request_reason) as tot_request_reason,request_reason'))
                ->whereYear('received_date_fptk',$year);
                $where = ['division'=>$division,'requester_name'=>$requester_name];

            if(!empty($division) && !empty($requester_name))   
            {
                $result = $result->where($where);    
            }
            else if(!empty($where['division']))
            {   

                $result = $result->where('division',$division);    
            }
            elseif (!empty($where['requester_name'])) 
            {
                $result = $result->where('requester_name',$requester_name);
            }  

            return $result->groupBy('request_reason')->get();
    }    
    public static function division_hired($year="",$division="",$requester_name="")
    {
        $result =  JobFptk::with('candidate')
                ->whereHas('candidate', function ($query){
                    $query->where('process','=','HIRED');
                })
                ->select(DB::raw('count(division) as tot_division,division'))
                ->whereYear('received_date_fptk',$year);
                $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
           $result =  $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
           $result =  $result->where('requester_name',$requester_name);
        }  

        return $result->groupBy('division')->take(30)->get();

    }    
    public static function division_all($year="",$division="",$requester_name="")
    {
        $result =  JobFptk::with('candidate')
                ->select(DB::raw('count(division) as tot_division,division'))
                ->whereYear('received_date_fptk',$year);
                $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result =  $result->where('requester_name',$requester_name);
        }  

        return $result->groupBy('division')->take(30)->get();
    }    
    public static function requester_name_hired($year="",$division="",$requester_name="")
    {
        $result =  JobFptk::with('candidate')
                ->whereHas('candidate', function ($query){
                    $query->where('process','=','HIRED');
                })
                ->select(DB::raw('count(requester_name) as tot_requester_name,requester_name'))
                ->whereYear('received_date_fptk',$year)
                ->whereNotNull('requester_name');
                $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        }  

        return $result->groupBy('requester_name')->take(30)->get();
    }    
    public static function requester_name_all($year="",$division="",$requester_name="")
    {

        $result =  JobFptk::with('candidate')
                ->select(DB::raw('count(requester_name) as tot_requester_name,requester_name'))
                ->whereYear('received_date_fptk',$year)
                ->whereNotNull('requester_name');
                $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result =  $result->where('requester_name',$requester_name);
        }  

        return $result->groupBy('requester_name')->take(30)->get();
    }       
    public static function work_location_hired($year="",$division="",$requester_name="")
    {

        $result =  JobFptk::with('candidate')
                ->whereHas('candidate', function ($query){
                    $query->where('process','=','HIRED');
                })
                ->select(DB::raw('count(work_location) as tot_work_location,work_location'))
                ->whereYear('received_date_fptk',$year);
                $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
           $result =  $result->where('requester_name',$requester_name);
        }  

        return $result->groupBy('work_location')->get();

    }    
    public static function work_location_all($year="",$division="",$requester_name="")
    {

         $result =  JobFptk::with('candidate')
                ->select(DB::raw('count(work_location) as tot_work_location,work_location'))
                ->whereYear('received_date_fptk',$year);
                $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result =  $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result =  $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result =  $result->where('requester_name',$requester_name);
        }  

        return $result->groupBy('work_location')->get();
    }    
   
   public static function job_open($year="",$division="",$requester_name="")
   {

        $actual_staff =  JobFptk::whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            
            $actual_staff = $actual_staff->where($where);    
            // return '1';
        }
        else if(!empty($where['division']))
        {  
            $actual_staff = $actual_staff->where('division',$division);    
            // return '2';
        }
        elseif (!empty($where['requester_name'])) 
        {
            $actual_staff = $actual_staff->where('requester_name',$requester_name);
            // return '3';
        }  



        $hired =  JobFptk::whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
              $hired = $hired->where($where);    
        }
        else if(!empty($where['division']))
        {   

              $hired = $hired->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
              $hired =  $hired->where('requester_name',$requester_name);
        }  

        $dd = $actual_staff->sum('actual_staff');
        $dd2 = $hired->sum('hired');
        return $dd - $dd2;
   }


    public static function job_drop($year="",$division="",$requester_name="")
   {

        $requested_staff =  JobFptk::whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
           $requested_staff =  $requested_staff->where($where);    
        }
        else if(!empty($where['division']))
        {   

           $requested_staff =  $requested_staff->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $requested_staff =  $requested_staff->where('requester_name',$requester_name);
        }  

        $actual_staff =  JobFptk::whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $actual_staff = $actual_staff->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $actual_staff = $actual_staff->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $actual_staff = $actual_staff->where('requester_name',$requester_name);
        }  


        $dd = $requested_staff->sum('requested_staff');
        $dd2 = $actual_staff->sum('actual_staff');
        return $dd - $dd2;
   }

   public static function closed_staff($year="",$division="",$requester_name="")
   {
        $result = JobFptk::whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result =  $result->where('requester_name',$requester_name);
        } 

        return $result->sum('hired');
   }


   public static function total_request_rejected($year="",$division="",$requester_name="")
   {
        $result = JobFptk::where('status','rejected')->whereYear('received_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        } 

        return $result->sum('requested_staff');
   }


   //============================== Non Employee ===========================

   public static function job_new_non_employee($year="",$division="",$requester_name="",$subco="")
   {
        $actual_staff =  JobFptk::where('type_fptk','outsource')->where('status','new');
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];

        if(!empty($division) && !empty($requester_name))   
        {
            $actual_staff = $actual_staff->where($where);    
            // return '1';
        }
        else if(!empty($where['division']))
        {  
            $actual_staff = $actual_staff->where('division',$division);    
            // return '2';
        }
        elseif (!empty($where['requester_name'])) 
        {
            $actual_staff = $actual_staff->where('requester_name',$requester_name);
            // return '3';
        }  
        elseif(!empty($subco))  
        {
            $actual_staff = $actual_staff->where($where2);
        }


        $hired =  JobFptk::where('type_fptk','outsource')->whereYear('required_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
              $hired = $hired->where($where);    
        }
        else if(!empty($where['division']))
        {   

              $hired = $hired->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
              $hired =  $hired->where('requester_name',$requester_name);
        } 
        elseif(!empty($subco))  
        {
            $hired = $hired->where($where2);
        } 

        $dd = $actual_staff->sum('actual_staff');
        $dd2 = $hired->sum('hired');
        return $dd - $dd2;
    }

   public static function job_open_non_employee($year="",$division="",$requester_name="",$subco="")
   {
        $actual_staff =  JobFptk::where('type_fptk','outsource')->where('status','open')->where('delete_time',NULL)->where('is_closed',NULL);
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];

        if(!empty($division) && !empty($requester_name))   
        {
            $actual_staff = $actual_staff->where($where);    
            // return '1';
        }
        else if(!empty($where['division']))
        {  
            $actual_staff = $actual_staff->where('division',$division);    
            // return '2';
        }
        elseif (!empty($where['requester_name'])) 
        {
            $actual_staff = $actual_staff->where('requester_name',$requester_name);
            // return '3';
        }  
        elseif(!empty($subco))  
        {
            $actual_staff = $actual_staff->where($where2);
        }


        $hired =  JobFptk::where('type_fptk','outsource')->where('status','open')->where('delete_time',NULL)->where('is_closed',NULL)->whereYear('required_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
              $hired = $hired->where($where);    
        }
        else if(!empty($where['division']))
        {   

              $hired = $hired->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
              $hired =  $hired->where('requester_name',$requester_name);
        } 
        elseif(!empty($subco))  
        {
            $hired = $hired->where($where2);
        } 

        $dd = $actual_staff->sum('actual_staff');
        $dd2 = $hired->sum('hired');
        return $dd - $dd2;
    }


    public static function job_drop_non_employee($year="",$division="",$requester_name="",$subco="")
    {
        $requested_staff =  JobFptk::where('type_fptk','outsource')->where('delete_time',NULL)->where('is_closed',NULL);
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];

        if(!empty($division) && !empty($requester_name))   
        {
           $requested_staff =  $requested_staff->where($where);    
        }
        else if(!empty($where['division']))
        {   
            $requested_staff =  $requested_staff->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $requested_staff =  $requested_staff->where('requester_name',$requester_name);
        }  
        elseif(!empty($subco))  
        {
            $requested_staff = $requested_staff->where($where2);
        }



        $actual_staff =  JobFptk::where('type_fptk','outsource')->whereYear('required_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];

        if(!empty($division) && !empty($requester_name))   
        {
            $actual_staff = $actual_staff->where($where);    
        }
        else if(!empty($where['division']))
        {   
            $actual_staff = $actual_staff->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $actual_staff = $actual_staff->where('requester_name',$requester_name);
        }  
        elseif(!empty($subco))  
        {
            $actual_staff = $actual_staff->where($where2);
        }


        $dd = $requested_staff->sum('requested_staff');
        $dd2 = $actual_staff->sum('actual_staff');
        return $dd - $dd2;
   }

    public static function closed_staff_non_employee($year="",$division="",$requester_name="",$subco="")
    {
        $result = JobFptk::where('type_fptk','outsource')->where('status', 'open')->where('delete_time',NULL)->whereNotNull('is_closed');
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   
            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result =  $result->where('requester_name',$requester_name);
        } 
        elseif(!empty($subco))  
        {
            $result = $result->where($where2);
        }

        return $result->sum('hired');
    }

    public static function job_closed_man_power($year="",$division="",$requester_name="",$subco="")
    {
        $result_manPower = JobFptk::where('type_fptk','outsource')->where('status', 'open')->where('delete_time',NULL)->whereNotNull('is_closed');
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];

        if(!empty($division) && !empty($requester_name))   
        {
            $result_manPower = $result_manPower->where($where);    
        }
        else if(!empty($where['division']))
        {   
            $result_manPower = $result_manPower->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result_manPower =  $result_manPower->where('requester_name',$requester_name);
        } 
        elseif(!empty($subco))  
        {
            $result_manPower = $result_manPower->where($where2);
        }

        return $result_manPower->sum('hired');
    }


   public static function total_request_rejected_non_employee($year="",$division="",$requester_name="",$subco="")
   {
        $result = JobFptk::where('status','rejected')->where('type_fptk','outsource')->where('delete_time',NULL)->where('is_closed',NULL)->whereYear('required_date_fptk',$year);
        $where = ['division'=>$division,'requester_name'=>$requester_name];
        $where2 = ['subco'=>$subco];

        if(!empty($division) && !empty($requester_name))   
        {
            $result = $result->where($where);    
        }
        else if(!empty($where['division']))
        {   

            $result = $result->where('division',$division);    
        }
        elseif (!empty($where['requester_name'])) 
        {
            $result = $result->where('requester_name',$requester_name);
        } 
        elseif(!empty($subco))  
        {
            $result = $result->where($where2);
        }

        return $result->sum('requested_staff');
   }


   //Tambahan untuk dashboard non Employee Dendy
    public static function project_name_non_employee($year="",$subco="")
    { 
        $where = ['subco'=>$subco];
        $result =  DB::table('e_recruit.tr_job_fptk')
        ->select(DB::raw('count (project_name) as jumlah,project_name '))
		->whereYear('required_date_fptk',$year);

        if(!empty($subco))   
        {
            $result = $result
                    ->where($where);    
        } 
        elseif($subco == '')
        {
            $result = $result
                    ->where('type_fptk','outsource')
                    ->groupBy('project_name');
        }

        return $result
        ->where('type_fptk','outsource')
        ->groupBy('project_name')
        ->get();  
    }

    public static function position_non_employee($year="",$subco="")
    { 
        $where = ['subco'=>$subco];
        $result =  DB::table('e_recruit.tr_job_fptk')
        ->select(DB::raw('count (position_name) as jumlah,position_name '))
		->whereYear('required_date_fptk',$year);;

        if(!empty($subco))   
        {
            $result = $result
                    ->where($where);    
        } 
        elseif($subco == '')
        {
            $result = $result
                    ->where('type_fptk','outsource')
                    ->groupBy('position_name');
        }

        return $result
        ->where('type_fptk','outsource')
        ->groupBy('position_name')
        ->get();  
    }

    public static function requester_non_employee($year="",$subco="")
    { 
        $where = ['subco'=>$subco];
        $result =  DB::table('e_recruit.tr_job_fptk as a')
        ->select(DB::raw('count (requester_name) as jumlah, a.requester_name, b.name'))
        ->join('e_recruit.tr_users as b', 'a.requester_name','b.nip')
		->whereYear('required_date_fptk',$year);;

        if(!empty($subco))   
        {
            $result = $result
                    ->where($where);    
        } 
        elseif($subco == '')
        {
            $result = $result
                    ->where('type_fptk','outsource')
                    ->groupBy('a.requester_name','b.name');
        }

        return $result
        ->where('type_fptk','outsource')
        ->groupBy('a.requester_name','b.name')
        ->get();  
    }

    public static function division_non_employee($year="",$subco="")
    { 
        $where = ['subco'=>$subco];
        $result =  DB::table('e_recruit.tr_job_fptk')
        ->select(DB::raw('count (division) as jumlah,division '))
		->whereYear('required_date_fptk',$year);;

        if(!empty($subco))   
        {
            $result = $result
                    ->where($where);    
        } 
        elseif($subco == '')  
        {
            $result = $result
                    ->where('type_fptk','outsource')
                    ->groupBy('division');
        }

        return $result
        ->where('type_fptk','outsource')
        ->groupBy('division')
        ->get();   
    }

    public static function cost_center_non_employee($year="",$subco="")
    { 
        $where = ['subco'=>$subco];
        $result =  DB::table('e_recruit.tr_job_fptk')
        ->select(DB::raw('count (cost_center) as jumlah,cost_center'))
		->whereYear('required_date_fptk',$year);;

        if(!empty($subco))   
        {
            $result = $result
                    ->where($where);    
        } 
        elseif($subco == '')
        {
            $result = $result
                    ->where('type_fptk','outsource')
                    ->groupBy('cost_center');
        }

        return $result
        ->where('type_fptk','outsource')
        ->groupBy('cost_center')
        ->get();   
    }

    public static function pt_os_non_employee($year="",$subco="")
    { 
        $where = ['subco'=>$subco];
        $result =  DB::table('e_recruit.tr_job_fptk as a')
        ->select(DB::raw('count (company_name) as count_company_name, b.company_name'))
        ->join('e_recruit.tr_candidate as b', 'a.job_fptk_id','b.job_fptk_id')
		->whereYear('required_date_fptk',$year);;

        if(!empty($subco))   
        {
            $result = $result
                    ->where(['a.subco'=>$subco]);    
        } 
        elseif($subco == '')
        {
            $result = $result
                    ->where('type_fptk','outsource')
                    ->groupBy('b.company_name');
        }

        return $result
        ->where('type_fptk','outsource')
        ->groupBy('b.company_name')
        ->get();   
    }

    public static function work_location_non_employee($year="",$subco="")
    { 
        $where = ['subco'=>$subco];
        $result =  DB::table('e_recruit.tr_job_fptk')
        ->select(DB::raw('count (work_location) as jumlah,work_location'))
		->whereYear('required_date_fptk',$year);;

        if(!empty($subco))   
        {
            $result = $result
                    ->where($where);    
        } 
        elseif($subco == '')
        {
            $result = $result
                    ->where('type_fptk','outsource')
                    ->groupBy('work_location');
        }

        return $result
        ->where('type_fptk','outsource')
        ->groupBy('work_location')
        ->get();   
    }
}