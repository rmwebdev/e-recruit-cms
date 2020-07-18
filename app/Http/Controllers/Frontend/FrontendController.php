<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Models\Candidate;
use App\Models\JobFptk;
use App\Models\TrHistoryProcess;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Mail\SendEmailToCandidate;
use App\Mail\SendEmailForgot;
use App\Mail\SendRegistrationEmail;
use App\Mail\SendConfirmationAttending;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use QrCode;
use Log;
use App\Imports\QRCode as QRCodeSuci;
use Excel;



class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        $result =  \DB::table('e_recruit.tr_job_fptk')
        ->select('division')
        ->whereNull('type_fptk')
        ->where('publish','Publish')
        ->where('is_closed','open')
        ->where('status','approved');

        if(!empty($request->search_general))
        {
            $result = $result->where('division','ilike','%'.$request->search_general.'%')
            ;
        }
        
        $result = $result->groupBy('division')
        ->paginate(5)->setPath('?search_general='.$request->search_general);


        $data['id'] = $request->candidate_id;
        $data['email'] = $request->key;
        $data['division'] = $result;


        $candidate = candidate::find(Session::get('userinfo')['candidate_id']);
        $data['process'] = (!empty($candidate)) ? $candidate->process : "REGISTRATION" ;


        if(!empty(Session::get('userinfo')['candidate_id']))
        {
          $data['candidate'] = $candidate;
          $data['job_ready'] = $candidate->job_fptk_id;
          $data['list_job'] = JobFptk::find($candidate->job_fptk_id);
        }


        $data['sess'] = Session::get('userinfo');
        return view('frontend.index_job_list',$data);
    }


    public function qr_code_suci()
    {   
       return view('frontend.qr_code_suci');
    }

    public function qr_action_suci(Request $req)
    {
        if ($req->hasFile('file_excel')) 
        {
            $file = $req->file('file_excel'); //GET FILE
            $import = new QRCodeSuci;
            $data['qr'] = Excel::toArray(new QRCodeSuci, $req->file('file_excel')); 

            $dt = Excel::toArray(new QRCodeSuci, $req->file('file_excel')); 
            for ($i=1; $i < count($dt[0]) ; $i++) {
                $url = 'https://qrickit.com/api/qr.php?d='.$dt[0][$i][0].'&addtext='.$dt[0][$i][0].'&qrsize=400&t=p&e=m"';

                $client = new \GuzzleHttp\Client([
                    'headers'   => ['Content-type' => 'application/json'],
                    'http_errors' => false
                ]);

                $response = $client->get($url);  
                $resp = $response->getBody()->getContents();   

                $imstr = base64_encode($resp);
                
                $data_image = base64_decode(preg_replace('#^data:image/\w+;base64,#i','','data:image/png;base64,'.$imstr));
                \Image::make($data_image)->save(storage_path('app/upload_file/' . $dt[0][$i][0].'.png'));
            }

            return '<img src="data:image/png;base64,'.base64_encode($resp).'" ">';
        }
    }

    public function regisCandidate(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name_holder' => 'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
            'email'=>'required|email',
            'captcha'=>'required'
        ]);
        $valid = $validator->errors()->toArray();

        if(!empty($valid['password'][0]))
        {
            if((string)$valid['password'][0] ==='The password confirmation does not match.')
            {
                $valid['password_confirmation'][0] = 'The password confirmation does not match.';
                unset($valid['password']);
            }
        }
            
        if($validator->fails())
        {
            return response()->json( array('errors' => $valid ),422);
        }


        $validEmail = Candidate::where('email',$request->email)->first();

        if($validEmail)
        {
            return response()->json(['errors'=>['email'=>'The candidate with email is already exist']],422);
        }


        $cekCandidate = Candidate::where('hp_1',formatNumber($request->phone_number))
        ->first();



        if($cekCandidate)
        {
            return response()->json(['errors'=>['candidate_error'=>'The candidate with phone number is already exist']],422);
        }
        
        $rules = ['captcha' => 'captcha'];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            echo json_encode(array('status' => 'captcha_error', 'message' => 'Sorry your captcha dont match'));
            die();
        }
        
      
        $pass = bcrypt($request->password);


        $candidate = new Candidate;

        $candidate->email = $request->email ;
        $candidate->name_holder = $request->name_holder;
        $candidate->password = $pass;
        $candidate->hp_1 = formatNumber($request->phone_number);
        $candidate->status = 2;
        $candidate->process = 'REGISTRATION';
        $candidate->received_date = date('Y-m-d');
        $candidate->insert_time = date('Y-m-d H:i:s');
        $candidate->registration_date = date('Y-m-d H:i:s');
        $candidate->insert_by = 'Candidate';
        $candidate->save();

        $paramHistory = [
                'candidate_id'=>$candidate->candidate_id,
                'result'=>'',
                'process'=>'REGISTRATION',
                'date_process'=>date('Y-m-d'),
                'remarks'=>'',
                'berkas'=>'',
                'history_position_name'=>0,
                'history_address' => '',
                'history_contact_person' => '',
                'history_confirmation' => '',
                'history_invitation_process' => '',
                'insert_by'=>'Candidate',
                'iq' => '',
                'pauli' => '',
                'disc' => '',
                'cbi' => '',
                'insert_time'=>date('Y-m-d H:i:s'),
            ];
        saveToHistory($paramHistory);


        $param = ['password'=>$pass,'candidate_id'=>$candidate->candidate_id];
        $data['candidate'] = $request->name_holder;
        $data['password'] = $param['password'];
        $data['candidate_id'] = $param['candidate_id'];
        Mail::to($request->email)->send(new SendRegistrationEmail($data));


        $updateStatus = Candidate::find($candidate->candidate_id);
        if( count(Mail::failures()) > 0 ) 
        {
            Log::info('Kirim Email => ERORRR, kirim email error !'); 
            $updateStatus->status_process  = 'FAILED';
            $updateStatus->save();
            return response()->json(['errors'=>['email_error'=>'Connection failures(101)']],422);
        } 
        else
        {
            Log::info('Kirim Email => SUCCESS, kirim email success !'); 
            $updateStatus->status_process  = 'SUCCESS';
            $updateStatus->save();
        }

        return response()->json(['status'=>'success'],200);
    }


    public function sendEmailActivation($email=null,$candidate=null,$param)
    {
        $data['candidate'] = $candidate;
        $data['password'] = $param['password'];
        $data['candidate_id'] = $param['candidate_id'];
        Mail::to($email)->send(new SendRegistrationEmail($data));
    }


    public function loginCandidate(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'password'=>'required',
            'email'=>'required|email',
        ]);
        $valid = $validator->errors()->toArray();
    

        if($validator->fails())
        {
            return response()->json( array('errors' => $valid ),422);
        }

        $candidate = Candidate::where('email',$request->email)->first();

        if(!$candidate)
        {
            return response()->json(['errors'=>[ 'email' =>['This email has not been registered']]],422);
        }


        if($candidate->status == 2)
        {
            return response()->json(['errors'=>[ 'email' =>['This email has not been activated, please check your email']]],422);
        }

        if($candidate)
        {
            $password =  Hash::check($request->password,$candidate->password);
            if($password)
            {
                $notif = TrHistoryProcess::where('candidate_id',$candidate->candidate_id)
                ->where('history_process','CALLED')
                ->where('history_result','SENT')
                ->count();
                $dataUser['candidate_id'] = $candidate->candidate_id;
                $dataUser['name_holder'] = $candidate->name_holder;
                $dataUser['email'] = $candidate->email;
                $dataUser['process'] = $candidate->process;
                $dataUser['result'] = $candidate->result;
                $dataUser['notif'] = $notif;

                Session::put('userinfo',$dataUser);
                $sumNotif = TrHistoryProcess::where('candidate_id',Session::get('userinfo')['candidate_id'])
                ->where('history_process','CALLED')
                ->whereIn('history_result',['SENT','REINVITED'])
                ->whereRaw("(history_confirmation = '' or history_confirmation is null)")
                ->count();

                return response()->json(['status'=>'success','notif'=>$sumNotif]); 
            }
            else
            {
                return response()->json(['errors'=>[ 'email' =>[' Login failed, please check email or password ']]],422);
            }
        }



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

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function getDescJob(Request $request)
    {
        $getJob = JobFptk::where('publish','Publish')->orderBy('job_fptk_id','desc')->first();
        $id = (empty($request->id)) ? $getJob->job_fptk_id : $request->id;

        $user = Session::get('userinfo');
        $candidate = candidate::find($user['candidate_id']);
        
        $data['job'] = JobFptk::findOrFail($id);
        $data['user'] = $user;
        $data['process'] = (!empty($candidate)) ? $candidate->process : "REGISTRATION" ;


        if(!empty($user))
        {
          $data['candidate'] = $candidate;
          $data['job_ready'] = $candidate->job_fptk_id;
          $data['list_job'] = JobFptk::find($candidate->job_fptk_id);
        }


        return view('frontend.getDescJob',$data);
    }

    public function saveJob(Request $request)
    {

        $candidate = Candidate::findOrFail($request->id);

        if($candidate->process == 'REGISTRATION')
        {
            return response()->json( array('status'=>'error','message' => 'Please input form candidate first !' ),422);
        }
        else
        {
            $candidate->job_fptk_id = $request->job_fptk_id;
            $candidate->received_date = date('Y-m-d');
            $candidate->save();
            return response()->json(['status'=>'success'],200);       
        }   
    }

 
    public function refreshCaptcha()
    {
        return captcha_img('default');
    }

    public function activatedAccount(Request $request)
    {
        $result = $request->result; 
        $id = base64_decode($request->id);

        if($id)
        {
            $update = Candidate::find($id);
            $update->status = 1;
            $update->save();
            return redirect('/')->with('status_regis','Your account has been successfully activated');
        }
        else
        {
            echo 'parameter not complete';
        }
    }

    public function confirmationEmail()
    {
        // session()->flush();
        return redirect('/form-candidate/confirmation')->with('confirmation','Please Login For Confirmation Job');      
    }


    public function sendEmailForgot(Request $request)
    {
         $messages = [
            'email_forgot.required'    => 'The email field is required.',
            'email_forgot.email'    => 'The email must be a valid email address.',
        ];

        $validator =  Validator::make($request->all(),[
            'email_forgot' => 'required|email',            
        ],$messages);


        $valid = $validator->errors()->toArray();

        if($validator->fails())
        {
            return response()->json( array('errors' => $valid ),422);
        }

        $candidate = Candidate::where('email',$request->email_forgot)->first();

        if(!$candidate)
        {
            return response()->json(['errors'=>[ 'email_forgot' =>['This email has not been registered']]],422);
        }

        $data['name_holder'] = $candidate->name_holder;
        $data['email'] = $candidate->email;
        $data['candidate_id'] = $candidate->candidate_id;

        Mail::to($request->email_forgot)->send(new SendEmailForgot($data));

        return response()->json(['status'=>'success'],200);
    }


    public function formForgotPassword(Request $request,$id)
    {
        session()->flush();
        return view('frontend.formForgotPassword');
    }

    public function actionForgotPassword(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
            
        ]);
        $valid = $validator->errors()->toArray();

        if(!empty($valid['password'][0]))
        {
            if((string)$valid['password'][0] ==='The password confirmation does not match.')
            {
                $valid['password_confirmation'][0] = 'The password confirmation does not match.';
                unset($valid['password']);
            }
        }

        if($validator->fails())
        {
            return response()->json( array('errors' => $valid ),422);
        }

        $candidate_id = $request->id;
        $can = Candidate::find($candidate_id);
        $cekPass =  Hash::check($can->email,$request->key);
        
        if(!$cekPass)
        {
            return response()->json( array('errors' => 'error_change_password' ),422);
        }
        $can->password = bcrypt($request->password);
        $can->save();       
        return response()->json(['status'=>'success'],200);
    }

    public function cek_ktp()
    {   
        $ktp_no = Input::get('ktp_no');
        $date_of_birth = Input::get('date_of_birth');
        $gender = Input::get('gender');

        $getCek = Candidate::where('ktp_no',$ktp_no)->first();

        if($getCek)
        {
            return ['errors'=>[ 'ktp_no' =>['The KTP is already exist']]];   
        }
        
        $validator =  Validator::make(Input::all(), [
            'ktp_no'=>'required|min:16|max:16',
        ]);
        $valid = $validator->errors();

        if($validator->fails())
        {
            return ['errors'=>$valid];
        }

        $cek = cek_format_ktp($ktp_no,$gender,$date_of_birth);

        if(!$cek)
        {
            return ['errors'=>[ 'ktp_no_valid' =>['Number of KTP is invalid']]];   
        }

        return response()->json(['status'=>'success'],200);
    }

    public function qr_code(Request $request)
    {
        $data['id'] = $request->param1;

        $id = base64_decode($data['id']);

        $candidate  = Candidate::with('job_fptk')->find($id);

        $exp = date('Y-m-d',strtotime($candidate->date_process."+1 days"));


        if((strtotime($exp) >  strtotime(now())))
        {
            $data['name'] = $candidate->name_holder;
            // $data['id'] = $id;
            $data['process'] = $candidate->process;
            $data['invitation_process'] = $candidate->invitation_process;
            $data['position_name'] = $candidate->job_fptk->position_name;
            $data['date_process'] = $candidate->date_process;
            $data['ktp_no'] = bcrypt($candidate->ktp_no);
            $data['until'] = date('Y-m-d',strtotime($candidate->date_process."+1 days"));
            return view('frontend.qr_code',$data);
        }
        else
        {
            return 'Sory qr code not found .. <a href='.url('/').'> Kembali </>';
        }  
        
    }


    public function scan_qr_code()
    {
        $data['id'] = Input::get('param1');
        $data['ktp_no'] = Input::get('param2');

        $id = base64_decode($data['id']);

        $candidate  = Candidate::with('job_fptk')->find($id);

        $ktp =  Hash::check($candidate->ktp_no,$data['ktp_no']);

        $exp = date('Y-m-d',strtotime($candidate->date_process."+1 days"));

        if($ktp  || (strtotime($exp) >  strtotime(now())))
        {
            $data['name'] = $candidate->name_holder;
            $data['process'] = $candidate->process;
            $data['invitation_process'] = $candidate->invitation_process;
            $data['position_name'] = $candidate->job_fptk->position_name;
            $data['date_process'] = $candidate->date_process;
            $data['until'] = date('Y-m-d',strtotime($candidate->date_process."+1 days"));
            return view('frontend.qr_code',$data);    
        }
        else
        {
            return 'Sory qr code not found .. <a href='.url('/').'> Kembali </>';
        }        
    }

    public function action_scan_qr_code(Request $request)
    {
        $data['id'] = Input::get('param1');
        $data['ktp_no'] = Input::get('param2');

        $id = base64_decode($data['id']);

        $candidate  = Candidate::with('job_fptk')->find($id);
        $fptk = JobFptk::find($candidate->job_fptk_id);

        $ktp =  Hash::check($candidate->ktp_no,$data['ktp_no']);


        $exp = date('Y-m-d',strtotime($candidate->date_process."+1 days"));

        if($ktp  || (strtotime($exp) >  strtotime(now())))
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
            return redirect('/');
        }
        else
        {
            return 'Sory candidate not found .. <a href='.url('/').'> Kembali </>';
        }
        
    }

    public function close_warning()
    {
        Session::put('warningFront','getSess');

        return response()->json(['status'=>'success']);
    }


    public function detail_job(Request $request)
    {
        
        $getJob = JobFptk::where('publish','Publish')->orderBy('job_fptk_id','desc')->first();
        $id = (empty($request->id_job)) ? $getJob->job_fptk_id : $request->id_job;

        $user = Session::get('userinfo');
        $candidate = candidate::find($user['candidate_id']);
        
        $data['job'] = JobFptk::findOrFail($id);
        $data['user'] = $user;
        $data['process'] = (!empty($candidate)) ? $candidate->process : "REGISTRATION" ;


        if(!empty($user))
        {
          $data['candidate'] = $candidate;
          $data['job_ready'] = $candidate->job_fptk_id;
          $data['list_job'] = JobFptk::find($candidate->job_fptk_id);
        }
        


        
        return view('frontend.detail_job',$data);    
    }


    public function to_other_url(Request $request)
    {

        if($request->type == 'website')
        {
            return redirect()->to('https://www.puninar.com');    
        }
        else if($request->type == 'instagram')
        {
            return redirect()->to('https://www.instagram.com/puninarlogistics');    
        }
        else if($request->type == 'linkedin')
        {
            return redirect()->to('https://www.linkedin.com/company/puninar-logistic/');    
        }
        else if($request->type == 'fb')
        {
            return redirect()->to('https://www.facebook.com/PuninarLogisticsOfficial/');    
        }
        
    }


}
