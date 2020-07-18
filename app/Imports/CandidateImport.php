<?php

namespace App\Imports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAMBAHKAN CODE INI

class CandidateImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            
            if(!empty($row['name_holder']))
            {
                // $cek = Candidate::where('email',$row['email'])->first();
                // if(empty($row['email']))
                // {
                //     echo json_encode(['error'=>'email_required','name_holder'=>$row['name_holder']]);
                //     exit();
                // }
                // elseif(!empty($cek))
                // {
                //     echo json_encode(['error'=>'email_already_exits','name_holder'=>$row['name_holder']]);
                //     exit();       
                // }
                
                   // Candidate::where('email', $row['email'])->delete();

                    return new Candidate([
                                         
                    // 'candidate_id'      =>$row['candidate_id'],
                    // 'job_fptk_id'=>$row['job_fptk_id'],
                    // 'received_date' => date('Y-m-d',strtotime($row['received_date'])),  
                    'subco'=>$row['subco'],
                    'job_title'   =>$row['job_title'],
                    'ktp_no' =>(string)$row['ktp_no'],
                    'name_holder' =>$row['name_holder'],
                    'function_dept'   =>$row['function_dept'],
                    'position_level'   =>$row['position_level'],
                    'age'  =>$row['age'],
                    'date_of_birth'   =>date('Y-m-d',strtotime($row['date_of_birth'])),
                    'religion'          =>$row['religion'],
                    'marital_status'      =>$row['marital_status'],  
                    'address' =>$row['address'],
                    'phone_no'  =>$row['phone_no'],        
                    'hp_1'        =>'62'.$row['hp_1'],  
                    'hp_2'          =>$row['hp_2'],
                    'email'         =>$row['email'],
                    'source'        =>$row['source'],
                    'source_desc'     =>$row['source_desc'],  
                    'edu_degree'       =>$row['edu_degree'],
                    'edu_major'         =>$row['edu_major'],
                    'edu_university'      =>$row['edu_university'], 
                    'edu_ipk'       =>$row['edu_ipk'],
                    'exp_total'       =>$row['exp_total'],  
                    'exp_start_year'  =>$row['exp_start_year'],
                    'exp_end_year'    =>$row['exp_end_year'],
                    'exp_buss_sector'   =>$row['exp_buss_sector'],   
                    'exp_company'      =>$row['exp_company'],
                    'exp_position'       =>$row['exp_position'],  
                    'exp_salary_existing'  =>$row['exp_salary_existing'],    
                    'exp_total_experience'   =>$row['exp_total_experience'],      
                    'display' =>$row['display'],
                    'status'  =>$row['status'],
                    'process' =>$row['process'],
                    'result'  =>$row['result'],
                    'remarks' =>$row['remarks'],
                    // 'date_process'           =>$row['date_process'],
                    'berkas'=>$row['berkas'],
                    'source_entry'          =>$row['source_entry'],
                    'file_1'       =>$row['file_1'],
                    'file_2'       =>$row['file_2'],
                    'postal_code' =>$row['postal_code'],
                    'edu_start_year'  =>$row['edu_start_year'],
                    'edu_end_year'  =>$row['edu_end_year'],  
                    'nationality'     =>$row['nationality'],  
                    'job_desc'    =>$row['job_desc'],
                    'candidate_code'=>$row['candidate_code'],  
                    'npwp'         =>$row['npwp'],
                    'sim_a'        =>$row['sim_a'],
                    'sim_b'        =>$row['sim_b'],
                    'sim_c'        =>$row['sim_c'],
                    'sim_other'      =>$row['sim_other'],  
                    'npwp_address'    =>$row['npwp_address'],
                    'insert_by'        =>'Upload Excel',
                    'insert_time'        =>date('Y-m-d H:i:s'),
                    'update_by'        =>$row['update_by'],
                    // 'update_time'        =>$row['update_time'],
                    'delete_by'        =>$row['delete_by'],
                    // 'delete_time'        =>$row['delete_time'],
                    'exp_start_month'      =>$row['exp_start_month'],
                    'exp_end_month'        =>$row['exp_end_month'],
                    'password'         =>$row['password'],
                    'iq'  =>$row['iq'],
                    'pauli' =>$row['pauli'],   
                    'disc'    =>$row['disc'],
                    'contact_person'       =>$row['contact_person'],
                    'address_interview'   =>$row['address_interview'],
                    'gender'  =>$row['gender'],
                    'place_of_birth'  =>$row['place_of_birth'],
                    'cbi' =>$row['cbi'],
                    'join_date'   =>$row['join_date'],
                    'invitation_process'       =>$row['invitation_process'],
                    'city'=>$row['city'],
                ]);    
            }
        }
}
