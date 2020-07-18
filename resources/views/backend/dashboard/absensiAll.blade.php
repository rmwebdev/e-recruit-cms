@extends('layouts.app')

@section('content')
<div class="container">

  <nav class="navbar bg-white mb-3" style="height: 55px;border-radius: 5px;">
    <div class="row">
        <form id="formCreateUser" target="_blank">
          <div class="col-md-12">
               <input type="text" name="data_absensi" id="scan_barcode" class="form-control" style="width: 400px" placeholder="Scan Barcode">
          </div>
        </form>
    </div>
  </nav>

  <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
    <div class="row">
        <div class="col-12 font-weight-900 color-ungu">
          Absensi Kehadiran
        </div>
    </div>

    <div class="pull-right font-weight-900" style="font-size: 16px"> 
      <div class="row">
          <div class="col-md-2" style="padding-left: 0">
<!--               <button class="btn bg-ungu color-white" onclick="getDataAbsensiDate_all()">
                All Date  
              </button> -->
              <table>
                <tr>
                  <td>
                    <a href="{{route('dashboard.absensi')}}">
                      <button class="btn bg-hijau color-white">
                        Current Date  
                      </button>
                    </a>
                  </td>
                  <td>
                    <a href="{{route('dashboard.absensiAll')}}">
                      <button class="btn bg-ungu color-white">
                        All Date  
                      </button>
                    </a>
                  </td>
                </tr>
              </table>
          </div>
      </div>
    </div>
  </nav>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="section">
                      <div class="table-responsive">
                        <table id="tableAbsensiAll" class="table table-striped table-bordered">
                          
                        </table>
                      </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">      
  $(function(){
    $('#scan_barcode').focus();

    var tableAbsensiAll = $('#tableAbsensiAll').DataTable({
        aaSorting: [[1, 'asc']],
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
            method: 'post',
            url : "{{route('dashboard.getDataAbsensiAll')}}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        columns: [
                 {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                ,title:'No'},
                {data: 'name_holder',name:'name_holder',title:'Name '},
                {data: 'process',name:'process',title:'Process'},
                {data: 'invitation_process',name:'invitation_process',title:'Invitation Process'},
                {data: 'date_process',name:'name_holder',title:'Date Invitation'},
                {data: 'position_name',name:'name_holder',title:'Position Name'},
                {data: 'status',title:'Status'},

        ]
    });

      $('#scan_barcode').keypress(function (e) {
          if (e.which == 412) {
              $('#scan_barcode').submit();
          }
      });
    })
</script>
@endsection