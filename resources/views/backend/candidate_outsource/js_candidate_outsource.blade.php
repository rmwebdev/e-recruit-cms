<script type="text/javascript">
var user ='{{Auth::user()->nip}}';
var nama_user ='{{Auth::user()->name}}';
$(function(){
    var form_validate = $( "#form-fptk-outsource" );
        form_validate.validate({
            errorElement: 'p',
            errorClass: 'help-block',
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            }   
        });

    $('.select2').select2();
    $('#join_date').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });

    $('[name="required_date_fptk"]').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });

    $('[name="ass_tgl_akhir_kontrak"]').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });

    $('[name="ass_tgl_penilaian"]').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });

    $('[name="date_of_birth"]').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });

    $('#end_date').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
    });

    
    number_valid_char();


    var table_outsource = $('#table-fptk-outsource').DataTable({
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
            method: 'POST',
            url : "{{route('get-fptk-outsource')}}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },

        order:[[1,'desc']],
        
        columns: [
                {data: 'job_fptk_id',
                    // this for numbering table
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'request_job_number','name':'request_job_number',
                    render: function(data,type,row){
                        return '<a href="/approved-fptk-outsource?id='+row.job_fptk_id+'">'+row.request_job_number+'</a></td>'
                    }
                },
                // {data: 'position_name','name':'position_name'}, // Asli
                {data: 'position_name','name':'position_name',
                    render: function(data,type,row){
                        return '<a href="/view-fptk-outsource-candidate?id='+row.job_fptk_id+'">'+row.position_name+'</a></td>'
                    }
                },
                {data: 'user_name','name':'user_name'},
                {data: 'request_reason','name':'request_reason'},
                {data: 'requested_staff','name':'requested_staff'},
                {data: 'actual_staff','name':'actual_staff'},
                {data: 'work_location','name':'work_location'},
                {data: 'project_name','name':'project_name'},
                {data: 'required_date_fptk','name':'required_date_fptk'},
                {data: 'employment_type','name':'employment_type'},

                {data: 'status','name':'status',
                    render: function (data, type, row) {
                        if(row.status === 'new')
                        {
                            return  "<div class='alert alert-success'> "+row.status+" </div>";
                        }
                        else if(row.status == 'rejected')
                        {
                            return '<div class="alert alert-danger"> '+row.status+' </div>';
                        }   
                        else
                        {
                            return '<div class="alert alert-primary">'+row.status+'</div>'
                        }
                    }
                },
                // {data: 'job_fptk_id',name:'job_fptk_id',
                //     render: function(data, type, row)
                //     {
                //         return '<a class="btn btn-primary" href="assessment-fptk-outsource/'+row.job_fptk_id+'?status='+row.status+'">Assessment</a> '
                //     }
                // },
                {data: 'job_fptk_id',name:'job_fptk_id',
                    render: function(data, type, row){
                        if(row.user_name === nama_user)
                        {
                           if(row.status == 'new')
                            {
                                return '<a class="btn btn-warning" href="edit-fptk-outsource/'+row.job_fptk_id+'?status='+row.status+'"> <i class="fa fa-edit"></i> </a> '
                            }
                            else if(row.status == 'draft')
                            {
                               return'<a class="btn btn-warning" style="margin-bottom:10px" href="edit-fptk-outsource/'+row.job_fptk_id+'?status='+row.status+'"> <i class="fa fa-edit"></i> </a> '+
                               '<button class="btn btn-danger" type="button" onclick="del_fptk('+row.job_fptk_id+')"> <i class="fa fa-trash"></i> </button> '
                            }
                            else
                            {
                                return '';
                            }
                        }
                        else if(nama_user === 'User Developer')
                        {
                           if(row.status == 'new')
                            {
                                return '<a class="btn btn-warning" href="edit-fptk-outsource/'+row.job_fptk_id+'?status='+row.status+'"> <i class="fa fa-edit"></i> </a> '
                            }
                            else if(row.status == 'draft')
                            {
                               return'<a class="btn btn-warning" style="margin-bottom:10px" href="edit-fptk-outsource/'+row.job_fptk_id+'?status='+row.status+'"> <i class="fa fa-edit"></i> </a> '+
                               '<button class="btn btn-danger" type="button" onclick="del_fptk('+row.job_fptk_id+')"> <i class="fa fa-trash"></i> </button> '
                            }
                            else
                            {
                                return '';
                            }
                        }
                        else
                        {
                            return '';
                        }
                    }
                },
                {data: 'subco',name:'subco',
                    render: function(data, type, row){
                    if(nama_user === 'User Developer')
                    {
                       if(row.subco == 'yes')
                        {
                            return '<p align="center"><img src="images/checklist.png" width="20" height="20"></p>'
                        }
                        else
                        {
                            return '<p align="center"><img src="images/no_checklist.png" width="20" height="20"></p>';
                        }
                    }
                    else
                    {
                        return '<p align="center"><img src="images/min.png" width="20" height="20"></p>';
                    }
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
            table_outsource.search( this.value ).draw();
        }
    });

    $(".range").on("keypress", function (event) {
      var regex = /[0-9-.]/g;
      var key = String.fromCharCode(event.which);
      if (regex.test(key) || event.keyCode == 8 || event.keyCode == 9) {
          return true;
      }

        return false;
    });

})

    function get_reason(e)
    {
        if($(e).val() == "replacement")
        {
            $('#employee_name_replace').show();
        }
        else
        {
            $('#employee_name_replace').hide();   
        }
    }

    function saveDraft(status)
    {        

        var data_candidate= new FormData($('#form-fptk-outsource')[0]);
        if(status == 'draft')
        {
            data_candidate.append('status','draft');    
        }
        else
        {
            data_candidate.append('status','new');       
        }
        swal({
              title: "Are you sure",
              text: " Save this data ?",
              icon: "warning",
              buttons: true,
              dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // form_validate.valid();

                    $.ajax({
                        url:'{{route('save-fptk-outsource')}}',
                        type:'POST',
                        data:data_candidate,
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                          cache:false,
                          contentType:false,
                          processData:false,
                    }) .done(function(data) {
                            if(data.status == 'success')
                            {
                                swal('Success','Job FPTK  has been saved successfully!','success');
                                // location.reload(true);    
                                $(location).attr('href','/create-fptk-outsource');    
                            }
                            
                        })
                        .fail(function(data) {
                            
                            var dt = data.responseJSON;
                            $.each(dt.errors, function (key, value) {
                                var input = '[name=' + key + ']';
                                
                                $(input + '+span').html('<strong>'+ value +'</strong>');
                                $(input).addClass('is-invalid');
                                $(input).focus();
                                $(input).change(function(){
                                    $(input).removeClass('is-invalid');
                                })
                            });
                    });
                }
        });

    }

    function updateFptk(id)
    {
        var data_candidate= new FormData($('#form-fptk-outsource')[0]);

        swal({
              title: "Are you sure",
              text: " this action ?",
              icon: "warning",
              buttons: true,
              dangerMode: false,
            })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:'{{route('update-fptk-outsource')}}',
                type:'POST',
                data:data_candidate,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                  cache:false,
                  contentType:false,
                  processData:false,
            }) .done(function(data) {
                    if(data.status == 'success')
                    {
                        swal('Success','Job FPTK  has been updated successfully!','success');
                        // location.reload(true);    
                        $(location).attr('href','/create-fptk-outsource');    
                    }
                    
                })
                .fail(function(data) {
                    
                    var dt = data.responseJSON;
                    $.each(dt.errors, function (key, value) {
                        var input = '[name=' + key + ']';
                        
                        $(input + '+span').html('<strong>'+ value +'</strong>');
                        $(input).addClass('is-invalid');
                        $(input).focus();
                        $(input).change(function(){
                            $(input).removeClass('is-invalid');
                        })
                    });
                });
            }
        });
    }


    function update_outsource_fptk(type)
    {
        var data_candidate= new FormData($('#form-fptk-outsource')[0]);
        data_candidate.append('status',type);    

        console.log(data_candidate)

        swal({
              title: "Are you sure",
              text: " this action ?",
              icon: "warning",
              buttons: true,
              dangerMode: false,
            })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:'{{route('update-fptk')}}',
                type:'POST',
                data:data_candidate,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                  cache:false,
                  contentType:false,
                  processData:false,
            }) .done(function(data) {
                    if(data.status == 'success')
                    {
                        swal('Success','Job FPTK  has been updated successfully!','success');
                        // location.reload(true);    
                        $(location).attr('href','/create-fptk-outsource');    
                    }
                    
                })
                .fail(function(data) {
                    
                    var dt = data.responseJSON;
                    $.each(dt.errors, function (key, value) {
                        var input = '[name=' + key + ']';
                        
                        $(input + '+span').html('<strong>'+ value +'</strong>');
                        $(input).addClass('is-invalid');
                        $(input).focus();
                        $(input).change(function(){
                            $(input).removeClass('is-invalid');
                        })
                    });
                });
            }
        });
    }

    function del_fptk(id)
    {
            swal({
                  title: "Are you sure",
                  text: " Delete this data ?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                     $.ajax({
                        url:'delete-fptk-outsource/'+id,
                        type:'GET',
                        dataType: "json",
                        success:function(){
                            swal('Success','Job FPTK  has been saved successfully!','success').then(function(){
                                location.reload(true);    
                            });
                            
                        },
                          cache:false,
                          contentType:false,
                          processData:false,
                    })
                }
            });
    }
</script>