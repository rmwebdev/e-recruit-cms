<?php

namespace App\Http\Controllers\Backend;

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
        $JobFptk = JobFptk::where('request_job_number',$param)->first();

        $job_fptk_id = (empty($JobFptk)) ? 0 : $JobFptk->job_fptk_id;
        

    	$data['status'] = Parameters::status()->get();
        $data['result'] = Parameters::result()->get();
        $data['cv_in'] = Candidate::where('process','CV IN')->where('job_fptk_id',$job_fptk_id)->count();
        $data['cv_sort'] = Candidate::where('process','CV SORT')->where('job_fptk_id',$job_fptk_id)->count();
        $data['called'] = Candidate::where('process','CALLED')->where('job_fptk_id',$job_fptk_id)->count();
        $data['psychotest'] = Candidate::where('process','PSYCHOTEST')->where('job_fptk_id',$job_fptk_id)->count();
        $data['initial_in'] = Candidate::where('process','INITIAL INTERVIEW')->where('job_fptk_id',$job_fptk_id)->count();
        $data['send_to_user'] = Candidate::where('process','SEND TO USER')->where('job_fptk_id',$job_fptk_id)->count();
        $data['med_check'] = Candidate::where('process','MED CHECK')->where('job_fptk_id',$job_fptk_id)->count();
        $data['intervew_1'] = Candidate::where('process','INTERVIEW 1')->where('job_fptk_id',$job_fptk_id)->count();
        $data['intervew_2'] = Candidate::where('process','INTERVIEW 2')->where('job_fptk_id',$job_fptk_id)->count();
        $data['intervew_3'] = Candidate::where('process','INTERVIEW 3')->where('job_fptk_id',$job_fptk_id)->count();
        $data['int_user'] = Candidate::where('process','INTERVIEW 1')->where('job_fptk_id',$job_fptk_id)->count();
        $data['offering_letter'] = Candidate::where('process','MED CHECK & OFFERING LETTER')->where('job_fptk_id',$job_fptk_id)->count();
        $data['hired'] = Candidate::where('process','HIRED')->count();
    	return view('backend.dashboard.search_fptk',$data);

    }

}
