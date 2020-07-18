@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-plus"></i> Change Password
                    
                </div>

                <div class="card-body">
                  	<div class="section">

	                  	
                  	  <form id="form_change_password">
						  <div id="others">
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label">  Old Password <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
									<input type="password" class="validate form-control" id="old_password" required="required" name="old_password" size="100" value="" >
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> New Password <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
							    	<input type="password" class="validate form-control" id="new_password" required="required" name="new_password" size="100" value="" >
									<i class="invalid-feedback" role="alert"></i>
							    </div>
							  </div>

							  <div class="form-group row">
							    <label for="" class="col-sm-3 col-form-label"> Confirm Password <span class="span-mandatory">*</span> : </label>
							    <div class="col-sm-9">
							    	<input name="confirm_password" type="password" required="required" class="form-control datepickerJoinDate" id="confirm_password">
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

