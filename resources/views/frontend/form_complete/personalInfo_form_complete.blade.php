<form id="form-candidate-edit">
  <div class="form-row"> <!-- This DIV FORM -->
      <div class="col-md-6">  <!-- Left Form  --->
        <input type="hidden" name="candidate_id" value="{{$userinfo['candidate_id']}}">
        <label for="" class="control-label"><b>BIODATA</b></label>
            <table class="table table-responsive table-striped">
          <tr>
            <td>NAME <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text"   maxlength="50" class="validate form-control" id="name_holder" required="required" name="name_holder" maxlength="50" value="{{(empty($candidate->name_holder)) ? "" : $candidate->name_holder }}"  >
                <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>GENDER <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <select class="form-control" id="gender" name="gender" required="required" >
                <option value=""> - Choose gender - </option>
                @foreach($gender as $gen)
                  <option value="{{$gen->nama}}" {{(!empty($candidate->gender) && $candidate->gender == $gen->nama ) ? "selected" : "" }} >{{$gen->nama}}  </option>
                @endforeach
              </select>
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
       

          <tr>
            <td>PLACE OF BIRTH <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text" class="validate form-control" maxlength="50" id="place_of_birth" required="required" name="place_of_birth" maxlength="50" value="{{(empty($candidate->place_of_birth)) ? "" : $candidate->place_of_birth }}" placeholder=" EX : JAKARTA">
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>

          <tr>
            <td>DATE OF BIRTH <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text" class="validate form-control date_of_birth" readonly="readonly" id="date_of_birth" required="required" name="date_of_birth" maxlength="50" value="{{(empty($candidate->date_of_birth)) ? "" : $candidate->date_of_birth }}" placeholder="format : YYYY-MM-DD, example : 2018-03-14">
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>


          <tr>
            <td>KTP NO <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text" class="validate form-control number_valid_char" maxlength="16"   readonly required="required" id="ktp_no" name="ktp_no" maxlength="50" value="{{(empty($candidate->ktp_no)) ? "" : $candidate->ktp_no }}" >
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>

          <tr>
            <td>RELIGION <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <select class="form-control" id="religion" name="religion" required="required" >
                <option value=""> - Choose Religion - </option>
                @foreach($religion as $agama)
                  <option value="{{$agama->name}}" {{(!empty($candidate->religion) && $candidate->religion == $agama->name ) ? "selected" : "" }} >{{$agama->name}}  </option>
                @endforeach
              </select>
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>MARITAL STATUS <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <select class="form-control" id="marital_status" required="required" name="marital_status" >
                <option value=""> - Choose Marital - </option>
                @foreach($marital as $ma)
                  <option value="{{$ma->nama}}"  {{(!empty($candidate->marital_status) && $candidate->marital_status == $ma->nama ) ? "selected" : "" }} >{{$ma->nama}}  </option>
                @endforeach
              </select>
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>ADDRESS <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <textarea class="form-control" id="address" required="required" name="address" >{{(empty($candidate->address)) ? "" : $candidate->address }}</textarea>
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>

          <tr>
            <td>CITY <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <div class="city_select2_complete">
                <select class="form-control" id="city" required="required" name="city" >
                  <option value=""> - Choose City - </option>
                  @foreach($city as $ct)
                    <option value="{{$ct->name}}"  {{(!empty($candidate->city) && $candidate->city == $ct->name ) ? "selected" : "" }} >{{$ct->name}}  </option>
                  @endforeach
                </select>
                <i class="invalid-feedback" role="alert"></i>
              </div>
            </td>
          </tr>

          <tr>
            <td>POSTAL CODE </td>
            <td>:</td>
            <td>
              <input type="text" class="validate form-control number_valid_char" id="postal_code" name="postal_code" maxlength="6" value="{{(empty($candidate->postal_code)) ? "" : $candidate->postal_code }}">
            </td>
          </tr>
          <tr>
            <td>NATIONALITY <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <select class="form-control" id="nationality" required="required" name="nationality" >
                <option value="Indonesian"> Indonesian </option>
                @foreach($nationality as $national)
                  <option value="{{$national->nama}}" {{$national->nama}} {{(!empty($candidate->nationality) && $candidate->nationality == $national->nama ) ? "selected" : "" }} >{{$national->nama}}  </option>
                @endforeach
              </select>
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>PHONE NUMBER</td>
            <td>:</td>
            <td><input type="text" class="validate form-control number_valid_char" maxlength="15" id="phone_no" name="phone_no" maxlength="50" value="{{(empty($candidate->phone_no)) ? "" : $candidate->phone_no }}"></td>
          </tr>
          <tr>
            <td>WHATSAPP NUMBER <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text" maxlength="15" class="validate form-control number_valid_char" id="hp_1" required="required" name="hp_1" maxlength="50" value="{{(empty($candidate->hp_1)) ? "" : $candidate->hp_1 }}" placeholder="Mobile Number 1" >
              <i class="invalid-feedback" role="alert"></i>
              <br/>
              <input type="text" class="validate form-control number_valid_char" id="hp_2" name="hp_2" maxlength="50" value="{{(empty($candidate->hp_2)) ? "" : $candidate->hp_2 }}" placeholder="Mobile Number 2">
            </td>
          </tr>
          <tr>
            <td>EMAIL <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text" readonly class="validate form-control" maxlength="50" id="email"   onchange="emailCheck()" required="required" name="email" maxlength="50" value="{{(empty($candidate->email)) ? "" : $candidate->email }}" >
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>

          <tr>
              <td width="45%">NPWP  <span class="span-mandatory">*</span> </td>
              <td  width="5%" >:</td>
              <td  width="50%">
                <input type="text" class="form-control number_valid_char" name="npwp"  maxlength="20" placeholder="No NPWP" value="{{(!empty($candidate->npwp)) ? $candidate->npwp : "999999999" }}" placeholder="">
                <i class="invalid-feedback" role="alert"></i>
              </td>
            </tr>
            <tr>
              <td>ALAMAT NPWP</td>
              <td>:</td>
              <td>
                 <input type="text" class="form-control" name="npwp_address" placeholder="Alamat  NPWP" value="{{(!empty($candidate->npwp_address)) ? $candidate->npwp_address : "" }}" placeholder="">
                  <i class="invalid-feedback" role="alert"></i>
                </td>
            </tr>
            <tr>
              <td>SIM A</td>
              <td>:</td>
              <td>
                  <input type="text" class="form-control number_valid_char" placeholder="No SIM " maxlength="15" name="sim_a" value="{{(!empty($candidate->sim_a)) ? $candidate->sim_a : "" }}" placeholder="">
                  <i class="invalid-feedback" role="alert"></i>
              </td>
            </tr>
            <tr>
              <td>SIM B</td>
              <td>:</td>
              <td>
                <input type="text" class="form-control number_valid_char" name="sim_b" placeholder="No SIM " maxlength="15"  value="{{(!empty($candidate->sim_b)) ? $candidate->sim_b : "" }}" placeholder="">
                <i class="invalid-feedback" role="alert"></i>
              </td>
            </tr> 

            <tr>
              <td>SIM C</td>
              <td>:</td>
              <td>
                  <input type="text" class="form-control number_valid_char" name="sim_c" placeholder="No SIM" maxlength="15" value="{{(!empty($candidate->sim_c)) ? $candidate->sim_c : "" }}" placeholder="">
                  <i class="invalid-feedback" role="alert"></i>
              </td>
            </tr>
            <tr>
              <td  width="45%">SIM LAINNYA</td>
              <td   width="5%">:</td>
              <td  width="50%">
                <input type="text" class="form-control number_valid_char" name="sim_other"  maxlength="50" placeholder="No SIM" value="{{(!empty($candidate->sim_other)) ? $candidate->sim_other : "" }}" placeholder="">
                <i class="invalid-feedback" role="alert"></i>    
              </td>
              
            </tr>                    


            <tr>
              <td>BJPS</td>
              <td>:</td>
              <td>
                <input type="text"  maxlength="15" class="validate form-control number_valid_char" id="bpjs_kesehatan" required name="bpjs_kesehatan"  value="{{(empty($candidate->bpjs_kesehatan)) ? "" : $candidate->bpjs_kesehatan }}" placeholder=" BPJS Kesehatan " >
                  <i class="invalid-feedback" role="alert"></i>
              </td>
            </tr>
            <tr>
              <td  width="45%"></td>
              <td   width="5%">:</td>
              <td  width="50%">
                <input type="text" class="validate form-control number_valid_char" id="bpjs_tenaga_kerja" name="bpjs_tenaga_kerja" maxlength="15" value="{{(empty($candidate->bpjs_tenaga_kerja)) ? "" : $candidate->bpjs_tenaga_kerja }}" placeholder="BPJS tenaga kerja">
                <i class="invalid-feedback" role="alert"></i>    
              </td>
              
            </tr>




        </table>

          <i>notes :<span class="span-mandatory">*</span>= mandatory</i>
        </div>
        <!-- End left form -->


        <!-- Right form -->
      <div class="col-md-6">
        <label for="" class="control-label"><b>ATTACHMENT</b></label>
            <table class="table table-responsive table-striped">
        
          <tr>
            <td>PHOTO PROFILE <span class="span-mandatory">* </span></td>
            <td>:</td>
            <td>
              <input class="form-control" type="file" name="file_1"  id="file_1" onchange="changePhoto(this)">
              <i class="invalid-feedback" role="alert"></i>
              <input type="hidden" name="file_1_edit" value="{{(empty($candidate->file_1)) ? "" : $candidate->file_1 }}">
            </td>
          </tr>
          <tr>
            <td colspan="3">File format must be on JPG,JPEG,PNG -  MAX 2 MB</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>
              <div class=""> 
                @php 
                  if(empty($candidate->file_1)):
                @endphp
                  <div></div>
                @php
                  else:
                @endphp
                  <img src="{{asset("upload_file/$candidate->file_1")}}" id="editPhoto" width="200px"/> 
                @php 
                  endif
                @endphp
               </div>
            </td>
          </tr>
          <tr>
            <td>CV <span class="span-mandatory">* </span></td>
            <td>:</td>
            <td>
              <input class="form-control" type="file" name="file_2"  id="file_2" onchange="changeCV(this)">
              <i class="invalid-feedback" role="alert"></i>
              <input type="hidden" name="file_2_edit" value="{{(empty($candidate->file_2)) ? "" : $candidate->file_2 }}">
            </td>
          </tr>
          <tr>
            <td colspan="3">File format must be on PDF  - MAX 2 MB </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><div id="editCV"> <a href="{{url("upload_file/$candidate->file_2")}}" target="_blank" id="fname"> {{$candidate->file_2}}   </a>  </div></td>
          </tr>
        </table>
        <label for="" class="control-label"><b>LATEST EDUCATION</b></label>
        <table class="table table-responsive table-striped">
          <tr>
            <td>STRATA <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <select class="form-control" id="edu_degree" name="edu_degree" required="required">
                <option value=""> - Choose Strata - </option>
                @foreach($education as $ed)
                  <option value="{{$ed->name}}" {{ ( trim($candidate->edu_degree) == trim($ed->name) ) ? "selected" : "" }}>{{$ed->name}}  </option>
                @endforeach
              </select>
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>MAJOR <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <select class="form-control" id="edu_major" name="edu_major" required="required">
                <option value=""> - Choose Major - </option>
                @foreach($major as $mj)
                  <option value="{!! $mj->name !!}" {!!( trim($candidate->edu_major) == trim($mj->name) ) ? "selected" : "" !!}>{!!$mj->name!!}  </option>
                @endforeach
              </select>

              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>SCHOOL/UNIVERSITY <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
            <div class="edu_university_select2">
              <select name="edu_university" id="edu_university" class="form-control">
                <option value=""> - Choose School / University - </option>
                @foreach($list_school as $school)
                    <option value="{{$school->name}}" {{ ( trim($school->name) == trim($candidate->edu_university) ) ? 'selected':''}}>{{$school->name}}</option>
                @endforeach
              </select>
              <i class="invalid-feedback" role="alert"></i>
            </div>
            </td>
          </tr>

<!--           <tr>
            <td>SCHOOL/UNIVERSITY <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <div class="edu_university_select2">
                <select name="edu_university" id="edu_university" class="form-control">
                  <option value=""> - Choose School / University - </option>
                  @foreach($list_school as $school)
                      <option value="{{$school->name}}" {{ ( trim($school->name) == trim($candidate->edu_university) ) ? 'selected':''}}>{{$school->name}}</option>
                  @endforeach
                </select>
                <i class="invalid-feedback" role="alert"></i>
              </div>
            </td>
          </tr> -->
          <tr>
            <td>IPK/GPA <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text" class="numeric validate form-control number_valid" required="required" id="edu_ipk" name="edu_ipk" maxlength="50" value="{{(empty($candidate->edu_ipk)) ? "" : $candidate->edu_ipk }}" placeholder="example : 3.45" maxlength="5" >
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>START YEAR <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text" class="validate form-control number_valid_char" maxlength="4" id="edu_start_year" name="edu_start_year" maxlength="50" value="{{(empty($candidate->edu_start_year)) ? "" : $candidate->edu_start_year }}" placeholder="format : YYYY, example : 2018" >
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>END YEAR <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <input type="text" class="validate form-control number_valid_char"  maxlength="4" id="edu_end_year" name="edu_end_year" maxlength="50" value="{{(empty($candidate->edu_end_year)) ? "" : $candidate->edu_end_year }}" placeholder="format : YYYY, example : 2018" >
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
        </table>
        <label for="" class="control-label"><b>LATEST EXPERIENCE</b></label>
        <table class="table table-responsive table-striped">
          <tr>
            <td>COMPANY</td>
            <td>:</td>
            <td colspan="2"><input type="text" class="validate form-control" id="exp_company" name="exp_company" maxlength="50" value="{{(empty($candidate->exp_company)) ? "" : $candidate->exp_company }}"></td>
          </tr>
          <tr>
            <td>POSITION</td>
            <td>:</td>
            <td colspan="2"><input type="text" class="validate form-control" id="exp_position" name="exp_position" maxlength="50" value="{{(empty($candidate->exp_position)) ? "" : $candidate->exp_position }}"></td>
          </tr>
          <tr>
            <td>JOB DESC.</td>
            <td>:</td>
            <td colspan="2"><textarea class="form-control" id="job_desc" name="job_desc">{{(empty($candidate->job_desc)) ? "" : $candidate->job_desc }}</textarea></td>
          </tr>
          <tr>
            <td>INDUSTRY SECTOR</td>
            <td>:</td>
            <td colspan="2"><input type="text" class="validate form-control" id="exp_buss_sector" name="exp_buss_sector" maxlength="50" value="{{(empty($candidate->exp_buss_sector)) ? "" : $candidate->exp_buss_sector }}"></td>
          </tr>
          <tr>
            <td>START</td>
            <td>:</td>
            <td>
              <input type="text" class="validate form-control number_valid_char" id="exp_start_month" name="exp_start_month" maxlength="2" value="{{(empty($candidate->exp_start_month)) ? "" : $candidate->exp_start_month }}" placeholder="MM : 12">
              <i class="invalid-feedback" role="alert"></i>
            </td>
            <td>
              <input type="text" class="validate form-control number_valid_char" id="exp_start_year" name="exp_start_year" maxlength="4" value="{{(empty($candidate->exp_start_year)) ? "" : $candidate->exp_start_year }}" placeholder="YYYY : 2018">
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>END</td>
            <td>:</td>
            <td>
              <input type="text" class="validate form-control  number_valid_char" id="exp_end_month" name="exp_end_month" maxlength="2" value="{{(empty($candidate->exp_end_month)) ? "" : $candidate->exp_end_month }}" placeholder="MM : 12">
              <i class="invalid-feedback" role="alert"></i>
            </td>
            <td>
              <input type="text" class="validate form-control number_valid_char" id="exp_end_year" name="exp_end_year" maxlength="4" value="{{(empty($candidate->exp_end_year)) ? "" : $candidate->exp_end_year }}" placeholder="YYYY : 2018">
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
          <tr>
            <td>TOTAL JOB EXPERIENCE</td>
            <td>:</td>
            <td colspan="2"><input type="text" class="validate form-control number_valid_char" id="exp_total" name="exp_total" maxlength="50" value="{{(empty($candidate->exp_total)) ? "" : $candidate->exp_total }}" placeholder="ex: 7"></td>
          </tr>
          <tr>
            <td>CURRENT SALARY</td>
            <td>:</td>
            <td colspan="2"><input type="text" class="validate form-control number_valid_char" id="exp_salary_existing" name="exp_salary_existing" maxlength="50" value="{{(empty($candidate->exp_salary_existing)) ? "" : $candidate->exp_salary_existing }}" placeholder="ex: 5000000"></td>
          </tr>
        </table>
        <label for="" class="control-label"><b>VACANCY INFORMATION</b></label>
        <table class="table table-responsive table-striped">
          <tr>
            <td>SOURCE OF JOB VACANCY <span class="span-mandatory">*</span></td>
            <td>:</td>
            <td>
              <select class="form-control" id="source" name="source" >
                <option value=""> - Choose Source - </option>
                @foreach($source as $so)
                  <option value="{{$so->nama}}" {{(!empty($candidate->source) && $candidate->source == $so->nama ) ? "selected" : "" }} >{{$so->nama}}  </option>
                @endforeach
              </select>
              <i class="invalid-feedback" role="alert"></i>
            </td>
          </tr>
        </table>
      </div>
        <!-- End Right form -->
  </div>
<!--  END FORM -->

    <center>
        <button type="button" style="padding-left:50px;padding-right: 50px;" class="btn btn-primary" onclick="updateCandidate()"> Update </button>
    </center>

</form>