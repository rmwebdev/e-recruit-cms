<div class="container mt-3" id="candidate_form"  style="max-width: 1203px">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
			<div class="form-row"> <!-- This DIV FORM -->
				<div class="col-md-12">
					<label for="" class="control-label">PRE-ASSESSMENT</label>
					<input type="hidden" name="countPreassesment" value="{{count($assessment)}}">
					<table class="table table-responsive table-bordered" id="">
						<tr>
							<th style="text-align:center">No.</th>
							<th style="text-align:center">Question</th>
							<th style="text-align:center">Answer</th>
						</tr>	
						@php  $no='1'; @endphp
						@foreach($assessment as $assess)
							@php 
								$data_asses = DB::table('e_recruit.tr_assessment')
								->where('candidate_id',$candidate_id)
								->where('asses_quest_id',$assess->asses_quest_id)->first();
							@endphp
						<tr>
							<td width="5%">{{$no}}</td>
							<td width="55%">  {{$assess->quest}} </td>
							<td>
								 <div class="row"> 
								  	@if($assess->quest_type == 'yesnotext')
									    <div class="col-md-4">
									    	<input type="hidden" name="asses_quest_id{{$no}}" value="{{$assess->asses_quest_id}}">
									    	<label class="radio-inline"><input type="radio" required="required" disabled name="assessment{{$no}}"  {{ (!empty($data_asses->answer) && ($data_asses->answer == 'yes'))  ? 'checked':'' }}  onchange="inputAsses(this,'yes','{{$no}}')"  value="yes"> Yes</label>
											<label class="radio-inline"><input type="radio" required="required" name="assessment{{$no}}" {{ (!empty($data_asses->answer) && ($data_asses->answer == 'no'))  ? 'checked':'' }}  disabled  onchange="inputAsses(this,'no','{{$no}}')"  value="no"> No</label>
											<i class="invalid-feedback" role="alert"></i>
									    </div>
									    <div class="col-md-8">
								    		<textarea name="textAnswer{{$no}}"  disabled class="form-control" id="textAnswer{{$no}}">{{(empty($data_asses->remarks)) ? '':$data_asses->remarks }}</textarea>
								    	</div>
								    @elseif($assess->quest_type == 'yesno')
								    	<div class="col-md-4">
									    	<label class="radio-inline"><input type="radio"  disabled required="required" name="assessment{{$no}}"  {{ (!empty($data_asses->answer) && ($data_asses->answer == 'yes'))  ? 'checked':'' }}  onchange="inputAsses(this,'yes','{{$no}}')"  value="yes"> Yes</label>
									    	<input type="hidden" name="asses_quest_id{{$no}}" value="{{$assess->asses_quest_id}}">
											<label class="radio-inline"><input type="radio"  disabled required="required" name="assessment{{$no}}" {{ (!empty($data_asses->answer) && ($data_asses->answer == 'no'))  ? 'checked':'' }}  onchange="inputAsses(this,'no','{{$no}}')"  value="no"> No</label>
											<i class="invalid-feedback" role="alert"></i>
									    </div>
									    
									@else
										<div class="col-md-8"> 
											<input type="hidden" name="asses_quest_id{{$no}}" value="{{$assess->asses_quest_id}}">
								    		<textarea name="textAnswer{{$no}}" class="form-control"  disabled style="width: 400px" required id="textAnswer{{$no}}">{{(empty($data_asses->remarks)) ? '':$data_asses->remarks }}</textarea>
								    	</div>
								    @endif
								    
								 </div>

								  {{-- <div class="row">
								    <div class="col-md-4">
								    	<label class="radio-inline"><input type="radio" disabled name="optradio{{$no}}" {{(!empty($data_asses->answer) && $data_asses->answer == 'yees' ) ? "checked" : "" }}  > Yes</label>
										<label class="radio-inline"><input type="radio" disabled {{(!empty($data_asses->answer) && $data_asses->answer == 'no' ) ? "checked" : "" }}  name="optradio{{$no}}" value=""> No</label>
								    </div>
								    <div class="col-md-8">		
								    	@php 
							      			if(!empty($data_asses) &&  (!empty($data_asses->remarks))):
							      			echo $data_asses->remarks
							      		@endphp
							      		@endif
								    </div>
								  </div> --}}
							</td>
						</tr>
						@php  $no++ @endphp
						@endforeach
					</table>								

				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>