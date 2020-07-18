@extends('layouts.app')

@section('content')
<style type="text/css">
  .select2-container .select2-selection--single{
    width: 100%;
  }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-plus"></i> Entry Data
                    
                </div>

                <div class="card-body">
                  	<div class="section">

	                  	
                  	  <form id="form-update-user">
                  	  	@csrf
						  <div class="form-group row">
						    <label for="" class="col-sm-3 col-form-label">NIK : </label>
						    <div class="col-sm-9">
						    	<input type="hidden" name="user_id" value="{{$user->user_id}}">
						    	<input type="text" class="validate form-control" id="nip" required="required" name="nip" size="100" value="{{$user->nip}}" >
 								<i class="invalid-feedback" role="alert"></i>  
						    </div>
						  </div>
						  <div id="others">
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">NAME <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
									<input type="text" class="validate form-control" id="name"  required="required" name="name" size="100" value="{{$user->name}}" >
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">EMAIL <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
									<input type="text" class="validate form-control" id="email_user"  required="required" name="email_user" size="100" value="{{$user->email_user}}" >
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>

							   <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> DIVISION <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<select name="division" class="form-control">
							    		{{$division}}
							    		@foreach($division as $div)
							    			<option value="{{$div->division}}" {{($div->division == $user->division) ? "selected":""}}>{{$div->division}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> DEPARTMENT <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<select name="department" class="form-control">
							    		@foreach($department as $dep)
							    			<option value="{{$dep->department}}" {{($dep->department == $user->department) ? "selected":""}}>{{$dep->department}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>



							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> POSITION <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<select name="position" class="form-control">
							    		@foreach($position as $pos)
							    			<option value="{{$pos->position}}" {{($pos->position == $user->position) ? "selected":""}}>{{$pos->position}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> JOB DESCRIPTION <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<select name="job_desc" class="form-control">
							    		@foreach($job_desc as $jd)
							    			<option value="{{$jd->job_desc}}" {{($jd->job_desc == $user->job_desc) ? "selected":""}}>{{$jd->job_desc}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>




							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> COST CENTER <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<select name="cost_center" class="form-control">
							    		@foreach($cost_center as $cc)
							    			<option value="{{$cc->cost_center}}"  {{($cc->cost_center == $user->cost_center) ? "selected":""}}>{{$cc->cost_center}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> LEADER <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<select name="parent_user" class="form-control">
							    		@foreach($parent_user as $lead)
							    			<option value="{{$lead->name}}"  {{($lead->name == $user->name) ? "selected":""}}>{{$lead->name}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">EMAIL LEADER<span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<input name="email" type="text" required="required" class="form-control datepickerJoinDate" value="{{$user->email}}" id="email">
									<i class="invalid-feedback date_process_validate" role="alert"></i>
							    </div>
							  </div>  



							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">PASSWORD <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-9">
							    	<input name="text" type="text" required="required" class="form-control" placeholder="Kosongkan jika tidak diubah" id="password">
									<i class="invalid-feedback date_process_validate" role="alert"></i>
							    </div>
							  </div>  


			
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">MOBILE NUMBER : </label>
							    <div class="col-sm-9">
							    	<input type="text" class="validate form-control number_valid"  id="hp" value="{{$user->hp}}" name="hp" size="100" value="" placeholder="Mobile Number 1">
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>

						</div>

                    	<br>
	                    <center>
	                    	<div id="buttonAction">
	                        	<button class="btn btn-success" id="btnUpdate" type="submit" ><i class="fa fa-save"></i> UPDATE </button>
	                        	<a href="{{url('index_user')}}" class="btn btn-waring">CANCEL</a>
	                    	</div>
	                    </center>
					</form>


					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
	<script type="text/javascript">
		$(function (){
			$('[name="department"]').select2();
            $('[name="division"]').select2();
            $('[name="cost_center"]').select2();
            $('[name="job_desc"]').select2();
            $('[name="position"]').select2();
            $('[name="parent_user"]').select2();
		})

		$('#form-update-user').submit(function(event){
		    event.preventDefault(); //prevent default action 	        
		    var dataUser =  new FormData($("#form-update-user")[0]);
		    $.ajax({
	            url:'/setting-user/update_user/'+$('[name="user_id"]').val(),
	            type:'POST',
	            data:dataUser,
	            dataType: "json",
	            success:function(data)
	            {   
	                swal('Success','Data berhasil di ubah','success')
	                  .then(function(){
	                      $(location).attr('href','/index_user');    
	                  });
	            },
	              cache:false,
	              contentType:false,
	              processData:false,
	        }).fail(function(data){
	          var dt = data.responseJSON;
	          if(dt.errors)
	          {   
	              $.each(dt.errors, function (key, value) {
	                  var input = '[name=' + key + ']';
	                  
	                  $(input + '+span').html('<strong>'+ value +'</strong>');
	                  $(input).addClass('is-invalid');
	                  $(input).focus();
	                  $(input).change(function(){
	                      $(input).removeClass('is-invalid');
	                  })
	              });                
	          }
	        }); 
	    })
	</script>
	</script>
@endsection

