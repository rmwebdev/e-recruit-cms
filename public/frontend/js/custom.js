$('.datepicker').datepicker({
        uiLibrary: 'bootstrap4', 
        format: 'yyyy-mm-dd',
        
    });
  $(".number_valid").on("keypress", function (event) {
      var regex = /[0-9.]/g;
      var key = String.fromCharCode(event.which);
      if (regex.test(key) || event.keyCode == 8 || event.keyCode == 9 ) {
          return true;
      }
        return false;
  });  

   $(".number_valid_char").on("keypress", function (event) {
      var regex = /[0-9]/g;
      var key = String.fromCharCode(event.which);
      if (regex.test(key) || event.keyCode == 8 || event.keyCode == 9) {
          return true;
      }
        return false;
    });


function number_valid()
{
    $(".number_valid").on("keypress", function (event) {
      var regex = /[0-9+.]/g;
      var key = String.fromCharCode(event.which);
      if (regex.test(key) || event.keyCode == 8 || event.keyCode == 9 ) {
          return true;
      }
        return false;
    });
}

function number_valid_char()
{
    $(".number_valid_char").on("keypress", function (event) {
      var regex = /[0-9]/g;
      var key = String.fromCharCode(event.which);
      if (regex.test(key) || event.keyCode == 8 || event.keyCode == 9) {
          return true;
      }
        return false;
    });
}
function datepicker()
{
    $('.datepicker').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
}



function cek_ktp(url)
{
     $.ajax({
        url: 'cek_ktp/'+url, 
        type: "GET",   
        data: {'ktp_no':$('[name="ktp_no"]').val(),'date_of_birth':$('[name="date_of_birth"]').val(),'gender':$('[name="gender"]').val()}, 
        dataType:'JSON',
        success: function(data)   
        {       
            console.log(data);
            
            if(data.errors)
            {
              if(data.errors.ktp_no_valid)
              {
                 swal('Error','Silahkan cek kembali nomor ktp anda, kemungkinan ada yang tidak sesuai dengan tanggal lahir dan jenis kelamin.','error').then(function(){
                        $('[name="ktp_no"]').focus();
                        $('[name="ktp_no"]').addClass('is-invalid');
                    });
              }
              $.each(data.errors, function (key, value) {
                var input = '[name=' + key + ']';
                $(input + '+i').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
              });
            }
            
            
        },
    })
}