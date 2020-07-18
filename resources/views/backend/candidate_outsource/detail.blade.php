@extends('layouts.app')

@section('content')
<style type="text/css">
	.select2-container .select2-selection--single{
		width: 100%;
	}
</style>
<div class="container" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">

    		<nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
	          <div class="row">
	            <div class="col-12">
	                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> DETAIL REQUEST </h3>   
	            </div>
	          </div>
	        </nav>

            <div class="card mt-3">
                <div class="card-body"  style="background-color: #f0f0f0">
                  	<div class="section">
	                  	<form>

	                  	<div class="form-row"> <!-- This DIV FORM -->
							<div class="col-md-6">  <!-- Left Form  --->
								<h5> <strong>NON-EMPLOYEE EMPLOYEMENT FORM </strong> </h5>
								<div class="form-group">
								    <label for="exampleInputEmail1">REQUEST JOB NUMBER</label>
									<input type="text" name="request_job_number" class="form-control" readonly value="{{$edit_data->request_job_number}}">
									<span class="invalid-feedback" role="alert"></span>
								</div>

								<div class="form-group">
								    <label for="exampleInputEmail1">POSITION NAME</label>
									<input type="text" name="position_name" class="form-control" readonly value="{{$edit_data->position_name}}">
									<span class="invalid-feedback" role="alert"></span>
								</div>

							  	<div class="form-group">
							    	<label for="exampleInputPassword1">REQUEST REASON</label>
									<input type="text" name="position_name" class="form-control" readonly value="{{$edit_data->request_reason}}">
									<span class="invalid-feedback" role="alert"></span>
							  	
		                          	@if($edit_data->request_reason == 'OTHERS')
			                          	<div style="margin-top: 7px;" id="div_request_reason">
				                        	<input class="form-control" type="text" name="other_request_reason"  id="other_request_reason" value="{{$edit_data->other_request_reason}}">
				                        	<i class="invalid-feedback" role="alert"></i>                                 
				                      	</div>
			                      	@endif

								  	@if($edit_data->request_reason == 'replacement')
									  	<div style="margin-top: 7px;"  id="employee_name_replace">
										    <label for="exampleInputEmail1"> REPLACED EMPLOYEE NAME  </label>
											<input type="text" name="employee_name_replace"  placeholder=" REPLACED EMPLOYEE NAME" readonly class="form-control" value="{{$edit_data->employee_name_replace}}">
											<i class="invalid-feedback" role="alert"></i>
										</div>
									@endif
								</div>

							  	<div class="form-group">
								    <label for="exampleInputEmail1">REQUESTED STAFF</label>
									<input type="text" name="requested_staff" readonly class="form-control number_valid_char" value="{{$edit_data->requested_staff}}">
									<span class="invalid-feedback" role="alert"></span>
								</div>

							  	<div class="form-group">
							    	<label for="exampleInputPassword1">WORK LOCATION</label>
									<input type="text" name="work_location" class="form-control" readonly  value="{{$edit_data->work_location}}">
									<span class="invalid-feedback" role="alert"></span>

		                          	@if($edit_data->work_location == 'OTHERS')
			                          	<div style="margin-top: 7px;" id="div_other_work_location">
				                        	<input class="form-control" type="text" name="other_work_location"  id="other_work_location" value="{{$edit_data->other_work_location}}" readonly>
				                        	<i class="invalid-feedback" role="alert"></i>                                 
				                      	</div>
			                      	@endif
		                      	</div>

							  	<div class="form-group">
								    <label for="exampleInputEmail1">PROJECT NAME</label>
									<input type="text" name="project_name"  class="form-control" readonly  value="{{$edit_data->project_name}}">
									<span class="invalid-feedback" role="alert"></span>

									@if($edit_data->project_name == 'OTHERS')
			                          <div style="margin-top: 7px;" id="div_other_project">
				                        <input class="form-control" type="text" name="other_project"  id="other_project" readonly value="{{$edit_data->other_project}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    @endif
				                </div>
						
						    </div>

						    <div class="col-md-6">
						    	<h5> </h5>
						    	<br>
								<div class="form-group">
								    <label for="exampleInputEmail1">DIVISION</label>
									<input type="text" name="division"  class="form-control" readonly value="{{$edit_data->division}}">
									<span class="invalid-feedback" role="alert"></span>
								</div>

							  	<div class="form-group">
							    	<label for="exampleInputPassword1">REQUIRED DATE </label>
									<input type="text" name="required_date_fptk" class="form-control" readonly value="{{$edit_data->required_date_fptk}}">
									<span class="invalid-feedback" role="alert"></span>
							  	</div>

							  	<div class="form-group">
								    <label for="exampleInputEmail1">EMPLOYMENT TYPE</label>
									<input type="text" name="employment_type" class="form-control" readonly  value="{{$edit_data->employment_type}}">
									<span class="invalid-feedback" role="alert"></span>
								</div>

								<div class="form-group">
							    	<label for="exampleInputPassword1">COST CENTER</label>
									<input type="text" name="cost_center" class="form-control" readonly value="{{$edit_data->cost_center}}">
									<span class="invalid-feedback" role="alert"></span>

		                          	@if($edit_data->cost_center == 'OTHERS')
			                          	<div style="margin-top: 7px;" id="div_other_cost_center">
				                        	<input class="form-control" type="text" name="other_cost_center"  id="other_cost_center" value="{{$edit_data->other_cost_center}}" readonly>
				                        	<i class="invalid-feedback" role="alert"></i>                                 
				                      	</div>
			                      	@endif
							  	</div>

							  	<div class="form-group">
								    <label for="exampleInputEmail1">JOB DESCRIPTION</label>
									<textarea name="description" class="form-control" readonly rows="5" cols="5">{{ strip_tags($edit_data->description)}}</textarea> 
									<span class="invalid-feedback" role="alert"></span>
								</div>
						    </div>

						</form>
					</div>
                </div>
				<div style="clear:both"></div>						
            </div>
        </div> 

        <div class="card mt-3">
            <div class="card-body"  style="background-color: #f0f0f0">
              	<div class="section">
                  	<form>

                  	<div class="form-row"> <!-- This DIV FORM -->
						<div class="col-md-6">  <!-- Left Form  --->
							<h5> <strong>CANDIDATE QUALIFICATION</strong> </h5>
							<div class="form-group">
							    <label for="exampleInputEmail1">EDUCATION</label>
							    <select class="form-control" disabled name="education_detail">
									@foreach($education as $edu)
										<option value="{{$edu->name}}" {{($edu->name == $edit_data->education) ? "selected" : ""}} >{{$edu->name}}</option>
									@endforeach
								</select>
								<span class="invalid-feedback" role="alert"></span>
							</div>

						  	<div class="form-group">
						    	<label for="exampleInputPassword1">MAJOR</label>
								<select class="form-control" disabled name="major_detail">
									@foreach($major as $mj)
										<option value="{{$mj->name}}" {{( trim($mj->name) == trim($edit_data->major) ) ? "selected" :""}} >{{$mj->name}}</option>
									@endforeach
								</select>
								<span class="invalid-feedback" role="alert"></span>

	                          	@if((trim($edit_data->major)) == 'Other')
		                          	<div style="margin-top: 7px;" id="div_other_major">
			                        	<input class="form-control" type="text" name="other_major"  id="other_major" value="{{$edit_data->other_major}}">
			                        	<i class="invalid-feedback" role="alert"></i>                                 
			                      	</div>
		                      	@endif
						  	</div>

						  	<div class="form-group">
							    <label for="exampleInputEmail1">WORK Of EXPERIENCE </label>
								<input type="text" name="experience_year" disabled class="form-control number_valid_char"  value="{{$edit_data->experience_year}}">
								<span class="invalid-feedback" role="alert"></span>
							</div>
					    </div>

					    <div class="col-md-6">
					    	<h4> </h4>
					    	<br>
					      	<div class="form-group">
							    <label for="exampleInputEmail1">AGE RANGE</label>
								<input type="text" name="age" class="form-control range" readonly value="{{$edit_data->age}}">
								<span class="invalid-feedback" role="alert"></span>
							</div>
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">GENDER </label>
						    	<select class="form-control" disabled name="gender_detail">
									@foreach($gender as $ge)
										<option value="{{$ge->nama}}" {{($edit_data->gender == $ge->nama) ? "selected":""}}>{{$ge->nama}}</option>
									@endforeach
								</select>
								<span class="invalid-feedback" role="alert"></span>
						  	</div>
						  	<div class="form-group">
							    <label for="exampleInputEmail1">SKILLS</label>
								<input type="text" name="skill" class="form-control" readonly value="{{$edit_data->skill}}">
								<span class="invalid-feedback" role="alert"></span>
							</div>
					    </div>
					</form>
				</div>
            </div>

        </div>
    </div>


	<nav class="navbar bg-white mt-3" style="height: 55px;border-radius: 5px;">
      <div class="row">
        <div class="col-12">
            <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> STEP OF APPROVAL </h3>   
        </div>
      </div>
    </nav>
    <div class="card mt-3">
        <div class="card-body bg-white">
          	<div class="section">
              	<form id="form-fptk-outsource">
              	<input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
 				<input type="hidden" name="job_fptk_id" value="{{$edit_data->job_fptk_id}}">
              	<div class="form-row mt-4"> <!-- This DIV FORM -->
					
 						<table class="table table-stripped">
 							<tr>
 								<th width="20%">Manager Designated Supervisor</th>
 								<th  width="20%">Status</th>
 								<th> Date</th>
 								<th>Notes</th>
 				
 						@if(!empty($get_head))
 							@foreach($get_head as $head)
 							<tr>
 								<td>  {!!$head->position!!} </td>
 								<td>
 									@php 
 										$approval_head = \App\Models\TrApproval::with('user','fptk')->where('user_id',$head->user_id)->where('job_fptk_id',$_GET['id'])->first();
 									@endphp
 									@if($head->username == $get_emp->parent_user || $get_emp->parent_user == Auth::user()->username)
 									 	<input type="hidden" name="approval_id[]" value="{!!(!empty($approval_head->user_id)) ? $approval_head->approval_id : '' !!}">
 										<input type="hidden" name="user_id[]" value="{!!$head->user_id!!}">
 										@if(!empty($approval_head->user_id)) 
 											@if($approval_head->user_id == Auth::user()->user_id)
 												<select class="form-control" name="approval_status">
 													<option value=""> New </option>
			 										
			 										<option value="approved" {!! ($approval_head->approval_status == 'approved') ? "selected"  :"" !!}> Approved </option>
			 										<option value="rejected" {!! ($approval_head->approval_status == 'rejected') ? "selected"  :"" !!}> Rejected </option>
		 										</select>	
		 									@else
		 										<div class="mt-2">
		 											{!! '<span class="alert alert-success">'.ucfirst($approval_head->approval_status).'</span>' !!}
		 										</div>
	 										@endif
 										@else
	 										@if(!empty($approval_head->user_id)) 
		 										<div class="mt-2">
		 											{!! '<span class="alert alert-success">'.ucfirst($approval_hr->approval_status).'</span>' !!}
		 										</div>
											@else
											 	@if($head->user_id == Auth::user()->user_id)
											 		<select class="form-control" name="approval_status">
				 										<option value=""> New </option>
				 										<option value="approved"> Approved </option>
				 										<option value="rejected"> Rejected </option>
				 									</select>
											 	@else	
				 									New
											 	@endif
											@endif
 										@endif
 									@else
 											New
 									@endif
 								</td>
 								<td>
 									{!!(!empty($approval_head->user_id)) ? $approval_head->approval_date : 'N / A' !!}
 								</td>
 								<td>				    		
 									<textarea cols="5" rows="5" class="form-control"
 									@if($head->username == $get_emp->username || $get_emp->parent_user == Auth::user()->username)
 									 	name="approval_desc" 
 									@else
 										disabled 
 									@endif
 									>{!!(!empty($approval_head->user_id)) ? $approval_head->approval_desc : '' !!}</textarea>
								</td>
 							</tr>
 							@endforeach
							@endif

 						@if(!empty($get_hr))
 							@foreach($get_hr as $hr)
 							<tr>
 								<td>  {!!$hr->position!!} </td>
 								<td> 
 									@php
 										$approval_hr = \App\Models\TrApproval::with('user','fptk')->where('user_id',$hr->user_id)->where('job_fptk_id',$_GET['id'])->first();
 									@endphp					
 									@if(Auth::user()->username == $hr->username)

	 									<input type="hidden" name="user_id[]" value="{!!$hr->user_id!!}">
	 									<input type="hidden" name="approval_id[]" value="{!!(!empty($approval_hr->user_id)) ? $approval_hr->approval_id : '' !!}">
										@if(!empty($approval_hr->user_id)) 
											@if($approval_hr->user_id == Auth::user()->user_id)
												<select class="form-control" name="approval_status">
													<option value=""> New </option>
			 										<option value="approved" {!! ($approval_hr->approval_status == 'approved') ? "selected"  :"" !!}> Approved </option>
			 										<option value="rejected" {!! ($approval_hr->approval_status == 'rejected') ? "selected"  :"" !!}> Rejected </option>
	 											</select>	
	 										@else
		 										<div class="mt-2">
		 											{!! '<span class="alert alert-success">'.ucfirst($approval_hr->approval_status).'</span>' !!}
		 										</div>
											@endif
										@else
		 									<select class="form-control" name="approval_status">
		 										<option value=""> New </option>
		 										<option value="approved"> Approved </option>
		 										<option value="rejected"> Rejected </option>
		 									</select>
										@endif
 									@else
 										@if(!empty($approval_hr->user_id)) 
	 										<div class="mt-2">
	 											{!! '<span class="alert alert-success">'.ucfirst($approval_hr->approval_status).'</span>' !!}
	 										</div>
										@else
		 									New
										@endif
 									@endif  
 								</td>
 								<td>
 									 {!!(!empty($approval_hr->user_id)) ? $approval_hr->approval_date : 'N / A' !!}
 								</td>
 								<td>				    		
 									<textarea cols="5" rows="5" class="form-control"
 									@if(Auth::user()->username == $hr->username)
 										name="approval_desc" 
 									@else
 										disabled 
 									@endif
 									>{!!(!empty($approval_hr->user_id)) ? $approval_hr->approval_desc :''!!}</textarea>
								</td>
 							</tr>
 							@endforeach
 						@endif
 						
 						</table>

				</form>
			</div>
        </div>

		<div style="clear:both"></div>
		<div class="card-footer bg-white">
			<center>
				@if($get_job->status == 'open' || $get_job->status == 'rejected' || $get_job->status == 'draft')
				@else
						<button type="button" class="btn bg-ungu color-white" onclick="updateFptk()"> UPDATE </button>
				@endif
				<a href="{{url('create-fptk-outsource')}}" class="btn btn-default">CANCEL</a>
			</center>	
		</div>	
    </div>

    </div>
</div>
@endsection


@section('js')
    @include('backend.candidate_outsource.js_candidate_outsource');
@endsection
