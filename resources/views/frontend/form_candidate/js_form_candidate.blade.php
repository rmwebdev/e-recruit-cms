
<!-- Modal Login -->
<div class="modal fade" id="modalReschedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 70%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="" style="font-weight: bold">Form Reschedule</h5>
        </div>
        <div class="modal-body">
           <form class="form-reschedule" id="form-reschedule">
              <input type="hidden" name="result" value="RESCHEDULE">
              <input type="hidden" name="process_id" value="">
              <div class="form-label-group">
                <label for="inputEmail">Date Time</label>
                <input type="text" class="form-control" name="date_process" placeholder="Date Time" autofocus>
                <span class="invalid-feedback" id="date_process" role="alert"></span>
              </div>
              <div class="form-label-group">
                <label for="inputEmail">Reason</label>
                <textarea class="form-control" name="remarks"></textarea>
                <span class="invalid-feedback" role="alert"></span>
              </div>
           
        </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" onclick="saveReschedule()">Submit</button>
          </div>
        </form>
      </div>
    </div>
</div>



<script type="text/javascript">
 var map;
  
$(document).ready(function(){
     $('[name="date_process"]').datetimepicker({ 
            footer: true, 
            modal: true,
            uiLibrary: 'bootstrap4', 
            format: 'yyyy-mm-dd HH:MM'
        });  

    $('[name="edu_university"]').select2();
    $('[name="city"]').select2();
    $('[name="nationality"]').select2();

    
    // this for form wizard =========================
    
if( typeof ($.fn.smartWizard) === 'undefined'){ return; }


 $('#wizard').smartWizard({
  onLeaveStep:leaveAStepCallback,
  onFinish:onFinishCallback,
      labelNext:'Next', // label for Next button
    labelPrevious:'Previous', // label for Previous button
    labelFinish:'Finish',  // label for Finish button        
 
});
     

function leaveAStepCallback(obj, context){
                          
  if(context.fromStep == 1)
  {
      $("#form-candidate-step-1").valid();
      var step_form1;
      data_candidate =  new FormData($("#form-candidate-step-1")[0]);
      data_candidate.append('step','step1');
      $.ajax({
            url:'{{route('form-candidate.update')}}',
            type:'POST',
            data:data_candidate,
            async:false,
            dataType: "json",
            success:function(data){
                 if(data.status == 'success')
                 {
                    return step_form1 = true; 
                 }
                 else
                 {
                    return step_form1 = false;
                 }
                 
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
              cache:false,
              contentType:false,
              processData:false,

        }) 
        .fail(function(data) {
            
            var dt = data.responseJSON;
            
            if(dt.errors)
            {
                if(dt.errors.ktp_no_valid)
                {
                   return   swal('Error','Silahkan cek kembali nomor ktp anda, kemungkinan ada yang tidak sesuai dengan tanggal lahir dan jenis kelamin.','error').then(function(){
                        $('[name="ktp_no"]').focus();
                    });
                }
            }
            
        });
      // return true;
      return step_form1;
    }
    else if(context.fromStep ==2)
    {
      $("#form-candidate-step-2").valid();
      var step_form2;
      data_candidate =  new FormData($("#form-candidate-step-2")[0]);
      data_candidate.append('step','step2');
      $.ajax({
            url:'{{route('form-candidate.update')}}',
            type:'POST',
            data:data_candidate,
            async:false,
            dataType: "json",
            success:function(data){
                 if(data.status == 'success')
                 {
                    return step_form2 = true; 
                 }
                 else
                 {
                    return step_form2 = false;
                 }
                 
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
              cache:false,
              contentType:false,
              processData:false,

        }) 
      // return true;
      return step_form2;
    }
    else if(context.fromStep ==3)
    {
      return true;
    }

}

function onFinishCallback(objs, context){
  if(validateAllSteps()){
  var form = $( "#form-candidate-step-3" );

  form.valid();
      var step_form3;
      data_candidate =  new FormData($("#form-candidate-step-3")[0]);
      data_candidate.append('step','step3');
      $.ajax({
            url:'{{route('form-candidate.update')}}',
            type:'POST',
            data:data_candidate,
            async:false,
            dataType: "json",
            success:function(data){
                 if(data.status == 'success')
                 {
                    swal('Success','Candidate has been saved successfully!','success').then(function(){
                      $(location).attr('href','/');  
                    });
                 }
                 else
                 {
                    return step_form3 = true;
                 }
                 
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
              cache:false,
              contentType:false,
              processData:false,

        }) .fail(function(data) {
    
            var dt = data.responseJSON;
            
            if(dt.errors)
            {
                if(dt.errors.ktp_no_valid)
                {
                   return   swal('Error','Silahkan cek kembali nomor ktp anda, kemungkinan ada yang tidak sesuai dengan tanggal lahir dan jenis kelamin.','error').then(function(){
                        $('[name="ktp_no"]').focus();
                        $('[name="ktp_no"]').addClass('is-invalid');
                    });
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

            }
            
        });
      // return true;
      return step_form3;
    }
}

   
function validateAllSteps(){
    var isStepValid = true;
    return isStepValid;
} 

  $('#wizard_verticle').smartWizard({
    transitionEffect: 'slide'
  });

  $('.buttonNext').addClass('btn bg-pun-orange color-white');
  $('.buttonPrevious').addClass('btn btn-default');
  
  $('.buttonFinish').addClass('btn btn-success');
    /// end form wizard =======================

})

//this function for change file photo profile 
function changFile1(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();


    reader.onload = function(e) {
      $('#output_image_front').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}


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
            url:'{{route('form-candidate.update')}}',
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
                    $(location).attr('href','/');
                }
                
            })
            .fail(function(data) {
                
                var dt = data.responseJSON;
                
                if(dt.errors)
                {
                    if(dt.errors.ktp_no_valid)
                    {
                       return   swal('Error','Silahkan cek kembali nomor ktp anda, kemungkinan ada yang tidak sesuai dengan tanggal lahir dan jenis kelamin.','error').then(function(){
                            $('[name="ktp_no"]').focus();
                            $('[name="ktp_no"]').addClass('is-invalid');
                        });
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

                }
                
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


//this function for change file photo profile 
function changFile1(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();


    reader.onload = function(e) {
      $('#output_image_front').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
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

function processConfirmation(result,id,process_id)
{
     swal({
      title: "Are you sure",
      text: " this action  ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        if(result == "RESCHEDULE")
        { 
            $('[name="process_id"]').val(process_id);
            $('#modalReschedule').modal({display:'show',backdrop: 'static'});;
        }
        else
        {
            $.ajax({
              url:'{{route('form-candidate.actionConfirmation')}}',
              type:'POST',
              data:{result:result,id:id,process_id:process_id},
              dataType: "json",
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
            })
             .done(function(data) {
              console.log(data);
                    if(data.status == 'success')
                    {
                        swal('Success','Candidate has been saved successfully!','success');
                        location.reload(true);
                    }

                    else if(data.status == 'error_confirmation')
                    {
                        swal('Error','Please complete data '+ data.message +'','error');
                    }
                    
                })
                .fail(function(data) {     
                    if(data.responseJSON.status == 'error_confirmation' && result =='ATTENDING')
                    {
                        swal('Error','Please complete data '+ data.responseJSON.message +'','error').then(function(){
                                $(location).attr('href','/form-complete?result='+result+'&id='+id+'&process_id='+process_id+'');    
                            });
                    }
                });
        }
      } 
    });    
}


$('#form-reschedule').submit(function(event){
  event.preventDefault(); //prevent default action 
  form = $('#form-reschedule').serialize();
   $.ajax({
      url:'{{route('form-candidate.saveReschedule')}}',
      type:'POST',
      data:form,
      dataType: "json",
      headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Candidate has been saved successfully!','success');
                location.reload(true);
            }
        })
        .fail(function(data) {  
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ']';
                if(dt.errors.date_process)
                {
                  $('#date_process').show();
                  $('#date_process').html('<strong>The date process field is required</strong>');
                }
                
                $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).change(function(){
                      $(input).removeClass('is-invalid');
                      $('#date_process').hide();
                      $('#date_process').removeClass('is-invalid');
                      
                  })
                
            }); 
        });
})



</script>