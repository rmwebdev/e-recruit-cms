
  <h5 class="card-title color-pun" style="font-weight: bold;">{{strtoupper($job->position_name)}}</h5>
  <p class="sub-job-title">Work Location : {{$job->work_location}}</p>
  <p class="sub-job-title">Work System : {{$job->work_system}}</p>
  <hr style="border: 1px solid #9b9b9b">

  <div>
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


      @if($process == 'REGISTRATION' || empty($user))
        
      @elseif(!empty($user) || $process != 'REGISTRATION')
        <h4>Description</h4>
        @php
          $description = html_entity_decode($job->description);
          echo $description;
        @endphp
        <h4>Requirements</h4>
        	@php
        	$requirement = html_entity_decode($job->requirement);
        	echo $requirement;
        	@endphp
        
        <h4>Benefits</h4>
        @php
        	$benefit = html_entity_decode($job->benefit);
        	echo $benefit;
        @endphp

        <button class="btn btn-warning" style="color:#fff"  
           onclick="applyNow('{{$job->job_fptk_id}}','{{$job->position_name}}')"> 
          Apply Now
        </button>
      @endif
    </div>
    <div>
        
</div>
  