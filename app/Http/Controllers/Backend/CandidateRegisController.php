<?php
/*
    this class for save candidate outsource
    by arief manggala putra 
    email ariefmanggalaputra25@gmail.com

    note : ada beberapa fungsi yang tidak kepakai
*/

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Candidate;
use App\Models\Parameters;
use App\Models\JobFptk;
use App\Models\Assessment;
use App\Models\TRAssessment;
use Validator;
use App\Models\MasterSunfish;
use DB;
use File;
use App\Imports\CandidateImport;
use Excel;
use Auth;
use App\Http\Controllers\Controller;
use DateTime;
use Session;

class CandidateRegisController extends Controller
{
    //

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
        return view('backend.candidate_regis.index_candidate_regis',$data);
    }

    public function getData(Request $request)
    {
        // $search  = $request->input('search.value');

        $position = Auth::user()->position;

        $req = \DB::table('e_recruit.tr_users as a')
            ->where('parent_user',\Auth::user()->nip)
            ->get();
        // dd($req);
          $parent_user =[];
        foreach ($req as $key => $value) {
          # code...
          $parent_user[] = $value->nip;
        }

        array_push($parent_user, Auth::user()->nip);


        $cek_role = \DB::table('e_recruit.roles')
        ->where('id', Auth::user()->role_id)
        ->get();

        // dd($cek_role[0]->name);PGP_SYM_DECRYPT(salary_range_max::bytea,'AES_KEY')


        $search  = $request->val_search;
        $length  = $request->input('length');
        $data = 
        \DB::table('e_recruit.tr_candidate')
        ->select('tr_candidate.*','project_name','tr_job_fptk.cost_center','work_location','company_name','employment_type','request_job_number','position_name',
        DB::Raw("PGP_SYM_DECRYPT(salary::bytea, 'AES_KEY'::text) AS salary"),'benefit','desc_benefit')
        ->join('e_recruit.tr_job_fptk','tr_job_fptk.job_fptk_id','tr_candidate.job_fptk_id')
        ->join('e_recruit.tr_users', 'tr_job_fptk.requester_name', 'tr_users.nip')
        ->join('e_recruit.roles', 'tr_users.role_id', 'roles.id');

        if($cek_role[0]->name == 'Super User' OR $cek_role[0]->name == 'Human Capital Development Head' OR $cek_role[0]->name == 'Human Services Department Head' OR $cek_role[0]->name == 'Chief Of Corp. HCM & Internal Audit' OR $cek_role[0]->name == 'IR' OR $cek_role[0]->name == 'Admin HR' OR $cek_role[0]->name == 'Subco')
        {
            $data = $data ->where('tr_job_fptk.type_fptk','outsource')->where('tr_candidate.delete_time',NULL);
        } else {
            $data = $data->whereIn('requester_name',$parent_user);
        }

        if(!empty($search))
        {
            if($search == 'Active')
            {
                $data = $data->whereRaw("  
                    ( tr_candidate.name_holder ilike  '%".$search."%' ) or  
                    ( tr_job_fptk.position_name ilike '%".$search."%' ) or 
                    ( tr_job_fptk.request_job_number = '".$search."') or 
                     ( tr_candidate.status = 1 ) " 
                 )->where('tr_candidate.delete_time',NULL)->get();
            }
            else if($search == 'Non Active')
            {
                $data = $data->whereRaw("  
                    ( tr_candidate.name_holder ilike  '%".$search."%' ) or  
                    ( tr_job_fptk.position_name ilike '%".$search."%' ) or 
                    ( tr_job_fptk.request_job_number = '".$search."') or 
                    ( tr_candidate.status = 4 ) " 
                )->where('tr_candidate.delete_time',NULL)->get();

            }
            else if($search == 'return')
            {
                $data = $data->whereRaw("  
                    ( tr_candidate.name_holder ilike  '%".$search."%' ) or  
                    ( tr_job_fptk.position_name ilike '%".$search."%' ) or 
                    ( tr_job_fptk.request_job_number = '".$search."') or 
                    ( tr_candidate.status = 3 ) " 
                );
            } 
        }
   
        $data = $data->orderBy('candidate_id','desc');
        if($length  == -1)
        {
            $data = $data->get();
        }
        else
        {
            
            $data = $data
                ->take(10);            
        }

        $count_total = 
        DB::table('e_recruit.tr_job_fptk as b')
        ->select('tr_candidate.*','b.project_name','b.cost_center','b.work_location','b.company_name','b.employment_type','b.request_job_number','b.position_name','b.salary')
        ->join('e_recruit.tr_candidate as a','b.job_fptk_id','a.job_fptk_id')
        ->where('b.type_fptk','outsource')->where('a.delete_time',NULL)->count();


        $count_filter = 
         DB::table('e_recruit.tr_job_fptk')
        ->select('tr_candidate.*','project_name','cost_center','work_location','company_name','employment_type','request_job_number','position_name',
        DB::Raw("PGP_SYM_DECRYPT(salary::bytea, 'AES_KEY'::text) AS salary"))
        ->join('e_recruit.tr_candidate','tr_job_fptk.job_fptk_id','tr_candidate.job_fptk_id')
        ->where('type_fptk','outsource')
        ->orWhere('tr_candidate.name_holder', 'ILIKE', '%' . $search . '%')
        ->orWhere('tr_candidate.join_date', 'ILIKE', '%' . $search . '%')
        ->orWhere('tr_candidate.end_date', 'ILIKE', '%' . $search . '%')
        ->orWhere('tr_candidate.status', 'ILIKE', '%' . $search . '%')
        ->count();


        return Datatables::of($data)
       ->editColumn('request_job_number',function($data){
            $job_number = (empty($data->request_job_number)) ? "":strtoupper($data->request_job_number); 
            return $job_number;
        })
      
       ->editColumn('position_name',function($data){
            $pos_name = (empty($data->position_name)) ? "": strtoupper($data->position_name); 
            return $pos_name;
        })    

       ->editColumn('salary',function($data){
            $salary = (empty($data->salary)) ? "": strtoupper($data->salary); 
            return $salary;
        })    
        ->with(
            ['recordsFiltered'=> $count_total,
            'recordsTotal'=> $count_filter,]
        )
        ->make(true);
    }

    public function index_reg()
    {
        return view('backend.candidate_regis.index_candidate_regis_reg');
    }

    public function candidate_regis(Request $request)
    {

        if(!empty($request->search['value']))
        {
            $data = Candidate::with('job_fptk')->orderby('candidate_id','desc')->get();  
            $count = Candidate::with('job_fptk')->orderby('candidate_id','desc')->take(100)->get();
        }
        else
        {
            $data = Candidate::with('job_fptk')->orderby('candidate_id','desc')->take($request->length);  
            $count = Candidate::with('job_fptk')->orderby('candidate_id','desc')->get();  
        }

        
        return Datatables::of($data)
       ->editColumn('request_job_number',function($data){
            $job_number = (empty($data->job_fptk->request_job_number)) ? "":strtoupper($data->job_fptk->request_job_number); 
            return $job_number;
        })->editColumn('age',function($data){
            $fullAge = date_create($data->date_of_birth);
            $interval = date_diff($fullAge,now());
            $age = $interval->y; 
            return $age.' Tahun';
        })->editColumn('position_name',function($data){
            $pos_name = (empty($data->job_fptk->position_name)) ? "": strtoupper($data->job_fptk->position_name); 
            return $pos_name;
        })
        ->with(
            ['recordsFiltered'=> $count->count(),
            'recordsTotal'=> $count->count(),]
        )
        ->make(true);
    }

    public function create()
    {   

        $data['assessment'] = Assessment::all();
        $data['relationship']  = MasterSunfish::family();
        $data['occupation']  = MasterSunfish::occupation();
        $data['city']  = MasterSunfish::city();
        $data['education']  = MasterSunfish::education();
        $data['gender']  = Parameters::gender()->get();
        $data['religion']  = MasterSunfish::religion();
        $data['marital']  = Parameters::marital()->get();
        $data['nationality']  = Parameters::nationality()->get();
        $data['major']  = MasterSunfish::major();
        $data['list_school']  = MasterSunfish::list_school();
        $data['source']  = Parameters::source()->get();     

        return view('backend.candidate_regis.create_candidate_regis',$data);
    }


    public function save(Request $request)
    {
        $messages = [
            'name_holder.required'    => 'The  name field is required.',
            'file_1.required'    => 'The  Photo Profile field is required.',
            'file_2.required'    => 'The CV field is required.',
            'email.email'    => 'The format email is wrong.',

            'ktp_no.numeric'    => 'The must be numeric .',
            'hp_1.numeric'    => 'The must be numeric .',
        ]; 

        $validEmail = Candidate::where('email',$request->email)->first();

        $validator =  Validator::make($request->all(), [
            'name_holder' => 'required',
            'ktp_no'=>'required|numeric',
            'date_of_birth'=>'required',
            'place_of_birth'=>'required',
            'religion'=>'required',
            'marital_status'=>'required',
            'address'=>'required',
            'city'=>'required',
            'nationality'=>'required',
            'hp_1'=>'required|numeric',
            'email'=>'required|email',
            'edu_degree'=>'required',
            'edu_major'=>'required',
            'edu_start_year'=>'required',
            'edu_end_year'=>'required',
            'edu_university'=>'required',
            'edu_ipk'=>'required',
            'source'=>'required',
            'file_1' => 'required|mimes:jpeg,jpg,png|max:500',
            'file_2' => 'required|mimes:pdf|max:500',
            'assessment.*' => 'required'
        ], $messages);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

         if($validEmail)
        {
            return response()->json(['errors'=>['email'=>'The email is already exist']],422);
        }
        $tot_row = $request->tot;
        $validate_array = [];

        $candidate = new Candidate;

        $tanggal_lahir =  date('Y-m-d', strtotime($request->date_of_birth));

        $file_photo = $request->file('file_1');
        $file_cv = $request->file('file_2');
        $destinationPath = 'upload_file';

        $fileNamePhoto = uploadFile($request->file('file_1'),$destinationPath);
        $fileNameCv = uploadFile($request->file('file_2'),$destinationPath);


        $candidate->name_holder = $request->name_holder;
        $candidate->ktp_no = $request->ktp_no;
        $candidate->date_of_birth = $tanggal_lahir;
        $candidate->place_of_birth = $request->place_of_birth;
        $candidate->religion = $request->religion;
        $candidate->marital_status = $request->marital_status;
        $candidate->address = $request->address;
        $candidate->city = $request->city;
        $candidate->nationality = $request->nationality;
        $candidate->hp_1 = formatNumber($request->hp_1);
        $candidate->hp_2 = trim($request->hp_2);
        $candidate->email = trim($request->email);
        $candidate->edu_degree = trim($request->edu_degree);
        $candidate->edu_major = trim($request->edu_major);
        $candidate->edu_university = trim($request->edu_university);
        $candidate->edu_ipk = trim($request->edu_ipk);
        $candidate->source = trim($request->source);
        $candidate->exp_company = trim($request['exp_company']);
        $candidate->exp_position = trim($request['exp_position']);
        $candidate->exp_buss_sector = trim($request['exp_buss_sector']);
        $candidate->postal_code=trim($request['postal_code']);
        $candidate->exp_start_month=trim($request['exp_start_month']);
        $candidate->exp_end_month=trim($request['exp_end_month']);    
        $candidate->exp_start_year=(int)$request['exp_start_year'];
        $candidate->exp_end_year=(int)$request['exp_end_year'];
        $candidate->job_desc=trim($request['job_desc']);
        $candidate->process = 'CV IN';
        $candidate->result = 'PASSED';
        $candidate->file_1 = $fileNamePhoto;
        $candidate->file_2 = $fileNameCv;
        $candidate->received_date = date('Y-m-d');
        $candidate->insert_by = Auth::user()->username;
        $candidate->insert_time = date('Y-m-d H:i:s');

        $candidate->save();

       return response()->json(['status'=>'success'],200);
    }

    public function emailCheck(Request $request)
    {
        $validEmail = Candidate::where('email',$request->email)->first();

        if($validEmail)
        {
            return response()->json(['errors'=>['email'=>'The email is already exist']],422);
        }
        else
        {
            return response()->json(['status'=>'success'],200);   
        }
    }

    public function edit($id)
    {   
        $get_fptk = \DB::table('e_recruit.tr_job_fptk as a')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('b.candidate_id',$id)
        ->first();

        $fptk = \App\Models\JobFptk::where('type_fptk','outsource')
        ->where('status','open')
        ->whereNull('is_closed')
        ->get();

        $all_fptk=[];
        foreach ($fptk as $key => $value) {
            # code...
            $all_fptk[] = $value->job_fptk_id;
        }

        array_push($all_fptk, $get_fptk->job_fptk_id);

        $data['division'] = config('variable_static.division');
        $data['cost_center'] = config('variable_static.cost_center');
        $data['location'] = config('variable_static.location');
        $data['pt'] = config('variable_static.pt');
        $data['project'] = config('variable_static.project');
        
        $data['religion'] = MasterSunfish::religion();
        $data['list_school'] = MasterSunfish::list_school();
        $data['major'] = MasterSunfish::major();
        $data['city'] = MasterSunfish::city();
        $data['education'] = MasterSunfish::education();
        $data['edu_university'] = \App\Models\MasterSunfish::list_school();
        $data['marital'] = Parameters::marital()->get();
        $data['nationality'] = Parameters::nationality()->get();
        $data['strata'] = Parameters::strata()->get();
        $data['source'] = Parameters::source()->get();
        $data['job_fptk'] = JobFptk::all();
        $data['gender'] = Parameters::gender()->get();
        $data['assessment'] = Assessment::all();
        $data['candidate'] = Candidate::where('candidate_id',$id)->first();
        
        $data['salary'] = Candidate::select(DB::Raw("PGP_SYM_DECRYPT(salary::bytea, 'AES_KEY'::text) as salary"))->where('candidate_id',$id)->first();
        $data['fptk'] = \App\Models\JobFptk::where('type_fptk','outsource')->whereIn('job_fptk_id',$all_fptk)->get();
        $data['get_data'] =  Candidate::with('job_fptk')->where('candidate_id',$id)->first();
        $data['requester_name'] =  \App\Models\User::where('nip',$data['get_data']->job_fptk->requester_name)->first();
        $data['history'] =  \DB::table('e_recruit.tr_history_process')->where('candidate_id',$id)->orderBy('history_process_id','desc')->get();
        // dd($data['history']);
        $data['user'] = \App\Models\User::all();

        return view('backend.candidate_regis.edit_candidate_outsource',$data);
    }  


    public function delete_candidate($id)
    {   
        $get_fptk = \DB::table('e_recruit.tr_job_fptk as a')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('b.candidate_id',$id)
        ->first();

        $fptk = \App\Models\JobFptk::where('type_fptk','outsource')
        ->where('status','open')
        ->whereNull('is_closed')
        ->get();

        $all_fptk=[];
        foreach ($fptk as $key => $value) {
            # code...
            $all_fptk[] = $value->job_fptk_id;
        }

        array_push($all_fptk, $get_fptk->job_fptk_id);

        $data['division'] = config('variable_static.division');
        $data['cost_center'] = config('variable_static.cost_center');
        $data['location'] = config('variable_static.location');
        $data['pt'] = config('variable_static.pt');
        $data['project'] = config('variable_static.project');
        
        $data['religion'] = MasterSunfish::religion();
        $data['list_school'] = MasterSunfish::list_school();
        $data['major'] = MasterSunfish::major();
        $data['city'] = MasterSunfish::city();
        $data['education'] = MasterSunfish::education();
        $data['edu_university'] = \App\Models\MasterSunfish::list_school();
        $data['marital'] = Parameters::marital()->get();
        $data['nationality'] = Parameters::nationality()->get();
        $data['strata'] = Parameters::strata()->get();
        $data['source'] = Parameters::source()->get();
        $data['job_fptk'] = JobFptk::all();
        $data['gender'] = Parameters::gender()->get();
        $data['assessment'] = Assessment::all();
        $data['candidate'] = Candidate::where('candidate_id',$id)->first();
        $data['fptk'] = \App\Models\JobFptk::where('type_fptk','outsource')->whereIn('job_fptk_id',$all_fptk)->get();
        $data['get_data'] =  Candidate::with('job_fptk')->where('candidate_id',$id)->first();
        $data['requester_name'] =  \App\Models\User::where('nip',$data['get_data']->job_fptk->requester_name)->first();
        $data['history'] =  \DB::table('e_recruit.tr_history_process')->where('candidate_id',$id)->orderBy('history_process_id','desc')->get();
        $data['user'] = \App\Models\User::all();

        return view('backend.candidate_regis.delete_candidate_regis',$data);
    }  


    public function assessment_candidate_regis($id)
    {   
        $get_fptk = \DB::table('e_recruit.tr_job_fptk as a')
        ->join('e_recruit.tr_candidate as b','a.job_fptk_id','b.job_fptk_id')
        ->where('b.candidate_id',$id)
        ->first();

        $fptk = \App\Models\JobFptk::where('type_fptk','outsource')
        ->where('status','open')
        ->whereNull('is_closed')
        ->get();

        $all_fptk=[];
        foreach ($fptk as $key => $value) {
            # code...
            $all_fptk[] = $value->job_fptk_id;
        }

        array_push($all_fptk, $get_fptk->job_fptk_id);

        $data['division'] = config('variable_static.division');
        $data['cost_center'] = config('variable_static.cost_center');
        $data['location'] = config('variable_static.location');
        $data['pt'] = config('variable_static.pt');
        $data['project'] = config('variable_static.project');
        
        $data['religion'] = MasterSunfish::religion();
        $data['list_school'] = MasterSunfish::list_school();
        $data['major'] = MasterSunfish::major();
        $data['city'] = MasterSunfish::city();
        $data['education'] = MasterSunfish::education();
        $data['edu_university'] = \App\Models\MasterSunfish::list_school();
        $data['marital'] = Parameters::marital()->get();
        $data['nationality'] = Parameters::nationality()->get();
        $data['strata'] = Parameters::strata()->get();
        $data['source'] = Parameters::source()->get();
        $data['job_fptk'] = JobFptk::all();
        $data['gender'] = Parameters::gender()->get();
        $data['assessment'] = Assessment::all();
        $data['candidate'] = Candidate::where('candidate_id',$id)->first();
        $data['fptk'] = \App\Models\JobFptk::where('type_fptk','outsource')->whereIn('job_fptk_id',$all_fptk)->get();
        $data['get_data'] =  Candidate::with('job_fptk')->where('candidate_id',$id)->first();
        $data['requester_name'] =  \App\Models\User::where('nip',$data['get_data']->job_fptk->requester_name)->first();
        $data['history'] =  \DB::table('e_recruit.tr_history_process')->where('candidate_id',$id)->orderBy('history_process_id','desc')->get();
        $data['user'] = \App\Models\User::all();
       

        return view('backend.candidate_regis.assessment_regis',$data);
    }  


    public function return_candidate($id)
    {   
        $data['religion'] = MasterSunfish::religion();
        $data['list_school'] = MasterSunfish::list_school();
        $data['major'] = MasterSunfish::major();
        $data['city'] = MasterSunfish::city();
        $data['education'] = MasterSunfish::education();
        $data['marital'] = Parameters::marital()->get();
        $data['nationality'] = Parameters::nationality()->get();
        $data['strata'] = Parameters::strata()->get();
        $data['source'] = Parameters::source()->get();
        $data['job_fptk'] = JobFptk::all();
        $data['gender'] = Parameters::gender()->get();
        $data['assessment'] = Assessment::all();
        $data['candidate'] = Candidate::where('candidate_id',$id)->first();
        $data['fptk'] = JobFptk::where('type_fptk','outsource')->get();
        $data['get_data'] =  Candidate::with('job_fptk')->where('candidate_id',$id)->first();
        $data['requester_name'] =  \App\Models\User::where('nip',$data['get_data']->job_fptk->requester_name)->first();
        $data['pt'] = config('variable_static.pt');
        $data['history'] =  \DB::table('e_recruit.tr_history_process')->where('candidate_id',$id)->orderBy('history_process_id','desc')->get();

        $data['get_emp'] = \App\Models\User::where('username',Auth::user()->username)->first();
        
        // $data['get_head'] = \App\Models\User::where('nip',$data['get_data']->job_fptk->requester_name)->get();

        $data['get_head'] = \DB::table('e_recruit.tr_users')
                            ->where('nip',DB::raw("(select parent_user from e_recruit.tr_users where nip = '".$data['get_data']->job_fptk->requester_name."' limit 1)"))->get();

        $data['get_hr'] = \App\Models\User::whereIn('position',['EKSTERAL & INDUSTRIAL RELATION OFFICER','HUMAN CAPITAL SERVICES DEPARTMENT HEAD'])->orderBy('position','desc')->get();
        
        return view('backend.candidate_regis.return_candidate_outsource',$data);
    }

    public function update(Request $request)
    {
        $messages = [
            'name_holder.required'    => 'The  name field is required.',
            'file_1.required'    => 'The  Photo Profile field is required.',
            'file_2.required'    => 'The CV field is required.',
            'email.email'    => 'The format email is wrong.',
            'ktp_no.numeric'    => 'The must be numeric .',
            'hp_1.numeric'    => 'The must be numeric .',
        ]; 

        $validEmail = Candidate::where('email',$request->email)->first();

        $file_1_edit = ($request->file_1_edit != "") ? "" : "required|mimes:jpeg,jpg,png|max:1000"; 
        $file_2_edit = ($request->file_2_edit != "") ? "" : "required|mimes:pdf"; 
      
        $destinationPath = 'upload_file';



        $validator =  Validator::make($request->all(), [
            'name_holder' => 'required',
            'ktp_no'=>'required|numeric',
            'date_of_birth'=>'required',
            'place_of_birth'=>'required',
            'religion'=>'required',
            'marital_status'=>'required',
            'address'=>'required',
            'nationality'=>'required',
            'hp_1'=>'required|numeric',
            'edu_degree'=>'required',
            'edu_major'=>'required',
            'edu_university'=>'required',
            'edu_ipk'=>'required',
            'edu_start_year'=>'required',
            'edu_end_year'=>'required',
            'source'=>'required',
            'file_1' => $file_1_edit,
            'file_2' => $file_2_edit,
        ], $messages);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }


        if(!empty($request->file('file_1')))
        {
            File::delete($destinationPath.'/'.$request->file_1_edit);
            $fileNamePhoto = uploadFile($request->file('file_1'),$destinationPath);
        }

        if(!empty($request->file('file_2')))
        {
            File::delete($destinationPath.'/'.$request->file_2_edit);
            $fileNameCv = uploadFile($request->file('file_2'),$destinationPath);
        }


        $file_photo = (empty($request->file('file_1'))) ?  $request->file_1_edit : $fileNamePhoto;
        $file_cv = (empty($request->file('file_2'))) ?  $request->file_2_edit : $fileNameCv ;

        
        $salaryEncrypt = DB::select( DB::raw("SELECT pgp_sym_encrypt::text FROM pgp_sym_encrypt('".$request['exp_salary_existing']."'::text, 'AES_KEY'::text)") );
    
        $candidate = Candidate::find($request->candidate_id);

        $tanggal_lahir =  date('Y-m-d', strtotime($request->date_of_birth));


        $candidate->name_holder = $request->name_holder;
        $candidate->ktp_no = $request->ktp_no;
        $candidate->date_of_birth = $tanggal_lahir;
        $candidate->place_of_birth = $request->place_of_birth;
        $candidate->religion = $request->religion;
        $candidate->marital_status = $request->marital_status;
        $candidate->marital_status = $request->marital_status;
        $candidate->address = $request->address;
        $candidate->city = $request->city;
        $candidate->nationality = $request->nationality;
        $candidate->hp_1 = formatNumber($request->hp_1);
        $candidate->hp_2 = trim($request->hp_2);
        $candidate->email = trim($request->email);
        $candidate->edu_degree = trim($request->edu_degree);
        $candidate->edu_major = trim($request->edu_major);
        $candidate->edu_university = trim($request->edu_university);
        $candidate->edu_ipk = trim($request->edu_ipk);
        $candidate->source = trim($request->source);
        $candidate->exp_company = trim($request['exp_company']);
        $candidate->exp_position = trim($request['exp_position']);
        $candidate->exp_buss_sector = trim($request['exp_buss_sector']);
        $candidate->postal_code=trim($request['postal_code']);
        $candidate->exp_start_month=trim($request['exp_start_month']);
        $candidate->exp_end_month=trim($request['exp_end_month']);    
        $candidate->exp_start_year=(int)$request['exp_start_year'];
        $candidate->exp_end_year=(int)$request['exp_end_year'];
        $candidate->job_desc=trim($request['job_desc']);
        $candidate->exp_total=(int)$request['exp_total'];
        $candidate->exp_salary_existing= $salaryEncrypt[0]->pgp_sym_encrypt;
        $candidate->process = 'CV IN';
        $candidate->result = 'PASSED';
        $candidate->file_1 = $file_photo;
        $candidate->file_2 = $file_cv;
        $candidate->received_date = date('Y-m-d');
        $candidate->update_by = Auth::user()->username;
        $candidate->update_time = date('Y-m-d H:i:s');


        $candidate->save();

       return response()->json(['status'=>'success'],200);   
    }

    public function show($id)
    {


        $data['religion'] = Parameters::religion()->get();
        $data['marital'] = Parameters::marital()->get();
        $data['nationality'] = Parameters::nationality()->get();
        $data['strata'] = Parameters::strata()->get();
        $data['source'] = Parameters::source()->get();
        $data['job_fptk'] = JobFptk::all();
        $data['assessment'] = Assessment::all();
        $data['candidate'] = Candidate::find($id);

        return view('backend.candidate_regis.show_candidate_regis',$data);
    }

    public function uploadCandidate(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'file_upload' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload'); //GET FILE
             Excel::import(new CandidateImport, $file); //IMPORT FILE 
            return response()->json(['status'=>'success'],200);   
        }  
    }

    public function update_candidate_outsource(Request $request)
    {
        $this->validate($request, [
              'name_holder'         => 'required',
              'end_date'            => 'required',
              'contract_periode'    => 'required',
              'cost_center'    => 'required',
              'join_date'    => 'required',
              'end_date'    => 'required',
              'gender'    => 'required',
              'no_npk'    => 'required',
              'supervisor'    => 'required',
              'request_job_number'    => 'required',
              'work_location'            => 'required',
              'division'            => 'required',
              'cost_center'            => 'required',
              'benefit'            => 'required',
              
          ]);

        \DB::beginTransaction();
        try {

        
          $fptk = \App\Models\JobFptk::find($request->job_fptk_id);
          $fptk->work_location = $request->work_location;
          $fptk->division = $request->division;
          $fptk->cost_center = $request->cost_center;
          $fptk->request_job_number = $request->request_job_number;
          $fptk->benefit = $request->benefit;
          $fptk->other_project = $request->other_project;
          $fptk->save();

          $candidate =  Candidate::find($request->candidate_id);



        

          if( $request->request_job_number != $fptk->request_job_number || $request->status_contract != $candidate->status_contract   )
          {

            // input to history
            $get_fptk = \App\Models\JobFptk::where('request_job_number',$fptk->request_job_number)->first();
        
            $get_candidate = \App\Models\Candidate::where('job_fptk_id',$request->job_fptk_id)->count();

              if($get_fptk->requested_staff == $get_candidate)
              {
                 \App\Models\JobFptk::where('request_job_number', $request->request_job_number)
                    ->update(
                        [
                          'is_closed' => 'closed',
                        ] 
                    );
              }





              
            //input to history
            $paramHistory = [
                    'candidate_id'=>$candidate->candidate_id,
                    'gender'=>$request->gender,
                    'no_npk'=>$request->no_npk,
                    'request_job_number'=>$request->request_job_number,
                    'history_position_name'=>$request->position_name,
                    'project_name'=>$request->project_name,
                    'company_name'=>$request->company_name,
                    'entiti'=>$request->cost_center,
                    'division'=>$request->division,
                    'work_location'=>$request->work_location,
                    'join_date'=>$request->join_date,
                    'status_contract'=>$request->status_contract,
                    'end_date'=>$request->end_date,
                    'insert_by'=>Auth::user()->user_name,
                    'insert_time'=>date('Y-m-d H:i:s'),
                    'email'=>$request->email,
                ];

                // \Log::info($paramHistory);

                // var_dump($paramHistory); exit(); die();

       

            \DB::table('e_recruit.tr_history_process')->insert(
                $paramHistory
            );
       
          }
          $salaryEncrypt = DB::select( DB::raw("SELECT pgp_sym_encrypt::text FROM pgp_sym_encrypt('".$request->salary."'::text, 'AES_KEY'::text)") );

          $candidate->name_holder = $request->name_holder;
          $candidate->job_fptk_id = $request->job_fptk_id;
          $candidate->company_name = $request->company_name;
          $candidate->salary = $salaryEncrypt[0]->pgp_sym_encrypt;
          $candidate->join_date = $request->join_date;
          $candidate->supervisor = $request->supervisor;
          $candidate->gender = $request->gender;
          $candidate->no_npk = $request->no_npk;
        //   $candidate->request_job_number = $request->request_job_number;
          $candidate->ktp_no = $request->ktp_no;
          $candidate->email = $request->email;
          $candidate->hp_1 = $request->hp_1;
          $candidate->address = $request->address;
          $candidate->account_number = $request->account_number;
          $candidate->end_date = $request->end_date;
          $candidate->contract_periode = $request->contract_periode;
          $candidate->status_contract = $request->status_contract;
          $candidate->edu_university = $request->edu_university;
          $candidate->pic = $request->pic;
          $candidate->insert_by = Auth::user()->email;
          $candidate->insert_time = date('Y-m-d H:i:s');
          $candidate->save();


            $get_his = \App\Models\TrHistoryProcess::where('candidate_id', $request->candidate_id)->orderby('history_process_id','desc')->first();
            if(!empty($get_his))
            {
                $update_his =  \App\Models\TrHistoryProcess::find($get_his->history_process_id);
                $update_his->request_job_number = $fptk->request_job_number;
                $update_his->request_job_number=$request->request_job_number;
                $update_his->history_position_name=$request->position_name;
                $update_his->project_name=$request->project_name;
                $update_his->company_name=$request->company_name;
                $update_his->entiti=$request->cost_center;
                $update_his->division=$request->division;
                $update_his->work_location=$request->work_location;
                $update_his->join_date=$request->join_date;
                $update_his->no_npk = $request->no_npk;
                $update_his->email = $request->email;
                $update_his->gender = $request->gender;
                $update_his->status_contract=$request->status_contract;
                $update_his->end_date=$request->end_date;
                $update_his->save();    
            }


            // \Log::info($update_his);

  

            \DB::commit();
            return response()->json(['status'=>'success']);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status'=>$e->getMessage()],422);       
        }    
    }

    public function delete_candidate_outsource(Request $request)
    {
        \DB::beginTransaction();
        try {

        
        $fptk = \App\Models\JobFptk::find($request->job_fptk_id);
          $fptk->work_location = $request->work_location;
          $fptk->division = $request->division;
          $fptk->cost_center = $request->cost_center;
          $fptk->benefit = $request->benefit;
          $fptk->other_project = $request->other_project;
          $fptk->save();

          $candidate =  Candidate::find($request->candidate_id);



        

          if( $request->request_job_number != $fptk->request_job_number || $request->status_contract != $candidate->status_contract   )
          {

            // input to history
            $get_fptk = \App\Models\JobFptk::where('request_job_number',$fptk->request_job_number)->first();
        
            $get_candidate = \App\Models\Candidate::where('job_fptk_id',$request->job_fptk_id)->count();

              if($get_fptk->requested_staff == $get_candidate)
              {
                 \App\Models\JobFptk::where('request_job_number', $request->request_job_number)
                    ->update(
                        [
                          'is_closed' => 'closed',
                        ] 
                    );
              }



            //input to history
            $paramHistory = [
                    'candidate_id'=>$candidate->candidate_id,
                    'delete_by'=>Auth::user()->user_name,
                    'delete_time'=>date('Y-m-d H:i:s'),
                ];
            \DB::table('e_recruit.tr_history_process')->insert(
                $paramHistory
            );
       
          }



          $candidate->job_fptk_id = $request->job_fptk_id;
          $candidate->delete_by = Auth::user()->email;
          $candidate->delete_time = date('Y-m-d H:i:s');
          $candidate->save();


            $get_his = \App\Models\TrHistoryProcess::where('candidate_id', $request->candidate_id)->orderby('history_process_id','desc')->first();
            if(!empty($get_his))
            {
                $update_his =  \App\Models\TrHistoryProcess::find($get_his->history_process_id);
                $update_his->request_job_number = $fptk->request_job_number;
                $update_his->request_job_number=$request->request_job_number;
                $update_his->history_position_name=$request->position_name;
                $update_his->project_name=$request->project_name;
                $update_his->company_name=$request->company_name;
                $update_his->entiti=$request->cost_center;
                $update_his->division=$request->division;
                $update_his->work_location=$request->work_location;
                $update_his->join_date=$request->join_date;
                $update_his->no_npk = $request->no_npk;
                $update_his->gender = $request->gender;
                $update_his->status_contract=$request->status_contract;
                $update_his->end_date=$request->end_date;
                $update_his->save();    
            }



            \DB::commit();
            return response()->json(['status'=>'success']);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status'=>$e->getMessage()],422);       
        }  
    }

    public function update_return_employee(Request $request)
    {
        if(!empty($request->approval_status))
        {

            if($request->approval_status == 'rejected')
            {
                $this->validate($request, [
                    'approval_desc'         => 'required',
                    'approval_status'         => 'required',
                ]); 
            }
            else
            {
                $this->validate($request, [
                    'approval_status'         => 'required',
                ]);    
            }
          
        }
        else
        {
            if($request->employment_type == 'magang' || $request->employment_type == 'pkl')
            {
                $this->validate($request, [
                      'name_holder'         => 'required',
                      'end_date'            => 'required',
                      'contract_periode'    => 'required',
                      'cost_center'    => 'required',
                      'join_date'    => 'required',
                      'end_date'    => 'required',
                      'salary'    => 'required',
                      'supervisor'    => 'required',
                      'request_job_number'    => 'required',
                       'work_location'            => 'required',
                        'division'            => 'required',
                        'company_name'            => 'required',
                        'cost_center'            => 'required',
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
                    'end_date'    => 'required',
                    'salary'    => 'required',
                    'supervisor'    => 'required',
                    'request_job_number'    => 'required',
                    'work_location'            => 'required',
                    'division'            => 'required',
                ]);
            }
         
        }


        if(!empty($request->approval_status))
        {
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
                        $approval->candidate_id = $request->candidate_id;
                        $approval->save();    
                    }
                    else if($request->user_id[$key] == Auth::user()->user_id)
                    {
                        $approval =  new \App\Models\TrApproval;
                        $approval->approval_date = date('Y-m-d H:i:s');
                        $approval->approval_status = $request->approval_status;
                        $approval->approval_desc = $request->approval_desc;
                        $approval->user_id = $request->user_id[$key];
                        $approval->candidate_id = $request->candidate_id;
                        $approval->save();  
                    }   
                  }



                  $cek_val = \DB::table('e_recruit.tr_approval')->whereRaw('candidate_id = '.$request->candidate_id.'')->first();
                   
                  $cek_approval = \DB::select("
                 SELECT count(*) AS count
                       FROM ( SELECT tr_approval.approval_id,
                                tr_approval.candidate_id,
                                tr_approval.user_id,
                                tr_approval.approval_status,
                                tr_approval.approval_date,
                                tr_approval.approval_desc
                               FROM e_recruit.tr_approval
                            UNION ALL
                             SELECT a_1.approval_id,
                                a_1.candidate_id,
                                a_1.user_id,
                                a_1.approval_status,
                                a_1.approval_date,
                                a_1.approval_desc
                               FROM e_recruit.tr_approval a_1
                                 left JOIN e_recruit.tr_users c ON a_1.user_id = c.user_id
                              WHERE c.position::text = 'HUMAN CAPITAL SERVICES DEPARTMENT HEAD'::text
                              and c.position::text = 'HUMAN CAPITAL DEVELOPMENT DEPT HEAD'::text
                              and c.position::text = 'EKSTERAL & INDUSTRIAL RELATION OFFICER'::text
                              ) a
                      WHERE a.approval_status IS NULL OR a.approval_status::text = 'approved'::text
                      and candidate_id = '".$request->candidate_id."'
                  ");

                  if($request->approval_status == 'rejected')
                  {
                      $fptk =  \App\Models\Candidate::find($request->candidate_id);
                      $fptk->status  = '1';
                      $fptk->save();  
                  }

                  if(!empty($cek_val))
                  {
                    if($cek_approval[0]->count == 3)
                    {
                        $fptk =  \App\Models\Candidate::find($request->candidate_id);
                        $fptk->status  = '4';
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
        else
        {

            $salaryEncrypt = DB::select( DB::raw("SELECT pgp_sym_encrypt::text FROM pgp_sym_encrypt('".$request->salary."'::text, 'AES_KEY'::text)") );

              $candidate = \App\Models\Candidate::find($request->candidate_id);
              $candidate->name_holder = $request->name_holder;
              $candidate->job_fptk_id = $request->job_fptk_id;
              $candidate->company_name = $request->company_name;
              $candidate->salary = $salaryEncrypt[0]->pgp_sym_encrypt;
              $candidate->join_date = $request->join_date;
              $candidate->supervisor = $request->supervisor;
              $candidate->end_date = $request->end_date;
              $candidate->contract_periode = $request->contract_periode;
              $candidate->pic = $request->pic;
              $candidate->status = 1;
              $candidate->insert_by = Auth::user()->nip;
              $candidate->insert_time = date('Y-m-d H:i:s');
              $candidate->account_number= $request->account_number;
              $candidate->address = $request->address;
              $candidate->hp_1 = $request->hp_1;
              $candidate->ktp_no = $request->ktp_no;
              $candidate->reason_return = $request->reason_return;

              $candidate->save();
              return response()->json(['status'=>'success']);
        }
    }


    public function detail_candidate(Request $request,$id)
    {
        $data['religion'] = MasterSunfish::religion();
        $data['list_school'] = MasterSunfish::list_school();
        $data['major'] = MasterSunfish::major();
        $data['city'] = MasterSunfish::city();
        $data['education'] = MasterSunfish::education();
        $data['marital'] = Parameters::marital()->get();
        $data['nationality'] = Parameters::nationality()->get();
        $data['strata'] = Parameters::strata()->get();
        $data['source'] = Parameters::source()->get();
        $data['job_fptk'] = JobFptk::all();
        $data['gender'] = Parameters::gender()->get();
        $data['assessment'] = Assessment::all();
        $data['candidate'] = Candidate::where('candidate_id',$id)->first();
        $data['salary'] = Candidate::select(DB::Raw("PGP_SYM_DECRYPT(salary::bytea, 'AES_KEY'::text) as salary"))->where('candidate_id',$id)->first();
        $data['fptk'] = \App\Models\JobFptk::where('type_fptk','outsource')->get();
        $data['get_data'] =  Candidate::with('job_fptk')->where('candidate_id',$id)->first();
        $data['requester_name'] =  \App\Models\User::where('nip',$data['get_data']->job_fptk->requester_name)->first();
        $data['pt'] = config('variable_static.pt');
        

        return view('backend.candidate_regis.detail_candidate',$data);
    }


    public function form_return_candidate(Request $request)
    {
        
        $data['religion'] = MasterSunfish::religion();
        $data['list_school'] = MasterSunfish::list_school();
        $data['major'] = MasterSunfish::major();
        $data['city'] = MasterSunfish::city();
        $data['education'] = MasterSunfish::education();
        $data['marital'] = Parameters::marital()->get();
        $data['nationality'] = Parameters::nationality()->get();
        $data['strata'] = Parameters::strata()->get();
        $data['source'] = Parameters::source()->get();
        $data['job_fptk'] = JobFptk::all();
        $data['gender'] = Parameters::gender()->get();
        $data['assessment'] = Assessment::all();
        $data['user'] = \App\Models\User::all();
        $data['employee'] = 
        \DB::table('e_recruit.tr_candidate as a')
        ->join('e_recruit.tr_job_fptk as b','a.job_fptk_id','b.job_fptk_id')
        ->where('type_fptk','outsource')->where('a.status','1')->get();
        $data['get_data'] = \App\Models\JobFptk::with('candidate')->where('type_fptk','outsource')->first();
        $data['pt'] = config('variable_static.pt');

        return view('backend.candidate_regis.form_return_candidate',$data);   
    }


    public function get_employee(Request $request)
    {
        $data = Candidate::with('job_fptk')->find($request->candidate_id);
        $parent = \App\Models\User::where('nip',$data->job_fptk->requester_name)->first();
        $parent_name = !empty($parent) ? $parent->name : "";
        return response()->json(['status'=>'success','data'=>$data,'requester_name'=>$parent_name]);
    }

    public function approved_return_employee(Request $request)
    {
        $this->validate($request, [
              'reason_return'         => 'required',
          ]);
        $candidate = \App\Models\Candidate::find($request->candidate_id);
        $candidate->name_holder = $request->name_holder;
        $candidate->job_fptk_id = $request->job_fptk_id;
        $candidate->company_name = $request->company_name;
        // $candidate->salary = $request->salary;
        $candidate->join_date = $request->join_date;
        $candidate->supervisor = $request->supervisor;
        $candidate->end_date = $request->end_date;
        $candidate->contract_periode = $request->contract_periode;
        $candidate->pic = $request->pic;
        $candidate->insert_by = Auth::user()->nip;
        $candidate->insert_time = date('Y-m-d H:i:s');
        $candidate->account_number= $request->account_number;
        $candidate->address = $request->address;
        $candidate->hp_1 = $request->hp_1;
        $candidate->ktp_no = $request->ktp_no;
        $candidate->reason_return = $request->reason_return;
        $candidate->status = 3;

        $candidate->save();
        return response()->json(['status'=>'success']);
    }

}
