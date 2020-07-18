@extends('layouts.app')

@section('content')
<style type="text/css">
  
  .select2-container .select2-selection--single{
    width: 450px;
  }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
            <div class="row">
              <div class="col-12">
                  <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> LIST USER  </h3>   
              </div>
            </div>
            <div class="pull-right">
              <a class="btn btn-success"  href="javascript:void(0)" style="color: #fff" onclick="upload_user()"><i class="fa fa-file-excel-o"></i> UPLOAD USER
              </a>
              <a class="btn bg-ungu"  href="{{url('add-user')}}" style="color: #fff"><i class="fa fa-plus"></i> ADD USER
              </a>
            </div>
          </nav>

          <div  id="setting-role" class="collapse show">
              <div class="row">
                <div class="col-12">
                  <div class="card mt-2">
                    <div class="card-body">
                        <div class="section">
                          <table class="table" id="table-user">
                            <thead>
                              <tr>
                                <td>NO</td>
                                <td> NIK </td>
                                <td>NAME</td>
                                <td>NAMA ROLE </td>
                                <td> POSISI </td>
                                <td> EMAIL </td>
                                <td> ACTION </td>
                              </tr>
                            </thead>
                          </table>
                        </div>
                    </div>    
                  </div>  
                </div>

              </div>
          </div>

      </div>

        </div>
    </div>
</div>


<!-- Modal   Upload -->
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12">
                <div class="col-12">
                  <form id="form_upload_file">
                    <label> Upload File </label>
                    <input type="file" name="upload_file" class="form-control">
                    <i class="invalid-feedback" role="alert"></i>
                  </form>
                </div>
              
                  
            </div>
          </div>
      </div>
  
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeModalUpload()" >Close</button>
          <button type="button" onclick="save_upload()" class="btn btn-primary" > Save</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

<!-- Modal   setting role -->
<div class="modal fade" id="modal_setting_role"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body">
            <form id="form-role">
                <div class="form-group row">
                  <label for="" class="col-sm-12 col-form-label">  SETTING ROLE  </label>
                  <div class="col-sm-12">
                    <input type="hidden" name="user_id_modal">
                    <select name="role_id" class="form-control">
                      <option value="">Pilih Role</option>
                      @foreach($role as $r)
                        <option value="{{$r->id}}" >  {{$r->name}} </option>
                      @endforeach
                    </select>
                  <i class="invalid-feedback" role="alert"></i>
                  </div>
                </div>
          </form>

      </div>
  
      <div class="modal-footer">
          <button type="button" onclick="save_role()" class="btn btn-primary" > Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->


@endsection

@section('js')
  <script type="text/javascript">

$(document).ready(function() {

  $('[name="cost_center"]').select2();

    var table_user = $('#table-user').DataTable({
        // aaSorting: [[1, 'desc']],
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
            method: 'GET',
            url : "{{route('setting-user.get_data_user')}}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        order:[[1,'desc']],
        
        columns: [
                {data: 'user_id',
                    // this for numbering table
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'nip'},
                {data: 'name'},
                {data: 'role_name','name':'name'},
                {data: 'position'},
                {data: 'email_user'},
                {data: 'user_id',
                render: function(data, type, row){
          
                 return  '<button class="btn btn-danger" type="button" onclick="delete_user('+row.user_id+')"> <i class="fa fa-trash"></i> </button> '+
                        '<a class="btn btn-warning" href="/setting-user/edit_user/'+row.user_id+'"> <i class="fa fa-edit"></i> </a> '+
                        '<button class="btn btn-success" onclick="setting_role('+row.user_id+','+row.role_id+')"> <i class="fa fa-user"></i> </button>'
                }
            }
        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
      });

        $('div.dataTables_filter input').unbind();
        $("div.dataTables_filter input").keyup( function (e) {
            if (e.keyCode == 13) {
                table_user.search( this.value ).draw();
            }
        });

    })

    function save_upload()
    {
        var data_upload = new FormData($('#form_upload_file')[0]);

        console.log(data_upload);
        swal({
          title: "Are you sure?",
          text: "This Process?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url:'{{url('/setting-user/store/')}}',
                type:'POST',
                data:data_upload,
                dataType: "json",
                headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                cache:false,
                contentType:false,
                processData:false,
                success:function(data)
                {   
                    swal('Success','Data berhasil di input','success')
                    .then(function(){
                        location.reload(true);    
                    });
                    
                },
              }).fail(function(data){
                  var dt = data.responseJSON;
                  if(dt.errors)
                  {   
                      $.each(dt.errors, function (key, value) {
                          var input = '[name=' + key + ']';
                          
                          $(input + '+i').html('<strong>'+ value +'</strong>');
                          $(input).addClass('is-invalid');
                          $(input).focus();
                          $(input).change(function(){
                              $(input).removeClass('is-invalid');
                          })
                      });                
                  }
                  else
                  {
                    swal('Errors','Format Wrong','error')
                  }
                });
          }
        });
    }

    function upload_user()
    {
        $('#modal_upload').modal('show');
    }

    function setting_role(id,role)
    {
     
      $('[name="user_id_modal"]').val(id);
      $('[name="role_id"]').val(role);
      $('#modal_setting_role').modal('show');
    }

    function save_role()
    {
      var data_form = new FormData($('#form-role')[0]);
      $.ajax({
        url:'/setting-user/save_role',
        type:'POST',
        data:data_form,
        dataType: "json",
        headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success:function(data)
        {   
             swal('Success','Data berhasil di simpan','success')
                  .then(function(){
                      location.reload(true);    
              });
        },
          cache:false,
          contentType:false,
          processData:false,
      }).fail(function(data){
          var dt = data.responseJSON;
          if(dt.errors)
          {   
              $.each(dt.errors, function (key, value) {
                  var input = '[name=' + key + ']';
                  
                  $(input + '+span').html('<strong>'+ value +'</strong>');
                  $(input).addClass('is-invalid');
                  $(input).focus();
                  $(input).change(function(){
                      $(input).removeClass('is-invalid');
                  })
              });                
          }
      });
    }


    function permission()
    {
        $('#modal_upload').modal('show');
    }

    function edit_role(id)
    {
        $.ajax({
            url:'/setting-role/edit/'+id,
            type:'GET',
            dataType: "json",
            success:function(data)
            {   

                $('#id_role').val(data.data.id)
                $('[name="name"]').val(data.data.name)
                $('#btn-save').text('Update')
            },
        }).fail(function(data){
          var dt = data.responseJSON;
          if(dt.errors)
          {   
              $.each(dt.errors, function (key, value) {
                  var input = '[name=' + key + ']';
                  
                  $(input + '+span').html('<strong>'+ value +'</strong>');
                  $(input).addClass('is-invalid');
                  $(input).focus();
                  $(input).change(function(){
                      $(input).removeClass('is-invalid');
                  })
              });                
          }
        }); 
    }

    function delete_user(id)
    {
      swal({
        title: "Are you sure?",
        text: "This Process?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url:'/setting-user/destroy/'+id,
              type:'GET',
              dataType: "json",
              success:function(data)
              {   
                  swal('Success','Data berhasil di hapus','success')
                  .then(function(){
                      location.reload(true);    
                  });
                  
              },
            }); 
        }
      });
    }


    function closeModalUpload()
    {
       $('#form_upload_file')[0].reset();
        $('[name="upload_file"]').removeClass('is-invalid');
       $('#modal_upload').modal('hide');
    }
  </script>
@endsection

