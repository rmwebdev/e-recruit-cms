<script type="text/javascript">

/// this function For Datatable
var table_process;
$(function(){

     table_process = $('#tableCandidateRegis').DataTable({
            dom: 'Blfrtip',
           
            buttons: [
                {
                    filename: 'KARYAWAN NON EMPLOYEE'+'{{date('YmdHis')}}',
                    title: 'KARYAWAN NON EMPLOYEE',
                    customizeData: function(data) {
                        for(var i = 0; i < data.body.length; i++) {
                        for(var j = 0; j < data.body[i].length; j++) {
                            data.body[i][j] = '\u200C' + data.body[i][j];
                        }
                        }
                    },
                    extend: 'excelHtml5',   
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
                        exportOptions: {
                            modifer : {
                                order:'index',
                                page:'all',
                                search: 'none'   
                            }
                        },
                    }
                    
                },
            ],
            aaSorting: [[0, 'desc']],
            bPaginate: true,
            bFilter: false,
            bInfo: true,
            bSortable: true,
            bRetrieve: true,
            aoColumnDefs: [
                { "aTargets": [ 0 ], "bSortable": true },
                { "aTargets": [ 1 ], "bSortable": true },
                { "aTargets": [ 2 ], "bSortable": true },
                { "aTargets": [ 3 ], "bSortable": true }
            ],
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100, 250,-1],
                [10, 25, 50, 100, 250, "All"]
            ],
            processing: true,
            serverSide: true,
            deferRender: true,
            scroller: false,
            searching: true,
            autoWidth: true,
            destroy: true,
            ordering: false,
            orderable: false,   
            responsive: true,  
            ajax: {
                method: 'POST',
                url : "{{route('candidate-regis.getData')}}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },
            
            columns: [
             {data: 'job_fptk_id',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'request_job_number',name:'job_fptk_id',
                render: function(data,type,row){
                        return '<a href="/candidate-regis/detail_candidate/'+row.candidate_id+'">'+row.request_job_number+'</a>';
                    }
            },
            {data: 'name_holder',name:'name_holder'},
            {data: 'position_name',name:'name_holder'},
            {data: 'join_date',name:'join_date'},
            {data: 'end_date',name:'end_date'},
            {data: 'contract_periode',name:'contract_periode'},
            {data: 'salary',name:'salary', orderable: false},
            {data: 'supervisor',name:'supervisor',  orderable: false},
            {data: 'project_name',name:'name_holder',  visible: false},
            {data: 'cost_center',name:'name_holder',  visible: false},
            {data: 'work_location',name:'name_holder',  visible: false},
            {data: 'company_name',name:'name_holder',  visible: false},
            {data: 'employment_type',name:'name_holder',  visible: false},
            {data: 'desc_benefit',name:'name_holder',  visible: false},
            {data: 'benefit',name:'name_holder',  visible: false},
            {data: 'ktp_no',name:'name_holder',visible: false},
            {data: 'no_npk',name:'name_holder',visible: false},
            {
                data: 'status',name:'status',
                render: function(data,type,row){
                        if(row.status == '1')
                        {
                            return 'Active';
                        }
                        else if(row.status == '4')
                        {
                            return 'Non Active';
                        } 
                        else if(row.status == '3')
                        {
                            return  '<a href="/candidate-regis/return_candidate/'+row.candidate_id+'" class="btn btn-success">Return</a></td>';
                        }
                        else
                        {
                            return '';
                        }
                    }
            },
            {
                data:'job_fptk_id',
                mRender: function (data, type, row) {
                    return '<a href="candidate-regis/edit/'+row['candidate_id']+'" class="btn btn-primary"><i class="fa fa-edit"></i></a>'
                }
            }
        ],

    });

    $('#search_').keypress(function(event){
        if(event.which == 13) {
          table_process.clear();
          table_process.destroy();

            table_process = $('#tableCandidateRegis').DataTable({
                dom: 'Bflrtip',
               
                buttons: [
                    {
                        filename: 'KARYAWAN NON EMPLOYEE'+'{{date('YmdHis')}}',
                        title: 'KARYAWAN NON EMPLOYEE',
                        customizeData: function(data) {
                        for(var i = 0; i < data.body.length; i++) {
                        for(var j = 0; j < data.body[i].length; j++) {
                            data.body[i][j] = '\u200C' + data.body[i][j];
                             }
                            }
                        },
                        extend: 'excelHtml5',   
                        exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
                            exportOptions: {
                                modifer : {
                                    order:'index',
                                    page:'all',
                                    search: 'none'   
                                }
                            },
                        }
                    },
                ],
                aaSorting: [[0, 'desc']],
                bPaginate: true,
                bFilter: false,
                bInfo: true,
                bSortable: true,
                bRetrieve: true,
                aoColumnDefs: [
                    { "aTargets": [ 0 ], "bSortable": true },
                    { "aTargets": [ 1 ], "bSortable": true },
                    { "aTargets": [ 2 ], "bSortable": true },
                    { "aTargets": [ 3 ], "bSortable": true }
                ],
                "iDisplayLength": 10,
                lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
                processing: true,
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
                    url : "{{route('candidate-regis.getData')}}",
                    data:{val_search:$("#search_").val()},
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                },
                
                columns: [
                 {data: 'job_fptk_id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'request_job_number',name:'job_fptk_id',
                    render: function(data,type,row){
                            return '<a href="/candidate-regis/detail_candidate/'+row.candidate_id+'">'+row.request_job_number+'</a>';
                        }
                },
                {data: 'name_holder',name:'name_holder'},
                {data: 'position_name',name:'name_holder'},
                {data: 'join_date',name:'join_date'},
                {data: 'end_date',name:'end_date'},
                {data: 'contract_periode',name:'contract_periode'},
                {data: 'salary',name:'salary', orderable: false},
                {data: 'supervisor',name:'supervisor',  orderable: false},
                {data: 'project_name',name:'name_holder',  visible: false},
                {data: 'cost_center',name:'name_holder',  visible: false},
                {data: 'work_location',name:'name_holder',  visible: false},
                {data: 'company_name',name:'name_holder',  visible: false},
                {data: 'employment_type',name:'name_holder',  visible: false},
                {data: 'desc_benefit',name:'name_holder',  visible: false},
                {data: 'benefit',name:'name_holder',  visible: false},
                {data: 'ktp_no',name:'name_holder',visible: false},
                {data: 'no_npk',name:'name_holder',visible: false},
                {
                    data: 'status',name:'status',
                    render: function(data,type,row){
                            if(row.status == '1')
                            {
                                return 'Active';
                            }
                            else if(row.status == '4')
                            {
                                return 'Non Active';
                            } 
                            else if(row.status == '3')
                            {
                                return  '<a href="/candidate-regis/return_candidate/'+row.candidate_id+'" class="btn btn-success">Return</a></td>';
                            }
                            else
                            {
                                return '';
                            }
                        }
                },
                {
                    data:'job_fptk_id',
                    mRender: function (data, type, row) {
                        return '<a href="candidate-regis/edit/'+row['candidate_id']+'" class="btn btn-primary"><i class="fa fa-edit"></i></a>'
                    }
                }
            ],

        });
        }

    })


    var table_process_reg = $('#tableCandidateRegis_reg').DataTable({
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
                url : "{{route('candidate-regis.candidate_regis')}}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        order:[[1,'desc']],
        
        columns: [
             {
                // this for numbering table
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'job_fptk_id',name:'job_fptk_id'},
            {data: 'position_name',name:'name_holder'},
            {data: 'name_holder',name:'name_holder'},
            {data: 'age',name:'name_holder'},
            {data: 'exp_company',name:'name_holder'},
            {data: 'exp_position',name:'name_holder'},
            {data: 'exp_total',name:'name_holder', orderable: false},
            {data: 'edu_major',name:'name_holder',  orderable: false},
            {data: 'edu_ipk',name:'name_holder' , orderable: false},
            {
                mRender: function (data, type, row) {
                    return '<a href="candidate-final/'+row['candidate_id']+'" class="" target="_blank"><i class="fa fa-edit"></i></a>';
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
            table_process_reg.search( this.value ).draw();
        }
    });


    
    $('div.dataTables_filter input').unbind();
    $("div.dataTables_filter input").keyup( function (e) {
        if (e.keyCode == 13) {
             table_process.search( this.value ).draw();
        }
    });


})



// this function for save candidate
$('#form-candidate').submit(function(event){

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
        data_candidate =  new FormData($("#form-candidate")[0]);
        $.ajax({
            url:'{{route('candidate-regis.save')}}',
            type:'POST',
            data:data_candidate,
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
                    swal('Success','Candidate has been saved successfully!','success');
                    $(location).attr('href','/candidate-regis');    
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

//this function for check email exist or not
function emailCheck()
{
    $.ajax({
        url:'{{route('candidate-regis.emailCheck')}}',
        type:'POST',
        data:{'email':$('[name="email"]').val()},
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
             var input = '[name="email"]';
             $(input).removeClass('is-invalid');
        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ']';
                
                $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
            });
        });
}



function modalUpload()
{
    $('#modalUpload').modal('show');
}

function closeModalUpload()
{
    $('#modalUpload').modal('hide');

    $('#form-upload-candidate')[0].reset();
    $('[name="file_upload"]').removeClass('is-invalid');
    
}
//this function for change file photo profile 
function changFile1(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();


    reader.onload = function(e) {
      $('#output_image').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}


//this function for update data candidate
$('#form-candidate-edit').submit(function(event){

    event.preventDefault(); //prevent default action 
    
    data_candidate =  new FormData($("#form-candidate-edit")[0]);
    $.ajax({
        url:'{{route('candidate-regis.update')}}',
        type:'POST',
        data:data_candidate,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
          cache:false,
          contentType:false,
          processData:false,
    })
     .done(function(data) {
            swal('Success','Candidate has been saved successfully!','success');
            $(location).attr('href','/candidate-regis');
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
})

// this function for upload candidate use excel
function uploadCandidate()
{
    
    dataFile =  new FormData($("#form-upload-candidate")[0]);
    $.ajax({
        url:'{{route('candidate-regis.uploadCandidate')}}',
        type:'POST',
        data:dataFile,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
          cache:false,
          contentType:false,
          processData:false,
    })
     .done(function(data) {
             var input = '[name="email"]';  
             $(input).removeClass('is-invalid');
             if(data.error == 'email_required')
             {
                swal('Error','Upload Failed, Candidate '+ data.name_holder + ' dont have email' ,'error').then(function(){
                        location.reload(true);
                    });
             }
             else if(data.error =='email_already_exits')
             {
                swal('Error','Upload Failed, Candidate '+ data.name_holder + ' email already exist' ,'error').then(function(){
                        location.reload(true);
                    });;    
             }
             else
             {
                swal('Success','Upload Candidate!','success');
                location.reload(true);
             }
                
             
        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ']';
                
                $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
            });
        });
}

//function for change input radio button
function inputAsses(cek,v,id)
{
  if(cek.checked)
  {
    $('#hideChoose'+id+'').val(v)
     var radio = '[name="hideChoose'+id+'"]';  
     $(radio).removeClass('is-invalid');
  }
}

function return_candidate(candidate_id)
{
    swal({
      title: "Are you sure",
      text: " you want to fill return form for this employee?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $(location).attr('href','/candidate-regis/return_candidate/'+candidate_id);    
        }
    })
}

</script>