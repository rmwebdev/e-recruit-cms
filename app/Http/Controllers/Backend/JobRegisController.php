<?php

namespace App\Http\Controllers\Backend;;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Candidate;
use App\Models\JobFptk;
use App\Models\TrJobFptkLog;
use App\Models\Parameters;
use Auth;
use Validator;
use DB;
use App\Http\Controllers\Controller;
use DateTime;
use Session;

class JobRegisController extends Controller
{
    //

    protected $year;
    public function __construct()
    {
        $this->middleware('auth');
        $this->year = ['2018','2019','All'];
    }

    public function index()
    {   
        $data['open'] = JobFptk::where('is_closed','open')->where('status','approved')->count();
        $data['closed'] = JobFptk::where('is_closed','closed')->where('status','approved')->count();
        $data['drop'] = JobFptk::where('drop','yes')->count();
        $data['approved'] = JobFptk::where('status','approved')->count();
        $data['rejected'] = JobFptk::where('status','rejected')->count(); 
        $data['total_req_fptk'] = JobFptk::count();
        $job_open = JobFptk::sum('actual_staff') - JobFptk::sum('hired'); 
        $job_drop = JobFptk::sum('requested_staff') - JobFptk::sum('actual_staff'); 
        $data['open_staff'] = $job_open;
        $data['closed_staff'] = JobFptk::sum('hired');
        $data['drop_staff'] = $job_drop;
        $data['year'] = $this->year;
        $data['total_request_rejected'] = JobFptk::where('status','rejected')->sum('requested_staff');
        $data['total_request_staff'] = $job_drop + $job_open + $data['closed_staff'] + $data['total_request_rejected'];

        return view('backend.job_regis.index_job_regis',$data);
    }

    public function getData(Request $request)
    {
        if(!empty($request->search['value']))
        {
            $data =  JobFptk::take(100)->get();
            $query =  JobFptk::take(100)->get();
        }
        else
        {
            $data =  JobFptk::take($request->length);
            $query =  JobFptk::get();
        }
          
            
        return Datatables::of($data)
        ->editColumn('request_job_number',function($data){
            return strtoupper($data->request_job_number); 
        })->editColumn('position_name',function($data){
            return strtoupper($data->position_name); 
        })->editColumn('insert_time',function($data){
            $insert_time = date('Y-m-d',strtotime($data->insert_time)) ;
            return $insert_time; 
        })->editColumn('rejected_staff',function($data){
            $rejected_staff = $data->requested_staff - $data->actual_staff;
            return $rejected_staff;
        })->editColumn('slaJoinDate',function($data){
            $getSlaJoin =  DB::table('e_recruit.tr_candidate as a')
        ->join('e_recruit.tr_job_fptk as b','a.job_fptk_id','=','b.job_fptk_id')
        ->select(DB::raw('round(avg((date(a.join_date) - date(b.received_date_fptk))),0) as sla_join_date'))
        ->where('process','HIRED')
        ->where('result','PASSED')
        ->where('b.job_fptk_id',$data->job_fptk_id)
        ->first();
            return $getSlaJoin->sla_join_date;
        })->editColumn('slaMcu',function($data){
            $sql = $this->getSLACount($data->job_fptk_id,'MED CHECK');
            return $sql[0]->datesla;
        })->editColumn('slaOffering',function($data){
             $sql = $this->getSLACount($data->job_fptk_id,'OFFERING LETTER');
             return $sql[0]->datesla;
        })->editColumn('slaInitialInterview',function($data){
            $sql = $this->getSLACount($data->job_fptk_id,'INITIAL INTERVIEW');
             return $sql[0]->datesla;
        })->editColumn('slaInterview1',function($data){
            $sql = $this->getSLACount($data->job_fptk_id,'INTERVIEW 1');
             return $sql[0]->datesla;
        })->editColumn('slaInterview2',function($data){
            $sql = $this->getSLACount($data->job_fptk_id,'INTERVIEW 2');
             return $sql[0]->datesla;
        })->editColumn('slaInterview3',function($data){
            $sql = $this->getSLACount($data->job_fptk_id,'INTERVIEW 3');
             return $sql[0]->datesla;
        })->editColumn('req_reason',function($data){
             return strtoupper($data->request_reason);
        })->editColumn('request_reason',function($data){
            $sql = $this->getSLACount($data->job_fptk_id,'MED CHECK');    
            if($data->request_reason == 'beyond man power planning')
            {
                if($sql[0]->datesla > 60) // 60
                {
                    return 'background-color:#DC3545;';
                }
                else
                {
                    return 'background-color:#28A745;';
                }

            }
            else
            {
                if($sql[0]->datesla > 30) // 30
                {
                    return 'background-color:#DC3545;';
                }
                else
                {
                    return 'background-color:#28A745;';
                }
            }
        })

        ->with(
            ['recordsFiltered'=> count($query),
            'recordsTotal'=> count($query)]
        )
        ->make();
     
    }


    function getSLACount($request_job_number,$type)
    {
        $dt = "select round(avg(a.history_date::date - c.received_date_fptk),0) as datesla
                         from
                                    (select
                                        rank()over(
                                            PARTITION BY candidate_id,history_process ORDER BY history_process_id desc) as baris,
                                        candidate_id,
                                        history_date,
                                        history_process
                                    from e_recruit.tr_history_process
                                    order by history_process_id desc
                                    ) a
                        inner join e_recruit.tr_candidate as b on a.candidate_id = b.candidate_id
                        inner join e_recruit.tr_job_fptk as c on b.job_fptk_id = c.job_fptk_id
                        where history_process = '".$type."'
                        and c.job_fptk_id = ".$request_job_number."
                         and a.baris  = 1";

        return DB::select($dt);
    }
    
    
    public function edit_job_regis($id)
    {
        
        $data['editData'] = JobFptk::where('request_job_number','ilike','%'.strtolower($id).'%')->first();
        $data['division'] = JobFptk::select('division')->groupBy('division')->get();
        $data['active'] = Parameters::active()->get();
        $data['publish'] = Parameters::publish()->get();
        return view('backend.job_regis.edit_job_regis',$data);
    }


    public function displaySla($id)
    {
        $data['editData'] = JobFptk::where('request_job_number','ilike','%'.strtolower($id).'%')->first();
        $data['active'] = Parameters::active()->get();
        $data['publish'] = Parameters::publish()->get();
        return view('backend.job_regis.displaySla',$data);
    }

    public function updateJobRegis(Request $request)
    {

         $validator =  Validator::make($request->all(), [
            'description' => 'required',
            'requirement'=>'required',
            'benefit'=>'required',
            'publish'=>'required',
            'drop'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }


        $getJob = JobFptk::where('request_job_number',$request->request_job_number)->first();

        $dataUpdate = 
        [
            'description' => $request->description,
            'requirement' => $request->requirement,
            'benefit' => $request->benefit,
            'publish' => $request->publish,
            'actual_staff'=> $getJob->actual_staff - $request->rejected_staff,
            'rejected_staff'=> $request->rejected_staff,
            'drop' => $request->drop,
            'reason_drop'=>$request->reason_drop,
            'subco'=>$request->subco,
            'update_time' => date('Y-m-d H:i:s'),
            'update_by' => Auth::user()->user_name,
        ];
        JobFptk::where('request_job_number',$request->request_job_number)->update($dataUpdate);

        if($request->drop == "yes")
        {
            if($request->rejected_staff == $getJob->actual_staff)
            {
                $dataUpdateClosed = ['publish'=>'Non Publish','is_closed'=>'closed','reason_drop'=>$request->reason_drop,'subco'=>$request->subco];
                JobFptk::where('request_job_number',$request->request_job_number)->update($dataUpdateClosed);                
            }
            
            $jobLog = new TrJobFptkLog;
            $jobLog->id = rand();
            $jobLog->request_job_number = $getJob->request_job_number;
            $jobLog->received_date_fptk = $getJob->received_date_fptk;
            $jobLog->required_date_fptk = $getJob->required_date_fptk;
            $jobLog->hired = $getJob->hired;
            $jobLog->recruitment_type = $getJob->recruitment_type;
            $jobLog->request_reason = $getJob->request_reason;
            $jobLog->position_name = $getJob->position_name;
            $jobLog->requested_staff = $getJob->requested_staff;
            $jobLog->golongan = $getJob->golongan;
            $jobLog->employment_type = $getJob->employment_type;
            $jobLog->ehrmpointofhire = $getJob->ehrmpointofhire;
            $jobLog->work_location = $getJob->work_location;
            $jobLog->work_system = $getJob->work_system;
            $jobLog->cost_center = $getJob->cost_center;
            $jobLog->reason_hiring = $getJob->reason_hiring;
            $jobLog->education = $getJob->education;
            $jobLog->faculty = $getJob->faculty;
            $jobLog->experience_year = $getJob->experience_year;
            $jobLog->age = $getJob->age;
            $jobLog->gender = $getJob->gender;
            $jobLog->marital_status = $getJob->marital_status;
            $jobLog->additional_information = $getJob->additional_information;
            $jobLog->skill = $getJob->skill;
            $jobLog->publish = $getJob->publish;
            $jobLog->status = $getJob->status;
            $jobLog->insert_by = $getJob->insert_by;
            $jobLog->insert_time = $getJob->insert_time;
            $jobLog->division = $getJob->division;
            $jobLog->requirement = $getJob->requirement;
            $jobLog->description = $getJob->description;
            $jobLog->benefit = $getJob->benefit;
            $jobLog->salary_range_max = $getJob->salary_range_max;
            $jobLog->salary_range_min = $getJob->salary_range_min;
            $jobLog->mp_period_code = $getJob->mp_period_code;
            $jobLog->age_from = $getJob->age_from;
            $jobLog->age_to = $getJob->age_to;
            $jobLog->department = $getJob->department;
            $jobLog->is_closed = $getJob->is_closed;
            $jobLog->drop = $getJob->drop;
            $jobLog->update_time = $getJob->update_time;
            $jobLog->update_by = $getJob->update_by;
            $jobLog->save();

        }
        return response()->json(['status'=>'success'],200);   
    }

    public function GetStatus(Request $request)
    {
        $sla = '';
        $dataStatus = $request->status;
        if($dataStatus=="approved" || $dataStatus=="rejected")
        {
            $data = getApprovedRejected($dataStatus);   
        }
        else if($dataStatus=="closed" || $dataStatus=="open")
        {
            $data = getOpenClosed($dataStatus);
        }
        else if($dataStatus=="drop")
        {
            $data = getDrop($dataStatus);   
        }


        return Datatables::of($data)
         ->editColumn('request_job_number',function($data){
            return strtoupper($data->request_job_number); 
         })
         ->editColumn('insert_time',function($data){
            $insert_time = date('Y-m-d',strtotime($data->insert_time)) ;
            return $insert_time;
        })->editColumn('rejected_staff',function($data){
            $rejected_staff = $data->requested_staff - $data->actual_staff;
            return $rejected_staff;
        })->editColumn('sla',function($data){
            $sla = $data->is_closed;
            return $sla;
        })->editColumn('req_reason',function($data){
             return strtoupper($data->request_reason);
        })
        ->make(true);
    }


    public function getCanSLAJoin(Request $request)
    {
        $param = strtolower($request->request_job_number);
        $data = Candidate::with('job_fptk')
                        ->whereHas('job_fptk', function ($query) use ($param){
                $query->where('request_job_number','=',$param);})
                        ->where('process','HIRED')
                        ->where('result','PASSED')
                        ->get();

        return Datatables::of($data)
        ->editColumn('request_job_number',function($data){
            $request_job_number = (empty($data->job_fptk->request_job_number)) ? "":strtoupper($data->job_fptk->request_job_number); 
            return $request_job_number;
        })->editColumn('received_date_fptk',function($data){
            $received_date_fptk = (empty($data->job_fptk->received_date_fptk)) ? "":strtoupper($data->job_fptk->received_date_fptk); 
            return $received_date_fptk;
        })->editColumn('join_date',function($data){
            $join_date = (empty($data->join_date)) ? "":strtoupper($data->join_date); 
            return $join_date;
        })->editColumn('name_holder',function($data){
            $name_holder = (empty($data->name_holder)) ? "":strtoupper($data->name_holder); 
            return $name_holder;
        })->editColumn('position_name',function($data){
            $position_name = (empty($data->job_fptk->position_name)) ? "":strtoupper($data->job_fptk->position_name); 
            return $position_name;
        })->editColumn('sla_join_date',function($data){
            $join =  date_create($data->join_date);
            $rec_date = date_create($data->job_fptk->received_date_fptk);
            $interval = date_diff($join,$rec_date);
            $join_date = $interval->days; 
            return $join_date;
        })
        ->make(true);
    }



    public function getCanSLA(Request $request)
    {
        $param = strtolower($request->request_job_number);

        if($request->type == 'MED CHECK')
        {
            $data = getSLADet($param,$request->type);    
        }
        else if($request->type == 'OFFERING LETTER')
        {
            $data = getSLADet($param,$request->type);    
        }
        else if($request->type == 'INITIAL INTERVIEW')
        {
            $data = getSLADet($param,$request->type);    
        }
        else if($request->type == 'INTERVIEW 1')
        {
            $data = getSLADet($param,$request->type);    
        }
        else if($request->type == 'INTERVIEW 2')
        {
            $data = getSLADet($param,$request->type);    
        }

        else if($request->type == 'INTERVIEW 3')
        {
            $data = getSLADet($param,$request->type);    
        }
                    
        return Datatables::of($data)
        ->editColumn('request_job_number',function($data){
            $request_job_number = (empty($data->request_job_number)) ? "":strtoupper($data->request_job_number); 
            return $request_job_number;
        })->editColumn('received_date_fptk',function($data){
            $received_date_fptk = (empty($data->received_date_fptk)) ? "":strtoupper($data->received_date_fptk); 
            return $received_date_fptk;
        })->editColumn('join_date',function($data){
            $strDate = date('Y-m-d',strtotime($data->history_date));
            $received_date = (empty($strDate)) ? "":strtoupper($strDate); 
            return $received_date;
        })->editColumn('name_holder',function($data){
            $name_holder = (empty($data->name_holder)) ? "":strtoupper($data->name_holder); 
            return $name_holder;
        })->editColumn('position_name',function($data){
            $position_name = (empty($data->position_name)) ? "":strtoupper($data->position_name); 
            return $position_name;
        })->editColumn('sla_date',function($data){
            $join =  date_create($data->history_date);
            $rec_date = date_create($data->received_date_fptk);
            $interval = date_diff($join,$rec_date);
            $join_date = $interval->days; 
            return $join_date;
        })->editColumn('request_reason',function($data){
            $join =  date_create($data->history_date);
            $rec_date = date_create($data->received_date_fptk);
            $interval = date_diff($join,$rec_date);
            $join_date = $interval->days; 
            if($data->request_reason == 'beyond man power planning')
            {
                if($join_date > 60) // 60
                {
                    return 'merah';
                }
                else
                {
                    return 'hijau';
                }

            }
            else
            {
                if($join_date > 30) // 30
                {
                    return 'background-color:#DC3545;';
                }
                else
                {
                    return 'background-color:#28A745;';
                }
            }
        })
        ->make(true);
    }
}
