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
	                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> EDIT REQUEST </h3>   
	            </div>
	          </div>
	        </nav>

        <div class="card mt-3">
            <div class="card-body"  style="background-color: #f0f0f0">
                <div class="section">
	                <form id="form-fptk-outsource">
	                <div class="form-row"> 
						<div class="col-md-6">  
							<h5> <strong>NON-EMPLOYEE EMPLOYEMENT FORM </strong> </h5>

<!-- 						      	<div class="form-group mt-1">
								    <label for="exampleInputEmail1">POSITION NAME <span class="span-mandatory">*</span></label>
									<input type="text" name="position_name" class="form-control" value="{{$edit_data->position_name}}">
									<input type="hidden" name="request_job_number" class="form-control" value="{{$edit_data->request_job_number}}">
									<span class="invalid-feedback" role="alert"></span>
								</div> -->

							<!--POSITION NAME -->
                         	<div class="form-group">
	                            <label class="control-label  font-14"> POSITION NAME  <span class="span-mandatory">*</span>  </label>
	                            <select class="form-control" name="position_name" onchange="get_project(this)" >
										<option value="">  - SELECT POSITION NAME -  </option>
										@foreach($position as $pr)
											<option value="{{$pr}}" {{ ($pr == $edit_data->position_name ) ? "selected" : "" }} > {{$pr}} </option>
										@endforeach
									</select>
	                            <i class="invalid-feedback" role="alert"></i>                                 
                          	</div>

	                        <!-- REQUEST REASON -->
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">REQUEST REASON <span class="span-mandatory">*</span></label>
						    	<select class="form-control" name="request_reason" onchange="get_reason(this)">
									<option value="">Select Reason </option>
									<option value="replacement" {{ ($edit_data->request_reason == 'replacement') ? "selected" : "" }}>Replacement</option>
									<option value="beyon man power planning"  {{ ($edit_data->request_reason == 'beyon man power planning') ? "selected" : "" }} >Beyond Man Power Planning</option>
									<option value="not beyon man power planning" {{ ($edit_data->request_reason == 'not beyon man power planning') ? "selected" : "" }}>Not Beyond Man Power Planning</option>
									<option value="other" {{ ($edit_data->request_reason == 'other') ? "selected" : "" }}> Other </option>
								</select>
								<span class="invalid-feedback" role="alert"></span>

			                    <div style="margin-top: 7px;display: none" id="div_request_reason">
			                        <input class="form-control" type="text" name="other_request_reason"  id="other_request_reason" placeholder="Input Other Request Reason">
			                        <i class="invalid-feedback" role="alert"></i>                                 
			                    </div>

	                          	@if($edit_data->request_reason == 'OTHERS')
		                          	<div style="margin-top: 7px;" id="div_request_reason">
			                        	<input class="form-control" type="text" name="other_request_reason"  id="other_request_reason" value="{{$edit_data->other_request_reason}}">
			                        	<i class="invalid-feedback" role="alert"></i>                                 
			                      	</div>
		                      	@endif
						  	</div>

						  	<!-- REPLACED EMPLOYEE NAM -->
						  	<div class="form-group" style="display: none" id="employee_name_replace">
							    <label for="exampleInputEmail1"> REPLACED EMPLOYEE NAME  <span class="span-mandatory">*</span></label>
								<input type="text" name="employee_name_replace"  placeholder=" REPLACED EMPLOYEE NAME" class="form-control">
								<i class="invalid-feedback" role="alert"></i>
							</div>

						  	@if($edit_data->request_reason == 'replacement')
							  	<div class="form-group"  id="employee_name_replace">
								    <label for="exampleInputEmail1"> REPLACED EMPLOYEE NAME  </label>
									<input type="text" name="employee_name_replace"  placeholder=" REPLACED EMPLOYEE NAME" class="form-control" value="{{$edit_data->employee_name_replace}}">
									<i class="invalid-feedback" role="alert"></i>
								</div>
							@endif

						  	<!-- REQUESTED STAFF -->
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">REQUESTED STAFF <span class="span-mandatory">*</span></label>
						    	<select class="form-control" name="requested_staff">
									<option value=""> - SELECT REQUESTED STAFF -  </option>
									<option value="1" {{ ($edit_data->requested_staff == '1') ? "selected" : "" }}>1</option>
									<option value="2" {{ ($edit_data->requested_staff == '2') ? "selected" : "" }}>2</option>
									<option value="3" {{ ($edit_data->requested_staff == '3') ? "selected" : "" }}>3</option>
								</select>
								<span class="invalid-feedback" role="alert"></span>
						  	</div>

							<!-- WORK LOCATION -->
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">WORK LOCATION <span class="span-mandatory">*</span> </label>
						    	<select class="form-control" name="work_location" onchange="get_work_location(this)">
									@foreach($location as $loc)
										<option value="{{$loc->work_location}}" {{ ($loc->work_location == $edit_data->work_location) ? "selected" :""  }}>{{$loc->work_location}}</option>
									@endforeach
								</select>
								<span class="invalid-feedback" role="alert"></span>

			                    <div style="margin-top: 7px;display: none" id="div_other_work_location">
			                        <input class="form-control" type="text" name="other_work_location"  id="other_work_location" placeholder="Input Other Work Location">
			                        <i class="invalid-feedback" role="alert"></i>                                 
			                    </div>

	                          	@if($edit_data->work_location == 'OTHERS')
		                          	<div style="margin-top: 7px;" id="div_other_work_location">
			                        	<input class="form-control" type="text" name="other_work_location"  id="other_work_location" value="{{$edit_data->other_work_location}}">
			                        	<i class="invalid-feedback" role="alert"></i>                                 
			                      	</div>
		                      	@endif
						  	</div>
							
							<!-- PROJECT NAME-->
	                        <div class="form-group">
	                            <label class="control-label  font-14"> PROJECT NAME  <span class="span-mandatory">*</span>  </label>
                            	<select class="form-control" name="project_name" onchange="get_project(this)" >
									<option value="">  - SELECT PROJECT NAME -  </option>
									@foreach($project as $pr)
										<option value="{{$pr}}" {{ ($pr == $edit_data->project_name ) ? "selected" : "" }} > {{$pr}} </option>
									@endforeach
								</select>
	                            <i class="invalid-feedback" role="alert"></i>

			                    <div style="margin-top: 7px;display: none" id="div_other_project">
			                        <input class="form-control" type="text" name="other_project"  id="other_project" placeholder="Input Other Project">
			                        <i class="invalid-feedback" role="alert"></i>                                 
			                    </div>

	                          	@if($edit_data->project_name == 'OTHERS')
		                          	<div style="margin-top: 7px;" id="div_other_project">
			                        	<input class="form-control" type="text" name="other_project"  id="other_project" value="{{$edit_data->other_project}}">
			                        	<i class="invalid-feedback" role="alert"></i>                                 
			                      	</div>
		                      	@endif
	                        </div>

	                        <!-- COST CENTER -->
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">COST CENTER <span class="span-mandatory">*</span></label>
								<select class="form-control" name="cost_center" onchange="get_cost_center(this)">
									<option value=""> - SELECT COST CENTER  -  </option>
									@foreach($cost_center as $cc)
										<option value="{{$cc}}" {{ ($cc == $edit_data->cost_center) ? "selected":"" }} >{{$cc}}</option>
									@endforeach
								</select>
								<span class="invalid-feedback" role="alert"></span>

			                    <div style="margin-top: 7px;display: none" id="div_other_cost_center">
			                        <input class="form-control" type="text" name="other_cost_center"  id="other_cost_center" placeholder="Input Other Cost Center">
			                        <i class="invalid-feedback" role="alert"></i>                                 
			                    </div>

	                          	@if($edit_data->cost_center == 'OTHERS')
		                          	<div style="margin-top: 7px;" id="div_other_cost_center">
			                        	<input class="form-control" type="text" name="other_cost_center"  id="other_cost_center" value="{{$edit_data->other_cost_center}}">
			                        	<i class="invalid-feedback" role="alert"></i>                                 
			                      	</div>
		                      	@endif
						  	</div>
						</div>

						<div class="col-md-6">
						     
						  	<div class="form-group">
						    	<label for="exampleInputPassword1" style="margin-top:36px;">REQUIRED DATE </label>
								<input type="text" name="required_date_fptk" class="form-control" value="{{$edit_data->required_date_fptk}}">
								<span class="invalid-feedback" role="alert"></span>
						  	</div>

						  	<div class="form-group">
							    <label for="exampleInputEmail1">DIVISION</label>
								<select class="form-control" name="division">
									<option value="">  - SELECT DIVISION -  </option>
									@foreach($division as $div)
										<option value="{{$div}}" {{ ($div == $edit_data->division) ? "selected"  : "" }} > {{$div}} </option>
									@endforeach
								</select>
								<i class="invalid-feedback" role="alert"></i>
							</div>

						  	<div class="form-group">
							    <label for="exampleInputEmail1">EMPLOYMENT TYPE</label>
							    <select class="form-control" name="employment_type">
									<option value="">Select Type</option>
									<option value="apprentice" {{ ($edit_data->employment_type == 'apprentice') ? "selected" : "" }} > Apprentice </option>
									<option value="outsourcing" {{ ($edit_data->employment_type == 'outsourcing') ? "selected" : "" }}> Outsourcing </option>
									<option value="magang" {{ ($edit_data->employment_type == 'magang') ? "selected" : "" }}> Magang </option>
									<option value="pkl" {{ ($edit_data->employment_type == 'pkl') ? "selected" : "" }}> PKL </option>
								</select>
								<span class="invalid-feedback" role="alert"></span>
							</div>
							 
						  	<div class="form-group">
							    <label for="exampleInputEmail1">SUBCO</label>
								<select class="form-control" name="subco">
									<option value="">  - SELECT TYPE -  </option>
									<option value="yes" {{ ($edit_data->subco == 'yes') ? "selected" : "" }} > YES </option>
									<option value="no" {{ ($edit_data->subco == 'no') ? "selected" : "" }}> NO </option>
								</select>
								<i class="invalid-feedback" role="alert"></i>
							</div>

						  	<div class="form-group">
							    <label for="exampleInputEmail1">JOB DESCRIPTION <span class="span-mandatory">*</span> </label>
								<textarea name="description" class="form-control" rows="4" cols="5">{{$edit_data->description}}</textarea> 
								<span class="invalid-feedback" role="alert"></span>
							</div>
						</div>
					</div>
                </div>
				<div style="clear:both"></div>
            </div>
        </div>


        <div class="card mt-3">
                <div class="card-body"  style="background-color: #f0f0f0">
                  	<div class="section">
	                  	<form id="form-fptk-outsource">
	                  	<div class="form-row"> <!-- This DIV FORM -->
						    <div class="col-md-6">  <!-- Left Form  --->
								<h5> <strong>CANDIDATE QUALIFICATION</strong> </h5>

								<!-- EDUCATION -->
								<div class="form-group">
								    <label for="exampleInputEmail1">EDUCATION</label>
								    <select class="form-control" name="education">
										@foreach($education as $edu)
											<option value="{{$edu->name}}" {{($edu->name == $edit_data->education) ? "selected" : ""}} >{{$edu->name}}</option>
										@endforeach
									</select>
									<span class="invalid-feedback" role="alert"></span>
								</div>

								<!-- MAJOR -->
							  	<div class="form-group">
							    	<label for="exampleInputPassword1">MAJOR</label>
									<select class="form-control" name="major" onchange="get_major(this)">
										@foreach($major as $mj)
											<option value="{{$mj->name}}" {{(trim($mj->name) == trim($edit_data->major) ) ? "selected" :""}} >{{$mj->name}}</option>
										@endforeach
									</select>
									<span class="invalid-feedback" role="alert"></span>

				                    <div style="margin-top: 7px;display: none" id="div_other_major">
				                        <input class="form-control" type="text" name="other_major"  id="other_major" placeholder="Input Other Major">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                    </div>

		                          	@if((trim($edit_data->major)) == 'Other')
			                          	<div style="margin-top: 7px;" id="div_other_major">
				                        	<input class="form-control" type="text" name="other_major"  id="other_major" value="{{$edit_data->other_major}}">
				                        	<i class="invalid-feedback" role="alert"></i>                                 
				                      	</div>
			                      	@endif
							  	</div>

							  	<!-- WORK Of EXPERIENCE -->
							  	<div class="form-group">
								    <label for="exampleInputEmail1">WORK Of EXPERIENCE </label>
									<input type="text" name="experience_year" class="form-control number_valid_char"  value="{{$edit_data->experience_year}}">
									<span class="invalid-feedback" role="alert"></span>
								</div>
						    </div>
						    <!-- End left form -->


						    <!-- Right form -->
						    <div class="col-md-6">
						    	<h4> </h4>
						    	<br>
						      	<div class="form-group">
								    <label for="exampleInputEmail1">AGE RANGE</label>
									<input type="text" name="age" class="form-control range" value="{{$edit_data->age}}">
									<span class="invalid-feedback" role="alert"></span>
								</div>
							  	<div class="form-group">
							    	<label for="exampleInputPassword1">GENDER </label>
							    	<select class="form-control" name="gender">
										@foreach($gender as $ge)
											<option value="{{$ge->nama}}" {{($edit_data->gender == $ge->nama) ? "selected":""}}>{{$ge->nama}}</option>
										@endforeach
									</select>
									<span class="invalid-feedback" role="alert"></span>
							  	</div>
							  	<div class="form-group">
								    <label for="exampleInputEmail1">SKILLS</label>
								 	<textarea  name="skill" class="form-control">{{$edit_data->skill}}</textarea>
									<input type="hidden" name="job_fptk_id" class="form-control" value="{{$edit_data->job_fptk_id}}">
									<span class="invalid-feedback" role="alert"></span>
								</div>
							 
						    </div>

						</form>
					</div>
                </div>

				<div style="clear:both"></div>
				<div class="card-footer" style="background-color: #f0f0f0">
					<center>
						<button type="button" class="btn btn-primary" onclick="update_outsource_fptk('{{$_GET['status']}}')"> UPDATE </button>
						@if($_GET['status'] == 'draft')
							<button type="button" class="btn btn-success"   onclick="update_outsource_fptk('new')">SEND TO APPROVER</button>
						@endif
						<a href="{{url('create-fptk-outsource')}}" class="btn btn-default">CANCEL</a>
					</center>	
				</div>
						
            </div>
           </form>
        </div>
    </div>
</div>
@endsection


@section('js')
    @include('backend.candidate_outsource.js_candidate_outsource')
    <script type="text/javascript">
 	    function get_reason(a)
	    {
	    	if($(a).val()=='other')
	    	{
	    		$('#div_request_reason').show();
	    	}
	    	else if($(a).val()=='replacement')
	    	{
	    		$('#employee_name_replace').show();
	    	}
	    	else
	    	{
	    		$('#div_request_reason').hide();	
	    		$('#employee_name_replace').hide();
	    		$('[name="other_request_reason"]').val('');	
	    	}
	    }

    	function get_project(b)
	    {
	    	// if($(e).val()=='OTHERS')
	    	// {
	    	// 	$('#div_other_project').show();
	    	// }
	    	// else
	    	// {
	    	// 	$('#div_other_project').hide();	
	    	// }

	    	if($(b).val()=='OTHERS')
	    	{
	    		$('#div_other_project').show();
	    	}
	    	else
	    	{
	    		$('#div_other_project').hide();	
	    		$('[name="other_project"]').val('');	
	    	}
	    }

	    function get_work_location(c)
	    {
	    	if($(c).val()=='OTHERS')
	    	{
	    		$('#div_other_work_location').show();
	    	}
	    	else
	    	{
	    		$('#div_other_work_location').hide();	
	    		$('[name="other_work_location"]').val('');	
	    	}
	    }

	    function get_cost_center(d)
	    {
	    	if($(d).val()=='OTHERS')
	    	{
	    		$('#div_other_cost_center').show();
	    	}
	    	else
	    	{
	    		$('#div_other_cost_center').hide();	
	    		$('[name="other_cost_center"]').val('');	
	    	}
	    }

	    function get_major(e)
	    {
	    	if($(e).val()=='Other')
	    	{
	    		$('#div_other_major').show();
	    	}
	    	else
	    	{
	    		$('#div_other_major').hide();	
	    		$('[name="other_major"]').val('');	
	    	}
	    }
    </script>
@endsection
