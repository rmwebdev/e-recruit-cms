@extends('layouts.frontend')

@section('content_frontend')
@php 
	$userinfo = Session::get('userinfo'); 
@endphp
<div style="margin-top: -70px;"></div>
<div class="container  my-4 mt-5">
    <div class="row">
        <div class="col-md-12 mt-5">
        	    <div class="mt-5 row" style="background-color:#fff">
        	    	<div class="col-md-6">
                    	<h1 style="font-size: 20px;">CONFIRMATION</h1>
                    </div>
                    <div class="col-md-6">
                    	<a href="{{url('/')}}" class="btn  pull-right" style="color:red;font-weight: bold;background: white;border-color:#000"><div style="font-size: 12px;">CANCEL</div></a>
                    </div>
                </div>
        	<div class="alert alert-success mt-4" role="alert">
				<strong> {!! ($count > 0) ? "Congratulation" : "" !!}  {!! ucfirst($userinfo['name_holder']) !!} ,</strong> You have <strong>  {{$count}} notification </strong> 
			</div>
		       	 @foreach($history as $history)
		       	 	<div style="background-color: #f9f9f9;padding:20px;" class="mt-4">
		            	<div class="card">  
		          	 		<table class="table table-responsive background-white">
								<tr>
									<td>Position Name</td>
									<td>:</td>
									<td>
										{{$history->history_position_name}}
												<span class="invalid-feedback" role="alert"></span>
		                            </td>
								</tr>
								<tr>
									<td>Date Interview</td>
									<td>:</td>
									<td>
										{{tanggal_indo_lengkap($history->history_date)}}
												<span class="invalid-feedback" role="alert"></span>
		                            </td>
								</tr>
								<tr>
									<td>Time</td>
									<td>:</td>
									<td>
										{!! date('H:i:s', strtotime($history->history_date)) !!}
												<span class="invalid-feedback" role="alert"></span>
		                            </td>
								</tr>

								<tr>
									<td>Interviewer</td>
									<td>:</td>
									<td>
										{!! $history->history_contact_person !!}
												<span class="invalid-feedback" role="alert"></span>
		                            </td>
								</tr>

								<tr>
									<td>Address</td>
									<td>:</td>
									<td>
										{!! $history->history_address !!}
												<span class="invalid-feedback" role="alert"></span>
		                            </td>
								</tr>

								<tr>
									<td>Process</td>
									<td>:</td>
									<td>
										<div class="label" style="font-weight: bold;"> {!! $history->history_invitation_process !!}</div>
		                            </td>
								</tr>

								<tr>
									<td>Status</td>
									<td>:</td>
									<td>
										<div class="label" style="font-weight: bold;">{!! $history->history_result !!}</div>
		                            </td>
								</tr>
						</table>
		            </div>

						<!-- <div class="mt-3"> -->
							@php 
						  	if(empty($history->history_confirmation)):
						  	@endphp
						  		<div style="margin-top: 10px;"></div>
						        <!-- <div class="form-group mt-5"> -->
									<div class="table-responsive">  
									  	<button class="btn btn-success"	type="button" onclick="processConfirmation('ATTENDING','{{$userinfo['candidate_id']}}','{{$history->history_process_id}}')">
									  		<div style="font-size: 11px;">Attending</div>
									  	</button>
									  	<button class="btn btn-danger"  type="button" onclick="processConfirmation('NOT ATTENDING','{{$userinfo['candidate_id']}}','{{$history->history_process_id}}')">
									  		<div style="font-size: 11px;">Not Attending</div>
									  	</button>
									  	<button class="btn btn-warning"	type="button" onclick="processConfirmation('RESCHEDULE','{{$userinfo['candidate_id']}}','{{$history->history_process_id}}')">
									  		<div style="font-size: 11px;">Re-Schedule</div>
									  	</button>
						        	</div>
						        <!-- </div> -->

	<!-- 						  	<div>
								  	<button class="btn btn-success"	type="button" onclick="processConfirmation('ATTENDING','{{$userinfo['candidate_id']}}','{{$history->history_process_id}}')" > Attending </button>
								  	<button class="btn btn-danger"  type="button" onclick="processConfirmation('NOT ATTENDING','{{$userinfo['candidate_id']}}','{{$history->history_process_id}}')">	 Not Attending </button>
								  	<button class="btn btn-warning"	type="button" onclick="processConfirmation('RESCHEDULE','{{$userinfo['candidate_id']}}','{{$history->history_process_id}}')"> Re-Schedule </button>
							  	</div> -->
						  	@php
						  		endif
						  	@endphp
						<!-- </div> -->
				</div>

				@endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
    @include('frontend.form_candidate.js_form_candidate')
@endsection

