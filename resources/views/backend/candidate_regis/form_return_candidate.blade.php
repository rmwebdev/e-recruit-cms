@extends('layouts.app')

@section('content')
<style type="text/css">
	.select2-container .select2-selection--single{
		width: 100%;
	}
</style>
<form id="form-fptk-return-employee">


<div class="container mt-1" id="candidate_entry_data"  style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
	                <div class="card-body">
	                  
	                  <h5> <strong>FORM PENGEMBALIAN NON EMPLOYEE</strong> </h5>
	                    <div class="row">

	                    	<div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> EMPLOYEE NAME   </label>
	                            <input type="hidden" name="job_fptk_id" >
	                            <input type="hidden" name="candidate_id" >
	                            <input type="hidden" name="name_holder" >
	                            <select class="form-control select2" name="id_" style="width: 533px" onchange="get_employee(this)">
	                            	<option value="">  - SELECT EMPLOYEE - </option>
		                          	@foreach($employee as $c)
			                        	<option value="{{$c->candidate_id}}"  > {{$c->name_holder}} </option>
			                        @endforeach
								</select>	
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 	

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> REQUEST JOB NUMBER  </label>
	                            <input type="text" name="request_job_number"  class="form-control" readonly>
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	   
    						


	                        <div class="col-sm-6" id="div_company_name" style="display: none">
	                        	<div class="form-group">
		                            <label class="control-label  font-14"> PT OS   </label>
		                            <select class="form-control" name="company_name" readonly>
		                          	@foreach($pt as $p)
			                        		<option value="{{$p}}"  > {{$p}} </option>
			                        @endforeach
									</select>	
		                            <i class="invalid-feedback" role="alert"></i>                                 
	                          	</div>
	                        </div> 	



	                         <div class="col-sm-6"  id="div_edu_university" style="display: none"> 
		                      <div class="form-group">
		                        <label class="control-label  font-14"  style="margin-top: 10px"> UNIV / SCHOOL  </label>
			                        <input type="text" name="edu_university" class="form-control" readonly>
			                        <i class="invalid-feedback" role="alert"></i>
		                      </div>
		                    </div>

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> REQUESTER </label>
	                            <input class="form-control" type="text" name="requester_name"  readonly  id="requester_name" >
	                            
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>   

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> POSITION  </label>
	                            <input class="form-control" type="text" name="position_name" readonly  id="position_name" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 




	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> PROJECT NAME </label>
	                            <input class="form-control" type="text" name="project_name" readonly id="project_name"  >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>	






	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> ENTITI (COST CENTER)  </label>
	                            <input class="form-control" type="text" name="cost_center" readonly id="cost_center"  >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        

		                	<div class="col-sm-6"  id="div_other_project" style="display: none">
		                      	<div class="form-group">
							    	<label for="exampleInputPassword1"> PROJECT NAME </label>
									<input type="text" name="other_project" readonly class="form-control" id="other_project">
									<span class="invalid-feedback" role="alert"></span>
							  	</div>
							</div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> WORKING LOCATION </label>
	                            <input class="form-control" type="text" name="work_location" readonly  id="work_location"  >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> DIVISION  </label>
	                            <input class="form-control" type="text" name="division"  id="division"  readonly >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	              {{--           <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> SALARY </label>
	                            <input class="form-control" type="text" name="salary"  id="salary"  readonly>
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> --}}

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> JOIN DATE </label>
	                            <input class="form-control" type="text" name="join_date"   id="join_date" autocomplete="off" readonly>
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> SUPERVISOR </label>
	                            {{-- <input class="form-control" type="text" name="supervisor"   id="supervisor" readonly> --}}
	                            <select class="form-control select2" name="supervisor" >
	                          		<option value="">  - SELECT SUPERVISOR -   </option>
		                          	@foreach($user as $u)
			                        		<option value="{{$u->name}}"  > {{$u->name}} </option>
			                        @endforeach
								</select>	
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                      {{--   <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> EOC 1 </label>
	                            <input class="form-control" type="text" name="eoc_1"  id="eoc_1"  >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> EOC 2 </label>
	                            <input class="form-control" type="text" name="eoc_2"   id="eoc_2"  >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> --}}

	                    {{--     <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> BENEFIT </label>
	                            <input class="form-control" type="text" name="benefit"  id="benefit"  >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> --}}

	                         <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> END DATE  </label>
	                            <input class="form-control" type="text" name="end_date"   id="end_date"  >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>
	                     

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> PERIODE CONTRACT  </label>
	                            <input class="form-control" type="text" name="contract_periode"   id="contract_periode"  >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

							<div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> REASON DESCRIPTION  </label>
	                            <textarea class="form-control" type="text" name="reason_return"  id="reason_return"  ></textarea>
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                    </div>

	                </div>  <!-- END CARD BODY -->
             
            </div><!-- END CARD -->
        </div>
    </div>
</div>


<div style="clear:both"></div>

<div class="container mt-1" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="bg-white" style="height: 55px;border-radius: 5px;">
            	<center>
	            	<div class="pt-2">
						<button type="button" class="btn btn-primary"  onclick="approved_return_employee()">SEND TO APPROVER</button>
						<a href="{{url('candidate-regis')}}" class="btn btn-default">CANCEL</a>
					</div>
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


    $('#end_date').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });

    $('[name="return_date"]').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });


    $('#join_date').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });

    function get_employee(e)
    {
    	$.ajax({
            url:'{{route('candidate-regis.get_employee')}}',
            type:'GET',
            data:{'candidate_id':$(e).val()},
            success:function(resp){
            	// console.log(resp.data.job_fptk);
            	console.log(resp.data);

            	if(resp.data.job_fptk.employment_type == 'magang')
            	{
            		$('#div_edu_university').show();
            		$('#div_company_name').hide();		
            	}
            	else
            	{
            		$('#div_company_name').show();	
            		$('#div_edu_university').hide();	
            	}
            	$('[name="name_holder"]').val(resp.data.name_holder);
            	$('[name="edu_university"]').val(resp.data.edu_university);
            	// $('[name="edu_university"]').val(resp.data.edu_university).trigger('change');
            	//$('[name="edu_university"]').select2("val",resp.data.edu_university.trim());
            	$('[name="candidate_id"]').val(resp.data.candidate_id);
            	$('[name="project_name"]').val(resp.data.job_fptk.project_name);
            	$('[name="job_fptk_id"]').val(resp.data.job_fptk.job_fptk_id);
            	$('[name="company_name"]').val(resp.data.company_name);
            	$('[name="request_job_number"]').val(resp.data.job_fptk.request_job_number);
            	$('[name="position_name"]').val(resp.data.job_fptk.position_name);
            	$('[name="requester_name"]').val(resp.requester_name);
            	$('[name="cost_center"]').val(resp.data.job_fptk.cost_center);
            	$('[name="work_location"]').val(resp.data.job_fptk.work_location);
            	$('[name="division"]').val(resp.data.job_fptk.division);
            	$('[name="salary"]').val(resp.data.salary);
            	$('[name="join_date"]').val(resp.data.join_date);
            	$('[name="end_date"]').val(resp.data.end_date);
            	$('[name="supervisor"]').val(resp.data.supervisor).trigger('change');
            	//$('[name="supervisor"]').select2("val",resp.data.supervisor.trim())
            	// $('[name="supervisor"]').val(resp.data.supervisor);
            	$('[name="eoc_1"]').val(resp.data.eoc_1);
            	$('[name="eoc_2"]').val(resp.data.eoc_2);
            	$('[name="benefit"]').val(resp.data.benefit);
            	$('[name="contract_periode"]').val(resp.data.contract_periode);
            	if(resp.data.job_fptk.project_name == 'OTHERS')
            	{
            		$('#other_project').val(resp.data.job_fptk.other_project);
            		$('#div_other_project').show();
            	}
            	
            }
        })
    }

    function approved_return_employee()
    {
        var data_candidate= new FormData($('#form-fptk-return-employee')[0]);
		swal({
              title: "Are you sure",
              text: " Return this employee ?",
              icon: "warning",
              buttons: true,
              dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
            		$.ajax({
                        url:'{{route('candidate-regis.approved_return_employee')}}',
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
                                swal('Success','Candidate has been update successfully!','success');
                                $(location).attr('href','/candidate-regis');    
                            }
                            
                        })
                        .fail(function(data) {
                            var dt = data.responseJSON;
							 $.each(dt.errors, function (key, value) {
	                                var input = '[name=' + key + ']';
	                                
	                                $(input + '+i').html('<strong>'+ value +'</strong>');
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
    </script>
@endsection
