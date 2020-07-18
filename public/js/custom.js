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


function number_valid()
{
    $(".number_valid").on("keypress", function (event) {
      var regex = /[0-9+,.]/g;
      var key = String.fromCharCode(event.which);
      if (regex.test(key) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39) {
          return true;
      }
        return false;
    });
}
function datepicker()
{
    $('.datepicker').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
}

tinymce.init({
  selector: '.textAreaEditor',
    height: 150,
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




function hoverProcess(param)
{
    if(param == "cv_in" )
    {
        $("#cv_in").addClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');
    }
    else if(param == "cv_sort")
    {
        $("#cv_sort").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');

    }
    else if(param == "failed")
    {
        $("#failed").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');

    }
    else if(param == "called")
    {
        $("#called").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');

    }
    else if(param == "psychotest")
    {
        $("#psychotest").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');

    }

    else if(param == "initial_in")
    {
        $("#initial_in").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');

    }

    else if(param == "interview_1")
    {
        $("#interview_1").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');
    }

    else if(param == "interview_2")
    {
        $("#interview_2").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');
    }
    
    else if(param == "interview_3")
    {
        $("#interview_3").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');
    }   
     
    else if(param == "med_check")
    {
        $("#med_check").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
        $("#hired").removeClass('active_card');
    } 

    else if(param == "offering_letter")
    {
        $("#offering_letter").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#hired").removeClass('active_card');
    } 

    else if(param == "hired")
    {
        $("#hired").addClass('active_card');
        $("#cv_in").removeClass('active_card');
        $("#cv_sort").removeClass('active_card');
        $("#failed").removeClass('active_card');
        $("#called").removeClass('active_card');
        $("#psychotest").removeClass('active_card');
        $("#initial_in").removeClass('active_card');
        $("#interview_1").removeClass('active_card');
        $("#interview_2").removeClass('active_card');
        $("#interview_3").removeClass('active_card');
        $("#med_check").removeClass('active_card');
        $("#offering_letter").removeClass('active_card');
    }
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
            $.each(data.errors, function (key, value) {
                var input = '[name=' + key + ']';
                $(input + '+i').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        },
    })
}