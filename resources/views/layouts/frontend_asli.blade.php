<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500&display=swap" rel="stylesheet">

    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('jquery_validation/screen.css') }}" rel="stylesheet">

     <!-- Font awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.css') }}">

    <!-- Datatable  -->
    <link rel="stylesheet" href="{{ asset('vendor/jquery/jquery.dataTables.min.css') }}">

    <!-- sweet alert --->
    <link href="{{ asset('vendor/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker4/css/gijgo.css') }}">
    @yield('css')

    <!-- jQuery 3 -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYKv5sjVpvD0hBsthxYts_uAvHsuwdbCI"></script>

    
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Datepicker 4 --->
    
    <script src="{{ asset('vendor/datepicker4/gijgo.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $(document).ajaxStart(function(){
            $('.loading').show();
            $('#trans').show();
        }).ajaxStop(function(){
            $('#trans').hide();
            $('.loading').hide();
        })
    </script>
</head>
<body class="bg-white"> 
@php
  use App\Models\Candidate;
  use App\Models\TrHistoryProcess;
  $user = Session::get('userinfo');
  if(!empty($user))
  {
    $candidate = Candidate::find($user['candidate_id']);
    $sumNotif = TrHistoryProcess::where('candidate_id',$user['candidate_id'])
        ->where('history_process','CALLED')
        ->whereIn('history_result',['SENT','REINVITED'])
        ->whereRaw("(history_confirmation = '' or history_confirmation is null)")
        ->count();
  }
@endphp
<div id="trans" class="overlay" style="display: none" ></div>
<div class="loading" style="display: none;">
  <img src="{{asset('images/loading.gif')}}"> 
</div>
    <!-- Navigation -->
    
    <nav class="navbar navbar-expand-md fixed-top bg-white shadow-sm p-3 mb-5 bg-white rounded" style="height: 50px">
      <div class="container">
        <a class="navbar-brand" href="{{url('/to_other_url?type=website')}}"><img src="{{asset('images/logo-puninar.png')}}"> </a>
        <button class="navbar-toggler" type="button" style="border-color:#000" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto" style="font-size: 14px;">
            <li class="nav-item  {{ (Request::is('home')) ? "active" : ""}}">
              <a class="nav-link font-weight-500" href="{{route('home')}}">HOME
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded js-scroll-trigger font-weight-500"  href="{{route('frontend.index','#vacancies')}}">VACANCIES
              </a>
            </li>
            
            @php 
              if($user):
            @endphp
            @php 
              if($candidate->process == "REGISTRATION"):
            @endphp
              <li class="nav-item   {{ (Request::is('form-candidate')) ? "active" : ""}}">
                <a class="nav-link  font-weight-500" href="{{route('form-candidate.create')}}">CANDIDATE FORM </a>
              </li>
            @php
              endif;
            @endphp
            
            <li class="nav-item  {{ (Request::is('form-candidate/confirmation')) ? "active" : ""}} ">
                <a href="{{route('form-candidate.confirmation')}}" class="nav-link font-weight-500">
                  NOTIFICATIONS <span class="badge badge-danger  font-weight-500">{{ ($sumNotif == 0 ) ? 0  : $sumNotif }}</span>
                </a>
            </li>
            
            @php 
              if($candidate->process != "REGISTRATION"):
            @endphp
              <li class="nav-item  {{ (Request::is('form-complete')) ? "active" : ""}}">
                <a class="nav-link  font-weight-500" href="{!!route('form-complete')!!}">COMPLETE FORM</a>
              </li>
            @php
              endif;
            @endphp
            

            <li class="nav-item">
              <a class="nav-link  font-weight-500" href="{{route('frontend.logout')}}" id="link_logout">LOGOUT</a>
            </li>
            @php 
              else:
            @endphp
            <li class="nav-item">
              <a class="nav-link  font-weight-500" href="javascript:void(0)" onclick="modalLogin()">LOGIN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  font-weight-500" href="javascript:void(0)" onclick="modalRegistration()">REGISTER</a>
            </li>
            @php 
              endif
            @endphp
          </ul>
        </div>
      </div>
    </nav>

  
    @yield('content_frontend')

    <!-- Footer -->
    <footer class="py-5" style="background-color: #f0f0f0">
      <div class="container">
        <div class="row">
            <div class="col-md-9  color-pun-abu">
              <img src="{{asset('images/logo.png')}}">
              <p class="mt-3 mb-2">
                <h5  style="font-weight: bold;font-size: 20px;">Head Office</h5>
              </p>
              <div class="col-md-9 pl-0 mt-3">
                Alamat : Jln. Raya Cakung Cilincing KM 1,5. Cakung,Jakarta Timur Jakarta 13910
                <br>
                <img src="{{asset('images/wa_footer.png')}}"> Phone : +62 21 460 2278 (Hunting) | 
                <img src="{{asset('images/fax_footer.png')}}"> Fax : +62 21 460 4886
              </div>
            </div> 


            <div class="col-md-3 text-sm-right  color-pun-abu">
              <p>
                <h5>TEMUKAN KAMI</h5>
              </p>
              <div class="text-sm-right pl-0 mt-3">
                <span class="mr-2">
                  <a href="{{url('/to_other_url?type=linkedin')}}" target="_blank">
                    <img src="{{asset('images/linkedin.png')}}">
                  </a>
                </span>
                <span class="mr-2">
                  <a href="{{url('/to_other_url?type=fb')}}"  target="_blank">
                    <img src="{{asset('images/fb.png')}}">
                  </a>
                </span>
                <span class="mr-2">
                  <a href="{{url('/to_other_url?type=instagram')}}"  target="_blank">
                    <img src="{{asset('images/ig.png')}}">
                  </a>
                </span>
                
                <div class="mt-5">
                  Copyright © PUNINAR 2019
                </div>
              </div>

            </div>



        </div>

      </div>
      <!-- /.container -->
    </footer>


@php  
  $dt = \App\Models\Tm_setting_banner::where('setting_banner_type','warning')->orderBy('setting_banner_id','desc')->first();
@endphp
@php

  if(!empty($dt))
  {
    $type = explode('.', $dt->setting_banner_pict);  
  }
  else
  {
      $type[1] = '';
  }
  
@endphp

@if(!empty($dt))
@if($dt->status == 'show')
<!-- Modal warning -->
<div class="modal fade" id="modalWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false" data-backdrop="static">
    <div class="modal-dialog 
        @if(!empty($dt))
          @if($type[1] == 'mp4')
           modal-lg
          @else
            ''
          @endif
        @endif
     modal-dialog-centered" role="document">
      <div class="modal-content">
    
        <div class="modal-body">
          <button type="button" class="close" onclick="closeModalWarning()">
            <span aria-hidden="true"  >&times;</span>
          </button>
          <div class="table-responsive">
            
            @if(!empty($dt))
              @php
                $type = explode('.', $dt->setting_banner_pict);
              @endphp
              @if($type[1] == 'mp4')
              {{-- <div class="embed-responsive embed-responsive-16by9">
                <video src="{{asset('upload_file/'.$dt->setting_banner_pict.'')}}"></video>
                <iframe src="{{asset('upload_file/'.$dt->setting_banner_pict.'')}}" id="telo"></iframe> 
              </div> --}}
              <div class="embed-responsive embed-responsive-16by9">
              <video width="400" controls>
                <source src="{{asset('upload_file/'.$dt->setting_banner_pict.'')}}" type="video/mp4">
              </video>
            </div>
              @else
                <img src="{{asset('upload_file/'.$dt->setting_banner_pict.'')}}" width="465" height="500">
              @endif
            @endif
          </div>
        </div>
        {{-- <div class="modal-footer">
            <input type="checkbox" name="check_">
        </div> --}}

           <div class="modal-footer" style="display: inline;float:left;">
              {{-- <input type="checkbox" name="check_warning"> --}}
              <button class="btn btn-primary" onclick="closeWarning()" style="background-color: white;border-color: #909090;color:#000"> Jangan Tampilkan Lagi  </button>
              {{-- <label> Cheklist untuk tidak menampilkan lagi hari ini </label> --}}
          </div>
      </div>
    </div>
</div>
@endif
@endif

<!-- Modal Forgot -->
<div class="modal fade" id="modalForgotPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document" style="">
      <div class="modal-content">
  
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="ml-5 mt-5">
            <div class="col-md-6 ml-2 mb-3 color-pun-abu">
              <h2 class="color-pun-biru " style="font-size: 14px"> <strong>FORGOT PASSWORD </strong>  </h2>
            </div>

           <form class="form-forgot" id="form-forgot">
              <div class="form-label-group">
                <div class="col-md-11">
                  <input type="text" style="padding:0.7rem;" class="form-control bg-abu-white" name="email_forgot" placeholder="Email address" required autofocus>
                  <span class="invalid-feedback" role="alert"></span>
                </div>
              </div>

              <div class="form-label-group">
                <div class="col-md-11 mt-5">
                    <div class="clearfix">
                      <button type="button"  class="btn bg-white pull-left" style="width: 100px;" onclick="closeModalForgotPassword()">Cancel</button>
                      <button type="submit"  class="btn  pull-right bg-pun-orange color-white" style="width: 100px">Send</button>
                    </div>
                </div>
              </div>
           </form>
          </div>
        </div>
      </div>
    </div>
</div>


<!-- Modal Login -->
<div class="modal fade" id="modalLoginFront" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width: 651px">
    <div class="modal-content">
      <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="ml-5 mt-3">
            <div class="col-md-6 ml-5 mt-3  color-pun-abu">
              <h3 class="color-pun-biru mb-3"> <strong class=" font-20">LOGIN </strong> </h3>
              <i class="font-12">
                "Your dream job won't find you,
                <br>
                you have to find it. Set your goals today
                <br>
                and make them happen this years."
              </i>
              <div style="clear:both;">
              </div>
              <hr style="border-top: 2px solid #2f318b;width: 75px;float: left;font-weight: bold;">
            </div>
              <form class="form-signin ml-5 mt-5" id="form-signin">
                  <div class="form-label-group">
                    <div class="col-md-11"> 
                      <input type="text" style="padding:0.7rem;" class="form-control bg-abu-white" name="email" placeholder="Email address" required autofocus>
                      <span class="invalid-feedback" role="alert"></span>
                    </div>
                  </div>

                  <div class="form-label-group">
                   <div class="col-md-11 mt-3">
                      <input type="password" style="padding:0.7rem;"  class="form-control bg-abu-white" name="password" placeholder="Password" required>
                      <span class="invalid-feedback" role="alert"></span>
                    </div>
                  </div>

                  <div class="form-label-group  font-14">
                    <div class="col-md-11 m3-5">
                       <div class="custom-control custom-checkbox mb-5" style="padding-left:0;">
                          <span  class="pull-left my-2  color-pun-abu"> Don't have an account, &nbsp;  </span>  <a href="#" onclick="notHaveAccount()"  class="pull-left my-2 color-pun-biru"> register here </a>
                          <a href="#" class="pull-right  my-2 color-pun-biru" onclick="modalForgotPassword()"> Forgot Password  </a>
                        </div>

                        <div class="clearfix">
                          <button type="button"  class="btn bg-white pull-left" style="width: 200px;" onclick="closeModalLogin()">Cancel</button>
                          <button type="submit"  class="btn  pull-right bg-pun-orange color-white" style="width: 200px">Login</button>
                        </div>
                    </div>
                  </div>
              </form>
           </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal Registrasi -->

<div class="modal fade" id="modalRegistration" tabindex="-1" role="dialog" aria-labelledby="groupModalCenterTitle" aria-hidden="false"  data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered  modal-lg" role="document" style="width: 45%;">
    <div class="modal-content" style="background-color: #FBFBFB;">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="alert alert-danger" id="error-alert" style="display: none"></div>
        <div class="ml-5 mt-5">
            <div class="col-md-6 ml-5 mt-3 mb-5 color-pun-abu">
              <h2 class="color-pun-biru mb-5 font-20"> <strong>REGISTRATION FORM </strong>  </h2>
            </div>

            <div class="ml-5">
              <form  id="form-registration">
                <div class="form-group row">
                  <div class="col-sm-11">
                      <input type="text" id="inputName" name="name_holder"  class="form-control bg-abu-white" placeholder="Name" required autofocus>
                      <span class="invalid-feedback" role="alert"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-11">
                      <input type="text" class="form-control bg-abu-white" onchange="emailCheck()" name="email"  required placeholder="Email">
                      <span class="invalid-feedback" role="alert"></span>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-11">
                      <input type="text" class="form-control number_valid_char bg-abu-white" maxlength="15" onchange="" name="phone_number"  required placeholder="Phone Number">
                      <span class="invalid-feedback" role="alert"></span>
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-11">
                    <input type="password"  class="form-control bg-abu-white" name="password" required placeholder="Password">
                    <span class="invalid-feedback" role="alert"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-11">
                    <input type="password" id="inputConfirmPassword" class="form-control bg-abu-white" required name="password_confirmation" placeholder="Confirm Password">
                    <span class="invalid-feedback" role="alert"></span>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-11">
                    <div class="refreshCaptcha"> 
                      {!! captcha_img('default') !!}
                    </div> 
                    <a href="javascript:void(0)" onclick="refreshCaptcha()" class="font-14 color-pun-biru">refresh captcha</a>
                    <br>
                    <input type="text" name="captcha" required="" class="form-control bg-abu-white" placeholder="Input Captcha">
                    <span class="invalid-feedback" role="alert"></span>
                  </div>
                </div>


                <div class="form-group row mt-5">
                      <div class="col-md-11">      
                          <div class="clearfix">
                            <button type="button" id="closeBtnRegis"  class="btn bg-white pull-left" style="width: 200px;" onclick="closeModalRegistration()">Cancel</button>
                            <button type="submit"  id="saveBtnRegis" class="btn  pull-right bg-pun-orange color-white" style="width: 200px">Register</button>
                          </div>
                      </div>
                  </div>
            </form>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

    <!-- EXPORT DATA -->
    <script src="{{ asset('vendor/jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/numeric.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.0.0/js/bootstrap.js') }}"></script>
    <script src="{{ asset('jquery_validation/jquery.validate.js') }}"></script>


    <script src="{{ asset('form_wizard/js/jquery.smartWizard.js') }}"></script>
    {{-- <script src="{{ asset('form_wizard1/js/jquery.smartWizard.js') }}"></script> --}}

    <!-- EXPORT DATA -->
    <script src="{{ asset('vendor/jquery/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.print.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    @yield('js')

</body>


</html>
