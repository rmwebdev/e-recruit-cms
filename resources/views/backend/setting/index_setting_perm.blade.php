@extends('layouts.app')

@section('content')
<style type="text/css">
  .select2-container .select2-selection--single{
    width: 100%;
  }
</style>

<div class="container">
    <div class="row">
      <div class="col-md-12 mt-2">
          <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
            <div class="row">
              <div class="col-12">
                  <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Setting Permission  </h3>   
              </div>
            </div>
              <a data-toggle="collapse" data-target="#setting-permission">
                  <img id="image_bottom_form"  style="display: none" src="{{asset('images/icon_drop.png')}}">
                  <img id="image_top_form" src="{{asset('images/icon_top.png')}}">
                </a> 
          </nav>

          <div  id="setting-permission" class="collapse show">
              <div class="row">
                

                <div class="col-6">
                  <div class="card mt-2  bg-abu-putih">
                    <div class="card-body">
                        <div class="section">
                          <form  id="form-permission">
                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong>Menu</strong> </label>

                              <select class="form-control" name="menu_id">
                                <option value=""> - Pilih Menu - </option>
                                @foreach($menu as $m)
                                  <option value="{{$m->menu_id}}">{{$m->menu_name}}</option>
                                @endforeach
                              </select>
                              <span class="invalid-feedback" role="alert"></span>
                            </div>    


                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong> Nama Permission </strong> </label>
                              <input type="hidden" name="id" id="id_permission"   class="form-control">
                              <input type="text" name="name"   class="form-control">
                              <span class="invalid-feedback" role="alert"></span>
                            </div>

                            <div class="form-group pull-right">
                              <button class="btn btn-primary"  type="button" onclick="save_permission()" id="btn-save">
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
                          <table class="table table-striped table-bordered" id="table-perm">
                            <thead>
                              <tr>
                                <td>Nama Menu</td>
                                <td>Nama Role</td>
                                <td> Action </td>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($perm as $r)
                              <tr>
                                  <td>{{ (!empty($r->menu_name)) ?  $r->menu_name :""}}</td>
                                  <td>{{$r->name}}</td>
                                  <td>
                                      <button class="btn btn-danger" type="button" onclick="delete_permission({{$r->id}})"> <i class="fa fa-trash"></i> </button>
                                      <button class="btn btn-warning" type="button" onclick="edit_permission({{$r->id}})"> <i class="fa fa-edit"></i> </button>
                                  </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
{{--                           {{ $perm->links() }}
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
@endsection

@section('js')
  <script type="text/javascript">

    $(function(){
        $('#table-perm').DataTable();
    })

    function save_permission()
    {
      var data_form = new FormData($('#form-permission')[0]);
      $.ajax({
        url:'/setting-permission/store_perm',
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


    function edit_permission(id)
    {
        $.ajax({
            url:'/setting-permission/edit_perm/'+id,
            type:'GET',
            dataType: "json",
            success:function(data)
            {   

                $('#id_permission').val(data.data.id)
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

    function delete_permission(id)
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
              url:'/setting-permission/destroy_perm/'+id,
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
  </script>
@endsection

