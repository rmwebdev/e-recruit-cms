@extends('layouts.app')
@section('content')
<style type="text/css">
	.select2-container .select2-selection--single{
		width: 100%;
	}
</style>
<form id="form-fptk-outsource-submission-delete">
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


    <input type="hidden" name="actual_staff" value="{{$get_data->job_fptk->actual_staff}}">
    <input type="hidden" name="candidate_id" value="{{$get_data->candidate_id}}">
   	<input type="hidden" name="job_fptk_id" class="form-control" value="{{$get_data->job_fptk_id}}">

	<div style="clear:both"></div>
	<div class="container mt-1" style="max-width: 1203px">
	    <div class="row">
	        <div class="col-md-12">
	            <nav class="bg-white" style="height: 55px;border-radius: 5px;">
	            	<center>
		            	<div class="pt-2">
							<button type="button" class="btn btn-primary"  onclick="deleteTenagaKerja()">DELETE</button>
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
    
	    $('#join_date').datepicker({
	        uiLibrary: 'bootstrap4', 
	        format: 'yyyy-mm-dd',
	    });
    	function deleteTenagaKerja()
	    {
	        var data_candidate= new FormData($('#form-fptk-outsource-submission-delete')[0]);
			swal({
	              title: "Are you sure",
	              text: " Delete this data ?",
	              icon: "warning",
	              buttons: true,
	              dangerMode: false,
	            })
	            .then((willDelete) => {
	                if (willDelete) {
	            		$.ajax({
	                        url:'{{route('candidate-regis.delete-candidate-outsource')}}',
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
	                                swal('Success','Candidate has been delete successfully!','success');
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