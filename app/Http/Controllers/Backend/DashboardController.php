<?php

namespace App\Http\Controllers\Backend;;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Candidate;
use App\Models\JobFptk;
use App\Models\User;
use App\Models\TrJobFptkLog;
use App\Models\TrHistoryProcess;
use App\Models\Parameters;
use App\Models\Tm_setting_banner;
use Auth;
use Validator;
use DB;
use Hash;
use File;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendConfirmationAttending;



class DashboardController extends Controller
{
    //
    protected $year;
    protected $division;
    protected $requester_name;
    protected $subco;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if(empty($request->year))
        {
            $this->year = date('Y');
        }
        else
        {
            $this->year = $request->year;
        }

        $this->division = (!empty($request->division)) ? $request->division : "";




        $data['source'] = Parameters::source()->get();
        $data['division'] = JobFptk::select('division')->groupBy('division')->whereNotNull('division')->get();
        $data['requester_name'] = JobFptk::select('requester_name')
                                    ->groupBy('requester_name')
                                    ->whereNotNull('requester_name')
                                    ->get();
        $data['subco'] = JobFptk::select('subco')
                            ->groupBy('subco')
                            ->orderBy('subco','desc')
                            ->get();
      
        $data['source_data'] = JobFptk::source_data($this->year,$request->division,$request->requester_name);

        $data['source_data_all'] =  JobFptk::source_data_all($this->year,$request->division,$request->requester_name);


 

        $data['all_candidate_source'] = Candidate::all();
        
        $data['open'] = JobFptk::open($this->year,$request->division,$request->requester_name);

        $data['closed'] = JobFptk::closed($this->year,$request->division,$request->requester_name);


        $data['drop'] =  JobFptk::drop($this->year,$request->division,$request->requester_name);
        $data['rejected'] = JobFptk::rejected($this->year,$request->division,$request->requester_name);

        // Jenins Kelamin
        $data['jenis_kelamin_hired'] = JobFptk::jenis_kelamin_hired($this->year,$request->division,$request->requester_name);

        $data['jenis_kelamin_all'] = JobFptk::jenis_kelamin_all($this->year,$request->division,$request->requester_name);



        // universitas
        $data['universitas_hired'] = JobFptk::universitas_hired($this->year,$request->division,$request->requester_name);

        

        $data['universitas_all'] = JobFptk::universitas_all($this->year,$request->division,$request->requester_name);


        // position name
        $data['position_name_hired'] =  JobFptk::position_name_hired($this->year,$request->division,$request->requester_name);



        $data['position_name_all'] = JobFptk::position_name_all($this->year,$request->division,$request->requester_name);


        // reason hiring
        $data['reason_hiring_hired'] = JobFptk::reason_hiring_hired($this->year,$request->division,$request->requester_name);


        $data['reason_hiring_all'] = JobFptk::reason_hiring_all($this->year,$request->division,$request->requester_name);


        // division
        $data['division_hired'] = JobFptk::division_hired($this->year,$request->division,$request->requester_name);
   

        $data['division_all'] = JobFptk::division_all($this->year,$request->division,$request->requester_name);



        // requester name
        $data['requester_name_hired'] =JobFptk::requester_name_hired($this->year,$request->division,$request->requester_name);


        $data['requester_name_all'] = JobFptk::requester_name_all($this->year,$request->division,$request->requester_name);


        // worklocation 
        $data['work_location_hired'] = JobFptk::work_location_hired($this->year,$request->division,$request->requester_name);





        $data['work_location_all'] =     JobFptk::work_location_hired($this->year,$request->division,$request->requester_name);

        $data['year_hired'] = JobFptk::with('candidate')
                                    ->whereHas('candidate', function ($query){
                                        $query->where('process','=','HIRED');
                                    })
                                    ->select(DB::raw('count(EXTRACT (YEAR FROM received_date_fptk)) AS jumlah_tahun, EXTRACT (YEAR FROM received_date_fptk) as tahun'))

                                    ->groupBy(DB::raw('EXTRACT (YEAR FROM received_date_fptk)'))
                                    ->get();       


        $data['year_all'] = JobFptk::select(DB::raw('count(EXTRACT (YEAR FROM received_date_fptk)) AS jumlah_tahun, EXTRACT (YEAR FROM received_date_fptk) as tahun'))
                                    ->groupBy(DB::raw('EXTRACT (YEAR FROM received_date_fptk)'))
                                    ->get();       


         // City
        $data['city_hired'] = Candidate::select(DB::raw('count(city) as tot_city,city'))
        ->where('process','=','HIRED')
        ->whereNotNull('city')
        ->groupBy('city')
        ->get();

        $data['city_all'] = Candidate::select(DB::raw('count(city) as tot_city,city'))
        ->whereNotNull('city')
        ->groupBy('city')
        ->get();

         // AGE
        $data['age_hired'] = Candidate::select(DB::raw("count(date_part('year',now()) - date_part('year',date_of_birth)) as tot_age,date_part('year',now()) - date_part('year',date_of_birth) as age"))
            ->where('process','=','HIRED')
            ->where(DB::raw("date_part('year',now()) - date_part('year',date_of_birth)"),'>',0)
            ->groupBy('candidate_id')
            ->get();

        $data['age_all'] = Candidate::select(DB::raw("count(date_part('year',now()) - date_part('year',date_of_birth)) as tot_age,date_part('year',now()) - date_part('year',date_of_birth) as age"))
        ->where(DB::raw("date_part('year',now()) - date_part('year',date_of_birth)"),'>',0)
        ->whereNotIn('process',['REGISTRATION'])
        ->groupBy(DB::raw("date_part('year',now()) - date_part('year',date_of_birth)"))
        ->get();

        $job_open = JobFptk::job_open($this->year,$request->division,$request->requester_name);


        $job_drop = JobFptk::job_drop($this->year,$request->division,$request->requester_name);
        $data['open_staff'] = $job_open;
        $data['closed_staff'] = JobFptk::closed_staff($this->year,$request->division,$request->requester_name);
        $data['drop_staff'] = $job_drop;
        $data['total_request_rejected'] = JobFptk::total_request_rejected($this->year,$request->division,$request->requester_name);
        
        $data['total_request_staff'] = $job_drop + $job_open + $data['closed_staff'] + $data['total_request_rejected'];

        return view('backend.dashboard.index_dashboard',$data);
    }


    public function getData(Request $request)
    {
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

    public function searchFPTK(Request $request)
    {
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
        return view('backend.dashboard.search_fptk',$data);
    }

    public function createUser()
    {
        return view('backend.dashboard.createUser');
    }

    public function actionCreateUser(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'level_user'=>'required',
            'email'=>'required|email',
            'effective_date'=>'required',
            'end_date'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        $user = new User;

        $user->name = $request->name;
        $user->nip = $request->nip;
        $user->level_user = $request->level_user;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->password = bcrypt('123qwe');
        $user->hp = $request->hp;
        $user->effective_date = $request->effective_date;
        $user->end_date = $request->end_date;
        $user->save();

       return response()->json(['status'=>'success'],200);
    }


    public function absensi(Request $request)
    {
        if(!empty($request->data_absensi) )
        {
            $data['id'] = $request->data_absensi;
            // $data['ktp_no'] = $request->param2;

            $id = base64_decode($data['id']);

            $candidate  = Candidate::with('job_fptk')->find($id);
            $fptk = JobFptk::find($candidate->job_fptk_id);

            // $ktp =  Hash::check($candidate->ktp_no,$data['ktp_no']);


            $exp = date('Y-m-d',strtotime($candidate->date_process."+1 days"));

            // if($ktp  || (strtotime($exp) >  strtotime(now())))
            if((strtotime($exp) >  strtotime(now())))
            {
                Session::put('confirmQR', 'Thank you for Comming'); 
                $candidate->status = 3;
                $candidate->result = "ATTENDING";
                $candidate->date_process = $candidate->date_process;
                $candidate->save();

                $data['requester_name'] = $candidate->job_fptk->requester_name;
                $data['name'] = $candidate->name_holder;
                $data['process'] = $candidate->invitation_process;
                Mail::to($fptk->requester_email)->send(new SendConfirmationAttending($data));
                return redirect('/dashboard/absensi');
            }
            else
            {
                return 'Sory candidate not found .. <a href='.url('/').'> Kembali </>';
            }  
        }
        
        return view('backend.dashboard.absensi');
    }


    public function absensiAll()
    {       
        return view('backend.dashboard.absensiAll');
    }

    public function getDataAbsensi(Request $request)
    {
        $param = $request->dataSearch;
        
        // $data['requester_name_hired_baru'] = DB::table('e_recruit.tr_job_fptk as a')
        // ->selectRaw('count (requester_name) as jumlah, a.requester_name, b.name')
        // ->join('e_recruit.tr_users as b', 'a.requester_name','b.nip')
        // ->where('type_fptk','outsource')
        // ->groupBy('a.requester_name','b.name')
        // ->get();  


        // $data =  Candidate::whereIn('process',['CALLED','INTERVIEW 1','PSYCHOTEST']);

        $data = 
        DB::table('e_recruit.tr_candidate as a')
        ->select('a.process', 'a.date_process', 'a.position_level','a.status','a.name_holder','a.invitation_process','b.project_name','b.cost_center','b.work_location','a.company_name','b.employment_type','b.request_job_number','b.position_name','a.salary','b.benefit','b.desc_benefit')
        ->join('e_recruit.tr_job_fptk as b','b.job_fptk_id','a.job_fptk_id')
        ->whereIn('a.process',['CALLED']);

        if(!empty($param))
        {
            $date = $param;
            $data->whereDate('date_process',$date)->get();
        }
        else
        {
            $data->get();
        }


        return Datatables::of($data)
        
        ->editColumn('process',function($data){
            if($data->process == 'CALLED')
            {
                return 'INVITED';    
            }
            else
            {
                return strtoupper($data->process);
            }
            
        })
        ->editColumn('date_process',function($data){
            return $data->date_process;
        })
        // ->editColumn('position_name',function($data){
        //     return strtoupper($data->job_fptk->position_name);
        // })
        ->editColumn('position_level',function($data){
            return $data->position_level;
        })
        ->editColumn('status',function($data){
            if($data->status == 3)
            {
                return 'HADIR';
            }
            else
            {
                return 'BELUM HADIR';
            }
        })
        ->make(true);
    }


    public function getDataAbsensiAll()
    {
        $dataAbsensiAll = DB::select("select a.process, a.date_process, a.position_level,a.status,a.name_holder,a.invitation_process,b.project_name,b.cost_center, b.work_location,a.company_name,b.employment_type,b.request_job_number,b.position_name,a.salary,b.benefit,b.desc_benefit from e_recruit.tr_candidate as a inner join e_recruit.tr_job_fptk as b on b.job_fptk_id=a.job_fptk_id where a.process in ('CALLED')");

        return Datatables::of($dataAbsensiAll)->make(true);
    }


    public function change_password()
    {
        return view('backend.dashboard.change_password');
    }


    public function action_change_password(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password'=>'required',
            'confirm_password'=>'required|same:new_password',
        ]);

        $password =  Hash::check($request->old_password,Auth::user()->password);

        if ($password) {
            $user = User::find(Auth::user()->id);
        }
        else
        {
            return response()->json( array('message' =>'Old password doesnt match','type'=>'old_password','status'=>'error_old_password'),422);
        }

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }
        
        $user = User::find(Auth::user()->user_id);
        $user->password = bcrypt($request->new_password);
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

       Auth::logout();
       return response()->json(['status'=>'success'],200);
    }

    public function setting_banner()
    {
        $data['data'] = \App\Models\Tm_setting_banner::orderBy('setting_banner_id','desc')->get();
        return view('backend.dashboard.setting_banner',$data);
    }

    public function action_setting_banner(Request $request)
    {
        if(!empty($request->setting_banner_id))
        {
            $validator =  Validator::make($request->all(), [
                'setting_banner_name' => 'required',
                'setting_banner_desc'=>'required',
                'setting_banner_type'=>'required',
                'status'=>'required',
            ]);    
        }
        else
        {
            $validator =  Validator::make($request->all(), [
                'setting_banner_name' => 'required',
                'setting_banner_desc'=>'required',
                'setting_banner_pict'=>'required|mimes:jpeg,bmp,png,jpg,mp4',
                'status'=>'required',
            ]);    
        }
        

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        $destinationPath = 'upload_file';
        if(!empty($request->setting_banner_id))
        {
        
            if(!empty($request->setting_banner_pict))
            {

                $fileNamePhoto = uploadFile($request->file('setting_banner_pict'),$destinationPath);   
                $setting_banner = \App\Models\Tm_setting_banner::find($request->setting_banner_id);
                File::delete($destinationPath.'/'.$setting_banner->setting_banner_pict);
                $setting_banner->setting_banner_name = $request->setting_banner_name;
                $setting_banner->setting_banner_desc = $request->setting_banner_desc;
                $setting_banner->setting_banner_type = $request->setting_banner_type;
                $setting_banner->status = $request->status;
                $setting_banner->setting_banner_pict = $fileNamePhoto;
                $setting_banner->save();

            }
            else
            {
                $setting_banner = \App\Models\Tm_setting_banner::find($request->setting_banner_id);
                $setting_banner->setting_banner_name = $request->setting_banner_name;
                $setting_banner->setting_banner_desc = $request->setting_banner_desc;
                $setting_banner->setting_banner_type = $request->setting_banner_type;
                $setting_banner->status = $request->status;
                $setting_banner->save();   
            }
            return response()->json(['status'=>'success'],200);   
        }
        else
        {
            $fileNamePhoto = uploadFile($request->file('setting_banner_pict'),$destinationPath);
            $setting_banner = new \App\Models\Tm_setting_banner;
            $setting_banner->setting_banner_name = $request->setting_banner_name;
            $setting_banner->setting_banner_desc = $request->setting_banner_desc;
            $setting_banner->setting_banner_type = $request->setting_banner_type;
            $setting_banner->status = $request->status;
            $setting_banner->setting_banner_pict = $fileNamePhoto;
            $setting_banner->save();
            return response()->json(['status'=>'success'],200);   
        }


      
    }

    public function delete_setting_banner($id)
    {
        if(!empty($id))
        {
            $destinationPath = 'upload_file';
            $setting_banner =  \App\Models\Tm_setting_banner::find($id);
            $setting_banner->delete();
            File::delete($destinationPath.'/'.$setting_banner->setting_banner_pict);
            return response()->json(['status'=>'success'],200);    
        }
        else
        {
            return response()->json(['status'=>'fail'],422);       
        }
        
    }

    public function edit_setting_banner(Request $request)
    {
        $data = \App\Models\Tm_setting_banner::find($request->id);
        return response()->json(['status'=>'success','data'=>$data],200);    
    }

    public function dashboard_outsource(Request $request)
    {
        if(empty($request->year))
        {
            $this->year = date('Y');
        }
        else
        {
            $this->year = $request->year;
        }
		
        // =============================== FULFILLMENT  =======================================
        // FPTK
        $data['new'] = JobFptk::new_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        $data['open'] = JobFptk::open_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        $data['draft'] = JobFptk::draft_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        $data['closed'] = JobFptk::closed_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        $data['rejected'] = JobFptk::rejected_non_employee($this->year,$request->division,$request->requester_name,$request->subco);

        // Man Power
        $data['new_man_power'] = JobFptk::job_new_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        $data['open_man_power'] = JobFptk::job_open_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        $data['closed_man_power'] = JobFptk::closed_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        $data['total_request_rejected_man_power'] = JobFptk::total_request_rejected_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        // =============================== END FULFILLMENT  =======================================


        /* ====================================== OPEN & CLOSE  ============================ */
        $job_open_non_employee = JobFptk::job_open_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        
        // $job_drop = JobFptk::job_drop_non_employee($this->year,$request->division,$request->requester_name,$request->subco);

        $data['open_staff'] = $job_open_non_employee;
        $data['closed_staff'] = JobFptk::closed_staff_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        // $data['drop_staff'] = $job_drop;
        $data['total_request_rejected'] = JobFptk::total_request_rejected_non_employee($this->year,$request->division,$request->requester_name,$request->subco);
        /* ====================================== END OPEN & CLOSE  ============================ */

        /* ======================================  PROJECT NAME   ============================ */
        // $data['project'] = DB::table('e_recruit.tr_job_fptk')
        // ->selectRaw('count (project_name) as jumlah,project_name ')
        // ->where('type_fptk','outsource')
        // ->groupBy('project_name')
        // ->get();     

        $data['project'] = JobFptk::project_name_non_employee($this->year,$request->subco);

        $data['project_employee'] = DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('count (project_name) as project_name,b.name_holder ')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('type_fptk','outsource')
        ->groupBy('a.project_name','b.name_holder')
        ->get();
        /* ================================ END PROJECT NAME  ===============================*/


        /* ================================== POSITION  ===================================================*/
        // $data['position'] = DB::table('e_recruit.tr_job_fptk')
        // ->selectRaw('count (position_name) as jumlah,position_name ')
        // ->where('type_fptk','outsource')
        // ->groupBy('position_name')
        // ->get();  

        $data['position'] = JobFptk::position_non_employee($this->year,$request->subco);   


        $data['position_employee'] = DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('count (position_name) as position_name,b.name_holder ')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('type_fptk','outsource')
        ->groupBy('a.position_name','b.name_holder')
        ->get();
        /* ================================== END POSITION  ===================================================*/


        /* ================================== REQUESTER  ===================================================*/
        // $data['requester_name_hired_baru'] = DB::table('e_recruit.tr_job_fptk as a')
        // ->selectRaw('count (requester_name) as jumlah, a.requester_name, b.name')
        // ->join('e_recruit.tr_users as b', 'a.requester_name','b.nip')
        // ->where('type_fptk','outsource')
        // ->groupBy('a.requester_name','b.name')
        // ->get();   

        $data['requester_name_hired_baru'] = JobFptk::requester_non_employee($this->year,$request->subco);     

        $data['requester_name_all_baru'] = DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('count (requester_name) as jumlah, a.requester_name')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('type_fptk','outsource')
        ->groupBy('a.requester_name')
        ->get();
        /* ================================== END REQUESTER  ===================================================*/


        /* ================================== DIVISION  ===================================================*/
        // $data['division'] = DB::table('e_recruit.tr_job_fptk')
        // ->selectRaw('count (division) as jumlah,division ')
        // ->where('type_fptk','outsource')
        // ->groupBy('division')
        // ->get();   

        $data['division'] = JobFptk::division_non_employee($this->year,$request->subco);     

        $data['division_employee'] = DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('count (division) as division , b.name_holder')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('type_fptk','outsource')
        ->groupBy('a.division','b.name_holder')
        ->get();
        /* ================================== END DIVISION  ===================================================*/



        /* ================================== COST CENTER  ===================================================*/
        // $data['cost_center'] = DB::table('e_recruit.tr_job_fptk')
        // ->selectRaw('count (cost_center) as jumlah,cost_center ')
        // ->where('type_fptk','outsource')
        // ->groupBy('cost_center')
        // ->get();     

        $data['cost_center'] = JobFptk::cost_center_non_employee($this->year,$request->subco);     

        $data['cost_center_employee'] = DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('count (cost_center) as cost_center , b.name_holder')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('type_fptk','outsource')
        ->groupBy('a.cost_center','b.name_holder')
        ->get();
        /* ================================== END COST CENTER  ===================================================*/


        /* ================================== PT OS  ===================================================*/
        // $data['pt_os'] = DB::table('e_recruit.tr_job_fptk as a')
        // ->selectRaw('count (company_name) as count_company_name ,b.company_name')
        // ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        // ->where('type_fptk','outsource')
        // ->groupBy('b.company_name')
        // ->get();

        $data['pt_os'] = JobFptk::pt_os_non_employee($this->year,$request->subco);     

        $data['pt_os_employee'] = DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('count (company_name) as count_company_name ,b.company_name, b.name_holder')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('type_fptk','outsource')
        ->groupBy('b.company_name','b.name_holder')
        ->get();
        /* ================================== END PT OS  ===================================================*/
              

        /* ================================== WORK LOCATION  ===================================================*/
        // $data['work_location'] = DB::table('e_recruit.tr_job_fptk')
        // ->selectRaw('count (work_location) as jumlah,work_location ')
        // ->where('type_fptk','outsource')
        // ->groupBy('work_location')
        // ->get();   

        $data['work_location'] = JobFptk::work_location_non_employee($this->year,$request->subco);     

        $data['work_location_employee'] = DB::table('e_recruit.tr_job_fptk as a')
        ->selectRaw('count (work_location) as work_location , b.name_holder')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('type_fptk','outsource')
        ->groupBy('a.work_location','b.name_holder')
        ->get();
        /* ================================== END WORK LOCATION  ===================================================*/

        return view('backend.dashboard.dashboard_outsource',$data);        
    }
}