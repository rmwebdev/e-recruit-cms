<!-- end Modal -->

<!-- Modal   for input reason , if reinvited -->
<div class="modal fade" id="modalReason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width: 30%">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none">
        
      </div>
      <div class="modal-body">
        <div class="form-group">
              <input type="text" name="reason" class="form-control" placeholder="Input Reason">
              <span class="invalid-feedback" role="alert"></span>
        </div>            
      </div>
      <div class="modal-footer" style="border-top: none;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="saveReason" onclick="saveReason()">Save</button>
      </div>
      
    </div>
  </div>
</div>
<!-- end Modal -->


<div class="modal fade" id="modalNotif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Candidate Confirmation</h5>
        <button type="button" class="close" onclick="closeNotif()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>  
      </div>
      <div class="modal-body">
        <div class="table-responsive"> 

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="dateNotif"  readonly class="form-control  pull-right datepicker" placeholder="Search By Date" onchange="getDataNotif()">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="button" onclick="getDataNotif('all')">All Data</button>
                    </div>
                </div>
            </div>
            <br>
          <table style="font-size:12px" id="tableNotification" class="table table-bordered table-striped mdl-data-table" id="grid-job-registration">
            <thead>
                <tr align="center" style="font-weight:bold">
                    <th>CANDIDATE NAME</th>
                    <th>REQUEST JOB NUMBER</th>
                    <th>POSITION NAME</th>
                    <th>INVITATION DATE</th>
                    <th>INVITATION PROCESS</th>
                    <th>HISTORY RESULT</th>
                    <th>RESCHEDULE DATE</th>
                    <th>CONFIRMATION TIME</th>
                    <th>ACTION</th>
                </tr>
            </thead>
        </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeNotif()">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal   Upload -->
<div class="modal fade" id="modalSendEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="width: 50%">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title" id="exampleModalLongTitle">Confirm Send Email</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           
             <form id="formEmail">
 
                  <div class="form-group">
                      <label for=""> Date and Time : <span class="span-mandatory">*</span>  </label>
                      <input type="text" class="form-control" name="date_time">
                      <span class="invalid-feedback date_time" role="alert"></span>
                  </div>

                  <div class="form-group">
                      <label for=""> Email Invitation : </label>
                      <textarea name="email_invitation" rows="10" class="form-control textAreaInvite" readonly>
 <div style="font-size: 14px">
Dear Candidate,
<br>
<br>
Menindaklanjuti aplikasi yang sudah kami terima, kami menginformasikan bahwa kami mengundang untuk Proses Seleksi yang akan dilaksanakan pada :
<br>
<br>
<table>
  <tr>
    <td>Hari, tanggal</td>
    <td> : </td>
    <td  id="tanggal">Tidak perlu diubah, hari tanggal terisi otomatis berdasarkan date invitation</td>
  </tr>

  <tr>
    <td>Jam</td>
    <td> : </td>
    <td  id="jam">Tidak perlu diubah, jam terisi otomatis berdasarkan date invitation</td>
  </tr>


  <tr>
    <td>Lokasi</td>
    <td> : </td>
    <td id="lokasi">Tidak perlu diubah, lokasi terisi otomatis berdasarkan Venue</td>
  </tr>

  <tr>
    <td>Agenda</td>
    <td> : </td>
    <td id="process">Tidak perlu diubah, agenda terisi otomatis berdasarkan Invitation Process</td>
  </tr>

  <tr>
    <td>Bertemu dengan</td>
    <td> : </td>
    <td id="contact_person"> Tidak perlu diubah, contact person terisi otomatis berdasarkan Invitation Process  </td>
  </tr>
</table>
<br>
<table>
    <tr>
        <td>Scan Barcode</td>
        <td> : </td>
        <td id="barcode"> Mohon scan barcode di bawah ini pada device yang tersedia untuk tanda kehadiran proses interview</td>
    </tr>
</table>
<br>

<br>
Harap memberikan konfirmasi kehadiran pada laman E-Recruitment Puninar.                
<br>
Silahkan klik link ini untuk konfirmasi kehadiran anda
<br>
{{url('form-candidate/confirmation')}}
<br>
<br>
Untuk detail informasi mengenai perusahaan kami, silahkan mengunjungi website www.puninar.com.
<br>
<br>
</div>
</textarea>
                      <span class="invalid-feedback" role="alert"></span>
                  </div>
                  <div class="form-group">
                    <label for="">Venue : </label>
                    <textarea name="venue"  rows="3" class="form-control">Jl. Raya Cakung Cilincing Km. 1,5, Jakarta 13910
Phone  : +62 21 460 2278 | Fax: +62 21 460 4866
                  </textarea>
                    <span class="invalid-feedback venue" role="alert"></span>
                  </div>

                <div class="form-group">
                    <label for="">Invitation Process :  <span class="span-mandatory">*</span> </label>
                    <select class="form-control" name="invitation_process">
                        <option value=""> -- SELECT PROCESS --</option>
                          @foreach($invitation_process as $ip)
                              <option value="{{$ip->nama}}">{{ $ip->nama }}</option>
                          @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Contact Person : <span class="span-mandatory">*</span>  </label>
                  <input type="text" name="contact_person" class="form-control">
                </div>    
             
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSendEmail" onclick="sendEmailCandidate()">Send Email</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal -->



<!-- Modal Reinvited -->
<div class="modal fade" id="modal_psychotest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false" data-backdrop="static">
    <div class="modal-dialog" role="document" style="width: 70%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="" style="font-weight: bold"> History Psychotest </h5>
        </div>
        <div class="modal-body">
          <table class="table" id="table_psychotest">
              
          </table>
           
        </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
      </div>
    </div>
</div>
<!-- end Modal -->


<script type="text/javascript">
var table_process;
var status_active = '{{isset($_GET['status']) ? $_GET['status'] :"" }}';

$(document).ready(function(){


if(status_active != "")
{
    hoverProcess(status_active);
}
tinymce.init({
  selector: '.textAreaInvite',
    height: 350,
    theme: 'modern',
    plugins: [
                          "advlist codesample  autolink lists link image charmap print preview hr anchor pagebreak",
                          "searchreplace wordcount visualblocks visualchars code fullscreen",
                          "insertdatetime media nonbreaking save table contextmenu directionality",
                          "emoticons template paste textcolor colorpicker textpattern"
                      ],
                      toolbar1: "code fullscreen insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link image ",
                      toolbar2: "print preview media | forecolor backcolor emoticons | codesample",
    image_advtab: true,
  
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css'
    ]
});

     $('[name="dateNotif"]').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});


     $('[name="date_process_reinvited"]').datetimepicker({ 
            footer: true, 
            modal: true,
            uiLibrary: 'bootstrap4', 
            format: 'yyyy-mm-dd HH:MM'
        });  

     $('[name="date_process_called"]').datetimepicker({ 
            footer: true, 
            modal: true,
            uiLibrary: 'bootstrap4', 
            format: 'yyyy-mm-dd HH:MM'
        });  

    $('#tableRecProcess tfoot th').each( function ()
    {
        var title = $(this).text();

        if(title=='JOB TITLE'||title=='NAME'||title=='LATEST COMPANY'||title=='LATEST POSITION'||title=='MAJOR'||title=='PROCESS'||title=='RESULT')
        {
            $(this).html( '<input type="text" style="width:100px;" placeholder="'+title+'" />' );
        }
    });


    

// for datatable rec process
table_process = $('#tableRecProcess').DataTable({
        aaSorting: [[3, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
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
            url : "{{route('rec-process.getData')}}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        
        columns: [
                {
                    "mRender": function (data, type, row, meta) {
                        if( (row.process === 'HIRED') || (row.process === 'REGISTRATION') )
                        {
                            return "";
                        }
                        else
                        {
                            
                            return "<center><input type='checkbox' name='candidate_id'  value='"+row.candidate_id+"'></center>";
                        }
                        
                    }
                 },
                  {
                    render: function (data, type, row) {
                        if(row.process === 'REGISTRATION')
                        {
                            return  "<center><a href='candidate-final/"+row.candidate_id+"' target='_blank'><i class='fa fa-eye'></i></a></center>";
                        }
                        else
                        {
                            
                            return  "<center><a href='rec-process/edit_rec_process/"+row.candidate_id+"''><i class='fa fa-edit'></i></a> | <a href='candidate-final/"+row.candidate_id+"'  target='_blank'><i class='fa fa-eye'></i></a></center>";

                        }
                    }
                }, 
                 {
                    // this for numbering table
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
               
                {data: 'registration_date'},
                {data: 'name_holder'},
                {data: 'email'},
                {data: 'job_fptk_id'}, 
                {data: 'exp_company'},
                {data: 'exp_position'},
                {data: 'exp_total'},
                {data: 'join_date'},
                {data: 'edu_major'},
                {data: 'edu_ipk'},
                {
                    
                    render: function (data, type, row) {
                        if(row.process === 'CALLED')
                        {
                            return  "INVITED";
                        }
                        else
                        {
                            
                            return  row.process;

                        }
                    }

                },
                {data: 'received_date'},
                {data: 'result'},
                {
                    data:'invitation_process'
                },
              
                
        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],


});


        // $('#tbl_1_filter').hide();

$('#tableRecProcess_filter input').bind('keyup', function(e) {
    if(e.keyCode == 13) {
        table_process.search(this.value);    
    }
}); 


    

    // Apply the search
    table_process.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            // console.log(this.value);
            if ( event.which == 13 ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    });
})




function selectProcess()
{
    var process = $('[name="process"]').val();

    if(process  == 'CALLED')
    {
        $('#btnSend').show();
        $('[name="result"],[name="date_process"],#btnUpdate,[name="join_date"]').hide();


        return false;
    }
    else if(process== 'HIRED')
    {
        $('[name="join_date"]').show();
    }
    else
    {

        $('[name="join_date"]').hide();
        $('.date_process').hide();
    }



    $('[name="result"],[name="date_process"],#btnUpdate').show();
    $('#btnSend').hide();
    $.ajax({
        url:'/rec-process/get_result_process/'+process,
        type:'GET',
        data:{proc:proc},
        dataType: "json",
        success:function(data)
        {   
            var tp = $('[name="result"]'); tp.empty();
            tp.append('<option value="">  -- SELECT RESULT -- </option>')
            data.data.forEach(function(e){
                tp.append('<option value='+e.nama+'>'+e.nama+'</option>')
            })
        }
    });

}

var count = 0;
function check_emp(cek,id)
{
    if($(cek).is(":checked"))
    {
        $('#process_candidate').show();
        $('#'+id).css('border','2px solid #feab1f')
        count++;
        //alert('tes');
        //alert(count);
    }
    else if($(cek).is(":not(:checked)"))
    {
        count--;
        $('#'+id).css('border','none')

    }
    if(count == 0)
    {
      $('#process_candidate').hide();
    }
}


function chekCandidate(cek)
{
    $('input:checkbox').not(cek).prop('checked', cek.checked);

    if($(cek).is(":checked"))
    {
        $('#process_candidate').show();
        $('.card-candidate').css('border','2px solid #feab1f')
    }
    else if($(cek).is(":not(:checked)"))
    {
        $('#process_candidate').hide();
        $('.card-candidate').css('border','none')
    }

}


function modalSendEmail()
{

    var candidate_id = [];
    $.each($('[name="candidate_id"]:checked'),function(){
        candidate_id.push($(this).val());
    })

   
    $('#modalSendEmail').modal('show');
    $('[name="date_time"]').datetimepicker({ 
            footer: true, 
            modal: true,
            uiLibrary: 'bootstrap4', 
            format: 'yyyy-mm-dd HH:MM'
        });
}

function updateStatus()
{
    var process = $('[name="process"]').val();
    var result = $('[name="result"]').val();
    var join_date = $('[name="join_date"]').val();
    var date_process ='[name="date_process"]';

    var candidate_id = [];


    $.each($('[name="candidate_id"]:checked'),function(){
        candidate_id.push($(this).val());
    })


    if(candidate_id == '' || candidate_id==null)
    {
        swal('Error','Please select the candidate  first!','error');
        return false;
    }    
    

     swal({
      title: "Are you sure?",
      text: "Process This Candidate?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:'{{route('rec-process.updateStatus')}}',
                type:'POST',
                data:{process:process,result:result,join_date,date_process:$(date_process).val(),candidate:candidate_id},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success:function(data)
                {   
                    
                }
            })
             .done(function(data) {
                    if(data.status == 'success')
                    {
                        swal('Success','Candidate has been updated successfully!','success');
                        location.reload(true);
                    }
                })
                .fail(function(data) {
                    
                    var dt = data.responseJSON;
                    
                    if(dt.status == 'error_process_already')
                    {
                        swal('Error','This candidate '+ dt.data_candidate +' have been a process ! ','error');
                    }
                    else if(dt.status == 'job_not_apply')
                    {
                        swal('Error','This candidate '+dt.candidate+' not applied job ','error');   
                    }
                    else if(dt.errors)
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
    });
}


function changeCV(input)
{
    var dataFile =  new FormData($("#othersForm")[0]);
    $.ajax({

        url: "{{route('rec-process.changeCV_baru')}}", 
        type: "POST",   
        data: dataFile, 
        dataType:'JSON',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(data)   
        {       

            $('#editCV').html('<a href="'+data.url+'" target="_blank" id="fname"> '+data.url+'  </a>');
        },
        contentType: false,       
        cache: false,             
        processData:false,
    }).fail(function(data) {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $('#editPhoto').attr('src', e.target.result);
                }
                
                $('[name="file_edit"]').val(input.files[0].name);
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



function changeEditProc(proc)
{   
    // var proc = $('[name="process"]').val();
    var asem = proc.replace(" ", "");

    if(proc == 'CALLED')
    {

        $('#sectionCalled').show();
        $('#buttonAction').show();
        $('#others').hide();
        $('#calledForm').show();
        $('#called_invite').show();
    }
    else
    {

        if(proc  == 'PSYCHOTEST')
        {
            $("#others").show();
            $("#PSYCHOTEST").show();
            // $("#called_invite").show();
            $('#buttonAction').show();
            $('#sectionCalled').hide();
            $('#rowJoinDate').hide();
            $('#calledForm').hide();
        }
        else if(proc == 'HIRED')
        {
        
            $('#rowJoinDate').show();
            $('#others').show();
            $('#buttonAction').show();
            $('#sectionCalled').hide();    
            $("#PSYCHOTEST").hide();
        }
        else if(proc == 'CV SORT')
        {
            $("#others").show();
            $('#CV_SORT').hide();
            $('#buttonAction').show();
        }
        else
        {
           // $('[name="join_date"]').attr('disabled','true');
            $('#rowJoinDate').hide();
            $('#others').show();
            $('#buttonAction').show();
            $('#sectionCalled').hide();    
            $("#PSYCHOTEST").hide();
        }   
    }

    $('[name="result"]').removeClass('is-invalid');
    $('[name="remarks"]').removeClass('is-invalid');
    $('[name="date_process"]').removeClass('is-invalid');
    $('[name="invitation_process"]').removeClass('is-invalid');
    $('.date_process_validate').hide();


    $('[name="email_invitation_called"]').removeClass('is-invalid');
    $('[name="date_process_called"]').removeClass('is-invalid');
    $('[name="remarks_called"]').removeClass('is-invalid');
    $('[name="contact_person"]').removeClass('is-invalid');
    $('.date_process_called').hide();
}


var proc

function updateRecProcess()
{
    var url = "";
    var desc = tinyMCE.get('description').getContent();
    proc = $('[name="process"]').val();
    if(proc == 'CALLED')
    {
        form =  new FormData($("#calledForm")[0]);
        form.append('pesan',desc);
        url = '{{route('rec-process.updateRecProcessEmail')}}';
    }
    else
    {
        form =  new FormData($("#othersForm")[0]);
        form.append('pesan',desc);
        url = '{{route('rec-process.updateRecProcessStatus')}}'
    }

    swal({
      title: "Are you sure?",
      text: "Process This Candidate ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
             $.ajax({
            url:url,
            type:'POST',
            data:form,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(data)
            {   
                
            },
              cache:false,
              contentType:false,
              processData:false,
        })
         .done(function(data) {
                if(data.status == 'success')
                {
                  var swal_msg='';
                  if(data.result_integrasi_stat == 1)
                  {
                    swal_msg=data.result_integrasi_msg;
                  }

                  swal('Success',""+ swal_msg +"",'success').then(function(){   
                    if(type == 'view-all')
                    {
                      $(location).attr('href','/rec-process/view_all/?status='+status+'&q='+q+'&tot='+tot+'&type='+type);  
                    }
                    else
                    {
                      $(location).attr('href','/detail-rec-process?id='+job_id+'&status='+status+'&type='+type);   
                    }
                  });

                }
            })
            .fail(function(data) {
                
                var dt = data.responseJSON;
                if(dt.errors)
                {

                    if(dt.errors.date_process)
                    {
                        $('.date_process_validate').html('<strong>The date process field is required</strong>');
                        $('.date_process_validate').show();        
                    }

                    if(dt.errors.join_date)
                    {
                        $('.join_process_validate').html('<strong>The join date field is required</strong>');
                        $('.join_process_validate').show();        
                    }
                    if(dt.errors.date_process_called)
                    {

                        $('.date_process_called').html('<strong>The date process field is required</strong>');
                        $('.date_process_called').show();        
                    }
                    
                    $.each(dt.errors, function (key, value) {
                        var input = '[name=' + key +']';
                        
                        $(input + '+span').html('<strong>'+ value +'</strong>');
                        $(input).addClass('is-invalid');
                        $(input).focus();
                        $(input).change(function(){
                            $(input).removeClass('is-invalid');
                            $('.date_process_validate').hide();
                            $('.join_process_validate').hide();
                            $('.date_process_called').hide();
                        })
                    });
                }

                if(dt.status == 'not_apply')
                {
                    swal('Warning','Sorry This Candidate Not Apply Job!','warning');
                }

                if(dt.status == 'hired_already')
                {
                    swal('Warning','Sorry, This candidate has been hired','warning');   
                }

                if(dt.status == 'validate_candidate')
                {
                    swal('Warning','Sorry, Please complete data '+dt.message,'warning');    
                }

                if(dt.status == 'fullfield')
                {
                    swal('Warning','Sorry, This FPTK Has FULLFIELD','warning');   
                }

                
                if(dt.status == 'already_process')
                {
                    swal({
                      title: "Warning !",
                      text: "This process already exist, are you sure input this process again ?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        $('[name="reason"]').val('');
                        modalReason(proc);
                      } 
                    });
                }
            });
        } 
    });
}

function modalReason(param)
{
    $('[name="reason"]').removeClass('is-invalid');
    $('[name="reason"]').val('');
    $('#modalReason').modal({display:'show',backdrop: 'static'});

    return proc;
}

function saveReason()
{

    if(proc == 'CALLED')
    {
        data_form =  new FormData($("#calledForm")[0]);
    }
    else
    {
        data_form =  new FormData($("#othersForm")[0]);
    }

    var desc = tinyMCE.get('description').getContent();
    var value = $('[name=reason]').val();
    var proces = $('[name=process]').val();
    var date_process_called = $('[name=date_process_called]').val();
    
    data_form.append('reason',value);
    data_form.append('process',proces);
    data_form.append('pesan',desc);
    data_form.append('date_process_called',date_process_called);



    $.ajax({
            url:"{{url('rec-process/inputReason/')}}",
            type:'POST',
            data:data_form,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(data)
            {   
                if(data.status == 'success')
                {
                    swal('Success','','success').then(function(){   
                      if(type == 'view-all')
                      {
                        $(location).attr('href','/rec-process/view_all/?status='+status+'&q='+q+'&tot='+tot+'&type='+type);  
                      }
                      else
                      {
                        $(location).attr('href','/detail-rec-process?id='+job_id+'&status='+status+'&type='+type);   
                      }
                    });
                }
            },
            beforeSend:function(){
                $('#saveReason').attr('disabled',true);
                $('#saveReason').text('Loading ....');

            },
              cache:false,
              contentType:false,
              processData:false,
        }).fail(function(data) {
            var dt = data.responseJSON;
              $('#saveReason').attr('disabled',false);
                $('#saveReason').text('Save');
            if(dt.errors)
            {
                $.each(dt.errors, function (key, value) {
                    var input = '[name=' + key +']';
                    $(input + '+span').html('<strong>'+ value +'</strong>');
                    $(input).addClass('is-invalid');
                    $(input).focus();
                    $(input).change(function(){
                        $(input).removeClass('is-invalid');
                    })
                });
            }
            else if(dt.status == 'not_apply')
            {
                swal('Warning','Sorry This Candidate Not Apply Job!','warning');
            }
            
        })
}

function sendEmailCandidate()
{
    var candidate_id = [];
    var date_process ='[name="date_time"]';
    $.each($('[name="candidate_id"]:checked'),function(){
        candidate_id.push($(this).val());
    })

    if(candidate_id == '' || candidate_id==null)
    {
        swal('Error','Please select the candidate  first!','error');
        return false;
    }    

    var desc = tinyMCE.get('email_invitation').getContent();
    data_form =  new FormData($("#formEmail")[0]);
    data_form.append('candidate_id',candidate_id);
    data_form.append('pesan',desc);

    


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
                    url:'{{route('rec-process.sendEmailMass')}}',
                    type:'POST',
                    data:data_form,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data)
                    {   
                        if(data.status == 'success')
                        {
                            swal('Success','Send Email to Candidate !','success');
                            location.reload(true);
                        }
                    },
                    beforeSend:function(){
                        $('#btnSendEmail').attr('disabled',true);
                        $('#btnSendEmail').text('Loading ....');
                    },
                      cache:false,
                      contentType:false,
                      processData:false,
                }).fail(function(data) {
                    $('#btnSendEmail').attr('disabled',false);
                    $('#btnSendEmail').text('Send Email');

                    var dt = data.responseJSON;
                    console.log(dt.errors);
                    if(dt.status == 'error_process_already')
                    {
                        swal('Error','This candidate '+ dt.data_candidate +' have been a process! ','error');
                    }
                    else if(dt.status == 'job_not_apply')
                    {
                        swal('Error',"There are candidate "+ dt.candidate +" haven't applied,",'error');   
                    }
                    else if(dt.errors)
                    {
                        $.each(dt.errors, function (key, value) {
                            var input = '[name=' + key +']';
                            $(input + '+span').html('<strong>'+ value +'</strong>');
                            $(input).addClass('is-invalid');
                            $(input).focus();
                            $(input).change(function(){
                                $(input).removeClass('is-invalid');
                                $(date_process).removeClass('is-invalid');
                                $('.date_time').hide();
                            })
                        });
                    }
                    else if(dt.status == 'not_apply')
                    {
                        swal('Warning','Sorry This Candidate Not Apply Job!','warning');
                    }
                    
                })
         }
    });
}

var tableNotification;

function showNotification()
{
    $("#modalNotif").modal('show');


    // for datatable rec process
    tableNotification = $('#tableNotification').DataTable({
            aaSorting: [[0, 'desc']],
            bPaginate: true,
            bFilter: true,
            bInfo: true,
            bSortable: true,
            bRetrieve: true,
            pageLength:5,
            "iDisplayLength": 10,
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
                url : "{{route('rec-process.showNotification')}}",
                data:{'dataSearch':'','all':''},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },
            
            columns: [
                    
                    {data: 'name_holder'},
                    {data: 'request_job_number'},
                    {data: 'history_position_name'},
                    {data: 'history_date'},
                    {data: 'history_invitation_process'},
                    {data: 'history_result'},
                    {data: 'history_remarks'},
                    {data: 'history_confirmation'},
                    {
                    // this for numbering table
                        render: function (data, type, row, meta) {
                            if(row.history_result == 'RESCHEDULE')
                            {
                               return '<button class="btn btn-success" onclick="send_reschedule('+row.history_process_id+',`'+row.history_date+'`)"> Re-Invited </button>'+
                                     '<button style="margin-top:10px;" class="btn btn-danger" onclick="send_decline('+row.history_process_id+')"> Decline </button>';
                            }
                            else
                            {
                                return '';
                            }
                        }
                    },
                    

            ],
             "columnDefs": [{
              "targets": 0,
               // "width": "20%", 
              "orderable": false
            }],
    });

     
      
}


function getDataNotif(all)
{
    if(all){
        $('[name="dateNotif"]').val('');
    }
    var getSearch = $('[name="dateNotif"]').val();

    tableNotification.clear();
    tableNotification.destroy();


    tableNotification = $('#tableNotification').DataTable({
        aaSorting: [[0, 'desc']],
        bPaginate: true,
        bFilter: true,
        bInfo: true,
        bSortable: true,
        bRetrieve: true,
        "iDisplayLength": 10,
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
            url : "{{route('rec-process.showNotification')}}",
            data:{'dataSearch':getSearch,'all':all},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        },
        
        columns: [
                  {data: 'name_holder'},
                    {data: 'request_job_number'},
                    {data: 'history_position_name'},
                    {data: 'history_date'},
                    {data: 'history_invitation_process'},
                    {data: 'history_result'},
                    {data: 'history_remarks'},
                    {data: 'history_confirmation'},
                    {
                    // this for numbering table
                        render: function (data, type, row, meta) {
                            if(row.history_result == 'RESCHEDULE' )
                            {
                               return '<button class="btn btn-success" onclick="send_reschedule('+row.history_process_id+',`'+row.history_date+'`)"> Re-Invited </button>'+
                                     '<button style="margin-top:10px;" class="btn btn-danger" onclick="send_decline('+row.history_process_id+')"> Decline </button>';
                            }
                            else
                            {
                                return '';
                            }
                        }
                    },

        ],
         "columnDefs": [{
          "targets": 0,
           // "width": "20%", 
          "orderable": false
        }],
    });
}


function send_reschedule(history_id,time)
{
     swal({
      title: "Are you sure?",
      text: "Confirm this re-schedule on "+time+" ",
      icon: "warning",
      
       // buttons: ["No", "Yes"],
        buttons: {
        cancel: "Cancel",
        no: "No",
        yes: "Yes",
      },
      dangerMode: true,
    })
    .then((willDelete) => {
        switch  (willDelete) {

            case "yes":
                 $.ajax({
                    url:"{{url('rec-process/send_reschedule/')}}",
                    type:'POST',
                    data:{history_id:history_id,time:''},
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data)
                    {   
                        swal('Success','Send Invitation','success');
                        location.reload(true);   
                    }
                });
            break;
            case "no":
                $('#modalReInvited').modal('show').focus();   
                $('[name="history_id"]').val(history_id);
            break;
            default:
                
            break;


        }
    });
}


function send_decline(history_id)
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
                url:"{{url('rec-process/send_decline/')}}",
                type:'POST',
                data:{history_id:history_id},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success:function(data)
                {   
                    swal('Success','Decline success','success');
                    location.reload(true);   
                }
            });
        }
    });
}

function send_reschedule_time()
{
    $('#btn_send_time').attr('disabled',false);
    $('#btn_send_time').text('Submit');
     $.ajax({
        url:"{{url('rec-process/send_reschedule/')}}",
        type:'POST',
        data:{time:$('[name="date_process_reinvited"]').val(),history_id:$('[name="history_id"]').val()},
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
         beforeSend:function(){
                $('#btn_send_time').attr('disabled',true);
                $('#btn_send_time').text('Loading ....');

        },
        success:function(data)
        {   
            swal('Success','Send Invitation','success');
            location.reload(true);   
        }
    });
}

function closeNotif()
{
    tableNotification.clear();
    tableNotification.destroy();
    $('#modalNotif').modal('hide');
    $('[name="dateNotif"]').val('');
}

$('.datepicker_join').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});

$('.datepickerJoinDate').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});



function detail_psyhotest(id)
{   
    var table = $('#table_psychotest');
    $.ajax({
            url:"{{url('rec-process/get_history_psychotest/')}}",
            type:'GET',
            data:{id:id},
            dataType: "json",
            success:function(rsp)
            {   
                console.log(rsp);
                table.empty();
                table.append(
                        '<tr>'+
                            '<td> IQ </td>'+
                            '<td> PAULI </td>'+
                            '<td> DISC </td>'+
                            '<td> CBI </td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>'+rsp.data.iq+'</td>'+
                            '<td>'+rsp.data.pauli+'</td>'+
                            '<td>'+rsp.data.disc+'</td>'+
                            '<td>'+rsp.data.cbi+'</td>'+
                        '</tr>'

                    )
          
            },
    });
    $('#modal_psychotest').modal('show');
}


</script>