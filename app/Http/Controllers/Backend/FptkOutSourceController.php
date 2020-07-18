<?php

namespace App\Http\Controllers\Backend;;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;

class FptkOutSourceController extends Controller
{
      public $position = ['Accessories Foreman','Accessories Operator','Account Support Staff','Accounting Administrator','Admin LOLO','Administation Support Staff','Administration Electrolux','Administration Leader','Administration WH Volvo','Administrator Inbound','Administrator OTM','Administrator Outbound','Administrator Shell','AdministratorKomisi','AP  Staff','Apprentice','Bandabags Fieldman','Billing & AR Staff','Cash Management Staff','Checker - Shell','Checker Inbound','Checker Outbound','Cleaning Service','Clinic Staff','CMT Staff - Car Carrier','CMT Staff - Holcim Trailer','CMT Staff - Milkrun','CMT Staff - Motor Carrier','CMT Staff - Pandaan','CMT Staff - Trailer','CMT Staff - Wingbox','CMT Staff- BAT','Custom Clearance Staff','Customer Service','Decanting Foreman','Delivery Foreman','Departure Control Staff','Discharge','Document Pooling Staff','Driver','Driver Management Staff','Driver Management Staff','Driver Openyard','EDI Staff','Facility Support Staff','Fieldman','Fieldman MC - Honda','Fieldman MC - Yamaha','Fieldman MC - YMH Inter WH','Fieldman Narogong','Fieldman SC - ADM','Fieldman SC - TAM','Fieldman TMMIN ADM FSCM','Finance Controller Staff','Foreman','Foreman Milkrun - TMMIN ADM FSCM','Foreman Motor Carrier','Foreman SC - Retail','Foreman SC - TAM & ADM','Forklift Operator','Forklift Operator - Decanting','Forklift Operator WH Volvo','Fuelman','GA Staff','Gardener','General Administrator','General Services Staff','Helper','HSSE Staff','Inventory Administrator','Jaminan Kontainer Staff','Kerani','Lab Staff','Loader','Maintenance Administrator','Maintenance Support Staff','Management Improvement','Mechanician','Messenger','Motoris Klotok','Office Boy','Office Girl','Operation Malang Fieldman','Operation Mojosari Fieldman','Operation Tuban Fieldman','Operational Staff','Operator Openyard','Operator Warehouse','Order Monitoring Staff','P2H Staff','Packing Operator','Petugas Rumah Tangga','Picker','Planning & OTM Staff','Planning Staff','POD Return Monitoring Staff','Pool Administrator','Procurement Staff','Procurement & VM Dept Head','Receiving Foreman','Receiving Operator','Receiving Team Leader','Receptionist','Return Administrator','Safety Staff','Safetyman','Sales Support','Scheduller Shell','Security','Security Cakung','Security Nagrak','Spareparts Administrator','SPK Administrator','Stock Controller','Supply Chain Management','Tax Administrator','Transport Staff','Trucking Monitoring  Administrator','Vanning Operator','VAS Member (Daily Worker)','Vehicle Management Staff','Vendor Management Administrator','Vendor Management Staff','Warehouse Administrator','Welder','Welder Foreman','Workshop Administrator'];

      public $location = ['BALIKPAPAN','BANDUNG','BANJARMASIN','BOGOR','CAKUNG','CIBINONG','CIKANDE','CIKARANG','CILEGON','GRESIK','JAKARTA','JAMBI','KELANIS','MAKASSAR','MALANG','MARUNDA','MEDAN','NAGRAK','NAROGONG','PANDAAN','PERAK','SEMARANG','TANJUNG PRIOK','TUBAN','KERAWANG','OTHERS'];

      public $division = ['BG1','BG3','LSS','QHSE','HCGA','FINANCE & ACCOUNTING','LSS CC','BG2','IT','PFU','MARKETING','LSB','OPERATION'];

      public $pt = ['PT. ALFA REKA USAHA','PT. ANUGERAH INSANI SEJAHTERA','PT. BANGKIT KARUNIA ABADI','PT. CAHAYA BETANG ABADI','PT. CAHAYA UTAMA','PT. CENTRAL CIPTA SECURINDO','PT. CITRA AUDURI','PT. GANESHA HUMANIKA','PT. GLOBAL SECONT','PT. MULTI PERKASA ABADI SEMESTA BANJARMASIN','PT. NEW BORNEO RESOURCES','PT. PRODUKTIF CITRA SUKSES','PT. PUTRA NUSA SEJATI','PT. SAKTI PURWA MUKTI','OTHERS'];

      public $project =  
       ['BAYER','SSC','VOLVO','WORKSHOP','YAMAHA','YAMAHA DEPO','ACCOUNTING','ADMIN SALES','ADMIN TAX','APL','AUTOMOTIVE','BAG','BANDABAGS','BAT','BEKO','BLIBLI','BLUESCOPE','BUMA','CAR CARRIER','CHEVRON','CLARIANT','CMT','CUSTOMS CLEARANCE BALIKPAPAN','DEPT IT','ELECTROLUX','ELNUSA','ESTATE','EX PROJECT'
      ,'EXIM','F&B','FINANCE','FUELLER','GA BALIKPAPAN' ,'GENERAL AFFAIR','GENERAL SERVICE','HALLO BANANA','HCGA','HEAVY EQUIPMENT','HOLCIM MIXER','HOLCIM,TRAILER','HSSE BALIKPAPAN','IMS CILEGON','INDOFOOD','KEPPEL','LAZADA','LINDE','LUBRICANT','MAINTENANCE','MAKASSAR','MAZDA','MBI','MERCY','MI BALIKPAPAN','MILKRUN','MILKRUN (KAYABA)','MOTOR CARRIER','NISSAN','OFFICE SBY','OPERATION','PETRONAS','PIR BPN','PLB','POOL','POOL CILEGON','POOL PANDAAN','PROCUREMENT','PROCUREMENT BALIKPAPAN','PROJECT MAZDA','QHSE','RB','RM MEDAN','SALES SUPPORT','SCHLUMBERGER','SHELL','SOKONINDO','SSC','TATA','TAX','TOTAL','TRAILER','TRANSPORT BALIKPAPAN','TRANSPORT PROJECT','VENDOR MANAGEMENT','VOLVO','WH BUMA BALIKPAPAN','WH PBU BALIKPAPAN','WH SCANIA BALIKPAPAN','WH SHELL BALIKPAPAN','WH VOLVO BALIKPAPAN','WING BOX','WORKSHOP','YAMAHA','YAMAHA DC','YAMAHA DEPO','YAMAHA DEPO BANDUNG ','YAMAHA DEPO JAKARTA & HASJRAT','SEB','BRIDGESTONE','OTHERS'];

      public $cost_center = ['PUNINAR SARANARAYA','PUNINAR JAYA','MULTILAND','PUNINAR INFINITE RAYA','PUNINAR FUELLER','PUNINAR MITRA ABADI','LSBL','OTHERS'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

      $get_user = \App\Models\User::where('username',Auth::user()->username)->first();
      $get_parent = \App\Models\User::where('username',$get_user->parent_user)->first();
      $result = 
      \App\Models\JobFptk::where('type_fptk','outsource')->orderBy('job_fptk_id','desc');
      $data['get_data'] = $result->get();
      return view('backend.candidate_outsource.index',$data);
    }

    public function add_fptk_resource(Request $request)
    {
      $data['position'] = $this->position;
      $data['location'] = $this->location;
      $data['division'] = $this->division;
      $data['project'] =  $this->project;
      $data['pt'] = $this->pt;
      $data['cost_center'] = $this->cost_center;
      $data['education']  = \App\Models\MasterSunfish::education();
      $data['user'] = \App\Models\User::all();
      $data['gender']  = \App\Models\Parameters::gender()->get();
      $data['major']  = \App\Models\MasterSunfish::major();
      return view('backend.candidate_outsource.create',$data);
    }


     /* function generate product number */
    public function job_number()
    {
        $query = \App\Models\JobFptk::
        where('request_job_number','ilike','%'.date('Ymd').'%') 
        ->where('request_job_number','not ilike','%deleted%') 
        ->orderBy('request_job_number','desc')
        ->first();
        if(!empty($query))
        {
            $get_code = substr($query->request_job_number, -3);
            $max = ((int)$get_code) + 1;
            return 'ROS'.date('Ymd').sprintf("%03s",$max);
        }
        else
        {
            return 'ROS'.date('Ymd')."001";
        }
    }

    public function save_fptk_outsource(Request $request)
    {

        $this->validate($request, [
            'position_name'    => 'required',
            'request_reason'  => 'required',
            'requested_staff'              => 'required',
            'work_location'        => 'required',
            'cost_center'      => 'required',
            'project_name'      => 'required',
            'education'            => 'required',
            'major'            => 'required',
            'description'            => 'required',
            'division'            => 'required',
            'employment_type'            => 'required',
            'subco'            => 'required',
            'required_date_fptk'            => 'required',
            // 'edu_university' => 'required',
        ]);

        if($request->request_reason == 'other')
        {
            $this->validate($request, [
              'other_request_reason'    => 'required',
          ]);
        }

        if($request->request_reason == 'replacement')
        {
            $this->validate($request, [
              'employee_name_replace'    => 'required',
          ]);
        }

        if($request->work_location == 'OTHERS')
        {
            $this->validate($request, [
              'other_work_location'    => 'required',
          ]);
        }

        if($request->project_name == 'OTHERS')
        {
            $this->validate($request, [
              'other_project'    => 'required',
          ]);
        }

        if($request->cost_center == 'OTHERS')
        {
            $this->validate($request, [
              'other_cost_center'    => 'required',
          ]);
        }

        if($request->major == 'Other')
        {
            $this->validate($request, [
              'other_major'    => 'required',
          ]);
        }

      $fptk = new \App\Models\JobFptk;
        $fptk->request_job_number = $this->job_number();
        $fptk->position_name = $request->position_name;
        $fptk->division = $request->division;
        $fptk->request_reason = $request->request_reason;
        $fptk->requested_staff = $request->requested_staff;
        $fptk->actual_staff = $request->requested_staff;
        $fptk->work_location = $request->work_location;
        $fptk->cost_center = $request->cost_center;
        $fptk->project_name = $request->project_name;
        $fptk->recruitment_type = $request->recruitment_type;
        $fptk->required_date_fptk = $request->required_date_fptk;
        $fptk->employment_type = $request->employment_type;
        $fptk->subco = $request->subco;
        $fptk->description = $request->description;
        $fptk->education = $request->education;
        $fptk->major = $request->major;
        $fptk->experience_year = $request->experience_year;
        $fptk->age = $request->age;
        $fptk->gender = $request->gender;
        $fptk->skill = $request->skill;
        $fptk->type_fptk = 'outsource';
        $fptk->status =$request->status;
        $fptk->major = $request->major;
        $fptk->employee_name_replace = $request->employee_name_replace;
        $fptk->other_project = $request->other_project;
        $fptk->other_request_reason = $request->other_request_reason;
        $fptk->other_work_location = $request->other_work_location;
        $fptk->other_cost_center = $request->other_cost_center;
        $fptk->other_major = $request->other_major;
        $fptk->requester_email = Auth::user()->email;
        $fptk->requester_name = Auth::user()->username;
        $fptk->insert_by = Auth::user()->email;
        $fptk->insert_time = date('Y-m-d H:i:s');
        $fptk->save();  

        return response()->json(['status'=>'success'],200);
    }

    public function edit_fptk_outsource($id)
    {
      $data['position'] = $this->position;
      $data['location'] = \App\Models\JobFptk::select('work_location')->groupBy('work_location')->whereNotNull('work_location')->get();
      $data['education']  = \App\Models\MasterSunfish::education();
      $data['gender']  = \App\Models\Parameters::gender()->get();
      $data['division']  = $this->division;
      $data['cost_center'] = $this->cost_center;
      $data['project'] = $this->project;
      $data['major']  = \App\Models\MasterSunfish::major();
      $data['edit_data'] = \App\Models\JobFptk::with('candidate')->where('job_fptk_id',$id)->first();
      return view('backend.candidate_outsource.edit',$data);
    }


    public function assessment_fptk_outsource($id)
    {
      $data['position'] = $this->position;
      $data['location'] = \App\Models\JobFptk::select('work_location')->groupBy('work_location')->whereNotNull('work_location')->get();
      $data['education']  = \App\Models\MasterSunfish::education();
      $data['gender']  = \App\Models\Parameters::gender()->get();
      $data['division']  = $this->division;
      $data['cost_center'] = $this->cost_center;
      $data['project'] = $this->project;
      $data['major']  = \App\Models\MasterSunfish::major();
      $data['edit_data'] = \App\Models\JobFptk::with('candidate')->where('job_fptk_id',$id)->first();
      return view('backend.candidate_outsource.assessment',$data);
    }

    public function delete_fptk_outsource($id)
    { 
      $del  = \App\Models\JobFptk::find($id); 
      $del->delete_by = Auth::user()->email;
      $del->delete_time = date('Y-m-d H:i:s');
      $del->save();
      // $del->delete();
      return response()->json(['status'=>'success'],200);
    }


    public function update_fptk(Request $request)
    {
          $this->validate($request, [
            'position_name'    => 'required',
            'request_reason'  => 'required',
            'requested_staff'              => 'required',
            'work_location'        => 'required',
            'cost_center'      => 'required',
            'project_name'      => 'required',
            'education'            => 'required',
            'major'            => 'required',
            'subco'            => 'required',
            'description'            => 'required',
            // 'edu_university' => 'required',
        ]);

        

        \DB::beginTransaction();
        try {
              $fptk =  \App\Models\JobFptk::find($request->job_fptk_id);
              $fptk->request_job_number = $request->request_job_number;
              $fptk->position_name = $request->position_name;
              $fptk->division = $request->division;
              $fptk->request_reason = $request->request_reason;
              $fptk->requested_staff = $request->requested_staff;
              $fptk->actual_staff = $request->requested_staff;
              $fptk->work_location = $request->work_location;
              $fptk->cost_center = $request->cost_center;
              $fptk->project_name = $request->project_name;
              $fptk->recruitment_type = $request->recruitment_type;
              $fptk->required_date_fptk = $request->required_date_fptk;
              $fptk->employment_type = $request->employment_type;
              $fptk->subco = $request->subco;
              $fptk->description = $request->description;
              $fptk->education = $request->education;
              $fptk->major = $request->major;
              $fptk->experience_year = $request->experience_year;
              $fptk->age = $request->age;
              $fptk->gender = $request->gender;
              $fptk->skill = $request->skill;
              $fptk->type_fptk = 'outsource';
              $fptk->status =$request->status;
              $fptk->employee_name_replace =$request->employee_name_replace;
              $fptk->other_project =$request->other_project;
              $fptk->other_request_reason =$request->other_request_reason;
              $fptk->other_work_location =$request->other_work_location;
              $fptk->other_cost_center =$request->other_cost_center;
              $fptk->other_major =$request->other_major;
              $fptk->major = $request->major;
              $fptk->requester_email = Auth::user()->email;
              $fptk->requester_name = Auth::user()->username;
              $fptk->insert_by = Auth::user()->email;
              $fptk->insert_time = date('Y-m-d H:i:s');
              $fptk->save();  
        
           \DB::commit();
            return response()->json(['status'=>'success']);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status'=>$e->getMessage()],422);       
        }

    }

    public function update_fptk_outsource(Request $request)
    {

        if($request->approval_status == 'rejected')
        {
            $this->validate($request, [
                'approval_status'    => 'required',
                'approval_desc'  => 'required',
            ]);
        }
        else
        {
            $this->validate($request, [
                'approval_status'    => 'required',
                // 'approval_desc'  => 'required',
            ]);
        }

        \DB::beginTransaction();
        try {

          foreach ($request->approval_id as $key => $value) 
          {
            if(!empty($value))
            {
                $approval =  \App\Models\TrApproval::find($value);
                $approval->approval_date = date('Y-m-d H:i:s');
                $approval->approval_status = $request->approval_status;
                $approval->approval_desc = $request->approval_desc;
                $approval->user_id = $request->user_id[$key];
                $approval->job_fptk_id = $request->job_fptk_id;
                $approval->save();    
            }
            else if($request->user_id[$key] == Auth::user()->user_id)
            {
                $approval =  new \App\Models\TrApproval;
                $approval->approval_date = date('Y-m-d H:i:s');
                $approval->approval_status = $request->approval_status;
                $approval->approval_desc = $request->approval_desc;
                $approval->user_id = $request->user_id[$key];
                $approval->job_fptk_id = $request->job_fptk_id;
                $approval->save();  
            }  
          }

          $cek_val = \DB::table('e_recruit.tr_approval')->whereRaw('job_fptk_id = '.$request->job_fptk_id.'')->first();
           
          $cek_approval = \DB::select("
         SELECT count(*) AS count
               FROM ( SELECT tr_approval.approval_id,
                        tr_approval.job_fptk_id,
                        tr_approval.user_id,
                        tr_approval.approval_status,
                        tr_approval.approval_date,
                        tr_approval.approval_desc
                       FROM e_recruit.tr_approval
                    UNION ALL
                     SELECT a_1.approval_id,
                        a_1.job_fptk_id,
                        a_1.user_id,
                        a_1.approval_status,
                        a_1.approval_date,
                        a_1.approval_desc
                       FROM e_recruit.tr_approval a_1
                         left JOIN e_recruit.tr_users c ON a_1.user_id = c.user_id
                      WHERE c.position::text = 'HUMAN CAPITAL SERVICES DEPARTMENT HEAD'::text
                      and c.position::text = 'HUMAN CAPITAL DEVELOPMENT DEPT HEAD'::text
                      and c.position::text = 'VICE PRESIDENT DIRECTOR'::text
                      ) a
              WHERE a.approval_status IS NULL OR a.approval_status::text = 'approved'::text
              and job_fptk_id = '".$request->job_fptk_id."'
          ");




          if($request->approval_status == 'rejected')
          {
              $fptk =  \App\Models\JobFptk::find($request->job_fptk_id);
              $fptk->status  = 'rejected';
              $fptk->save();  
          }

          if(!empty($cek_val))
          {
            if($cek_approval[0]->count == 4)
            {
                $fptk =  \App\Models\JobFptk::find($request->job_fptk_id);
                $fptk->status  = 'open';
                $fptk->save();  
            }
          }
          

            \DB::commit();
            return response()->json(['status'=>'success']);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status'=>$e->getMessage()],422);       
        }

    }

    public function approved_fptk_outsource(Request $request)
    {
      $id = $request->id;
      $data['location'] = \App\Models\JobFptk::select('work_location')->groupBy('work_location')->whereNotNull('work_location')->get();
      $data['get_job'] = \App\Models\JobFptk::find($request->id);

      $data['get_emp'] = \App\Models\User::where('username',$data['get_job']->requester_name)->first();

      $parent_user = (empty($data['get_emp'])) ? 0 : $data['get_emp']->parent_user;

      $data['get_head'] = \App\Models\User::where('username',$parent_user)->get();

      $data['get_hr'] = 
      \App\Models\User
      ::selectRaw(" case 
        when position = 'HUMAN CAPITAL SERVICES DEPARTMENT HEAD' 
        then 
          '1'
       when position = 'HUMAN CAPITAL DEVELOPMENT DEPT HEAD' 
        then 
          '3'    
        when position = 'VICE PRESIDENT DIRECTOR' 
        then 
          '2'
        else
          position
        end as urutan,*")
      ->whereIn('position',['HUMAN CAPITAL DEVELOPMENT DEPT HEAD','VICE PRESIDENT DIRECTOR','HUMAN CAPITAL SERVICES DEPARTMENT HEAD'])->orderBy('urutan','asc')->get();

      $data['education']  = \App\Models\MasterSunfish::education();
      $data['gender']  = \App\Models\Parameters::gender()->get();
      $data['major']  = \App\Models\MasterSunfish::major();
      $data['edit_data'] = \App\Models\JobFptk::where('job_fptk_id',$id)->first();
      return view('backend.candidate_outsource.detail',$data);
    }


    public function view_fptk_outsource_candidate(Request $request)
    {
      $id = $request->id;
      $data['get_job'] = \App\Models\JobFptk::find($request->id);
      $parent_user = (empty($data['get_emp'])) ? 0 : $data['get_emp']->parent_user;

      $data['get_head'] = \App\Models\User::where('username',$parent_user)->get();

      $data['get_hr'] = 
      \App\Models\User
      ::selectRaw(" case 
        when position = 'HUMAN CAPITAL SERVICES DEPARTMENT HEAD' 
        then 
          '1'
       when position = 'HUMAN CAPITAL DEVELOPMENT DEPT HEAD' 
        then 
          '3'    
        when position = 'VICE PRESIDENT DIRECTOR' 
        then 
          '2'
        else
          position
        end as urutan,*")
      ->whereIn('position',['HUMAN CAPITAL DEVELOPMENT DEPT HEAD','VICE PRESIDENT DIRECTOR','HUMAN CAPITAL SERVICES DEPARTMENT HEAD'])->orderBy('urutan','asc')->get();


      $cek_candidate = \DB::select("select distinct(a.candidate_id), b.job_fptk_id, c.position_name, b.name_holder, b.email from e_recruit.tr_history_process as a 
        inner join e_recruit.tr_candidate as b on a.candidate_id = b.candidate_id 
        inner join e_recruit.tr_job_fptk as c on b.job_fptk_id = c.job_fptk_id 
        where b.job_fptk_id = '".$id."'");

      $id_candidate = $cek_candidate;

      if($id_candidate == true)
      {
        $id_pelamar = $cek_candidate[0]->candidate_id;
      }
      else
      {
        $id_pelamar = 0;
      }

      $data_candi = \DB::select("select distinct(a.candidate_id), b.name_holder from e_recruit.tr_history_process as a
        inner join e_recruit.tr_candidate as b on a.candidate_id = b.candidate_id
        inner join e_recruit.tr_job_fptk as c on b.job_fptk_id = c.job_fptk_id
        where b.job_fptk_id = '".$id."' and a.candidate_id = '".$id_pelamar."' ");


      // $cek_history_candidate = \DB::select("select b.job_fptk_id, a.candidate_id, b.name_holder, a.history_process, a.history_result from e_recruit.tr_history_process as a
      //   inner join e_recruit.tr_candidate as b on a.candidate_id = b.candidate_id
      //   inner join e_recruit.tr_job_fptk as c on b.job_fptk_id = c.job_fptk_id
      //   where b.job_fptk_id = '".$id."' and a.candidate_id = '".$id_pelamar."'
      //   order by a.history_process desc");
      

      $data['edit_data'] = $cek_candidate;
      $data['data_candi'] = $data_candi;
      // $data['lihat_history_candidate'] = $cek_history_candidate;

      return view('backend.candidate_outsource.view_candidate',$data);
    }

    public function view_histori_fptk_outsource_candidate(Request $request)
    {
      $id_job = $request->id_job;
      $id_can = $request->id_can;
      $data['get_job'] = \App\Models\JobFptk::find($request->id);
      $parent_user = (empty($data['get_emp'])) ? 0 : $data['get_emp']->parent_user;

      $data['get_head'] = \App\Models\User::where('username',$parent_user)->get();

      $data['get_hr'] = 
      \App\Models\User
      ::selectRaw(" case 
        when position = 'HUMAN CAPITAL SERVICES DEPARTMENT HEAD' 
        then 
          '1'
       when position = 'HUMAN CAPITAL DEVELOPMENT DEPT HEAD' 
        then 
          '3'    
        when position = 'VICE PRESIDENT DIRECTOR' 
        then 
          '2'
        else
          position
        end as urutan,*")
      ->whereIn('position',['HUMAN CAPITAL DEVELOPMENT DEPT HEAD','VICE PRESIDENT DIRECTOR','HUMAN CAPITAL SERVICES DEPARTMENT HEAD'])->orderBy('urutan','asc')->get();


      $cek_history_candidate = \DB::select("select b.job_fptk_id, a.candidate_id, b.name_holder, a.history_process, a.history_result, a.history_date from e_recruit.tr_history_process as a
        inner join e_recruit.tr_candidate as b on a.candidate_id = b.candidate_id
        inner join e_recruit.tr_job_fptk as c on b.job_fptk_id = c.job_fptk_id
        where b.job_fptk_id = '".$id_job."' and a.candidate_id = '".$id_can."'
        order by a.history_process desc");
      
      $data['lihat_history_candidate'] = $cek_history_candidate;

      return view('backend.candidate_outsource.histori_process_candidate',$data);
    }

    public function create_candidate_outsource(Request $request)
    {

      $data['location'] = $this->location;
      $data['division'] = $this->division;
      $data['project'] =  $this->project;
      $data['fptk'] = \App\Models\JobFptk::where('type_fptk','outsource')->where('status','open')->whereNull('is_closed')->get();
      $data['pt'] = $this->pt;
      $data['education'] = \App\Models\MasterSunfish::list_school();
      $data['cost_center'] = $this->cost_center;
      $data['user'] = \App\Models\User::all();
      $data['gender']  = \App\Models\Parameters::gender()->get();

      $data['get_data'] = \App\Models\JobFptk::where('type_fptk','outsource')
      ->where('request_job_number','ilike','%'.$request->request_job_number.'%')
      ->first();

      if(!empty($data['get_data']))
      {
        $data['requester'] = \App\Models\User::where('username',$data['get_data']->requester_name)->first();
        $data['candidate'] = \App\Models\Candidate::with('job_fptk')->where('job_fptk_id',$data['get_data']->job_fptk_id)->get();  
      }
      else
      {
        $data['requester'] = [];
        $data['candidate'] = [];
      }
      
      
          
      
      return view('backend.candidate_outsource.create_candidate_outsource',$data);
    }


    public function save_fptk_outsource_submission(Request $request)
    { 
        if($request->employment_type == 'magang'||$request->employment_type == 'pkl')
        {
           $this->validate($request, [
              'name_holder'         => 'required',
              // 'pic'                 => 'required',
              'end_date'            => 'required',
              'contract_periode'    => 'required',
              'cost_center'    => 'required',
              'join_date'    => 'required',
              'salary'    => 'required',
              'gender' => 'required',
              'supervisor'    => 'required',
              'request_job_number'    => 'required',
              'work_location'            => 'required',
              'division'            => 'required',
              'ktp_no'            => 'required',
              'account_number'            => 'required',
              'address'            => 'required',
              'hp_1'            => 'required',
              'date_of_birth'            => 'required',
              'benefit'            => 'required',
              'desc_benefit'            => 'required',
              'email' => 'required',
              // 'edu_university' => 'required',
          ]);
        }
        else
        {
            $this->validate($request, [
              'name_holder'         => 'required',
              'end_date'            => 'required',
              'contract_periode'    => 'required',
              'cost_center'    => 'required',
              'join_date'    => 'required',
              'salary'    => 'required',
              'supervisor'    => 'required',
              'request_job_number'    => 'required',
              'work_location'            => 'required',
              'division'            => 'required',
              'company_name'            => 'required',
              'ktp_no'            => 'required',
              'hp_1'            => 'required',
              'date_of_birth'            => 'required',
              'benefit'            => 'required',
              'desc_benefit'            => 'required',
              // 'edu_university' => 'required',
          ]);
        }

        $cekCandidate = \App\Models\Candidate::where('ktp_no',formatNumber($request->ktp_no))
        ->first();


        if($cekCandidate)
        {
            return response()->json( ['status'=>'errors','candidate_error'=>'The candidate  is already exist'] ,422);
        }
       

        \DB::beginTransaction();
        try {

          // for get closed on fullfillment candidate 
          $get_fptk = \App\Models\JobFptk::where('request_job_number',$request->request_job_number)->first();

          $candidate = new \App\Models\Candidate;
          $candidate->name_holder = $request->name_holder;
          $candidate->job_fptk_id = $get_fptk->job_fptk_id;
          $candidate->company_name = $request->company_name;
          $candidate->salary = $request->salary;
          $candidate->join_date = $request->join_date;
          $candidate->supervisor = $request->supervisor;
          $candidate->end_date = $request->end_date;
          $candidate->contract_periode = $request->contract_periode;
          $candidate->pic = $request->pic;
          $candidate->status_contract = 'Contract 1';
          $candidate->status = 1;
          $candidate->insert_by = Auth::user()->nip;
          $candidate->insert_time = date('Y-m-d H:i:s');
          $candidate->account_number= $request->account_number;
          $candidate->address = $request->address;
          $candidate->email = $request->email;
          $candidate->edu_university = $request->edu_university;
          $candidate->date_of_birth = $request->date_of_birth;
          $candidate->hp_1 = $request->hp_1;
          $candidate->ktp_no = $request->ktp_no;
          $candidate->gender = $request->gender;
          $candidate->no_npk = $request->no_npk;

          $candidate->save();

          $get_candidate = \App\Models\Candidate::where('job_fptk_id',$get_fptk->job_fptk_id)->count();
          
          if($get_fptk->requested_staff == $get_candidate)
          {
             \App\Models\JobFptk::where('request_job_number', $request->request_job_number)
                ->update(
                    [
                      'is_closed' => 'closed',
                    ] 
                );
          }

          
          \App\Models\JobFptk::where('request_job_number', $request->request_job_number)
          ->update(
              ['work_location' => $request->work_location,
              'division'=>$request->division,
              'cost_center'=>$request->cost_center,
              'benefit' => $request->benefit,
              'desc_benefit' => $request->desc_benefit,
            ]
          );


            //input to history
            $paramHistory = [
                    'candidate_id'=>$candidate->candidate_id,
                    'request_job_number'=>$request->request_job_number,
                    'history_position_name'=>$request->position_name,
                    'project_name'=>$request->project_name,
                    'company_name'=>$request->company_name,
                    'entiti'=>$request->cost_center,
                    'division'=>$request->division,
                    'work_location'=>$request->work_location,
                    'join_date'=>$request->join_date,
                    'status_contract'=>'Contract 1',
                    'end_date'=>$request->end_date,
                    'insert_by'=>Auth::user()->user_name,
                    'insert_time'=>date('Y-m-d H:i:s'),
                    'gender'=>$request->gender,
                    'no_npk'=>$request->no_npk,
                    'email'=>$request->email,
                ];
            \DB::table('e_recruit.tr_history_process')->insert(
                $paramHistory
            );


            \DB::commit();
            return response()->json(['status'=>'success']);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status'=>$e->getMessage()],422);       
        }
           
    }

    public function get_req(Request $request)
    {
      $get_fptk = \App\Models\JobFptk::with('user')->where('request_job_number',$request->request_job_number)->first();
      $get_candidate = \App\Models\Candidate::where('job_fptk_id',$get_fptk->job_fptk_id)->count();
      return response()->json(['status'=>'success','data'=>$get_fptk],200);   
    }


    public function get_fptk_outsource(Request $request)
    {
      $position = Auth::user()->position;

        $req = \DB::table('e_recruit.tr_users as a')
            ->where('parent_user',\Auth::user()->nip)
            ->get();

          $parent_user =[];
        foreach ($req as $key => $value) {
          # code...
          $parent_user[] = $value->nip;
        }

        array_push($parent_user, Auth::user()->nip);

        //Sudah solve problem actual staff

      if($position == 'HUMAN CAPITAL DEVELOPMENT DEPT HEAD' || $position =='VICE PRESIDENT DIRECTOR' || $position=='HUMAN CAPITAL SERVICES DEPARTMENT HEAD' || Auth::user()->name =='User Developer' || $position=='EKSTERAL & INDUSTRIAL RELATION OFFICER' || $position=='RECRUITMENT OFFICER')
      {
          $result = 
            \DB::table('e_recruit.tr_job_fptk as a')
            ->select('a.job_fptk_id','a.request_job_number','a.position_name','b.name as user_name','a.request_reason','a.requested_staff','a.actual_staff','a.work_location','a.project_name','a.required_date_fptk','a.employment_type','a.status','a.subco','a.is_closed')
            ->join('e_recruit.tr_users as b','a.requester_name','b.nip')
            ->where('type_fptk','outsource')
            ->where('delete_time',NULL)
            ->get();
      }
      else
      {
          $result = 
            \DB::table('e_recruit.tr_job_fptk as a')
            ->select('a.job_fptk_id','a.request_job_number','a.position_name','b.name as user_name','a.request_reason','a.requested_staff','a.actual_staff','a.work_location','a.project_name','a.required_date_fptk','a.employment_type','a.status','a.subco','a.is_closed')
            ->join('e_recruit.tr_users as b','a.requester_name','b.nip')
            ->whereIn('a.requester_name',$parent_user)
            ->where('a.type_fptk','outsource')
            ->where('a.delete_time',NULL);
            $result=$result->get();
      }
    
      return Datatables::of($result)
      
       ->editColumn('join_staff',function($data){
          
          return $get_candidate = \App\Models\Candidate::where('job_fptk_id',$data->job_fptk_id)->count();
      })        
      ->editColumn('status',function($data){
          $get_fptk = \App\Models\JobFptk::where('request_job_number',$data->request_job_number)->first();
          $get_candidate = \App\Models\Candidate::where('job_fptk_id',$data->job_fptk_id)->count();

            
          if($data->is_closed == 'closed')
          {
              return 'closed';
          }
          else
          {
              if($data->status == 'new')
              {
                  $query = \DB::table('e_recruit.tr_approval')
                  ->selectRaw('count(*) as count ')
                  ->whereRaw("approval_status is null or approval_status  = 'approved' ")
                  ->where('job_fptk_id',$data->job_fptk_id)
                  ->first();


                  if($query->count != 0)
                  {
                     return 'awaiting';
                  }
                  else
                  {
                    return 'new';    
                  }
              }
              else if($data->status == 'rejected')
              {
                return 'rejected';
              }
              else if($data->status == 'open')
              {
                  $get_fptk = \App\Models\JobFptk::where('request_job_number',$data->request_job_number)->first();
                  $get_candidate = \App\Models\Candidate::where('job_fptk_id',$data->job_fptk_id)->count();


                  if($data->requested_staff > 1 && $get_candidate == 0 )
                  {
                      return 'open';    
                  }
                  else
                  {
                    if($get_fptk->requested_staff != $get_candidate) 
                    {
                        return 'on progress';
                    }
                    else
                    {
                      return 'open';
                    }
                  }
                  

              }
              else if($data->status == 'draft')
              {
                return 'draft';
              }
             
          }
      })
      ->make(TRUE);
    }


}
