<script type="text/javascript">
    // for datatable rec process
    // buat load datatable client side


$('#table-setting-banner').DataTable({
   
    "lengthMenu": [
        [5, 15, 20, -1],
        [5, 15, 20, "All"] // change per page values here
    ],
    // set the initial value
    "pageLength": 10,   
});

$('.date_end').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
$('.date_effective').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
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
            url : "{{route('dashboard.getData')}}",
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



// this function for save banner
$('#form-setting-banner').submit(function(event){

    event.preventDefault(); //prevent default action 

    swal({
      title: "Are you sure",
      text: " save this data ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        data_setting_banner =  new FormData($("#form-setting-banner")[0]);
        $.ajax({
            url:'{{route('dashboard.action-setting-banner')}}',
            type:'POST',
            data:data_setting_banner,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
              cache:false,
              contentType:false,
              processData:false, 
        })
         .done(function(data) {
                if(data.status == 'success')
                {
                    swal('Success','Picture has been saved successfully!','success');
                    location.reload();
                }
                
            })
            .fail(function(data) {
                
                var dt = data.responseJSON;
                $.each(dt.errors, function (key, value) {
                    var input = '[name=' + key + ']';
                    
                    $(input + '+i').html('<strong>'+ value +'</strong>');
                    $(input).addClass('is-invalid');
                    $(input).focus();
                    $(input).change(function(){
                        $(input).removeClass('is-invalid');
                    })
                });
            });
      } 
    });
})

/// delete banner 
function delete_setting_banner(id)
{
    swal({
      title: "Are you sure?",
      text: "Delete this data ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
         $.ajax({
            url:'delete-setting-banner/'+id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data family has been deleted successfully!','success');
                    location.reload(true);
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}

function edit_setting_banner(id)
{
     $.ajax({
            url:'edit-setting-banner',
            dataType:'JSON',
            type:'GET',
            data:{id:id},
            success:function(get){
                var pict = get.data.setting_banner_pict;
                var sp_pict = pict.split('.');
                
                $('[name="setting_banner_id"]').val(get.data.setting_banner_id)
                $('[name="setting_banner_name"]').val(get.data.setting_banner_name)
                $('[name="setting_banner_desc"]').val(get.data.setting_banner_desc)
                $('[name="setting_banner_pict_edit"]').val(get.data.setting_banner_pict)
                $('[name="setting_banner_type"]').val(get.data.setting_banner_type)
                $('[name="status"]').val(get.data.status)
                $('[name="setting_banner_pict"]').removeAttr('required')
                if(sp_pict[1] == 'mp4')
                {
                     $('#banner_pict').html('<video width="100px" height="100px" controls><source src="upload_file/'+pict+'" type="video/mp4"></video>'); 
                }
                else
                {
                    $('#banner_pict').html('<img src=upload_file/'+pict+' width="200px">');    
                }
                
                $('#modal_setting_banner').modal('show');
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
}

// close modal banner 
function closeModalBanner()
{
    $('#setting_banner_name').removeClass('is-invalid');
    $('#setting_banner_desc').removeClass('is-invalid');
    $('#setting_banner_pict').removeClass('is-invalid');
    $('#form-setting-banner')[0].reset();
    $('#modal_setting_banner').modal('hide');
    $('#banner_pict').html('');
}


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



$("#cv_in").click(function(){

    hoverProcess('cv_in');
     tableSearchFPTK
        .columns(10)
        .search('CV IN')
        .draw();
    
});

$("#cv_sort").click(function(){
    hoverProcess('cv_sort');
     tableSearchFPTK
        .columns(10)
        .search('CV SORT')
        .draw();
    
});

$("#sort_list").click(function(){
    hoverProcess('sort_list');
        tableSearchFPTK
        .columns(11)
        .search('CONSIDER')
        .draw();
});

$("#called").click(function(){
    hoverProcess('called');
        tableSearchFPTK
        .columns(10)
        .search('CALLED')
        .draw();
});


$("#psychotest").click(function(){
    hoverProcess('psychotest');
         tableSearchFPTK
        .columns(10)
        .search('PSYCHOTEST')
        .draw();
});

$("#initial_in").click(function(){
    hoverProcess('initial_in');
    tableSearchFPTK
        .columns(10)
        .search('INITIAL INTERVIEW')
        .draw();
});

$("#interview_1").click(function(){
    hoverProcess('interview_1');
    tableSearchFPTK
        .columns(10)
        .search('INTERVIEW 1')
        .draw();
});

$("#interview_2").click(function(){
    hoverProcess('interview_2');
    tableSearchFPTK
        .columns(10)
        .search('INTERVIEW 2')
        .draw();
});

$("#interview_3").click(function(){
    hoverProcess('interview_3');
    tableSearchFPTK
        .columns(10)
        .search('INTERVIEW 3')
        .draw();
});


$("#med_check").click(function(){
    hoverProcess('med_check');
    tableSearchFPTK
        .columns(10)
        .search('MED CHECK ')
        .draw();
});

$("#offering_letter").click(function(){
    hoverProcess('offering_letter');
    tableSearchFPTK
        .columns(10)
        .search('OFFERING LETTER')
        .draw();
});

$("#hired").click(function(){
    hoverProcess('hired');
     tableSearchFPTK
        .columns(10)
        .search('HIRED')
        .draw();
});




// this function for save candidate
$('#formCreateUser').submit(function(event){

    event.preventDefault(); //prevent default action 

    swal({
      title: "Are you sure",
      text: " save this data ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        dataUser =  new FormData($("#formCreateUser")[0]);
        $.ajax({
            url:'{{route('dashboard.actionCreateUser')}}',
            type:'POST',
            data:dataUser,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
              cache:false,
              contentType:false,
              processData:false,
        })
         .done(function(data) {
                if(data.status == 'success')
                {
                    swal('Success','User has been saved successfully!','success');
                    location.reload();
                }
                
            })
            .fail(function(data) {
                
                var dt = data.responseJSON;
                $.each(dt.errors, function (key, value) {
                    var input = '[name=' + key + ']';
                    
                    $(input + '+i').html('<strong>'+ value +'</strong>');
                    $(input).addClass('is-invalid');
                    $(input).focus();
                    $(input).change(function(){
                        $(input).removeClass('is-invalid');
                    })
                });
            });
      } 
    });
})


// this function for save candidate
$('#form_change_password').submit(function(event){

    event.preventDefault(); //prevent default action 

    swal({
      title: "Are you sure",
      text: " change password this data ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        dataUser =  new FormData($("#form_change_password")[0]);
        $.ajax({
            url:'{{route('dashboard.action_change_password')}}',
            type:'POST',
            data:dataUser,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
              cache:false,
              contentType:false,
              processData:false,
        })
         .done(function(data) {
                if(data.status == 'success')
                {
                    swal('Success','User has been saved successfully!','success');
                    location.reload('login');
                }
                
            })
            .fail(function(data) {
                
                var dt = data.responseJSON;

                if(dt.status == 'error_old_password')
                {
                    swal('Error',dt.message,'error');
                    return false;   
                }

                $.each(dt.errors, function (key, value) {
                    var input = '[name=' + key + ']';
                    
                    $(input + '+i').html('<strong>'+ value +'</strong>');
                    $(input).addClass('is-invalid');
                    $(input).focus();
                    $(input).change(function(){
                        $(input).removeClass('is-invalid');
                    })
                });
            });
      } 
    });
})

function set_banner(e)
{
    if($(e).val() == 'warning')
    {
        $('#show_type').show();  
    }
    else
    {
        $('#show_type').hide();
    }
}


</script>