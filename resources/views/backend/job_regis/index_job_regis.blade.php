@extends('layouts.app')

@section('content')
<style type="text/css">
[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #2f318b;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #2f318b;
    position: absolute;
    top: 4px;
    left: 3px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar bg-white mb-2" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
                    <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> JOB REGISTERED  </h3>   
                </div>
              </div>
            </nav>

            <div class="card bg-abu-putih" style="border-radius: 5px;">
              <div class="row ml-5 mt-2">
                <div>
                    <input type="radio" id="test1" name="radio-group" checked onchange="change_radio(1)">
                    <label for="test1" class="mr-4"> <b> FPTK </b></label>
                </div>
                <div>
                  <input type="radio" id="test2" name="radio-group" onchange="change_radio(2)">
                  <label for="test2"><b>Man Power</b></label>
                </div>
              </div>


              <div class="card-body row"  id="row-1">

                <div class="col-3 ml-3" style="max-width: 215px;height:74px;">
                  <div class="card" style="border-radius: 5px;">
                    <div class="box bg-biru text-center" style="cursor: pointer;" onclick="getData()">
                          <h6 style="margin-top:10px"> TOTAL REQUEST</h6>
                          <h6>{{$total_req_fptk}}</h6>
                      </div>
                  </div>
                </div>

                <div class="col-3" style="max-width: 215px;height:74px;">
                      <div class="card"  style="border-radius: 5px;">
                        <div class="box bg-merah text-center"   style="cursor: pointer;" onclick="GetStatus('open')">
                              <h6 style="margin-top:10px"> OPEN</h6>
                              <h6>{{$open}}</h6>
                          </div>
                      </div>
                </div>

                <div class="col-3" style="max-width: 215px;height:74px;">
                      <div class="card"  style="border-radius: 5px;">
                          <div class="box bg-hijau text-center"    style="cursor: pointer;" onclick="GetStatus('closed')">
                              <h6 style="margin-top:10px">CLOSED</h6>
                              <h6>{{$closed}}</h6>
                          </div>
                      </div>
                </div>

                <div class="col-3" style="max-width: 215px;height:74px;">
                      <div class="card"  style="border-radius: 5px;">
                        <div class="box bg-kuning text-center"    style="cursor: pointer;" onclick="GetStatus('drop')">
                              <h6 style="margin-top:10px">DROP</h6>
                              <h6>{{$drop}}</h6>
                          </div>
                      </div>
                </div>

                <div class="col-3" style="max-width: 215px;height:74px;">
                      <div class="card"  style="border-radius: 5px;">
                          <div class="box bg-abu text-center"   style="cursor: pointer" onclick="GetStatus('rejected')">
                              <h6 style="margin-top:10px">REJECTED</h6>
                              <h6>{{$rejected}}</h6>
                          </div>
                      </div>
                </div>              

              </div>


              <div class="card-body row" id="row-2" style="display: none">

                 <div class="col-3  ml-3"  style="max-width: 215px;height:74px;">
                    <div class="card"  style="border-radius: 5px;">
                      <div class="box bg-biru text-center">
                            <h6  style="margin-top:10px"> TOTAL REQUEST</h6>
                            <h6>{{$total_request_staff}}</h6>
                        </div>
                    </div>
                  </div>

                  <div class="col-3"  style="max-width: 215px;height:74px;">
                        <div class="card"  style="border-radius: 5px;">
                          <div class="box bg-merah text-center">
                                <h6  style="margin-top:10px"> OPEN</h6>
                                <h6>{{$open_staff}}</h6>
                            </div>
                        </div>
                  </div>
                  <div class="col-3"  style="max-width: 215px;height:74px;">
                        <div class="card"  style="border-radius: 5px;">
                            <div class="box bg-hijau text-center">
                                <h6  style="margin-top:10px">CLOSED</h6>
                                <h6>{{$closed_staff}}</h6>
                            </div>
                        </div>
                  </div>

                  <div class="col-3"  style="max-width: 215px;height:74px;">
                        <div class="card"  style="border-radius: 5px;">
                          <div class="box bg-kuning text-center">
                                <h6  style="margin-top:10px">DROP</h6>
                                <h6>{{$drop_staff}}</h6>
                            </div>
                        </div>
                  </div>

                  <div class="col-3"  style="max-width: 215px;height:74px;">
                        <div class="card"  style="border-radius: 5px;">
                            <div class="box bg-abu text-center">
                                <h6 style="margin-top:10px">REJECTED</h6>
                                <h6>{{$total_request_rejected}}</h6>
                            </div>
                        </div>
                  </div>          

              </div>


            </div>




            <div class="card mt-2">
               {{--  <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-list"></i> Job Registered 
                </div> --}}

                <div class="card-body">
                  <div class="row">        
                        <div class="col-md-12">
                            <div class="table-responsive">
                                 <table style="font-size:12px" id="tableCandidateRegis" class="table table-bordered table-striped mdl-data-table" id="grid-job-registration">
                                    <thead>
                                        <tr align="center" style="font-weight:bold">
                                            <th>NO</th>        
                                            <th>ACTION</th>    
                                            <th>REQUEST NUMBER</th>
                                            <th>POSITION NAME</th>
                                            <th>STATUS</th>
                                            <th>DROP</th>
                                            <th>PUBLISH</th>
                                            <th>IS CLOSED</th>
                                            <th>KJ</th>
                                            <th>RECRUITMENT TYPE</th>
                                            <th>REQUEST DATE</th>
                                            <th>EFFECTIVE DATE</th>
                                            <th>REQUESTED STAFF</th>
                                            <th>DROP STAFF</th>
                                            <th>ACTUAL STAFF</th>
                                            <th>REQUEST REASON</th>
                                            <th>SLA JOIN DATE</th>
                                            <th>SLA MCU </th>
                                            <th>SLA OFFERING </th>
                                            <th>SLA INTERVIEW HR </th>
                                            <th>SLA INTERVIEW 1 </th>
                                            <th>SLA INTERVIEW 2 </th>
                                            <th>SLA INTERVIEW  3</th>
                                            <th>EMPLOYMENT TYPE</th>
                                            <th>HIRED</th>
                                            <th>WORK LOCATION</th>
                                        </tr>
                                    </thead>

                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  <!-- END CARD BODY -->
            </div><!-- END CARD -->
        </div>
    </div>
</div>


<!-- Modal   Upload -->
<div class="modal fade" id="modalCanSLA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title" id="exampleModalLongTitle"> Detail SLA </h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered"  style="font-size:12px" id="tableCanSLA">
            <thead>
            <tr>
              <td>Request Job Number</td>
              <td>Request Date</td>
              <td>Join Date</td>
              <td>Name Holder</td>
              <td>Position Name</td>
              <td>SLA</td>
            </tr>
            </thead>
            <tbody> 
            </tbody>
          </table>
        </div>
      </div>
  </div>
</div>
<!-- end Modal -->


@endsection

@section('js')
@include('backend.job_regis.js_job_regis')
<script type="text/javascript">
  function change_radio(id)
  {

      if(id == 2)
      {
        $('#row-2').show();
        $('#row-1').hide();   
      }
      else if(id == 1)
      {
        
        $('#row-1').show(); 
        $('#row-2').hide();
      }
  }
</script>

@endsection
