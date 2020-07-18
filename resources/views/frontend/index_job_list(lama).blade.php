@extends('layouts.frontend')
@section('content_frontend')

@php 
  $userinfo = Session::get('userinfo'); 
@endphp


<!-- Page Content -->
<div  class="mb-4" style="margin-top: 44px;">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    @php  
      $banner = \App\Models\Tm_setting_banner::where('setting_banner_type','banner')->orderBy('setting_banner_id','desc')->limit(5)->get();
    @endphp

    <ol class="carousel-indicators">
      @foreach($banner as $key => $ban)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"></li>
      @endforeach
    
    </ol>
    <div class="carousel-inner" role="listbox">
      @foreach($banner as $key => $ban)
      <div class="carousel-item {{($key == 0) ? "active":""}}">
        <img class="d-block img-fluid" src="{{asset('upload_file/'.$ban->setting_banner_pict.'')}}" alt="First slide">
      </div>
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

@if(empty($userinfo['candidate_id']))
<div class="container">
    <div class="row">
      <div class="col-12 mt-5 mb-5">
        <div>
          <h1  class="mb-3" style="font-weight: bold;font-size: 28px">Puninar Logistics</h1>
          <h1  class="mb-3" style="font-size: 24px">
            Leading Integrated Logistics Solution Provider 
          </h1>
          <p align="justify">
            Since established in 1969, Puninar Logistics has grown and developed into foremost and experienced logistics company which leads logistics world in Indonesia with the capability and competence to provide a total logistics solution through operation of its subsidiaries. The integrated logistics capability which dedicated to meet Customer’s Supply Chain.
            <br>
            <br>
            We want people with Integrity & Ethics. People who are fair, impartial, and truthful. We want persons with perseverance and passion who are not afraid to think creatively, to be proactive, flexible and responsive.
            <br>
            <br>
            If you think you embody these values then Puninar Logistics is the place for you and your career.
            <br>
            <br>
            <i>*Please note that Puninar Logistics will only process shortlisted applicants who best met the job requirements..</i>
          </p>
        </div>
      </div>
    </div>
  </div>


  <div class="middle-banner mt-5">
      <center>
        <h3 class="pt-4" style="font-size: 24px;font-weight: 500">PUNINAR LOGISTICS </h3>
        <p class="pt-3" style="font-size: 16px;">Your Career Solution</p>
      </center>
  </div>
@endif

<section class="page-section" id="vacancies">
    <div class="container">
      <div class="col-md-12">
        <!-- /.row -->
      @php
        $search = isset($_GET['search_general']);
        

        if($search)
        {
          $search = $_GET['search_general'];
          $show = 'show';
        }
        else
        {
          $search = '';
            $show = '';
        }
      @endphp

      <div class="mt-5">
        <center style="margin: 0px auto;" class="col-md-6"> 
          <h3> CAREER VACANCIES </h3>
        </center>
      </div>


      <div class="container">
        <div class="col-md-6 mt-5" style="margin:  0 auto;">
              <form  class="row" method="GET" action="{{route('frontend.index','#vacancies')}}">
                 <div class="input-group">
                      <input type="text" class="form-control" name="search_general" placeholder="Search Job" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ (isset($_GET['search_general'])) ? $_GET['search_general'] : "" }}">
                      <div class="input-group-append">
                        <button class="btn bg-pun-orange color-white" type="submit">Search</button>
                      </div>
                  </div>
              </form>
        </div>
      </div>


      <main class="my-5">
        <div id="accordion" role="tablist">
          <div class="card" style="border: none">

            @foreach($division as $key => $div)
            @php
                $detail = \App\Models\JobFptk::where('division',$div->division)
                ->whereNull('type_fptk')
                ->where('publish','Publish')
                ->where('is_closed','open')
                ->where('status','approved');
                if($search)
                {
                  $detail = $detail->where('position_name','ilike','%'.$search.'%');
                  // ->get();                  
                }
                $detail = $detail
                //->orwhere('position_name','ilike','%'.$search.'%')
                ->get();
                //dump($detail);
            @endphp
            @if(count($detail)  != 0)
            <div class="card-header bg-white" role="tab" id="headingOne" style="padding:1.5rem 1.25rem">
              <h5 class="mb-0 text-right-sm">
                <a  data-toggle="collapse" style="text-decoration: none" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                  <span class="color-pun-biru">{{strtoupper($div->division)}}</span>
                  <i  class="float-right  bg-white fa fa-angle-down font-weight-bold"  style="color: #2f318b" ></i>
                   <span  style="font-size: 15px;" class="float-right  bg-white mr-3 color-pun-biru"> {{count($detail)}} Vacancies </span>
                </a>
              </h5>
            </div>

            
            <div id="collapse{{$key}}" class="collapse {{$show}}" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                  @php
                      foreach($detail as $det):
                  @endphp
                  <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.125)">
                      <div class="row" style="padding:10px">
                        <div class="col-md-4" style="text-align: left;">
                           <a href="javascript:void(0)" onclick="get_detail(this,'{{$det->job_fptk_id}}')"> {{strtoupper($det->position_name)}} </a>
                           <br>
                           {{strtoupper($det->work_location)}}
                           <br>
                           {{$det->work_system}}
                        </div>
<!--                         <div class="col-md-4" style="text-align: center;"> 
                          {{strtoupper($det->work_location)}}
                        </div>
                        <div class="col-md-4" style="text-align: right;">
                          {{$det->work_system}}
                        </div> -->
                      </div>
                  </div>
                  @php 
                    endforeach;
                  @endphp
              </div>
            </div>
            @endif
            @endforeach

          </div>
        
        </div> 
      </main>

      <div class="mb-5">
        {{ $division->links() }}
      </div>
      </div>
    </section>
</div>
@endsection

@section('js')
    @include('frontend.js_frontend')
@endsection

