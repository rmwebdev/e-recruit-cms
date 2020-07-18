@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-plus"></i> Entry Data
                    <a href="{{url('candidate-regis')}}" class="btn btn-warning pull-right">CANCEL</a>
                </div>

                <div class="card-body">
                  	<div class="section">
	                  	<form id="form-candidate">

						  <div class="form-row"> <!-- This DIV FORM -->
							<div class="col-md-6">  <!-- Left Form  --->
								<label for="" class="control-label">BIODATA</label>
					       		<table class="table table-responsive table-striped">
									<tr>
										<td>NAME <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control" id="name_holder" required="required" name="name_holder" size="50" value="" >
 												<span class="invalid-feedback" role="alert"></span>
                                        </td>
									</tr>
									

									<tr>
										<td>PLACE OF BIRTH <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control" id="place_of_birth" required="required" name="place_of_birth" size="50" value="{{(empty($candidate->place_of_birth)) ? "" : $candidate->place_of_birth }}" placeholder=" EX : JAKARTA">
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									
									<tr>
										<td>DATE OF BIRTH <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control datepicker" readonly="readonly" id="date_of_birth" required="required" name="date_of_birth" size="50" value="" placeholder="format : YYYY-MM-DD, example : 2018-03-14" data-date-format="yyyy-mm-dd" >
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>

									<tr>
										<td>KTP NO <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid_char" maxlength="16" required="required" id="ktp_no" name="ktp_no" size="50" value="" >
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
								

									<tr>
										<td>RELIGION <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="religion" name="religion" required="required" >
												<option value=""> - Choose Religion - </option>
												@foreach($religion as $agama)
													<option value="{{$agama->name}}">{{$agama->name}}  </option>
												@endforeach
											</select>
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									<tr>
										<td>MARITAL STATUS <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="marital_status" required="required" name="marital_status" >
												<option value=""> - Choose Marital - </option>
												@foreach($marital as $ma)
													<option value="{{$ma->nama}}">{{$ma->nama}}  </option>
												@endforeach
											</select>
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									<tr>
										<td>ADDRESS <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<textarea class="form-control" id="address" required="required" name="address" ></textarea>
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>

					                  <tr>
					                    <td>CITY <span class="span-mandatory">*</span></td>
					                    <td>:</td>
					                    <td>
					                    <div class="table-responsive">
					                      <div class="city_select2_complete">
					                        <select class="form-control" id="city" required="required" name="city" >
					                          <option value=""> - Choose City - </option>
					                          @foreach($city as $ct)
					                            <option value="{{$ct->name}}"  {{(!empty($candidate->city) && $candidate->city == $ct->name ) ? "selected" : "" }} >{{$ct->name}}  </option>
					                          @endforeach
					                        </select>
					                      </div>
					                    </div>
					                    </td>
					                  </tr>
					                  
									<tr>
										<td>POSTAL CODE </td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid_char" id="postal_code" name="postal_code" maxlength="6" value="">
										</td>
									</tr>
									<tr>
										<td>NATIONALITY <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="nationality" required="required" name="nationality" >
												<option value="Indonesian"> Indonesian </option>
												@foreach($nationality as $national)
													<option value="{{$national->name}}">{{$national->name}}  </option>
												@endforeach
											</select>
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									<tr>
										<td>PHONE NUMBER</td>
										<td>:</td>
										<td><input type="text" class="validate form-control number_valid_char" id="phone_no" name="phone_no" size="50" value=""></td>
									</tr>
									<tr>
										<td>MOBILE NUMBER <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid_char" id="hp_1" required="required" name="hp_1" size="50" value="" placeholder="Mobile Number 1" >
											<span class="invalid-feedback" role="alert"></span>
											<br/>
											<input type="text" class="validate form-control number_valid_char" id="hp_2" name="hp_2" size="50" value="" placeholder="Mobile Number 2">
										</td>
									</tr>
									<tr>
										<td>EMAIL <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control" id="email" onchange="emailCheck()" required="required" name="email" size="50" value="" >
											<span class="invalid-feedback" role="alert"></span>
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
											<input class="form-control" type="file" name="file_1" required="required" id="file_1" >
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>File format must be on JPG,JPEG,PNG</td>
									</tr>
									<tr>
										<td>CV <span class="span-mandatory">* </span></td>
										<td>:</td>
										<td>
											<input class="form-control" type="file" name="file_2" required="required" id="file_2" >
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>File format must be on PDF</td>
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
					                          <option value="{{$ed->name}}">{{$ed->name}}  </option>
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
					                          <option value="{{$mj->name}}">{{$mj->name}}  </option>
					                        @endforeach
					                      </select>


					                      <i class="invalid-feedback" role="alert"></i>
					                    </td>
					                </tr>
					                <tr>
					                    <td>UNIVERSITY / SCHOOL <span class="span-mandatory">*</span></td>
					                    <td>:</td>
					                    <td>
					                    <input type="text" class="validate form-control" id="edu_university" maxlength="100" required="required" name="edu_university" size="50" value="" placeholder="example : Universitas Indonesia / SMK 1 Negeri" >
					                    </td>
					                </tr>
									<tr>
										<td>IPK/GPA <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="number_valid form-control" required="required" id="edu_ipk" name="edu_ipk" size="50" value="" placeholder="example : 3.45" size="4" >
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									<tr>
										<td>START YEAR <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid_char" maxlength="4" id="edu_start_year" name="edu_start_year" size="50" value="" placeholder="format : YYYY, example : 2018" >
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									<tr>
										<td>END YEAR <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid_char"  maxlength="4" id="edu_end_year" name="edu_end_year" size="50" value="" placeholder="format : YYYY, example : 2018" >
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
								</table>
								<label for="" class="control-label">LATEST EXPERIENCE</label>
								<table class="table table-responsive table-striped">
									<tr>
										<td>COMPANY</td>
										<td>:</td>
										<td colspan="2"><input type="text" class="validate form-control" id="exp_company" name="exp_company" size="50" value=""></td>
									</tr>
									<tr>
										<td>POSITION</td>
										<td>:</td>
										<td colspan="2"><input type="text" class="validate form-control" id="exp_position" name="exp_position" size="50" value=""></td>
									</tr>
									<tr>
										<td>JOB DESC.</td>
										<td>:</td>
										<td colspan="2"><textarea class="form-control" id="job_desc" name="job_desc"></textarea></td>
									</tr>
									<tr>
										<td>INDUSTRY SECTOR</td>
										<td>:</td>
										<td colspan="2"><input type="text" class="validate form-control" id="exp_buss_sector" name="exp_buss_sector" size="50" value=""></td>
									</tr>
									<tr>
										<td>START</td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control number_valid_char" id="exp_start_month" name="exp_start_month" maxlength="2" value="" placeholder="MM : 12">
											<span class="invalid-feedback" role="alert"></span>
										</td>
										<td>
											<input type="text" class="validate form-control number_valid_char" id="exp_start_year" name="exp_start_year" maxlength="4" value="" placeholder="YYYY : 2018">
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
									<tr>
										<td>END</td>
										<td>:</td>
										<td>
											<input type="text" class="validate form-control  number_valid_char" id="exp_end_month" name="exp_end_month" maxlength="2" value="" placeholder="MM : 12">
											<span class="invalid-feedback" role="alert"></span>
										</td>
										<td>
											<input type="text" class="validate form-control number_valid_char" id="exp_end_year" name="exp_end_year" maxlength="4" value="" placeholder="YYYY : 2018">
											<span class="invalid-feedback" role="alert"></span>
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
										<td>SOURCE OF JOB VACANCY <span class="span-mandatory">*</span></td>
										<td>:</td>
										<td>
											<select class="form-control" id="source" name="source" >
												<option value=""> - Choose Source - </option>
												@foreach($source as $so)
													<option value="{{$so->nama}}">{{$so->nama}}  </option>
												@endforeach
											</select>
											<span class="invalid-feedback" role="alert"></span>
										</td>
									</tr>
								</table>
						    </div>
						    <!-- End Right form -->
						  </div>
						  <!--  END FORM -->

							<div style="clear:both"></div>
							<center>
								<a href="{{url('candidate-regis')}}" class="btn btn-warning">CANCEL</a>
								<button type="submit" class="btn btn-primary" id="SaveCandidate" >SAVE</button>
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

