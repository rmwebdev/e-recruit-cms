@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-plus"></i> CANDIDATE DETAIL
                 	<a href="javascript:window.close()" class="btn btn-warning pull-right"  >CLOSE</a>
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
										<td  width="45%">NAME</td>
										<td  width="5%">:</td>
										<td width="50%">{{$candidate->name_holder}}</td>
									</tr>
									<tr>
										<td>KTP NO</td>
										<td>:</td>
										<td>{{$candidate->ktp_no}}</td>
									</tr>
									<tr>
										<td>PLACE OF BIRTH</td>
										<td>:</td>
										<td>{{$candidate->place_of_birth}}</td>
									</tr>

									<tr>
										<td>DATE OF BIRTH</td>
										<td>:</td>
										<td>{{$candidate->date_of_birth}}</td>
									</tr>
									<tr>
										<td>RELIGION</td>
										<td>:</td>
										<td>{{$candidate->religion}}</td>
									</tr>
									<tr>
										<td>MARITAL STATUS</td>
										<td>:</td>
										<td>{{$candidate->marital_status}}</td>
									</tr>
									<tr>
										<td>ADDRESS</td>
										<td>:</td>
										<td>{{$candidate->address}}</td>
									</tr>
									<tr>
										<td>POSTAL CODE </td>
										<td>:</td>
										<td>{{$candidate->postal_code}}
										</td>
									</tr>
									<tr>
										<td>NATIONALITY</td>
										<td>:</td>
										<td>{{$candidate->nationality}}
										</td>
									</tr>
									<tr>
										<td>PHONE NUMBER</td>
										<td>:</td>
										<td>{{$candidate->phone_no}}</td>
									</tr>
									<tr>
										<td>MOBILE NUMBER</td>
										<td>:</td>
										<td>{{$candidate->hp_1}}
											<br/>
											{{$candidate->hp_2}}
										</td>
									</tr>
									<tr>
										<td>EMAIL</td>
										<td>:</td>
										<td>{{$candidate->email}}
										</td>
									</tr>
								</table>

						    </div>
						    <!-- End left form -->


						    <!-- Right form -->
							<div class="col-md-6">
								<label for="" class="control-label">ATTACHMENT</label>
					      		<table class="table table-responsive table-striped">
								
									<tr>
										<td width="45%">Photo Profile</td>
										<td width="5%">:</td>
										<td   width="50%" >
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
										<td>CV</td>
										<td>:</td>
										<td><div> <a href="{{url("upload_file/$candidate->file_2")}}" target="_blank" id="fname"> {{$candidate->file_2}}   </a>  </div></td>
									</tr>

								</table>
								<label for="" class="control-label">LATEST EDUCATION</label>
								<table class="table table-responsive table-striped">
									<tr>
										<td width="45%">STRATA</td>
										<td width="5%">:</td>
										<td   width="50%" >{{$candidate->edu_degree}}
										</td>
									</tr>
									<tr>
										<td>MAJOR</td>
										<td>:</td>
										<td>{{$candidate->edu_major}}
											
										</td>
									</tr>
									<tr>
										<td>UNIVERSITY / SCHOOL</td>
										<td>:</td>
										<td>{{$candidate->edu_university}}
											
										</td>
									</tr>
									<tr>
										<td>IPK/GPA</td>
										<td>:</td>
										<td>{{$candidate->edu_ipk}}
										</td>
									</tr>
									<tr>
										<td>START YEAR</td>
										<td>:</td>
										<td>{{$candidate->edu_start_year}}
										
										</td>
									</tr>
									<tr>
										<td>END YEAR</td>
										<td>:</td>
										<td>{{$candidate->edu_end_year}}
										</td>
									</tr>
								</table>
								<label for="" class="control-label">LATEST EXPERIENCE</label>
								<table class="table table-responsive table-striped">
									<tr>
										<td width="45%">COMPANY</td>
										<td  width="5%" >:</td>
										<td  width="50%">{{$candidate->exp_company}}</td>
									</tr>
									<tr>
										<td>POSITION</td>
										<td>:</td>
										<td>{{$candidate->exp_position}}</td>
									</tr>
									<tr>
										<td>JOB DESC.</td>
										<td>:</td>
										<td>{{$candidate->job_desc}}</td>
									</tr>
									<tr>
										<td>INDUSTRY SECTOR</td>
										<td>:</td>
										<td>
											{{$candidate->exp_buss_sector}}
										</td>
									</tr>
									<tr>
										<td  width="45%">START</td>
										<td   width="5%">:</td>
										<td  width="50%">{{$candidate->exp_start_month}} - {{$candidate->exp_start_year}}
										</td>
										
									</tr>
									<tr>
										<td>END</td>
										<td>:</td>
										<td colspan="2">
											{{$candidate->exp_end_month}} - {{$candidate->exp_end_year}}
										</td>
									
									</tr>
									<tr>
										<td>TOTAL JOB EXPERIENCE</td>
										<td>:</td>
										<td>{{$candidate->exp_total}}</td>
									</tr>
									<tr>
										<td>CURRENT SALARY</td>
										<td>:</td>
										<td>{{$candidate->exp_salary_existing}}</td>
									</tr>
								</table>
								<label for="" class="control-label">VACANCY INFORMATION</label>
								<table class="table table-responsive table-striped">
									<tr>
										<td  width="45%">SOURCE OF JOB VACANCY</td>
										<td  width="5%">:</td>
										<td   width="50%" >{{$candidate->source}}
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
												    	<label class="radio-inline"><input type="radio" disabled required="required" name="assessment{{$no}}"  {{ (!empty($data_asses->answer) && ($data_asses->answer == 'yes'))  ? 'checked':'' }}  onchange="inputAsses(this,'yes','{{$no}}')"  value="YES"> Yes</label>
												    	<input type="hidden" name="asses_quest_id{{$no}}" value="{{$assess->asses_quest_id}}">
														<label class="radio-inline"><input type="radio" disabled required="required" name="assessment{{$no}}" {{ (!empty($data_asses->answer) && ($data_asses->answer == 'no'))  ? 'checked':'' }}  onchange="inputAsses(this,'no','{{$no}}')"  value="NO"> No</label>
														<input type="hidden"  value=" {{(empty($data_asses->answer)) ? '':$data_asses->answer }} " class="form-control" name="hideChoose{{$no}}" id="hideChoose{{$no}}">
														<span class="invalid-feedback" role="alert"></span>
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

