<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Candidate;
use App\Models\JobFptk;
use App\Models\Parameters;
use App\Models\User;
use App\Models\TrHistoryProcess;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use DB;
use GuzzleHttp;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailProcess;
use App\Mail\SendEmailFailedProcess;
use App\Mail\SendEmailApproved;
use App\Mail\SendConfirmationAttending;
use App\Mail\SendEmailToCandidate;
use Log;
use DOMDocument;
use file_get_html;
use Session;
use Firebase\JWT\JWT;



class RecProcessController extends Controller
{
    //
    
    // Valid constant names
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index(Request $request)
    {
        $search = $request->s;
        $data['user'] = User::all();
        $data['status'] = Parameters::status()->get();
        $data['result'] = Parameters::result()->get();
        $data['cv_in'] = Candidate::whereNotNull('job_fptk_id')->whereNotIn('result',['CONSIDER','FAILED'])->count();
        $data['cv_sort'] = Candidate::where('process','CV SORT')->whereNotIn('result',['CONSIDER'])->count();
        $data['called'] = Candidate::where('process','CALLED')->whereNotIn('result',['CONSIDER'])->count();
        $data['psychotest'] = Candidate::where('process','PSYCHOTEST')->whereNotIn('result',['CONSIDER'])->count();
        $data['initial_in'] = Candidate::where('process','INITIAL INTERVIEW')->whereNotIn('result',['CONSIDER'])->count();
        $data['send_to_user'] = Candidate::where('process','SEND TO USER')->whereNotIn('result',['CONSIDER'])->count();
        $data['med_check'] = Candidate::where('process','MED CHECK')->whereNotIn('result',['CONSIDER'])->count();
        $data['intervew_1'] = Candidate::where('process','INTERVIEW 1')->whereNotIn('result',['CONSIDER'])->count();
        $data['intervew_2'] = Candidate::where('process','INTERVIEW 2')->whereNotIn('result',['CONSIDER'])->count();
        $data['intervew_3'] = Candidate::where('process','INTERVIEW 3')->whereNotIn('result',['CONSIDER'])->count();
        $data['int_user'] = Candidate::where('process','INTERVIEW 1')->whereNotIn('result',['CONSIDER'])->count();
        $data['offering_letter'] = Candidate::where('process','MED CHECK & OFFERING LETTER')->whereNotIn('result',['CONSIDER'])->count();
        $data['sort_list'] = Candidate::where('result','CONSIDER')->count();
        $data['history'] = TrHistoryProcess::whereNotNull('history_confirmation')->whereIn('history_result',['RESCHEDULE','ATTENDING','NOT ATTENDING','REINVITED'])->where('history_confirmation','ilike','%'.date('Y-m-d').'%')->count();
        $data['hired'] = Candidate::where('process','HIRED')->whereNotIn('result',['CONSIDER'])->count();
        $data['invitation_process'] = Parameters::where('kategori','STATUS')->where('status',1)->whereNotIn('nama',['CALLED','CV SORT','HIRED'])->get();
        $data['process'] = Parameters::status()->get();

        $parent  = User::where('nip',Auth::user()->parent_user)->first();
        $HR = \DB::table('e_recruit.tr_users as a')
        ->join('e_recruit.roles as b','a.role_id','b.id')
        ->where('nip',Auth::user()->nip)
        ->first();


        $req = \DB::table('e_recruit.tr_users as a')
            ->where('parent_user',\Auth::user()->nip)
            ->get();

            $parent_user =[];
            foreach ($req as $key => $value) {
              # code...
              $parent_user[]  = strtolower($value->name);
            }

            array_push($parent_user, strtolower(Auth::user()->name) );

        if(!empty($HR))
        {
            if($HR->name == 'Super User' || $HR->name == 'Admin HR' || $HR->username == 'userdeveloper' || $HR->name == 'CEO')
            {
                $result = 
                JobFptk::with('candidate')
                ->select('position_name','received_date_fptk','job_fptk_id','status','request_job_number','requester_name','requester_email')
                ->groupBy('position_name','received_date_fptk','job_fptk_id','status','request_job_number','requester_name','requester_email')
                ->orderBy('received_date_fptk','desc')
                ->whereNull('type_fptk');
        
            }
            else 
            {    
                $result = 
                JobFptk::with('candidate')
                ->select('position_name','received_date_fptk','job_fptk_id','status','request_job_number','requester_name','requester_email')
                ->groupBy('position_name','received_date_fptk','job_fptk_id','status','request_job_number','requester_name','requester_email')
                ->orderBy('received_date_fptk','desc')
                ->whereNull('type_fptk')
                ->whereIn('requester_name',$parent_user)
                ;
            }  
        }
        else
        {
             $result = 
                JobFptk::with('candidate')
                ->select('position_name','received_date_fptk','job_fptk_id','status','request_job_number','requester_name','requester_email')
                ->groupBy('position_name','received_date_fptk','job_fptk_id','status','request_job_number','requester_name','requester_email')
                ->orderBy('received_date_fptk','desc')
                ->whereNull('type_fptk')
                ->whereIn('requester_name',$parent_user)
                ;
        }
  



        if($request->filter == "published")
        {
            $result = $result->where('publish','Publish');
        }
        else if($request->filter == "save_draft")
        {
            $result = $result->where('publish','Non Publish');
        }
        else if($request->filter == "complete")
        {
            $result = $result->where('is_closed','closed');   
        }
        $result = $result->where('position_name','ilike','%'.$search.'%')
        ->paginate(10);
        // dump(Auth::user());
        //dump($result);


        if($request->sort_by == "APPLY")
        {
            $result = \DB::table('e_recruit.tr_job_fptk as a')
            ->selectRaw('count(request_job_number),request_job_number,position_name,received_date_fptk,a.job_fptk_id,a.status,request_job_number,requester_name,requester_email')
            ->leftJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
            ->whereNull('type_fptk')
            ->groupBy('request_job_number','position_name','received_date_fptk','a.job_fptk_id','a.status','request_job_number','requester_name','requester_email');
            if($request->filter == "published")
            {
                $result = $result->where('publish','Publish');
            }
            else if($request->filter == "save_draft")
            {
                $result = $result->where('publish','Non Publish');
            }
            else if($request->filter == "complete")
            {
                $result = $result->where('is_closed','closed');   
            }
            $result = $result->orderBy('count','desc')->paginate(10);
        }
        else if($request->sort_by == "HIRED")
        {
            $result = \DB::table('e_recruit.tr_job_fptk as a')
            ->selectRaw('count(request_job_number),request_job_number,position_name,received_date_fptk,a.job_fptk_id,a.status,request_job_number,requester_name,requester_email')
            ->leftJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
            ->whereNull('type_fptk')
            ->groupBy('request_job_number','position_name','received_date_fptk','a.job_fptk_id','a.status','request_job_number','requester_name','requester_email')
            ->where('b.process','HIRED');
            if($request->filter == "published")
            {
                $result = $result->where('publish','Publish');
            }
            else if($request->filter == "save_draft")
            {
                $result = $result->where('publish','Non Publish');
            }
            else if($request->filter == "complete")
            {
                $result = $result->where('is_closed','closed');   
            }
            $result = $result->orderBy('count','desc')->paginate(10);
        }
        else if($request->sort_by == "CV IN")
        {
            $result = \DB::table('e_recruit.tr_job_fptk as a')
            ->selectRaw('count(request_job_number),request_job_number,position_name,received_date_fptk,a.job_fptk_id,a.status,request_job_number,requester_name,requester_email')
            ->leftJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
            ->whereNull('type_fptk')
            ->groupBy('request_job_number','position_name','received_date_fptk','a.job_fptk_id','a.status','request_job_number','requester_name','requester_email')
            ->where('b.process','CV IN');
            if($request->filter == "published")
            {
                $result = $result->where('publish','Publish');
            }
            else if($request->filter == "save_draft")
            {
                $result = $result->where('publish','Non Publish');
            }
            else if($request->filter == "complete")
            {
                $result = $result->where('is_closed','closed');   
            }
            $result = $result->orderBy('count','desc')->paginate(10);
        }
      

        $data['getData'] =  $result;
        $data['search'] = $request->s;

        $sort_apply = \DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('request_job_number,count(request_job_number) as baris')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->whereNotIn('type_fptk',['outsource'])
        ->orWhereRaw('type_fptk is null')
        ->groupBy('request_job_number')
        ->orderBy('baris','desc')
        ->first();

        $sort_hired = \DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('request_job_number,count(request_job_number) as baris,b.process')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->whereNotIn('type_fptk',['outsource'])
        ->orWhereRaw('type_fptk is null')
        ->where('process','HIRED')
        ->groupBy('request_job_number','process')
        ->orderBy('baris','desc')
        ->first();



        $data['count_data'] =  JobFptk::with('candidate')
        ->select('position_name','received_date_fptk','job_fptk_id')
        ->groupBy('position_name','received_date_fptk','job_fptk_id')
        ->orderBy('received_date_fptk','desc')
        ->whereNull('type_fptk')
        ->where('position_name','ilike','%'.$search.'%')
        ->get();  


        $data['released'] =  \App\Models\JobFptk::
        where('publish','ilike','%publish%')
        ->whereNull('type_fptk')
        ->count(); 

        $data['consider'] =  \App\Models\Candidate::
        where('result','ilike','%consider%')
        ->count(); 

       $data['registered'] = \DB::table('e_recruit.tr_candidate')
        ->where('process','REGISTRATION')
        ->count();

        $data['cv_in_all'] =  \App\Models\Candidate::
        with('job_fptk')
        ->whereNotNull('job_fptk_id')
        ->whereNotIn('result',['FAILED','CONSIDER'])
        ->count();

         $data['invited_all'] = \App\Models\Candidate::
        with('job_fptk')
        ->where('process','ilike','%CALLED%')
        ->whereIn('invitation_process',['INITIAL INTERVIEW','INTERVIEW 2','INTERVIEW 1','INTERVIEW 3','PSYCHOTEST'])
        ->count();


        $data['hired_all'] = \App\Models\Candidate::
        with('job_fptk')
        ->where('process','ilike','%HIRED%')
        ->count();


        $data['failed_all'] = \App\Models\Candidate::
        with('job_fptk')
        ->where('result','=','FAILED')
        ->count();


        return view('backend.rec_process.index_rec_process',$data);
    }

    public function getData(Request $request)
    {
        $data = Candidate::with('job_fptk')->orderBy('registration_date','asc')->take($request->length);
        $count = Candidate::with('job_fptk')->orderBy('registration_date','asc')->get();

        return Datatables::of($data)
        ->with(
            ['recordsFiltered'=> $count->count(),
            'recordsTotal'=> $count->count(),]
        )
        ->make(true);
    }


    public function detail_rec_process(Request $request)
    {
        $data['user'] = User::all();
        $data['status'] = Parameters::status()->get();
        $data['result'] = Parameters::result()->get();
        $data['applied'] = Candidate::whereNotNull('job_fptk_id')->whereNotIn('result',['CONSIDER','FAILED'])->where('job_fptk_id',$request->id)->count();
        $data['cv_in'] = Candidate::whereNotNull('job_fptk_id')->whereNotIn('result',['CONSIDER'])->where('process','ilike','%CV IN%')->where('job_fptk_id',$request->id)->count();
        $data['cv_sort'] = Candidate::where('process','CV SORT')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$request->id)->count();
        $data['called'] = Candidate::where('process','CALLED')->whereRaw("(result not in ('CONSIDER')  or result is null )")->where('job_fptk_id',$request->id)->count();
        $data['psychotest'] = Candidate::where('process','PSYCHOTEST')->whereNotIn('result',['CONSIDER'])->where('result','PASSED')->where('job_fptk_id',$request->id)->count();
        $data['initial_in'] = Candidate::where('process','INITIAL INTERVIEW')->whereNotIn('result',['CONSIDER'])->where('result','PASSED')->where('job_fptk_id',$request->id)->count();
        $data['send_to_user'] = Candidate::where('process','SEND TO USER')->whereNotIn('result',['CONSIDER'])->where('result','PASSED')->where('job_fptk_id',$request->id)->count();
        $data['med_check'] = Candidate::where('process','MED CHECK')->whereNotIn('result',['CONSIDER'])->where('result','PASSED')->where('job_fptk_id',$request->id)->count();
        $data['intervew_1'] = Candidate::where('process','INTERVIEW 1')->whereNotIn('result',['CONSIDER'])->where('result','PASSED')->where('job_fptk_id',$request->id)->count();
        $data['intervew_2'] = Candidate::where('process','INTERVIEW 2')->whereNotIn('result',['CONSIDER'])->where('result','PASSED')->where('job_fptk_id',$request->id)->count();
        $data['intervew_3'] = Candidate::where('process','INTERVIEW 3')->whereNotIn('result',['CONSIDER'])->where('result','PASSED')->where('job_fptk_id',$request->id)->count();
        $data['int_user'] = Candidate::where('process','INTERVIEW 1')->whereNotIn('result',['CONSIDER'])->where('result','PASSED')->where('job_fptk_id',$request->id)->count();
        $data['offering_letter'] = Candidate::where('process','ilike','%OFFERING LETTER%')->whereRaw("(result not in ('CONSIDER')  or result is null )")->where('job_fptk_id',$request->id)->count();
        $data['failed'] = Candidate::where('result','FAILED')->where('job_fptk_id',$request->id)->count();
        $data['history'] = TrHistoryProcess::whereNotNull('history_confirmation')->whereIn('history_result',['RESCHEDULE','ATTENDING','NOT ATTENDING','REINVITED'])->where('history_confirmation','ilike','%'.date('Y-m-d').'%')->count();
        $data['hired'] = Candidate::where('process','HIRED')->whereNotIn('result',['CONSIDER'])->where('job_fptk_id',$request->id)->count();
        $data['invitation_process'] = Parameters::where('kategori','STATUS')->where('status',1)->whereNotIn('nama',['CALLED','CV SORT','HIRED'])->get();
        $data['process'] = Parameters::status()->get();
        $data['detail'] = JobFptk::find($request->id);
        $result = Candidate::where('job_fptk_id',$request->id);

        $data['data_invitation'] = DB::table('e_recruit.tr_history_process as a')
                ->join('e_recruit.tr_candidate as b','a.candidate_id','=','b.candidate_id')
                ->join('e_recruit.tr_job_fptk as c','c.job_fptk_id','=','b.job_fptk_id')
                ->select('*')
                ->whereIn('a.history_result',['ATTENDING','RESCHEDULE','NOT ATTENDING','REINVITED'])
                ->where('a.history_confirmation','ilike','%'.date('Y-m-d').'%')
                ->whereRaw("(a.history_confirmation != '' or a.history_confirmation is not null)")
                ->orderby('a.history_confirmation','desc')
                ->count();
        if(!empty($request->status))
        {
            if($request->status == 'consider' || $request->status == 'failed' )
            {
                $result->whereNotNull('job_fptk_id');    
                $result->where('result','ilike','%'.$request->status.'%');                
            }
            else if(!empty($request->search_name))
            {
                $result->whereNotNull('job_fptk_id');    
                $result->where('name_holder','ilike','%'.$request->search_name.'%'); 
            }
            else
            {
                $result->whereNotNull('job_fptk_id');    
                $result->where('process','ilike','%'.$request->status.'%');                
            }   
        }

        $data['detail_candidate'] = $result->paginate(10);
        
        return view('backend.rec_process.detail_rec_process',$data);
        
    }

    public function getDataWithStatus(Request $request)
    {
        $stat = $request->status;
        if($stat == 'CONSIDER')
        {
            $data = Candidate::with('job_fptk')->where('result','CONSIDER')->get();
        } 
        else
        {
            $data = Candidate::with('job_fptk')->where('process',$stat)->get();
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


    public function updateStatus(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'process' => 'required',
            'result'=>'required',
            'date_process'=>'required',
            
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        $getCandidate =[];

        foreach ($_POST['candidate'] as $value) 
        {
            // input to history
            $candidate = Candidate::find($value);
            $job = JobFptk::find($candidate->job_fptk_id);

            if(empty($job))
            {
                return response()->json(array('status'=>'job_not_apply','message'=>'job_not_apply','candidate'=>$candidate->name_holder),422); 
            }

            $paramHistory = [
                'candidate_id'=>$value,
                'result'=>$request->result,
                'process'=>$request->process,
                'date_process'=>$request->date_process,
                'remarks'=>'',
                'berkas'=>'',
                'history_position_name'=>(empty($job)) ? "" : $job->position_name,
                'history_address' => '',
                'history_contact_person' => '',
                'history_confirmation' => '',
                'history_invitation_process'=>'',
                'iq' => $request->iq,
                'pauli' => $request->pauli,
                'disc' => $request->disc,
                'cbi' => $request->cbi,
                'insert_by'=>Auth::user()->user_name,
                'insert_time'=>date('Y-m-d H:i:s'),
            ];


            if($request->process == "CV SORT")
            {
                $save_history  = saveToHistory($paramHistory);
                if(!$save_history)
                {
                    $getCandidate[] =  $candidate->name_holder;
                }
                else
                {
                    // update candidate
                    $candidate->process = $request->process;
                    $candidate->result = $request->result;
                    $candidate->join_date = $request->join_date;
                    $candidate->received_date = $request->date_process;
                    $candidate->insert_by = Auth::user()->user_name;
                    $candidate->insert_time = date('Y-m-d H:i:s');

                    $candidate->save();    
                }
                
            }
            else
            {
                if(empty($job))
                {
                    return response()->json(array('status'=>'job_not_apply','message'=>'job_not_apply'),422); 
                }

                $save_history  = saveToHistory($paramHistory);
                if(!$save_history)
                {
                    $getCandidate[] =  $candidate->name_holder;
                }
                else
                {
                    // update candidate
                    $candidate->process = $request->process;
                    $candidate->result = $request->result;
                    $candidate->join_date = $request->join_date;
                    $candidate->received_date = $request->date_process;
                    $candidate->insert_by = Auth::user()->user_name;
                    $candidate->insert_time = date('Y-m-d H:i:s');

                    $candidate->save();    
                }
            }
        }

        
        if(empty($getCandidate))
        {
            return response()->json(['status'=>'success'],200);
        }
        else
        {
            return response()->json(array('status'=>'error_process_already','data_candidate'=>$getCandidate),422); 
        }        

    }



    public function video_call($candidate_id,$date,$time)
    {
        try {
            $url = 'https://api.zoom.us/v2/users/OxBOnxuqT0eAZX9O81mYOg/meetings';
            
            $candidate = \App\Models\Candidate::find($candidate_id);

            $client = new \GuzzleHttp\Client([
                'headers'   => [
                    'Content-type' => 'application/json',
                    'Authorization'=> 'Bearer '.$this->generateJWT()
                ],
                'http_errors' => false
            ]);

            $response = $client->post($url,
                ['body' => json_encode(

                    [   
                      "topic" => "Interview online ".$candidate->name_holder,
                      "type" => "2",
                      "start_time" => $date.' '.$time,
                      "duration" => "30",
                      "timezone" => "Asia/Jakarta",
                      "password" => "",
                      "agenda" => "Interview Online ".$candidate->name_holder,
                      "settings" => [
                        "host_video" => "true",
                        "participant_video" => "true",
                        "cn_meeting" => "false",
                        "in_meeting" => "false",
                        "join_before_host" => "true",
                        "mute_upon_entry" => "false",
                        "watermark" => "true",
                        "use_pmi" => "",
                        "approval_type" => "0",
                        "registration_type" => "1",
                        "audio" => "both",
                        "auto_recording" => "local",
                        "enforce_login" => "false",
                        "enforce_login_domains" => "",
                        "alternative_hosts" => ""
                       ]
                    ]
                )]
            );  
            $resp = json_decode($response->getBody());   

            return $resp;

        } catch (Exception $e) {
            return redirect()->route('login');
        }   
    }



    public function generateJWT()
    {
        $token = [
            'iss' => config('zoom.api_key'),
            'exp' => time() + 30000,
        ];

        return JWT::encode($token, config('zoom.api_secret'));
    }


    public function edit_rec_process($id,Request $request)
    {        
        $data['candidate'] = Candidate::find($id);   
        $sql = "select a.* from
            (select
                row_number()over(
                    PARTITION BY candidate_id,history_process ORDER BY history_process_id desc) as baris,
                candidate_id,
                history_process_id,
                history_date,
                history_process,
                history_result,
                history_remarks,
                history_attachment,
                history_invitation_process,
                history_position_name as position_name,
                insert_time
            from e_recruit.tr_history_process
            order by history_process_id desc
            ) 
            a where a.candidate_id = '".$id."' and a.baris  = 1";

        $dt = DB::select($sql);

        
        $data['history'] = $dt;
        $data['status'] = Parameters::status()->get();

         $getProces = Parameters::where('kategori','STATUS')

        ->where('nama',$request->process)->where('status',1)
        ->select('kode','nama','parameter_id')
        ->orderby('nama','asc')
        ->first();



        $data_result = Parameters::where('parent','ilike','%'.$getProces->parameter_id.',%')
        ->orderBy('no_urut','asc')
        ->get();
        
        if($request->process != 'CALLED')
        {
            $data['result'] = $data_result;
        }
        else
        {
            $data['result'] = Parameters::where('kategori','STATUS')->where('status',1)->whereNotIn('nama',['CALLED','CV SORT','HIRED'])->get();
        }


        
        $data['invitation_process'] = Parameters::where('kategori','STATUS')->where('status',1)->whereNotIn('nama',['CALLED','CV SORT','HIRED'])->get();

        $data['user'] = User::all();

        

        $data['candidate'] = Candidate::where('candidate_id',$id)->first();

        return view('backend.rec_process.edit_rec_process',$data);
    }

    //for validate cv with event onchange
    public function changeCV_baru(Request $request)
    {
        $messages = [
            'file.mimes'    => '  CV must be a  pdf file .',
            'file.max'    => '  CV must be a  greater than 2000 kilobytes .',
        ]; 
    
        $destinationPath = 'upload_file';

        $validator =  Validator::make($request->all(), [
            'file' => 'mimes:pdf|max:2000',
        ], $messages);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        $destinationPath = 'upload_file';
        if(!empty($request->file('file')))
        {
            File::delete($destinationPath.'/'.$request->file_edit);
            $fileNameCv = uploadFile($request->file('file'),$destinationPath);
        }

        $fileNameCv = "";


        $can = Candidate::find($request->candidate_id);

        $can->file_2 = $fileNameCv;
        $can->save();

        return response()->json(['status'=>'success','url'=>$fileNameCv],200); 
    }



    public function message($message,$candidate_id,$date,$remark,$process,$person,$type="")
    {
        $dateProc = date('Y-m-d', strtotime($date));
        $timeProc  = date('H:i:s', strtotime($date));
        $replace = array();
        $replace[0] = "/Tidak perlu diubah, hari tanggal terisi otomatis berdasarkan date invitation/";
        $replace[1] = "/Tidak perlu diubah, jam terisi otomatis berdasarkan date invitation/";
        $replace[2] = "/Tidak perlu diubah, lokasi terisi otomatis berdasarkan Venue/";
        $replace[3] = "/Tidak perlu diubah, agenda terisi otomatis berdasarkan Invitation Process/";
        $replace[4] = "/Tidak perlu diubah, contact person terisi otomatis berdasarkan Invitation Process/";
        if($type == 'video_call')
        {
            $replace[5] = "/Tidak perlu diisi, link zoom terisi otomatis/";    
        }
    
        $replacement = array();
        $replacement[0] = tanggal_indo_lengkap($dateProc);
        $replacement[1] = $timeProc;
        $replacement[2] = $remark;
        $replacement[3] = $process;
        



        if($type == 'video_call')
        {
            // dd('video_call');
            $link = $this->video_call($candidate_id,$dateProc,$timeProc)->join_url;
            $replacement[4] = $person;
            $replacement[5] = $link;      
            $msg = preg_replace($replace,$replacement, $message);                
            $msgTag = strip_tags($msg);
            $msgReplace =  str_ireplace(array("\r","\t",'\r','\t'),'', $msgTag);
            $ms = preg_replace("/(\r?\n){2,}/", "\n\n", $msgReplace);
            $message_wa = str_replace(["\n\nDear tes,","Hari, tanggal\n",": \n","Jam\n","Lokasi\n","Agenda\n","dengan\n","Phone","Scan Barcode\n","Link Zoom\n"],["Dear tes,", " Hari, Tanggal "," : "," Jam "," Lokasi "," Agenda "," dengan "," \nPhone "," Scan Barcode "," Link Zoom "], $ms);
            $link_re = str_replace('/j', "/s", $link);
            $candidate = \App\Models\Candidate::find($candidate_id);
            $candidate->link_video_call = $link_re;
            $candidate->save();
        }
        else
        {  
            
            $replacement[4] = $person;
            $msg = preg_replace($replace,$replacement, $message);                
            $msgTag = strip_tags($msg);
            $msgReplace =  str_ireplace(array("\r","\t",'\r','\t'),'', $msgTag);
            $ms = preg_replace("/(\r?\n){2,}/", "\n\n", $msgReplace);
            $message_wa = str_replace(["\n\nDear tes,","Hari, tanggal\n",":\n","Jam\n","Lokasi\n","Agenda\n","dengan\n","Phone","Scan Barcode\n"],["Dear tes, ","Hari, Tanggal ",": ","Jam ","Lokasi ","Agenda ","dengan ","\nPhone ","Scan Barcode "], $ms);
            $candidate = \App\Models\Candidate::find($candidate_id);
            $candidate->link_video_call = '';
            $candidate->save();
        }

        return  ['message_wa'=>$message_wa,'message_email'=>$msg];
        
    }


    public function cek_candidate($candidate_id)
    {
        $userinfo = $candidate_id; 
        $cand = \App\Models\Candidate::where('candidate_id',$candidate_id)->first();
        $family = \App\Models\MasterPersonal::family($candidate_id);
        $emergency_contact = \App\Models\MasterPersonal::emergency_contact($candidate_id);
        $education_background = \App\Models\MasterPersonal::education_background($candidate_id);
        $course_information = \App\Models\MasterPersonal::course_information($candidate_id);
        $skill = \App\Models\MasterPersonal::skill($candidate_id);
        $language_skill = \App\Models\MasterPersonal::language_skill($candidate_id);
        $org_information = \App\Models\MasterPersonal::org_information($candidate_id);
        $job_experience = \App\Models\MasterPersonal::job_experience($candidate_id);
        $job_interest = \App\Models\MasterPersonal::job_interest($candidate_id);
        $assess_can = \App\Models\TRAssessment::where('candidate_id',$candidate_id)->count();


        $assess_can = ($assess_can == 0) ? "Assessment, " : "";
        $family = ($family == 0) ? "Family Information, " : "";
        $emergency_contact = ($emergency_contact == 0) ? "Emergency Contact, " : "";
        $education_background = ($education_background == 0) ? "Educational Background, " : "";
        $course_information = ($course_information == 0) ? "Course Information, " : "";
        $skill = ($skill == 0) ? "Skill, " : "";
        $language_skill = ($language_skill == 0) ? "Language Skill, " : "";
        $org_information = ($org_information == 0) ? "Organization, " : "";
        $job_experience = ($job_experience == 0) ? "Job Experience, " : "";
        $job_interest = ($job_interest == 0) ? "Job Interest, " : "";
        $npwp = (empty($cand->npwp)) ? "NPWP, " : "";
        

        if(
            ($family != "") || ($emergency_contact != "") || ($education_background != "") || ($skill != "") || ($language_skill != "") || ($npwp !="") 
            // || ($assess_can !="")
            ):

            ($npwp == 'NPWP,') ? "Personal Information" : "";
            if( ($npwp == 'NPWP,' ) ):
                    return  "Personal Information, ";                  
           endif;

          if( ($family == 'Family Information, ' ) || ($emergency_contact == 'Emergency Contact, ' ) ):
                    return "Family Information, ";                  
           endif;

           if ( $education_background == 'Educational Background, '  ):
                    return "Educational Background,  ";
           endif;

            if ( ($skill == 'Skill, ')  || ($language_skill == 'Language Skill, ') ):
                    return "Skill,  ";
            endif;

      

        else:
            return '';
        endif;
    }

    public function updateRecProcessEmail(Request $request)
    {
        $html = $request->pesan;

        if($request->invitation_type == 'video_call')
        {
             $validator =  Validator::make($request->all(), [
                'date_process_called'=>'required',
                "contact_person"=>'required',
                'attachment'=>"mimes:jpeg,png,jpg,doc,docx,pdf,xls,xlsx|max:2000",
            ]);
        }        
        else
        {
             $validator =  Validator::make($request->all(), [

                'date_process_called'=>'required',
                "invitation_process"=>'required',
                "contact_person"=>'required',
                'attachment'=>"mimes:jpeg,png,jpg,doc,docx,pdf,xls,xlsx|max:2000",
            ]);
        }
       



        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }
         // send email
        $candidate = Candidate::find($request->candidate_id_called);
        $job = JobFptk::find($candidate->job_fptk_id);
        
        if(empty($job))
        {
            return response()->json( array('status' => 'not_apply'),422);
        }

        $dateProc = date('Y-m-d', strtotime($request->date_process_called));
        $timeProc  = date('H:i:s', strtotime($request->date_process_called));

        

        $message_ = '';
        if($request->invitation_type == 'video_call')
        {
            $message_  = $request->email_video_call;
        }        
        else
        {
            $message_ = $request->pesan;
        }
             
        // input to history
        $paramHistory = [
                'candidate_id'=>$request->candidate_id_called,
                'result'=>'SENT',
                'process'=>'CALLED',
                'date_process'=>$request->date_process_called,
                'remarks'=>'',
                'berkas'=>'',
                'history_position_name'=>$job->position_name,
                'history_address'=>$request->remarks_called,
                'history_contact_person'=>$request->contact_person,
                'history_invitation_process'=>$request->invitation_process,
                'history_confirmation'=>'',
                'iq' => $request->iq,
                'pauli' => $request->pauli,
                'disc' => $request->disc,
                'cbi' => $request->cbi,
                'insert_by'=>Auth::user()->user_name,
                'insert_time'=>date('Y-m-d H:i:s'),
            ];
        $save_history  = saveToHistory($paramHistory);

        if(!$save_history)
        {
            return response()->json( array('status' => 'already_process'),422);
        }


        $message = $this->message($message_,$request->candidate_id_called,$request->date_process_called,$request->remarks_called,$request->invitation_process,$request->contact_person);
        //

        // param send email
        $paramEmail['requester_name']  = $job->requester_name;
        $paramEmail['requester_email']  = $job->requester_email;
        $paramEmail['request_job_number']  = $job->request_job_number;
        $paramEmail['name_holder'] = $candidate->name_holder;
        $paramEmail['position_name'] = $job->position_name;
        $paramEmail['process'] = "INVITE";
        $paramEmail['email_candidate'] = $candidate->email;
        $paramEmail['required_date_fptk'] = $job->required_date_fptk;
        $paramEmail['result'] = $candidate->invitation_process;
       

        // update candidate
        $candidate = Candidate::find($request->candidate_id_called);
        $candidate->result = "SENT";
        $candidate->invitation_process = $request->invitation_process;
        $candidate->process = 'CALLED';
        $candidate->contact_person = $request->contact_person;
        $candidate->address_interview = $request->remarks_called;
        $candidate->date_process = $request->date_process_called;
        $candidate->update_by = Auth::user()->user_name;
        $candidate->update_time = date('Y-m-d H:i:s');

        $candidate->save();

        $paramEmailCan['candidate'] = $candidate->name_holder;
        $paramEmailCan['address'] =  '';
        $paramEmailCan['job'] =$job->position_name;
        $paramEmailCan['interview_process'] =$request->invitation_process;
        $paramEmailCan['date_process'] =tanggal_indo_lengkap($dateProc);
        $paramEmailCan['time_process']=$timeProc;
        $paramEmailCan['candidate_id']=$candidate->candidate_id;
        $paramEmailCan['ktp_no']=$candidate->ktp_no;
        $paramEmailCan['msg']=$message['message_email'];


        Mail::to($candidate->email)->send(new SendEmailToCandidate($paramEmailCan));

        // ini kirim ke user
        if(!empty($job->requester_email))
        {
            Mail::to($job->requester_email)->send(new SendEmailProcess($paramEmail));    
        }
        
        sendWA2($message['message_wa'],$candidate->name_holder,$dateProc,$timeProc,$request->invitation_process,$candidate->hp_1,$candidate->candidate_id,$candidate->ktp_no);
       
        if(!Mail::failures())
        {
            return response()->json(['status'=>'success'],200);   
        }
        else
        {
            return response()->json( array('status' => 'errors'),422);
        }

    } 


    public function updateRecProcessStatus(Request $request)
    {
        Log::info('RecProcessController.updateRecProcessStatus => begin');


        if($request->process == 'HIRED')
        {       
            $join = [
            'result'=>'required',
            'date_process'=>'required',
            'join_date'=>'required',
            'attachment'=>"mimes:jpeg,png,jpg,doc,docx,pdf,xls,xlsx|max:2000",
            ];
        }
        if($request->process == 'CV SORT')
        {       
            $join = [
            'result'=>'required',
            'date_process'=>'required',
            // 'join_date'=>'required',
            ];
        }
        else
        {
            $join = [
            'result'=>'required',
            'date_process'=>'required',
            'attachment'=>"mimes:jpeg,png,jpg,doc,docx,pdf,xls,xlsx|max:2000",
            ];
        }

        $validator =  Validator::make($request->all(), $join);


        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        if($request->file('attachment'))
        {
            $destinationPath = 'upload_file';
            $fileAttachment = uploadFile($request->file('attachment'),$destinationPath);
        }
        $file_att = (empty($fileAttachment)) ? '' : $fileAttachment;
        $candidate = Candidate::find($request->candidate_id);


        if($candidate->process == 'HIRED')
        {
            return response()->json( array('status' => 'hired_already'),422);   
        }
 
        $job = JobFptk::find($candidate->job_fptk_id);

        if(empty($job))
        {
            return response()->json( array('status' => 'not_apply'),422);
        }


        \DB::beginTransaction();
        try {

            if($request->process=='HIRED' ||  $request->process=='PASSED')
            {
               
                $cek = $this->cek_candidate($candidate->candidate_id);

                if(!empty($cek))
                {
                    return response()->json( array('status' => 'validate_candidate','message'=>$cek),422);
                }

                $client = new GuzzleHttp\Client([
                        'headers'=>['Content-type'=>'application/json'],
                        'auth' => ['ws_erec', '3reC!!!'],
                        'http_errors'=>false
                ]);
                // $url ='https://services.puninar.com/hcis-post-candidate-to-hcis';
                // $url_master = 'https://services.puninar.com/hcis-get-data-master-from-hcis';
                $url ='https://middleware.puninar.com:9091/services-hcis-post-candidate-to-hcis';
                $url_master = 'https://middleware.puninar.com:9091/services-hcis-get-data-master-from-hcis';
                $res = $client->post($url, 
                    ['body'=>json_encode(
                            [
                                'id'=>$candidate->candidate_id,
                            ]
                        )
                    ]
                );

                $response = json_decode($res->getBody());
                
                $stat = json_decode($response->stat);
                $message_r = json_decode($response->msg);


                if($stat == 2 || $stat == 20)
                {   
                    return response()->json( array('status' => $stat,'message'=>$message_r),422);
                }

                $updateJob = JobFptk::find($candidate->job_fptk_id);

                if($updateJob->is_closed == 'closed')
                {
                    return response()->json( array('status' => 'fullfield'),422);
                }

                $updateJob->hired = $updateJob->hired + 1;
                $updateJob->save();

                if($updateJob->hired == $updateJob->actual_staff)
                {   
                    $updateClosed = JobFptk::find($candidate->job_fptk_id);
                    $updateClosed->is_closed = "closed";
                    $updateClosed->publish = "Non Publish";
                    $updateClosed->save();
                }
            }
            // update candidate
            $candidate->result = $request->result;
            $candidate->process = $request->process;
            $candidate->date_process = $request->date_process;
            $candidate->remarks = $request->remarks;
            $candidate->iq = $request->iq;
            $candidate->pauli = $request->pauli;
            $candidate->disc = $request->disc;
            $candidate->cbi = $request->cbi;
            $candidate->join_date = $request->join_date;
            $candidate->berkas = $file_att;
            $candidate->update_by = Auth::user()->user_name;
            $candidate->update_time = date('Y-m-d H:i:s');
            $candidate->save();
            //


            // send  email to user
            $paramEmail['requester_name']  = $job->requester_name;
            $paramEmail['requester_email']  = $job->requester_email;
            $paramEmail['request_job_number']  = $job->request_job_number;
            $paramEmail['name_holder'] = $candidate->name_holder;
            $paramEmail['email_candidate'] = $candidate->email;
            $paramEmail['process'] = $request->process;
            $paramEmail['position_name'] = $job->position_name;
            $paramEmail['required_date_fptk'] = $job->required_date_fptk;
            $paramEmail['result'] = $request->result;
            

            // input history
            $paramHistory = [
                    'candidate_id'=>$request->candidate_id,
                    'result'=>$request->result,
                    'process'=>$request->process,
                    'date_process'=>$request->date_process,
                    'remarks'=>$request->remarks,
                    'history_position_name'=>(empty($job)) ? "" : $job->position_name,
                    'history_address' => '',
                    'history_contact_person' => '',
                    'history_confirmation' => '',
                    'history_invitation_process' => '',
                    'iq' => $request->iq,
                    'pauli' => $request->pauli,
                    'disc' => $request->disc,
                    'cbi' => $request->cbi,
                    'berkas'=>$file_att,
                    'insert_by'=>Auth::user()->user_name,
                    'insert_time'=>date('Y-m-d H:i:s')
                ];
            $save_history  = saveToHistory($paramHistory);
            if(!$save_history)
            {
                return response()->json( array('status' => 'already_process'),422);
            }
            if( ($request->process == 'INITIAL INTERVIEW' && $request->result == 'PASSED') || ($request->process == 'INTERVIEW 1'  && $request->result == 'PASSED') || ($request->process == 'INTERVIEW 2'  && $request->result == 'PASSED') || ($request->process == 'INTERVIEW 3'  && $request->result == 'PASSED')  || ($request->process == 'MED CHECK'  && $request->result == 'PASSED') || ($request->process == 'OFFERING LETTER'  && $request->result == 'PASSED') || ($request->process == 'PSYCHOTEST' && $request->result == 'PASSED')  || ($request->process == 'HIRED' && $request->result == 'PASSED'))
            {
                if(!empty($job->requester_email))
                 {       
                    Mail::to($job->requester_email)->send(new SendEmailProcess($paramEmail));
                    if( count(Mail::failures()) > 0 ) 
                    {
                        Log::info('Kirim Email => ERORRR, kirim email error !');
                    } 
                    else 
                    {
                        Log::info('Kirim Email => No errors, all sent successfully!');
                    }    
                }
            
            }
            else if($request->result == 'FAILED')
            {
                if(!empty($job->requester_email))
                {
                    Mail::to($job->requester_email)->send(new SendEmailProcess($paramEmail));
                }

                Mail::to($candidate->email)->send(new SendEmailFailedProcess($paramEmail));
            }

            /* Integrasi ke psychotest */
            $integrasi=new IntegrationController;
            $result_integrasi_=$integrasi->postUserToPsikonogram(['candidate_id'=>$candidate->candidate_id]);

            $result_integrasi=json_decode($result_integrasi_,1);
            $result_integrasi_stat=2;
            $result_integrasi_msg='';
            if (isset($result_integrasi['stat'])) {
            	if ($result_integrasi['stat']==1||$result_integrasi['stat']==3) {
            		$result_integrasi_stat=1;
            		$result_integrasi_msg=$result_integrasi['msg'];
            	}
            }

            
            \DB::commit();
            return response()->json(['status'=>'success','result_integrasi_stat'=>$result_integrasi_stat,'result_integrasi_msg'=>$result_integrasi_msg],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status'=>$e->getMessage()],422);       
        }

    }

    public function inputReason(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'reason' => 'required',
            // 'contact_person' => 'required',
        ]);

        Log::info('RecProcessController.inputReason => Begin');
        Log::info($request->all());


        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        $html = $request->pesan;

        $candidate = Candidate::find($request->candidate_id_called);
        $job = JobFptk::find($candidate->job_fptk_id);

        $dateProc = date('Y-m-d', strtotime($request->date_process_called));
        $timeProc  = date('H:i:s', strtotime($request->date_process_called));


        $message_ = '';
        if($request->invitation_type == 'video_call')
        {
            $message_  = $request->email_video_call;
        }        
        else
        {
            $message_ = $request->pesan;
        }

        $message = $this->message($message_,$request->candidate_id_called,$request->date_process_called,$request->remarks_called,$request->invitation_process,$request->contact_person,$request->invitation_type);
        

        // param send email to user
        $paramEmail['requester_name']  = $job->requester_name;
        $paramEmail['requester_email']  = $job->requester_email;
        $paramEmail['request_job_number']  = $job->request_job_number;
        $paramEmail['name_holder'] = $candidate->name_holder;
        $paramEmail['process'] = $request->process;
        $paramEmail['email_candidate'] = $candidate->email;
        $paramEmail['position_name'] = $job->position_name;
        $paramEmail['required_date_fptk'] = $job->required_date_fptk;
        $paramEmail['result'] = $request->result;

        \DB::beginTransaction();
        try {

            if(empty($job))
            {
                return response()->json( array('status' => 'not_apply'),422);
            }

            $paramEmailCan['candidate'] = $candidate->name_holder;
            $paramEmailCan['address'] =  '';
            $paramEmailCan['job'] =$job->position_name;
            $paramEmailCan['interview_process'] =$request->invitation_process;
            $paramEmailCan['date_process'] =tanggal_indo_lengkap($dateProc);
            $paramEmailCan['time_process']=$timeProc;
            $paramEmailCan['candidate_id']=$candidate->candidate_id;
            $paramEmailCan['ktp_no']=$candidate->ktp_no;
            $paramEmailCan['msg']=$message['message_email'];

            if($request->process == 'CALLED')
            {   
                // send email
              


                $send = Mail::to($candidate->email)->send(new SendEmailToCandidate($paramEmailCan));


                if (!Mail::failures()) 
                {
                    // update table candidate
                    $candidate = Candidate::find($request->candidate_id_called);
                    $candidate->result = "SENT";
                    $candidate->invitation_process = $request->invitation_process;
                    $candidate->process = 'CALLED';
                    $candidate->contact_person = $request->contact_person;
                    $candidate->address_interview = $request->remarks_called;
                    $candidate->date_process = $request->date_process_called;
                    // $candidate->date_process = $dateProc;
                    $candidate->update_by = Auth::user()->user_name;
                    $candidate->update_time = date('Y-m-d H:i:s');
                    $candidate->save();
                    //

                    // input table history 
                    $history = new TrHistoryProcess;
                    $history->candidate_id = $request->candidate_id_called;
                    $history->history_result = "SENT";
                    $history->history_invitation_process =$request->invitation_process;
                    $history->history_process = "CALLED";
                    $history->history_date = $request->date_process_called;
                    $history->history_position_name = $job->position_name;
                    $history->history_contact_person = $request->contact_person;
                    $history->history_remarks = $request->remarks;
                    $history->history_address = $request->remarks_called;
                    $history->reason=$request->reason;
                    $history->iq = $request->iq;
                    $history->pauli = $request->pauli;
                    $history->disc = $request->disc;
                    $history->cbi = $request->cbi;
                    $history->insert_by = Auth::user()->user_name;
                    // $history->insert_time = date('Y-m-d H:i:s');
                    $history->save();
                    //

                    $paramEmail['result'] = $candidate->invitation_process;
                    $paramEmail['process'] = 'INVITE';
                    if(!empty($job->requester_email))
                    {
                       Mail::to($job->requester_email)->send(new SendEmailProcess($paramEmail));
                    }   

                    sendWA2($message['message_wa'],$candidate->name_holder,$dateProc,$timeProc,$request->invitation_process,$candidate->hp_1,$candidate->candidate_id,$candidate->ktp_no);

                }
                else
                {
                    return response()->json( array('status' =>'error'),422);
                }
            }
            else
            {
                 // update table candidate
                    $candidate = Candidate::find($request->candidate_id_called);
                    $candidate->result = $request->result;
                    $candidate->invitation_process = $request->invitation_process;
                    $candidate->process = $request->process;
                    $candidate->contact_person = $request->contact_person;
                    $candidate->address_interview = $request->remarks_called;
                    $candidate->date_process = $request->date_process;
                    // $candidate->date_process = $dateProc;
                    $candidate->update_by = Auth::user()->user_name;
                    $candidate->update_time = date('Y-m-d H:i:s');
                    $candidate->save();
                    //

                    // input table history 
                    $history = new TrHistoryProcess;
                    $history->candidate_id = $request->candidate_id_called;
                    $history->history_result = $request->result;
                    $history->history_invitation_process =$request->invitation_process;
                    $history->history_process = $request->process;
                    $history->history_date = $request->date_process;
                    $history->history_position_name = $job->position_name;
                    $history->history_contact_person = $request->contact_person;
                    $history->history_remarks = $request->remarks;
                    $history->history_address = $request->remarks_called;
                    $history->reason=$request->reason;
                    $history->iq = $request->iq;
                    $history->pauli = $request->pauli;
                    $history->disc = $request->disc;
                    $history->cbi = $request->cbi;
                    $history->insert_by = Auth::user()->user_name;
                    $history->insert_time = date('Y-m-d H:i:s');
                    $history->save();
            }


            if($request->file('attachment'))
            {
                $destinationPath = 'upload_file';
                $fileAttachment = uploadFile($request->file('attachment'),$destinationPath);
            }
            $file_att = (empty($fileAttachment)) ? '' : $fileAttachment;

            // // update table candidate
            // $candidate->result = $request->result;
            // $candidate->process = $request->process;
            // // $candidate->date_process = $request->date_process_called;
            // $candidate->date_process = $dateProc;
            // $candidate->remarks = $request->remarks;
            // $candidate->iq = $request->iq;
            // $candidate->pauli = $request->pauli;
            // $candidate->disc = $request->disc;
            // $candidate->cbi = $request->cbi;
            // $candidate->join_date = $request->join_date;
            $history->history_attachment = $file_att;
            // $candidate->update_by = Auth::user()->user_name;
            // $candidate->update_time = date('Y-m-d H:i:s');
            $history->save();
            //

    


           if( ($request->process == 'INITIAL INTERVIEW' && $request->result == 'PASSED') || ($request->process == 'INTERVIEW 1'  && $request->result == 'PASSED') || ($request->process == 'INTERVIEW 2'  && $request->result == 'PASSED') || ($request->process == 'INTERVIEW 3'  && $request->result == 'PASSED')  || ($request->process == 'MED CHECK'  && $request->result == 'PASSED') || ($request->process == 'OFFERING LETTER'  && $request->result == 'PASSED')  || ($request->process == 'PSYCHOTEST' && $request->result == 'PASSED') || ($request->process == 'HIRED' && $request->result == 'PASSED'))
            {
             
                if(!empty($job->requester_email))
                {
                   Mail::to($job->requester_email)->send(new SendEmailProcess($paramEmail));
                }
            }

            /* Integrasi ke psychotest */
            $integrasi=new IntegrationController;
            $result_integrasi_=$integrasi->postUserToPsikonogram(['candidate_id'=>$request->candidate_id_called]);

            $result_integrasi=json_decode($result_integrasi_,1);
            $result_integrasi_stat=2;
            $result_integrasi_msg='';
            if (isset($result_integrasi['stat'])) {
            	if ($result_integrasi['stat']==1||$result_integrasi['stat']==3) {
            		$result_integrasi_stat=1;
            		$result_integrasi_msg=$result_integrasi['msg'];
            	}
            }

            \DB::commit();
            return response()->json(['status'=>'success','result_integrasi_stat'=>$result_integrasi_stat,'result_integrasi_msg'=>$result_integrasi_msg],200);   
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status'=>$e->getMessage()],422);       
        }
    }

    public function get_result_process($id)
    {
        $getProces = Parameters::where('kategori','STATUS')
        ->where('nama',$id)->where('status',1)
        ->select('kode','nama','parameter_id')
        ->orderby('nama','asc')
        ->first();


        $data = Parameters::where('parent','ilike','%'.$getProces->parameter_id.',%')
        ->orderBy('no_urut','asc')
        ->get();

        if($data)
        {
            return response()->json(['status'=>'success','data'=>$data],200);   
        }        
        else
        {
            return response()->json( array('status'=>'error'),422);
        }
    }


    public function sendEmailMass(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'date_time' => 'required',
            'email_invitation'=>'required',
            'venue'=>'required',
            'contact_person'=>'required',
            'invitation_process'=>'required',
        ]);


        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }       


        $dom = new DOMDocument();

        $dateProc = date('Y-m-d', strtotime($request->date_time));
        $timeProc  = date('H:i:s', strtotime($request->date_time));

         $candidateID = explode(',',$request->candidate_id);


        $getCandidate =[];

        foreach ($candidateID as $value) 
        {
            $candidate = Candidate::find($value);
            $job = JobFptk::find($candidate->job_fptk_id);
            if(empty($job))
            {
                return response()->json(array('status'=>'job_not_apply','message'=>'job_not_apply','candidate'=>$candidate->name_holder),422); 
            }

            $saveHistory = new TrHistoryProcess;
            $saveHistory->candidate_id = $value;
            $saveHistory->history_date = $request->date_time;
            $saveHistory->history_process ="CALLED";
            $saveHistory->history_result = "SENT";
            $saveHistory->history_position_name = $job->position_name;
            $saveHistory->history_address = $request->venue;
            $saveHistory->iq = $request->iq;
            $saveHistory->pauli = $request->pauli;
            $saveHistory->disc = $request->disc;
            $saveHistory->cbi = $request->cbi;
            $saveHistory->history_contact_person = $request->contact_person;
            $saveHistory->history_invitation_process = $request->invitation_process;
            $saveHistory->insert_by = Auth::user()->user_name;
            $saveHistory->insert_time = date('Y-m-d H:i:s');
            $saveHistory->save();

            
            if(empty($job))
            {
                return response()->json( array('status' => 'not_apply'),422);
            }

           
            $html = $request->pesan;

            $dateProc = date('Y-m-d', strtotime($request->date_time));
            $timeProc  = date('H:i:s', strtotime($request->date_time));

            $candidateID = explode(',',$request->candidate_id);



            $message_ = '';
            if($request->invitation_type == 'video_call')
            {
                $message_  = $request->email_video_call;
            }        
            else
            {
                $message_ = $request->pesan;
            }

            $message = $this->message($request->pesan,$value,$request->date_time,$request->venue,$request->invitation_process,$request->contact_person);


            $updateCandidate = Candidate::find($value);
            $updateCandidate->process = 'CALLED';
            $updateCandidate->invitation_process = $request->invitation_process;
            $updateCandidate->result = "SENT";
            $updateCandidate->received_date = $request->date_time;
            $updateCandidate->join_date = $request->join_date;
            $updateCandidate->contact_person = $request->contact_person;
            $updateCandidate->address_interview = $request->venue;
            $updateCandidate->update_by = Auth::user()->user_name;
            $updateCandidate->update_time = date('Y-m-d H:i:s');

            $updateCandidate->save();    

            $paramEmailCan['candidate'] = $candidate->name_holder;
            $paramEmailCan['address'] =  $request->venue;
            $paramEmailCan['job'] =$job->position_name;
            $paramEmailCan['interview_process'] =$request->invitation_process;
            $paramEmailCan['date_process'] =tanggal_indo_lengkap($dateProc);
            $paramEmailCan['time_process']=$timeProc;
            $paramEmailCan['candidate_id']=$candidate->candidate_id;
            $paramEmailCan['ktp_no']=$candidate->ktp_no;
            $paramEmailCan['msg']=$message['message_email'];

            Mail::to($candidate->email)->send(new SendEmailToCandidate($paramEmailCan));
             if (count(Mail::failures()) > 0) {
                return response()->json(['status'=>'error'],422);
             }

            sendWA2($message['message_wa'],$candidate->name_holder,$dateProc,$timeProc,$request->invitation_process,$candidate->hp_1,$candidate->candidate_id,$candidate->ktp_no);
        }
        
        return response()->json(['status'=>'success'],200);
    }

    public function showNotification(Request $request)
    {
        $param = $request->dataSearch;
        $all = $request->all;
        $date = '';

        if(!empty($param))
        {
            $date = $param;
        }
        elseif($request->all)
        {
            $date = '';
        }
        else
        {
            $date = date('Y-m-d');
        }


        $data = DB::table('e_recruit.tr_history_process as a')
                ->join('e_recruit.tr_candidate as b','a.candidate_id','=','b.candidate_id')
                ->join('e_recruit.tr_job_fptk as c','c.job_fptk_id','=','b.job_fptk_id')
                ->select('*')
                ->whereIn('a.history_result',['ATTENDING','RESCHEDULE','NOT ATTENDING','REINVITED'])
                ->where('a.history_confirmation','ilike','%'.$date.'%')
                ->whereRaw("(a.history_confirmation != '' or a.history_confirmation is not null)")
                ->orderby('a.history_confirmation','desc')
                ->get();

    
        return Datatables::of($data)
        ->editColumn('request_job_number',function($data){
            $request_job_number = (empty($data->request_job_number)) ? "":strtoupper($data->request_job_number); 
            return $request_job_number;
        })->editColumn('history_position_name',function($data){
            $history_position_name = (empty($data->history_position_name)) ? "":strtoupper($data->history_position_name); 
            return $history_position_name;
        })->editColumn('history_date',function($data){
            $history_date = (empty($data->history_date)) ? "":date('Y-m-d H:i:s',strtotime($data->history_date)); 
            return $history_date;
        })->editColumn('history_invitation_process',function($data){
            $history_invitation_process = (empty($data->history_invitation_process)) ? "":$data->history_invitation_process; 
            return $history_invitation_process;
        })->editColumn('history_result',function($data){
            $history_result = (empty($data->history_result)) ? "":$data->history_result; 
            return $history_result;
        })->editColumn('history_remarks',function($data){
            $history_remarks = (empty($data->history_remarks)) ? "":$data->history_remarks; 
            return $history_remarks;
        })
        ->make(true);
    }

    public function send_reschedule(Request $request)
    {               
        $history = TrHistoryProcess::find($request->history_id);
        \DB::beginTransaction();
        try {

            $candidate = Candidate::find($history->candidate_id);
            $job = JobFptk::find($candidate->job_fptk_id);


            $candidate->result = "SENT";
            $candidate->invitation_process = $history->history_invitation_process;
            $candidate->process = 'CALLED';
            $candidate->update_by = Auth::user()->user_name;
            $candidate->update_time = date('Y-m-d H:i:s');

            $candidate->save();

            $timeProc  = date('H:i:s', strtotime($history->history_date));
            $history_date = $history->history_date;
            $confirm = '';

            if(!empty($request->time))
            {
                $history_date = $request->time;
                $timeProc  = date('H:i:s', strtotime($request->time));
                $historyUpd = TrHistoryProcess::find($request->history_id);
                $historyUpd->history_result = 'REINVITED';
                $historyUpd->save();
            }
            else
            {
                $historyUpd = TrHistoryProcess::find($request->history_id);
                $historyUpd->history_result = 'REINVITED';
                $historyUpd->save();   
            }
           

            $saveHistory = new TrHistoryProcess;
            $saveHistory->candidate_id = $history->candidate_id;
            $saveHistory->history_date = $history_date;
            $saveHistory->history_process ="CALLED";
            $saveHistory->history_result = "REINVITED";
            $saveHistory->history_position_name = $history->history_position_name;
            $saveHistory->history_address = $history->history_address;
            $saveHistory->history_contact_person = $history->history_contact_person;
            $saveHistory->history_invitation_process = $history->history_invitation_process;
            $saveHistory->insert_by = Auth::user()->user_name;
            $saveHistory->insert_time = date('Y-m-d H:i:s');
            $saveHistory->save();


            $msg = '<div style="font-size: 14px">
            <br>
            Dear <strong>'.$candidate->name_holder.'</strong>,
            <br>
            <br>
            Menindaklanjuti aplikasi yang sudah kami terima, kami menginformasikan bahwa kami mengundang untuk Proses Seleksi yang akan dilaksanakan pada :
            <br>
            <table>
                <tr>
                    <td>Hari, tanggal</td>
                    <td> : </td>
                    <td  id="tanggal">'.tanggal_indo_lengkap($history_date).'</td>
                </tr>

                <tr>
                    <td>Jam</td>
                    <td> : </td>
                    <td  id="jam">'.$timeProc.'</td>
                </tr>


                <tr>
                    <td>Lokasi</td>
                    <td> : </td>
                    <td id="lokasi">Jl. Raya Cakung Cilincing Km. 1,5, Jakarta 13910 Phone  : +62 21 460 2278 | Fax: +62 21 460 4866</td>
                </tr>

                <tr>
                    <td>Agenda</td>
                    <td> : </td>
                    <td id="process">'.$history->history_invitation_process.' </td>
                </tr>

                <tr>
                    <td>Bertemu dengan</td>
                    <td> : </td>
                    <td id="contact_person"> Tidak perlu diubah, contact person terisi otomatis berdasarkan Invitation Process  </td>
                </tr>
            </table>
            Silahkan scan barcode dibawah ini untuk absensi kehadiran disaat interview
            <br>
            klik link ini: '.url('qr-code?param1='.base64_encode($history->candidate_id).'&param2='.bcrypt($history->ktp_no)).'
            <br>
            Harap memberikan konfirmasi kehadiran pada laman E-Recruitment Puninar.                
            <br>
            Mohon scan barcode di bawah ini pada device yang tersedia untuk tanda kehadiran proses interview
            <br>
            '.url('form-candidate/confirmation').'
            <br>
            <br>
            Untuk detail informasi mengenai perusahaan kami, silahkan mengunjungi website www.puninar.com.
            <br>
            <br>
            </div>';

            $paramEmailCan['candidate'] = '';
            $paramEmailCan['address'] =  '';
            $paramEmailCan['job'] ='';
            $paramEmailCan['interview_process'] = '';
            $paramEmailCan['date_process'] = '';
            $paramEmailCan['time_process']='';
            $paramEmailCan['candidate_id']='';
            $paramEmailCan['ktp_no']='';
            $paramEmailCan['msg']=$msg;
            Mail::to($job->requester_email)->send(new SendEmailToCandidate($paramEmailCan));

            if(!empty($job->requester_email))
            {
                // param send email
                $paramEmail['requester_name']  = $job->requester_name;
                $paramEmail['requester_email']  = $job->requester_email;
                $paramEmail['request_job_number']  = $job->request_job_number;
                $paramEmail['name_holder'] = $candidate->name_holder;
                $paramEmail['position_name'] = $job->position_name;
                $paramEmail['process'] = "INVITE";
                $paramEmail['email_candidate'] = $candidate->email;
                $paramEmail['required_date_fptk'] = $job->required_date_fptk;
                $paramEmail['result'] = "REINVITED";
                // ini kirim ke user
                Mail::to($job->requester_email)->send(new SendEmailProcess($paramEmail));
            }

            \DB::commit();
            return response()->json(['status'=>'success'],200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status'=>$e->getMessage()],422);       
        }
        
    }

    public function send_decline(Request $request)
    {
        $history = TrHistoryProcess::find($request->history_id);
        $candidate = Candidate::find($history->candidate_id);
        $job = JobFptk::find($candidate->job_fptk_id);

        $candidate->result = "NOT ATTENDING";
        $candidate->invitation_process = $history->history_invitation_process;
        $candidate->process = 'CALLED';
        $candidate->update_by = Auth::user()->user_name;
        $candidate->update_time = date('Y-m-d H:i:s');

        $candidate->save();

        $saveHistory = new TrHistoryProcess;
        $saveHistory->candidate_id = $history->candidate_id;
        $saveHistory->history_date = $history->history_date;
        $saveHistory->history_process ="CALLED";
        $saveHistory->history_result = "NOT ATTENDING";
        $saveHistory->history_position_name = $history->history_position_name;
        $saveHistory->history_address = $history->history_address;
        $saveHistory->history_contact_person = $history->history_contact_person;
        $saveHistory->history_invitation_process = $history->history_invitation_process;
        $saveHistory->insert_by = Auth::user()->user_name;
        $saveHistory->insert_time = date('Y-m-d H:i:s');
        $saveHistory->save();


        $historyUpd = TrHistoryProcess::find($request->history_id);
        $historyUpd->history_process = "CALLED";
        $historyUpd->history_result = 'NOT ATTENDING';
        $historyUpd->save();   
        
    

        if(!empty($candidate->email))
        {    
            // param send email
            $paramEmail['requester_name']  = $job->requester_name;
            $paramEmail['requester_email']  = $job->requester_email;
            $paramEmail['request_job_number']  = $job->request_job_number;
            $paramEmail['name_holder'] = $candidate->name_holder;
            $paramEmail['position_name'] = $job->position_name;
            $paramEmail['process'] = "INVITE";
            $paramEmail['email_candidate'] = $candidate->email;
            $paramEmail['required_date_fptk'] = $job->required_date_fptk;
            $paramEmail['result'] = "NOT ATTENDING";
           

            // ini kirim ke candidate
            Mail::to($candidate->email)->send(new SendEmailFailedProcess($paramEmail));       
        }

        if(!empty($job->requester_email))
        {
            // param send email
            $paramEmail['requester_name']  = $job->requester_name;
            $paramEmail['requester_email']  = $job->requester_email;
            $paramEmail['request_job_number']  = $job->request_job_number;
            $paramEmail['name_holder'] = $candidate->name_holder;
            $paramEmail['position_name'] = $job->position_name;
            $paramEmail['process'] = "INVITE";
            $paramEmail['email_candidate'] = $candidate->email;
            $paramEmail['required_date_fptk'] = $job->required_date_fptk;
            $paramEmail['result'] = "NOT ATTENDING";
            // ini kirim ke user
            Mail::to($job->requester_email)->send(new SendEmailProcess($paramEmail));
        }

        
        return response()->json(['status'=>'success'],200);       
    }

    public function get_history_psychotest(Request $request)
    {
        $data = TrHistoryProcess::find($request->id);
        return response()->json(['status'=>'success','data'=>$data],200);       
    }

    public function view_all(Request $request)
    {
        $data['invitation_process'] = Parameters::where('kategori','STATUS')->where('status',1)->whereNotIn('nama',['CALLED','CV SORT','HIRED'])->get();
        $data['process'] = Parameters::status()->get();
        
        if($request->q == 'cv_in_all')
        {
            if(!empty($request->search_q))
            {
                 $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('name_holder','ilike','%'.$request->search_q.'%')
                ->orWhere('position_name','ilike','%'.$request->search_q.'%')
                ->orderBy('candidate_id','desc')
                ->whereNotNull('b.job_fptk_id')
                ->whereNotIn('result',['FAILED','CONSIDER'])
                ->paginate(10);
            }
            else
            {
                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->orderBy('candidate_id','desc')
                ->whereNotNull('b.job_fptk_id')
                ->whereNotIn('result',['FAILED','CONSIDER'])
                ->paginate(10);
            }
        }
        else if($request->q == 'invited_all')
        {
            if(!empty($request->search_q))
            {
                 $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                
                ->where('process','ilike','%CALLED%')
                ->whereIn('invitation_process',['INITIAL INTERVIEW','INTERVIEW 2','INTERVIEW 1','INTERVIEW 3','PSYCHOTEST'])
                ->where('name_holder','ilike','%'.$request->search_q.'%')
                ->orWhere('position_name','ilike','%'.$request->search_q.'%')
                ->paginate(10);
            }
            else
            {
                 $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('process','ilike','%CALLED%')
                ->whereIn('invitation_process',['INITIAL INTERVIEW','INTERVIEW 2','INTERVIEW 1','INTERVIEW 3','PSYCHOTEST'])
                ->paginate(10);
            }


        } 

        else if($request->q == 'hired_all')
        {
            if(!empty($request->search_q))
            {
                 $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('process','ilike','%HIRED%')
                ->where('name_holder','ilike','%'.$request->search_q.'%')
                ->orWhere('position_name','ilike','%'.$request->search_q.'%')
                ->paginate(10);
            }
            else
            {
                 $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('process','ilike','%HIRED%')
                ->paginate(10);

            }
        }


        else if($request->q == 'failed_all')
        {
            if(!empty($request->search_q))
            {
                 $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->rightJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('result','=','FAILED')
                ->where('name_holder','ilike','%'.$request->search_q.'%')
                ->orWhere('position_name','ilike','%'.$request->search_q.'%')
                ->paginate(10);
            }
            else
            {
                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->rightJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('result','=','FAILED')
                ->paginate(10);

            }
        }

        else if($request->q == 'registered')
        {
            if(!empty($request->search_q))
            {

                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->rightJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('process','REGISTRATION')
                ->where('name_holder','ilike','%'.$request->search_q.'%')
                ->orWhere('position_name','ilike','%'.$request->search_q.'%')
                ->paginate(10);
            }
            else
            {
                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->rightJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->paginate(10);
            }
        }

        else if($request->q == 'all_registered')
        {
            if(!empty($request->search_q))
            {

                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->rightJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('name_holder','ilike','%'.$request->search_q.'%')
                ->orWhere('position_name','ilike','%'.$request->search_q.'%')
                ->paginate(10);
            }
            else
            {
                
                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->rightJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->paginate(10);
            }
        }



    
        else if($request->q == 'released')
        {
            if(!empty($request->search_q))
            {
                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('publish','ilike','%publish%')
                ->whereNull('type_fptk')
                ->where('name_holder','ilike','%'.$request->search_q.'%')
                ->orWhere('position_name','ilike','%'.$request->search_q.'%')
                ->paginate(10);

            }
            else
            {
                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('publish','ilike','%publish%')
                ->whereNull('type_fptk')
                
                ->paginate(10);
            }
        }        

        else if($request->q == 'consider')
        {
            if(!empty($request->search_q))
            {
                $result =  \DB::table('e_recruit.tr_job_fptk as a')
                ->rightJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('result','ilike','%consider%')
                ->whereNull('type_fptk')
                ->where('name_holder','ilike','%'.$request->search_q.'%')
                ->orWhere('position_name','ilike','%'.$request->search_q.'%')
                ->paginate(10);

            }
            else
            {
                $result =  
                \DB::table('e_recruit.tr_job_fptk as a')
                ->rightJoin('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
                ->where('result','ilike','%consider%')
                ->paginate(10);
            }
        }

        $data['result'] = $result;
        return view('backend.rec_process.view_all_process',$data);
    }

    public function calender()
    {
        $data['candidate_schedule'] = Candidate::where('process','CALLED')->whereNotNull('link_video_call')->where('link_video_call','!=','')->get();
        return view('backend.rec_process.calender',$data);
    }

}