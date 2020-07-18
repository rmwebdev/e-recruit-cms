@extends('layouts.app')

@section('content')
<style type="text/css">
  .select2-container .select2-selection--single{
    width: 100%;
  }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
          <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
            <div class="row">
              <div class="col-12">
                  <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Setting Role  </h3>   
              </div>
            </div>
              <a data-toggle="collapse" data-target="#setting-role">
                  <img id="image_bottom_form"  style="display: none" src="{{asset('images/icon_drop.png')}}">
                  <img id="image_top_form" src="{{asset('images/icon_top.png')}}">
                </a> 
          </nav>

          <div  id="setting-role" class="collapse show">
              <div class="row">
                <div class="col-6">
                  <div class="card mt-2  bg-abu-putih">
                    <div class="card-body">
                        <div class="section">
                          <form  id="form-role">
                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong>Nama Role</strong> </label>
                              <input type="hidden" name="id" id="id_role"   class="form-control">
                              <input type="text" name="name"   class="form-control">
                              <span class="invalid-feedback" role="alert"></span>
                            </div>

                            <div class="form-group pull-right">
                              <button class="btn btn-primary"  type="button" onclick="save_role()" id="btn-save">
                                <i class="fa fa-save"></i>
                                Save
                              </button>
                            </div>
                          </form>
                        </div>
                    </div>    
                  </div>  
                </div>

                <div class="col-6">
                  <div class="card mt-2  bg-abu-putih">
                    <div class="card-body">
                        <div class="section">
                          <table class="table table-striped table-bordered" id="table_role">
                            <thead>
                              <tr>
                                <td>Nama Role</td>
                                <td> Action </td>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($role as $r)
                              <tr>
                                  <td>{{$r->name}}</td>
                                  <td>
                                      <button class="btn btn-danger" type="button" onclick="delete_role({{$r->id}})"> <i class="fa fa-trash"></i> </button>
                                      <button class="btn btn-warning" type="button" onclick="edit_role({{$r->id}})"> <i class="fa fa-edit"></i> </button>
                                      <a class="btn btn-primary" href="{{url('role-permission',['id'=>$r->id])}}"> <i class="fa fa-gear"></i> </a>
                                  </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
{{--                           {{ $role->links() }}
 --}}                        </div>
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
<div class="modal fade" id="modal_permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Setting Banner</h5>
        <button type="button" class="close" onclick="closeModalBanner()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-setting-banner">

          <div class="form-group row">
            <div class="col-sm-12">
 
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @php $no = 1; @endphp
                        <table class="table table-striped">
                          <tr>
                            <td> Name </td>
                          </tr>
                        @foreach($permission as $per)
                          <tr>
                            <td> {{$per}} </td>
                          </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
          </div>
      </div>
  
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeModalBanner()" >Close</button>
          <button type="submit" class="btn btn-primary"> Save</button>
        </form>          
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->


@endsection

@section('js')
  <script type="text/javascript">

    $(function(){
        $('#table_role').DataTable();
    })

    function save_role()
    {
      var data_form = new FormData($('#form-role')[0]);
      $.ajax({
        url:'/setting-role/store',
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


    function permission(id)
    {
        $('#modal_permission').modal('show');
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

    function delete_role(id)
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
              url:'/setting-role/destroy/'+id,
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


    function closeModalBanner()
    {
       $('#modal_permission').modal('hide');
    }
  </script>
@endsection

