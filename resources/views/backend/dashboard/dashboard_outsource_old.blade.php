<!doctype html>
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
  if($get_year)
  {
      $year_op = $_GET['year'];
  }
  else
  {
      $year_op = date('Y');
  }
@endphp
<center><h3><b><u>DASHBOARD NON EMPLOYEE  {{$year_op}}</u></b></h3></center>
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




<!-- POSITION NAME -->
<center><h3> PROJECT NAME </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="project" class="col-md-12"></div>
          <!-- <div id="project_employee" class="col-md-6"></div> -->
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
          <div id="position" class="col-md-12"></div>
          <!-- <div id="position_employee" class="col-md-6"></div> -->
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
          <div id="pieRequesterName_baru" class="col-md-12"></div>
          <!-- <div id="pieRequesterNameAll_baru" class="col-md-6"></div> -->
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
          <div id="division" class="col-md-12"></div>
          <!-- <div id="division_employee" class="col-md-6"></div> -->
        </div>

      </div>
    
    </div>
  </div>
<hr/>



<!-- COST CENTER  -->
<center><h3> COST CENTER (ENTITI)  </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="cost_center" class="col-md-12"></div>
          <!-- <div id="cost_center_employee" class="col-md-6"></div> -->
        </div>

      </div>
    
    </div>
  </div>
<hr/>


<!-- COST CENTER  -->
<center><h3> PT OS  </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="pt_os" class="col-md-12"></div>
          <!-- <div id="pt_os_employee" class="col-md-6"></div> -->
        </div>

      </div>
    
    </div>
  </div>
<hr/>




<!-- WORK LOCATION  -->
<center><h3> WORK LOCATION  </h3></center><br/>
  <div class="container-fluid">
    <div class="row"  style="font-size: 10px">
      <div class="col-md-12" align="center">
    
      </div>
      <div class="col-md-12"> 
        <div class="row"  style="font-size: 10px">
          <div id="work_location" class="col-md-12"></div>
          <!-- <div id="work_location_employee" class="col-md-6"></div> -->
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



/* ============ FULLFILLMENT ================= */
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
          color: "#F54E5E"
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
           color: "#F54E5E"

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

/* =================================== END FULLFILLMENT  ================================== */


/* ============ OPEN & CLOSE ================= */


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
          color: '#F54E5E'
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
          color: "#F54E5E"

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


/* ============ END OPEN & CLOSE ================= */




/* ============ PROJECT ================= */



Highcharts.chart('project', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
 colors:color_chart,
    title: {
        text: '',
        style: {
                fontWeight: 'bold',
                fontSize:'18px',
            }
    },
    tooltip: {
        // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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

         @foreach($project as $val)
         {
           name: '{{$val->project_name}}',
            sliced: true,
           x:{!! $val->jumlah !!},
           y : {!! $val->jumlah !!}

         },
         @endforeach    
       ]
    }]
});




// Highcharts.chart('project_employee', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     colors:color_chart,
//     title: {
//         text: '',
//             style: {
//                 fontWeight: 'bold',
//                 fontSize:'18px',
//             }
//     },
//     tooltip: {
//         // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//         pointFormat: ''

//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: true,
//                 // format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
//                 format: '',

//                 style: {
//                     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//                 }
//             }
//         }
//     },
//     series: [{
//         name: '',
//         colorByPoint: true,
//          data: [

//         // @foreach($project_employee as $val)
//         //  {
//         //    name: '{{$val->name_holder}}',
//         //     sliced: true,
//         //    x:{!! $val->project_name !!},
//         //    y : {!! $val->project_name !!}

//         //  },
//         //  @endforeach
       

//         ]
//     }]
// });

/* ============ END PROJECT ================= */





/* ============ POSITION ================= */



Highcharts.chart('position', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
 colors:color_chart,
    title: {
        text: '',
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

         @foreach($position as $val)
         {
           name: '{{$val->position_name}}',
            sliced: true,
           x:{!! $val->jumlah !!},
           y : {!! $val->jumlah !!}

         },
         @endforeach    
       ]
    }]
});




// Highcharts.chart('position_employee', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     colors:color_chart,
//     title: {
//         text: '',
//             style: {
//                 fontWeight: 'bold',
//                 fontSize:'18px',
//             }
//     },
//     tooltip: {
//         // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//         pointFormat: '{'

//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: true,
//                 // format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
//                 format: '',

//                 style: {
//                     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//                 }
//             }
//         }
//     },
//     series: [{
//         name: '',
//         colorByPoint: true,
//          data: [

//         // @foreach($position_employee as $val)
//         //  {
//         //    name: '{{$val->name_holder}}',
//         //     sliced: true,
//         //    x:{!! $val->position_name !!},
//         //    y : {!! $val->position_name !!}

//         //  },
//         //  @endforeach
       

//         ]
//     }]
// });

/* ============ END POSITION ================= */




/* ============ CHART REQUESTER NAME ================= */

Highcharts.chart('pieRequesterName_baru', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    colors:color_chart,
    title: {
        text: '',
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

         @foreach($requester_name_hired_baru as $val)
         {
           name: '{{$val->name}}',
            sliced: true,
           x:{!! $val->jumlah !!},
           y : {!! $val->jumlah !!}

         },
         @endforeach

        ]
    }]
});

// Highcharts.chart('pieRequesterNameAll_baru', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     colors:color_chart,

//     title: {
//         text: '',
//             style: {
//                 fontWeight: 'bold',
//                 fontSize:'18px',
//             }
//     },
//     tooltip: {
//         // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//         pointFormat: ''

//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: true,
//                 // format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
//                 format: '',

//                 style: {
//                     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//                 }
//             }
//         }
//     },
//     series: [{
//         name: '',
//         colorByPoint: true,
//          data: [

//          // @foreach($requester_name_all_baru as $val)
//          // {
//          //   name: '{{$val->requester_name}}',
//          //    sliced: true,
//          //   x:{!! $val->jumlah !!},
//          //   y : {!! $val->jumlah !!}

//          // },
//          // @endforeach

//         ]
//     }]
// });
/* ============ END REQUESTER NAME ================= */





/* ============ DIVISION ================= */
Highcharts.chart('division', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
 colors:color_chart,
    title: {
        text: '',
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

         @foreach($division as $val)
         {
           name: '{{$val->division}}',
            sliced: true,
           x:{!! $val->jumlah !!},
           y : {!! $val->jumlah !!}

         },
         @endforeach    
       ]
    }]
});




// Highcharts.chart('division_employee', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     colors:color_chart,
//     title: {
//         text: '',
//             style: {
//                 fontWeight: 'bold',
//                 fontSize:'18px',
//             }
//     },
//     tooltip: {
//         // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//         pointFormat: ''

//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: true,
//                 // format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
//                 format: '',

//                 style: {
//                     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//                 }
//             }
//         }
//     },
//     series: [{
//         name: 'DIVISION',
//         colorByPoint: true,
//          data: [

//         // @foreach($division_employee as $val)
//         //  {
//         //    name: '{{$val->name_holder}}',
//         //     sliced: true,
//         //    x:{!! $val->division !!},
//         //    y : {!! $val->division !!}

//         //  },
//         //  @endforeach
       

//         ]
//     }]
// });

/* ============ END DIVISION ================= */





/* ============ COST CENTER ================= */
Highcharts.chart('cost_center', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
 colors:color_chart,
    title: {
        text: '',
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

         @foreach($cost_center as $val)
         {
           name: '{{$val->cost_center}}',
            sliced: true,
           x:{!! $val->jumlah !!},
           y : {!! $val->jumlah !!}

         },
         @endforeach    
       ]
    }]
});




// Highcharts.chart('cost_center_employee', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     colors:color_chart,
//     title: {
//         text: '',
//             style: {
//                 fontWeight: 'bold',
//                 fontSize:'18px',
//             }
//     },
//     tooltip: {
//         // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//         pointFormat: ''

//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: true,
//                 // format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
//                 format: '',

//                 style: {
//                     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//                 }
//             }
//         }
//     },
//     series: [{
//         name: '',
//         colorByPoint: true,
//          data: [

//         // @foreach($cost_center_employee as $val)
//         //  {
//         //    name: '{{$val->name_holder}}',
//         //     sliced: true,
//         //    x:{!! $val->cost_center !!},
//         //    y : {!! $val->cost_center !!}

//         //  },
//         //  @endforeach
       

//         ]
//     }]
// });

/* ============ END COST CENTER ================= */




/* ============ PT OS ================= */
Highcharts.chart('pt_os', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
 colors:color_chart,
    title: {
        text: '',
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

         @foreach($pt_os as $val)
         {
           name: '{{$val->company_name}}',
            sliced: true,
           x:{!! $val->count_company_name !!},
           y : {!! $val->count_company_name !!}

         },
         @endforeach    
       ]
    }]
});




// Highcharts.chart('pt_os_employee', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     colors:color_chart,
//     title: {
//         text: '',
//             style: {
//                 fontWeight: 'bold',
//                 fontSize:'18px',
//             }
//     },
//     tooltip: {
//         // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//         pointFormat: ''

//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: true,
//                 // format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
//                 format: '',

//                 style: {
//                     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//                 }
//             }
//         }
//     },
//     series: [{
//         name: '',
//         colorByPoint: true,
//          data: [

//         // @foreach($pt_os_employee as $val)
//         //  {
//         //    name: '{{$val->name_holder}}',
//         //     sliced: true,
//         //    x:{!! $val->count_company_name !!},
//         //    y : {!! $val->count_company_name !!}

//         //  },
//         //  @endforeach
       

//         ]
//     }]
// });

/* ============ END PT OS ================= */




/* ============ WORK LOCATION ================= */
Highcharts.chart('work_location', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
 colors:color_chart,
    title: {
        text: '',
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

         @foreach($work_location as $val)
         {
           name: '{{$val->work_location}}',
            sliced: true,
           x:{!! $val->jumlah !!},
           y : {!! $val->jumlah !!}

         },
         @endforeach    
       ]
    }]
});




// Highcharts.chart('work_location_employee', {
//     chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'
//     },
//     colors:color_chart,
//     title: {
//         text: '',
//             style: {
//                 fontWeight: 'bold',
//                 fontSize:'18px',
//             }
//     },
//     tooltip: {
//         // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
//         pointFormat: ''

//     },
//     plotOptions: {
//         pie: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: {
//                 enabled: true,
//                 // format: '<b>{point.name}</b>: {point.percentage:.1f}% <b> Total:{point.x}</b>',
//                 format: '',

//                 style: {
//                     color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
//                 }
//             }
//         }
//     },
//     series: [{
//         name: '',
//         colorByPoint: true,
//          data: [

//         // @foreach($work_location_employee as $val)
//         //  {
//         //    name: '{{$val->name_holder}}',
//         //     sliced: true,
//         //    x:{!! $val->work_location !!},
//         //    y : {!! $val->work_location !!}

//         //  },
//         //  @endforeach
       

//         ]
//     }]
// });

/* ============ END WORK LOCATION ================= */




</script>  
</body>
</html>
