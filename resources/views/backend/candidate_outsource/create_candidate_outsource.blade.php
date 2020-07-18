@extends('layouts.app')

@section('content')
<style type="text/css">
	.select2-container .select2-selection--single{
		width: 100%;
	 }
</style>
<form id="form-fptk-outsource-submission">

<div class="container mt-1" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
	                    <h4 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> NON-EMPLOYEE INPUT FORM</h4>   
                </div>
              </div>

            </nav>
        </div> 
    </div>
</div>

<div class="container mt-1 collapse show" id="candidate_entry_data"  style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

            		<div class="card-body">
	            		<div class="row">
		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14" style="margin-top: 3px;"> REQUEST JOB NUMBER  </label>
		                        <select class="form-control select2" name="request_job_number" required style="width: 553px;" onchange="get_req(this)">
		                        	<option value=""> - Pilih Request Job -  </option>
			                        @foreach($fptk as $fp)
			                        	<option value="{{$fp->request_job_number}}"> {{$fp->request_job_number}} </option>
			                        @endforeach
		                        </select>
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>

		                    <input type="hidden" name="actual_staff" value="">



		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> REQUESTER <span class="span-mandatory">*</span></label>
		                        <input class="form-control" type="text" name="requester_name" readonly id="requester_name" value="" >
		                        <input class="form-control" type="hidden" name="requester_email"   id="requester_email" value="" >
		                        <input class="form-control" type="hidden" name="employment_type"   id="employment_type" value="" >
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>   

		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> POSITION NAME <span class="span-mandatory">*</span></label>
		                        <input class="form-control" type="text" name="position_name"  id="position_name" readonly >
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div> 

		                    <div class="col-sm-6">
		                      	<div class="form-group">
			                        <label class="control-label  font-14"> PROJECT NAME <span class="span-mandatory">*</span></label>
			                        <select name="project_name" id="project_name" class="form-control" onchange="get_project(this)">
		                            	<option value=""> - SELECT PROJECT -  </option>
			                        	@foreach($project as $p)
			                        		<option value="{{$p}}"> {{$p}}</option>
			                        	@endforeach
		                        	</select>
			                        <i class="invalid-feedback" role="alert"></i>                            
		                      	</div>

		                    	<div style="margin-top: 7px;display: none" id="div_other_project">
		                        	<input class="form-control" type="text" name="other_project"  id="other_project" placeholder="Input Other Project">
		                        	<i class="invalid-feedback" role="alert"></i>                                 
		                    	</div>
		                    </div>
							<div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> NPK</label>
		                        <input class="form-control" type="text" name="no_npk"  id="no_npk" value="">
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                  </div>
		                  <div class="col-sm-6">
			                    <div class="form-group">
			                        <label class="control-label  font-14"> WORK LOCATION <span class="span-mandatory">*</span> </label>
			                        <select name="work_location" id="work_location" class="form-control" onchange="get_work_location(this)">
		                            	<option value=""> - SELECT LOKASI -  </option>
			                        	@foreach($location as $l)
			                        		<option value="{{$l}}"> {{$l}}</option>
			                        	@endforeach
		                        	</select>
			                        <i class="invalid-feedback" role="alert"></i> 

								  	<div style="margin-top: 7px;display: none" id="div_other_work_location">
				                        <input class="form-control" type="text" name="other_work_location"  id="other_work_location" placeholder="Input Other Work Location">
				                        <i class="invalid-feedback" role="alert"></i>    
				                    </div>                                  
			                    </div>
		                    </div>


							<div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> EMPLOYEE NAME <span class="span-mandatory">*</span> </label>
		                        <input class="form-control" type="text" name="name_holder"  id="name_holder" value="" >
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
							</div> 	
							{{-- add by HIERO--}}
							<div class="col-sm-6" id="">
								<div class="form-group">
								  <label for="exampleInputEmail1">GENDER <span class="span-mandatory">*</span> </label>

								  </select><select class="form-control" id="gender" name="gender" required="required" >
									<option value=""> - SELECT GENDER - </option>								
									@foreach($gender as $gen)
									  <option value="{{$gen->nama}}">{{$gen->nama}}  </option>
									@endforeach			
								  </select>	
								  <i class="invalid-feedback" role="alert"></i>
							  </div>
						  </div>
	                    	<div class="col-sm-6">
							  	<div class="form-group">
								    <label for="exampleInputEmail1">DIVISION <span class="span-mandatory">*</span> </label>
									<select class="form-control" name="division" id="division">
										<option value="">  - SELECT DIVISION -  </option>
										@foreach($division as $div)
											<option value="{{$div}}"> {{$div}} </option>
										@endforeach
									</select>
									<i class="invalid-feedback" role="alert"></i>
								</div>
							</div>
		               

		                    <div class="col-sm-6" id="div_pt_os" style="display: none">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> PT OS <span class="span-mandatory">*</span> </label>
		                        <select name="company_name" class="form-control" id="company_name" onchange="get_ptos(this)">
		                        	<option value=""> - Pilih PT OS -  </option>
		                        	@foreach($pt as $p)
		                        		<option value="{{$p}}" > {{$p}} </option>
		                        	@endforeach
		                        </select>
		                        <i class="invalid-feedback" role="alert"></i> 

	                            <div style="margin-top: 7px;display: none" id="div_other_ptos">
	                                  <input class="form-control" type="text" name="other_ptos"  id="other_ptos" placeholder="Input Other PT OS">
	                                  <i class="invalid-feedback" role="alert"></i>                                 
	                            </div>

		                      </div>
		                    </div>


		                    <div class="col-sm-6"  id="div_edu_university" style="display: none"> 
		                      <div class="form-group">
		                        <label class="control-label  font-14"  style="margin-top: 10px"> UNIV / SCHOOL <span class="span-mandatory">*</span>  </label>
			                        <select class="form-control select2" id="edu_university" style="width: 553px;" name="edu_university" required>
			                          <option value=""> - CHOOSE SCHOOL - </option>
			                          @foreach($education as $ed)
			                            <option value="{{$ed->name}}">{{$ed->name}}  </option>
			                          @endforeach
			                        </select>
			                        <i class="invalid-feedback" role="alert"></i>
		                      </div>
		                    </div>

		                    <div class="col-sm-6">
		                      	<div class="form-group">
			                        <label class="control-label  font-14"> ENTITI (COST CENTER) <span class="span-mandatory">*</span> </label>
		                        	<select name="cost_center" id="cost_center" class="form-control" onchange="get_cost_center(this)">
		                        		<option value=""> - SELECT COST CENTER -  </option>
			                        	@foreach($cost_center as $cc)
			                        		<option value="{{$cc}}" > {{$cc}}</option>
			                        	@endforeach
		                        	</select>
			                        <i class="invalid-feedback" role="alert"></i>  

				                    <div style="margin-top: 7px;display: none" id="div_other_cost_center">
				                        <input class="form-control" type="text" name="other_cost_center"  id="other_cost_center" placeholder="Input Other Cost Center">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                    </div>                               
		                      	</div>
		                    </div>


		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> SALARY <span class="span-mandatory">*</span></label>
		                        <input class="form-control number_valid_char" type="text" name="salary"  id="salary" value="">
		                        <i class="invalid-feedback" role="alert"></i>  
		                        {!! $errors->first('salary', '<i class="invalid-feedback" role="alert">:message</i>  ') !!}                               
		                      </div>
		                    </div>

		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> DESC BENEFIT <span class="span-mandatory">*</span></label>
		                        <input class="form-control" type="text" name="desc_benefit"  id="desc_benefit" value="">
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>


		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> BENEFIT <span class="span-mandatory">*</span></label>
		                        <input class="form-control number_valid_char" type="text" name="benefit"  id="benefit" value="">
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>



		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> DATE OF BIRTH <span class="span-mandatory">*</span></label>
		                        <input class="form-control number_valid_char" type="text" name="date_of_birth"  id="date_of_birth" value="">
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>

		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> JOIN DATE <span class="span-mandatory">*</span></label>
		                        <input class="form-control" type="text" name="join_date"  id="join_date" value="" autocomplete="off">
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>


		                    
							
							<div class="col-sm-6">
								<div class="form-group">
								  <label class="control-label  font-14"  style="margin-top: 10px;"> CONTRACT PERIODE <span class="span-mandatory">*</span>  </label>
								  <input class="form-control number_valid_char" type="text" name="contract_periode"  id="contract_periode">
								  <i class="invalid-feedback" role="alert"></i>                                 
								</div>
							  </div>
						

		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> END DATE  <span class="span-mandatory">*</span></label>
							  <input class="form-control" type="text" name="end_date"  id="end_date"   autocomplete="off" >
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>
							
							<div class="col-sm-6">
								<div class="form-group">
								  <label class="control-label font-14"> SUPERVISOR <span class="span-mandatory">*</span></label>
								   <select class="form-control select2" name="supervisor" id="supervisor" required>
									   <option value="">  - SELECT SUPERVISOR -   </option>
										@foreach($user as $u)
											  <option value="{{$u->name}}"  > {{$u->name}} </option>
									  @endforeach
								  </select>
								  <i class="invalid-feedback" role="alert"></i>
								  <small style="color: red;display: none;" id="error_validate_supervisor">Supervisor Is Required</small>                                 
								</div>
							  </div>
		                   

		                    <div class="col-sm-6" id="div_hp" style="display: none">
		                      <div class="form-group">
		                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO HP  <span class="span-mandatory">*</span> </label>
		                        <input class="form-control number_valid_char" type="text" name="hp_1"  id="hp_1" required>
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>


							<div class="col-sm-6"  id="div_account_number"  style="display: none"> 
		                      <div class="form-group">
		                        <label class="control-label  font-14"  style="margin-top: 10px;"> ACCOUNT NUMBER <span class="span-mandatory">*</span> </label>
		                        <input class="form-control number_valid_char" type="text" name="account_number"  id="account_number">
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>


		           

		                    <div class="col-sm-6"  id="div_ktp">
		                      <div class="form-group">
		                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO KTP  <span class="span-mandatory">*</span>  </label>
		                        <input class="form-control number_valid_char" type="text" name="ktp_no"  id="ktp_no" required>
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>



		                    <div class="col-sm-6"  id="div_address"  style="display: none">
		                      <div class="form-group">
		                        <label class="control-label  font-14"  style="margin-top: 10px;"> ADDRESS  <span class="span-mandatory">*</span> </label>
		                        <textarea class="form-control" type="text" name="address"  id="address" required placeholder="jalan, no rumah, RT/RW, kelurahan"></textarea>
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>

		                    <div class="col-sm-6"  id="div_email"  style="display: none">
		                      <div class="form-group">
		                        <label class="control-label  font-14"  style="margin-top: 10px;"> EMAIL  <span class="span-mandatory">*</span> </label>
		                        <input class="form-control" type="email" name="email"  id="email" required></input>
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>

		                </div>
		             </div>
		        
             
            </div><!-- END CARD -->
        </div>
    </div>
</div>


<div class="container mt-1" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="bg-white pt-2" style="height: 55px;border-radius: 5px;">
            	<center>
						<button type="button" class="btn btn-primary"  onclick="saveTenagaKerja()">SAVE</button>
						<a href="{{url('candidate-regis')}}" class="btn btn-default">CANCEL</a>
				</center>
            </nav>
        </div> 
    </div>
</div>
</form>

@endsection


@section('js')
    @include('backend.candidate_outsource.js_candidate_outsource')
    <script type="text/javascript">

    	function saveTenagaKerja()
	    {
	    	var spv = $('#supervisor').val();
	    	if( spv == ''){
	    		document.getElementById('error_validate_supervisor').style.display='';
	    		// document.getElementById("myDIV").style.display = "none";
	    	} else {
	    	$("#supervisor").select2().prop('required', true);
	        var data_candidate= new FormData($('#form-fptk-outsource-submission')[0]);
			swal({
	              title: "Are you sure",
	              text: " Save this data ?",
	              icon: "warning",
	              buttons: true,
	              dangerMode: false,
	            })
	            .then((willDelete) => {
	                if (willDelete) {
	            		$.ajax({
	                        url:'{{route('save-fptk-outsource-submission')}}',
	                        type:'POST',
	                        data:data_candidate,
	                        dataType: "json",
	                        headers: {
	                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
	                        },
	                          cache:false,
	                          contentType:false,
	                          processData:false,
	                    }) .done(function(data) {
	                            if(data.status == 'success')
	                            {
	                                swal('Success','','success');
	                                $(location).attr('href','/candidate-regis');    
	                            }
	                            
	                        })
	                        .fail(function(data) {
	                            var dt = data.responseJSON;

	                            if(dt.status == 'errors')
	                            {
	                            	// $('#form-fptk-outsource-submission')[0].reset();
	                           		return swal('Error',dt.candidate_error,'error');
	                            }

								$.each(dt.errors, function (key, value) {
				                    var input = '[name=' + key + ']';
				                    
				                    $(input + '+ii').html('<strong>'+ value +'</strong>');
				                    $(input).addClass('is-invalid');
				                    $(input).focus();
				                    $(input).change(function(){
				                        $(input).removeClass('is-invalid');
				                    })
				                });
	                    });
	                }
	        });
	        }
	    }
	    function get_req(e)
	    {
	    	$.ajax({
                url:'{{url('get-req')}}',
                type:'GET',
                data:{request_job_number:$(e).val()},
                dataType: "json",
                success:function(res){
                		if(res.data.employment_type == 'magang' || res.data.employment_type == 'pkl')
                		{
                			$('#div_address').show();
                			$('#div_ktp').show();
                			$('#div_hp').show();
                			$('#div_email').show();
                			$('#div_account_number').show();
                			$('#div_edu_university').show();
                			$('#div_pt_os').hide();
                		}
                		else
                		{
                			$('#div_pt_os').show();
                			$('#div_ktp').show();
                			$('#div_hp').show();
                			$('#div_email').hide();
                			$('#div_edu_university').hide();
                			$('#div_address').hide();
                		}
                		$('#position_name').val(res.data.position_name);
	                	$('#project_name').val(res.data.project_name);
	                	$('#work_location').val(res.data.work_location);
	                	$('#cost_center').val(res.data.cost_center);
	                	$('#requester_name').val(res.data.user.name);
	                	$('#requester_email').val(res.data.user.email);
	                	$('#employment_type').val(res.data.employment_type);
	                	$('#division').val(res.data.division);

	                	if(res.data.project_name == 'OTHERS')
	                	{
	                		$('#other_project').val(res.data.other_project);
	                		$('#div_other_project').show();
	                	}
	                	
                	}	
            })
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

	    function get_ptos(f)
	    {
	    	if($(f).val()=='OTHERS')
	    	{
	    		$('#div_other_ptos').show();
	    	}
	    	else
	    	{
	    		$('#div_other_ptos').hide();	
	    		$('[name="other_ptos"]').val('');
	    	}
	    }
	</script>
	
{{-- 	
//
    $startDate = '2017-05-09';
    $months = 3;
    $monthStr = $months == 1 ? 'month' : 'months';
    
    echo date('Y-m-d', strtotime('+ '.$months. ' '.$monthStr, strtotime($startDate ))); --}}
@endsection

