@extends('layouts.app')

@section('content')
<style type="text/css">
    
</style>

@php
	$status =  (empty($_GET['status']))  ? "" : $_GET['status'] ; 
	$q =  (empty($_GET['q']))  ? "" : $_GET['q'] ; 
	$tot =  (empty($_GET['tot']))  ? "" : $_GET['tot'] ; 
	$type =  (empty($_GET['type']))  ? "" : $_GET['type'] ; 
	$search_q =  (empty($_GET['search_q']))  ? "" : $_GET['search_q'] ; 
@endphp

<div class="container" style="max-width: 1203px">
    <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
  	   <div class="row">
            <div class="col-12">
                <h4 class="color-ungu  pl-3 mt-1 font-18"> <a href="{{url('rec-process')}}"> <i class="fa fa-arrow-left"></i> </a>  {{ ( $q =='all_registered' )  ? "LIST ALL CANDIDATE" : "LIST EMPLOYEE ".strtoupper($_GET['status']).' ('.$_GET['tot'].')'   }}  </h4>
            </div>
        </div>
		<a class="btn bg-ungu pull-right"  href="{{url('candidate-final-add?status='.$status.'&q='.$q.'&tot='.$tot.'&type='.$type.'')}}" style="color: #fff"><i class="fa fa-plus"></i> ADD CANDIDATE
        </a>
	 </nav>



	<nav class="navbar bg-abu-muda mt-2" style="height: 55px;border-radius: 5px;padding: 0">
	    <div class="row">
	      <div class="col-sm-12">
	         <div class="font-weight-500 font-14" >
	         	<form action="{{url('rec-process/view_all')}}" method="GET" id="form-search">
	         		<input type="hidden" name="status" value="{{$_GET['status']}}">
	         		<input type="hidden" name="q" value="{{$_GET['q']}}">
	         		<input type="hidden" name="tot" value="{{$_GET['tot']}}">
	         		<input type="hidden" name="type" value="{{$_GET['type']}}">
	            	<input type="text" style="width: 300px" class="form-control" name="search_q" placeholder="Search ..." value= {{ !isset($_GET['search_q']) ? ""  : $_GET['search_q'] }} > 
	           	</form>
	          </div>
	      </div>
	    </div>
	    <div class="row">
	        
	    </div>
	</nav>


	<div class="card bg-abu-muda  mt-3" style="border:none;">
	    <div class="card-body" style="padding: 0">
	      <div class="col-12">
	        <div class="row">
	            <div class="col-2">
	              <h5 class="font-weight-500 font-14 font-abu pl-4"> NAME </h5>
	            </div>

	            <div class="col-2">
	              <h5 class="font-14 font-abu pl-4">  CURRENT EXPERIENCE </h5>
	            </div>

	            <div class="col-2">
	              <h5 class="font-14 font-abu pl-2"> NO HP</h5>
	            </div>

	            <div class="col-2">
	              <h5 class="font-14 font-abu pl-2">DEGREE/WORK EXPERIENCE</h5>
	            </div>  


	            <div class="col-2">
	              <h5 class="font-14 font-abu pl-4">EXPECTED SALARY</h5>
	            </div>


	            <div class="col-2">
	              <h5 class="font-14 font-abu"> JOB APPLIED</h5>
	            </div>
	           
	        </div><!-- CARD TOP --->
	      </div>
	    </div>
	</div>


	@foreach($result as $r)
	 <div class="card bg-white card-candidate mb-3" style="border-radius: 5px;" id=""> 
	  <div class="card-body">
	    <div class="col-12">
	          <div class="row">
	              <div class="col-2">
	                <h5 class="color-ungu  font-weight-500 font-16"> {{$r->name_holder}}  </h5>
	                <a href="{{url('candidate-final/'.$r->candidate_id)}}" target="_blank"><h5  class="font-14 font-abu"> <i class="fa fa-eye"></i> View </h5></a>
	              </div>

	              <div class="col-2">
	                <h5 class="color-ungu  font-14"> {!! (empty($r->edu_major)) ? "" : "$r->edu_major ($r->edu_end_year)" !!} </h5>
	                <h5 class="font-14 font-abu"> {{$r->edu_university}}</h5>
	              </div>

	              <div class="col-2">
	                <h5 class="color-ungu  font-14"> {{ $r->hp_1 }} </h5>
	              </div>

	              <div class="col-2">
	                <h5 class="color-ungu  font-14">  {{$r->edu_degree}} </h5>
	                <h5 class="font-14 font-abu"> {{$r->exp_total}} </h5>
	              </div>  


	              <div class="col-2">
	                <h5 class="color-ungu  font-14"> <center> {{(empty($r->exp_salary_existing)) ? 0 : $r->exp_salary_existing}} </center>  </h5>
	              </div>

	              <div class="col-2">
	                <h5 class="color-ungu  font-14 pl-4"> {{(empty($r->position_name)) ? '-' : $r->position_name}}  </h5>
	              </div>
	             
	          </div><!-- CARD TOP --->

	          <hr>
	          @if(auth()->user()->can('invited-candidate'))
	              <form action="{{url('rec-process/edit_rec_process/'.$r->candidate_id)}}">
	               <div class="row">
	                  <div class="col-5">
	                    <div class="row">
	                      <div class="col-3 float-right" style="padding-right: 3px;">
	                        <span class="color-ungu  font-weight-500 font-14">  Select Process </span>  
	                      </div>
	                      <div class="col-6"  style="padding-left:0px">
	                        <input type="hidden" name="job_id">
	                        <input type="hidden" name="status" value="{{$_GET['status']}}">
	                        <input type="hidden" name="q" value="{{$_GET['q']}}">
	                        <input type="hidden" name="tot" value="{{$_GET['tot']}}">
	                        <input type="hidden" name="type" value="{{$_GET['type']}}">
	                        <select class="form-control" name="process">
	                            @foreach($process as $st)
	                                <option value="{{$st->nama}}">{{($st->nama == 'CALLED' ? "INVITED" : $st->nama)}}</option>
	                            @endforeach
	                        </select>
	                      </div>
	                      <div>
	                        <button type="submit" class="btn bg-ungu" style="color:white"> Lanjut </a>
	                      </div>
	                    </div>
	                  </div>
	                 
	              </div>
	            </form>
            @endif

	    </div><!-- END COL 12 -->
	  </div>
	</div>
	@endforeach
	<div class="pull-right">
	{{ $result->appends(['status'=>$_GET['status'],'q'=>$_GET['q'],'tot'=>$_GET['tot'],'type'=>$_GET['type'],'search_q'=>$search_q ])->links() }}
	</div>
</div>

@endsection

@section('js')
    @include('backend.rec_process.js_rec_process')
    <script type="text/javascript">
	
    	$('[name="select_all"]').keypress(function (e) {
		  if (e.which == 13) {
		    $('#form-search').submit();
		  }
		});
    </script>
@endsection
