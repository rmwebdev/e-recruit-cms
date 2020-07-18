@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">

    @php
    $role = \DB::table('e_recruit.roles')
    ->where('id', Auth::user()->role_id)
    ->get();
    @endphp

    @if($role[0]->name == 'Super User' || $role[0]->name == 'Admin HR' || $role[0]->name == 'Subco' )
    <nav class="navbar bg-white mb-2" style="height: 55px;border-radius: 5px;">
      <a class="btn bg-ungu pull-right"  href="{{url('rec-process/view_all?status=Registered&q=all_registered&tot='.$registered.'&type=view-all')}}" style="color: #fff"> ALL CANDIDATE
      </a>
    </nav>
    @endif
    {{-- ori 
    <nav class="navbar bg-white mb-2" style="height: 55px;border-radius: 5px;">
      <a class="btn bg-ungu pull-right"  href="{{url('rec-process/view_all?status=Registered&q=all_registered&tot='.$registered.'&type=view-all')}}" style="color: #fff"> ALL CANDIDATE
      </a>
    </nav>
    --}}

      <form id="search_lowongan">
        <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
                <input type="text" class="form-control" placeholder="Cari job berdasarkan lowongan" name="s" value="{{(isset($_GET['s'])) ?  $_GET['s'] :""}}"  aria-label="Username" aria-describedby="basic-addon1" style="width: 270px">
            <div class="pull-right">
              <div class="row">
                <div class="row pr-5">
                    <label class="label-control  pr-2">Filter</label>
                    <select class="form-control" name="filter" style="width:155px;background-color: #f2f2f2">
                      <option value="all" {{ (isset($_GET['filter']) && $_GET['filter'] == 'all'  ) ? "selected"  : ""}} >All</option>
                      <option value="published" {{ (isset($_GET['filter']) && $_GET['filter'] == 'published'  ) ? "selected"  : ""}} >Published</option>
                      <option value="save_draft" {{ (isset($_GET['filter']) && $_GET['filter'] == 'save_draft'  ) ? "selected"  : ""}} >Saved Draft</option>
                      <option value="complete" {{ (isset($_GET['filter']) && $_GET['filter'] == 'complete'  ) ? "selected"  : ""}} >Complete</option>
                    </select>
                </div>
                <div class="row  pr-5">
                    <label class="label-control pr-2">Sort By</label>
                    <select class="form-control" name="sort_by"  style="width:155px;background-color: #f2f2f2">
                      <option value="" > - SELECT SORT -  </option>
                      <option value="APPLY" {{ (isset($_GET['sort_by']) && $_GET['sort_by'] == 'APPLY'  ) ? "selected"  : ""}}>Most Apply</option>
                      <option value="HIRED" {{ (isset($_GET['sort_by'] )  && $_GET['sort_by'] == 'HIRED'  ) ? "selected"  : ""}}>Most Hired</option>
                      <option value="CV IN" {{ (isset($_GET['sort_by'] )  && $_GET['sort_by'] == 'CV IN'  ) ? "selected"  : ""}}> Most CV IN </option>
                    </select>
                </div>
                <div class="row  pr-5" style="font-weight: 900;font-size: 16px">
                    {{count($count_data)}} POST  
                </div>
              </div>
            </div>
          </nav>
 
          @if(auth()->user()->can('job-summary'))
          <div class="card bg-white" style="border-radius: 5px;">
            <div class="card-body row">
            
              <div class="col-md-12">
                <div class="row">
                  <span href=""  class="color-ungu">
                    <div class="col-md-12">
                      <h2 class="font-abu" style="font-weight:normal !important;"> JOB SUMMARY  : </h2>                
                    </div>
                  </span>
                </div>
              </div>
            </div>
            <div class="card-body row">
     
              <div class="col-md-2">
                <a class="color-ungu">
                  <div class="col-md-12">
                    <h5> Job Publish </h5>
                    <h1>{{$released}}</h1>
                  </div>
                </a>
              </div>  
              <div class="col-md-2">
                <a href="{{route('rec-process.view_all',['status'=>'Registered','q'=>'registered','tot'=>$registered,'type'=>'view-all'])}}"  class="color-ungu">
                  <div class="col-md-12">
                    <h5> Registered </h5>
                    <h1>{{$registered}}</h1>
                  </div>
                </a>
              </div> 
              <div class="col-md-2">
                <a href="{{route('rec-process.view_all',['status'=>'Consider','q'=>'consider','tot'=>$consider,'type'=>'view-all'])}}"  class="color-ungu">
                  <div class="col-md-12">
                    <h5> Consider </h5>
                    <h1>{{$consider}}</h1>
                  </div>
                </a>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-3">
                    <a href="{{route('rec-process.view_all',['status'=>'Applied','q'=>'cv_in_all','tot'=>$cv_in_all,'type'=>'view-all'])}}"  class="color-ungu">
                      <h5> Applied </h5>
                      <h1> {{ $cv_in_all }}</h1>
                    </a>
                  </div>
                  <div class="col-md-3">
                    <a href="{{route('rec-process.view_all',['status'=>'Invited','q'=>'invited_all','tot'=>$invited_all,'type'=>'view-all'])}}"  class="color-ungu">
                      <h5> Invited </h5>
                      <h1> {{ $invited_all }} </h1>
                    </a>
                  </div>
                  <div class="col-md-3">
                    <a href="{{route('rec-process.view_all',['status'=>'Hired','q'=>'hired_all','tot'=>$hired_all,'type'=>'view-all'])}}"  class="color-ungu">
                      <h5> Hired </h5>
                      <h1> {{ $hired_all }} </h1>
                    </a>
                  </div> 
                  <div class="col-md-3">
                    <a href="{{route('rec-process.view_all',['status'=>'Not Suitable','q'=>'failed_all','tot'=>$failed_all,'type'=>'view-all'])}}"  class="color-ungu">
                      <h5> Not Suitable </h5>
                      <h1>  {{ $failed_all }} </h1>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif

          </form>                




          @foreach($getData as $dt)
          <div class="card mt-3 bg-white" style="border-radius: 5px;">
            <div class="card-body row">
              <div class="col-md-7">
                <h5 class="font-weight-500 font-16"> <a href="{{route('detail-rec-process',['status'=>'cv_in','id'=>$dt->job_fptk_id,'type'=>'rec-dash'])}}" class="color-ungu font-weight-500"> {{strtoupper($dt->position_name)}} </a> - {{ucfirst($dt->status)}} </h5>
                <h6 class="font-abu" style="font-weight:normal !important;">Post Received {{tanggal_indo_lengkap($dt->received_date_fptk)}} </h6>
                <div class="mb-2">
                  <i style="color: #d0d0d0;">Requester : {{$dt->requester_name}}</i>
                </div>
                <h6 class="color-ungu" style="font-weight:normal !important;">
                  <a href="job-regis/edit_job_regis/{{$dt->request_job_number}}" style="a:link=color:#4b4b4b"> 
                    <i class="fa fa-eye"></i> View Job Specification 
                  </a>
                </h6>
                
              </div>
               @php
                  $search = isset($_GET['s']) ? $_GET['s'] : '';
                  $apply =  \App\Models\Candidate::
                  where('job_fptk_id',$dt->job_fptk_id)
                  ->whereNotNull('job_fptk_id')
                  ->get(); 

                  $cv_in =  \App\Models\Candidate::
                  where('job_fptk_id',$dt->job_fptk_id)
                  ->where('process','ilike','%CV IN%')
                  ->get();

                  $invited =  \App\Models\Candidate::
                  where('job_fptk_id',$dt->job_fptk_id)
                  ->where('process','ilike','%CALLED%')
                  ->get();

                  $hired =  \App\Models\Candidate::
                  where('job_fptk_id',$dt->job_fptk_id)
                  ->where('process','ilike','%HIRED%')
                  ->get();

                  $failed =  \App\Models\Candidate::
                  where('job_fptk_id',$dt->job_fptk_id)
                  ->where('result','=','FAILED')
                  ->get();

              @endphp
              <div class="col-md-5">
              <div class="row">
                <div class="col-md-2">
                  <a href="{{route('detail-rec-process',['status'=>'cv_in','id'=>$dt->job_fptk_id,'type'=>'rec-dash'])}}"  class="color-ungu">
                    <h2> {{ count($cv_in)}} </h2>
                    <span> New CV </span>
                  </a>
                </div> 
                <div class="col-md-2">
                  <a href="{{route('detail-rec-process',['status'=>'cv_in','id'=>$dt->job_fptk_id,'type'=>'rec-dash'])}}"  class="color-ungu">
                    <h2> {{ count($apply)}} </h2>
                    <span> Applied </span>
                  </a>
                </div>
                <div class="col-md-2">
                  <a href="{{route('detail-rec-process',['status'=>'called','id'=>$dt->job_fptk_id,'type'=>'rec-dash'])}}"  class="color-ungu">
                    <h2> {{ count($invited)}} </h2>
                    <span> Invited </span>
                  </a>
                </div>
                <div class="col-md-2">
                  <a href="{{route('detail-rec-process',['status'=>'hired','id'=>$dt->job_fptk_id,'type'=>'rec-dash'])}}" class="color-ungu">
                    <h2> {{ count($hired)}} </h2>
                    <span> Hired </span>
                </div> 
                <div class="col-md-3">
                  <a href="{{route('detail-rec-process',['status'=>'failed','id'=>$dt->job_fptk_id,'type'=>'rec-dash'])}}"  class="color-ungu">
                    <h2> {{ count($failed)}} </h2>
                    <span> Not Suitable </span>
                  </a>
                </div>
              </div>
              </div>
            </div>
          </div>
          @endforeach
          @php
            $filter = (!isset($_GET['filter'])) ? "" : $_GET['filter'];
            $sort_by = (!isset($_GET['sort_by'])) ? "" : $_GET['sort_by'];
          @endphp
          <div class="mt-3 pull-right">
            {{ $getData->appends(['s'=>$search,'filter'=>$filter,'sort_by'=>$sort_by])->links() }}
          </div>

        </div>
    </div>
</div>



<!-- Modal Reinvited -->
<div class="modal fade" id="modalReInvited" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 70%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="" style="font-weight: bold">Date Time</h5>
        </div>
        <div class="modal-body">
           <form class="form-reschedule" id="form-reschedule">
              <input type="hidden" name="history_id">
              <div class="form-label-group">
                <label for="inputEmail">Date Time</label>
                <input type="text" class="form-control" name="date_process_reinvited" placeholder="Date Time" autofocus>
                <span class="invalid-feedback" id="date_process" role="alert"></span>
              </div>
           
        </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="btn_send_time" onclick="send_reschedule_time()">Submit</button>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection

@section('js')
    @include('backend.rec_process.js_rec_process')
    <script type="text/javascript">
      $('[name="sort_by"]').change(function(){
        $('#search_lowongan').submit();
      })

      $('[name="filter"]').change(function(){
        $('#search_lowongan').submit();
      })
    </script>
@endsection
