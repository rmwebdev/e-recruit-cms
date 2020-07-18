@extends('layouts.app')

@section('content')
<style type="text/css">
	.select2-container .select2-selection--single{
		width: 100%;
	}
</style>


<div class="container mt-1" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
	                 <h4 class="color-ungu  pl-3 mt-1 font-18 font-weight-900">  <a href="{{url('candidate-regis')}}"> <i class="fa fa-arrow-left"></i> </a> FORM APPROVAL PENGEMBALIAN  </h4>   
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


<form id="form-fptk-return-employee">

<div class="container mt-1" id="candidate_entry_data"  style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
	                <div class="card-body">
	                  
	                    <div class="row">
	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> REQUEST JOB NUMBER  </label>
	                            <input type="text" name="request_job_number" value="{{$get_data->job_fptk->request_job_number}}" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }} class="form-control">
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                        <input type="hidden" name="actual_staff" value="{{$get_data->job_fptk->actual_staff}}">
	                        <input type="hidden" name="candidate_id" value="{{$get_data->candidate_id}}">
	                        <input type="hidden" name="employment_type" value="{{$get_data->employment_type}}">


    						<div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> EMPLOYEE NAME   </label>
	                       		<input type="hidden" name="job_fptk_id" class="form-control" value="{{$get_data->job_fptk_id}}" readonly>
	                            <input class="form-control" type="text" name="name_holder" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }} id="name_holder" value="{{$get_data->name_holder}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 		

	                        @if($get_data->employment_type == 'magang' || $get_data->employment_type == 'pkl')
	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> PT OS   </label>
	                            <select class="form-control" name="company_name" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }}>
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
	                            <label class="control-label  font-14"> REQUESTER </label>
	                            <input class="form-control" type="text" name="requester_name"  {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }} id="requester_name" value="{{$requester_name->name}}" >
	                            <input class="form-control" type="hidden" name="requester_email"   id="requester_email" value="{{$get_data->job_fptk->requester_email}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>   

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> POSITION  </label>
	                            <input class="form-control" type="text" name="position_name" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }}  id="position_name" value="{{$get_data->job_fptk->position_name}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div> 




	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> PROJECT NAME </label>
	                            <input class="form-control" type="text" name="project_name" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }} id="project_name" value="{{$get_data->job_fptk->project_name}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>



	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> ENTITI (COST CENTER)  </label>
	                            <input class="form-control" type="text" name="cost_center" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }} id="cost_center"  value="{{$get_data->job_fptk->cost_center}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>




	                        @if($get_data->job_fptk->project_name == 'OTHERS')
		                       	<div class="col-sm-6">
		                          <div class="form-group" id="div_other_project">
			                        <label class="control-label  font-14"> PROJECT NAME <span class="span-mandatory">*</span> </label>
			                        <input class="form-control" type="text" name="other_project" readonly  id="other_project" value="{{$get_data->job_fptk->other_project}}">
			                        <i class="invalid-feedback" role="alert"></i>                                 
			                      </div>
			                    </div>
		                    @endif

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> WORKING LOCATION </label>
	                            <input class="form-control" type="text" name="work_location"  {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }} id="work_location"  value="{{$get_data->job_fptk->work_location}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> DIVISION  </label>
	                            <input class="form-control" type="text" name="division" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }} id="division"  value="{{$get_data->job_fptk->division}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>

	                

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> JOIN DATE </label>
	                            <input class="form-control" type="text" name="join_date" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }}  id="join_date" value="{{$get_data->join_date}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> SUPERVISOR </label>
	                            <input class="form-control" type="text" name="supervisor" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }}  id="supervisor" value="{{$get_data->supervisor}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>


	                         <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> END DATE  </label>
	                            <input class="form-control" type="text" name="end_date" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }}  id="end_date" value="{{ date('Y-m-d',strtotime($get_data->end_date)) }}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>
	                     
	                         <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> REASON DESCRIPTION  </label>
	                            <textarea class="form-control" type="text" name="reason_return" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }}  id="reason_return"  >{{ $get_data->reason_return }}</textarea>
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>
	                     

	                        <div class="col-sm-6">
	                          <div class="form-group">
	                            <label class="control-label  font-14"> CONTRACT PERIODE  </label>
	                            <input class="form-control" type="text" name="contract_periode" {{ ($get_data->job_fptk->requester_name == Auth::user()->nip) ? "" : "readonly" }}  id="contract_periode" value="{{$get_data->contract_periode}}" >
	                            <i class="invalid-feedback" role="alert"></i>                                 
	                          </div>
	                        </div>
	                    </div>

	                </div>  <!-- END CARD BODY -->
             
            </div><!-- END CARD -->
        </div>
    </div>
</div>


<div class="container mt-1" id="candidate_entry_data"  style="max-width: 1203px">
	<nav class="navbar bg-white mt-2" style="height: 55px;border-radius: 5px;">
      <div class="row">
        <div class="col-12">
            <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> APPROVAL  </h3>   
        </div>
      </div>
    </nav>
    <div class="card mt-2">
       	<div class="card-body bg-white">
          	<div class="section">
              		<div class="form-row mt-4"> <!-- This DIV FORM -->
 						<table class="table table-stripped">
 							<tr>
 								<th width="20%">Manager Designated Supervisor</th>
 								<th  width="20%">Status</th>
 								<th> Date</th>
 								<th>Notes</th>
 							</tr>
 							

 							@if(!empty($get_head))

 							@foreach($get_head as $head)
 							<tr>
 								<td>  {!!$head->position!!} </td>
 								<td>
 									@php 
 										$approval_head = \App\Models\TrApproval::with('user','fptk')
 										->where('user_id',Auth::user()->user_id)
 										->where('job_fptk_id',$get_data->job_fptk_id)
 										->first();

 										$user = Auth::user()->username;
 										$kepala = $head->parent_user;

 									@endphp


 									@if($kepala && $user)
 									 	<input type="hidden" name="approval_id[]" value="{!!(!empty($approval_head->user_id)) ? $approval_head->approval_id : '' !!}">
 										<input type="hidden" name="user_id[]" value="{!!Auth::user()->user_id!!}">

 										 
 										@if(!empty($approval_head->user_id)) 
 											@if($approval_head->user_id == Auth::user()->user_id)
 												<select class="form-control" name="approval_status" id="approval_status_head" onchange="ubah_note()">
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
											 	@if($head->parent_user == Auth::user()->username)
											 		<select class="form-control" name="approval_status" >
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
 										{!!(!empty($approval->user_id)) ? '<div class="mt-2"><span class="alert alert-success">'.$approval->approval_status.'</span></div>' : ' New' !!}
 									@endif


 								</td>
 								<td>
 									{!!(!empty($approval_head->user_id)) ? $approval_head->approval_date : 'N / A' !!}
 								</td>
 								<td>				    		
<!--  									<textarea cols="5" rows="5" class="form-control" id="txt_note"
 									@if($kepala && $user)
 									 	name="approval_desc" 
 									@else
 										disabled 
 									@endif
 									>{!!(!empty($approval_head->user_id)) ? $approval_head->approval_desc : '123' !!}</textarea> -->
 									<textarea cols="5" rows="5" class="form-control" id="txt_note" disabled>
 										{!!(!empty($approval_head->user_id)) ? $approval_head->approval_desc : '123' !!}
 									</textarea>
								</td>
 							</tr>
 							@endforeach
							@endif

 							@foreach($get_hr as $gh)
 							<tr>
								@php 
									$approval = \App\Models\TrApproval::with('user','fptk')->where('user_id',$gh->user_id)->where('candidate_id',$get_data->candidate_id)->first();

								@endphp
 								<td> {{$gh->position}}   </td>
 								<td>
 									@if($gh->username == $get_emp->username || $get_emp->parent_user == Auth::user()->username)
 										<input type="hidden" name="approval_id[]" value="{!!(!empty($approval->user_id)) ? $approval->approval_id : '' !!}">
 										<input type="hidden" name="user_id[]" value="{{Auth::user()->user_id}}">
 										@if(!empty($approval->user_id)) 
 											@if($approval->user_id == Auth::user()->user_id)
 												<select class="form-control" name="approval_status">
 													<option value=""> New </option>
			 										
			 										<option value="approved" {!! ($approval->approval_status == 'approved') ? "selected"  :"" !!}> Approved </option>
			 										<option value="rejected" {!! ($approval->approval_status == 'rejected') ? "selected"  :"" !!}> Rejected </option>
		 										</select>	
		 									@else
		 										<div class="mt-2">
		 											{!! '<span class="alert alert-success">'.ucfirst($approval->approval_status).'</span>' !!}
		 										</div>
	 										@endif
 										@else
	 										@if(!empty($approval->user_id)) 
		 										<div class="mt-2">
		 											{!! '<span class="alert alert-success">'.ucfirst($approval_hr->approval_status).'</span>' !!}
		 										</div>
											@else
											 	@if($gh->user_id == Auth::user()->user_id)
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
 									{!!(!empty($approval->user_id)) ? '<div class="mt-2"><span class="alert alert-success">'.$approval->approval_status.'</span></div>' : 'New' !!}
 									@endif

 								</td>
 								<td>{!!(!empty($approval->user_id)) ? $approval->approval_date : 'N / A' !!}</td>
 								<td>				    

 									<textarea cols="5" rows="5" class="form-control"
 									@if($gh->username == $get_emp->username || $get_emp->parent_user == Auth::user()->username)
 									 	name="approval_desc" 
 									@else
 										disabled 
 									@endif>{!!(!empty($approval->user_id)) ? $approval->approval_desc : '' !!}</textarea>
								</td>
 							</tr>
 							@endforeach	
 							
 							
 						</table>
 					</div>

			</div>
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
						<button type="button" class="btn btn-primary"  onclick="update_return_employee()">UPDATE</button>
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


function ubah_note() {

	var abc = $('#approval_status_head').val();

	if(abc == '' || abc == 'approved') 
	{
		document.getElementById("txt_note").disabled = true;
	}
	else
	{
		document.getElementById("txt_note").disabled = false;
	}
}

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
