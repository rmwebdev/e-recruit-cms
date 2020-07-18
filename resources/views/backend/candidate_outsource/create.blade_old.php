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
	                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> ADD FPTK NON EMPLOYEE </h3>   
	            </div>
	          </div>
	        </nav>
	        
            <div class="card mt-3">
                <div class="card-body" style="background-color: #f0f0f0">
                  	<div class="section">
	                  	<form id="form-fptk-outsource">

						  <div class="form-row"> <!-- This DIV FORM -->
							<div class="col-md-6">  <!-- Left Form  --->
								<h5> <strong>NON-EMPLOYEE EMPLOYEMENT FORM</strong> </h5>
								<div class="form-group">
								    <label for="exampleInputEmail1" style="margin-bottom: 18px;">POSITION NAME <span class="span-mandatory">*</span></label>
									<input type="text" name="position_name" class="form-control">
									<i class="invalid-feedback" role="alert"></i>
								</div>
							  	<div class="form-group">
							    	<label for="exampleInputPassword1">REQUEST REASON <span class="span-mandatory">*</span></label>
							    	<select class="form-control   validate" name="request_reason" onchange="get_reason(this)">
										<option value=""> - SELECT REASON -  </option>
										<option value="replacement">Replacement</option>
										<option value="beyon man power planning">Beyond Man Power Planning</option>
										<option value="not beyon man power planning">Not Beyond Man Power Planning</option>
										<option value="other"> Other </option>
									</select>
									<i class="invalid-feedback" role="alert"></i>
							  	</div>

							  	<div class="form-group" style="display: none" id="employee_name_replace">
								    <label for="exampleInputEmail1"> REPLACED EMPLOYEE NAME  </label>
									<input type="text" name="employee_name_replace"  placeholder=" REPLACED EMPLOYEE NAME" class="form-control">
									<i class="invalid-feedback" role="alert"></i>
								</div>

								<div class="form-group">
								    <label for="exampleInputEmail1">REQUESTED STAFF <span class="span-mandatory">*</span> </label>
									<select class="form-control" name="requested_staff">
										<option value=""> - SELECT REQUESTED STAFF -  </option>
										<option value="1"> 1 </option>
										<option value="2"> 2 </option>
										<option value="3"> 3 </option>
									</select>
									<i class="invalid-feedback" role="alert"></i>
								</div>
							  	<div class="form-group">
							    	<label for="exampleInputPassword1">WORK LOCATION <span class="span-mandatory">*</span> </label>
							    	<select class="form-control  " name="work_location">
							    		<option value=""> - SELECT WORK LOCATION  -  </option>
										@foreach($location as $loc)
											<option value="{{$loc}}">{{$loc}}</option>
										@endforeach
									</select>
									<i class="invalid-feedback" role="alert"></i>
							  	</div>
							  	<div class="form-group">
								    <label for="exampleInputEmail1">PROJECT NAME <span class="span-mandatory">*</span></label>
									<select class="form-control  " name="project_name" id="project_name"  onchange="get_project(this)" >
										<option value=""> - SELECT PROJECT NAME  -  </option>
										@foreach($project as $p)
											<option value="{{$p}}">{{$p}}</option>
										@endforeach
									</select>
									<i class="invalid-feedback" role="alert"></i>
								</div>

			                      <div class="form-group" id="div_other_project" style="display: none">
			                        <label class="control-label  font-14"> PROJECT NAME <span class="span-mandatory">*</span> </label>
			                        <input class="form-control" type="text" name="other_project"  id="other_project">
			                        <i class="invalid-feedback" role="alert"></i>                                 
			                      </div>

							  	<div class="form-group">
							    	<label for="exampleInputPassword1">COST CENTER <span class="span-mandatory">*</span></label>
							    	<select class="form-control  " name="cost_center">
										<option value=""> - SELECT COST CENTER  -  </option>
										@foreach($cost_center as $cc)
											<option value="{{$cc}}">{{$cc}}</option>
										@endforeach
									</select>
									<i class="invalid-feedback" role="alert"></i>
							  	</div>

						    </div>
						    <!-- End left form -->


						    <!-- Right form -->
						    <div class="col-md-6">
						    	<h4> </h4>
						    	<br>
							  	<div class="form-group">
							    	<label for="exampleInputPassword1" style="margin-bottom: 15px">REQUIRED DATE <span class="span-mandatory">*</span> </label>
									<input type="text" name="required_date_fptk" class="form-control datepicker" >
									<i class="invalid-feedback" role="alert"></i>
							  	</div>


							  	<div class="form-group">
								    <label for="exampleInputEmail1" style="margin-bottom: 15px">EMPLOYMENT TYPE <span class="span-mandatory">*</span></label>
									<select class="form-control " name="employment_type">
										<option value="">  - SELECT TYPE -  </option>
										<option value="apprentice"> Apprentice </option>
										<option value="outsourcing"> Outsourcing </option>
										<option value="magang"> Magang </option>
										<option value="pkl"> PKL </option>
										<option value="dialy_worker"> Daily Worker </option>
									</select>
									<i class="invalid-feedback" role="alert"></i>
								</div>


							 	<div class="form-group">
								    <label for="exampleInputEmail1" style="margin-bottom: 18px">DIVISION <span class="span-mandatory">*</span></label>
									<select class="form-control  " name="division">
										<option value="">  - SELECT DIVISION -  </option>
										@foreach($division as $div)
											<option value="{{$div}}"> {{$div}} </option>
										@endforeach
									</select>
									<i class="invalid-feedback" role="alert"></i>
								</div>
							 
							  	<div class="form-group">
								    <label for="exampleInputEmail1">JOB DESCRIPTION <span class="span-mandatory">*</span> </label>
									<textarea name="description" class="form-control" rows="5" cols="5"></textarea> 
									<i class="invalid-feedback" role="alert"></i>
								</div>
						    </div>
					</div>
                </div>

				<div style="clear:both"></div>

            </div>
        </div>




    	<div class="card mt-3">
            <div class="card-body" style="background-color: #f0f0f0">
              	<div class="section">
                  	<form id="form-fptk-outsource">

					  <div class="form-row"> <!-- This DIV FORM -->

					    <div class="col-md-6">  <!-- Left Form  --->
							<h5> <strong>CANDIDATE QUALIFICATION</strong> </h5>
							<div class="form-group">
							    <label for="exampleInputEmail1">EDUCATION <span class="span-mandatory">*</span> </label>
							    <select class="form-control" name="education">
							    	<option value="">   - SELECT EDUCATION  - </option>
									@foreach($education as $edu)
										<option value="{{$edu->name}}">{{$edu->name}}</option>
									@endforeach
								</select>
								<i class="invalid-feedback" role="alert"></i>
							</div>
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">MAJOR <span class="span-mandatory">*</span></label>
								<select class="form-control" name="major">
									<option value=""> - SELECT MAJOR - </option>
									@foreach($major as $mj)
										<option value="{{$mj->name}}">{{$mj->name}}</option>
									@endforeach
								</select>
								<i class="invalid-feedback" role="alert"></i>
						  	</div>
						  	<div class="form-group">
							    <label for="exampleInputEmail1">WORK OF EXPERIENCE </label>
								<input type="text" name="experience_year" class="form-control number_valid_char">
								<i class="invalid-feedback" role="alert"></i>
							</div>
					    </div>
					    <!-- End left form -->


					    <!-- Right form -->
					    <div class="col-md-6">
					    	<h4> </h4>
					    	<br>
					      	<div class="form-group">
							    <label for="exampleInputEmail1">AGE RANGE</label>
								<input type="text" name="age" class="form-control range">
								<i class="invalid-feedback" role="alert"></i>
							</div>
						  	<div class="form-group">
						    	<label for="exampleInputPassword1">GENDER </label>
						    	<select class="form-control" name="gender">
						    		<option value=""> - SELECT GENDER - </option>
									@foreach($gender as $ge)
										<option value="{{$ge->nama}}">{{$ge->nama}}</option>
									@endforeach
								</select>
								<i class="invalid-feedback" role="alert"></i>
						  	</div>
						  	<div class="form-group">
							    <label for="exampleInputEmail1">SKILLS</label>
								<textarea  name="skill" class="form-control"></textarea>
								<i class="invalid-feedback" role="alert"></i>
							</div>
					    </div>
				</div>
            </div>
			<div style="clear:both"></div>
			<div class="card-footer" style="background-color: #f0f0f0">
				<center>
					<button type="button" class="btn btn-primary"  onclick="saveDraft('draft')">SAVE AS DRAFT</button>
					<button type="button" class="btn btn-success"   onclick="saveDraft('new')">SEND TO APPROVER</button>
					<a href="{{url('create-fptk-outsource')}}" class="btn btn-default">CANCEL</a>
				</center>	
			</div>
        </div>
    </div>


    </div>
</div>
@endsection


@section('js')
    @include('backend.candidate_outsource.js_candidate_outsource')
    <script type="text/javascript">
    	
	    function get_project(e)
	    {
	    	if($(e).val()=='OTHERS')
	    	{
	    		$('#div_other_project').show();
	    	}
	    	else
	    	{
	    		$('#div_other_project').hide();	
	    		$('[name="other_project"]').val('');	
	    	}
	    }
    </script>
@endsection
