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

	                  	
                  	  <form id="form-create-user">
						  <div class="form-group row">
						    <label for="" class="col-sm-3 col-form-label">NIK <span class="span-mandatory">*</span></label>
						    <div class="col-sm-8">
						    	<input type="text" class="validate form-control" id="nip" required="required" name="nip" placeholder="NOMOR INDUK KARYAWAN" size="100" value="" >
 								<i class="invalid-feedback" role="alert"></i>  
						    </div>
						  </div>

						  <div id="others">
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">NAME <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
									<input type="text" class="validate form-control" id="name" placeholder="NAME" required="required" name="name" size="100" value="" >
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">EMAIL<span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<input name="email_user" type="text" required="required" class="form-control" placeholder="EMAIL USER" id="email">
									<i class="invalid-feedback date_process_validate" role="alert"></i>
							    </div>
							  </div>  


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> DIVISION <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<select name="division" class="form-control" style="width: 700px" required>
							    		<option value="">  Select Division </option>
							    		@foreach($division as $div)
							    			<option value="{{$div->division}}">{{$div->division}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> DEPARTMENT <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<select name="department" class="form-control"  style="width: 700px" required>
							    		<option value="">  Select Department </option>
							    		@foreach($department as $dep)
							    			<option value="{{$dep->department}}">{{$dep->department}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>



							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> POSITION <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<select name="position" class="form-control"  style="width: 700px" required>
							    		<option value="">  Select Position </option>
							    		@foreach($position as $pos)
							    			<option value="{{$pos->position}}">{{$pos->position}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> JOB DESCRIPTION <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<select name="job_desc" class="form-control"  style="width: 700px" required>
							    		<option value="">  Select Job Description </option>
							    		@foreach($job_desc as $jd)
							    			<option value="{{$jd->job_desc}}">{{$jd->job_desc}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>




							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> COST CENTER <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<select name="cost_center" class="form-control"  style="width: 700px" required>
							    		<option value="">  Select Cost Center </option>
							    		@foreach($cost_center as $cc)
							    			<option value="{{$cc->cost_center}}">{{$cc->cost_center}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>




							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> LEADER <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<select name="parent_user" class="form-control"  style="width: 700px" required>
							    		<option value="">  Select Leader </option>
							    		@foreach($parent_user as $lead)
							    			<option value="{{$lead->nip}}">{{$lead->name}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>




							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">EMAIL LEADER<span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<input name="email" type="text" required="required" class="form-control" placeholder="EMAIL LEADER" id="email">
									<i class="invalid-feedback date_process_validate" role="alert"></i>
							    </div>
							  </div>  




							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">PASSWORD <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<input name="password" type="text" required="required" class="form-control" placeholder="PASSWORD" id="password">
									<i class="invalid-feedback date_process_validate" role="alert"></i>
							    </div>
							  </div>  


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">MOBILE NUMBER <span class="span-mandatory">*</span></label>
							    <div class="col-sm-8">
							    	<input type="text" class="validate form-control number_valid"  id="hp" name="hp" size="100" value="" placeholder="No Hp">
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>
							  
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> ROLE USER <span class="span-mandatory">*</span> </label>
							    <div class="col-sm-8">
							    	<select name="role_user" class="form-control" style="width: 700px" required>
							    		<option value="">  Select Role </option>
							    		@foreach($role as $role)
							    			<option value="{{$role->id}}">{{$role->name}}</option>
							    		@endforeach
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>

						
						</div>

                    	<br>
	                    <center>
	                    	<div id="buttonAction">
	                        	<button class="btn btn-success" id="btnUpdate" type="submit" ><i class="fa fa-save"></i> SAVE </button>
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

	$('#form-create-user').submit(function(event){
		    event.preventDefault(); //prevent default action 	        
		   	var dataUser =  new FormData($("#form-create-user")[0]);
		    $.ajax({
	            url:'{{url('setting-user/store/')}}',
	            type:'POST',
	            dataType: "json",
	            data:dataUser,
	            headers: {
		                'X-CSRF-TOKEN': '{{ csrf_token() }}'
		        },
	            success:function(data)
	            {   
	                swal('Success','Data berhasil di simpan','success')
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
	                  
	                  $(input + '+i').html('<strong>'+ value +'</strong>');
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
@endsection

