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
                  <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Setting Menu  </h3>   
              </div>
            </div>
              <a data-toggle="collapse" data-target="#setting-menu">
                  <img id="image_bottom_form"  style="display: none" src="{{asset('images/icon_drop.png')}}">
                  <img id="image_top_form" src="{{asset('images/icon_top.png')}}">
                </a> 
          </nav>

     

          <div  id="setting-menu" class="collapse show">
              <div class="row">
                <div class="col-6">
                  <div class="card mt-2  bg-abu-putih">
                    <div class="card-body">
                        <div class="section">
                          <form  id="form-menu">
                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong>Nama Menu</strong> </label>
                              <input type="hidden" name="id" id="menu_id"   class="form-control">
                              <input type="text" name="menu_name"   class="form-control">
                              <span class="invalid-feedback" menu="alert"></span>
                            </div>

                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong>Menu Parent</strong> </label>

                              <select name="menu_parent" id="menu_parent" class="form-control">
                                  <option value=""> Pilih Menu </option>
                                  <option value="0"> -- Jadikan Menu Utama -- </option>
                                  @foreach($parent as $p)
                                    <option value="{{$p->menu_id}}"> {{$p->menu_name}}  </option>
                                    @php 

                                      $sub_level = 0;
                                      $menu_ = DB::table('e_recruit.menu')->where('menu_parent',$p->menu_id)->get(); 


                                        if(!empty($menu_))
                                        {   
                                            $sub_level++;
                                            foreach ($menu_ as  $value) 
                                            {
                                                $sparator='';
                                                for($z=0;$z<$sub_level;$z++)
                                                {
                                                    $sparator .='---';
                                                }
                                                
                                                echo '<option value='.$value->menu_id.'>'.$sparator.$value->menu_name.'</option>';
                                                // $sub($value->menu_id,$sub_level,$p->menu_id);
                                            }
                                        }   
                                    @endphp

                                  @endforeach
                              </select>
                              <span class="invalid-feedback" menu="alert"></span>
                            </div>                            

                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong>Menu Url</strong> </label>
                              <input type="text" name="menu_url"   class="form-control">
                              <span class="invalid-feedback" menu="alert"></span>
                            </div>

                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong>Menu Type</strong> </label>                            
                              <select class="form-control" name="type">
                                  <option value=""> - Choose Type -   </option>
                                  <option value="navbar"> Navbar </option>
                                  <option value="dropdown"> Dropdown </option>
                              </select>
                              <span class="invalid-feedback" menu="alert"></span>
                            </div>



                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong> No Urut </strong> </label>
                              <input type="text" name="no_urut"   class="form-control number_valid_char">
                              <span class="invalid-feedback" menu="alert"></span>
                            </div>

                            <div class="form-group pull-right">
                              <button class="btn btn-primary"  type="button" onclick="save_menu()" id="btn-save">
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
                          <table class="table table-striped table-bordered" id="table-menu">
                            <thead>
                              <tr>
                                <td>Nama Menu</td>
                                <td>Menu Url</td>
                                <td>Menu Parent</td>
                                <td> Sequence Number</td>
                                <td> Action </td>
                              </tr>
                            </thead>
                            <tbody>
                              	@foreach($menu as $m)
                              	<tr>
                                  <td> {{$m->menu_name}}</td>
                                  <td> {{$m->menu_url}}</td>
                                  <td> {{$m->menu_parent}}</td>
                                  <td> {{$m->no_urut}}</td>
                                  <td>
                                      <button class="btn btn-danger" type="button" onclick="delete_menu({{$m->menu_id}})"> <i class="fa fa-trash"></i> </button>
                                      <button class="btn btn-warning" type="button" onclick="edit_menu({{$m->menu_id}})"> <i class="fa fa-edit"></i> </button>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                              </tr>
                          </table>
                          {{-- {{ $menu->links() }} --}}
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
<div class="modal fade" id="modal_permission" tabindex="-1" menu="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" menu="document">
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
        $('#table-menu').DataTable();
    })

    function save_menu()
    {
      var data_form = new FormData($('#form-menu')[0]);
      $.ajax({
        url:'/setting-menu/store',
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

    function edit_menu(id)
    {
        $.ajax({
            url:'/setting-menu/edit/'+id,
            type:'GET',
            dataType: "json",
            success:function(data)
            {   
                console.log(data);
                $('#menu_id').val(data.data.menu_id)
                $('[name="menu_name"]').val(data.data.menu_name)
                $('[name="menu_url"]').val(data.data.menu_url)
                $('[name="no_urut"]').val(data.data.no_urut)
                $('[name="menu_parent"]').val(data.data.menu_parent)
                $('[name="type"]').val(data.data.type)
                $('#btn-save').text('Update')
                $('[name="menu_name"]').focus();
            },
        }).fail(function(data){
          var dt = data.responseJSON;
          if(dt.errors)
          {   
            console.log(dt.errors);
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

    function delete_menu(id)
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
              url:'/setting-menu/destroy/'+id,
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

