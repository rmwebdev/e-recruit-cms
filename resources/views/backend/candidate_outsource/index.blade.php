@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
                    <h4 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> FPTK NON EMPLOYEE </h4>   
                </div>
              </div>
                 <a class="btn bg-ungu pull-right pl-5 pr-5"  href="{{route('add-fptk-resource')}}" style="color: #fff"><i class="fa fa-plus"></i> ADD FPTK
                </a>
            </nav>
        </div>
    </div>
</div>

<div class="container mt-3" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                         <table style="font-size:12px" id="table-fptk-outsource" class="table table-striped mdl-data-table">
                            <thead>
                                <tr align="center" style="font-weight:bold;" >
                                    <th>NO</th>             
                                    <th>REQUEST NUMBER</th>
                                    <th>POSITION NAME</th>
                                    <th>REQUESTER NAME</th>
                                    <th>REQUEST REASON</th>
                                    <th>REQUEST STAFF</th>
                                    <th>JOIN STAFF</th>
                                    <th>WORK LOCATION</th>
                                    <th>PROJECT NAME</th>
                                    <th>REQUIRED DATE</th>
                                    <th>EMPLOYEE TYPE</th>
                                    <th>STATUS</th>
                                    <!-- <th>ASSESSMENT</th> -->
                                    <th>ACTION</th>
                                    <th>SUBCO</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
    @include('backend.candidate_outsource.js_candidate_outsource')
@endsection