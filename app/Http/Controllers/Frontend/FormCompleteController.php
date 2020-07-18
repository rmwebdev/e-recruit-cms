<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Candidate;
use App\Models\Parameters;
use App\Models\JobFptk;
use App\Models\Assessment;
use App\Models\TRAssessment;
use App\Models\TrFamily;
use App\Models\TrCourse;
use App\Models\TrOrg;
use App\Models\TrLanguageSkill;
use App\Models\TrEmergencyContact;
use App\Models\TrJobInterest;
use App\Models\TrSkill;
use App\Models\TrEduBack;
use App\Models\TrJobExperience;
use App\Models\MasterSunfish;
use App\Models\MasterPersonal;
use Validator;
use DB;
use File;
use App\Imports\CandidateImport;
use Excel;
use Auth;
use Session;


class FormCompleteController extends Controller
{
    //
    protected $assessment;

    public function __construct()
    {
         $this->assessment = Assessment::all()->count();
    }

    public function index()
    {	
        $userinfo = Session::get('userinfo'); 
        $cand = Candidate::where('candidate_id',$userinfo['candidate_id'])->first();
        $family = MasterPersonal::family($userinfo['candidate_id']);
        $emergency_contact = MasterPersonal::emergency_contact($userinfo['candidate_id']);
        $education_background = MasterPersonal::education_background($userinfo['candidate_id']);
        $course_information = MasterPersonal::course_information($userinfo['candidate_id']);
        $skill = MasterPersonal::skill($userinfo['candidate_id']);
        $language_skill = MasterPersonal::language_skill($userinfo['candidate_id']);
        $org_information = MasterPersonal::org_information($userinfo['candidate_id']);
        $job_experience = MasterPersonal::job_experience($userinfo['candidate_id']);
        $job_interest = MasterPersonal::job_interest($userinfo['candidate_id']);
        $assess_can = TRAssessment::where('candidate_id',$userinfo['candidate_id'])->count();


        $data['assess_can'] = ($this->assessment != $assess_can) ? "Assessment, " : "";
        $data['family'] = ($family == 0) ? "Family Information, " : "";
        $data['emergency_contact'] = ($emergency_contact == 0) ? "Emergency Contact, " : "";
        $data['education_background'] = ($education_background == 0) ? "Educational Background, " : "";
        $data['course_information'] = ($course_information == 0) ? "Course Information, " : "";
        $data['skill'] = ($skill == 0) ? "Skill, " : "";
        $data['language_skill'] = ($language_skill == 0) ? "Language Skill, " : "";
        $data['org_information'] = ($org_information == 0) ? "Organization, " : "";
        $data['job_experience'] = ($job_experience == 0) ? "Job Experience, " : "";
        $data['job_interest'] = ($job_interest == 0) ? "Job Interest, " : "";
        

        $data['assessment'] = Assessment::all();
        $data['candidate'] = Candidate::find($userinfo['candidate_id']);
    	return view('frontend.form_complete.index_form_complete',$data);
    }

    public function refreshAlert()
    {
        $userinfo = Session::get('userinfo'); 
        $cand = Candidate::where('candidate_id',$userinfo['candidate_id'])->first();
        $family = MasterPersonal::family($userinfo['candidate_id']);
        $emergency_contact = MasterPersonal::emergency_contact($userinfo['candidate_id']);
        $education_background = MasterPersonal::education_background($userinfo['candidate_id']);
        $course_information = MasterPersonal::course_information($userinfo['candidate_id']);
        $skill = MasterPersonal::skill($userinfo['candidate_id']);
        $language_skill = MasterPersonal::language_skill($userinfo['candidate_id']);
        $org_information = MasterPersonal::org_information($userinfo['candidate_id']);
        $job_experience = MasterPersonal::job_experience($userinfo['candidate_id']);
        $job_interest = MasterPersonal::job_interest($userinfo['candidate_id']);
        $assess_can = TRAssessment::where('candidate_id',$userinfo['candidate_id'])->count();


        $assess_can = ($this->assessment != $assess_can) ? "Assessment, " : "";
        $family = ($family == 0) ? "Family Information, " : "";
        $emergency_contact = ($emergency_contact == 0) ? "Emergency Contact, " : "";
        $education_background = ($education_background == 0) ? "Educational Background, " : "";
        $course_information = ($course_information == 0) ? "Course Information, " : "";
        $skill = ($skill == 0) ? "Skill, " : "";
        $language_skill = ($language_skill == 0) ? "Language Skill, " : "";
        $org_information = ($org_information == 0) ? "Organization, " : "";
        $job_experience = ($job_experience == 0) ? "Job Experience, " : "";
        $job_interest = ($job_interest == 0) ? "Job Interest, " : "";
        // $npwp = (empty($cand->npwp)) ? "NPWP, " : "";
        

         if(
            ($family != "") || ($emergency_contact != "") || ($education_background != "") || ($skill != "") || ($language_skill != "") 
            //|| ($npwp !="") 
            || ($assess_can !="")
            ):

            echo '<div class="alert alert-danger" role="alert">
                          <span id="alertValid">Please complete data <strong>';
            //($npwp == 'NPWP,') ? "Personal Information" : "";


                if( ($family == 'Family Information, ' ) || ($emergency_contact == 'Emergency Contact, ' ) )
                {
                        echo "Family Information, ";                  
                }
                else if ( $education_background == 'Educational Background, '  )
                {
                     echo "Educational Background,  ";
                }
                else if ( ($skill == 'Skill, ')  || ($language_skill == 'Language Skill, ') )
                {
                        echo "Skill,  ";
                }
                else if ( $assess_can == 'Assessment, '  )
                {
                        echo "Assessment,  ";
                }
                else 
                {
                     echo '</strong> for next step . </span></div>';
                }


                // if ( $education_background == 'Educational Background, '  ):
                //         echo "Educational Background,  ";
                // endif;

                // if ( ($skill == 'Skill, ')  || ($language_skill == 'Language Skill, ') ):
                //         echo "Skill,  ";
                // endif;

                // if ( $assess_can == 'Assessment, '  ):
                //         echo "Assessment,  ";
                // endif;

                //     echo '</strong> for next step . </span></div>';
            
        endif;
    }

    // function for get personal info
    public function personalInfo()
    {
    	$data['assessment'] = Assessment::all();
        $userinfo = Session::get('userinfo');
        $data['candidate'] = Candidate::find($userinfo['candidate_id']);
        $data['userinfo'] = Session::get('userinfo');
        $data['relationship']  = MasterSunfish::family();
        $data['occupation']  = MasterSunfish::occupation();
        $data['education']  = MasterSunfish::education();
        $data['gender']  = Parameters::gender()->get();
        $data['religion']  = MasterSunfish::religion();
        $data['marital']  = Parameters::marital()->get();
        $data['nationality']  = Parameters::nationality()->get();
        $data['major']  = MasterSunfish::major();
        $data['city']  = MasterSunfish::city();
        $data['list_school']  = MasterSunfish::list_school();
        $data['source']  = Parameters::source()->get();
    	return view('frontend.form_complete.personalInfo_form_complete',$data);	
    }

    // function for update personal info
    public function store(Request $request)
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

        $getCan = Candidate::find($request->candidate_id);
    
    
        $file_1 = ($getCan->file_1 != $request->file_1_edit) ? "required|mimes:jpeg,jpg,png|max:2000" : ""; 
        $file_2 = ($getCan->file_2 != $request->file_2_edit) ? "required|mimes:pdf|max:2000" : ""; 

        $destinationPath = 'upload_file';

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
            'edu_degree'=>'required',
            'edu_major'=>'required',
            'edu_university'=>'required',
            'edu_ipk'=>'required',
            'edu_start_year'=>'required',
            'edu_end_year'=>'required',
            'source'=>'required',
            'gender'=>'required',
            'npwp' => 'required|numeric',
            'file_1' => $file_1,
            'file_2' => $file_2,
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


        $tot_row = $request->tot;
        $validate_array = [];


        $msgAsses = [
            'hideChoose*.required'    => 'This assessment is required  .'
        ];

        for($i= 1;$i<=$tot_row;$i++)
        {   
            if(empty($_POST['hideChoose'.$i]))
            {
                 $validate_array['hideChoose'. $i] = 'required';
            }
        }

        $validator =  Validator::make($request->all(),$validate_array,$msgAsses);
     
        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        $file_photo = (empty($request->file('file_1'))) ?  $request->file_1_edit : $fileNamePhoto;
        $file_cv = (empty($request->file('file_2'))) ?  $request->file_2_edit : $fileNameCv ;

        $candidate_id =  Candidate::where('email',$request->email)->first();
        $candidate = Candidate::find($candidate_id->candidate_id);

        $tanggal_lahir =  date('Y-m-d', strtotime($request->date_of_birth));

        $candidate->name_holder = $request->name_holder;
        $candidate->ktp_no = $request->ktp_no;
        $candidate->date_of_birth = $tanggal_lahir;
        $candidate->place_of_birth = $request->place_of_birth;
        $candidate->religion = $request->religion;
        $candidate->city = $request->city;
        $candidate->marital_status = $request->marital_status;
        $candidate->address = $request->address;
        $candidate->nationality = $request->nationality;
        $candidate->hp_1 = formatNumber($request->hp_1);
        $candidate->gender = trim($request->gender);
        $candidate->hp_2 = trim($request->hp_2);
        $candidate->email = trim($request->email);
        $candidate->phone_no = trim($request->phone_no);
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
        $candidate->file_1 = $file_photo;
        $candidate->file_2 = $file_cv;
        $candidate->received_date = date('Y-m-d');
        $candidate->npwp = $request->npwp;
        $candidate->npwp_address = $request->npwp_address;
        $candidate->sim_a = $request->sim_a;
        $candidate->sim_b = $request->sim_b;
        $candidate->sim_c = $request->sim_c;
        $candidate->sim_other = $request->sim_other;
        $candidate->update_by = $request->name_holder;
        $candidate->update_time = date('Y-m-d H:i:s');


        $candidate->save();

        $paramHistory = [
                'candidate_id'=>$request->candidate_id,
                'result'=>'PASSED',
                'process'=>'CV IN',
                'date_process'=>date('Y-m-d H:i:s'),
                'remarks'=>$request->remarks,
                'history_position_name'=>'',
                'history_address' => '',
                'history_contact_person' => '',
                'history_confirmation' => '',
                'history_invitation_process' => '',
                'berkas'=>'',
                'iq' => '',
                'pauli' => '',
                'disc' => '',
                'cbi' => '',
                'insert_by'=>Session::get('userinfo')['name_holder'],
                'insert_time'=>date('Y-m-d H:i:s')
            ];

        $save_history  = saveToHistory($paramHistory);
        if(!$save_history)
        {
            return response()->json( array('status' => 'success','status_history'=>'HistoryAlready'),200);
        }


        TRAssessment::where('candidate_id', $candidate_id->candidate_id)->delete();        
        for($i= 1;$i<=$tot_row;$i++)
        {   
            $assessment = new TRAssessment;
            $assessment->candidate_id = $candidate_id->candidate_id;
            $assessment->asses_quest_id =  $request['asses_quest_id'.($i)];  
            $assessment->answer = $request['hideChoose'.($i)]; 
            $assessment->remarks = $_POST['textAnswer'.$i.''];
            $assessment->created_at = date('Y-m-d H:i:s');
            $assessment->updated_at = date('Y-m-d H:i:s');
            $assessment->save();
        }


		return response()->json(['status'=>'success'],200);
    }

    // function for get data family info
    public function familyInfo()
    {
    	$data['family'] = TrFamily::where('candidate_id', Session::get('userinfo')['candidate_id'])
               ->orderBy('family_id', 'desc')
               ->get();
        $data['emergency_contact'] = TrEmergencyContact::where('candidate_id', Session::get('userinfo')['candidate_id'])->orderBy('emergency_contact_id', 'desc')->get();
        $data['relationship']  = MasterSunfish::family();
        $data['occupation']  = MasterSunfish::occupation();
        $data['education']  = MasterSunfish::education();
        $data['gender']  = Parameters::gender()->get();
    	return view('frontend.form_complete.familyInfo_form_complete',$data);
    }    

    // function for get data course candidate
    public function courseInfo()
    {
        $data['courseInfo'] = TrCourse::where('candidate_id', Session::get('userinfo')['candidate_id'])
               ->orderBy('course_info_id', 'desc')
               ->get();

        return view('frontend.form_complete.courseInfo_form_complete',$data);
    }    

    // function for get organization candidate
    public function orgInfo()
    {
        $data['orgInfo'] = TrOrg::where('candidate_id', Session::get('userinfo')['candidate_id'])
               ->orderBy('org_information_id', 'desc')
               ->get();
        $data['point']  = MasterSunfish::point();
        $data['list_school']  = MasterSunfish::list_school();

        return view('frontend.form_complete.orgInfo_form_complete',$data);
    }    

    // function for get language skill candidate
    public function langSkill()
    {
        $data['langSkill'] = TrLanguageSkill::where('candidate_id', Session::get('userinfo')['candidate_id'])
               ->orderBy('lang_skill_id', 'desc')
               ->get();
        $data['skill'] = TrSkill::where('candidate_id', Session::get('userinfo')['candidate_id'])->orderBy('skill_id','desc')->get();
        $data['list_skill'] = MasterSunfish::skill();
        $data['language'] = MasterSunfish::language();
        return view('frontend.form_complete.lang_skill_form_complete',$data);
    }

    // function for get education background candidate
    public function eduBack()
    {
        $data['eduBack'] = TrEduBack::where('candidate_id', Session::get('userinfo')['candidate_id'])
               ->orderBy('edu_back_id', 'desc')
               ->get();
        $data['edu_back_level']  = MasterSunfish::education();
        $data['list_school']  = MasterSunfish::list_school();
        $data['major']  = MasterSunfish::major();

        return view('frontend.form_complete.eduBack_form_complete',$data);
    }

    // function for get job experience candidate
    public function jobExp()
    {
        $data['jobExp'] = TrJobExperience::where('candidate_id', Session::get('userinfo')['candidate_id'])
               ->orderBy('job_exp_id', 'desc')
               ->get();
        $data['jobInterest'] = TrJobInterest::where('candidate_id',Session::get('userinfo')['candidate_id'])->orderBy('sort','desc')->get();
        $data['resign_cause'] = MasterSunfish::resign_cause();

        return view('frontend.form_complete.jobExp_form_complete',$data);
    }


    public function other()
    {
    	$data['assessment'] = Assessment::all();
        $data['assessment_comp'] = TRAssessment::where('candidate_id',Session::get('userinfo')['candidate_id'])->count();
    	return view('frontend.form_complete.viewAsses_form_complete',$data);
    }

    // function save family candidate
    public function saveFamily(Request $request)
    {	

        $tanggal_lahir =  date('Y-m-d', strtotime((string)$request->birth_of_date));

    	 $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'relationship'=>'required',
            'gender'=>'required',
            'birth_place'=>'required',
            'birth_of_date'=>'required',
            'last_education' =>'required',
            'occupation' =>'required',
        ]);

    	if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no'=>$request->id_no),422);
        }
        $userinfo = Session::get('userinfo'); 
    
        $family = new TrFamily;
        $family->name = $request->name;
        $family->candidate_id = Session::get('userinfo')['candidate_id'];
        $family->relationship = $request->relationship;
        $family->gender = $request->gender;
        $family->birth_place = $request->birth_place;
        $family->birth_of_date = $tanggal_lahir;
        $family->last_education = $request->last_education;
        $family->occupation = $request->occupation;
        $family->insert_time = date('Y-m-d H:i:s');
        $family->insert_by = Session::get('userinfo')['name_holder'] ;
        $family->save();

        $cek_form_complete = 0;
        if($request->id != 0)
        {
            $cek_form_complete = cek_form_complete(Session::get('userinfo'),$request->id,$request->process_id,$request->result);
        }
        

        return response()->json(['status'=>'success','result'=>$cek_form_complete],200);
    }


       // function save family candidate
    public function saveEmergencyContact(Request $request)
    {   

        $tanggal_lahir =  date('Y-m-d', strtotime((string)$request->birth_of_date));

         $validator =  Validator::make($request->all(), [
            'emergency_name' => 'required',
            'emergency_address'=>'required',
            'emergency_relation'=>'required',
            'emergency_phone'=>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no'=>$request->id_no),422);
        }

        $family = new TrEmergencyContact;
        $family->emergency_name = $request->emergency_name;
        $family->emergency_address = $request->emergency_address;
        $family->emergency_relation = $request->emergency_relation;
        $family->emergency_phone = $request->emergency_phone;
        $family->candidate_id = Session::get('userinfo')['candidate_id'];
        $family->insert_time = date('Y-m-d H:i:s');
        $family->insert_by = Session::get('userinfo')['name_holder'] ;
        $family->save();

        $cek_form_complete = 0;
        if($request->id != 0)
        {
            $cek_form_complete = cek_form_complete(Session::get('userinfo'),$request->id,$request->process_id,$request->result);
        }
        

        return response()->json(['status'=>'success','candidate_id'=>$request->candidate_id,'result'=>$cek_form_complete],200);
    }


      // function update emergency contact
    public function updateEmergencyContact(Request $request)
    {   


         $validator =  Validator::make($request->all(), [
            'rowEmergencyName' => 'required',
            'rowEmergencyAddress'=>'required',
            'rowEmergencyRelation'=>'required',
            'rowEmergencyPhone'=>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'emergency_contact_id'=>$request->emergency_contact_id),422);
        }

        $emergency_contact = TrEmergencyContact::find($request->emergency_contact_id);
        $emergency_contact->emergency_name = $request->rowEmergencyName;
        $emergency_contact->emergency_address = $request->rowEmergencyAddress;
        $emergency_contact->emergency_relation = $request->rowEmergencyRelation;
        $emergency_contact->emergency_phone = $request->rowEmergencyPhone;

        $emergency_contact->update_by = Session::get('userinfo')['name_holder'] ;
        $emergency_contact->save();

        return response()->json(['status'=>'success','candidate_id'=>$emergency_contact->candidate_id],200);
    }


        // function for delete emergency contact 
    public function deleteEmergencyContact($emergency_contact_id)
    {
        if(!empty($emergency_contact_id))
        {
            $delete  = TrEmergencyContact::find($emergency_contact_id);
            $delete->delete();   
            return response()->json(['status'=>'success','candidate_id'=>$delete->candidate_id],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }  


   // function update family candidate
    public function updateFamily(Request $request)
    {   
        $tanggal_lahir =  date('Y-m-d', strtotime((string)$request->rowBirthOfDate));
         $validator =  Validator::make($request->all(), [
            'rowName' => 'required',
            'rowRelationship'=>'required',
            'rowGender'=>'required',
            'rowBirthPlace'=>'required',
            'rowBirthOfDate'=>'required',
            'rowLastEducation' =>'required',
            'rowOccupation' =>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'family_id'=>$request->family_id),422);
        }

        $family = TrFamily::find($request->family_id);
        $family->name = $request->rowName;
        $family->relationship = $request->rowRelationship;
        $family->gender = $request->rowGender;
        $family->birth_place = $request->rowBirthPlace;
        $family->birth_of_date = $tanggal_lahir;
        $family->last_education = $request->rowLastEducation;
        $family->occupation = $request->rowOccupation;
        $family->update_time = date('Y-m-d H:i:s');
        $family->update_by = Session::get('userinfo')['name_holder'];
        $family->save();

        return response()->json(['status'=>'success','candidate_id'=>$family->candidate_id],200);
    }


    // function for save course candidate
    public function saveCourse(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'course_type' => 'required',
            'topic'=>'required',
            'institution'=>'required',
            'start_year'=>'required',
            'end_year'=>'required',
           
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_course'=>$request->id_no_course),422);
        }

        $course = new TrCourse;
        $course->course_type = $request->course_type;
        $course->candidate_id = Session::get('userinfo')['candidate_id'];
        $course->topic = $request->topic;
        $course->institution = $request->institution;
        $course->start_year = $request->start_year;
        $course->end_year = $request->end_year;
        $course->insert_time = date('Y-m-d H:i:s');
        $course->insert_by = Session::get('userinfo')['name_holder'] ;
        $course->save();

        return response()->json(['status'=>'success'],200);
    }

    // function for update course candidate
    public function updateCourse(Request $request)
    {   
      $validator =  Validator::make($request->all(), [
            'rowCourseType' => 'required',
            'rowTopic'=>'required',
            'rowInstitution'=>'required',
            'rowStartYear'=>'required',
            'rowEndYear'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'course_info_id'=>$request->course_info_id),422);
        }

        $course = TrCourse::find($request->course_info_id);
        $course->course_type = $request->rowCourseType;
        $course->topic = $request->rowTopic;
        $course->institution = $request->rowInstitution;
        $course->start_year = $request->rowStartYear;
        $course->end_year = $request->rowEndYear;
        $course->update_time = date('Y-m-d H:i:s');
        $course->update_by = Session::get('userinfo')['name_holder'] ;
        $course->save();

        return response()->json(['status'=>'success'],200);
    }

    // function for save organization candidate
    public function saveOrgInfo(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'organization' => 'required',
            'position'=>'required',
            'start_year'=>'required',
            'end_year'=>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_orgInfo'=>$request->id_no_orgInfo),422);
        }

        $course = new TrOrg;
        $course->organization = $request->organization;
        $course->candidate_id = Session::get('userinfo')['candidate_id'];
        $course->position = $request->position;
        $course->start_year = $request->start_year;
        $course->end_year = $request->end_year;
        $course->insert_time = date('Y-m-d H:i:s');
        $course->insert_by = Session::get('userinfo')['name_holder'] ;
        $course->save();

        return response()->json(['status'=>'success'],200);
    }

    // function for update organization candidate
    public function updateOrgInfo(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'rowOrganization' => 'required',
            'rowPosition'=>'required',
            'rowStartYear'=>'required',
            'rowEndYear'=>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'org_information_id'=>$request->org_information_id),422);
        }

        $course = TrOrg::find($request->org_information_id);
        $course->organization = $request->rowOrganization;
        $course->position = $request->rowPosition;
        $course->start_year = $request->rowStartYear;
        $course->end_year = $request->rowEndYear;
        $course->update_time = date('Y-m-d H:i:s');
        $course->update_by = Session::get('userinfo')['name_holder'] ;
        $course->save();

        return response()->json(['status'=>'success'],200);
    }

// function for save language skill candidate
    public function saveLangSkill(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'language_name' => 'required',
            'read_score'=>'required',
            'speak_score'=>'required',
            'write_score'=>'required',
            'listen_score'=>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_langSkill'=>$request->id_no_langSkill),422);
        }

        $langSkill = new TrLanguageSkill;
        $langSkill->language_name = $request->language_name;
        $langSkill->candidate_id = Session::get('userinfo')['candidate_id'];
        $langSkill->read_score = $request->read_score;
        $langSkill->speak_score = $request->speak_score;
        $langSkill->write_score = $request->write_score;
        $langSkill->listen_score = $request->listen_score;
        $langSkill->insert_time = date('Y-m-d H:i:s');
        $langSkill->insert_by = Session::get('userinfo')['name_holder'] ;
        $langSkill->save();

        $cek_form_complete = 0;
        if($request->id != 0)
        {
            $cek_form_complete = cek_form_complete(Session::get('userinfo'),$request->id,$request->process_id,$request->result);
        }
        

        return response()->json(['status'=>'success','result'=>$cek_form_complete],200);
    }

    // function for update language skill candidate
    public function updateLangSkill(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'rowLanguageName' => 'required',
            'rowReadScore'=>'required',
            'rowSpeakScore'=>'required',
            'rowWriteScore'=>'required',
            'rowListenScore'=>'required',
           
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_langSkill'=>$request->id_no_langSkill),422);
        }

       $langSkill = TrLanguageSkill::find($request->id_no_langSkill);
       $langSkill->language_name = $request->rowLanguageName;
       $langSkill->read_score = $request->rowReadScore;
       $langSkill->speak_score = $request->rowSpeakScore;
       $langSkill->write_score = $request->rowWriteScore;
       $langSkill->listen_score = $request->rowListenScore;
       $langSkill->update_time = date('Y-m-d H:i:s');
       $langSkill->update_by = Session::get('userinfo')['name_holder'] ;
       $langSkill->save();

        return response()->json(['status'=>'success'],200);
    }


// function for save  skill candidate
    public function saveSkill(Request $request)
    {   

         $validator =  Validator::make($request->all(), [
            'skill_name' => 'required',
            'score'=>'required',           
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_skill'=>$request->id_no_skill),422);
        }

        $course = new TrSkill;
        $course->skill_name = $request->skill_name;
        $course->candidate_id = Session::get('userinfo')['candidate_id'];
        $course->score = $request->score;
        $course->skill_description = $request->skill_description;
        $course->insert_time = date('Y-m-d H:i:s');
        $course->insert_by = Session::get('userinfo')['name_holder'] ;
        $course->save();

        $cek_form_complete = 0;
        if($request->id != 0)
        {
            $cek_form_complete = cek_form_complete(Session::get('userinfo'),$request->id,$request->process_id,$request->result);
        }

        return response()->json(['status'=>'success','result'=>$cek_form_complete],200);
    }

    // function for update skill candidate
    public function updateSkill(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
           'rowSkillName' => 'required',
            'rowScore'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'skill_id'=>$request->skill_id),422);
        }


        $course = TrSkill::find($request->skill_id);
        $course->skill_name = $request->rowSkillName;
        $course->score = $request->rowScore;
        $course->skill_description = $request->rowSkillDescription;
        $course->update_time = date('Y-m-d H:i:s');
        $course->update_by = Session::get('userinfo')['name_holder'] ;
        $course->save();

        return response()->json(['status'=>'success'],200);
    }

        // function save education background candidate
    public function saveEduBack(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'edu_back_level' => 'required',
            'institution'=>'required',
            'major'=>'required',
            'gpa'=>'required',
            'institution'=>'required',
            'edu_back_city'=>'required',
            'start_edu_back' =>'required',
            'end_edu_back' =>'required',
        ]);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_eduBack'=>$request->id_no_eduBack),422);
        }

        $getListSchool = MasterSunfish::getListSchool($request->institution);

        $eduBack = new TrEduBack;
        $eduBack->candidate_id = Session::get('userinfo')['candidate_id'];
        $eduBack->edu_back_level = $request->edu_back_level;
        $eduBack->major = $request->major;
        $eduBack->institution = $getListSchool;
        $eduBack->gpa = $request->gpa;
        $eduBack->edu_back_city = $request->edu_back_city;
        $eduBack->start_edu_back = $request->start_edu_back;
        $eduBack->end_edu_back = $request->end_edu_back;
        $eduBack->insert_time = date('Y-m-d H:i:s');
        $eduBack->insert_by = Session::get('userinfo')['name_holder'] ;
        $eduBack->save();

        $cek_form_complete = 0;
        if($request->id != 0)
        {
            $cek_form_complete = cek_form_complete(Session::get('userinfo'),$request->id,$request->process_id,$request->result);
        }

        return response()->json(['status'=>'success','result'=>$cek_form_complete],200);
    }

    // function update Education Background candidate
    public function updateEduBack(Request $request)
    {   
          $validator =  Validator::make($request->all(), [
           'rowEduBackLevel' => 'required',
            'rowInstitution'=>'required',
            'rowMajor'=>'required',
            'rowGpa'=>'required',
            'rowEduBackCity'=>'required',
            'rowStartEduBack' =>'required',
            'rowEndEduBack' =>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_eduBack'=>$request->id_no_eduBack),422);
        }

        $getListSchool = MasterSunfish::getListSchool($request->rowInstitution);


        $eduBack = TrEduBack::find($request->id_no_eduBack);
        $eduBack->edu_back_level = $request->rowEduBackLevel;
        $eduBack->major = $request->rowMajor;
        $eduBack->gpa = $request->rowGpa;
        $eduBack->institution = $getListSchool;
        $eduBack->edu_back_city = $request->rowEduBackCity;
        $eduBack->start_edu_back = $request->rowStartEduBack;
        $eduBack->end_edu_back = $request->rowEndEduBack;
        $eduBack->insert_time = date('Y-m-d H:i:s');
        $eduBack->insert_by = Session::get('userinfo')['name_holder'] ;
        $eduBack->save();

        return response()->json(['status'=>'success'],200);
    }

     // function save job Interest candidate
    public function saveJobInterest(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'type_of_work' => 'required',
            'sort'=>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_JobInterest'=>$request->id_no_JobInterest),422);
        }

        $jobExp = new TrJobInterest;
        $jobExp->type_of_work = $request->type_of_work;
        $jobExp->sort = $request->sort;
        $jobExp->candidate_id = Session::get('userinfo')['candidate_id'];
        
        $jobExp->insert_time = date('Y-m-d H:i:s');
        $jobExp->insert_by = Session::get('userinfo')['name_holder'] ;
        $jobExp->save();

        return response()->json(['status'=>'success','candidate_id'=>$request->candidate_id],200);
    }

      // function update job interest candidate
    public function updateJobInterest(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'rowTypeOfWork' => 'required',
            'rowSort'=>'required',
        ]);
         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_JobInterest'=>$request->id_no_JobInterest),422);
        }

        $jobInterest = TrJobInterest::find($request->id_no_JobInterest);
        $jobInterest->type_of_work = $request->rowTypeOfWork;
        $jobInterest->sort = $request->rowSort;
        $jobInterest->update_time = date('Y-m-d H:i:s');
        $jobInterest->update_by = Session::get('userinfo')['name_holder'] ;
        $jobInterest->save();

        return response()->json(['status'=>'success','candidate_id'=>$jobInterest->candidate_id],200);
    }


    // function for delete job interest candidate 
    public function deleteJobInterest($job_interest_id)
    {
        if(!empty($job_interest_id))
        {
            $delete  = TrJobInterest::find($job_interest_id);
            $delete->delete();   
            return response()->json(['status'=>'success','candidate_id'=>$delete->candidate_id],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }

        // function save job experience candidate
    public function saveJobExp(Request $request)
    {   
         $validator =  Validator::make($request->all(), [
            'company_name' => 'required',
            'position_exp'=>'required',
            'company_address'=>'required',
            'terminated_reason'=>'required',
             'start_job_exp'=>'required',
            'end_job_exp' =>'required',
        ]);

         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_JobExp'=>$request->id_no_JobExp),422);
        }

        $jobExp = new TrJobExperience;
        $jobExp->company_name = $request->company_name;
        $jobExp->candidate_id = Session::get('userinfo')['candidate_id'];
        $jobExp->position_exp = $request->position_exp;
        $jobExp->company_address = $request->company_address;
        $jobExp->terminated_reason = $request->terminated_reason;
        $jobExp->current_salary = 0;
        $jobExp->start_job_exp = $request->start_job_exp;
        $jobExp->end_job_exp = $request->end_job_exp;
        $jobExp->job_exp_desc = $request->job_exp_desc;
        $jobExp->insert_time = date('Y-m-d H:i:s');
        $jobExp->insert_by = Session::get('userinfo')['name_holder'] ;
        $jobExp->save();

        return response()->json(['status'=>'success'],200);
    }

    // function update job experience candidate
    public function updateJobExp(Request $request)
    {   

         $validator =  Validator::make($request->all(), [
            'rowCompanyName' => 'required',
            'rowPositionExp'=>'required',
            'rowCompanyAddress'=>'required',
            'rowTerminatedReason'=>'required',
            'rowStartJobExp'=>'required',
            'rowEndJobExp' =>'required',
        ]);
         if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray(),'id_no_JobExp'=>$request->id_no_JobExp),422);
        }

        $jobExp = TrJobExperience::find($request->id_no_JobExp);
        $jobExp->company_name = $request->rowCompanyName;
        $jobExp->position_exp = $request->rowPositionExp;
        $jobExp->company_address = $request->rowCompanyAddress;
        $jobExp->terminated_reason = $request->rowTerminatedReason;
        $jobExp->current_salary = 0;
        $jobExp->start_job_exp = $request->rowStartJobExp;
        $jobExp->end_job_exp = $request->rowEndJobExp;
        $jobExp->job_exp_desc = $request->rowJobExpDesc;
        $jobExp->insert_time = date('Y-m-d H:i:s');
        $jobExp->insert_by = Session::get('userinfo')['name_holder'] ;
        $jobExp->save();

        return response()->json(['status'=>'success'],200);
    }


    // function for delete family candidate 
    public function deleteFamily($family_id)
    {
        if(!empty($family_id))
        {
            $delete  = TrFamily::find($family_id);
            $delete->delete();   
            return response()->json(['status'=>'success'],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }    

    // function for delete course candidate 
    public function deleteCourse($course_info_id)
    {
        if(!empty($course_info_id))
        {
            $delete  = TrCourse::find($course_info_id);
            $delete->delete();   
            return response()->json(['status'=>'success'],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }

    // function for delete language skill candidate 
    public function deleteLangSkill($lang_skill_id)
    {
        if(!empty($lang_skill_id))
        {
            $delete  = TrLanguageSkill::find($lang_skill_id);
            $delete->delete();   
            return response()->json(['status'=>'success'],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }

    // function for delete  skill candidate 
    public function deleteSkill($Skill_id)
    {
        if(!empty($Skill_id))
        {
            $delete  = TrSkill::find($Skill_id);
            $delete->delete();   
            return response()->json(['status'=>'success'],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }

    // function for delete Organization candidate 
    public function deleteOrganization($org_information_id)
    {
        if(!empty($org_information_id))
        {
            $delete  = TrOrg::find($org_information_id);
            $delete->delete();   
            return response()->json(['status'=>'success'],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }
    

  // function for delete Education Background candidate 
    public function deleteEduBack($edu_back_id)
    {
        if(!empty($edu_back_id))
        {
            $delete  = TrEduBack::find($edu_back_id);
            $delete->delete();   
            return response()->json(['status'=>'success'],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }

 // function for delete job experience candidate 
    public function deleteJobExp($job_exp_id)
    {
        if(!empty($job_exp_id))
        {
            $delete  = TrJobExperience::find($job_exp_id);
            $delete->delete();   
            return response()->json(['status'=>'success'],200); 
        }
        else
        {
            return response()->json(['status'=>'error'],422); 
        }
    }

    public function getDropDownFamily()
    {
        $relationship  = MasterSunfish::family();
        $gender  = Parameters::gender()->get();
        $occupation  = MasterSunfish::occupation();
        $education  = MasterSunfish::education();
        return response()->json(['status'=>'success','relationship'=>$relationship,'gender'=>$gender,'occupation'=>$occupation,'last_education'=>$education],200); 
    }

    public function getDropDownEducation()
    {
        // $edu_back_level  = Parameters::education()->get();
        $edu_back_level  = MasterSunfish::education();
        $major  = MasterSunfish::major();
        $list_school  = MasterSunfish::list_school();
        return response()->json(['status'=>'success','edu_back_level'=>$edu_back_level,'major'=>$major,'list_school'=>$list_school],200); 
    }


    public function getDropDownSkill()
    {
        $skill  = MasterSunfish::skill();
        $language  = MasterSunfish::language();
        return response()->json(['status'=>'success','skill'=>$skill,'language'=>$language],200); 
    }

    public function getDropJob()
    {
        $reason  = MasterSunfish::resign_cause();
        return response()->json(['status'=>'success','reason'=>$reason],200); 
    }


    public function fetch(Request $request)
    {
        $list_school  = DB::table('e_recruit.tm_list_school')->where('name','like','%'.ucfirst($_POST['query']).'%')->get();
        $output = '';
        
        if($list_school->isEmpty())
        {
         
            $output = '<ul></ul>';
        }
        else
        {
            $output = '<ul class="dropdown-menu list-menu" style="display:block; position:relative">';
              foreach($list_school as $row)
              {
               $output .= '
               <li style="padding: 0.25rem 1.5rem;"><a href="#" id="getList">'.$row->name.'</a></li>
               ';
              }
              $output .= '</ul>';
        }
          echo $output;
    }

    public function changePhoto(Request $request)
    {
        $messages = [
             'file_1.mimes'    => 'Photo profile must be a JPG JPEG PNG.',
        ]; 
      
        $destinationPath = 'upload_file';

        $validator =  Validator::make($request->all(), [
            'file_1' => 'mimes:jpeg,jpg,png|max:2000',
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

        $can = Candidate::find($request->candidate_id);

        $can->file_1 = $fileNamePhoto;
        $can->save();

        return response()->json(['status'=>'success'],200); 
    }

    public function changeCV(Request $request)
    {
        $messages = [
            'file_2.mimes'    => '  CV must be a  pdf file .',
            'file_2.max'    => '  CV must be a  greater than 2000 kilobytes .',
        ]; 
    
        $destinationPath = 'upload_file';

        $validator =  Validator::make($request->all(), [
            'file_2' => 'mimes:pdf|max:2000',
        ], $messages);

        if($validator->fails())
        {
            return response()->json( array('errors' => $validator->errors()->toArray()),422);
        }

        $destinationPath = 'upload_file';
        if(!empty($request->file('file_2')))
        {
            File::delete($destinationPath.'/'.$request->file_2_edit);
            $fileNameCv = uploadFile($request->file('file_2'),$destinationPath);
        }


        $can = Candidate::find($request->candidate_id);

        $can->file_2 = $fileNameCv;
        $can->save();

        return response()->json(['status'=>'success','url'=>$fileNameCv],200); 
    }

    public function formAssessment(Request $request)
    {
        $count = Assessment::get()->count();
        $candidate_assessment = TRAssessment::where('candidate_id',$request->candidate_id)->count();

    
        TRAssessment::where('candidate_id',$request->candidate_id)->delete();

        $textAnswer= '';
        TRAssessment::where('candidate_id', $request->candidate_id)->delete();        
        for($i= 1;$i<=$request->tot;$i++)
        {   
            if (!empty($_POST['textAnswer'.$i])) 
            {
                $textAnswer = $_POST['textAnswer'.$i.''];
            }

            $assessment = new TRAssessment;
            $assessment->candidate_id = $request->candidate_id;
            $assessment->asses_quest_id =  $request['asses_quest_id'.($i)];  
            // $assessment->answer = $request['hideChoose'.($i)]; 
            $assessment->answer = $request['assessment'.($i)]; 
            $assessment->remarks = $textAnswer;
            $assessment->created_at = date('Y-m-d H:i:s');
            $assessment->updated_at = date('Y-m-d H:i:s');
            $assessment->save();
        }

        $cek_form_complete = 0;
        if($request->id != 0)
        {
            $cek_form_complete = cek_form_complete(Session::get('userinfo'),$request->id,$request->process_id,$request->result);
        }
        

        return response()->json(['status'=>'success','result'=>$cek_form_complete],200); 
        
    }


}
