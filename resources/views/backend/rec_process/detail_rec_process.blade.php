@extends('layouts.app')

@section('content')
<style type="text/css">
    
</style>
<div class="container" style="max-width: 1203px">
    <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
      <div class="row">
          <div class="col-12">
            <h4 class="color-ungu  pl-3 mt-1 font-18"> <a href="{{url('rec-process')}}"> <i class="fa fa-arrow-left"></i> </a> {{strtoupper($detail->position_name)}}</h4>
          </div>
      </div>
      @php

      @endphp
      <span class="pull-right font-weight-900" style="font-size: 16px"> 
        <button  class="btn bg-ungu color-white pl-5 pr-5 notification" onclick="showNotification()">
          <span class="badge">{{$data_invitation }}</span>
          NOTIFICATION
        </button>
        </span>
    </nav>

          
    <div class="card mt-3" style="border-radius: 5px;background-color: #f2f2f2;">
      <div class="card-body row">
        <div class="col-12">
              <div class="row">
                  <div class="col-3">
                      <div class="card-hover">
                        <a href="{{route('detail-rec-process',['status'=>'cv_in','id'=>$_GET['id'],'type'=>$_GET['type'] ])}}">
                          <div class="box bg-ungu warna-pudar-05 text-center" id="cv_in"  style="cursor: pointer;">
                              <h5 class="pt-3"> NEW CV  </h5>
                              <h6>{{$cv_in}}</h6>
                          </div>
                        </a>
                      </div>
                  </div>
                  <div class="col-3">
                        <div class="card-hover">
                          <a href="{{route('detail-rec-process',['status'=>'cv_sort','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                            <div class="box bg-ungu warna-pudar-05 text-center"  id="cv_sort"    style="cursor: pointer">
                                <h5 class="pt-3">CV SORT</h5>
                                <h6>{{$cv_sort}}</h6>
                            </div>
                          </a>
                        </div>
                  </div>
      
                  <div class="col-3">
                      <div class="card-hover">
                        <a href="{{route('detail-rec-process',['status'=>'failed','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                          <div class="box  bg-ungu warna-pudar-05 text-center" id="failed"   style="cursor: pointer;">
                              <h5 class="pt-3">NOT SUITABLE</h5>
                                <h6>{{$failed}}</h6>
                          </div>
                        </a>
                      </div>
                  </div>

                  <div class="col-3">
                        <div class="card-hover">
                          <a href="{{route('detail-rec-process',['status'=>'called','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                            <div class="box  bg-ungu warna-pudar-05 text-center" id="called"   style="cursor: pointer;">
                              <h5 class="pt-3">INVITED</h5>
                              <h6>{{$called}}</h6>
                          </div>
                        </a>
                        </div>
                  </div>
                 
              </div><!-- CARD TOP --->

              <div class="row" style="margin-top:13px"> 


                 <div class="col-3">      
                        <div class="card-hover">
                          <a href="{{route('detail-rec-process',['status'=>'psychotest','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                          <div class="box  bg-ungu warna-pudar-05 text-center " id="psychotest"  style="cursor: pointer;">
                              <h5 class="pt-3">PSYCHO TEST</h5>
                              <h6>{{$psychotest}}</h6>
                          </div>
                        </a>
                        </div>
                  </div>

                  <div class="col-3">
                      <div class="card-hover">
                        <a href="{{route('detail-rec-process',['status'=>'initial_in','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                          <div class="box  bg-ungu warna-pudar-05 text-center" id="initial_in"     style="cursor: pointer;">
                              <h5 class="pt-3">INITIAL INTERVIEW</h5>
                              <h6>{{$initial_in}}</h6>
                          </div>
                        </a>
                      </div>
                  </div>

                  <div class="col-3">
                      <div class="card-hover">
                        <a href="{{route('detail-rec-process',['status'=>'interview_1','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                          <div class="box bg-ungu warna-pudar-05 text-center" id="interview_1"     style="cursor: pointer;">
                              <h5 class="pt-3">INTERVIEW 1</h5>
                              <h6>{{$intervew_1}}</h6>
                          </div>
                        </a>
                      </div>
                  </div>
                  <div class="col-3">
                        <div class="card-hover">
                          <a href="{{route('detail-rec-process',['status'=>'interview_2','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                            <div class="box bg-ungu warna-pudar-05 text-center" id="interview_2"   style="cursor: pointer;">
                                <h5 class="pt-3">INTERVIEW 2</h5>
                                <h6>{{$intervew_2}}</h6>
                            </div>
                          </a>
                        </div>
                  </div>
                 
              </div><!-- CARD BOTTOM --->



            <div class="row" style="margin-top:13px"> 
                   <div class="col-3">
                        <div class="card-hover">
                          <a href="{{route('detail-rec-process',['status'=>'interview_3','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                            <div class="box bg-ungu warna-pudar-05 text-center"  id="interview_3"  style="cursor: pointer;">
                                <h5 class="pt-3">INTERVIEW 3</h5>
                                <h6>{{$intervew_3}}</h6>
                            </div>
                          </a>
                        </div>
                  </div>

                  <div class="col-3">
                        <div class="card-hover">
                          <a href="{{route('detail-rec-process',['status'=>'med_check','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                            <div class="box bg-ungu warna-pudar-05 text-center" id="med_check"   style="cursor: pointer;">
                                <h5 class="pt-3">MED CHECK</h5>
                                <h6>{{$med_check}}</h6>
                            </div>
                          </a>
                        </div>
                  </div>
                  <div class="col-3">
                        <div class="card-hover">
                          <a href="{{route('detail-rec-process',['status'=>'offering_letter','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                            <div class="box bg-ungu warna-pudar-05  text-center"  id="offering_letter"  style="cursor: pointer;">
                                <h5 class="pt-3">OFFERING LETTER</h5>
                                <h6>{{$offering_letter}}</h6>
                            </div>
                          </a>
                        </div>
                  </div>
                  <div class="col-3">
                      <div class="card-hover">
                        <a href="{{route('detail-rec-process',['status'=>'hired','id'=>$_GET['id'],'type'=>$_GET['type']])}}">
                          <div class="box  bg-ungu warna-pudar-05  text-center" id="hired"   style="cursor: pointer;">
                              <h5 class="pt-3">HIRED</h5>
                                <h6>{{$hired}}</h6>
                          </div>
                        </a>
                      </div>
                  </div>
              </div><!-- CARD BOTTOM --->
            </div><!-- END COL 12 -->
      </div>
    </div>



<nav class="navbar bg-abu-muda mt-2" style="height: 55px;border-radius: 5px;padding: 0">
    <div class="row">
      <div class="col-sm-12">
         <div class="font-weight-500 font-14" style="background-color: #f2f2f2;padding:10px;  height:36px ;border: solid 1px #cccccc;border-radius: 5px">
            <input type="checkbox" name="select_all" onclick="chekCandidate(this)"> All
          </div>
      </div>
    </div>

    <div class="row">
      <form action="detail-rec-process" id="form_search"> 
       {{--  <div class="col-md-4">
            <label class="label-control font-14"  style="padding-right: 0">SEARH </label>
        </div> --}}
        <div class="col-md-12"style="padding-left: 0">
          <input type="text" name="search_name" id="search_" class="form-control" placeholder="SEARCH ..." >
          <input type="hidden" name="status" id="search_"  value="{{$_GET['status']}}" >
          <input type="hidden" name="id" id="search_"  value="{{$_GET['id']}}" >
          <input type="hidden" name="type" id="search_"  value="{{$_GET['type']}}" >
             {{--  <select class="form-control" name="" style="width:155px;background-color: #f2f2f2">
                <option>Latest</option>
              </select> --}}
        </div>
        </form>
    </div>

</nav>



<nav class="bg-abu-muda mt-2" id="process_candidate" style="height: 55px;border-radius: 5px;padding: 0;display: none;">
  <div class="row">
    <div class="col-3">
        <select class="form-control" name="process" onchange="selectProcess()">
            <option> -- SELECT PROCESS --</option>
            @foreach($process as $st)
                <option value="{{$st->nama}}">{{($st->nama == 'CALLED' ? "INVITED" : $st->nama)}}</option>
            @endforeach
        </select>
    </div> 

    <div class="col-3">
        <button class="btn btn-success" id="btnSend" style="display: none;" onclick="modalSendEmail()"><i class="fa fa-send"></i> Send Email </button>
        <select class="form-control" name="result" style="display: none">
            <option> -- SELECT RESULT --</option>
            @foreach($result as $rs)
                <option value="{{$rs->nama}}">{{$rs->nama}}</option>
            @endforeach
        </select>
        <div class="invalid-feedback result"></div>
    </div> 

    <div class="col-2">
        <input type="text" name="date_process" class="form-control datepicker" autocomplete="off" style="display: none" placeholder="DATE PROCESS">
          <div class="invalid-feedback date_process"></div>
    </div>


    <div class="col-2">
        <input type="text" name="join_date" class="form-control datepicker_join" autocomplete="off" style="display: none" placeholder="JOIN DATE">
          <div class="invalid-feedback join_date"></div>
    </div>
    <br><br>
        


    <div class="col-2">
        <button class="btn btn-success" id="btnUpdate" style="display: none;" onclick="updateStatus()"><i class="fa fa-save"></i> Update </button>
    </div>

</nav>

<div class="card bg-abu-muda" style="border:none;">
    <div class="card-body" style="padding: 0">
      <div class="col-12">
        <div class="row">
            <div class="col-3">
              <h5 class="font-weight-500 font-12 font-abu "> NAME </h5>
            </div>

            <div class="col-3">
              <h5 class="font-12 font-abu"> CURRENT EXPERIENCE  </h5>
            </div>

            <div class="col-2">
              <h5 class="font-12 font-abu"> NO HP </h5>
            </div>

            <div class="col-2">
              <h5 class="font-12 font-abu">DEGREE/WORK EXPERIENCE</h5>
            </div>  


            <div class="col-2">
              <h5 class="font-12 font-abu">EXPECTED SALARY</h5>
            </div>
           
        </div><!-- CARD TOP --->
      </div>
    </div>
</div>

@if(!empty($detail_candidate[0]->name_holder))
@foreach($detail_candidate as $det)
  <div class="card bg-white card-candidate mb-3" style="border-radius: 5px;" id="{{$det->candidate_id}}"> 
      <div class="card-body">
        <div class="col-12">
              <div class="row">
                  <div class="col-3">
                    <h5 class="color-ungu  font-weight-500 font-16"> <input type="checkbox" onclick="check_emp(this,{{$det->candidate_id}})" name="candidate_id" value="{{$det->candidate_id}}"> {{$det->name_holder}} </h5>
                    <a href="{{url('candidate-final/'.$det->candidate_id)}}" target="_blank"><h5  class="font-14 font-abu"> <i class="fa fa-eye"></i> View </h5></a>
                  </div>

                  <div class="col-3">
                    <h5 class="color-ungu  font-14">{{$det->edu_major}} ({{$det->edu_end_year}}) </h5>
                    <h5 class="font-14 font-abu"> {{$det->edu_university}} </h5>
                  </div>

                  <div class="col-2">
                    <h5 class="color-ungu  font-14">{{ $det->hp_1 }}  </h5>
                  </div>

                  <div class="col-2">
                    <h5 class="color-ungu  font-14"> {{$det->edu_degree}} </h5>
                    <h5 class="font-14 font-abu">{{$det->exp_total}} </h5>
                  </div>  


                  <div class="col-2">
                    <h5 class="color-ungu  font-14">{{(empty($det->exp_salary_existing)) ? 0 : $det->exp_salary_existing}}</h5>
                  </div>
                 
              </div><!-- CARD TOP --->
              <hr>

              <form action="{{url('rec-process/edit_rec_process/'.$det->candidate_id)}}">
               <div class="row">
                  <div class="col-5">
                    <div class="row">
                      <div class="col-3 float-right" style="padding-right: 3px;">
                        <span class="color-ungu  font-weight-500 font-14">  Select Process </span>  
                      </div>
                      <div class="col-6"  style="padding-left:0px">
                        <input type="hidden" name="job_id" value="{{$_GET['id']}}">
                        <input type="hidden" name="status" value="{{$_GET['status']}}">
                        <input type="hidden" name="type" value="{{$_GET['type']}}">
                        <input type="hidden" name="q" value="">
                        <select class="form-control" name="process">
                            @foreach($process as $st)
                                <option value="{{$st->nama}}">{{($st->nama == 'CALLED' ? "INVITED" : $st->nama)}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div>
                        <button type="submit" class="btn bg-ungu" style="color:white"> Lanjut </a>
                      </div>
                    </div>
                  </div>
                 
              </div>
            </form>

        </div><!-- END COL 12 -->
      </div>
    </div>
@endforeach
@endif
<div class="pull-right">
  {{ $detail_candidate->appends(['status'=>$_GET['status'],'id'=>$_GET['id'],'type'=>$_GET['type']])->links() }}
</div>



@endsection

@section('js')
    @include('backend.rec_process.js_rec_process')
    <script type="text/javascript">
      

    $('#search_').keypress(function(event){
        if(event.which == 13) {
          $('#form_search').submit();
        }
    })

    </script>
@endsection
