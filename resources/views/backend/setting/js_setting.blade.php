<script type="text/javascript">
 var table_process;
$(function(){
    table_process = $('#tableCandidateRegis').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        processing: false,
        serverSide: true,
        deferRender: true,
        scroller: false,
        autoWidth: true,
        destroy: true,
        ordering: false,
        orderable: false,   
        responsive: true,  
        ajax: {
            method: 'POST',
            url : "{{route('job-regis.getData')}}",
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
                {
                    mRender: function (data, type, row) {
                        if(row.status === 'approved')
                        {
                            return  '<center><a href="job-regis/edit_job_regis/'+row.request_job_number+'" class="btn btn-primary"><i class="fa fa-pencil"></i></a></center>';
                        }
                        else
                        {
                            return '';   
                        }
                        
                    }
                },
                {data: 'request_job_number'},
                {data: 'position_name'},
                {data: 'status'},
                {
                     mRender: function (data, type, row) {
                        if(row.drop ===null || row.drop ==='no' )
                        {
                            return  'no';
                        }
                        else
                        {
                            return 'yes';   
                        }
                        
                    }
                },
                {data: 'publish'},
                {data: 'is_closed'},
                {data: 'golongan'},
                {data: 'recruitment_type'},
                {data: 'received_date_fptk'},
                {data: 'insert_time'},
                {data: 'requested_staff'},
                {data: 'rejected_staff'},
                {data: 'actual_staff'},
                {data:'req_reason'},
                {

                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLAJoin(`'+row.request_job_number+'`)">'+((row.slaJoinDate==null) ? "0" : row.slaJoinDate)+'</a>';
                      
                    }
                },
                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block;'+row.request_reason+'"  onclick="getCanSLA(`'+row.request_job_number+'`,`MED CHECK`)">'+((row.slaMcu==null) ? "0" : row.slaMcu)+'</a>';
                    }
                }, 
                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLA(`'+row.request_job_number+'`,`OFFERING LETTER`)">'+((row.slaOffering==null) ? "0" : row.slaOffering)+'</a>';
                    }
                }, 

                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INITIAL INTERVIEW`)">'+((row.slaInitialInterview==null) ? "0" : row.slaInitialInterview)+'</a>';
                    }
                },
               {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 1`)">'+((row.slaInterview1==null) ? "0" : row.slaInterview1)+'</a>';
                    }
                },
                 {
                    "render": function (data, type, row) {

                      return  '<a  href="javascript:void(0)" style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 2`)">'+((row.slaInterview2==null) ? "0" : row.slaInterview2)+'</a>';
                    }
                },
                 {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)" style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 3`)">'+((row.slaInterview3==null) ? "0" : row.slaInterview3)+'</a>';
                    }
                },
                {data: 'employment_type'},
                {data: 'hired'},
                {data: 'work_location'},
                
        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
    });

    // $('#tableCandidateRegis_filter').hide();

})

    
$('#tableCandidateRegis_filter').bind('keyup', function (e) {
        if (e.keyCode == 13) {
            table_process.search(this.value).draw();
        }
    });   

$('#searchYear').on('change', function (e) {
    // if (e.keyCode == 13) {
        if(this.value == 'All')
        {
            table_process.ajax.reload();
        }
        else
        {
            table_process.columns(9).search(this.value).draw();
        }

    // }

});    

 
function getData()
{

    table_process.clear();
    table_process.destroy();
    table_process =    $('#tableCandidateRegis').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        processing: false,
        serverSide: true,
        deferRender: true,
        scroller: false,
        autoWidth: true,
        destroy: true,
        ordering: false,
        orderable: false,   
        responsive: true,  

        ajax: {
            method: 'POST',
            url : "{{route('job-regis.getData')}}",
            data:{status:status},
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
                 {
                    mRender: function (data, type, row) {
                        if(row.status === 'approved')
                        {
                            return  '<center><a href="job-regis/edit_job_regis/'+row.request_job_number+'" class=""><i class="fa fa-edit"></i></a></center>';
                        }
                        else
                        {
                            return '';   
                        }
                        
                    }
                },
                {data: 'request_job_number'},
                {data: 'position_name'},
                {data: 'status'},
                {
                     mRender: function (data, type, row) {
                        if(row.drop ===null || row.drop ==='no' )
                        {
                            return  'no';
                        }
                        else
                        {
                            return 'yes';   
                        }
                        
                    }
                },
                {data: 'publish'},
                {data: 'is_closed'},
                {data: 'golongan'},
                {data: 'recruitment_type'},
                {data: 'received_date_fptk'},
                {data: 'insert_time'},
                {data: 'requested_staff'},
                {data: 'rejected_staff'},
                {data: 'actual_staff'},
                {data:'req_reason'},
                {

                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLAJoin(`'+row.request_job_number+'`)">'+((row.slaJoinDate==null) ? "0" : row.slaJoinDate)+'</a>';
                      
                    }
                },
                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block;'+row.request_reason+'"  onclick="getCanSLA(`'+row.request_job_number+'`,`MED CHECK`)">'+((row.slaMcu==null) ? "0" : row.slaMcu)+'</a>';
                    }
                }, 
                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLA(`'+row.request_job_number+'`,`OFFERING LETTER`)">'+((row.slaOffering==null) ? "0" : row.slaOffering)+'</a>';
                    }
                }, 

                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INITIAL INTERVIEW`)">'+((row.slaInitialInterview==null) ? "0" : row.slaInitialInterview)+'</a>';
                    }
                },
               {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 1`)">'+((row.slaInterview1==null) ? "0" : row.slaInterview1)+'</a>';
                    }
                },
                 {
                    "render": function (data, type, row) {

                      return  '<a  href="javascript:void(0)" style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 2`)">'+((row.slaInterview2==null) ? "0" : row.slaInterview2)+'</a>';
                    }
                },
                 {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)" style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 3`)">'+((row.slaInterview3==null) ? "0" : row.slaInterview3)+'</a>';
                    }
                },
                {data: 'employment_type'},
                {data: 'hired'},
                {data: 'work_location'},
               
        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
    });
}



function tinymceValidation() {
    var benefit = tinyMCE.get('benefit').getContent();
    var description = tinyMCE.get('description').getContent();
    var requirement = tinyMCE.get('requirement').getContent();
    
     

    if (description == "" || description == null) 
    {
      swal('Error','The description is required!','error');
      return false;
    }  

    if (requirement == "" || requirement == null) 
    {
      swal('Error','The requirement is required!','error');
      return false;
    } 

    if (benefit == "" || benefit == null) 
    {
      swal('Error','The benefit is required!','error');
      return false;
    } 
}



// this function for save candidate
$('#form-job').submit(function(event){

    event.preventDefault(); //prevent default action 
    tinyMCE.triggerSave();
    validate = tinymceValidation();
    if(!validate)
    {
        tinymceValidation();
    }

    rejected_staff = $('[name="rejected_staff"]').val();
    drop = $('[name="drop"]').val();

    if(parseInt(rejected_staff) > parseInt(actual_staff))
    {
        swal('Error','Staff yang di reject lebih banyak dari staff yang tersedia','error');
        return false;
    }

        dataJobRegis =  new FormData($("#form-job")[0]);


    swal({
          title: "Are you sure",
          text: " Save this data ?",
          icon: "warning",
          buttons: true,
          dangerMode: false,
        })
        .then((willDelete) => {
            if (willDelete) {
            $.ajax({
                url:'{{route('job-regis.updateJobRegis')}}',
                type:'POST',
                data:dataJobRegis,
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
                        swal('Success','Job registrasi has been saved successfully!','success');
                        // location.reload(true);    
                        $(location).attr('href','/job-regis');    
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
})

function GetStatus(status)
{
    
        table_process.clear();
        table_process.destroy();
        //$('#tableCandidateRegis').empty(); // empty in case the columns change

     table_process =    $('#tableCandidateRegis').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        processing: false,
        serverSide: true,
        deferRender: true,
        scroller: false,
        autoWidth: true,
        destroy: true,
        ordering: false,
        orderable: false,   
        responsive: true,  
        ajax: {
            method: 'POST',
            url : "{{route('job-regis.GetStatus')}}",
            data:{status:status},
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
                  {
                    mRender: function (data, type, row) {
                        if(row.status === 'approved')
                        {
                            return  '<a href="job-regis/edit_job_regis/'+row.request_job_number+'" class=""><i class="fa fa-edit"></i></a>';
                        }
                        else
                        {
                            return '';   
                        }
                        
                    }
                },
              
                {data: 'request_job_number'},
                {data: 'position_name'},
                {data: 'status'},
                {
                     mRender: function (data, type, row) {
                        if(row.drop ===null || row.drop ==='no' )
                        {
                            return  'no';
                        }
                        else
                        {
                            return 'yes';   
                        }
                        
                    }
                },
                {data: 'publish'},
                {data: 'is_closed'},
                {data: 'golongan'},
                {data: 'recruitment_type'},
                {data: 'received_date_fptk'},
                {data: 'insert_time'},
                {data: 'requested_staff'},
                {data: 'rejected_staff'},
                {data: 'actual_staff'},
                {data:'req_reason'},
                {

                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLAJoin(`'+row.request_job_number+'`)">'+((row.slaJoinDate==null) ? "0" : row.slaJoinDate)+'</a>';
                      
                    }
                },
                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block;'+row.request_reason+'"  onclick="getCanSLA(`'+row.request_job_number+'`,`MED CHECK`)">'+((row.slaMcu==null) ? "0" : row.slaMcu)+'</a>';
                    }
                }, 
                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLA(`'+row.request_job_number+'`,`OFFERING LETTER`)">'+((row.slaOffering==null) ? "0" : row.slaOffering)+'</a>';
                    }
                }, 

                {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INITIAL INTERVIEW`)">'+((row.slaInitialInterview==null) ? "0" : row.slaInitialInterview)+'</a>';
                    }
                },
               {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)"  style="color:black;text-align:center;display:block"  onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 1`)">'+((row.slaInterview1==null) ? "0" : row.slaInterview1)+'</a>';
                    }
                },
                 {
                    "render": function (data, type, row) {

                      return  '<a  href="javascript:void(0)" style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 2`)">'+((row.slaInterview2==null) ? "0" : row.slaInterview2)+'</a>';
                    }
                },
                 {
                    "render": function (data, type, row) {

                      return  '<a href="javascript:void(0)" style="color:black;text-align:center;display:block" onclick="getCanSLA(`'+row.request_job_number+'`,`INTERVIEW 3`)">'+((row.slaInterview3==null) ? "0" : row.slaInterview3)+'</a>';
                    }
                },
                {data: 'employment_type'},
                {data: 'hired'},
                {data: 'work_location'},
              
        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
    });
}

function getDrop()
{
    valDrop =  $('#drop').val();
    if(valDrop == "yes")
    {
        $('#rowRequest').show();
    }
    else
    {
        $('#rowRequest').hide();   
    }
}


var varTableSLAJoin;
function datatableSLAJoin(request_job_number)
{
    varTableSLAJoin = $('#tableCanSLA').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        processing: false,
        serverSide: true,
        deferRender: true,
        scroller: false,
        autoWidth: true,
        destroy: true,
        ordering: false,
        orderable: false,   
        responsive: true,  
        ajax: {
            method: 'POST',
            url : "{{route('job-regis.getCanSLAJoin')}}",
            data:{request_job_number,request_job_number},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        
        columns: [
                
                {data: 'request_job_number'},
                {data: 'received_date_fptk'}, 
                {data: 'join_date'},
                {data: 'position_name'},
                {data: 'name_holder'},
                {data: 'sla_join_date',title:'SLA Join Date'},

        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
    });
}

function getCanSLAJoin(request_job_number)
{
    $('#modalCanSLA').modal('show');

    datatableSLAJoin(request_job_number)
    varTableSLAJoin.clear();
    varTableSLAJoin.destroy();
    

    varTableSLAJoin = $('#tableCanSLA').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        processing: false,
        serverSide: true,
        deferRender: true,
        scroller: false,
        autoWidth: true,
        destroy: true,
        ordering: false,
        orderable: false,   
        responsive: true,  
        ajax: {
            method: 'POST',
            url : "{{route('job-regis.getCanSLAJoin')}}",
            data:{request_job_number,request_job_number},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        
        columns: [
                
                {data: 'request_job_number'},
                {data: 'received_date_fptk'}, 
                {data: 'join_date'},
                {data: 'name_holder'},
                {data: 'position_name'},
                {data: 'sla_join_date',title:'SLA Join Date'},
        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
    });
}



function  getCanSLA(request_job_number,type)
{
    $('#modalCanSLA').modal('show');

    datatableSLAJoin(request_job_number)
    varTableSLAJoin.clear();
    varTableSLAJoin.destroy();
    

    varTableSLAJoin = $('#tableCanSLA').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        processing: false,
        serverSide: true,
        deferRender: true,
        scroller: false,
        autoWidth: true,
        destroy: true,
        ordering: false,
        orderable: false,   
        responsive: true,  
        ajax: {
            method: 'POST',
            url : "{{route('job-regis.getCanSLA')}}",
            data:{request_job_number,request_job_number,type:type},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        
        columns: [
                
                {data: 'request_job_number'},
                {data: 'received_date_fptk'}, 
                {data: 'join_date',title:'Received Date'},
                {data: 'name_holder'},
                {data: 'position_name'},
                {data: 'sla_date',title:'SLA '+type+''},
        ],
         createdRow: function( row, data, dataIndex ) {
                if ( data['request_reason'] == "merah" ) {
                    $(row).css( 'background-color','#DC3545' );
                }
                else{
                    $(row).css( 'background-color','#28A745' );   
                }
              
            },
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
    });
}



</script>