@extends('layouts.app')

@section('style')
<style>
.dataTables_filter{

  width:400px;
  font-size:20px;
}
</style>
@endsection

@section('content')
@php 
    $user = json_encode(Session::get('role'));
@endphp 
<div class="container" style="">
    <div class="row">

        <div class="col-md-12">
            <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
                    <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900">  NON EMPLOYEE </h3>   
                </div>
              </div>
              <div class="pull-right"> 
<!-- 
                <a class="btn bg-ungu"  href="{{url('dashboard-outsource')}}" style="color: #fff" target="_blank"> DASHBOARD
                </a> -->
                @php
                $role = \DB::table('e_recruit.roles')
                ->where('id', Auth::user()->role_id)
                ->get();
                @endphp
                <a class="btn bg-ungu"  href="{{url('candidate-regis/form_return_candidate')}}" style="color: #fff"><i class="fa fa-edit"></i> FORM PENGEMBALIAN
                </a>
                @if($role[0]->name == 'Super User' || $role[0]->name == 'Admin HR' || $role[0]->name == 'Subco')
                {{-- @if($role[0]->name == 'Subco') --}}
                <a class="btn bg-ungu"  href="{{url('create-candidate-outsource')}}" style="color: #fff"><i class="fa fa-plus"></i>  ADD NON EMPLOYEE
                </a>
                @endif
                
              </div>
                
            </nav>
            <div class="card mt-2">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        
                          <div class="col-3 pull-right">
                            <!-- <input type="text" name="search_" id="search_" class="form-control" placeholder="Search ...." >  -->
                          </div>
                         <table style="font-size:12px" id="tableCandidateRegis" class="table table-bordered table-striped mdl-data-table " id="grid-job-registration">
                            <thead>
                                <tr align="center" style="font-weight:bold;" >
                                    <th>NO</th>             
                                    <th>REQUEST NUMBER</th>
                                    <th>NAME</th>
                                    <th>POSITION NAME</th>
                                    <th>JOIN DATE</th>
                                    <th>END DATE</th>
                                    <th>CONTRACT PERIODE</th>
                                    <th>SALARY</th>
                                    <th>SUPERVISOR</th>
                                    <th>PROJECT NAME</th>
                                    <th>ENTITI</th>
                                    <th>WORK LOCATION</th>
                                    <th>PT OS</th>
                                    <th>EMPLOYEE TYPE</th>
                                    <th>DESC BENEFIT</th>
                                    <th>BENEFIT</th>
                                    <th>NO KTP</th>
                                    <th>NO NPK</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr align="center" style="font-weight:bold">
                                    <th>NO</th>            
                                    <th>REQUEST NUMBER</th>
                                    <th>NAME</th>
                                    <th>POSITION NAME</th>
                                    <th>JOIN DATE</th>
                                    <th>END DATE</th>
                                    <th>CONTRACT PERIODE</th>
                                    <th>SALARY</th>
                                    <th>SUPERVISOR</th>
                                    <th>PROJECT NAME</th>
                                    <th>ENTITI</th>
                                    <th>WORK LOCATION</th>
                                    <th>PT OS</th>
                                    <th>EMPLOYEE TYPE</th>
                                    <th>DESC BENEFIT</th>
                                    <th>BENEFIT</th>
                                    <th>NO KTP</th>
                                    <th>NO NPK</th>
                                    <th>STATUS</th>
                             
                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal   Upload -->



<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document"  style="width:50%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Candidate</h5>
        <button type="button" class="close" onclick="closeModalUpload()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div>
            <label for="Create Start Date"> Download : </label>
            <a href="{{asset('uploadcandidate.xlsx')}}" target="_blank"> Template </a> 
         </div>
         <label for="Create Start Date" class="col-sm-2 col-form-label"> FILE :</label>
            <form id="form-upload-candidate">
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="file_upload">
                  <span class="invalid-feedback" role="alert"></span>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModalUpload()" >Close</button>
        <button type="button" class="btn btn-primary" onclick="uploadCandidate()">Upload</button>
      </div>
    </div>
  </div>
</div>


<!-- end Modal -->


@endsection

@section('js')
    @include('backend.candidate_regis.js_candidate_regis')
@endsection
