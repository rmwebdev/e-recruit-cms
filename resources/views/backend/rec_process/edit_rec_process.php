@extends('layouts.app')

@section('content')
@php
		$job_id = (!empty($_GET['job_id']))  ? $_GET['job_id'] : "";
		
		$url = (!empty($_GET['job_id']))  ? url('detail-rec-process?id='.$job_id.'&status='.$_GET['status'].'&type='.$_GET['type']) : url('rec-process/view_all?status='.$_GET['status'].'&q='.$_GET['q'].'&tot='.$_GET['tot'].'&type='.$_GET['type']) ;
@endphp
<div class="container" style="max-width: 1203px">
    <nav class="navbar bg-white mb-2" style="height: 55px;border-radius: 5px;">
      <div class="row">
          <div class="col-12">
             <span class="color-ungu font-weight-900">Edit Candidate Process | ID = {{$candidate->candidate_id}} | RECEIVED DATE : {{$candidate->received_date}}</span>
          </div>
      </div>
      <a href="{{ $url }}" class="btn btn-warning pull-right" >CANCEL</a>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                

                <div class="card-body  bg-abu-putih">
                  	<div class="section">
                  		<table class="table">
                			<tr>
                				<td width="40%"></td>
                				
                				<td>
									@php 
										if(empty($candidate->file_1)):
									@endphp
										<div></div>
									@php 
										else:
									@endphp
										<img src="{{asset("upload_file/$candidate->file_1")}}" id="output_image" width="150px"/>
									@php 
										endif
									@endphp
                				</td>
                			</tr>
		                </table>
                  		<div class="row">
                  			<div class="col-md-6">
                  				<div class="form-group">
                  					<label>Name</label>
                  					<input type="text" name="" disabled value="{{$candidate->name_holder}}" class="form-control">
                  				</div>
                  				<div class="form-group">
                  					<label>Email</label>
                  					<input type="text" name="" disabled value="{{$candidate->email}}" class="form-control">
                  				</div>	

                  				<div class="form-group">
                  					<label>No HP</label>
                  					<input type="text" name="" disabled value="{{$candidate->hp_1}}" class="form-control">
                  				</div>
                  			</div>

                  			<div class="col-md-6">
                  				<div class="form-group">
                  					<label>Major</label>
                  					<input type="text" name="" disabled value="{{$candidate->edu_major}}" class="form-control">
                  				</div>
                  				<div class="form-group">
                  					<label>Process</label>
                  					<input type="text" name="" disabled value="{{($candidate->process == 'CALLED') ? "INVITED" : $candidate->process}}" class="form-control">
                  				</div>	

                  				
                  			</div>
                  		</div>
                  		
		                <br>
	             	</div>
	          
                </div>  <!-- END CARD BODY -->
            </div><!-- END CARD -->
        </div>
    </div>


    <nav class="navbar bg-white mb-2 mt-2" style="height: 55px;border-radius: 5px;">
      <div class="row">
          <div class="col-12">
             <span class="color-ungu font-weight-900">History Process</span>
          </div>
      </div>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body  bg-white">
                  	<div class="section">
	              		<table class="table table-bordered table-striped">
		                		<thead>
			                		<tr>
			                			<td>NO</td>		
			                			<td>DATE PROCESS</td>		
			                			<td>PROCESS</td>		
			                			<td>INVITATION PROCESS</td>	
			                			<td>RESULT</td>		
			                			<td>REMARKS</td>		
			                			<td>ATTACHMENT</td>		
			                			<td>POSITION NAME</td>	        			
			                		</tr>
		                		</thead>
		                		<tbody>
		                			@php
		                				if(empty($history[0])):
		                			@endphp
		                				<tr>
		                					<td colspan="10"></td>
		                				</tr>
		                			@php
		                				else:
		                					$no=0;
		                			@endphp
		                			@foreach($history as $history)
		                				@php 
		                					$no++;
		                				@endphp
		                			<tr>
		                				<td>{{$no}}</td>
		                				<td>
		                					{{ date('d-M-Y', strtotime($history->history_date)) }}
		                				</td>
		                				<td>
		                				
		                					@if($history->history_process == 'PSYCHOTEST')
		                						<a href="javascript:void(0)" onclick="detail_psyhotest('{{$history->history_process_id}}')"> {{$history->history_process}}   </a>
		                					@elseif($history->history_process == 'CALLED')
		                						{{"INVITED"}}
		                					@else
		                						{{$history->history_process}}
		                					@endif
		                				</td>

		                				{{-- <td>{{($history->history_process == 'CALLED') ? "INVITED" : $history->history_process}}</td> --}}
										<td>{{ (!empty($history->history_invitation_process)) ? $history->history_invitation_process." | ".date('Y-m-d',strtotime($history->history_date)) : "" }}</td>
		                				<td>{{$history->history_result}}</td>
		                				<td>{{$history->history_remarks}}
		                				</td>
		                				<td> <a href="{{asset("upload_file/$history->history_attachment")}}" target="_blank">{{$history->history_attachment}}</a></td>
		                				<td>{{$history->position_name}}</td>
		                			</tr>

		                			@endforeach
		                			@endif
		                		</tbody>
		                	</table>
	             	</div>
	          
                </div>  <!-- END CARD BODY -->
            </div><!-- END CARD -->
        </div>
    </div>



    <nav class="navbar bg-white mb-2 mt-2" style="height: 55px;border-radius: 5px;">
      <div class="row">
          <div class="col-12">
             <span class="color-ungu font-weight-900">Entry Process Recruitment - {{($_GET['process'] =='CALLED') ? "INVITED" : $_GET['process'] }}</span>
          </div>
      </div>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body  bg-white">
                  	<div class="section">
	              		
				<form id="othersForm">
						  <div class="form-group row">
						    <input type="hidden" name="candidate_id" value="{{$candidate->candidate_id}}">
						  	<input type="hidden" name="candidate_id_called" value="{{$candidate->candidate_id}}">
						  	<input type="hidden" name="process" value="{{$_GET['process']}}">
						  </div>

						 
						  <div id="others" style="display: none">
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">Result : <span class="span-mandatory">*</span></label>
							    <div class="col-sm-9">
							    	<select name="result" class="form-control">
								    	<option value=""> ======= SELECT RESULT =======</option>
		                                @foreach($result as $rs)
		                                    <option value="{{$rs->nama}}">{{$rs->nama}}</option>
		                                @endforeach
	                                </select>
									<span class="invalid-feedback" role="alert"></span>
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">Remarks : <span class="span-mandatory">*</span></label>
							    <div class="col-sm-9">
							    	<textarea name="remarks" class="form-control"></textarea>
									<span class="invalid-feedback" role="alert"></span>
							    </div>
							  </div>
							  <div class="form-group row" id="rowJoinDate" style="display: none;">
							    <label for="" class="col-sm-3 col-form-label">Join Date :</label>
							    <div class="col-sm-9">
							    	<input name="join_date" type="text" readonly class="form-control datepickerJoinDate" id="join_date">
									<span class="invalid-feedback join_process_validate" role="alert"></span>

							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">Date Process : <span class="span-mandatory">*</span></label>
							    <div class="col-sm-9">
							    	<input name="date_process" type="text" readonly class="form-control datepicker" id="date_process_others">
									<span class="invalid-feedback date_process_validate" role="alert"></span>

							    </div>
							  </div>


							  <div class="form-group row" id="CV_SORT">
							    <label for="" class="col-sm-3 col-form-label">Attachment : <span class="span-mandatory">*</span></label>
							    <div class="col-sm-9">
							    	<input name="attachment" type="file" class="form-control" onchange="changeCV(this)">
							    	<span class="invalid-feedback" role="alert"></span>

							    </div>
							  </div> 

							  <div style="display: none" id="PSYCHOTEST">
								  <div class="form-group row">
								    <label for="" class="col-sm-3 col-form-label">IQ : </label>
								    <div class="col-sm-9">
								    	<input name="iq" type="text" class="form-control  " value="{{$candidate->iq}}">
								    	<span class="invalid-feedback" role="alert"></span>

								    </div>
								  </div>

								  <div class="form-group row">
								    <label for="" class="col-sm-3 col-form-label">Pauli : </label>
								    <div class="col-sm-9">
								    	<input name="pauli" type="text" class="form-control " value="{{$candidate->pauli}}">
								    	<span class="invalid-feedback" role="alert"></span>

								    </div>
								  </div>

								  <div class="form-group row">
								    <label for="" class="col-sm-3 col-form-label">Disc : </label>
								    <div class="col-sm-9">
								    	<input name="disc" type="text" class="form-control" value="{{$candidate->disc}}">
								    	<span class="invalid-feedback" role="alert"></span>

								    </div>
								  </div>

								  <div class="form-group row">
								    <label for="" class="col-sm-3 col-form-label">CBI : </label>
								    <div class="col-sm-9">
								    	<input name="cbi" type="text" class="form-control" value="{{$candidate->cbi}}">
								    	<span class="invalid-feedback" role="alert"></span>

								    </div>
								  </div>
							  </div>
						</div>
					</form>
					{{-- <form id="calledForm"> --}}
					<form id="calledForm">

						<div class="form-group row" style="display: none" id="called_invite">
								<label for="" class="col-sm-3 col-form-label"> Invitation Type : <span class="span-mandatory">*</span></label>
							    <div class="col-sm-9">
							      <select class="form-control" name="invitation_type" onchange="get_call_video(this)">
                                    	<option value="on_office"> On Office </option>
                                    	<option value="video_call"> Video Call </option>
		                            </select>
									<span class="invalid-feedback" role="alert"></span>
							    </div>
						 </div>


						<div id="sectionCalled" style="display: none">
							 <div class="form-group row" id="on_office">
							 	<input type="hidden" name="candidate_id_called" value="{{$candidate->candidate_id}}">
							 	<input type="hidden" name="candidate_id" value="{{$candidate->candidate_id}}">
							    <label for="" class="col-sm-3 col-form-label">Email Invitation : </label>
							    <div class="col-sm-9">
							    	<textarea name="description" id="description" class="form-control textAreaInvite">
 <div style="font-size: 14px">

Dear <strong>{{ $candidate->name_holder }}</strong>,

Menindaklanjuti aplikasi yang sudah kami terima, kami menginformasikan bahwa kami mengundang anda untuk Proses Seleksi yang akan dilaksanakan pada :
<br>
<br>

<table>
	<tr>
		<td>Hari, tanggal</td>
		<td> : </td>
		<td  id="tanggal">Tidak perlu diubah, hari tanggal terisi otomatis berdasarkan date invitation</td>
	</tr>

	<tr>
		<td>Jam</td>
		<td> : </td>
		<td  id="jam">Tidak perlu diubah, jam terisi otomatis berdasarkan date invitation</td>
	</tr>


	<tr>
		<td>Lokasi</td>
		<td> : </td>
		<td id="lokasi">Tidak perlu diubah, lokasi terisi otomatis berdasarkan Venue</td>
	</tr>

	<tr>
		<td>Agenda</td>
		<td> : </td>
		<td id="process">Tidak perlu diubah, agenda terisi otomatis berdasarkan Invitation Process</td>
	</tr>

	<tr>
		<td>Bertemu dengan</td>
		<td> : </td>
    	<td id="contact_person"> Tidak perlu diubah, contact person terisi otomatis berdasarkan Invitation Process  </td>
	</tr>
</table>
<table>
	<tr>
		<td>Scan Barcode</td>
		<td> : </td>
    	<td> Mohon scan barcode di bawah ini pada device yang tersedia untuk tanda kehadiran proses interview <br> {{ htmlspecialchars(html_entity_decode(url('qr-code?param1='.base64_encode($candidate->candidate_id))))}}  </td>
	</tr>
</table>
<br>

Harap memberikan konfirmasi kehadiran pada laman E-Recruitment Puninar.                
<br>
Silahkan klik link ini untuk konfirmasi kehadiran anda
<br>
<br>
{{url('form-candidate/confirmation')}}
<br>
<br>
Untuk detail informasi mengenai perusahaan kami, silahkan mengunjungi website www.puninar.com.
<br>

</div>
</textarea>

							    	<span class="invalid-feedback" role="alert"></span>
							    </div>
							  </div>




							  <div class="form-group row" id="video_call" style="display: none">
							 	<input type="hidden" name="candidate_id_called" value="{{$candidate->candidate_id}}">
							 	<input type="hidden" name="candidate_id" value="{{$candidate->candidate_id}}">
							    <label for="" class="col-sm-3 col-form-label">Email Invitation : </label>
							    <div class="col-sm-9">
							    	<textarea name="email_video_call" id="email_video_call" class="form-control textAreaInvite">
 <div style="font-size: 14px">

Dear <strong>{{ $candidate->name_holder }}</strong>,
<br>
<br>
Menindaklanjuti aplikasi yang sudah kami terima, kami menginformasikan bahwa kami mengundang anda untuk Proses interveiew  melalui video call menggunakan aplikasi Zoom, yang akan dilaksanakan pada :
<br>
<br>
<table>
	<tr>
		<td>Hari, tanggal</td>
		<td> : </td>
		<td  id="tanggal">Tidak perlu diubah, hari tanggal terisi otomatis berdasarkan date invitation</td>
	</tr>

	<tr>
		<td>Jam</td>
		<td> : </td>
		<td  id="jam">Tidak perlu diubah, jam terisi otomatis berdasarkan date invitation</td>
	</tr>
	<tr>
		<td>Bertemu dengan</td>
		<td> : </td>
    	<td id="contact_person"> Tidak perlu diubah, contact person terisi otomatis berdasarkan Invitation Process  </td>
	</tr>

	<tr>
		<td>Link Zoom</td>
		<td> : </td>
    	<td id="link_zoom"> Tidak perlu diisi, link zoom terisi otomatis  </td>
	</tr>
</table>
<br>

<br>

<b>Catatan * </b> : Harap untuk mendownload aplikasi Zoom terlebih dahulu, untuk keperluan interview video call.                
<br>


</div>
</textarea>

							    	<span class="invalid-feedback" role="alert"></span>
							    </div>
							  </div>





							<div class="form-group row" id="invitation_process">
								<label for="" class="col-sm-3 col-form-label">Invitation Process : <span class="span-mandatory">*</span></label>
							    <div class="col-sm-9">
							      <select class="form-control" name="invitation_process">
		                                <option value=""> ======= SELECT PROCESS =======</option>
			                               	@foreach($invitation_process as $ip)
		                                    	<option value="{{$ip->nama}}">{{ $ip->nama }}</option>
			                                @endforeach
		                            </select>
									<span class="invalid-feedback" role="alert"></span>
							    </div>
						  	</div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">Date Invitation :<span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<input name="date_process_called" type="text" class="form-control" readonly id="date_process_called">
									<span class="invalid-feedback date_process_called" role="alert"></span>
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">Venue : </label>
							    <div class="col-sm-9">
							    	<textarea name="remarks_called" class="form-control">Jl. Raya Cakung Cilincing Km. 1,5, Jakarta 13910
Phone  : +62 21 460 2278 | Fax: +62 21 460 4866
									</textarea>
									<span class="invalid-feedback" role="alert"></span>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">Contact Person : <span class="span-mandatory">*</span></label>
							    <div class="col-sm-9">
							    	 <div class="form-group">
						                  <input type="text" name="contact_person" class="form-control">
						                  <span class="invalid-feedback contact_person" role="alert"></span>
						              </div>    
	                                <span class="invalid-feedback" role="alert"></span>
							    </div>
							  </div>
						</div>
                    </form>

                    <br>
	                    <center>
	                    	<div style="display: none" id="buttonAction">
	                    		<a  href="{{ $url }}" class="btn btn-warning">CANCEL</a>
	                        	<button class="btn btn-success" id="btnUpdate" type="button"  onclick="updateRecProcess()"><i class="fa fa-save"></i> SAVE </button>
	                    	</div>
	                    </center>
                  </div>





	             	</div>
	          
                </div>  <!-- END CARD BODY -->
            </div><!-- END CARD -->
        </div>
    </div>


</div>

                        

@endsection

@section('js')
    @include('backend.rec_process.js_rec_process')
<script type="text/javascript">
	var proc= '{{ (empty($_GET['process']))  ? "" : $_GET['process'] }}';
	var job_id= '{{ (empty($_GET['job_id']))  ? "" : $_GET['job_id'] }}';
	var candidate_id = '{{ Request::segment(3) }}'; 
	var status = '{{ (empty($_GET['status']))  ? "" : $_GET['status'] }}'; 
	var q = '{{ (empty($_GET['q']))  ? "" : $_GET['q'] }}'; 
	var tot = '{{ (empty($_GET['tot']))  ? "" : $_GET['tot'] }}'; 
	var process = '{{ (empty($_GET['process']))  ? "" : $_GET['process'] }}'; 
	var type = '{{ (empty($_GET['type']))  ? "" : $_GET['type'] }}'; 

	
	changeEditProc(proc);
	function get_call_video(e)
	{
		if($(e).val() =='video_call' )
		{
			$('#video_call').show();
			$('#on_office').hide();
			$('#invitation_process').hide();
		}	
		else
		{
			$('#video_call').hide();
			$('#on_office').show();
			$('#invitation_process').show();
		}
	}
</script>
@endsection
