
@php
  $status =  (empty($_GET['status']))  ? "" : $_GET['status'] ; 
  $q =  (empty($_GET['q']))  ? "" : $_GET['q'] ; 
  $tot =  (empty($_GET['tot']))  ? "" : $_GET['tot'] ; 
  $type =  (empty($_GET['type']))  ? "" : $_GET['type'] ; 
  
@endphp
<form id="form-candidate-edit">
  <div class="form-row"> <!-- This DIV FORM -->
              <div class="col-md-6">  <!-- Left Form  --->
                <input type="hidden" name="candidate_id" value="">
                <label for="" class="control-label">BIODATA</label>
                    <table class="table table-responsive table-striped">
                  <tr>
                    <td>NAME <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <input type="text"   maxlength="50" class="validate form-control" id="name_holder" placeholder="Name" required="required" name="name_holder" size="50" value=""  >
                        <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>

                  <tr>
                    <td>APPLY JOB <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <div class="city_select2_complete">
                      <select class="form-control" id="job" name="job" required="required" >
                        <option value=""> - Choose Job - </option>
                        @foreach($job as $val)
                          <option value="{{$val->job_fptk_id}}" >{{  strtoupper($val->request_job_number).' - '.ucwords($val->position_name)}}  </option>
                        @endforeach
                      </select>
                      </div>
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
                          <option value="{{$gen->nama}}">{{$gen->nama}}  </option>
                        @endforeach
                      </select>
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>PLACE OF BIRTH <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control" maxlength="50" id="place_of_birth" required="required" name="place_of_birth" size="50" value="" placeholder=" Example : Jakarta">
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>

                  <tr>
                    <td>DATE OF BIRTH <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control date_of_birth" id="date_of_birth"  name="date_of_birth" size="50" value="" placeholder="format : YYYY-MM-DD ">
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>


                  <tr>
                    <td>KTP NO <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control number_valid_char" maxlength="16" placeholder="KTP No."  required="required" onchange="" id="ktp_no" name="ktp_no" size="50" value="" >
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>


                  <tr>
                    <td>RELIGION </td>
                    <td>:</td>
                    <td>
                      <select class="form-control" id="religion" name="religion" required="required" onchange="get_religion(this)">
                        <option value=""> - Choose Religion - </option>
                        @foreach($religion as $agama)
                          <option value="{{$agama->name}}">{{$agama->name}}  </option>
                        @endforeach
                      </select>
                      <i class="invalid-feedback" role="alert"></i>

                      <div style="margin-top: 7px;display: none" id="div_other_religion">
                        <input class="form-control" type="text" name="other_religion"  id="other_religion" placeholder="Input Other Religion">
                        <i class="invalid-feedback" role="alert"></i>    
                      </div> 
                    </td>
                  </tr>



                  <tr>
                    <td>MARITAL STATUS </td>
                    <td>:</td>
                    <td>
                      <select class="form-control" id="marital_status" required="required" name="marital_status" >
                        <option value=""> - Choose Marital - </option>
                        @foreach($marital as $ma)
                          <option value="{{$ma->nama}}">{{ ucwords($ma->nama)}}  </option>
                        @endforeach
                      </select>
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>
                  <tr>
                    <td>ADDRESS <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <textarea class="form-control" id="address" required="required" name="address" ></textarea>
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>



                  <tr>
                    <td>CITY <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <div class="city_select2_complete">
                        <select class="form-control" id="city" required="required" name="city" onchange="get_city(this)">
                          <option value=""> - Choose City - </option>
                          @foreach($city as $ct)
                            <option value="{{$ct->name}}"  >{{$ct->name}}  </option>
                          @endforeach
                        </select>
                      </div>

                      <div style="margin-top: 7px;display: none" id="div_other_city">
                        <input class="form-control" type="text" name="other_city"  id="other_city" placeholder="Input Other City">
                        <i class="invalid-feedback" role="alert"></i>    
                      </div> 
                    </td>
                  </tr>
                  
                  <tr>
                    <td>POSTAL CODE </td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control number_valid_char" placeholder="Postal Code" id="postal_code" name="postal_code" maxlength="6" value="">
                    </td>
                  </tr>
                  <tr>
                    <td>NATIONALITY <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <select class="form-control" id="nationality" required="required" name="nationality" >
                        <option value="Indonesian"> Indonesian </option>
                        @foreach($nationality as $national)
                          <option value="{{$national->nama}}">{{$national->nama}}  </option>
                        @endforeach
                      </select>
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>
                  <tr>
                    <td>PHONE NUMBER</td>
                    <td>:</td>
                    <td><input type="text" class="validate form-control number_valid_char" placeholder="Phone number" maxlength="15" id="phone_no" name="phone_no" size="50" value=""></td>
                  </tr>
                  <tr>
                    <td>MOBILE NUMBER <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <input type="text" maxlength="15" class="validate form-control number_valid_char" id="hp_1" required="required" name="hp_1" size="50" value="" placeholder="Mobile Number 1" >
                      <i class="invalid-feedback" role="alert"></i>
                      <br/>
                      <input type="text" class="validate form-control number_valid_char" id="hp_2" name="hp_2" size="50" value="" placeholder="Mobile Number 2">
                    </td>
                  </tr>
                  <tr>
                    <td>EMAIL <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control" maxlength="50" id="email" placeholder="Email"    required="required" name="email" size="50" value="" >
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>

                  <tr>
                      <td width="45%">NPWP  <span class="span-mandatory">*</span> </td>
                      <td  width="5%" >:</td>
                      <td  width="50%">
                        <input type="text" class="form-control number_valid_char" name="npwp"  maxlength="20" placeholder="No NPWP" value="9999999999999999999" placeholder="">
                        <i class="invalid-feedback" role="alert"></i>
                      </td>
                    </tr>
                    <tr>
                      <td>ALAMAT NPWP</td>
                      <td>:</td>
                      <td>
                         <input type="text" class="form-control" name="npwp_address" placeholder="Alamat  NPWP" value="" placeholder="">
                          <i class="invalid-feedback" role="alert"></i>
                        </td>
                    </tr>
                    <tr>
                      <td>SIM A</td>
                      <td>:</td>
                      <td>
                          <input type="text" class="form-control number_valid_char" placeholder="No SIM " maxlength="15" name="sim_a" value="" placeholder="">
                          <i class="invalid-feedback" role="alert"></i>
                      </td>
                    </tr>
                    <tr>
                      <td>SIM B</td>
                      <td>:</td>
                      <td>
                        <input type="text" class="form-control number_valid_char" name="sim_b" placeholder="No SIM " maxlength="15"  value="" placeholder="">
                        <i class="invalid-feedback" role="alert"></i>
                      </td>
                    </tr> 

                    <tr>
                      <td>SIM C</td>
                      <td>:</td>
                      <td>
                          <input type="text" class="form-control number_valid_char" name="sim_c" placeholder="No SIM" maxlength="15" value="" placeholder="">
                          <i class="invalid-feedback" role="alert"></i>
                      </td>
                    </tr>
                    <tr>
                      <td  width="45%">SIM LAINNYA</td>
                      <td   width="5%">:</td>
                      <td  width="50%">
                        <input type="text" class="form-control number_valid_char" name="sim_other"  maxlength="50" placeholder="No SIM" value="" placeholder="">
                        <i class="invalid-feedback" role="alert"></i> 
                      </td>
                      
                    </tr>
                </table>

                  <i>notes :<span class="span-mandatory">*</span>= mandatory</i>
                </div>
                <!-- End left form -->


                <!-- Right form -->
              <div class="col-md-6">
                <label for="" class="control-label">ATTACHMENT</label>
                    <table class="table table-responsive table-striped">
                
                  <tr>
                    <td> PHOTO PROFILE </td>
                    <td>:</td>
                    <td>
                      <input class="form-control" type="file" name="file_1"  id="file_1" onchange="changePhoto(this)">
                      <i class="invalid-feedback" role="alert"></i>
                      <input type="hidden" name="file_1_edit" value="">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">File format must be on JPG,JPEG,PNG -  MAX 500kb</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <div class=""> 

                       </div>
                    </td>
                  </tr>
                  <tr>
                    <td>CV </td>
                    <td>:</td>
                    <td>
                      <input class="form-control" type="file" name="file_2"  id="file_2" onchange="changeCV(this)">
                      <i class="invalid-feedback" role="alert"></i>
                      <input type="hidden" name="file_2_edit" value="">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">File format must be on PDF  - MAX 500kb </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td><div id="editCV"> <a href="" target="_blank" id="fname">  </a>  </div></td>
                  </tr>
                </table>
                <label for="" class="control-label">LATEST EDUCATION</label>
                <table class="table table-responsive table-striped">
                  <tr>
                    <td>STRATA <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <div class="edu_university_select2">
                        <select class="form-control" id="edu_degree" name="edu_degree" required>
                          <option value=""> - Choose Strata - </option>
                          @foreach($education as $ed)
                            <option value="{{$ed->name}}">{{$ed->name}}  </option>
                          @endforeach
                        </select>
                        <i class="invalid-feedback" role="alert"></i>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>MAJOR <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <div class="edu_university_select2">
                        <select class="form-control" id="edu_major" name="edu_major" onchange="get_major(this)" required>
                          <option value=""> - Choose Major - </option>
                          @foreach($major as $mj)
                            <option value="{{$mj->name}}">{{$mj->name}}  </option>
                          @endforeach
                        </select>
                        <i class="invalid-feedback" role="alert"></i>
                      </div>

                      <div style="margin-top: 7px;display: none" id="div_other_major">
                        <input class="form-control" type="text" name="other_major"  id="other_major" placeholder="Input Other Major">
                        <i class="invalid-feedback" role="alert"></i>    
                      </div>
                    </td>
                  </tr>
           
                   <tr>
                    <td>SCHOOL/UNIVERSITY <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                    <div class="edu_university_select2">
                      <select name="edu_university" id="edu_university" class="form-control" onchange="get_school(this)">
                        <option value=""> - Choose School / University - </option>
                        @foreach($list_school as $school)
                            <option value="{{$school->name}}">{{$school->name}}</option>
                        @endforeach
                      </select>
                      <i class="invalid-feedback" role="alert"></i>
                    </div>

                      <div style="margin-top: 7px;display: none" id="div_other_school">
                        <input class="form-control" type="text" name="other_school"  id="other_school" placeholder="Input Other School">
                        <i class="invalid-feedback" role="alert"></i>    
                      </div> 
                    </td>
                  </tr>

                  <tr>
                    <td>IPK/GPA <span class="span-mandatory">*</span></td>
                    <td>:</td>
                    <td>
                      <input type="text" class="numeric validate form-control number_valid" required="required" id="edu_ipk" name="edu_ipk" size="50" value="" placeholder="example : 3.45" maxlength="5" >
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>
                  <tr>
                    <td>START YEAR </td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control number_valid_char" maxlength="4" id="edu_start_year" name="edu_start_year" size="50" value="" placeholder="format : YYYY, example : 2018" >
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>
                  <tr>
                    <td>END YEAR </td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control number_valid_char"  maxlength="4" id="edu_end_year" name="edu_end_year" size="50" value="" placeholder="format : YYYY, example : 2018" >
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>
                </table>
                <label for="" class="control-label">LATEST EXPERIENCE</label>
                <table class="table table-responsive table-striped">
                  <tr>
                    <td>COMPANY</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" class="validate form-control" id="exp_company" placeholder="Company" name="exp_company" size="50" value=""></td>
                  </tr>
                  <tr>
                    <td>POSITION</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" class="validate form-control" id="exp_position" placeholder="Position" name="exp_position" size="50" value=""></td>
                  </tr>
                  <tr>
                    <td>JOB DESC.</td>
                    <td>:</td>
                    <td colspan="2"><textarea class="form-control" id="job_desc" placeholder="Job Desc" name="job_desc"></textarea></td>
                  </tr>
                  <tr>
                    <td>INDUSTRY SECTOR</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" class="validate form-control" id="exp_buss_sector" placeholder="Industry Sector" name="exp_buss_sector" size="50" value=""></td>
                  </tr>
                  <tr>
                    <td>START</td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control number_valid_char" id="exp_start_month" name="exp_start_month" maxlength="2" value="" placeholder="MM : 12">
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                    <td>
                      <input type="text" class="validate form-control number_valid_char" id="exp_start_year" name="exp_start_year" maxlength="4" value="" placeholder="YYYY : 2018">
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>
                  <tr>
                    <td>END</td>
                    <td>:</td>
                    <td>
                      <input type="text" class="validate form-control  number_valid_char" id="exp_end_month" name="exp_end_month" maxlength="2" value="" placeholder="MM : 12">
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                    <td>
                      <input type="text" class="validate form-control number_valid_char" id="exp_end_year" name="exp_end_year" maxlength="4" value="" placeholder="YYYY : 2018">
                      <i class="invalid-feedback" role="alert"></i>
                    </td>
                  </tr>
                  <tr>
                    <td>TOTAL JOB EXPERIENCE</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" class="validate form-control number_valid_char" id="exp_total" name="exp_total" size="50" value="" placeholder="ex: 7"></td>
                  </tr>
                  <tr>
                    <td>CURRENT SALARY</td>
                    <td>:</td>
                    <td colspan="2"><input type="text" class="validate form-control number_valid_char" id="exp_salary_existing" name="exp_salary_existing" size="50" value="" placeholder="ex: 5000000"></td>
                  </tr>
                </table>
                <label for="" class="control-label">VACANCY INFORMATION</label>
                <table class="table table-responsive table-striped">
                  <tr>
                    <td>SOURCE OF JOB VACANCY </td>
                    <td>:</td>
                    <td>
                      <select class="form-control" id="source" name="source" >
                        <option value=""> - Choose Source - </option>
                        @foreach($source as $so)
                          <option value="{{$so->nama}}">{{$so->nama}}  </option>
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
        <button type="button" style="padding-left:50px;padding-right: 50px;" class="btn btn-primary" onclick="saveCandidate()"> Save </button>
        <a style="padding-left:50px;padding-right: 50px;" id="link_" class="btn btn-default" href="{{ url('rec-process/view_all?status='.$status.'&q='.$q.'&tot='.$tot.'&type='.$type.'') }}"> Cancel </a>
    </center>

</form>

<script type="text/javascript">
  function get_religion(a)
  {
    if($(a).val()=='Other')
    {
      $('#div_other_religion').show();
    }
    else
    {
      $('#div_other_religion').hide(); 
      $('[name="other_religion"]').val('');  
    }
  }

  function get_city(b)
  {
    if($(b).val()=='Other')
    {
      $('#div_other_city').show();
    }
    else
    {
      $('#div_other_city').hide(); 
      $('[name="other_city"]').val('');  
    }
  }

  function get_major(c)
  {
    if($(c).val()=='Other')
    {
      $('#div_other_major').show();
    }
    else
    {
      $('#div_other_major').hide(); 
      $('[name="other_major"]').val('');  
    }
  }

  function get_school(d)
  {
    if($(d).val()=='Other')
    {
      $('#div_other_school').show();
    }
    else
    {
      $('#div_other_school').hide(); 
      $('[name="other_school"]').val('');  
    }
  }
</script>