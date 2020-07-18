<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
{{--     <script src="{{ asset('js/app.js') }}"></script>
 --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <!-- Font awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.css') }}">

    <!-- Datatable  -->
    <link rel="stylesheet" href="{{ asset('vendor/jquery/jquery.dataTables.min.css') }}">
    <link href="{{ asset('vendor/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('fullcalender/css/fullcalendar.css') }}" rel='stylesheet' />
    <link href="{{ asset('fullcalender/css/fullcalendar.print.css') }}" rel='stylesheet' media='print' />
    
    <!-- jQuery 3 -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Datepicker 4 --->
    <link rel="stylesheet" href="{{ asset('vendor/datepicker4/css/gijgo.css') }}">
    <script src="{{ asset('vendor/datepicker4/gijgo.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('vendor/highcharts/highcharts.js')}}"></script>
    <script src="{{ asset('vendor/highcharts/modules/exporting.js')}}"></script>
    <script src="{{ asset('vendor/highcharts/modules/export-data.js')}}"></script>

     <script>
      $(document).ajaxStart(function(){
          
          $('.loading').show();
          $('#trans').show();
      }).ajaxStop(function(){
          $('#trans').hide();
          $('.loading').hide();
      })
    </script>
    @yield('style')


</head>
<style type="text/css">
    
</style>
<body  id="app" class="bg-abu-muda">
@php 
    $menu = DB::table('e_recruit.roles as a')
    ->select('e.menu_name','e.menu_id','e.menu_url','e.menu_parent')
    ->join('e_recruit.role_has_permissions as b','a.id','b.role_id')
    ->join('e_recruit.permissions as c','c.id','b.permission_id')
    ->join('e_recruit.tr_users as d','d.role_id','a.id')
    ->join('e_recruit.menu as e','e.menu_id','c.menu_id')
    ->where('d.user_id',Auth::user()->user_id)
    ->where('menu_parent',0)
    ->whereRaw(" ( type is null or type = 'navbar' ) ")
    ->orderBy('no_urut','asc')
    ->groupBy('e.menu_name','e.menu_id','e.menu_url','e.menu_parent')
    ->get();
@endphp
<div id="trans" class="overlay" style="display:none"></div>
<div class="loading" style="display: none">
  <img src="{{asset('images/loading.gif')}}"> 
</div>

    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-ungu">
          <a class="navbar-brand" style="color: white">{{'E - Recruitment'}}</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @php
                  $candidate = App\Models\Candidate::where('process','CALLED')
                  ->whereDate('date_process',date('Y-m-d', strtotime('date_process')))
                  ->whereNotNull('link_video_call')
                  ->where('link_video_call','!=','')
                  ->count();

                  // Candidate::where('candidate_id',$user['candidate_id'])
                  // ->where('history_process','CALLED')
                  // ->whereIn('history_result',['SENT','REINVITED'])
                  // ->whereRaw("(history_confirmation = '' or history_confirmation is null)")
                  // ->count();
                  
                @endphp
                @foreach($menu as $m)
                  @if($m->menu_url !='#')
                    <li>
                      <a  class="nav-link {{( $m->menu_url === Request::segment(1)) ? "active" : ""}}"  href="{{url($m->menu_url)}}"> {{$m->menu_name}} {!! ($m->menu_name == 'Calendar') ? '<span class="badge badge-danger">'.$candidate.'</span>' : "" !!}  </a>
                    </li>
                  @else
                  <li class="nav-item dropdown">
                        @php
                          $sub_menu = DB::table('e_recruit.menu')->where('menu_parent',$m->menu_id)->get();
                        @endphp
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{$m->menu_name}}   <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @foreach($sub_menu as $sm)
                              <a href="{!! url($sm->menu_url) !!}" class="dropdown-item"> {{$sm->menu_name}} </a>
                            @endforeach
                          </div>
                    </li>
                  @endif
                @endforeach
            </ul>
            <ul class="navbar-nav ml-auto">

                 <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-user"></i>  
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
               
                          <a href="{{route('dashboard.change_password')}}" class="dropdown-item">Change Password</a>
                          @php
                            $menu_ex =DB::table('e_recruit.roles as a')
                            ->select('e.menu_name','e.menu_id','e.menu_url','e.menu_parent')
                            ->join('e_recruit.role_has_permissions as b','a.id','b.role_id')
                            ->join('e_recruit.permissions as c','c.id','b.permission_id')
                            ->join('e_recruit.tr_users as d','d.role_id','a.id')
                            ->join('e_recruit.menu as e','e.menu_id','c.menu_id')
                            ->where('d.user_id',Auth::user()->user_id)
                            ->orderBy('no_urut','asc')
                            ->where('type','dropdown')->get();

                          @endphp
                            @foreach($menu_ex as $ex)
                                <a href="{{url($ex->menu_url)}}" class="dropdown-item">{{$ex->menu_name}} </a>
                            @endforeach
                      
                          <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                         </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
          </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- EXPORT DATA -->
    <script src="{{ asset('vendor/jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/numeric.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.0.0/js/bootstrap.js') }}"></script>
    <script src="{{ asset('jquery_validation/jquery.validate.js') }}"></script>


    <!-- EXPORT DATA -->
    <script src="{{ asset('vendor/jquery/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jszip.min.js') }}"></script>
{{--     <script src="{{ asset('vendor/jquery/pdfmake.min.js') }}"></script>
 --}}    <script src="{{ asset('vendor/jquery/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <!--- Select 2 ---->
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
{{--     <script src="{{ asset('fullcalender/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
 --}}    <script src="{{ asset('fullcalender/js/jquery-ui.custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('fullcalender/js/fullcalendar.js') }}" type="text/javascript"></script>
    
    @yield('js')

</body>


</html>
