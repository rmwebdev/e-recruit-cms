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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

     <!-- Font awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.css') }}">

    <!-- Datatable  -->
    <link rel="stylesheet" href="{{ asset('vendor/jquery/jquery.dataTables.min.css') }}">
    <link href="{{ asset('vendor/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet">
   
    <!-- jQuery 3 -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>

    <!--- Select 2 ---->
    <script src="{{ asset('vendor/select2/js/select2.js') }}"></script>

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


</head>

<body  id="app">
{{-- @php 
    $user = Auth::user()->level_user;
@endphp --}}
<div id="trans" class="overlay" style="display:none"></div>
<div class="loading" style="display: none">
  <img src="{{asset('images/logo.png')}}"> 
</div>

    <div>
    
<main class="py-4">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-list"></i> SEARCH FPTK  
                    <span class="pull-right"><a href="javascript:void(0)" onclick="window.close()" class="btn btn-warning"> CLOSE </a>  </span>
                </div> 

                <div class="card-body">
                 <div class="card  border-default">
                  <h5 class="card-header  text-black bg-default"> Search FPTK</h5>
                  <div class="card-body">
                    <form method="get" id="submitSearchFPTK">
                      <div class="row">
                          <div class="col-10">
                              <input type="text" name="searchFPTK" class="form-control" value="{!! (empty($_GET['searchFPTK'])) ? "" : $_GET['searchFPTK'] !!}" placeholder="FPTK 99938">
                          </div> 
                          <div class="col-2">
                              <button class="btn btn-primary" id="btnSearchFPTK"><i class="fa fa-search"></i> Searching </button>
                          </div>
                      </div>
                    </form>
                  </div>
                </div>

                </div>
                <div class="card-body bodySearch" style="display:{!! (empty($_GET['searchFPTK'])) ? "none" : '' !!}">
                  <div class="row">

                    <div class="col-12">
                      <div class="row">
                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box bg-biru-muda text-center" id="cv_in"  style="cursor: pointer;">
                                      <h5>CV IN</h5>
                                      <h6>{{$cv_in}}</h6>
                                  </div>
                              </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box bg-hijau text-center" id="cv_sort"    style="cursor: pointer;">
                                        <h5>CV SORT</h5>
                                        <h6>{{$cv_sort}}</h6>
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box bg-biru-muda text-center" id="sort_list"   style="cursor: pointer;">
                                      <h5>CONSIDER</h5>
                                        <h6>{{$sort_list}}</h6>
                                  </div>
                              </div>
                          </div>
                          <div class="col-3">
                               
                                <div class="card card-hover">
                                    <div class="box bg-kuning text-center" id="called"   style="cursor: pointer;">
                                      <h5>INVITED</h5>
                                      <h6>{{$called}}</h6>
                                  </div>
                                </div>
                          </div>
                         
                      </div><!-- CARD TOP --->

                      <div class="row" style="margin-top:13px"> 


                         <div class="col-3">      
                                <div class="card card-hover">
                                  <div class="box bg-merah text-center" id="psychotest"  style="cursor: pointer;">
                                      <h5>PSYCHO TEST</h5>
                                      <h6>{{$psychotest}}</h6>
                                  </div>
                                </div>
                          </div>

                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box bg-biru text-center" id="initial_in"     style="cursor: pointer;">
                                      <h5>INITIAL INTERVIEW</h5>
                                      <h6>{{$initial_in}}</h6>
                                  </div>
                              </div>
                          </div>

                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box bg-hijau text-center" id="interview_1"     style="cursor: pointer;">
                                      <h5>INTERVIEW 1</h5>
                                      <h6>{{$intervew_1}}</h6>
                                  </div>
                              </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box bg-biru text-center" id="interview_2"   style="cursor: pointer;">
                                        <h5>INTERVIEW 2</h5>
                                        <h6>{{$intervew_2}}</h6>
                                    </div>
                                </div>
                          </div>
                         
                      </div><!-- CARD BOTTOM --->



                    <div class="row" style="margin-top:13px"> 
                           <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box bg-kuning text-center"  id="interview_3"  style="cursor: pointer;">
                                        <h5>INTERVIEW 3</h5>
                                        <h6>{{$intervew_3}}</h6>
                                    </div>
                                </div>
                          </div>

                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box bg-merah text-center" id="med_check"   style="cursor: pointer;">
                                        <h5>MED CHECK</h5>
                                        <h6>{{$med_check}}</h6>
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box bg-hijau text-center"  id="offering_letter"  style="cursor: pointer;">
                                        <h5>OFFERING LETTER</h5>
                                        <h6>{{$offering_letter}}</h6>
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box bg-biru-muda text-center" id="hired"   style="cursor: pointer;">
                                      <h5>HIRED</h5>
                                        <h6>{{$hired}}</h6>
                                  </div>
                              </div>
                          </div>
                      </div><!-- CARD BOTTOM --->
                    </div><!-- END COL 12 -->

                  </div> <!-- END ROW CARD -->
                
                  <br><br>
                  <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                 <table style="font-size:12px" id="tableSearchFptk" class="table table-bordered table-striped mdl-data-table" id="grid-job-registration">
                                       <thead>
                                        <tr align="center" style="font-weight:bold">
                                            <th>NO</th>            
                                            <th>JOB TITLE</th>
                                            <th>NAME HOLDER</th>
                                            <th>LASTEST COMPANY</th>
                                            <th>LATEST POSITION</th>
                                            <th>TOTAL EXPERIENCE (YEAR)</th>
                                            <th>MAJOR</th>
                                            <th>IPK</th>
                                            <th>LATEST PROCESS</th>
                                            <th>RESULT</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr align="center" style="font-weight:bold">
                                            <th>NO</th>            
                                            <th>JOB TITLE</th>
                                            <th>NAME HOLDER</th>
                                            <th>LASTEST COMPANY</th>
                                            <th>LATEST POSITION</th>
                                            <th>TOTAL EXPERIENCE (YEAR)</th>
                                            <th>MAJOR</th>
                                            <th>IPK</th>
                                            <th>LATEST PROCESS</th>
                                            <th>RESULT</th>
                                        </tr>
                                    </tfoot>
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
</main>


</div>


    <!-- EXPORT DATA -->
    <script src="{{ asset('vendor/jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/numeric.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.0.0/js/bootstrap.js') }}"></script>

    <!-- EXPORT DATA -->
    <script src="{{ asset('vendor/jquery/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript">
var getSearch = '{!! (empty($_GET['searchFPTK'])) ? "" : $_GET['searchFPTK'] !!}'
var tableSearchFPTK = $('#tableSearchFptk').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        processing: true,
        serverSide: true,
        ajax: {
            method: 'POST',
            url : "{{route('search-user-fptk.getData')}}",
            data:{'dataSearch':getSearch},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        
        columns: [
                 {
                    // this for numbering table
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
              
                {data: 'job_fptk_id'},
                {data: 'name_holder'},
                {data: 'exp_company'},
                {data: 'exp_position'},
                {data: 'exp_total_experience'},
                {data: 'edu_major'},
                {data: 'edu_ipk'},
                {data: 'process'},
                {data: 'result'},
        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
});


// SEARCH FILTER CUSTOM 2
// Setup - add a text input to each footer cell
$('#tableSearchFptk tfoot th').each( function ()
{
    var title = $(this).text();
    //alert(title);

    if(title=='JOB TITLE'||title=='NAME'||title=='LATEST COMPANY'||title=='LATEST POSITION'||title=='MAJOR'||title=='LATEST PROCESS'||title=='RESULT')
    {
        $(this).html( '<input type="text" style="width:100px;" placeholder="'+title+'" />' );
    }
});

// Apply the search
tableSearchFPTK.columns().every( function () {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
            that
                .search( this.value )
                .draw();
        }
    } );
});



function getDataStatusFptk(status)
{

    tableSearchFPTK.clear();
    tableSearchFPTK.destroy();
    

    tableSearchFPTK = $('#tableSearchFptk').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        processing: true,
        serverSide: true,
        ajax: {
            method: 'POST',
            url : "{{route('search-user-fptk.getDataWithStatus')}}",
            data:{status:status,dataSearch:getSearch},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        
        columns: [
                
                 {
                    // this for numbering table
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
              
                {data: 'job_fptk_id'},
                {data: 'name_holder'},
                {data: 'exp_company'},
                {data: 'exp_position'},
                {data: 'exp_total_experience'},
                {data: 'edu_major'},
                {data: 'edu_ipk'},
                {data: 'process'},
                {data: 'result'},
        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
    });
}





$("#cv_in").click(function(){

    hoverProcess('cv_in');
     getDataStatusFptk('CV IN');
    
});

$("#cv_sort").click(function(){
    hoverProcess('cv_sort');
    getDataStatusFptk('CV SORT');
});

$("#sort_list").click(function(){
    hoverProcess('sort_list');
    getDataStatusFptk('CONSIDER');
});

$("#called").click(function(){
    hoverProcess('called');
    getDataStatusFptk('CALLED');
});


$("#psychotest").click(function(){
    hoverProcess('psychotest');
    getDataStatusFptk('PSYCHOTEST');
});

$("#initial_in").click(function(){
    hoverProcess('initial_in');
    getDataStatusFptk('INITIAL INTERVIEW');
});

$("#interview_1").click(function(){
    hoverProcess('interview_1');
    
    getDataStatusFptk('INTERVIEW 1');
});

$("#interview_2").click(function(){
    hoverProcess('interview_2');
    getDataStatusFptk('INTERVIEW 2');
});

$("#interview_3").click(function(){
    hoverProcess('interview_3');
    getDataStatusFptk('INTERVIEW 3');
});


$("#med_check").click(function(){
    hoverProcess('med_check');
    getDataStatusFptk('MED CHECK');
});

$("#offering_letter").click(function(){
    hoverProcess('offering_letter');
    getDataStatusFptk('OFFERING LETTER');
});

$("#hired").click(function(){
    hoverProcess('hired');
    getDataStatusFptk('HIRED');

});
    </script>

</body>


</html>
