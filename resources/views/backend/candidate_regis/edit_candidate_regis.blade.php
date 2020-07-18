@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-plus"></i> EDIT CANDIDATE DATA 
                 	<a href="{{url('candidate-regis')}}" class="btn btn-warning pull-right" >CANCEL</a>
                </div>

                <div class="card-body">
                  	<div class="section">
	                  	<form id="form-candidate-edit">

						  <div class="form-row"> <!-- This DIV FORM -->
							<div class="col-md-6">  <!-- Left Form  --->
								<label for="" class="control-label">BIODATA</label>
								<input type="hidden" name="candidate_id" value="{{$candidate->candidate_id}}">
					       		<table class="table table-responsive table-striped">
									<tr>
										<td>NAME <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control" id="name_holder" value="{{$candidate->name_holder}}" name="name_holder" size="50" value="" >
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
											<input type="text" class="validate form-control" id="place_of_birth" required="required" name="place_of_birth" size="50" value="{{(empty($candidate->place_of_birth)) ? "" : $candidate->place_of_birth }}" placeholder=" EX : JAKARTA">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									
									<tr>
										<td>DATE OF BIRTH <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control datepicker" id="date_of_birth" name="date_of_birth"  size="50" data-date-format="yyyy-mm-dd" value="{{$candidate->date_of_birth}}" >
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>

									<tr>
										<td>KTP NO <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid" id="ktp_no" value="{{$candidate->ktp_no}}" name="ktp_no" size="50" value="" >
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>

									<tr>
										<td>RELIGION <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="religion" name="religion" >
												<option value=""> - Choose Religion - </option>
												@foreach($religion as $agama)
													<option value="{{$agama->name}}"  {{($agama->name == $candidate->religion ) ? "selected":""}} >{{$agama->name}}  </option>
												@endforeach
											</select>
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>MARITAL STATUS <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="marital_status" name="marital_status" >
												<option value=""> - Choose Marital - </option>
												@foreach($marital as $ma)
													<option value="{{$ma->nama}}"  {{($ma->nama == $candidate->marital_status ) ? "selected":""}}>{{$ma->nama}}  </option>
												@endforeach
											</select>
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>ADDRESS <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<textarea class="form-control" id="address" name="address" >{{$candidate->address}}</textarea>
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
					                      </div>
					                    </td>
					                  </tr>
					                  
									<tr>
										<td>POSTAL CODE </td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control" id="postal_code" name="postal_code" size="50" value="{{$candidate->postal_code}}">
										</td>
									</tr>
									<tr>
										<td>NATIONALITY <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="nationality" name="nationality" >
												@foreach($nationality as $national)
													<option value="{{$national->nama}}" {{($national->nama == $candidate->nationality ) ? "selected":""}} > {{$national->nama}}  </option>
												@endforeach
											</select>
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>PHONE NUMBER</td>
										<td>:</td>
										<td><input type="text" class="validate form-control number_valid" id="phone_no" name="phone_no" size="50" value="{{$candidate->phone_no}}"></td>
									</tr>
									<tr>
										<td>MOBILE NUMBER <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid" id="hp_1" name="hp_1" size="50" value="{{$candidate->hp_1}}" >
											<i class="invalid-feedback" role="alert"></i>
											<br/>
											<input type="text" class="validate form-control number_valid" id="hp_2" name="hp_2" size="50" value="{{$candidate->hp_2}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>EMAIL <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text"  readonly class="validate form-control" id="email" onchange="emailCheck()" name="email" size="50" value="{{$candidate->email}}" >
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
										<td>Photo Profile <span class="span-mandatory">* </span></td>
										<td>:</td>
										<td>
											<input class="form-control" type="file" name="file_1" id="file_1"  onchange="changFile1(this)">
											<i class="invalid-feedback" role="alert"></i>
											<input type="hidden" name="file_1_edit" value="{{$candidate->file_1}}">
										</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>File format must be on JPG,JPEG,PNG</td>
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
													<img src="{{asset("upload_file/$candidate->file_1")}}" id="output_image" width=200px"/>
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
											<input class="form-control" type="file" name="file_2" id="file_2" >
											<input type="hidden" name="file_2_edit" value="{{$candidate->file_2}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>File format must be on PDF</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td><div> <a href="{{url("upload_file/$candidate->file_2")}}" target="_blank" id="fname"> {{$candidate->file_2}}   </a>  </div></td>
									</tr>
								</table>
								<label for="" class="control-label">LATEST EDUCATION</label>
								<table class="table table-responsive table-striped">
									<tr>
										<td>STRATA <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="edu_degree" name="edu_degree" required="required">
												<option value=""> - Choose Strata - </option>
												@foreach($education as $ed)
													<option value="{{$ed->name}}" {{(!empty($candidate->edu_degree) && $candidate->edu_degree == $ed->name ) ? "selected" : "" }}>{{$ed->name}}  </option>
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
													<option value="{{$mj->name}}" {{(!empty($candidate->edu_major) && $candidate->edu_major == $mj->name ) ? "selected" : "" }}>{{$mj->name}}  </option>
												@endforeach
											</select>


											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>UNIVERSITY / SCHOOL <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
							
											<input type="text" class="validate form-control" id="edu_university" name="edu_university" size="50" value="{{$candidate->edu_university}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>IPK/GPA <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="numeric validate form-control" id="edu_ipk" name="edu_ipk" size="50" value="{{$candidate->edu_ipk}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>START YEAR  <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid"  maxlength="4" id="edu_start_year" name="edu_start_year" size="50" value="{{$candidate->edu_start_year}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>END YEAR  <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid" maxlength="4" id="edu_end_year" name="edu_end_year" size="50" value="{{$candidate->edu_end_year}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
								</table>
								<label for="" class="control-label">LATEST EXPERIENCE</label>
								<table class="table table-responsive table-striped">
									<tr>
										<td>COMPANY</td>
										<td>:</td>
										<td colspan="2"><input type="text" class="validate form-control" id="exp_company" name="exp_company" size="50" value="{{$candidate->exp_company}}"></td>
									</tr>
									<tr>
										<td>POSITION</td>
										<td>:</td>
										<td colspan="2"><input type="text" class="validate form-control" id="exp_position" name="exp_position" size="50" value="{{$candidate->exp_position}}"></td>
									</tr>
									<tr>
										<td>JOB DESC.</td>
										<td>:</td>
										<td colspan="2"><textarea class="form-control" id="job_desc" name="job_desc">{{$candidate->job_desc}}</textarea></td>
									</tr>
									<tr>
										<td>INDUSTRY SECTOR</td>
										<td>:</td>
										<td colspan="2">
											<input type="text" class="validate form-control" id="exp_buss_sector" name="exp_buss_sector" size="50" value="{{$candidate->exp_buss_sector}}">
										</td>
									</tr>
									<tr>
										<td>START</td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid" id="exp_start_month" name="exp_start_month" maxlength="2" value="{{$candidate->exp_start_month}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
										<td>
											<input type="text" class="validate form-control number_valid" id="exp_start_year" name="exp_start_year" maxlength="4" value="{{$candidate->exp_start_year}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>END</td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control  number_valid" id="exp_end_month" name="exp_end_month" maxlength="2" value="{{$candidate->exp_end_month}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
										<td>
											<input type="text" class="validate form-control number_valid" id="exp_end_year" name="exp_end_year" maxlength="4" value="{{$candidate->exp_end_year}}">
											<i class="invalid-feedback" role="alert"></i>
										</td>
									</tr>
									<tr>
										<td>TOTAL JOB EXPERIENCE</td>
										<td>:</td>
										<td colspan="2"><input type="text" class="validate form-control number_valid" id="exp_total" name="exp_total" size="50" value="{{$candidate->exp_total}}"></td>
									</tr>
									<tr>
										<td>CURRENT SALARY</td>
										<td>:</td>
										<td colspan="2"><input type="text" class="validate form-control number_valid" id="exp_salary_existing" name="exp_salary_existing" size="50" value="{{$candidate->exp_salary_existing}}"></td>
									</tr>
								</table>
								<label for="" class="control-label">VACANCY INFORMATION</label>
								<table class="table table-responsive table-striped">
									<tr>
										<td>SOURCE OF JOB VACANCY <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="source" name="source" >
												<option value=""> - Choose Source - </option>
												@foreach($source as $so)
													<option value="{{$so->nama}}" {{($so->nama == $candidate->source ) ? "selected":""}} >{{$so->nama}}  </option>
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

						  <!-- THIS ASSESSMENT -->
						  <div class="form-row"> <!-- This DIV FORM -->
								<div class="col-md-12">
									<label for="" class="control-label">PRE-ASSESSMENT</label>
									<input type="hidden" name="countPreassesment" value="{{count($assessment)}}">
									<table class="table table-responsive table-bordered" id="">
										<tr>
											<th style="text-align:center">No.</th>
											<th style="text-align:center">Question</th>
											<th style="text-align:center">Answer</th>
										</tr>	
										@php  $no='1'; @endphp
										@foreach($assessment as $assess)
											@php 
												$data_asses = DB::table('e_recruit.tr_assessment')
												->where('candidate_id',$candidate->candidate_id)
												->where('asses_quest_id',$assess->asses_quest_id)->first();
											@endphp
										<tr>
											<td width="5%">{{$no}}</td>
											<td width="55%">  {{$assess->quest}} </td>
											<td>
												  <div class="row">
												    <div class="col-md-4">
												    	<label class="radio-inline"><input type="radio" required="required" disabled name="assessment{{$no}}"  {{ (!empty($data_asses->answer) && ($data_asses->answer == 'yes'))  ? 'checked':'' }}  onchange="inputAsses(this,'yes','{{$no}}')"  value="YES"> Yes</label>
												    	<input type="hidden" name="asses_quest_id{{$no}}" value="{{$assess->asses_quest_id}}">
														<label class="radio-inline"><input type="radio" required="required" disabled name="assessment{{$no}}" {{ (!empty($data_asses->answer) && ($data_asses->answer == 'no'))  ? 'checked':'' }}  onchange="inputAsses(this,'no','{{$no}}')"  value="NO"> No</label>
														<input type="hidden"  value=" {{(empty($data_asses->answer)) ? '':$data_asses->answer }} " class="form-control" name="hideChoose{{$no}}" id="hideChoose{{$no}}">
														<i class="invalid-feedback" role="alert"></i>
												    </div>
												    <div class="col-md-8">		
												    	@php 
											      			if(!empty($data_asses) &&  (!empty($data_asses->remarks))):
											      			echo $data_asses->remarks
											      		@endphp
											      		@endif
												    </div>
												  </div>
											</td>
										</tr>
										@php  $no++ @endphp
										@endforeach
									</table>								

								</div>
							</div>
							<!-- END ASSESSMENT -->
							<div style="clear:both"></div>
							<center>
								<a href="{{url('candidate-regis')}}" class="btn btn-warning">CANCEL</a>
								<button type="submit" class="btn btn-primary" id="SaveCandidate" >UPDATE</button>
							</center>

						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @include('backend.candidate_regis.js_candidate_regis')
@endsection

