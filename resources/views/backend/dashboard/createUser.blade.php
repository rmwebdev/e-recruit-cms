@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-plus"></i> Entry Data
                    
                </div>

                <div class="card-body">
                  	<div class="section">

	                  	
                  	  <form id="formCreateUser">
						  <div class="form-group row">
						    <label for="" class="col-sm-3 col-form-label">NIP : </label>
						    <div class="col-sm-9">
						    	<input type="text" class="validate form-control" id="nip" required="required" name="nip" size="100" value="" >
 								<i class="invalid-feedback" role="alert"></i>  
						    </div>
						  </div>
						  <div id="others">
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">NAME <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
									<input type="text" class="validate form-control" id="name" required="required" name="name" size="100" value="" >
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">ROLE <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
							    	<select name="level_user" class="form-control">
							    		<option value="superadmin">Superadmin</option>
							    		<option value="admin">Admin</option>
							    		<option value="user">User</option>
							    	</select>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">EMAIL <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
							    	<input name="email" type="text" required="required" class="form-control datepickerJoinDate" id="email">
									<i class="invalid-feedback date_process_validate" role="alert"></i>
							    </div>
							  </div>  


							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">ADDRESS : </label>
							    <div class="col-sm-9">
							    	<textarea class="form-control" id="address" name="address" ></textarea>
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">MOBILE NUMBER : </label>
							    <div class="col-sm-9">
							    	<input type="text" class="validate form-control number_valid"  id="hp" name="hp" size="100" value="" placeholder="Mobile Number 1">
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">EFFECTIVE DATE <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
							    	<input name="effective_date" type="text" readonly class="form-control date_effective" required="required" id="date_process_others">
									<i class="invalid-feedback date_process_validate" role="alert"></i>
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">END DATE <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
							    	<input name="end_date" type="text" readonly class="form-control date_end" required="required" id="date_process_others">
									<i class="invalid-feedback date_process_validate" role="alert"></i>
							    </div>
							  </div> 
						</div>

                    	<br>
	                    <center>
	                    	<div id="buttonAction">
	                    		<a href="{{url('rec-process')}}" class="btn btn-waring">CANCEL</a>
	                        	<button class="btn btn-success" id="btnUpdate" type="submit" ><i class="fa fa-save"></i> SAVE </button>
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
		$('.date_end').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
		$('.date_effective').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
	</script>
    @include('backend.dashboard.js_dashboard')
@endsection

