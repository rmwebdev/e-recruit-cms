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
	                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> 
	                	<a href="/create-fptk-outsource">FPTK NON EMPLOYEE</a> >> View Candidate
	                </h3>   
	            </div>
	          </div>
	        </nav>

            <div class="card mt-3">
                <div class="card-body"  style="background-color: #f0f0f0">
                  	<div class="section">
	                  	<div class="form-row">
							<div class="col-md-12">
								<table class="table table-striped">
									<tr>
										<th>No</th>
										<th>Name Candidate</th>
										<th>Email Candidate</th>
										<th>Information</th>
									</tr>
									@if(!empty($edit_data))
										@php $no = 1; @endphp
										@foreach($edit_data as $data_histori)
												<tr>
													<td>{{ $no++ }}</td>
													<td>{{$data_histori->name_holder}}</td>
													<td>{{$data_histori->email}}</td>
													<td>
<!-- 														<a href="" onclick="detail_psyhotest('{{$data_histori->candidate_id}}')">
															View Process
														</a> -->
														<a href="/view-histori-fptk-outsource-candidate?id_job={{$data_histori->job_fptk_id}}&id_can={{$data_histori->candidate_id}}">View Process</a>
													</td>
												</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4" align="center">Data Kosong</td> 
										</tr>
									@endif
								</table>
						    </div>
						</div>
               	 	</div>
					<div style="clear:both"></div>						
           		</div>
        	</div> 
    	</div>
    </div>
</div>
@endsection

@section('js')
    @include('backend.candidate_outsource.js_candidate_outsource');
@endsection