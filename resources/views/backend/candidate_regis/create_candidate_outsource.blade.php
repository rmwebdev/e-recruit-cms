@extends('layouts.app')

@section('content')
<style type="text/css">
	.select2-container .select2-selection--single{
		width: 100%;
	}
</style>
<div class="container" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
        	<nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
	          <div class="row">
	            <div class="col-12">
	                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> FORM PENYERAHAN TENAGA KERJA </h3>   
	            </div>
	          </div>
	        </nav>
	        
            <div class="card mt-3">
                <div class="card-body" style="background-color: #f0f0f0">
                  	<div class="section">
	                  	<form id="form-fptk-outsource">

						<div class="form-row"> <!-- This DIV FORM -->
							<div class="col-md-12">  <!-- Left Form  --->
								<h6 class="color-ungu"> <strong> PIHAK YANG MENYERAHKAN (PERUSAHAAN OUTSOURCE)</strong> </h6>
								<div class="form-group">
								    <label for="exampleInputEmail1"> NAMA</label>
									<input type="text" name="position_name" class="form-control" placeholder="nama">
									<span class="invalid-feedback" role="alert"></span>
								</div>
							  	<div class="form-group">
							    	<label for="exampleInputPassword1">JABATAN</label>
									<input type="text" name="request_reason" class="form-control" placeholder="jabatan">
									<span class="invalid-feedback" role="alert"></span>
							  	</div>
							  	<div class="form-group">
								    <label for="exampleInputEmail1">NAMA PERUSAHAAN OUTSOURCE</label>
									<input type="text" name="requested_staff"  class="form-control number_valid_char" placeholder="nama perusahaan outsource">
									<span class="invalid-feedback" role="alert"></span>
								</div>
							  	<div class="form-group">
							    	<label for="exampleInputPassword1">TANGGAL REQUEST</label>
									<input type="text" name="work_location" class="form-control" placeholder="tanggal request">
									<span class="invalid-feedback" role="alert"></span>
							  	</div>
							  	<div class="form-group">
								    <label for="exampleInputEmail1">TANGGAL SERAH TERIMA KARYAWAN</label>
									<input type="text" name="project_name"  class="form-control" placeholder="tanggal serah terima karyawan">
									<span class="invalid-feedback" role="alert"></span>
								</div>
						    </div>
						    <!-- End left form -->
						</div>
                	</div>
				<div style="clear:both"></div>
            </div>
        </div>

{{-- 
        <div class="card mt-1">
            <div class="card-body" style="background-color: #f0f0f0">
              	<div class="section">
					<div class="form-row"> <!-- This DIV FORM -->
					    <div class="col-md-12">  <!-- Left Form  --->
				    		<div class="form-group">
						    	<label for="exampleInputPassword1">Dengan ini menyerahkan karyawan outsource dengan data sebagai berikut : </label>
						  	</div>
						  	<div>
						  		<table class="table table-stripped">
						  			<tr>
						  				<td>Nomor FPTK</td>
										<td>Requester</td>
										<td>Nama karyawan</td>
										<td>Posisi</td>
										<td>Nama Project</td>
										<td>Divisi</td>
										<td>Nama PT OS</td>
										<td>Entiti (Cost Center)</td>
										<td>Lokasi kerja</td>
										<td>Gaji</td>
										<td>Join Date</td>
										<td>Supervisor</td>
										<td>End date </td>
										<td>Periode Kontrak</td>
						  			</tr>
						  			<tr>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  				<td><input type="text" name="" class="form-control"></td>
						  			</tr>
						  		</table>
						  	</div>
					    </div>
					    <!-- End left form -->   
					</div>
            	</div>
			<div style="clear:both"></div>
		
        </div>
    </div> --}}
    </div>
  </div>
</div>


<div class="container mt-1" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
                    <h4 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Dengan ini menyerahkan karyawan outsource dengan data sebagai berikut: </h4>   
                </div>
              </div>
               <a data-toggle="collapse" data-target="#candidate_entry_data">
                  <img id="image_bottom_form"  style="display: none" src="{{asset('images/icon_drop.png')}}">
                  <img id="image_top_form" src="{{asset('images/icon_top.png')}}">
                </a> 

             {{--    <a data-toggle="collapse" data-target="#candidate_form" id="telo"><i class="fa fa-plus"></i>
                </a> --}}
            </nav>
        </div> 
    </div>
</div>

<div class="container mt-1 collapse show" id="candidate_entry_data"  style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                @php 
                  $candidate_id = Request::segment(2);
                @endphp 
                <div class="card-body">
                  <form id="form-candidate-step-3">
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Nomor FPTK </label>
                            <input class="form-control" type="text" name="nama"  id="nama" readonly  value="{{$_GET['request_job_number']}}">
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>


                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Posisi </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div> 

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Nama Project </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Divisi </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Nama PT OS </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Entiti (Cost Center) </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Lokasi kerja </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Gaji </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Join Date </label>
                            <input class="form-control datepicker" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>


                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Supervisor </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>


                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> End date  </label>
                            <input class="form-control" type="text" name="end_date"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Periode Kontrak  </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>
                    </div>

                    <hr style="border-top: 4px solid rgba(0, 0, 0, 0.1);">

                     <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Nomor FPTK </label>
                            <input class="form-control" type="text" name="nama"  id="nama" readonly value="{{$_GET['request_job_number']}}">
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>


                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Posisi </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div> 

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Nama Project </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Divisi </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Nama PT OS </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Entiti (Cost Center) </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Lokasi kerja </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Gaji </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Join Date </label>
                            <input class="form-control datepicker" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>


                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Supervisor </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>


                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> End date  </label>
                            <input class="form-control" type="text" name="end_date"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label  font-14"> Periode Kontrak  </label>
                            <input class="form-control" type="text" name="nama"  id="nama" >
                            <i class="invalid-feedback" role="alert"></i>                                 
                          </div>
                        </div>
                    </div>
                  </form>

                </div>  <!-- END CARD BODY -->
                <div class="card-footer" style="background-color: #f0f0f0">
					<center>
						<button type="button" class="btn btn-primary"  onclick="saveTenagaKerja()">SAVE</button>
						<a href="{{url('create-fptk-outsource')}}" class="btn btn-default">CANCEL</a>
					</center>	
				</div>
            </div><!-- END CARD -->
        </div>
    </div>
</div>

@endsection


@section('js')
    @include('backend.candidate_regis.js_candidate_regis')

@endsection
