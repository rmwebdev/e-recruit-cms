@extends('layouts.app')

@section('content')
<style type="text/css">
	.select2-container .select2-selection--single{
		width: 100%;
	}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
	          <div class="row">
	            <div class="col-12">
	                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> {{ strtoupper($editData->position_name) }} </h3>   
	            </div>
	          </div>
	           	<a data-toggle="collapse" data-target="#job_regis_position">
                  <img id="image_bottom_form"  style="display: none" src="{{asset('images/icon_drop.png')}}">
                  <img id="image_top_form" src="{{asset('images/icon_top.png')}}">
               	</a> 
	        </nav>

	        <div  id="job_regis_position" class="collapse">
	            <div class="card mt-2  bg-abu-putih">

	                <div class="card-body">
	                  	<div class="section">
	                  		<label for="" class="control-label"> <strong class="font-18">RECRUITMENT REQUEST VIEW</strong> </label>
							  <div class="form-row  mt-3"> <!-- This DIV FORM -->
								<div class="col-md-6">  <!-- Left Form  --->
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>RECRUITMENT TYPE</strong> </label>
										<input type="text" name="" value="{{$editData->recruitment_type}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>DIVISI</strong> </label>
										<input type="text" name="" value="{{$editData->division}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>REQUEST JOB NUMBER </strong> </label>
										<input type="text" name="" value="{{strtoupper($editData->request_job_number)}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>RECRUITMENT TYPE</strong> </label>
										<input type="text" name="" value="{{$editData->recruitment_type}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>REQUIRED DATE </strong> </label>
										<input type="text" name="" value="{{$editData->required_date_fptk}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>STATUS</strong> </label>
										<input type="text" name="" value="{!! strtoupper($editData->status) !!}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>DEPARTMENT</strong> </label>
										<input type="text" name="" value="{!! strtoupper($editData->department) !!}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>MPP PERIOD CODE </strong> </label>
										<input type="text" name="" value="{{$editData->mp_period_code}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>REQUEST REASON</strong> </label>
										<input type="text" name="" value="{{$editData->mp_period_code}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>POSITION NAME</strong> </label>
										<input type="text" name="" value="{{$editData->position_name}}" readonly class="form-control">
									</div>
								
							</div>
							<div class="col-md-6">
									
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>WORK LOCATION</strong> </label>
										<input type="text" name="" value="{{$editData->work_location}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>WORK SYSTEM </strong> </label>
										<input type="text" name="" value="{{strtoupper($editData->work_system)}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>COST CENTER </strong> </label>
										<input type="text" name="" value="{{$editData->recruitment_type}}" readonly class="form-control">
									</div>
									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>REASON HIRNG </strong> </label>
										<input type="text" name="" value="{{$editData->reason_hiring}}" readonly class="form-control">
									</div>

									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>REQUESTED STAFF</strong> </label>
										<input type="text" name="" value="{{$editData->requested_staff}}" readonly class="form-control">
									</div>

									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>GOLONGAN</strong> </label>
										<input type="text" name="" value="{{$editData->golongan}}" readonly class="form-control">
									</div>


									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>EMPLOYMENT TYPE</strong> </label>
										<input type="text" name="" value="{{$editData->employment_type}}" readonly class="form-control">
									</div>

									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>SALARY RANGE </strong> </label>
										<input type="text" name="" value="{{$editData->min_salary}} - {{$editData->max_salary}}" readonly class="form-control">
									</div>

									<div class="form-group">
										<label for="" class="control-label font-14"> <strong>EHRMPOINTOFFICE </strong> </label>
										<input type="text" name="" value="{{$editData->ehrmpointoffice}}" readonly class="form-control">
									</div>

							</div>
						</div>
	                </div>
	            </div>
	        </div>

	        <div class="card mt-2  bg-abu-putih">
	    	   <div class="card-body">
	    	   		<label for="" class="control-label"> <strong class="font-18">JOB TITLE</strong> </label>
	              	<div class="section  mt-3">
	              		<div class="row">
			        		<div class="col-md-6">
								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>EDUCATION</strong> </label>
									<input type="text" name="" value="{{$editData->education}}" readonly class="form-control">
								</div>
								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>FACULTY </strong> </label>
									<input type="text" name="" value="{{strtoupper($editData->faculty)}}" readonly class="form-control">
								</div>
								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>IPK / GPA </strong> </label>
									<input type="text" name="" value="{{$editData->ipk}}" readonly class="form-control">
								</div>
								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>EXPERIENCE YEAR </strong> </label>
									<input type="text" name="" value="{{$editData->experience_year}}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>RANGE AGE</strong> </label>
									<input type="text" name="" value="{!! $editData->min_age!!} - {!! $editData->max_age!!}" readonly class="form-control">
								</div>

							</div>


							<div class="col-md-6">
								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>GENDER</strong> </label>
									<input type="text" name="" value="{{$editData->gender}}" readonly class="form-control">
								</div>


								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>MARITAL STATUS </strong> </label>
									<input type="text" name="" value="{{$editData->marital_status}}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>ADDITIONAL INFORMATION  </strong> </label>
									<input type="text" name="" value="{{$editData->additional_information}}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label for="" class="control-label font-14"> <strong>SKILL </strong> </label>
									<textarea type="text" name="" readonly class="form-control">{{$editData->skill}}</textarea>
								</div>
							</div>
						</div>

					</div>
				</div>
	    	</div>

    	</div>



        


    	<nav class="navbar bg-white mt-2" style="height: 55px;border-radius: 5px;">
          <div class="row">
            <div class="col-12">
                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> JOB SPECIFICATION  </h3>   
            </div>
          </div>
           	<a data-toggle="collapse" data-target="#candidate_entry_data">
              <img id="image_bottom_entry"  style="display: none" src="{{asset('images/icon_drop.png')}}">
              <img id="image_top_entry" src="{{asset('images/icon_top.png')}}">
           	</a> 
        </nav>

        <div class="card mt-2 collapse" id="candidate_entry_data">
        	<div class="card-body">
              <div class="section">
	              	<div class="row">
	              		<div class="col-md-12">
	              			<form  id="form-job">
		              			<div class="form-group">
									<label for="" class="control-label font-14"> <strong>DESCRIPTION</strong> <span class="span-mandatory">* </span>  </label>
									<textarea name="description" id="description" class="form-control textAreaEditor">{{(!empty($editData->description)) ? $editData->description : "" }}</textarea>
									<span class="invalid-feedback" role="alert"></span>
		              			</div>

		              			<div class="form-group">
									<label for="" class="control-label font-14"> <strong>REQUIREMENTS</strong> <span class="span-mandatory">* </span>  </label>
									<input type="hidden" name="job_fptk_id" value="{{$editData->job_fptk_id}}">
									<input type="hidden" name="request_job_number" value="{{$editData->request_job_number}}">
									<textarea name="requirement" id="requirement" class="form-control textAreaEditor">{{(!empty($editData->requirement)) ? $editData->requirement : "" }}</textarea>
									<span class="invalid-feedback" role="alert"></span>
		              			</div>

		              			<div class="form-group">
									<label for="" class="control-label font-14"> <strong>BENEFITS</strong> <span class="span-mandatory">* </span>  </label>
									<textarea name="benefit" id="benefit" class="form-control textAreaEditor">{{(!empty($editData->benefit)) ? $editData->benefit : "" }}</textarea>
									<span class="invalid-feedback" role="alert"></span>
		              			</div>

		              	

		              			<div class="form-group">
									<label for="" class="control-label font-14"> <strong>PUBLISH</strong> <span class="span-mandatory">* </span>  </label>
									<select name="publish" class="form-control" id="publish" required="required">
										<option value=""> === SELECT PUBLISH   === </option>
										@foreach($publish as $pub)
											<option value="{{$pub->nama}}" {{( $pub->nama == $editData->publish) ? "selected" : "" }} >{{$pub->nama}}</option>
										@endforeach
									</select>
									<span class="invalid-feedback" role="alert"></span>
		              			</div>

		              			<div class="form-group">
									<label for="" class="control-label font-14"> <strong>DROP</strong> <span class="span-mandatory">* </span>  </label>
									<select name="drop" class="form-control" id="drop" required="required" onchange="getDrop()">
										<option value=""> === SELECT DROP   === </option>
										<option value="yes" {{( $editData->drop == 'yes') ? "selected" : "" }} >Yes</option>
										<option value="no"  {{( $editData->drop == 'no') ? "selected" : "" }} >No</option>				
									</select>
									<span class="invalid-feedback" role="alert"></span>
		              			</div>

		              			<div class="form-group" id="rowRequest" style="display: {{($editData->drop == 'yes' ? "" : "none")}};">
									<label for="" class="control-label font-14"> <strong>ACTUAL STAFF</strong> <span class="span-mandatory">* </span>  </label>
									<label class="control-label" style="margin-right: 10px;margin-left: 10px"> {{$editData->actual_staff}} </label> 
									<input type="text" name="rejected_staff" value="{{$editData->rejected_staff}}" maxlength="2" placeholder="Input rejected staff" class="form-control  number_valid" style="width: 50%;display: inline;">							
									<span class="invalid-feedback" role="alert"></span>
		              			</div>
	              		</div>
	              	</div>

            	</div>
         	</div>

         	<div class="card-footer" style="background-color: #f0f0f0">
{{--          		@if($editData->is_closed != 'closed')
 --}}					<center>
						<button type="submit" class="btn btn-primary" id="updateJobRegis">UPDATE</button>
						<a href="{{url('job-regis')}}" class="btn btn-warning">CANCEL</a>
					</center>	
{{-- 				@endif
 --}}			</div>
		</form>	

        </div>


    </div>
</div>
@endsection

@section('js')
	<script type="text/javascript">
		var actual_staff = '{{$editData->actual_staff}}';
		// $('[name="division"]').select2();
		


		$('#job_regis_position').on('shown.bs.collapse', function() {
	      $('#image_bottom_form').show();
	      $('#image_top_form').hide();
  		});

	  	$('#job_regis_position').on('hidden.bs.collapse', function() {
	      $('#image_bottom_form').hide();
	      $('#image_top_form').show();
	  	});

		$('#candidate_entry_data').on('shown.bs.collapse', function() {
	      $('#image_bottom_entry').show();
	      $('#image_top_entry').hide();
  		});

	  	$('#candidate_entry_data').on('hidden.bs.collapse', function() {
	      $('#image_bottom_entry').hide();
	      $('#image_top_entry').show();
	  	});

	</script>
    @include('backend.job_regis.js_job_regis')
@endsection

