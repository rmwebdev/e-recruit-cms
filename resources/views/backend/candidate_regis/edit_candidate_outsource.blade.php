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
	                 <h4 class="color-ungu  pl-3 mt-1 font-18 font-weight-900">  <a href="{{url('candidate-regis')}}"> <i class="fa fa-arrow-left"></i> </a> NON-EMPLOYEE INFO </h4>   
                </div>
              </div>
               <div class="pull-right">
              </div>
            </nav>
        </div> 
    </div>
</div>


<div class="container mt-1" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
	                    <h4 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> CONTRACT HISTORY </h4>   
                </div>
              </div>
               
            </nav>
        </div> 
    </div>
</div>


<div class="container mt-1"  style="max-width: 1203px">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
			      <div class="section">
			          	<div class="row">
			          		<div class="col-md-12">
			          			<table class="table table-stripped">
			          				<tr>
			          					<td>NO</td>
			          					<td>REQUEST NUMBER</td>
			          					<td>POSITION NAME</td>
			          					<td>PROJECT NAME</td>
			          					<td>PT OS</td>
			          					<td> ENTITI</td>
			          					<td>DIVISION</td>
			          					<td>WORK LOCATION</td>
			          					<td>JOIN DATE</td>
			          					<td>END DATE</td>
			          					<td>NOTE</td>
			          					<td>STATUS CONTRACT</td>
			          				</tr>
			          				@php 
			          					$no = 1;
			          				@endphp
			          				@foreach($history as $h)
			          				<tr>
			          					<td>{{$no}}</td>
			          					<td> {{$h->request_job_number}} </td>
			          					<td> {{$h->history_position_name}} </td>
			          					<td> {{$h->project_name}} </td>
			          					<td> {{$h->company_name}} </td>
			          					<td> {{$h->entiti}} </td>
			          					<td> {{$h->division}} </td>
			          					<td> {{$h->work_location}} </td>
			          					<td> {{$h->join_date}} </td>
			          					<td>  {{$h->end_date}} </td>
			          					<td> {{$h->reason}} </td>
			          					<td> {{$h->status_contract}} </td>
			          				</tr>
			          				@php 
			          					$no++;
			          				@endphp
			          				@endforeach
			          			</table>
			          		</div>
			          	</div>

			    	</div>
			 	</div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-1" id="candidate_entry_data"  style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
	                <div class="card-body">
	                  <form id="form-candidate-submission">
	                    <div class="row">

	                    	<div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> STATUS CONTRACT <span class="span-mandatory">*</span></label>
		                        <select name="status_contract" class="form-control mt-2">
		                        	<option value=""> - CHOOSE STATUS CONTRACT - </option>
			                        @for($i = 1;$i<5;$i++)
			                        	<option value="Contract {{$i}}" {{ ($get_data->status_contract == 'Contract '.$i ) ? "selected" : "" }} > Contract {{$i}} </option>
			                        @endfor
		                        </select>
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">

	                            <label class="control-label  font-14 mb-3"> REQUEST JOB NUMBER </label>
	                              <select class="form-control select2" name="request_job_number">
		                        	<option value=""> - Pilih Request Job -  </option>
			                        @foreach($fptk as $fp)
			                        	<option value="{{$fp->request_job_number}}"  {{ ($fp->request_job_number == $get_data->job_fptk->request_job_number) ? "selected" : "" }} > {{$fp->request_job_number}} </option>
			                        @endforeach
		                        </select>
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                        <input type="hidden" name="actual_staff" value="{{$get_data->job_fptk->actual_staff}}">
	                        <input type="hidden" name="candidate_id" value="{{$get_data->candidate_id}}">

							<div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> NPK <span class="span-mandatory">*</span> </label>
	                            <input class="form-control" type="text" name="no_npk"  id="no_npk" value="{{$get_data->no_npk}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                        <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> WORK LOCATION <span class="span-mandatory">*</span> </label>
		                        <select name="work_location" id="work_location" class="form-control">
	                            	<option value=""> - SELECT LOKASI -  </option>
		                        	@foreach($location as $l)
		                        		<option value="{{$l}}" {{ ($l == $get_data->job_fptk->work_location ) ? "selected" : "" }} > {{$l}}</option>
		                        	@endforeach
	                        	</select>
		                        <i class="invalid-feedback" role="alert"></i>                                 
		                      </div>
		                    </div>

    						<div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> EMPLOYEE NAME  <span class="span-mandatory">*</span> </label>
	                       		<input type="hidden" name="job_fptk_id" class="form-control" value="{{$get_data->job_fptk_id}}">
	                            <input class="form-control" type="text" name="name_holder"  id="name_holder" value="{{$get_data->name_holder}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 		


 							<div class="col-sm-6">
							  	<div class="form-group">
								    <label for="exampleInputEmail1"> GENDER   <span class="span-mandatory">*</span> </label>
									<select class="form-control" name="gender">
										<option value="">  - SELECT GENDER -  </option>
										@foreach($gender as $gen)
											<option value="{{$gen->nama}}" {{ ($gen->nama == $get_data->gender ) ? 'selected' : '' }} > {{$gen->nama}}</option>
										@endforeach
									</select>
									<i class="invalid-feedback" role="alert"></i>
								</div>
							</div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> REQUESTER NAME <span class="span-mandatory">*</span> </label>
	                            <input class="form-control" type="text" name="requester_name"  id="requester_name" value="{{$requester_name->name}}" >
	                            <input class="form-control" type="hidden" name="requester_email"   id="requester_email" value="{{$get_data->job_fptk->requester_email}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>   

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> POSITION NAME <span class="span-mandatory">*</span> </label>
	                            <input class="form-control" type="text" name="position_name"  id="position_name" value="{{$get_data->job_fptk->position_name}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 
						   <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> PROJECT NAME  <span class="span-mandatory">*</span>  </label>
	                            <input class="form-control" type="text" name="project_name"  id="project_name" value="{{$get_data->job_fptk->project_name}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>
	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> EMPLOYEE TYPE <span class="span-mandatory">*</span>  </label>
	                            <input class="form-control" type="text" name="employment_type"  id="employment_type" value="{{$get_data->job_fptk->employment_type}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



	                        @if($get_data->job_fptk->project_name == 'OTHERS')
		                       	<div class="col-sm-6">
		                          <div class="form-group" id="div_other_project">
			                        <label class="control-label  font-14"> PROJECT NAME <span class="span-mandatory">*</span> </label>
			                        <input class="form-control" type="text" name="other_project"  id="other_project" value="{{$get_data->job_fptk->other_project}}">
			                        <i class="invalid-feedback" role="alert"></i>                                 
			                      </div>
			                    </div>
		                    @endif
 							<div class="col-sm-6">
							  	<div class="form-group">
								    <label for="exampleInputEmail1"> DIVISION   <span class="span-mandatory">*</span> </label>
									<select class="form-control" name="division">
										<option value="">  - SELECT DIVISION -  </option>
										@foreach($division as $div)
											<option value="{{$div}}" {{ ($div == $get_data->job_fptk->division ) ? "selected" : "" }} > {{$div}} </option>
										@endforeach
									</select>
									<i class="invalid-feedback" role="alert"></i>
								</div>
							</div>


						@if($get_data->job_fptk->employment_type == 'outsourcing')
		                    <div class="col-sm-6">
		                      <div class="form-group">
		                        <label class="control-label  font-14"> PT OS  <span class="span-mandatory">*</span> </label>
		                        <select name="company_name" class="form-control">
		                        	<option value=""> - Pilih PT OS -  </option>
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
	                            <label class="control-label  font-14"> ENTITI (COST CENTER)  <span class="span-mandatory">*</span> </label>
	                            <select name="cost_center" id="cost_center" class="form-control">
	                            	<option value=""> - SELECT COST CENTER -  </option>
		                        	@foreach($cost_center as $cc)
		                        		<option value="{{$cc}}" {{ ($cc == $get_data->job_fptk->cost_center ) ? "selected" : "" }} > {{$cc}}</option>
		                        	@endforeach
	                        	</select>
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>
	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> SALARY  <span class="span-mandatory">*</span> </label>
	                            <input class="form-control number_valid_char" type="text" name="salary"  id="salary" value="{{$get_data->salary}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> DESC BENEFIT  <span class="span-mandatory">*</span> </label>
	                            <input class="form-control number_valid_char" type="text" name="desc_benefit"  id="desc_benefit" value="{{$get_data->job_fptk->desc_benefit}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> BENEFIT  <span class="span-mandatory">*</span> </label>
	                            <input class="form-control number_valid_char" type="text" name="benefit"  id="benefit" value="{{$get_data->job_fptk->benefit}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> DATE OF BIRTH <span class="span-mandatory">*</span></label>
	                            <input class="form-control number_valid_char" type="text" name="date_of_birth"  id="date_of_birth" value="{{$get_data->date_of_birth}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>
	                        

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> JOIN DATE  <span class="span-mandatory">*</span> </label>
	                            <input class="form-control" type="text" name="join_date"  id="join_date" value="{{$get_data->join_date}}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> SUPERVISOR  <span class="span-mandatory">*</span> </label>
{{-- 	                            <input class="form-control" type="text" name="supervisor"  id="supervisor" value="{{$get_data->supervisor}}" >
 --}}	                        <select class="form-control select2" name="supervisor">
 			                        <option value="">  - SELECT SUPERVISOR -   </option>
		                          	@foreach($user as $u)
			                        		<option value="{{$u->name}}" {{ ( $get_data->supervisor == $u->name ) ? "selected"  : "" }} > {{$u->name}} </option>
			                        @endforeach
								</select>	
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> END DATE  <span class="span-mandatory">*</span> </label>
	                            <input class="form-control" type="text" name="end_date"  id="end_date" value="{{ date('Y-m-d',strtotime($get_data->end_date)) }}">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> CONTRACT PERIODE  <span class="span-mandatory">*</span> </label>
	                            <input class="form-control" type="text" name="contract_periode"  id="contract_periode" value="{{$get_data->contract_periode}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>  
	                        @if($get_data->job_fptk->employment_type == 'magang' || $get_data->job_fptk->employment_type == 'pkl')
	                        	  	<div class="col-sm-6"  id="div_address" >
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> ADDRESS  </label>
				                        <textarea class="form-control" type="text" name="address"  id="address">{{$get_data->address}}</textarea>
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>



				                    <div class="col-sm-6"  id="div_account_number" > 
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> ACCOUNT NUMBER  </label>
				                        <input class="form-control number_valid_char" type="text" name="account_number"  id="account_number" value="{{$get_data->account_number}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>

				                    <div class="col-sm-6" id="div_hp">
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO HP  </label>
				                        <input class="form-control number_valid_char" type="text" name="hp_1"  id="hp_1"  value="{{$get_data->hp_1}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>

			                      	<div class="col-sm-6"  id="div_edu_university"> 
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px"> UNIV / SCHOOL <span class="span-mandatory">*</span>  </label>
				                        <select class="form-control select2" name="edu_university">
				                          	@foreach($edu_university as $edu)
					                        		<option value="{{$edu->name}}"  {{ ( trim($edu->name) == trim($get_data->edu_university)  ) ? "selected" : "" }} > {{$edu->name}} </option>
					                        @endforeach
										</select>	
{{-- 											<input class="form-control" type="text" name="edu_university"  id="edu_university"  value="{{$get_data->edu_university}}">
 --}}					                        
 										<i class="invalid-feedback" role="alert"></i>
				                      </div>
									</div>
									
									<div class="col-sm-6" id="div_email">
										<div class="form-group">
										  <label class="control-label  font-14"  style="margin-top: 10px;"> EMAIL  </label>
										  <input class="form-control email_valid_char" type="email" name="email"  id="email"  value="{{$get_data->email}}">
										  <i class="invalid-feedback" role="alert"></i>                                 
										</div>
									  </div>


				                    <div class="col-sm-6"  id="div_ktp" >
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO KTP  </label>
				                        <input class="form-control number_valid_char" type="text" name="ktp_no"  id="ktp_no"  value="{{$get_data->ktp_no}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>
				            @else 
				            		<div class="col-sm-6" id="div_hp">
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO HP  </label>
				                        <input class="form-control number_valid_char" type="text" name="hp_1"  id="hp_1" value="{{$get_data->hp_1}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>


				                    <div class="col-sm-6"  id="div_ktp" >
				                      <div class="form-group">
				                        <label class="control-label  font-14"  style="margin-top: 10px;"> NO KTP  </label>
				                        <input class="form-control number_valid_char" type="text" name="ktp_no"  id="ktp_no" value="{{$get_data->ktp_no}}">
				                        <i class="invalid-feedback" role="alert"></i>                                 
				                      </div>
				                    </div>
	                        @endif	

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
						<button type="button" class="btn btn-primary"  onclick="updateTenagaKerja()">UPDATE</button>
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
    
    // $('#contract_periode').datepicker({
    //     uiLibrary: 'bootstrap4', 
    //     format: 'yyyy-mm-dd',
        
    // });


    $('#join_date').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });
    	function updateTenagaKerja()
	    {
	        var data_candidate= new FormData($('#form-fptk-outsource-submission')[0]);
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
	                        url:'{{route('candidate-regis.update-candidate-outsource')}}',
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
	                                // location.reload(true);    
	                                $(location).attr('href','/candidate-regis');    
	                            }
	                            
	                        })
	                        .fail(function(data) {
	                            var dt = data.responseJSON;
	               
	                            $.each(dt.errors, function (key, value) {
	                                var input = '[name=' + key + ']';
	                                
	                                $(input + '+span').html('<strong>'+ value +'</strong>');
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
