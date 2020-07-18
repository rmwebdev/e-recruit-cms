<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use App\Mail\SendEmailToCandidate;
use Illuminate\Support\Facades\Mail;
use App\Models\TrHistoryProcess;
use App\Models\Candidate;
use App\Models\MasterPersonal;
use App\Models\TRAssessment;
use App\Models\JobFptk;
use GuzzleHttp as GuzzleHttp; 
use DB as DB;

function uploadFile($file, $path, $originalName = false)
{
    if ($originalName === true) {
        $filename = preg_replace('@[^0-9a-z\.\s]+@i', '', $file->getClientOriginalName());
        $filename = str_replace(' ', '-', $filename);
    } elseif ($originalName) {
        $filename = $originalName . '.' . $file->getClientOriginalExtension();
    } else {
        $filename = strtoupper(str_random(10)) . '-' . time() . '.' . $file->getClientOriginalExtension();
    }

    $file->move($path,$filename);

    return $filename;
    
}

function sendEmailToCandidate($email=null,$job=null,$candidate=null,$address,$interview_process,$date_process,$time_process,$candidate_id,$ktp_no)
{
    $data['candidate'] = $candidate;
    $data['job'] = $job;
    $data['address'] = $address;
    $data['interview_process'] = $interview_process;
    $data['date_process'] = $date_process;
    $data['time_process'] = $time_process;
    $data['candidate_id'] = $candidate_id;
    $data['ktp_no'] = $ktp_no;
    Mail::to($email)->send(new sendEmailToCandidate($data));

    return true;
}


function saveToHistory($param)
{
    $candidate = TrHistoryProcess::where('candidate_id',$param['candidate_id'])
    ->where('history_process',$param['process'])
    ->first();

    if(!empty($candidate->candidate_id))
    {
        return false;
    }

    $history = new TrHistoryProcess;
    $history->candidate_id = $param['candidate_id'];
    $history->history_result = $param['result'];
    $history->history_process = $param['process'];
    $history->history_date = $param['date_process'];
    $history->history_remarks = $param['remarks'];
    $history->history_attachment = $param['berkas'];
    $history->history_position_name = $param['history_position_name'];
    $history->history_address = $param['history_address'];
    $history->history_contact_person = $param['history_contact_person'];
    $history->history_confirmation = $param['history_confirmation'];
    $history->history_invitation_process = $param['history_invitation_process'];
    $history->iq = $param['iq'];
    $history->pauli = $param['pauli'];
    $history->disc = $param['disc'];
    $history->cbi = $param['cbi'];
    $history->insert_by = $param['insert_by'];
    $history->insert_time = $param['insert_time'];

    $history->save();

    return true;
}


function getApprovedRejected($param)
{
    return $data =  JobFptk::where('status',$param)->orderBy('request_job_number')->get();
}


function getOpenClosed($param)
{
    return JobFptk::where('is_closed',$param)->where('status','approved')->get();
}


function getDrop($param)
{
    return JobFptk::where('drop','yes')->get();
}



function tanggal_indo_lengkap($timestamp = '', $date_format = 'l, j F Y') 
{
    date_default_timezone_set("Asia/Bangkok");
    if (trim($timestamp) == '') 
    {
        $timestamp = time();
    } 
    elseif (!ctype_digit($timestamp)) 
    {
        $timestamp = strtotime($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace("/S/", "", $date_format);
    $pattern = array(
        '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
        '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
        '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
        '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
        '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
        '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
        '/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
        '/November/', '/December/',
    );
    $replace = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun',
        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Dec',
        'January', 'February', 'March', 'April', 'Juny', 'July', 'August', 'September',
        'October', 'November', 'December',
    );
    $date = date($date_format, $timestamp);
    $date = preg_replace($pattern, $replace, $date);
    $date = ($date);
    return $date;
}



function formatNumber($number)
{
    $countryCode = '62'; // Replace with known country code of user.
    $internationalNumber = preg_replace('/^0/', $countryCode,$number);
    return $internationalNumber;
}


function sendWA($name=null,$date=null,$time=null,$agenda=null,$phone,$candidate_id,$ktp_no)
{

    Log::channel('job_wa')->info('GlobalHelper.sendWA => begin');
    Log::channel('job_wa')->info($phone);
    Log::channel('job_wa')->info($candidate_id);
    Log::channel('job_wa')->info($ktp_no);
   $data_messsage_wa='Dear '.$name.PHP_EOL.
    'Menindaklanjuti aplikasi yang sudah kami terima, kami menginformasikan bahwa kami mengundang untuk Proses Seleksi yang akan dilaksanakan pada :'.PHP_EOL.PHP_EOL.
    'Hari, tanggal   : '.tanggal_indo_lengkap($date).PHP_EOL.
    'Jam             : '.$time.PHP_EOL.
    'Lokasi          : Jl. Raya Cakung Cilincing KM. 1,5 Cakung, Jakarta Timur 13910 (021-4602278 ext. 5100)'.PHP_EOL.
    'Agenda          : '.$agenda.PHP_EOL.
    'Bertemu dengan  : Bapak Aldi/Ibu Ata '.PHP_EOL.

    'Harap memberikan konfirmasi kehadiran pada laman E-Recruitment Puninar.'.PHP_EOL.


    'Mohon membawa CV, Pensil HB, dan Bolpoin.'.PHP_EOL.
    'Diharapkan sudah hadir 10 menit sebelum jadwal yang sudah ditentukan.'.PHP_EOL.
    'Catatan: Apabila Bapak/Ibu sudah pernah mengikuti proses psikotest atau Interview di Puninar Logistics, silahkan mengabaikan email undangan ini dan tidak perlu menghadiri proses seleksi.'.PHP_EOL.
    'Silahkan scan barcode dibawah ini untuk absensi kehadiran disaat interview.'.PHP_EOL.
    PHP_EOL.
    'klik link ini: '.url('qr-code?param1='.base64_encode($candidate_id).'&param2='.bcrypt($ktp_no)).PHP_EOL.
    'Silahkan klik link ini untuk konfirmasi kehadiran anda'.PHP_EOL.
    url('form-candidate/confirmation').PHP_EOL.
    PHP_EOL.
    'Untuk detail informasi mengenai perusahaan kami, silahkan mengunjungi website www.puninar.com.'.PHP_EOL.
    'Salam Hangat,'.PHP_EOL.
    'Tim Rekrutmen Puninar Logistics';


    // send notif WA to candidate
    $client = new GuzzleHttp\Client([
        'headers'=>['Content-type'=>'application/json'],
        'http_errors'=>false
    ]);

   // $url ='https://services.puninar.com/get-pun-wa';
    $url ='https://services.puninar.com/get-pun-wa-clients';
    $array_content=[
        'data_header'=>'Notification E-Recruitment Puninar',
        'data_detail'=>$data_messsage_wa,
        'to'=>[['phone'=>$phone]],
        'data_source'=>[
            'system'=>'erec_candidate_invitation',
            'candidate_id'=>$candidate_id,
            'process_status'=>$agenda,
            'env'=>'dev'
        ]
    ];
    $json_content=json_encode($array_content);
    $res = $client->post($url, ['body'=>$json_content]);
    $response = json_decode($res->getBody());


    Log::channel('job_wa')->info('GlobalHelper.sendWA => response');
    Log::channel('job_wa')->info( json_decode(json_encode($response),1) );

    return true;
}

function sendWA2($msg,$name=null,$date=null,$time=null,$agenda=null,$phone,$candidate_id,$ktp_no)
{


    Log::channel('job_wa')->info('GlobalHelper.sendWA => begin');
    Log::channel('job_wa')->info($phone);
    Log::channel('job_wa')->info($candidate_id);
    Log::channel('job_wa')->info($ktp_no);


   $data_messsage_wa='Dear '.$name.PHP_EOL.
    'Menindaklanjuti aplikasi yang sudah kami terima, kami menginformasikan bahwa kami mengundang untuk Proses Seleksi yang akan dilaksanakan pada :'.PHP_EOL.PHP_EOL.
    'Hari, tanggal   : '.tanggal_indo_lengkap($date).PHP_EOL.
    'Jam             : '.$time.PHP_EOL.
    'Lokasi          : Jl. Raya Cakung Cilincing KM. 1,5 Cakung, Jakarta Timur 13910 (021-4602278 ext. 5100)'.PHP_EOL.
    'Agenda          : '.$agenda.PHP_EOL.
    'Bertemu dengan  : Bapak Aldi/Ibu Ata '.PHP_EOL.

    'Harap memberikan konfirmasi kehadiran pada laman E-Recruitment Puninar.'.PHP_EOL.


    'Mohon membawa CV, Pensil HB, dan Bolpoin.'.PHP_EOL.
    'Diharapkan sudah hadir 10 menit sebelum jadwal yang sudah ditentukan.'.PHP_EOL.
    'Catatan: Apabila Bapak/Ibu sudah pernah mengikuti proses psikotest atau Interview di Puninar Logistics, silahkan mengabaikan email undangan ini dan tidak perlu menghadiri proses seleksi.'.PHP_EOL.
    'Silahkan scan barcode dibawah ini untuk absensi kehadiran disaat interview.'.PHP_EOL.
    PHP_EOL.
    'klik link ini: '.url('qr-code?param1='.base64_encode($candidate_id).'&param2='.bcrypt($ktp_no)).PHP_EOL.
    'Silahkan klik link ini untuk konfirmasi kehadiran anda'.PHP_EOL.
    url('form-candidate/confirmation').PHP_EOL.
    PHP_EOL.
    'Untuk detail informasi mengenai perusahaan kami, silahkan mengunjungi website www.puninar.com.'.PHP_EOL.
    'Salam Hangat,'.PHP_EOL.
    'Tim Rekrutmen Puninar Logistics';


    // send notif WA to candidate
    $client = new GuzzleHttp\Client([
        'headers'=>['Content-type'=>'application/json'],
        'http_errors'=>false
    ]);

   // $url ='https://services.puninar.com/get-pun-wa';
    $url ='https://services.puninar.com/get-pun-wa-clients';
    $array_content=[
        'data_header'=>'Notification E-Recruitment Puninar',
        'data_detail'=>$msg,
        'to'=>[['phone'=>$phone]],
        'data_source'=>[
            'system'=>'erec_candidate_invitation',
            'candidate_id'=>$candidate_id,
            'process_status'=>$agenda,
            'env'=>'dev'
        ]
    ];
    $json_content=json_encode($array_content);
    $res = $client->post($url, ['body'=>$json_content]);
    $response = json_decode($res->getBody());

    Log::channel('job_wa')->info('GlobalHelper.sendWA => response');
    Log::channel('job_wa')->info( json_decode(json_encode($response),1) );


    return true;
}


function getSLADet($request_job_number,$type)
{

    $dt = "select a.*,c.request_job_number,c.received_date_fptk,b.received_date,b.name_holder,b.date_process,
                c.position_name,c.request_reason
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
                 and a.baris  = 1
                 and c.request_job_number = '".$request_job_number."'
                ";
        return $data = DB::select($dt);
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

function cek_format_ktp($ktp_no,$gender,$date_of_birth)
{
    $dt = explode('-', $date_of_birth);
    $formatTgl = $ktpEx = $formFem = '';


    if(empty($gender) || empty($date_of_birth) )
    {
        return false;
    }

    $formatTgl = $dt[2].$dt[1].substr($dt[0],-2);
    $ktpEx = substr($ktp_no,6,6);

    if($gender == 'MALE')
    {
        $formatTgl = $dt[2].$dt[1].substr($dt[0],-2);
        $ktpEx = substr($ktp_no,6,6);
    }
    elseif($gender == 'FEMALE')
    {
        $formFem = $dt[2]+40;
        $formatTgl = $formFem.$dt[1].substr($dt[0],-2);
        $ktpEx = substr($ktp_no,6,6);   
    }


    if($formatTgl != $ktpEx)
    {
       return false;
    }
    else
    {
        return true;
    }
}

function cek_form_complete($user_id,$id,$process_id,$result)
{
    $cand = Candidate::where('candidate_id',$user_id['candidate_id'])->first();
    $family = MasterPersonal::family($user_id['candidate_id']);
    $emergency_contact = MasterPersonal::emergency_contact($user_id['candidate_id']);
    $education_background = MasterPersonal::education_background($user_id['candidate_id']);
    $course_information = MasterPersonal::course_information($user_id['candidate_id']);
    $skill = MasterPersonal::skill($user_id['candidate_id']);
    $language_skill = MasterPersonal::language_skill($user_id['candidate_id']);
    $org_information = MasterPersonal::org_information($user_id['candidate_id']);
    $job_experience = MasterPersonal::job_experience($user_id['candidate_id']);
    $job_interest = MasterPersonal::job_interest($user_id['candidate_id']);
    $assess_can = TRAssessment::where('candidate_id',$user_id['candidate_id'])->count();
    
    if( !empty($cand->npwp) &&  $family != 0 && $emergency_contact  != 0 && $education_background != 0 && $skill !=0 && $language_skill !=0 && $assess_can != 0 )
    {
        
        $candidate = Candidate::find($user_id['candidate_id']);
        $candidate->result = $result;
        $candidate->process = 'CALLED';
        $candidate->update_by = $user_id['name_holder'];
        $candidate->update_time = date('Y-m-d H:i:s');
        $candidate->save();
        
        //
        $updateHistory = TrHistoryProcess::find($process_id);
        $updateHistory->history_confirmation = date('Y-m-d H:i:s');
        $updateHistory->history_result = $result;
        $updateHistory->update_time = date('Y-m-d H:i:s');
        $updateHistory->update_by = $user_id['name_holder'];
        $updateHistory->save();
        return true;
    }
    else
    {
        return false;    
    }
    

}
