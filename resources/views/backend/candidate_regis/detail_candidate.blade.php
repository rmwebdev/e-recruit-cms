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
	                  
	                  <h5> <strong>DETAIL NON EMPLOYEE  </strong> </h5>
	                    <div class="row">

	                        <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> STATUS CONTRACT <span class="span-mandatory">*</span></label>
		                       	<input type="text" name="status_contract" value="{{$get_data->status_contract}}" readonly class="form-control">
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> REQUEST JOB NUMBER  </label>
	                            <input type="text" name="request_job_number" value="{{$get_data->job_fptk->request_job_number}}" readonly class="form-control">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

    						<div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> EMPLOYEE NAME   </label>
	                       		<input type="hidden" name="job_fptk_id" class="form-control" value="{{$get_data->job_fptk_id}}" readonly>
	                            <input class="form-control" type="text" name="name_holder" readonly id="name_holder" value="{{$get_data->name_holder}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 	



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> REQUESTER NAME </label>
	                            <input class="form-control" type="text" name="requester_name"  readonly id="requester_name" value="{{$requester_name->name}}" >
	                            <input class="form-control" type="hidden" name="requester_email"   id="requester_email" value="{{$get_data->job_fptk->requester_email}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>   

	                        <input type="hidden" name="actual_staff" value="{{$get_data->job_fptk->actual_staff}}">
	                        <input type="hidden" name="candidate_id" value="{{$get_data->candidate_id}}">
	                        <input type="hidden" name="employment_type" value="{{$get_data->employment_type}}">



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> POSITION NAME </label>
	                            <input class="form-control" type="text" name="position_name" readonly  id="position_name" value="{{$get_data->job_fptk->position_name}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 




	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> PROJECT NAME </label>
	                            <input class="form-control" type="text" name="project_name" readonly id="project_name" value="{{$get_data->job_fptk->project_name}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



    						<div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> EMPLOYEE TYPE   </label>
	                            <input class="form-control" type="text" name="employment_type" readonly id="employment_type" value="{{$get_data->job_fptk->employment_type}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 	
	                        {{-- add by hiero --}}
	                        <div class="col-sm-6">
	                         <div class="form-group">
	                            <label class="control-label  font-14"> GENDER   </label>
	                            <input class="form-control" type="text" name="gender" readonly id="gender" value="{{$get_data->gender}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 	
	                        <div class="col-sm-6">
	                         <div class="form-group">
	                            <label class="control-label  font-14">NPK</label>
	                            <input class="form-control" type="text" name="no_npk" readonly id="no_npk" value="{{$get_data->no_npk}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 





	                        @if($get_data->job_fptk->project_name == 'OTHERS')
		                       	<div class="col-sm-6">
		                          <div class="form-group" id="div_other_project">
			                        <label class="control-label  font-14"> PROJECT NAME <span class="span-mandatory">*</span> </label>
			                        <input class="form-control" type="text" name="other_project"  id="other_project" readonly value="{{$get_data->job_fptk->other_project}}">
			                        <i class="invalid-feedback" role="alert"></i>                                 
			                      </div>
			                    </div>
		                    @endif


	                        @if($get_data->job_fptk->employment_type != 'magang' || 'pkl')
	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> PT OS   </label>
	                            <select class="form-control" name="company_name" readonly>
	                          	@foreach($pt as $p)
		                        		<option value="{{$p}}" {{ ($p == $get_data->company_name ) ? "selected" : "" }}  > {{$p}} </option>
		                        @endforeach
								</select>	
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 
	                        @endif



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> DIVISION  </label>
	                            <input class="form-control" type="text" name="division" readonly id="division"  value="{{$get_data->job_fptk->division}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> ENTITI (COST CENTER)  </label>
	                            <input class="form-control" type="text" name="cost_center" readonly id="cost_center"  value="{{$get_data->job_fptk->cost_center}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> WORKING LOCATION </label>
	                            <input class="form-control" type="text" name="work_location"  readonly id="work_location"  value="{{$get_data->job_fptk->work_location}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> DESC BENEFIT  <span class="span-mandatory">*</span> </label>
	                            <input class="form-control number_valid_char" type="text" name="desc_benefit" readonly  id="desc_benefit" value="{{$get_data->job_fptk->desc_benefit}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> SALARY </label>
	                            <input class="form-control" type="text" name="salary" readonly id="salary" value="{{$salary->salary}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> BENEFIT </label>
	                            <input class="form-control" type="text" name="benefit" readonly id="benefit" value="{{$get_data->job_fptk->benefit}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> JOIN DATE </label>
	                            <input class="form-control" type="text" name="join_date" readonly  id="join_date" value="{{$get_data->join_date}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> DATE OF BIRTH </label>
	                            <input class="form-control" type="text" name="date_of_birth"  readonly id="date_of_birth" value="{{$get_data->date_of_birth}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                         <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> END DATE  </label>
	                            <input class="form-control" type="text" name="end_date" readonly  id="end_date"  value="{{ date('Y-m-d',strtotime($get_data->end_date)) }}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>
	                     
	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> SUPERVISOR </label>
	                            <input class="form-control" type="text" name="supervisor" readonly  id="supervisor" value="{{$get_data->supervisor}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14">  CONTRACT  PERIODE </label>
	                            <input class="form-control" type="text" name="contract_periode" readonly  id="contract_periode" value="{{$get_data->contract_periode}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>




	                        <?php if($get_data->job_fptk->employment_type == 'magang'||$get_data->job_fptk->employment_type == 'pkl') { ?>
	                        	  	<div class="col-sm-6"  id="div_address" >
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> ADDRESS  </label>
				                        <textarea class="form-control" type="text" name="address" readonly  id="address">{{$get_data->address}}</textarea>
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>



				                    <div class="col-sm-6"  id="div_account_number" > 
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> ACCOUNT NUMBER  </label>
				                        <input class="form-control number_valid_char" type="text" name="account_number" readonly  id="account_number" value="{{$get_data->account_number}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>

				                    <div class="col-sm-6" id="div_hp">
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO HP  </label>
				                        <input class="form-control number_valid_char" type="text" name="hp_1"  id="hp_1" readonly  value="{{$get_data->hp_1}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>


				                    <div class="col-sm-6"  id="div_edu_university"> 
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px"> UNIV / SCHOOL <span class="span-mandatory">*</span>  </label>
											<input class="form-control" type="text" name="edu_university" readonly id="edu_university"  value="{{$get_data->edu_university}}">
					                        <i class="invalid-feedback" role="alert"></i>
				                      </div>
				                    </div>

				                    <div class="col-sm-6"  id="div_ktp" >
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO KTP  </label>
				                        <input class="form-control number_valid_char" type="text" name="ktp_no"  id="ktp_no"  readonly value="{{$get_data->ktp_no}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
									</div>
									<div class="col-sm-6"  id="div_email" >
										<div class="form-group">
										  <label class="control-label  font-14"  style="margin-top: 10px;"> EMAIL  </label>
										  <input class="form-control email_valid_char" type="text" name="email"  id="email"  readonly value="{{$get_data->email}}">
										  <i class="invalid-feedback" role="alert"></i>                                 
										</div>
									  </div>
									<?php } else { ?> 
				            		<div class="col-sm-6" id="div_hp">
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO HP  </label>
				                        <input class="form-control number_valid_char" type="text" name="hp_1"  id="hp_1" readonly value="{{$get_data->hp_1}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>


				                    <div class="col-sm-6"  id="div_ktp" >
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO KTP  </label>
				                        <input class="form-control number_valid_char" type="text" name="ktp_no"  id="ktp_no" readonly value="{{$get_data->ktp_no}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>
								<?php } ?>

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
						<a href="{{url('candidate-regis')}}" class="btn btn-default">CLOSE</a>
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


    function update_return_employee()
    {
        var data_candidate= new FormData($('#form-fptk-return-employee')[0]);
		swal({
              title: "Are you sure",
              text: " Update this data ?",
              icon: "warning",
              buttons: true,
              dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
            		$.ajax({
                        url:'{{route('candidate-regis.update_return_employee')}}',
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
