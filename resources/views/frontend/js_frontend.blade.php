@php
  $candidate_id = Session::get('userinfo')['candidate_id'];
  $process_ = \App\Models\Candidate::find($candidate_id);  
  $process = (empty($process_))  ? "" : $process_->process;

@endphp

<!-- Modal Login -->
<div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width: 651px">
    <div class="modal-content">
      <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="ml-5 mt-3">
            <div class="col-md-6 ml-5 mt-3  color-pun-abu">
              <h3 class="color-pun-biru mb-3"> <strong class=" font-20">CHANGE PASSWORD </strong> </h3>
            </div>
              <form class="form-signin ml-5 mt-5" id="form-forgot-password">
                
                  <div class="form-label-group">
                    <div class="col-md-11"> 
                        <input type="hidden" name="id" value="{{ (empty($id)) ? ""  : $id }}">
                        <input type="hidden" name="key" value="{{ (empty($email)) ? "" :  $email}}">
                        <input type="password" class="form-control" name="password" placeholder="Input New Password" required autofocus>
                      <span class="invalid-feedback" role="alert"></span>
                    </div>
                  </div>

                  <div class="form-label-group">
                   <div class="col-md-11 mt-3">
                        <input type="password"  class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                      <span class="invalid-feedback" role="alert"></span>
                    </div>
                  </div>

                  <div class="form-label-group  font-14">
                    <div class="col-md-11 m3-5 mt-3">
                        <div class="clearfix">
                          <button type="button"  class="btn bg-white pull-left" style="width: 200px;" data-dismiss="modal" >Cancel</button>
                          <button type="submit"  class="btn  pull-right bg-pun-orange color-white" style="width: 200px">Submit</button>
                        </div>
                    </div>
                  </div>

              </form>
           </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
var process = '{{$process}}';
var warningFront ='{{Session::get('warningFront')}}';
var userinfo = "@php echo ( !empty(Session::get('userinfo')) ) ? Session::get('userinfo')['process']:'' @endphp"; 
var url = '{{Request::segment(1)}}';
var id_ = '{{ (empty($id)) ? ""  : $id }}';



$(document).ready(function(){


    $('#carouselExampleIndicators').carousel({
      interval: 5000,
      cycle: true
    }); 

    number_valid_char();
    // getDescJob();
    var alert_regis = '{{session('status_regis')}}';
    var confirmation = '{{session('confirmation')}}';
    var confirmQr = '{{Session::get('confirmQR')}}';


    if(warningFront == 'getSess')
    {
        $('#modalWarning').modal('hide');    
    }
    else
    {
        if(id_ != '')
        {
            $('#modalChangePassword').modal('show');
            //$("#modalWarning iframe").attr('src', '');  
        }
        else if(id_ == "")
        {
            if (url == "" || url =="home")
            {
                $('#modalWarning').modal('show');           
              //  $("#modalWarning iframe").attr('src', '');  
            }
        }
    }
    


    if(alert_regis)
    {
        swal('Attention',alert_regis,'success');        
    }  


    if(confirmation)
    {
        swal('Attention',confirmation,'success').then(function(){
                    modalLogin();
                });  
    }

    
    //$("#modalWarning iframe").attr('src', '');    

    

})

function closeWarning()
{
     $.ajax({
        url:'close_warning',
        dataType:'JSON',
        type:'GET',
    })
    $('#modalWarning').modal('hide');

    $("video").each(function () { this.pause() });

}
    


function closeModalWarning()
{
    $('#modalWarning').modal('hide');

    $("video").each(function () { this.pause() });
}


function modalLogin()
{
	$("#modalLoginFront").modal('show');	 
    
}

function modalRegistration()
{
	$("#modalRegistration").modal('show');	
}

function closeModalLogin()
{
	$('#form-signin')[0].reset();
	$('#modalLoginFront').modal('hide');
	$('[name="email"]').removeClass('is-invalid');
	$('[name="password"]').removeClass('is-invalid');
}

function closeModalRegistration()
{
	$('#form-registration')[0].reset();
	$('[name="email"]').removeClass('is-invalid');
	$('[name="password"]').removeClass('is-invalid');
	$('[name="password_confirmation"]').removeClass('is-invalid');
	$('[name="name_holder"]').removeClass('is-invalid');
	$('[name="password"]').removeClass('is-invalid');
	$('#modalRegistration').modal('hide');	
    $('#saveBtnRegis').attr('disabled',false);
    $('#saveBtnRegis').text('Register');
}


function alertApply()
{        
    position_name= $('[name="position_name"]').val();
    return swal('Warning','You already have registered as a candidate for  '+ position_name +' , You can only apply for one job vacancy','warning')
}


function applyNow(job_fptk_id,par_position_name)
{
    var sess;

    sess = "@php echo ( !empty(Session::get('userinfo')) ) ? Session::get('userinfo')['candidate_id']:'' @endphp"; 

    job_fptk= $('[name="job_fptk"]').val();
    position_name= $('[name="position_name"]').val();
    result= $('[name="result"]').val();
    process= $('[name="process"]').val();
    exp_date = $('[name="exp_date"]').val();
    date_now = $('[name="date_now"]').val();



    if(userinfo === '')
    {
        swal('Attention','Please login or registration before apply this job!','warning')
        .then(function()
            {modalLogin();});
    }
    else
    {

        if(process== "PSYCHOTEST" && result == 'FAILED')
        {

            if(date_now < exp_date)
            {
                alertApply()
                //alert('tes ini 2 tahun')
                 return false;
            }

            alertApply()
            
            return false;
        }

        if(process == "NOT ATTENDING" && result == "FAILED")
        {
            if(date_now < exp_date)
            {
                alertApply()
                //alert('tes ini 2 tahun')
                 return false;
            }
            alertApply()

            return false;
        }

        if(result == 'FAILED')
        {
            if(position_name == par_position_name)
            {
                swal('Warning','Sorry position name already to apply','warning')
                return false;
            }

           alertApply();    
            return false;
        }


        if(job_fptk)
        {
           alertApply();    
            return false;
        }
     
            swal({
              title: "Are you sure",
              text: " Apply this job ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url:'{{route('frontend.saveJob')}}',
                    dataType:'JSON',
                    data:{id:sess,job_fptk_id:job_fptk_id},
                    type:'POST',
                    headers: {
                       'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(get){
                        if(get.status=='success')
                        {
                            

                            swal('Success','Data job has been apply successfully!','success').then(function(){
                                $(location).attr('href','/home');    
                            });
                        }
                    },
                      error: function (xhr, ajaxOptions, thrownError) {
                        swal('Error ','Please input form candidate first !','error').then(function(){
                                $(location).attr('href','/form-candidate');    
                            });
                      },
                })

              } 
            });    

    }
}



// this function for save candidate
$('#form-registration').submit(function(event){

    event.preventDefault(); //prevent default action 
    
    dataRegis =  $("#form-registration").serialize();
    $.ajax({
        url:'{{route('frontend.regisCandidate')}}',
        type:'POST',
        data:dataRegis,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
       beforeSend: function( xhr ) {
            $('#saveBtnRegis').attr('disabled',true);
            $('#saveBtnRegis').text('Loading .......');
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Please check your email to activate your account ','success').then(function(){
                        location.reload(true);
                    });
                closeModalRegistration();
            }
            else if(data.status=='captcha_error')
            {
                swal('Attention ',data.message+'!','warning');    
                $('#saveBtnRegis').attr('disabled',false);
                $('#saveBtnRegis').text('Register');
            }
            
        })
        .fail(function(data) {

            $('#saveBtnRegis').attr('disabled',false);
            $('#saveBtnRegis').text('Register');
            var dt = data.responseJSON;
            console.log(dt);
            if(dt.errors.candidate_error)
            {   
                swal('Error','Candidate is already exist','error');
            }
            else if(dt.errors.email_error)
            {
                swal('Error','Connection failures(101)','error');
            }

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

// this function for login candidate
$('#form-signin').submit(function(event){

    event.preventDefault(); //prevent default action 
    
    dataRegis =  new FormData($("#form-signin")[0]);
    $.ajax({
        url:'{{route('frontend.loginCandidate')}}',
        type:'POST',
        data:dataRegis,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        beforeSend: function( xhr ) {
   			$('.loginBtn').attr('disabled',true);
   			$('.loginBtn').text('Loading .......');
  		},
          cache:false,
          contentType:false,
          processData:false,
    })
     .done(function(data) {
            if(data.status == 'success' && data.notif ==  0)
            {
                swal('Success','Login Successfuly','success').then(function(){
                    $(location).attr('href','/');    
                });    
            }
            else if(data.status == 'success' && data.notif > 0)
            {
                swal('Success','Login Successfuly','success').then(function(){
                    $(location).attr('href','/form-candidate/confirmation');    
                });    
            }
            else
            {
                swal('Success','Login Successfuly','success').then(function(){
                    $(location).attr('href','/');    
                });       
            }
            
        })
        .fail(function(data) {
            $('.loginBtn').attr('disabled',false);
   			$('.loginBtn').text('Login');
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



//this function for check email exist or not
function emailCheck()
{
    email = $('#form-registration [name="email"]').val();

    $.ajax({
        url:'{{route('frontend.emailCheck')}}',
        type:'POST',
        data:{'email':email},
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

function refreshCaptcha()
{
    $.ajax({
        url:'{{route('frontend.refreshCaptcha')}}',
        type:'GET',
        success:function(data)
        {   
            $('.refreshCaptcha').html(data);
        }
    })   
}

function notHaveAccount()
{
    $('#form-registration')[0].reset();
    $('[name="email"]').removeClass('is-invalid');
    $('#modalRegistration').modal('show');
    $('#modalLoginFront').modal('hide');
}

function closeModalForgotPassword()
{
    $('[name="email_forgot"]').removeClass('is-invalid');
    $('#modalForgotPassword').modal('hide');
    $('#form-forgot')[0].reset();
}

function modalForgotPassword()
{

    $('#form-forgot')[0].reset();
    $('#modalForgotPassword').modal('show');
    $('#modalLoginFront').modal('hide');
    $('#modalRegistration').modal('hide');
}

// this function for save candidate
$('#form-forgot').submit(function(event){

    event.preventDefault(); //prevent default action 
    
    dataForgot =  new FormData($("#form-forgot")[0]);
    $.ajax({
        url:'{{route('frontend.sendEmailForgot')}}',
        type:'POST',
        data:dataForgot,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        beforeSend: function( xhr ) {
            $('.loginBtn').attr('disabled',true);
            $('.loginBtn').text('Loading .......');
        },
          cache:false,
          contentType:false,
          processData:false,
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Please check your email for account recovery','success').then(function(){
                        location.reload(true);
                });
            }
            
        })
        .fail(function(data) {
            $('.loginBtn').attr('disabled',false);
            $('.loginBtn').text('Login');
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



// this function for save candidate
$('#form-forgot-password').submit(function(event){

    event.preventDefault(); //prevent default action 
    
    dataForgot =  new FormData($("#form-forgot-password")[0]);
    $.ajax({
        url:'{{route('frontend.actionForgotPassword')}}',
        type:'POST',
        data:dataForgot,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        beforeSend: function( xhr ) {
            $('.loginBtn').attr('disabled',true);
            $('.loginBtn').text('Loading .......');
        },
          cache:false,
          contentType:false,
          processData:false,
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Password has been changed successfully','success').then(function(){
                        //location.reload(true);
                        $(location).attr('href','/');    
                    });
            }
            
        })
        .fail(function(data) {

            $('.loginBtn').attr('disabled',false);
            $('.loginBtn').text('Login');
            var dt = data.responseJSON;

            if(dt.errors == 'error_change_password')
            {
                swal('Error','Sorry change password failed','error').then(function(){
                        //location.reload(true);
                        $(location).attr('href','/');    
                    });
            }
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


function toCandidateForm()
{
    swal('Warning','Please complete form candidate first','warning').then(function(){
                        $(location).attr('href','/form-candidate');    
                    });
}

function get_detail(e,id)
{
    if(process == "")
    {

        swal('Warning','Please login or registration first ','warning')
        .then(function(){
                        $('#modalLoginFront').modal('show');
                    });
        return false;
    }
    else if(process =="REGISTRATION")
    {
        swal('Warning','Please input form candidate first  ','warning')
        .then(function(){
                          $(location).attr('href','/form-candidate');
                    });
        return false;   
    }
    else
    {
        $(location).attr('href','/detail-job?id_job='+id+'');
    }


}


</script>