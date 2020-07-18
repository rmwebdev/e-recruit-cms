@extends('layouts.frontend')
@section('css')
<style type="text/css">
	
.select2-container .select2-selection--single{
      width: 505px;
      height: 38px;
}
.actionBar .buttonNext {
  
  padding-left: 100px;
  padding-right: 100px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  right: 5px;
}
.form-control::-webkit-input-placeholder { color: black;opacity: 0.2 }  /* WebKit, Blink, Edge */
.form-control:-moz-placeholder { color: black;opacity: 0.2 }  /* Mozilla Firefox 4 to 18 */
.form-control::-moz-placeholder { color: black;opacity: 0.2 }  /* Mozilla Firefox 19+ */
.form-control:-ms-input-placeholder { color: black;opacity: 0.2 }  /* Internet Explorer 10-11 */
.form-control::-ms-input-placeholder { color: black;opacity: 0.2 }  /* Microsoft Edge */

</style>
@endsection

@section('content_frontend')
@php 
	$userinfo = Session::get('userinfo'); 
@endphp

<div class="section">
	<div class="bg-light" style="padding-top: 120px;padding-bottom: 100px">
    	<div class="container">


    		<div class="col-md-12"><!-- col 12 -->

        		<div id="wizard" class="form_wizard wizard_horizontal"><!-- FORM WIZARD -->

		            <ul class="wizard_steps">
		                <li>
		                  <a href="#step-1">
		                    <span class="step_no">1</span>
		                  </a>
		                </li>
		                <li>
		                  <a href="#step-2">
		                    <span class="step_no">2</span>
		                  </a>
		                </li>
		                <li>
		                  <a href="#step-3">
		                    <span class="step_no">3</span>

		                  </a>
		                </li>
		            </ul>
	              	<div id="step-1"> <!-- STEP 1 --->
	              		<h5 class="font-20"> CANDIDATE FORM</h5>
	                   	<div class="mt-2"  style="background-color: #f0f0f0;padding:20px;"> <!-- ROW --->
	                   		<h5 class="font-16"> BIODATA</h5>
	                   		<div class="row mt-2">
	                		<div class="col-md-6"> <!-- Col 6 md -->
	                			<form id="form-candidate-step-1">
		                    		<input type="hidden" name="candidate_id" value="{{$userinfo['candidate_id']}}">
									<div class="form-group">
										<label class="control-label"> NAME <span class="span-mandatory">*</span></label>
										<input type="text"   maxlength="50"  class="validate form-control" id="name_holder"  placeholder="NAME HOLDER"  required name="name_holder" maxlength="50" value="{{(empty($candidate->name_holder)) ? "" : $candidate->name_holder }}"  >
												<i class="invalid-feedback" role="alert"></i>
									</div>

									<div class="form-group">
										<label class="control-label"> GENDER <span class="span-mandatory">*</span></label>
										<select class="form-control" id="gender" name="gender" required >
											<option value=""> - Choose gender - </option>
											@foreach($gender as $gen)
												<option value="{{$gen->nama}}" {{(!empty($candidate->gender) && $candidate->gender == $gen->nama ) ? "selected" : "" }} >{{$gen->nama}}  </option>
											@endforeach
										</select>
										<i class="invalid-feedback" role="alert"></i>	 												
									</div>

									<div class="form-group">
										<label class="control-label"> PLACE OF BIRTH <span class="span-mandatory">*</span></label>
										<input type="text" class="validate form-control" id="place_of_birth" maxlength="50"  required name="place_of_birth"  value="{{(empty($candidate->place_of_birth)) ? "" : $candidate->place_of_birth }}" placeholder=" Ex : Jakarta">
										<i class="invalid-feedback" role="alert"></i>	 												
									</div>

									<div class="form-group">
										<label class="control-label"> DATE OF BIRTH <span class="span-mandatory">*</span></label>
										<input type="text" class="validate form-control datepicker" readonly="readonly" id="date_of_birth" required name="date_of_birth"  value="{{(empty($candidate->date_of_birth)) ? "" : $candidate->date_of_birth }}" placeholder="format : YYYY-MM-DD, example : 2018-03-14" data-date-format="yyyy-mm-dd" >
										<i class="invalid-feedback" role="alert"></i>	 												
									</div>

									<div class="form-group">
										<label class="control-label"> KTP NO <span class="span-mandatory">*</span></label>
										<input type="text" class="validate form-control number_valid_char"  placeholder="Ex: 1231285573753757" maxlength="16" required id="ktp_no" name="ktp_no"  value="{{(empty($candidate->ktp_no)) ? "" : $candidate->ktp_no }}" >
										<i class="invalid-feedback" role="alert"></i>	 												
									</div>

									<div class="form-group">
										<label class="control-label"> RELIGION <span class="span-mandatory">*</span></label>
										<select class="form-control" id="religion" name="religion" required >
										<option value=""> - Choose Religion - </option>
										@foreach($religion as $agama)
											<option value="{{$agama->name}}" {{(!empty($candidate->religion) && $candidate->religion == $agama->name ) ? "selected" : "" }} >{{$agama->name}}  </option>
										@endforeach
										</select>
										<i class="invalid-feedback" role="alert"></i>	 												
									</div>

									<div class="form-group">
										<label class="control-label"> MARITAL STATUS <span class="span-mandatory">*</span></label>
										<select class="form-control" id="marital_status" required name="marital_status" >
										<option value=""> - Choose Marital - </option>
										@foreach($marital as $ma)
											<option value="{{$ma->nama}}"  {{(!empty($candidate->marital_status) && $candidate->marital_status == $ma->nama ) ? "selected" : "" }} >{{$ma->nama}}  </option>
										@endforeach
										</select>
										<i class="invalid-feedback" role="alert"></i>	 												
									</div>

									<div class="form-group">
										<label class="control-label"> ADDRESS <span class="span-mandatory">*</span></label>
										<textarea class="form-control" id="address" required name="address" >{{(empty($candidate->address)) ? "" : $candidate->address }}</textarea>
										<i class="invalid-feedback" role="alert"></i>	
									</div>
								</div>

								<div class="col-md-6">
		                			<input type="hidden" name="candidate_id" value="{{$userinfo['candidate_id']}}">
									<div class="form-group">
										<label class="control-label"> CITY </label>
										<select class="form-control" id="city" required name="city" >
											<option value=""> - Choose City - </option>
											@foreach($city as $ct)
												<option value="{{$ct->name}}"  {{(!empty($candidate->city) && $candidate->city == $ct->name ) ? "selected" : "" }} >{{$ct->name}}  </option>
											@endforeach
										</select>
										<i class="invalid-feedback" role="alert"></i>
									</div>

									<div class="form-group">
										<label class="control-label"> POSTAL CODE</label>
										<input type="text" class="validate form-control number_valid_char" placeholder="Ex : 17131" id="postal_code" name="postal_code" maxlength="6" value="{{(empty($candidate->postal_code)) ? "" : $candidate->postal_code }}">
										<i class="invalid-feedback" role="alert"></i>
									</div>

									<div class="form-group">
										<label class="control-label"> NATIONALITY <span class="span-mandatory">*</span></label>
										<select class="form-control" id="nationality" required name="nationality" >
											<option value="Indonesian"> Indonesian </option>
											@foreach($nationality as $national)
												<option value="{{$national->nama}}" {{$national->nama}}  {{(!empty($candidate->nationality) && $candidate->nationality == $national->nama ) ? "selected" : "" }} >{{$national->nama}}  </option>
											@endforeach
										</select>
										<i class="invalid-feedback" role="alert"></i>	 												
									</div>

									<div class="form-group">
										<label class="control-label"> PHONE NUMBER </label>
										<input type="text" class="validate form-control number_valid_char" placeholder="Ex : 02188837373" maxlength="15"  id="phone_no" name="phone_no"  value="{{(empty($candidate->phone_no)) ? "" : $candidate->phone_no }}">
										<i class="invalid-feedback" role="alert"></i>	 												
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label class="control-label"> WHATSAPP NUMBER <span class="span-mandatory">*</span></label>
												<input type="text"  maxlength="15" class="validate form-control number_valid_char" id="hp_1" required name="hp_1"  value="{{(empty($candidate->hp_1)) ? "" : $candidate->hp_1 }}" placeholder="Mobile Number 1" >
												<i class="invalid-feedback" role="alert"></i>
											</div>
											<br/>
											<div class="col-sm-6" style="margin-top: 30px">
												<input type="text" class="validate form-control number_valid_char" id="hp_2" name="hp_2" maxlength="15" value="{{(empty($candidate->hp_2)) ? "" : $candidate->hp_2 }}" placeholder="Mobile Number 2">
												<i class="invalid-feedback" role="alert"></i>	 												
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6">
												<label class="control-label"> BPJS </label>
												<input type="text"  maxlength="15" class="validate form-control number_valid_char" id="bpjs_kesehatan" required name="bpjs_kesehatan"  value="{{(empty($candidate->bpjs_kesehatan)) ? "" : $candidate->bpjs_kesehatan }}" placeholder=" BPJS Kesehatan " >
												<i class="invalid-feedback" role="alert"></i>
											</div>
											<br/>
											<div class="col-sm-6" style="margin-top: 30px">
												<input type="text" class="validate form-control number_valid_char" id="bpjs_tenaga_kerja" name="bpjs_tenaga_kerja" maxlength="15" value="{{(empty($candidate->bpjs_tenaga_kerja)) ? "" : $candidate->bpjs_tenaga_kerja }}" placeholder="BPJS tenaga kerja">
												<i class="invalid-feedback" role="alert"></i>	 												
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label"> EMAIL <span class="span-mandatory">*</span></label>
										<input type="text" maxlength="50"  readonly class="validate form-control" id="email"   onchange="emailCheck()" required name="email"  value="{{(empty($candidate->email)) ? "" : $candidate->email }}" >
										<i class="invalid-feedback" role="alert"></i>	 										
									</div>
		
									</form>
								</div><!-- end col 6 -->
							</div>
						</div>  <!-- end row --->
					</div><!-- END STEP 1 -->

					<div id="step-2"> <!-- STEP 2 --->
						<h5 class="font-20 mb-2"> CANDIDATE DATA</h5>
		                <form id="form-candidate-step-2">
		              		<input type="hidden" maxlength="50"  readonly class="validate form-control"   onchange="emailCheck()" required name="email"  value="{{(empty($candidate->email)) ? "" : $candidate->email }}" >
							<div style="background-color: #f0f0f0;padding: 20px;">
								<h5>LAST EDUCATION</h5>
								<div class="row mt-2">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label"> STRATA <span class="span-mandatory">*</span></label>
											<select class="form-control" id="edu_degree" name="edu_degree" required>
												<option value=""> - Choose Strata - </option>
												@foreach($education as $ed)
													<option value="{{$ed->name}}" {{(!empty($candidate->edu_degree) && $candidate->edu_degree == $ed->name ) ? "selected" : "" }}>{{$ed->name}}  </option>
												@endforeach
											</select>
											<i class="invalid-feedback" role="alert"></i>	 												
										</div>

										<div class="form-group">
											<label class="control-label"> MAJOR <span class="span-mandatory">*</span></label>
											<select class="form-control" id="edu_major" name="edu_major" required>
												<option value=""> - Choose Major - </option>
												@foreach($major as $mj)
													<option value="{{$mj->name}}" {{(!empty($candidate->edu_major) && $candidate->edu_major == $mj->name ) ? "selected" : "" }}>{{$mj->name}}  </option>
												@endforeach
											</select>
											<i class="invalid-feedback" role="alert"></i>									
										</div>

										<div class="form-group">
											<label class="control-label"> SCHOOL / UNIVERSITY <span class="span-mandatory">*</span></label>
											 <select name="edu_university" id="edu_university" class="form-control">
                								<option value=""> - Choose School / University - </option>
						                        @foreach($list_school as $school)
						                            <option value="{{$school->name}}" {{($school->name == $candidate->edu_university) ? 'selected':''}}>{{$school->name}}</option>
						                        @endforeach
						                      </select>
											<i class="invalid-feedback" role="alert"></i>									
										</div>

									</div>


									<div class="col-sm-6">
										
										<div class="form-group">
											<label class="control-label"> IPK/GPA  <span class="span-mandatory">*</span></label>
											 <input type="text" class="numeric validate form-control number_valid" required id="edu_ipk" name="edu_ipk"  value="{{(empty($candidate->edu_ipk)) ? "" : $candidate->edu_ipk }}" placeholder="example : 3.45" maxlength="4" >
											<i class="invalid-feedback" role="alert"></i>									
										</div>

										<div class="form-group">
											<label class="control-label"> START YEAR  <span class="span-mandatory">*</span></label>
											<input type="text" class="validate form-control number_valid_char" maxlength="4" id="edu_start_year" name="edu_start_year" required  value="{{(empty($candidate->edu_start_year)) ? "" : $candidate->edu_start_year }}" placeholder="format : YYYY, example : 2018" >
											<i class="invalid-feedback" role="alert"></i>									
										</div>


										<div class="form-group">
											<label class="control-label"> END YEAR  <span class="span-mandatory">*</span></label>
											<input type="text" class="validate form-control number_valid_char"  maxlength="4" id="edu_end_year" name="edu_end_year" required  value="{{(empty($candidate->edu_end_year)) ? "" : $candidate->edu_end_year }}" placeholder="format : YYYY, example : 2018" >
											<i class="invalid-feedback" role="alert"></i>									
										</div>
									</div>
								</div>
							</div>

							<br>
							<div style="background-color: #f0f0f0;padding: 20px;">
								<h5>LATEST EXPERIENCE</h5>
								<div  class="row mt-2">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label"> COMPANY </label>
											<input type="text" class="validate form-control" id="exp_company"   placeholder="Ex : PT 213" name="exp_company" maxlength="50" value="{{(empty($candidate->exp_company)) ? "" : $candidate->exp_company }}">
											<i class="invalid-feedback" role="alert"></i>	 												
										</div>

										<div class="form-group">
											<label class="control-label"> POSITION </label>
											<input type="text" class="validate form-control" id="exp_position" placeholder="Ex : Sales" name="exp_position" maxlength="50" value="{{(empty($candidate->exp_position)) ? "" : $candidate->exp_position }}">
											<i class="invalid-feedback" role="alert"></i>									
										</div>

										<div class="form-group">
											<label class="control-label"> JOB DESC </label>
											<textarea class="form-control" id="job_desc" rows="5" name="job_desc">{{(empty($candidate->job_desc)) ? "" : $candidate->job_desc }}</textarea>
											<i class="invalid-feedback" role="alert"></i>									
										</div>

										<div class="form-group">
											<label class="control-label"> INDUSTRY SECTOR </label>
											<input type="text" class="validate form-control" id="exp_buss_sector" placeholder="Ex : Otomotif" name="exp_buss_sector" maxlength="50" value="{{(empty($candidate->exp_buss_sector)) ? "" : $candidate->exp_buss_sector }}">
											<i class="invalid-feedback" role="alert"></i>									
										</div>
										
									</div>


									<div class="col-sm-6">
										
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label class="control-label"> START MONTH </label>
													<input type="text" class="validate form-control number_valid_char" id="exp_start_month" name="exp_start_month" maxlength="2" value="{{(empty($candidate->exp_start_month)) ? "" : $candidate->exp_start_month }}" placeholder="MM : 12">
													<i class="invalid-feedback" role="alert"></i>									
												</div>
												<div class="col-sm-6">
													<label class="control-label"> START YEAR </label>
													<input type="text" class="validate form-control number_valid_char" id="exp_start_year" name="exp_start_year" maxlength="4" value="{{(empty($candidate->exp_start_year)) ? "" : $candidate->exp_start_year }}" placeholder="YYYY : 2018">
													<i class="invalid-feedback" role="alert"></i>
												</div>
											</div>

										</div>


										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label class="control-label"> END MONTH </label>
													<input type="text" class="validate form-control  number_valid_char" id="exp_end_month" name="exp_end_month" maxlength="2" value="{{(empty($candidate->exp_end_month)) ? "" : $candidate->exp_end_month }}" placeholder="MM : 12">
													<i class="invalid-feedback" role="alert"></i>									
												</div>
												<div class="col-sm-6">
													<label class="control-label"> END YEAR </label>
													<input type="text" class="validate form-control number_valid_char" id="exp_end_year" name="exp_end_year" maxlength="4" value="{{(empty($candidate->exp_end_year)) ? "" : $candidate->exp_end_year }}" placeholder="YYYY : 2018">
													<i class="invalid-feedback" role="alert"></i>
												</div>
											</div>

										</div>

										<div class="form-group">
											<label class="control-label"> TOTAL JOB EXPERIENCE  </label>
											<input type="text" class="validate form-control  number_valid_char" id="exp_total" name="exp_total" maxlength="2" value="{{(empty($candidate->exp_total)) ? "" : $candidate->exp_total }}" placeholder="TOTAL MONTH . EX: 12">
											<i class="invalid-feedback" role="alert"></i>									
										</div>


										<div class="form-group">
											<label class="control-label"> CURRENT SALARY  </label>
											<input type="text" class="validate form-control number_valid_char" id="exp_salary_existing" name="exp_salary_existing" maxlength="50" value="{{(empty($candidate->exp_salary_existing)) ? "" : $candidate->exp_salary_existing }}" placeholder="ex: 5000000">									
											<i class="invalid-feedback" role="alert"></i>									
										</div>
									</div>
								</div>
							</div>
						</form>
		          	</div> <!-- End step 2 -->



		          	<div id="step-3"> <!-- STEP 3 --->
		          		<h1>ENTRY DATA</h1>
		               	<form id="form-candidate-step-3">
		               		<input type="hidden" maxlength="50"  readonly class="validate form-control"   onchange="emailCheck()"  name="email"  value="{{(empty($candidate->email)) ? "" : $candidate->email }}" >
							<div style="background-color: #f0f0f0;padding: 20px;">
								<h5>VACANCY INFORMATION</h5>
								<div class="row mt-2">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label font-14"> Source of Job Vacancy <span class="span-mandatory">*</span></label>
											<select class="form-control" id="source" name="source" >
												<option value=""> - Choose Source - </option>
												@foreach($source as $so)
													<option value="{{$so->nama}}" {{(!empty($candidate->source) && $candidate->source == $so->nama ) ? "selected" : "" }} >{{$so->nama}}  </option>
												@endforeach
											</select>
											<i class="invalid-feedback" role="alert"></i> 												
										</div>
									</div>
								</div>
							</div>

							<br>

							<div style="background-color: #f0f0f0;padding: 20px;">
								<h5> ATTACHMENT</h5>
								<div  class="row mt-2">
									<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label font-14"> PHOTO PROFILE<span class="span-mandatory">*</span></label>
												<input class="form-control" type="file" name="file_1"  id="file_1">
												<i class="invalid-feedback" role="alert"></i>
												<input type="hidden" name="file_1_edit" required value="{{(empty($candidate->file_1)) ? "" : $candidate->file_1 }}">
												@php 
													if(empty($candidate->file_1)):
												@endphp
													<div></div>
												@php 
													else:
												@endphp
													<img src="{{asset("upload_file/$candidate->file_1")}}" id="output_image_front" width="200px"/>
												@php 
													endif
												@endphp
												<span>File format must be on JPG,JPEG,PNG -  MAX 500kb</span>
											</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label  font-14"> CV <span class="span-mandatory">*</span></label>
											<input class="form-control" type="file" name="file_2"  id="file_2" >
											<i class="invalid-feedback" role="alert"></i>
											<input type="hidden" name="file_2_edit" required value="{{(empty($candidate->file_2)) ? "" : $candidate->file_2 }}">
											 <a href="{{url("upload_file/$candidate->file_2")}}" target="_blank" id="fname"> {{$candidate->file_2}}   </a> 
											<span>File format must be on PDF - MAX 500kb</span>
										</div>
									</div>
								</div>
							</div>
						</form>

		          	</div> <!-- End step 3 -->

		          	<!-- STEP 4 --->
		          	{{-- <div id="step-4"> 
		          	
		                
		          	</div>  --}}
		          	<!-- End step 4 -->


				</div><!-- END WIZARD -->

			</div><!-- end col 12 -->

    	</div>
    </div>
</div>



@endsection

@section('js')
@include('frontend.form_candidate.js_form_candidate')
@endsection

