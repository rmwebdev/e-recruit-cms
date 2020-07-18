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
                            <div class="form-group">
                              <label for="" class="control-label font-14"> <strong>Role Permission</strong> </label>
                              <input type="hidden" name="id" id="id_role"  value="{{$role->id}}" class="form-control">
                              <input type="text" name="role_name" value="{{$role->name}}"  class="form-control" readonly>
                              <span class="invalid-feedback" role="alert"></span>
                            </div>

                            <div class="form-group pull-right">
                              	<a  href="{{url('setting-role')}}" class="btn btn-default mr-2"  id="btn-save">
                                	Cancel
                            	</a>
                              <button class="btn btn-primary"  type="button" onclick="save_role_permission()" id="btn-save">
                                <i class="fa fa-save"></i>
                                Save
                              </button>
                            </div>
                        </div>
                    </div>    
                  </div>  
                </div>

                <div class="col-6">
                  <div class="card mt-2  bg-abu-putih">
                    <div class="card-body">
                        <div class="section">
                        	<form id="form-role-permission">
                        		
	                          <table class="table table-striped table-bordered" id="table-role-permission">
                              <thead>
	                              <tr>
	                                <th><input type="checkbox" name="all" id="checkall" value="0"> ALL</th>
	                                <th> Permission Name </th>
	                              </tr>
                              </thead>
                              <tbody>
	                              @foreach($permission as $r)
	                              <tr>
	                                  <td> <input type="checkbox" name="role" value="{{$r->id}}" {{ in_array($r->name, $hasPermission) ? 'checked':'' }}> </td>
	                                  <td>{{$r->name}}</td>
	                              </tr>
	                              @endforeach
                              </tbody>
	                          </table>
                          </form>
                          
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


    </div>
  </div>
</div>
<!-- end Modal -->


@endsection

@section('js')
  <script type="text/javascript">

    // $(function(){
    //   $('#table-role-permission').DataTable();
    // })

  $("#checkall").on('click', function () {
    $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
  });


    function save_role_permission()
    {

    	var role_id = [];
	    $.each($('[name="role"]:checked'),function(){
	        role_id.push($(this).val());
	    })

	    if(role_id == '' || role_id==null)
	    {
	        swal('Error','Please select the permission  first!','error');
	        return false;
	    }    
	   

	    // var data_ =   new FormData($("#form-role-reff")[0]);
	    // data_.append('role_id',role_id);
	    // data_.append('type',type);



	    console.log(role_id);

      // var data_form = new FormData($('#form-role-permission')[0]);
      $.ajax({
        url:'/save-role-permission',
        type:'POST',
        data:{role_id:role_id,role_name:$('[name="role_name"]').val()},
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

  </script>
@endsection

