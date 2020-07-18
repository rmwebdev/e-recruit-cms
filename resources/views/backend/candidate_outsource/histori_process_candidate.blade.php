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
	                <a href="/create-fptk-outsource">FPTK NON EMPLOYEE</a> >> View Candidate >> DETAIL 
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
					                    <th>Process</th>
					                    <th>Process Date</th>
					                    <th>Result</th>
					                </tr>
										@php $no = 1; @endphp
										@foreach($lihat_history_candidate as $histori_candidate)
												<tr>
													<td>{{ $no++ }}</td>
													<td>{{$histori_candidate->name_holder}}</td>
													<td>{{$histori_candidate->history_process}}</td>
													<td>{{ date('d-M-Y', strtotime($histori_candidate->history_date)) }}</td>
													<td>{{$histori_candidate->history_result}}</td>
												</tr>
										@endforeach
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