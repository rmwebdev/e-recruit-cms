 <!-- THIS ASSESSMENT -->
<div class="form-row"> <!-- This DIV FORM -->
<div class="col-md-12">
		<label for="" class="control-label">PRE-ASSESSMENT</label>
		<div>
			<i><span class="span-mandatory">*</span>  Mandatory</i>
		</div>
		<input type="hidden" name="countPreassesment" value="{{count($assessment)}}">
		<form id="formAssessment">
		<input type="hidden" name="candidate_id" value="{{Session::get('userinfo')['candidate_id']}}">
		<table class="table table-responsive table-bordered" id="">
			<tr>
				<th style="text-align:center">NO.</th>
				<th style="text-align:center">QUESTION</th>
				<th style="text-align:center">ANSWER</th>
			</tr>	
			@php  $no=1; @endphp
			
			@foreach($assessment as $assess)
				@php 
					$data_asses = DB::table('e_recruit.tr_assessment')
					->where('candidate_id',Session::get('userinfo')['candidate_id'])
					->where('asses_quest_id',$assess->asses_quest_id)->first();
				@endphp
			<tr>
				<td width="5%">{{$no}}</td>
				<td width="55%">   {{$assess->quest}} <span class="span-mandatory">*</span> </td>
				<td>
					  <div class="row"> 
					  	@if($assess->quest_type == 'yesnotext')
						    <div class="col-md-4">
						    	<input type="hidden" name="asses_quest_id{{$no}}" value="{{$assess->asses_quest_id}}">
						    	<label class="radio-inline"><input type="radio" required="required" name="assessment{{$no}}"  {{ (!empty($data_asses->answer) && ($data_asses->answer == 'yes'))  ? 'checked':'' }}  onchange="inputAsses(this,'yes','{{$no}}')"  value="yes"> Yes</label>
								<label class="radio-inline"><input type="radio" required="required" name="assessment{{$no}}" {{ (!empty($data_asses->answer) && ($data_asses->answer == 'no'))  ? 'checked':'' }}  onchange="inputAsses(this,'no','{{$no}}')"  value="no"> No</label>
								<i class="invalid-feedback" role="alert"></i>
						    </div>
						    <div class="col-md-8">
					    		<textarea name="textAnswer{{$no}}"  class="form-control" id="textAnswer{{$no}}">{{(empty($data_asses->remarks)) ? '':$data_asses->remarks }}</textarea>
					    	</div>
					    @elseif($assess->quest_type == 'yesno')
					    	<div class="col-md-4">
						    	<label class="radio-inline"><input type="radio" required="required" name="assessment{{$no}}"  {{ (!empty($data_asses->answer) && ($data_asses->answer == 'yes'))  ? 'checked':'' }}  onchange="inputAsses(this,'yes','{{$no}}')"  value="yes"> Yes</label>
						    	<input type="hidden" name="asses_quest_id{{$no}}" value="{{$assess->asses_quest_id}}">
								<label class="radio-inline"><input type="radio" required="required" name="assessment{{$no}}" {{ (!empty($data_asses->answer) && ($data_asses->answer == 'no'))  ? 'checked':'' }}  onchange="inputAsses(this,'no','{{$no}}')"  value="no"> No</label>
								<i class="invalid-feedback" role="alert"></i>
						    </div>
						    
						@else
							<div class="col-md-8"> 
								<input type="hidden" name="asses_quest_id{{$no}}" value="{{$assess->asses_quest_id}}">
					    		<textarea name="textAnswer{{$no}}" class="form-control" style="width: 400px" required id="textAnswer{{$no}}">{{(empty($data_asses->remarks)) ? '':$data_asses->remarks }}</textarea>
					    	</div>
					    @endif
					    
					  </div>
					  
				</td>
			</tr>
			@php  $no++ @endphp
			@endforeach
			<input type="hidden" name="tot" value="{{$no-1}}">
		</table>
		@if($assessment_comp != $no-1 )								
			<center>
				<button type="submit" class="btn btn-primary">SAVE ASSESSMENT</button>
			</center>
		@endif
		</form>
</div>
</div>
<!-- END ASSESSMENT -->