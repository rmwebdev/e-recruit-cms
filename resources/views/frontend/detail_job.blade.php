@extends('layouts.frontend')
@section('content_frontend')

@php 
  $userinfo = Session::get('userinfo'); 
@endphp


<div style="background: url('/images/banner_detail.png'); margin-top:44px;height: 125px;">
	<div class="container">
		<h5 style="padding-top:30px;font-size: 24px" class="color-white"> {{strtoupper($job->position_name)}} </h5>
		<div style="margin-top: -10px;"></div>
		<div class="row mt-4">
			<div class="col-md-3">
				<img src="{{asset('images/map_icon.png')}}">
				<span class="color-white" style="font-size: 16px">{{strtoupper($job->work_location)}}</span>
			</div>
			<div class="col-md-3">
				<img src="{{asset('images/time_icon.png')}}">
				<span class="color-white"  style="font-size: 16px">{{strtoupper($job->work_system)}} </span>
			</div>
		{{-- 	<div class="col-md-4">
				<img src="{{asset('images/box_icon.png')}}">
				<span class="color-white">{{strtoupper($job->department)}} </span>
			</div> --}}
		</div>
	</div>
</div>


<section class="page-section mt-4 mb-5">
    <div class="container">
      <div class="col-md-12">
        <!-- /.row -->

         	@php 
		        $date_exp = 0;
		        if(!empty($candidate))
		        {
		            if($candidate->result == 'FAILED')
		            {
		              $tgl = (!empty($candidate)) ? strtotime($candidate->received_date) : "0";  
		              $date_exp = date('Y-m-d', strtotime('+2 years',$tgl));    
		            }
		            else
		            {
		              $date_exp = 0;
		            }
		        }
	      	@endphp
		   		
	      <input type="hidden" name="job_fptk" value="{{(!empty($job_ready)) ? "$job_ready" : "" }}">
	      <input type="hidden" name="position_name" value="{{(!empty($list_job)) ? "$list_job->position_name" : "" }}">
	      <input type="hidden" name="result" value="{{(!empty($candidate)) ? "$candidate->result" : "" }}">
	      <input type="hidden" name="process" value="{{(!empty($candidate)) ? "$candidate->process" : "" }}">
	      <input type="hidden" name="received_date" value="{{(!empty($candidate)) ? "$candidate->received_date" : "" }}">
	      <input type="hidden" name="date_now" value="{{ strtotime(date('Y-m-d')) }}">
	      <input type="hidden" name="exp_date" value="{{ strtotime($date_exp)}}">
		<h3 class="font-20">DESCRIPTION</h3>
		<p  class="mt-2">{{strip_tags(html_entity_decode($job->description))}}</p>
		

		<h3  class="mt-4 font-20">REQUIREMENTS</h3>
		<p class="mt-2">{{strip_tags(html_entity_decode($job->requirement))}}</p>
		
		<h3  class="mt-4 font-20">BENEFIT</h3>
		<p  class="mt-2">{{strip_tags(html_entity_decode($job->benefit))}}</p>

		<hr class="mt-5">
		<h3 class="mt-5 font-20">SUBMIT A JOB APPLICATION</h3>
		<p class="font-16 mt-1" align="justify">I acknowledge that I have read and understood the Data Privacy Policy, and I agree that the Data Privacy Policy shall apply to PUNINAR LOGISTICS’s collection, use, processing, retention and disclosure of my personal data for the purpose of my recruitment and consideration for employment by PUNINAR LOGISTICS. I understand that I can withdraw my consent at any time.</p>


		<div class="mt-5">
	      <button class="btn btn-warning" style="color:#fff" onclick="applyNow('{{$job->job_fptk_id}}','{{$job->position_name}}')"> 
	        Apply Now
	      </button>
	      <a class="btn btn-default" href="/"> 
	        Cancel
	      </a>
	    </div>

      </div>
    </section>
@endsection

@section('js')
    @include('frontend.js_frontend')
@endsection