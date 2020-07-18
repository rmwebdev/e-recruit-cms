<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap-4.0.0/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet">
  <style type="text/css">
    @media screen and (max-width:480px){      
      .col-4 {
           flex: none; 
           max-width: none; 
         }    
    }
    .select2-container .select2-selection--single{
      height: 37px;
    }
  </style>
    <!--- Select 2 ---->
  <title>Dashboard</title>
</head>
<body>
  
@php 
  $get_year = isset($_GET['year']);
  $get_division = isset($_GET['division']) ? $_GET['division'] : "";
  $get_requester_name = isset($_GET['requester_name']) ? $_GET['requester_name'] : "";
  if($get_year)
  {
      $year_op = $_GET['year'];
  }
  else
  {
      $year_op = date('Y');
  }
@endphp
<center><h3><b><u>DASHBOARD RECRUITMENT {{$year_op}}</u></b></h3></center>
<br>
 <div class="container" style="margin-left: 10px">
    <h4>SEARCH : </h4>
    <form action="{{route('dashboard')}}"  method="GET">
      <div class="row">
        <div class="col-3">
           <select class="form-control" name="year">
              <option value="">All</option>
              @for($year=2015;$year<=date('Y');$year++)

                <option value="{{$year}}" {{($year_op == $year)  ? "selected" : ""}}> {{$year}} </option>
              @endfor    
          </select>
        </div> 

        <div class="col-3">
           <select class="form-control" name="division">
              <option value=""> - ALL  DIVISION -</option>
              @foreach($division as $dv)
                <option value="{{$dv->division}}" {{($get_division == $dv->division) ? "selected" : ""}}>  {{$dv->division}} </option>
              @endforeach
          </select>
        </div> 

        <div class="col-3"> 
          <select class="form-control" name="requester_name">
            <option value=""> - ALL REQUESTER -</option>
            @foreach($requester_name as $req)
                <option value="{{$req->requester_name}}" {{($get_requester_name == $req->requester_name) ? "selected" : ""}}>  {{$req->requester_name}} </option>
            @endforeach
          </select>
        </div>    

        <div class="col-3"> 
          <button class="btn btn-primary"> <i class="fa fa-search"></i> Cari </button>
          <a class="btn btn-default" href="{{url('rec-process')}}" style="border:1px solid #909090"> Cancel </a>
        </div>
    </form>

      </div>
        <!-- /.col-md-8 -->
</div>
<br><br>

<!-- FULLFILMENT -->
<center><h3>FULFILLMENT </h3></center><br/>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div id="pieFPTK" class="col-md-6"></div>
        <div id="pieMain" class="col-md-6"></div>
      </div>
    </div>
  </div>
</div>
<hr/>

<!-- FULLFILMENT -->
<center><h3>OPEN &  CLOSE </h3></center><br/>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div id="pieOpen" class="col-md-6"></div>
        <div id="pieClose" class="col-md-6"></div>
      </div>
    </div>
  </div>
</div>
  <hr/>


<!-- SOURCE -->
<center><h3>SOURCE OF JOB VACANCY </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieSource" class="col-md-6"></div>
          <div id="pieSourceAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
  <hr/>


<!-- GENDER -->
<center><h3> GENDER </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieGender" class="col-md-6"></div>
          <div id="pieGenderAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
  <hr/>

<!-- AGE -->
<center><h3> AGE </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieAge" class="col-md-6"></div>
          <div id="pieAgeAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
<hr/>



<!-- CITY -->
<center><h3> CITY  </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieCity" class="col-md-6"></div>
          <div id="pieCityAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
<hr/>



<!-- UNIVERSITY -->
<center><h3> UNIVERSITY </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieUniversity" class="col-md-6"></div>
          <div id="pieUniversityAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
<hr/>



<!-- REQUESTER NAME  -->
<center><h3> REQUESTER NAME  </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieRequesterName" class="col-md-6"></div>
          <div id="pieRequesterNameAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
<hr/>


<!-- POSITION NAME -->
<center><h3> POSITION NAME </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="piePositionName" class="col-md-6"></div>
          <div id="piePositionNameAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
<hr/>


<!-- DIVISION  -->
<center><h3> DIVISION  </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieDivision" class="col-md-6"></div>
          <div id="pieDivisionAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
<hr/>




<!-- POSITION NAME -->
<center><h3> REASON HIRING </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieReasonHiring" class="col-md-6"></div>
          <div id="pieReasonHiringAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
<hr/>
@php
   $openClosed =$open + $closed;
   $openClosedStaff = $open_staff + $closed_staff;
   $totOpen = ($open == 0) ? 0 : @($open/$openClosed * 100) ;
   $totClosed = ($closed == 0)  ? 0 : @($closed/$openClosed * 100);
   $totOpenStaff = @($open_staff/$openClosedStaff * 100) ;
   $totClosedStaff = @($closed_staff/$openClosedStaff * 100) ;
 @endphp

<!-- WORK LOCATION  -->
<center><h3> WORK LOCATION  </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pieWorkLocation" class="col-md-6"></div>
          <div id="pieWorkLocationAll" class="col-md-6"></div>
        </div>

      </div>
    
    </div>
  </div>
<hr/>



<!-- jQuery 3 -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/jquery/jquery-2.0.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/jquery/jquery-ui-1.10.4.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap-4.0.0/js/bootstrap.js') }}"></script>


<script type="text/javascript" src="{{ asset('vendor/highcharts/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/highcharts/modules/series-label.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/highcharts/modules/exporting.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/highcharts/modules/export-data.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.js') }}"></script>

<script type="text/javascript">
// 


$(function(){
    $('[name="requester_name"]').select2();
    $('[name="division"]').select2();
})


var color_chart = ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4','#DC3545','#28A745','#FFC107','#29166F','#27A9E3','#8150A0'];

/* ============ CHART  FOR FPTK ================= */
Highcharts.chart('pieFPTK', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
 colors:color_chart,
    title: {
        text: 'FPTK',
        style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
     series: [{
        name: '',
        colorByPoint: true,
         data: [
        {
          name: "OPEN",
          sliced: true,
          x:  {!! $open !!},
          y: {!! $open !!},
          color: "red"
        },
        {
          name: "CLOSED",
          sliced: true,
          x: {!! $closed !!},
          y:  {!! $closed !!},
          color: "green"
        },
        {
          name: "DROP",
          sliced: true,
          x:{!! $drop !!},
          y:  {!! $drop !!},
          color: "yellow",
        },
        {
          name: "REJECTED",
          sliced: true,
          x:{!! $rejected !!},
          y:  {!! $rejected !!},
          color: "#909090",
        }

        ]
    }]
});


/* ============ CHART  FOR FPTK ================= */
Highcharts.chart('pieOpen', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
 colors:color_chart,
    title: {
        text: 'FPTK',
        style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
     series: [{
        name: '',
        colorByPoint: true,
         data: [
        {
          name: "OPEN",
          sliced: true,
          x:  {!! $open !!},
          y: {!! $totOpen !!},
          color: 'red'
        },
        {
          name: "CLOSED",
          sliced: true,
          x: {!! $closed!!},
         y: {!! $totClosed !!},
        color: "green"
        },
      
        ]
    }]
});



Highcharts.chart('pieMain', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'MAN POWER',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [
       {
           name: 'OPEN',
            sliced: true,
           x:{!! $open_staff !!},
           y : {!! $open_staff !!},
           color: "red"

         },

         {
           name: 'CLOSED',
            sliced: true,
           x:{!! $closed_staff !!},
           y :{!! $closed_staff !!},
           color: "green"
         },

         {
           name: 'DROP',
            sliced: true,
           x:{!! $drop_staff !!},
           y :{!! $drop_staff !!},
           color: "yellow"
         },   

         {
           name: 'REJECTED',
            sliced: true,
           x:{!! $total_request_rejected !!},
           y :{!! $total_request_rejected !!},
           color: "#909090"
         },
        ]
    }]
});

/* ============ END CHART FOR FPTK ================= */


Highcharts.chart('pieClose', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'MAN POWER',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [
       {
           name: 'OPEN',
            sliced: true,
           x:{!! $open_staff!!},
           y: {!! $totOpenStaff !!},
          color: "red"

         },

         {
           name: 'CLOSED',
            sliced: true,
           x:{!! $closed_staff!!},
           y: {!! $totClosedStaff  !!},
          color: "green"

         },

        ]
    }]
});

/* ============ END CHART FOR FPTK ================= */


/* ============ CHART FOR SOURCE ================= */
Highcharts.chart('pieSource', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIREDTELO',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($source_data as $val)
         {
           name: '{{$val->source}}',
            sliced: true,
           x:{!! $val->count_candidate !!},
           y : {!! $val->count_candidate !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieSourceAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    colors:color_chart,
    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($source_data_all as $val)
         {
           name: '{{$val->source}}',
            sliced: true,
           x:{!! $val->count_candidate !!},
           y : {!! $val->count_candidate !!}

         },
         @endforeach

        ]
    }]
});

/* ============ END CHART FOR SOURCE ================= */


/* ============ CHART FOR GENDER ================= */

Highcharts.chart('pieGender', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($jenis_kelamin_hired as $val)
         {
           name: '{{$val->gender}}',
            sliced: true,
           x:{!! $val->tot_gender !!},
           y : {!! $val->tot_gender !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieGenderAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($jenis_kelamin_all as $val)
         {
           name: '{{$val->gender}}',
            sliced: true,
           x:{!! $val->tot_gender !!},
           y : {!! $val->tot_gender !!}

         },
         @endforeach

        ]
    }]
});
/* ============ END CHART FOR GENDER ================= */


/* ============ CHART FOR UNIVERSITY ================= */

Highcharts.chart('pieUniversity', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($universitas_hired as $val)
         {
           name: '{{$val->edu_university}}',
            sliced: true,
           x:{!! $val->tot_university !!},
           y : {!! $val->tot_university !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieUniversityAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($universitas_all as $val)
         {
           name: '{{$val->edu_university}}',
            sliced: true,
           x:{!! $val->tot_university !!},
           y : {!! $val->tot_university !!}

         },
         @endforeach

        ]
    }]
});
/* ============ END CHART FOR UNIVERSITY ================= */


/* ============ CHART FOR AGE ================= */

Highcharts.chart('pieAge', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name} Tahun: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name} </b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($age_hired as $val)
         {
           name: '{{$val->age}}',
            sliced: true,
           x:'{!! $val->tot_age!!}',
           y : {!! $val->tot_age !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieAgeAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name} Tahun</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($age_all as $val)
         {
           name: '{{$val->age}}',
            sliced: true,
           x:{!! $val->tot_age !!},
           y : {!! $val->tot_age !!}

         },
         @endforeach

        ]
    }]
});
/* ============ END CHART FOR AGE ================= */


/* ============ CHART FOR POSITION NAME ================= */


Highcharts.chart('piePositionName', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name} Tahun: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name} </b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

        @foreach($position_name_hired as $val)
         {
           name: '{{$val->position_name}}',
            sliced: true,
           x:{!! $val->tot_position_name !!},
           y : {!! $val->tot_position_name !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('piePositionNameAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name} Tahun</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

          @foreach($position_name_all as $val)
         {
           name: '{{$val->position_name}}',
            sliced: true,
           x:{!! $val->tot_position_name !!},
           y : {!! $val->tot_position_name !!}

         },
         @endforeach

        ]
    }]
});

/* ============ END CHART FOR POSITION NAME ================= */



/* ============ CHART REASON HIRING ================= */

Highcharts.chart('pieReasonHiring', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($reason_hiring_hired as $val)
         {
           name: '{{$val->request_reason}}',
            sliced: true,
           x:{!! $val->tot_request_reason !!},
           y : {!! $val->tot_request_reason !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieReasonHiringAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($reason_hiring_all as $val)
         {
           name: '{{$val->request_reason}}',
            sliced: true,
           x:{!! $val->tot_request_reason !!},
           y : {!! $val->tot_request_reason !!}

         },
         @endforeach

        ]
    }]
});
/* ============ END REASON HIRING ================= */



/* ============ CHART DIVISION ================= */

Highcharts.chart('pieDivision', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($division_hired as $val)
         {
           name: '{{$val->division}}',
            sliced: true,
           x:{!! $val->tot_division !!},
           y : {!! $val->tot_division !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieDivisionAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($division_all as $val)
         {
           name: '{{$val->division}}',
            sliced: true,
           x:{!! $val->tot_division !!},
           y : {!! $val->tot_division !!}

         },
         @endforeach

        ]
    }]
});
/* ============ END DIVISION ================= */



/* ============ CHART REQUESTER NAME ================= */

Highcharts.chart('pieRequesterName', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($requester_name_hired as $val)
         {
           name: '{{$val->requester_name}}',
            sliced: true,
           x:{!! $val->tot_requester_name !!},
           y : {!! $val->tot_requester_name !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieRequesterNameAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,

    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($requester_name_all as $val)
         {
           name: '{{$val->requester_name}}',
            sliced: true,
           x:{!! $val->tot_requester_name !!},
           y : {!! $val->tot_requester_name !!}

         },
         @endforeach

        ]
    }]
});
/* ============ END REQUESTER NAME ================= */

/* ============ CHART WORK LOCATION ================= */

Highcharts.chart('pieWorkLocation', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($work_location_hired as $val)
         {
           name: '{{$val->work_location}}',
            sliced: true,
           x:{!! $val->tot_work_location !!},
           y : {!! $val->tot_work_location !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieWorkLocationAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,

    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($work_location_all as $val)
         {
           name: '{{$val->work_location}}',
            sliced: true,
           x:{!! $val->tot_work_location !!},
           y : {!! $val->tot_work_location !!}

         },
         @endforeach

        ]
    }]
});
/* ============ END WORK LOCATION ================= */

/* ============ CHART CITY ================= */

Highcharts.chart('pieCity', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: 'HIRED',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($city_hired as $val)
         {
           name: '{{$val->city}}',
            sliced: true,
           x:{!! $val->tot_city !!},
           y : {!! $val->tot_city !!}

         },
         @endforeach

        ]
    }]
});



Highcharts.chart('pieCityAll', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,

    title: {
        text: 'ALL',
            style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: '',
        colorByPoint: true,
         data: [

         @foreach($city_all as $val)
         {
           name: '{{$val->city}}',
            sliced: true,
           x:{!! $val->tot_city !!},
           y : {!! $val->tot_city !!}

         },
         @endforeach

        ]
    }]
});
/* ============ END CITY ================= */




</script>
  
</body>
</html>
