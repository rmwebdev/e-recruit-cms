<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Parameters;
use App\Models\JobFptk;
use App\Models\Assessment;
use App\Models\TRAssessment;
use App\Models\TrHistoryProcess;
use App\Models\MasterSunfish;
use App\Models\MasterPersonal;
use Validator;
use DB;
use File;
use App\Imports\CandidateImport;
use Excel;
use Auth;
use Session;


class FormCandidateController extends Controller
{
    //

    protected $assessment;
    public function __construct()
    {
         $this->assessment = Assessment::all()->count();
    }

    public function create()
    {   
        $data['religion'] = MasterSunfish::religion();
        $data['marital'] = Parameters::marital()->get();
        $data['nationality'] = Parameters::nationality()->get();
        $data['strata'] = Parameters::strata()->get();
        $data['source'] = Parameters::source()->get();
        $data['gender'] = Parameters::gender()->get();
        $data['job_fptk'] = JobFptk::all();
        $data['assessment'] = Assessment::orderBy('asses_quest_id')->get();
        $data['list_school'] = MasterSunfish::list_school();
        $data['major'] = MasterSunfish::major();
        $data['education'] = MasterSunfish::education();
        $data['city'] = MasterSunfish::city();

        

        $userinfo = Session::get('userinfo');
        $candidate =  Candidate::where('email',$userinfo['email'])->first();

        $data['candidate']  = $candidate;

        return view('frontend.form_candidate.create_form_candidate',$data);
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

   

    public function update(Request $request)
    {

        $messages = [
            'name_holder.required'    => 'The  name field is required.',
            'file_1.required'    => 'The  Photo Profile field is required.',
            'file_2.required'    => 'The CV field is required.',
            'email.email'    => 'The format email is wrong.',
            'ktp_no.numeric'    => 'The must be numeric .',
            'hp_1.numeric'    => 'The must be numeric .',
            'file_1.mimes'    => 'The Photo must be a file of type: jpeg, jpg, png.',
            'file_2.mimes'    => 'The CV must be a file of type: pdf.',
        ]; 

        $file_1_edit = ($request->file_1_edit != "") ? "" : "required|mimes:jpeg,jpg,png|max:500"; 
        $file_2_edit = ($request->file_2_edit != "") ? "" : "required|mimes:pdf|max:500"; 
      
        $destinationPath = 'upload_file';

        if($request->step == 'step1')
        {
    
            $validator =  Validator::make($request->all(), [
                'name_holder' => 'required',
                'gender'=>'required',
                'place_of_birth'=>'required',
                'date_of_birth'=>'required',
                'ktp_no'=>'required|numeric',
                'religion'=>'required',
                'marital_status'=>'required',
                'address'=>'required',
                // 'city'=>'required',
                'nationality'=>'required',
                'hp_1'=>'required|numeric',
            ], $messages);


            if($validator->fails())
            {
                return response()->json( array('errors' => $validator->errors()->toArray()),422);
            }


            $candidate_id =  Candidate::where('email',$request->email)->first();
            $candidate = Candidate::find($candidate_id->candidate_id);

            $tanggal_lahir =  date('Y-m-d', strtotime($request->date_of_birth));

            $candidate->name_holder = $request->name_holder;
            $candidate->gender = trim($request->gender);
            $candidate->place_of_birth = $request->place_of_birth;
            $candidate->date_of_birth = $tanggal_lahir;
            $candidate->ktp_no = $request->ktp_no;
            $candidate->religion = $request->religion;
            $candidate->city = $request->city;
            $candidate->postal_code=trim($request->postal_code);
            $candidate->marital_status = $request->marital_status;
            $candidate->address = $request->address;
            $candidate->nationality = $request->nationality;
            $candidate->bpjs_kesehatan = $request->bpjs_kesehatan;
            $candidate->bpjs_tenaga_kerja = $request->bpjs_tenaga_kerja;
            $candidate->phone_no = $request->phone_no;
            $candidate->hp_2 = trim($request->hp_2);
            $candidate->email = trim($request->email);
            $candidate->hp_1 = formatNumber($request->hp_1);

            $candidate->save();

        }
        else if($request->step == 'step2')
        {
            $validator =  Validator::make($request->all(), [
                'edu_degree'=>'required',
                'edu_ipk'=>'required',
                'edu_major'=>'required',
                'edu_university'=>'required',
                'edu_start_year'=>'required',
                'edu_end_year'=>'required',
            ], $messages);
            if($validator->fails())
            {
                return response()->json( array('errors' => $validator->errors()->toArray()),422);
            }

            $candidate_id =  Candidate::where('email',$request->email)->first();
            $candidate = Candidate::find($candidate_id->candidate_id);
            $candidate->edu_degree = trim($request->edu_degree);
            $candidate->edu_major = trim($request->edu_major);
            $candidate->edu_start_year = trim($request->edu_start_year);
            $candidate->edu_end_year = trim($request->edu_end_year);
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
            $candidate->exp_total=(int)$request['exp_total'];
            $candidate->exp_salary_existing=$request['exp_salary_existing'];
            $candidate->job_desc=trim($request['job_desc']);
            $candidate->save();

            $dt = \App\Models\TrEduBack::where('candidate_id',$candidate_id->candidate_id)->first();
            
            if(empty($dt))
            {
                $edu = new \App\Models\TrEduBack;
                $edu->candidate_id = $candidate_id->candidate_id;
                $edu->edu_back_level = $request->edu_degree;
                $edu->major = $request->edu_major;
                $edu->start_edu_back = $request->edu_start_year;
                $edu->end_edu_back = $request->edu_end_year;
                $edu->institution = $request->edu_university;
                $edu->gpa = $request->edu_ipk;
                $edu->edu_back_city = ' ';
                $edu->save();
            }

        }
        else if($request->step == 'step3')
        {
            $validator =  Validator::make($request->all(), [
                'file_1' => $file_1_edit,
                'file_2' => $file_2_edit,
                'source'=>'required',
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

            $candidate_id =  Candidate::where('email',$request->email)->first();
            $candidate = Candidate::find($candidate_id->candidate_id);
            $candidate->process = 'CV IN';
            $candidate->source = $request->source;
            $candidate->result = 'PASSED';
            $candidate->file_1 = $file_photo;
            $candidate->file_2 = $file_cv;
            $candidate->received_date = date('Y-m-d');
            $candidate->update_by = $request->name_holder;
            $candidate->update_time = date('Y-m-d H:i:s');
            $candidate->save();        
        }
        



       return response()->json(['status'=>'success'],200);   
    }


    public function confirmation()
    {
        $data['userinfo'] = Session::get('userinfo');
        $data['history'] = TrHistoryProcess::where('candidate_id',$data['userinfo']['candidate_id'])
        ->where('history_process','CALLED')
        ->orderBy('history_process_id', 'desc')
        ->get();

        $data['count'] = TrHistoryProcess::where('candidate_id',$data['userinfo']['candidate_id'])
        ->where('history_process','CALLED')
        ->whereIn('history_result',['SENT','REINVITED'])
        ->whereRaw("(history_confirmation = '' or history_confirmation is null)")
        ->count();


        $data['candidate'] = Candidate::find($data['userinfo']['candidate_id']);
        return view('frontend.form_candidate.confirmation',$data);
    }

    public function actionConfirmation(Request $request)
    {   
        $sess = Session::get('userinfo');
        $family = MasterPersonal::family($sess['candidate_id']);
        $emergency_contact = MasterPersonal::emergency_contact($sess['candidate_id']);
        $education_background = MasterPersonal::education_background($sess['candidate_id']);
        $course_information = MasterPersonal::course_information($sess['candidate_id']);
        $skill = MasterPersonal::skill($sess['candidate_id']);
        $language_skill = MasterPersonal::language_skill($sess['candidate_id']);
        $org_information = MasterPersonal::org_information($sess['candidate_id']);
        $job_experience = MasterPersonal::job_experience($sess['candidate_id']);
        $job_interest = MasterPersonal::job_interest($sess['candidate_id']);
        $assessment = TRAssessment::get()->count();
        $assess_can = TRAssessment::where('candidate_id',$sess['candidate_id'])->count();

        if($request->result == "ATTENDING")
        {
            if($family == 0){return response()->json(['status'=>'error_confirmation','message'=>'Family'],422);}
            else if($emergency_contact == 0){return response()->json(['status'=>'error_confirmation','message'=>'Emergency Contact'],422);}
            else if($education_background == 0){return response()->json(['status'=>'error_confirmation','message'=>'Education Background'],422);}
            else if($language_skill == 0){return response()->json(['status'=>'error_confirmation','message'=>'Language Skill'],422);}
            else if($skill == 0){return response()->json(['status'=>'error_confirmation','message'=>'Skill'],422);}
            else if($this->assessment != $assess_can){return response()->json(['status'=>'error_confirmation','message'=>'Assessment'],422);}
        }


        if(!empty($request->id) && !empty($request->result))
        {
            // update table candidate
            $candidate = Candidate::find($sess['candidate_id']);
            $candidate->result = $request->result;
            $candidate->process = 'CALLED';
            $candidate->update_by = $sess['name_holder'];
            $candidate->update_time = date('Y-m-d H:i:s');
            $candidate->save();
            
            //
            $updateHistory = TrHistoryProcess::find($request->process_id);
            $updateHistory->history_confirmation = date('Y-m-d H:i:s');
            $updateHistory->history_result = $request->result;
            $updateHistory->update_time = date('Y-m-d H:i:s');
            $updateHistory->update_by = $sess['name_holder'];
            $updateHistory->save();
            return response()->json(['status'=>'success'],200);    
        }
        else
        {
            return response()->json(['status'=>'error'],422);
        }
    }


    public function saveReschedule(Request $request)
    {
        $sess = Session::get('userinfo');
        $messages = [
            'date_process.required'    => 'The  Date time field is required.',
            'remarks.required'    => 'The  Reason field is required.',
        ]; 

        $validator =  Validator::make($request->all(), [
            'date_process' => 'required',
            'remarks'=>'required',
        ],$messages);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

           // update table candidate
        $candidate = Candidate::find($sess['candidate_id']);
        $candidate->result = $request->result;
        $candidate->process = 'CALLED';
        $candidate->date_process = date('Y-m-d H:i:s');
        $candidate->remarks = $request->remarks;
        $candidate->update_by = $sess['name_holder'];
        $candidate->update_time = date('Y-m-d H:i:s');
        
        //
        $updateHistory = TrHistoryProcess::find($request->process_id);
        $updateHistory->history_confirmation = date('Y-m-d H:i:s');
        $updateHistory->history_result = $request->result;
        $updateHistory->history_date = $request->date_process;
        $updateHistory->history_remarks =$request->remarks." || Reschedule Pada Tanggal :  ".$request->date_process;
        $updateHistory->save();


        return response()->json(['status'=>'success'],200);    
    }


}
