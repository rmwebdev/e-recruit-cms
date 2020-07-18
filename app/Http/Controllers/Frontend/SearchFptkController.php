<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Candidate;
use App\Models\JobFptk;
use App\Models\User;
use App\Models\TrJobFptkLog;
use App\Models\TrHistoryProcess;
use App\Models\Parameters;
use Auth;
use Validator;
use DB;

class SearchFptkController extends Controller
{
    //
    public function searchFPTK(Request $request)
    {

       return redirect('rec-process');
    	$param = $request->searchFPTK;
        $JobFptk = JobFptk::where('request_job_number','ilike','%'.$param.'%')->first();

        $job_fptk_id = (empty($JobFptk)) ? 0 : $JobFptk->job_fptk_id;

    	
        $data['status'] = Parameters::status()->get();
        $data['result'] = Parameters::result()->get();
        $data['cv_in'] = Candidate::where('process','CV IN')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['cv_sort'] = Candidate::where('process','CV SORT')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['called'] = Candidate::where('process','CALLED')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['psychotest'] = Candidate::where('process','PSYCHOTEST')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['initial_in'] = Candidate::where('process','INITIAL INTERVIEW')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['send_to_user'] = Candidate::where('process','SEND TO USER')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['med_check'] = Candidate::where('process','MED CHECK')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['intervew_1'] = Candidate::where('process','INTERVIEW 1')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['intervew_2'] = Candidate::where('process','INTERVIEW 2')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['intervew_3'] = Candidate::where('process','INTERVIEW 3')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['int_user'] = Candidate::where('process','INTERVIEW 1')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['offering_letter'] = Candidate::where('process','MED CHECK & OFFERING LETTER')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
        $data['sort_list'] = Candidate::where('result','CONSIDER')->where('job_fptk_id',$job_fptk_id)->count();
        $data['history'] = TrHistoryProcess::where('history_confirmation','true')->count();
        $data['hired'] = Candidate::where('process','HIRED')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$job_fptk_id)->count();
    	return view('frontend.search_user_fptk',$data);
    }



    public function getData(Request $request)
    {
        return redirect('rec-process');

        $param = $request->dataSearch;
        $data =  Candidate::with('job_fptk')
                ->whereHas('job_fptk', function ($query) use ($param){
                $query->where('request_job_number','ilike','%'.$param.'%');})->get();


        return Datatables::of($data)
        ->editColumn('job_fptk_id',function($data){
            return strtoupper($data->job_fptk->position_name);
        })->editColumn('invitation_process',function($data){
            $invitation_process = (empty($data->invitation_process)) ? "":strtoupper($data->invitation_process); 
            return $invitation_process;
        })->editColumn('process',function($data){
            $process='';
            if (!empty($data->process))
            {
                if($data->process == 'CALLED')
                {
                    $process = 'INVITED';
                }
                else
                {
                    $process = $data->process;
                }
            }
            return $process;  
        })
        ->make(true);
    }



    public function getDataWithStatus(Request $request)
    {
        return redirect('rec-process');
        $stat = $request->status;
        $param = $request->dataSearch;
        if($stat == 'CONSIDER')
        {
            $data =  Candidate::with('job_fptk')
                ->whereHas('job_fptk', function ($query) use ($param){
                $query->where('request_job_number','ilike','%'.$param.'%');})
                ->where('result','CONSIDER')
                ->get();
        } 
        else
        {
            $data =  Candidate::with('job_fptk')
                ->whereHas('job_fptk', function ($query) use ($param){
                $query->where('request_job_number','ilike','%'.$param.'%');})
                ->where('process',$stat)
                ->get();
        }
        return Datatables::of($data)
        ->editColumn('job_fptk_id',function($data){
            $position_name = (empty($data->job_fptk->position_name)) ? "":strtoupper($data->job_fptk->position_name); 
            return $position_name;
        })->editColumn('invitation_process',function($data){
            $invitation_process = (empty($data->invitation_process)) ? "":strtoupper($data->invitation_process); 
            return $invitation_process;
        })->editColumn('process',function($data){
            $process='';
            if (!empty($data->process))
            {
                if($data->process == 'CALLED')
                {
                    $process = 'INVITED';
                }
                else
                {
                    $process = $data->process;
                }
            }
            return $process;  
        })
        ->make(true);
    }

}
