<style type="text/css">
.swal-button {
  padding: 7px 100px;
  border-radius: 2px;
  background-color: #feab1f;
  font-size: 12px;
  margin: auto 0;
  border: 1px solid #feab1f;
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
}
.swal-footer {
  text-align: center;
}
.swal-button:not([disabled]):hover{
      background-color: #feab1f;
}
</style>
<script type="text/javascript">
// var no_fam = 0;

var result ="<?= (!isset($_GET['result'])) ?  0 : $_GET['result'] ?>";
var id ="<?= (!isset($_GET['id'])) ? 0 : $_GET['id'] ?>";
var process_id ="<?= (!isset($_GET['process_id'])) ? 0 : $_GET['process_id'] ?>";


$(document).ready(function(){
    var box_action = $('[name="box_action"]').val();

    switch(box_action){
        case 'family':
            familyInfo();
            break;
        case 'edu':
            eduBack();
            break;
        case 'skill':
            langSkill();
            break;
        case 'personal':
            personalInfo();
            break;
        case 'assessment':
            other();
            break;
        default :
        personalInfo();
    }

	datepicker();
    $("#modalWarning iframe").attr('src', '');
})

//this function for change file photo profile 
function changePhoto(input) 
{   
 
  var dataFile =  new FormData($("#form-candidate-edit")[0]);
  $.ajax({

        url: "{{route('form-complete.changePhoto')}}", 
        type: "POST",   
        data: dataFile, 
        dataType:'JSON',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(data)   
        {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $('#editPhoto').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                $('[name="file_1_edit"]').val(input.files[0].name);
        },
        contentType: false,       
        cache: false,             
        processData:false,
    }).fail(function(data) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#editPhoto').attr('src', e.target.result);
            }
            
            $('[name="file_1_edit"]').val(input.files[0].name);
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

function changeCV(input)
{
    var dataFile =  new FormData($("#form-candidate-edit")[0]);
    $.ajax({

        url: "{{route('form-complete.changeCV')}}", 
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
              $('#editCV').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $('[name="file_2_edit"]').val(input.files[0].name);
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



function hover(param)
{
    if(param == "familyInfo" )
    {

        // $('#familyInfo').prop("onclick", null).off("click");

        $("#familyInfo").addClass('active_card_family');
        $("#familyInfo").removeClass('no_active_card_family');
      


        $("#personalInfo").removeClass('active_card_personal');
        $("#personalInfo").addClass('no_active_card_personal');
     


        $("#eduBack").removeClass('active_educational_background');
        $("#eduBack").addClass('no_active_educational_background');
       

        $("#courseInfo").removeClass('active_course_info');
        $("#courseInfo").addClass('no_active_course_info');
     

        $("#langSkill").removeClass('active_lang_skill');
        $("#langSkill").addClass('no_active_lang_skill');
      

        $("#orgInfo").removeClass('active_org_info');
        $("#orgInfo").addClass('no_active_org_info');



        $("#jobExp").removeClass('active_job_exp');
        $("#jobExp").addClass('no_active_job_exp');
    


        $("#other").removeClass('active_other');
        $("#other").addClass('no_active_other');
     

    }
    else if(param == "eduBack")
    {

        //$('#familyInfo').prop("onclick", 'teslo').on("click");
        // $('#eduBack').prop("onclick", null).off("click");
        $("#eduBack").addClass('active_educational_background');
        $("#eduBack").removeClass('no_active_educational_background');
      


        $("#familyInfo").removeClass('active_card_family');
        $("#familyInfo").addClass('no_active_card_family');




        $("#personalInfo").removeClass('active_card_personal');
        $("#personalInfo").addClass('no_active_card_personal');

     

        $("#courseInfo").removeClass('active_course_info');
        $("#courseInfo").addClass('no_active_course_info');



        $("#langSkill").removeClass('active_lang_skill');
        $("#langSkill").addClass('no_active_lang_skill');
 

        $("#orgInfo").removeClass('active_org_info');
        $("#orgInfo").addClass('no_active_org_info');

        $("#jobExp").removeClass('active_job_exp');
        $("#jobExp").addClass('no_active_job_exp');
   

        $("#other").removeClass('active_other');
        $("#other").addClass('no_active_other');
       
    }
    else if(param == "jobExp")
    {

        $("#jobExp").addClass('active_job_exp');
        $("#jobExp").removeClass('no_active_job_exp');


        $("#familyInfo").removeClass('active_card_family');
        $("#familyInfo").addClass('no_active_card_family');


        $("#personalInfo").removeClass('active_card_personal');
        $("#personalInfo").addClass('no_active_card_personal');


        $("#eduBack").removeClass('active_educational_background');
        $("#eduBack").addClass('no_active_educational_background');

        $("#courseInfo").removeClass('active_course_info');
        $("#courseInfo").addClass('no_active_course_info');

        $("#langSkill").removeClass('active_lang_skill');
        $("#langSkill").addClass('no_active_lang_skill');


        $("#orgInfo").removeClass('active_org_info');
        $("#orgInfo").addClass('no_active_org_info');



        $("#other").removeClass('active_other');
        $("#other").addClass('no_active_other');


    }
    else if(param == "other")
    {
        
        $("#other").addClass('active_other');
        $("#other").removeClass('no_active_other');


        $("#jobExp").removeClass('active_job_exp');
        $("#jobExp").addClass('no_active_job_exp');


        $("#familyInfo").removeClass('active_card_family');
        $("#familyInfo").addClass('no_active_card_family');


        $("#personalInfo").removeClass('active_card_personal');
        $("#personalInfo").addClass('no_active_card_personal');


        $("#eduBack").removeClass('active_educational_background');
        $("#eduBack").addClass('no_active_educational_background');

        $("#courseInfo").removeClass('active_course_info');
        $("#courseInfo").addClass('no_active_course_info');

        $("#langSkill").removeClass('active_lang_skill');
        $("#langSkill").addClass('no_active_lang_skill');


        $("#orgInfo").removeClass('active_org_info');
        $("#orgInfo").addClass('no_active_org_info');

    }
    else if(param == "langSkill")
    {
        $("#langSkill").addClass('active_lang_skill');
        $("#langSkill").removeClass('no_active_lang_skill');


        $("#personalInfo").removeClass('active_card_personal');
        $("#personalInfo").addClass('no_active_card_personal');


        $("#familyInfo").removeClass('active_card_family');
        $("#familyInfo").addClass('no_active_card_family');


        $("#eduBack").removeClass('active_educational_background');
        $("#eduBack").addClass('no_active_educational_background');


        $("#courseInfo").removeClass('active_course_info');
        $("#courseInfo").addClass('no_active_course_info');

        $("#orgInfo").removeClass('active_org_info');
        $("#orgInfo").addClass('no_active_org_info');

        $("#jobExp").removeClass('active_job_exp');
        $("#jobExp").addClass('no_active_job_exp');

        $("#other").removeClass('active_other');
        $("#other").addClass('no_active_other');

    }

    else if(param == "orgInfo")
    {

        $("#orgInfo").addClass('active_org_info');
        $("#orgInfo").removeClass('no_active_org_info');


        $("#personalInfo").removeClass('active_card_personal');
        $("#personalInfo").addClass('no_active_card_personal');


        $("#familyInfo").removeClass('active_card_family');
        $("#familyInfo").addClass('no_active_card_family');


        $("#eduBack").removeClass('active_educational_background');
        $("#eduBack").addClass('no_active_educational_background');


        $("#courseInfo").removeClass('active_course_info');
        $("#courseInfo").addClass('no_active_course_info');

        $("#langSkill").removeClass('active_lang_skill');
        $("#langSkill").addClass('no_active_lang_skill');


        $("#jobExp").removeClass('active_job_exp');
        $("#jobExp").addClass('no_active_job_exp');
        

        $("#other").removeClass('active_other');
        $("#other").addClass('no_active_other');

    }

    else if(param == "personalInfo")
    {
        $("#personalInfo").addClass('active_card_personal');
        $("#personalInfo").removeClass('no_active_card_personal');


        $("#familyInfo").removeClass('active_card_family');
        $("#familyInfo").addClass('no_active_card_family');


        $("#eduBack").removeClass('active_educational_background');
        $("#eduBack").addClass('no_active_educational_background');


        $("#courseInfo").removeClass('active_course_info');
        $("#courseInfo").addClass('no_active_course_info');

        $("#langSkill").removeClass('active_lang_skill');
        $("#langSkill").addClass('no_active_lang_skill');

        $("#orgInfo").removeClass('active_org_info');
        $("#orgInfo").addClass('no_active_org_info');

        $("#jobExp").removeClass('active_job_exp');
        $("#jobExp").addClass('no_active_job_exp');

        $("#other").removeClass('active_other');
        $("#other").addClass('no_active_other');
    }

    else if(param == "courseInfo")
    {
        $("#courseInfo").addClass('active_course_info');
        $("#courseInfo").removeClass('no_active_course_info');


        $("#personalInfo").removeClass('active_card_personal');
        $("#personalInfo").addClass('no_active_card_personal');


        $("#familyInfo").removeClass('active_card_family');
        $("#familyInfo").addClass('no_active_card_family');


        $("#eduBack").removeClass('active_educational_background');
        $("#eduBack").addClass('no_active_educational_background');

        $("#langSkill").removeClass('active_lang_skill');
        $("#langSkill").addClass('no_active_lang_skill');   


        $("#orgInfo").removeClass('active_org_info');
        $("#orgInfo").addClass('no_active_org_info');


        $("#jobExp").removeClass('active_job_exp');
        $("#jobExp").addClass('no_active_job_exp');

        $("#other").removeClass('active_other');
        $("#other").addClass('no_active_other');
    }
}

function refreshAlert()
{
     $.ajax({
            url:'{{route('form-complete.refreshAlert')}}',
            type:'GET',
            success:function(r){
                $('#alertValid').empty();
                $('#alertValid').html(r);
            }
        })
}


//function for update candidate
function updateCandidate()
{
   var dataFile =  new FormData($("#form-candidate-edit")[0]);
    $.ajax({
            url:'{{route('form-complete.store')}}',
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
     	   swal('Success','Data has been update successfully!','success');
           // location.reload(true);
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

// get data family

var no_family;
var no_emergency_contact; 
var getFamily = {};



function familyInfo()
{
  
  hover("familyInfo")
    var val_ = [];
    var span = document.createElement("span");
    span.innerHTML= 'Please make sure all the columns are already filled  <br> and save the data before leaving the page. <br><br> *<span style="font-size:12px">Click this button <button class="btn btn-success"><i class="fa fa-save"></i></button>  at the side of the column to save the data. </span>';
     swal({
            title: "Attention!",
            button: "OK",          
            icon: "../images/warning_modal.png",
            content: span,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url:'{{route('form-complete.familyInfo')}}',
                        type:'GET',
                        success:function(data)
                        {   
                            $('#content-candidate').html(data);
                            datepicker();

                            return  getFamily = {no_family:row_family,no_emergency_contact:row_emergency_contact};

                        }
                    })
            }
        })
}



// get data personal info
function personalInfo()
{
    hover('personalInfo');
   // var val_ = [];
   //  var span = document.createElement("span");
   //  span.innerHTML= 'Please make sure all the columns are already filled  <br> and save the data before leaving the page. <br><br> *<span style="font-size:12px">Click this button <button class="btn btn-success"><i class="fa fa-save"></i></button>  at the side of the column to save the data. </span>';
   //   swal({
   //          title: "Attention!",
   //          button: "OK",          
   //          icon: "../images/warning_modal.png",
   //          content: span,
   //      })
   //      .then((willDelete) => {
   //          if (willDelete) {
              
            	$.ajax({
                    url:'{{route('form-complete.personalInfo')}}',
                    type:'GET',
                    success:function(data)
                    {	
                    	$('#content-candidate').html(data);
                        number_valid_char();
                        number_valid();
                        $('.date_of_birth').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
                        $('[name="edu_university"]').select2();
                        $('[name="city"]').select2();
                    }
                })
        //     }
        // })
}

var no_course; 

// get data course
function courseInfo()
{

    hover('courseInfo');
       var val_ = [];
    var span = document.createElement("span");
    span.innerHTML= 'Please make sure all the columns are already filled  <br> and save the data before leaving the page. <br><br> *<span style="font-size:12px">Click this button <button class="btn btn-success"><i class="fa fa-save"></i></button>  at the side of the column to save the data. </span>';
     swal({
            title: "Attention!",
            button: "OK",          
            icon: "../images/warning_modal.png",
            content: span,
        })
        .then((willDelete) => {
            if (willDelete) {
               
                $.ajax({
                    url:'{{route('form-complete.courseInfo')}}',
                    type:'GET',
                    success:function(data)
                    {   
                        $('#content-candidate').html(data);
                        return no_course = row_courseInfo
                    }
                })

            }
        })

}

var no_orgInfo; 

// get data Org
function orgInfo()
{
    hover('orgInfo');
    var val_ = [];
    var span = document.createElement("span");
    span.innerHTML= 'Please make sure all the columns are already filled  <br> and save the data before leaving the page. <br><br> *<span style="font-size:12px">Click this button <button class="btn btn-success"><i class="fa fa-save"></i></button>  at the side of the column to save the data. </span>';
     swal({
            title: "Attention!",
            button: "OK",          
            icon: "../images/warning_modal.png",
            content: span,
        })
    .then((willDelete) => {
        if (willDelete) {
            
            $.ajax({
                url:'{{route('form-complete.orgInfo')}}',
                type:'GET',
                success:function(data)
                {   
                    $('#content-candidate').html(data);
                    return no_orgInfo = row_orgInfo
                }
            })
        }
    })
}


var no_langSkill; 
var no_skill; 
var getSkill = {};

// get data Org
function langSkill()
{
    hover('langSkill');
   var val_ = [];
    var span = document.createElement("span");
    span.innerHTML= 'Please make sure all the columns are already filled  <br> and save the data before leaving the page. <br><br> *<span style="font-size:12px">Click this button <button class="btn btn-success"><i class="fa fa-save"></i></button>  at the side of the column to save the data. </span>';
     swal({
            title: "Attention!",
            button: "OK",          
            icon: "../images/warning_modal.png",
            content: span,
        })
        .then((willDelete) => {
            if (willDelete) {
                
                $.ajax({
                    url:'{{route('form-complete.langSkill')}}',
                    type:'GET',
                    async:false,
                    success:function(data)
                    {   
                        $('#content-candidate').html(data);
                        return  getSkill = {no_skill:row_skill,no_langSkill:row_langSkill};
                    }
                })
            }
    })       
}



var no_eduBack; 

// get data Org
function eduBack()
{
    hover('eduBack');
   var val_ = [];
    var span = document.createElement("span");
    span.innerHTML= 'Please make sure all the columns are already filled  <br> and save the data before leaving the page. <br><br> *<span style="font-size:12px">Click this button <button class="btn btn-success"><i class="fa fa-save"></i></button>  at the side of the column to save the data. </span>';
     swal({
            title: "Attention!",
            button: "OK",          
            icon: "../images/warning_modal.png",
            content: span,
        })
        .then((willDelete) => {
            if (willDelete) {
                
                $.ajax({
                    url:'{{route('form-complete.eduBack')}}',
                    type:'GET',
                    success:function(data)
                    {   
                        $('#content-candidate').html(data);
                        return no_eduBack = row_eduBack
                    }
                })
            }
    })
}


var no_jobExp; 
var no_jobInterest; 
var getJob = {}; 

// get data Org
function jobExp()
{
    hover('jobExp');
   var val_ = [];
    var span = document.createElement("span");
    span.innerHTML= 'Please make sure all the columns are already filled  <br> and save the data before leaving the page. <br><br> *<span style="font-size:12px">Click this button <button class="btn btn-success"><i class="fa fa-save"></i></button>  at the side of the column to save the data. </span>';
     swal({
            title: "Attention!",
            button: "OK",          
            icon: "../images/warning_modal.png",
            content: span,
        })
        .then((willDelete) => {
            if (willDelete) {
                
                $.ajax({
                    url:'{{route('form-complete.jobExp')}}',
                    type:'GET',
                    success:function(data)
                    {   
                        $('#content-candidate').html(data);
                        return getJob = {no_jobExp:row_jobExp,no_jobInterest:row_jobInterest}
                    }
                })
            }
    })
}


// get data Org
function other()
{

    hover('other');
    // var val_ = [];
    // var span = document.createElement("span");
    // span.innerHTML= 'Please make sure all the columns are already filled  <br> and save the data before leaving the page. <br><br> *<span style="font-size:12px">Click this button <button class="btn btn-success"><i class="fa fa-save"></i></button>  at the side of the column to save the data. </span>';
    //  swal({
    //         title: "Attention!",
    //         button: "OK",          
    //         icon: "../images/warning_modal.png",
    //         content: span,
    //     })
    // .then((willDelete) => {
    //     if (willDelete) {
            
            $.ajax({
                url:'{{route('form-complete.other')}}',
                type:'GET',
                success:function(data)
                {	
                	$('#content-candidate').html(data);
                    $('#formAssessment').submit(function(event){
                      event.preventDefault(); //prevent default action 
                      form = $('#formAssessment').serialize();
                       $.ajax({
                          url:'{{route('form-complete.formAssessment')}}',
                          type:'POST',
                          data:form+ '&id=' + id+'&result='+result+'&process_id='+process_id ,
                          dataType: "json",
                          headers: {
                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
                          },
                        })
                         .done(function(data) {

                                if(data.result==true)
                                {
                                    swal('Success','Candidate assessment has been saved successfully','success').then(function(){                                
                                        location.reload(true)
                                    });
                                }
                                else
                                {
                                    swal('Success','Candidate assessment has been saved successfully','success').then(function(){
                                        location.reload(true);
                                    });
                                }
                            })
                            .fail(function(data) {  
                                    var dt = data.responseJSON;
                                    if(dt.errors)
                                    {
                                        swal('Error','Please complete form assessment!','error');
                                    }
                            });
                    })
                }
            })
    //     }
    // })
}



// function for add family
function addFamily()
{
	var table = $('#tableFamily');
    getFamily.no_family++;


    var body  = '<tr>'+
          '<td><input name="id_no'+getFamily.no_family+'"  type="hidden" value="'+getFamily.no_family+'">'+getFamily.no_family+'</td>'+
          '<td><input type="text" placeholder="ex : Budi " maxlength="50" class="form-control" name="name'+getFamily.no_family+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><select name="relationship'+getFamily.no_family+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropDownFamily')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='relationship"+getFamily.no_family+"']"); tp.empty();
                      tp.append("<option value=''> - Choose Relationship - </option>")
                        data.relationship.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
          body+=
          '</select></td>'+
          '<td><select name="gender'+getFamily.no_family+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropDownFamily')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='gender"+getFamily.no_family+"']"); tp.empty();
                      tp.append("<option value=> - Choose gender - </option>")
                        data.gender.forEach(function(e){
                            tp.append("<option value='"+e.nama+"'>"+e.nama+"</option>")
                        })
                        
                    }
                  })
          body+='</select></td>'+
          '<td><input type="text" placeholder="ex : Jakarta " class="form-control"  maxlength="50" name="birth_place'+getFamily.no_family+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2001-24-10" readonly class="form-control add_datepicker'+getFamily.no_family+'"  name="birth_of_date'+getFamily.no_family+'"><span class="invalid-feedback" role="alert"></span></td>'+

           '<td><select name="last_education'+getFamily.no_family+'" class="form-control">'+
             $.ajax({
                    url:'{{route('form-complete.getDropDownFamily')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='last_education"+getFamily.no_family+"']"); tp.empty();
                      tp.append("<option value=> - Choose Level - </option>")
                        data.last_education.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
         body+='</select></td>'+
               
        '<td><select name="occupation'+getFamily.no_family+'" class="form-control">'+
             $.ajax({
                    url:'{{route('form-complete.getDropDownFamily')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='occupation"+getFamily.no_family+"']"); tp.empty();
                      tp.append("<option value=> - Choose Occupaciton - </option>")
                        data.occupation.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
         body+='</select></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Family" onclick="saveFamily('+getFamily.no_family+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowFamily(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);
            var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('.add_datepicker'+getFamily.no_family+'').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            maxDate: today,
             format: 'yyyy-mm-dd'
        });
}

// function for add family
function addEmergencyContact(candidate_id)
{   
    var table = $('#tableEmergencyContact');
    getFamily.no_emergency_contact++;

    var body  = '<tr>'+
          '<td><input name="id_no'+getFamily.no_emergency_contact+'" type="hidden" value="'+getFamily.no_emergency_contact+'">'+getFamily.no_emergency_contact+'</td>'+
          '<td><input type="text" placeholder="ex : Budi " class="form-control"  maxlength="50" name="emergency_name'+getFamily.no_emergency_contact+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : Jakarta " class="form-control" name="emergency_address'+getFamily.no_emergency_contact+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><select name="emergency_relation'+getFamily.no_emergency_contact+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropDownFamily')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='emergency_relation"+getFamily.no_emergency_contact+"']"); tp.empty();
                      tp.append("<option value=> - Choose Relationship - </option>")
                        data.relationship.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                    }
                  })
          body+='</select></td>'+
          '<td><input type="text" placeholder="ex : 021-88788888 " class="form-control number_valid_char"  maxlength="15" name="emergency_phone'+getFamily.no_emergency_contact+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Family" onclick="saveEmergencyContact('+getFamily.no_emergency_contact+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowEmergencyContact(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';
        table.append(body);
           number_valid_char();
}


// function for save emergency contact
function saveEmergencyContact(no,candidate_id)
{
    var id_no = $('[name="id_no'+no+'"]').val();
    var emergency_name = $('[name="emergency_name'+no+'"]').val();
    var emergency_address = $('[name="emergency_address'+no+'"]').val();
    var emergency_relation = $('[name="emergency_relation'+no+'"]').val();
    var emergency_phone = $('[name="emergency_phone'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.saveEmergencyContact')}}',
        type:'POST',
        data:{
            id_no:id_no,
            emergency_name:emergency_name,
            emergency_address:emergency_address,
            emergency_relation:emergency_relation,
            emergency_phone:emergency_phone,
            result:result,
            id:id,
            process_id:process_id
        },
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
                refreshAlert()
                familyInfo(data.candidate_id);
                if(data.result==true)
                {
                    swal('Success','Data has been saved successfully','success').then(function(){
                        $(location).attr('href','/form-candidate/confirmation');

                    });
                }
                else
                {
                    swal('Success','Data has been saved successfully','success');
                }
            }
        })
        .fail(function(data) {
            var dt = data.responseJSON;
            console.log(dt.id_no);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no+']';
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}



// function for delete row table family
function deleteRowEmergencyContact(obj)
{
     $('#tableEmergencyContact tr:last').remove();
     getFamily.no_emergency_contact--;
     return false;
}


// function for edit form family
function editEmergencyContact(no)
{
    $('#rowEmergencyName'+no+',#rowEmergencyAddress'+no+',#rowEmergencyRelation'+no+',#rowEmergencyPhone'+no+'').removeAttr('disabled').focus();
    var emergency_contact_id = $('[name="emergency_contact_id'+no+'"]').val();
       number_valid();
       number_valid_char();

    $('#button-row-emergency'+no+'').html('<button class="btn btn-success" onclick="updateEmergencyContact('+emergency_contact_id+','+no+')"><i class="fa fa-save"></i> </button>');
}
    

// function for update emergency contact
function updateEmergencyContact(id,no)
{
    var emergency_contact_id = id;
    var rowEmergencyName = $('[name="rowEmergencyName'+no+'"]').val();
    var rowEmergencyAddress = $('[name="rowEmergencyAddress'+no+'"]').val();
    var rowEmergencyRelation = $('[name="rowEmergencyRelation'+no+'"]').val();
    var rowEmergencyPhone = $('[name="rowEmergencyPhone'+no+'"]').val();

    $.ajax({
        url:'{{route('form-complete.updateEmergencyContact')}}',
        type:'POST',
        data:{
            emergency_contact_id:emergency_contact_id,
            rowEmergencyName:rowEmergencyName,
            rowEmergencyAddress:rowEmergencyAddress,
            rowEmergencyRelation:rowEmergencyRelation,
            rowEmergencyPhone:rowEmergencyPhone,
            },
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
                swal('Success','Data has been update successfully!','success');
                familyInfo(data.candidate_id);
                refreshAlert();
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.emergency_contact_id);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.emergency_contact_id+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for delete family
function deleteEmergencyContact(emergency_contact_id)
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
            url:'form-complete/deleteEmergencyContact/'+emergency_contact_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data has been deleted successfully!','success');
                    familyInfo(get.candidate_id);
                    refreshAlert();
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}

// function for delete row table family
function deleteRowFamily(obj)
{
     $('#tableFamily tr:last').remove();
     getFamily.no_family--;
     return false;
}

// function for save family
function saveFamily(no)
{
	var id_no = $('[name="id_no'+no+'"]').val();
	var name = $('[name="name'+no+'"]').val();
	var relationship = $('[name="relationship'+no+'"]').val();
	var gender = $('[name="gender'+no+'"]').val();
	var birth_place = $('[name="birth_place'+no+'"]').val();
	var birth_of_date = $('[name="birth_of_date'+no+'"]').val();
	var last_education = $('[name="last_education'+no+'"]').val();
	var occupation = $('[name="occupation'+no+'"]').val();

	
	$.ajax({
        url:'{{route('form-complete.saveFamily')}}',
        type:'POST',
        data:{
            id_no:id_no,name:name,relationship:relationship,
        	gender:gender,birth_place:birth_place,
        	birth_of_date:birth_of_date,last_education:last_education,
            occupation:occupation,
            result:result,
            id:id,
            process_id:process_id

        },
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
                familyInfo();
                refreshAlert();
                if(data.result==true)
                {
                    swal('Success','Data has been saved successfully','success').then(function(){
                        $(location).attr('href','/form-candidate/confirmation');

                    });
                }
                else
                {
                    swal('Success','Data has been saved successfully','success');
                }
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form family
function editFamily(no)
{
	$('#rowName'+no+',#rowRelationship'+no+',#rowGender'+no+',#rowBirthPlace'+no+',#rowBirthOfDate'+no+',#rowLastEducation'+no+',#rowOccupation'+no+'').removeAttr('disabled').focus();
    var family_id = $('[name="family_id'+no+'"]').val();

    $('#rowBirthOfDate'+no+'').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
    $('#button-row'+no+'').html('<button class="btn btn-success" onclick="updateFamily('+family_id+','+no+')"><i class="fa fa-save"></i> </button>');
}
	
// function for update family
function updateFamily(id,no)
{
	var family_id = id;
    var rowName = $('[name="rowName'+no+'"]').val();
    var rowRelationship = $('[name="rowRelationship'+no+'"]').val();
    var rowGender = $('[name="rowGender'+no+'"]').val();
    var rowBirthPlace = $('[name="rowBirthPlace'+no+'"]').val();
    var rowBirthOfDate = $('[name="rowBirthOfDate'+no+'"]').val();
    var rowLastEducation = $('[name="rowLastEducation'+no+'"]').val();
    var rowOccupation = $('[name="rowOccupation'+no+'"]').val();

    $.ajax({
        url:'{{route('form-complete.updateFamily')}}',
        type:'POST',
        data:{family_id:family_id,rowName:rowName,rowRelationship:rowRelationship,
            rowGender:rowGender,rowBirthPlace:rowBirthPlace,
            rowBirthOfDate:rowBirthOfDate,rowLastEducation:rowLastEducation,
            rowOccupation:rowOccupation},
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
                swal('Success','Data has been update successfully!','success');
                familyInfo(data.candidate_id);
                refreshAlert();
            }
        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.family_id);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.family_id+']';
                console.log(input);
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for add course
function addCourse()
{
    var table = $('#tableCourse');
    no_course++;

    var body  = '<tr>'+
          '<td><input name="id_no_course'+no_course+'" type="hidden" value="'+no_course+'">'+no_course+'</td>'+
          '<td><input type="text" placeholder="ex : English " maxlength="30" class="form-control" name="course_type'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : Conversation "  maxlength="30" class="form-control" name="topic'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : LIA " class="form-control"  maxlength="50" name="institution'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2010 " maxlength="4" class="form-control number_valid_char" name="start_year'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2011" maxlength="4" class="form-control number_valid_char"  name="end_year'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Course" onclick="saveCourse('+no_course+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowCourse(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);
    number_valid();
    number_valid_char();
}

// function for delete row table course
function deleteRowCourse(obj)
{
     $('#tableCourse tr:last').remove();
     no_course--;
     return false;
}

// function for save family
function saveCourse(no)
{
    var id_no_course = $('[name="id_no_course'+no+'"]').val();
    var course_type = $('[name="course_type'+no+'"]').val();
    var topic = $('[name="topic'+no+'"]').val();
    var institution = $('[name="institution'+no+'"]').val();
    var start_year = $('[name="start_year'+no+'"]').val();
    var end_year = $('[name="end_year'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.saveCourse')}}',
        type:'POST',
        data:{id_no_course:id_no_course,course_type:course_type,topic:topic,
            institution:institution,start_year:start_year,
            end_year:end_year},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been saved successfully','success');
                courseInfo();
                refreshAlert();
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_course);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_course+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form family
function editCourse(no)
{
    $('#rowCourseType'+no+',#rowTopic'+no+',#rowInstitution'+no+',#rowStartYear'+no+',#rowEndYear'+no+'').removeAttr('disabled').focus();
    var course_info_id = $('[name="course_info_id'+no+'"]').val();
    number_valid();
    number_valid_char();
    $('#button-row'+no+'').html('<button class="btn btn-success" onclick="updateCourse('+course_info_id+','+no+')"><i class="fa fa-save"></i> </button>');
}

// function for update family
function updateCourse(id,no)
{
    var course_info_id = id;
    var rowCourseType = $('[name="rowCourseType'+no+'"]').val();
    var rowTopic = $('[name="rowTopic'+no+'"]').val();
    var rowInstitution = $('[name="rowInstitution'+no+'"]').val();
    var rowStartYear = $('[name="rowStartYear'+no+'"]').val();
    var rowEndYear = $('[name="rowEndYear'+no+'"]').val();

    $.ajax({
        url:'{{route('form-complete.updateCourse')}}',
        type:'POST',
        data:{course_info_id:course_info_id,rowCourseType:rowCourseType,rowTopic:rowTopic,
            rowInstitution:rowInstitution,rowStartYear:rowStartYear,
            rowEndYear:rowEndYear},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been updated successfully!','success');
                courseInfo();
                refreshAlert();
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.course_info_id+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for add organization
function addOrgInfo()
{
    var table = $('#tableOrgInfo');
    no_orgInfo++;

    var body  = '<tr>'+
          '<td><input name="id_no_orgInfo'+no_orgInfo+'" type="hidden" value="'+no_orgInfo+'">'+no_orgInfo+'</td>'+
          '<td><input type="text" placeholder="ex : BEM "  maxlength="30" class="form-control" name="organization'+no_orgInfo+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : Ketua BEM "  maxlength="30" class="form-control" name="position'+no_orgInfo+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2010 " class="form-control number_valid_char" maxlength="4" name="start_year'+no_orgInfo+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2011" class="form-control  number_valid_char"  maxlength="4" name="end_year'+no_orgInfo+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save OrgInfo" onclick="saveOrgInfo('+no_orgInfo+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowOrgInfo(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);
    number_valid_char()
    number_valid()
}

// function for delete row table organization
function deleteRowOrgInfo(obj)
{
     $('#tableOrgInfo tr:last').remove();
     no_orgInfo--;
     return false;
}

// function for save organization
function saveOrgInfo(no)
{
    var id_no_orgInfo = $('[name="id_no_orgInfo'+no+'"]').val();
    var organization = $('[name="organization'+no+'"]').val();
    var position = $('[name="position'+no+'"]').val();
    var start_year = $('[name="start_year'+no+'"]').val();
    var end_year = $('[name="end_year'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.saveOrgInfo')}}',
        type:'POST',
        data:{id_no_orgInfo:id_no_orgInfo,organization:organization,position:position,
            start_year:start_year,
            end_year:end_year},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been saved successfully','success');
                orgInfo();
                refreshAlert();
            }
        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_orgInfo);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_orgInfo+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form organization
function editOrgInfo(no)
{
    $('#rowOrganization'+no+',#rowPosition'+no+',#rowStartYear'+no+',#rowEndYear'+no+'').removeAttr('disabled').focus();
    var org_information_id = $('[name="org_information_id'+no+'"]').val();

    number_valid();
    number_valid_char()

    $('#button-row'+no+'').html('<button class="btn btn-success" onclick="updateOrgInfo('+org_information_id+','+no+')"><i class="fa fa-save"></i> </button>');
}

// function for update organization
function updateOrgInfo(id,no)
{
    var org_information_id = id;
    var rowOrganization = $('[name="rowOrganization'+no+'"]').val();
    var rowPosition = $('[name="rowPosition'+no+'"]').val();
    var rowStartYear = $('[name="rowStartYear'+no+'"]').val();
    var rowEndYear = $('[name="rowEndYear'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.updateOrgInfo')}}',
        type:'POST',
        data:{org_information_id:org_information_id,rowOrganization:rowOrganization,rowPosition:rowPosition,
            rowStartYear:rowStartYear,
            rowEndYear:rowEndYear},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been updated successfully!','success');
                orgInfo();
                refreshAlert();
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.org_information_id+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for add skill
function addLangSkill()
{
    getSkill.no_langSkill++;
    var table = $('#tableLangSkill');
    var body  = '<tr>'+
          '<td><input name="id_no_langSkill'+getSkill.no_langSkill+'" type="hidden" value="'+getSkill.no_langSkill+'">'+getSkill.no_langSkill+'</td>'+

            '<td><select name="language_name'+getSkill.no_langSkill+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropDownSkill')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='language_name"+getSkill.no_langSkill+"']"); tp.empty();
                      tp.append("<option value=> - Choose Skill - </option>")
                        data.language.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                    }
                  })
          body+='</select></td>'+

         '<td><select name="read_score'+getSkill.no_langSkill+'" class="form-control">'+
            +'<option value=""> - Select Score - </option>'
            +'<option value=1>1</option>'
            +'<option value=2>2</option>'
            +'<option value=3>3</option>'
            +'<option value=4>4</option>'
            +'<option value=5>5</option>'
            +'<option value=6>6</option>'
            +'<option value=7>7</option>'
            +'<option value=8>8</option>'
            +'<option value=9>9</option>'
            +'<option value=10>10</option>'
          body+='</select></td>'+         

          '<td><select name="speak_score'+getSkill.no_langSkill+'" class="form-control">'+
            +'<option value=""> - Select Score - </option>'
            +'<option value=1>1</option>'
            +'<option value=2>2</option>'
            +'<option value=3>3</option>'
            +'<option value=4>4</option>'
            +'<option value=5>5</option>'
            +'<option value=6>6</option>'
            +'<option value=7>7</option>'
            +'<option value=8>8</option>'
            +'<option value=9>9</option>'
            +'<option value=10>10</option>'
          body+='</select></td>'+

          '<td><select name="write_score'+getSkill.no_langSkill+'" class="form-control">'+
            +'<option value=""> - Select Score - </option>'
            +'<option value=1>1</option>'
            +'<option value=2>2</option>'
            +'<option value=3>3</option>'
            +'<option value=4>4</option>'
            +'<option value=5>5</option>'
            +'<option value=6>6</option>'
            +'<option value=7>7</option>'
            +'<option value=8>8</option>'
            +'<option value=9>9</option>'
            +'<option value=10>10</option>'
          body+='</select></td>'+

          '<td><select name="listen_score'+getSkill.no_langSkill+'" class="form-control">'+
            +'<option value=""> - Select Score - </option>'
            +'<option value=1>1</option>'
            +'<option value=2>2</option>'
            +'<option value=3>3</option>'
            +'<option value=4>4</option>'
            +'<option value=5>5</option>'
            +'<option value=6>6</option>'
            +'<option value=7>7</option>'
            +'<option value=8>8</option>'
            +'<option value=9>9</option>'
            +'<option value=10>10</option>'
          body+='</select></td>'+

          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save LangSkill" onclick="saveLangSkill('+getSkill.no_langSkill+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowLangSkill(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);
    number_valid_char();
    number_valid();
}

// function for delete row table skill
function deleteRowLangSkill(obj)
{
     $('#tableLangSkill tr:last').remove();
     getSkill.no_langSkill--;
     return false;
}

// function for save skill
function saveLangSkill(no)
{
    var id_no_langSkill = $('[name="id_no_langSkill'+no+'"]').val();
    var language_name = $('[name="language_name'+no+'"]').val();
    var read_score = $('[name="read_score'+no+'"]').val();
    var speak_score = $('[name="speak_score'+no+'"]').val();
    var write_score = $('[name="write_score'+no+'"]').val();
    var listen_score = $('[name="listen_score'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.saveLangSkill')}}',
        type:'POST',
        data:{id_no_langSkill:id_no_langSkill,language_name:language_name,read_score:read_score,
            speak_score:speak_score,
            write_score:write_score,listen_score:listen_score,
            result:result,
            id:id,
            process_id:process_id
        },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                langSkill();
                refreshAlert();
                if(data.result==true)
                {
                    swal('Success','Data has been saved successfully','success').then(function(){
                        $(location).attr('href','/form-candidate/confirmation');

                    });
                }
                else
                {
                    swal('Success','Data has been saved successfully','success');
                }
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_langSkill);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_langSkill+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form skill
function editLangSkill(no)
{
    $('#rowLanguageName'+no+',#rowReadScore'+no+',#rowSpeakScore'+no+',#rowWriteScore'+no+',#rowListenScore'+no+'').removeAttr('disabled').focus();
    var lang_skill_id = $('[name="lang_skill_id'+no+'"]').val();

    $('#button-row-lang'+no+'').html('<button class="btn btn-success" onclick="updateLangSkill('+lang_skill_id+','+no+')"><i class="fa fa-save"></i> </button>');
    number_valid();
    number_valid_char()
}

// function for update skill
function updateLangSkill(id,no)
{
    var lang_skill_id = id;
    var rowLanguageName = $('[name="rowLanguageName'+no+'"]').val();
    var rowReadScore = $('[name="rowReadScore'+no+'"]').val();
    var rowSpeakScore = $('[name="rowSpeakScore'+no+'"]').val();
    var rowWriteScore = $('[name="rowWriteScore'+no+'"]').val();
    var rowListenScore = $('[name="rowListenScore'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.updateLangSkill')}}',
        type:'POST',
        data:{id_no_langSkill:lang_skill_id,rowLanguageName:rowLanguageName,rowReadScore:rowReadScore,
            rowSpeakScore:rowSpeakScore,
            rowWriteScore:rowWriteScore,rowListenScore:rowListenScore},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been updated successfully!','success');
                langSkill();
                refreshAlert();
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_langSkill+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for add skill
function addSkill()
{
    getSkill.no_skill++;
    var table = $('#tableSkill');

    var body  = '<tr>'+

          '<td><input name="id_no_skill'+getSkill.no_skill+'" type="hidden" value="'+getSkill.no_skill+'">'+getSkill.no_skill+'</td>'+

          '<td><select name="skill_name'+getSkill.no_skill+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropDownSkill')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='skill_name"+getSkill.no_skill+"']"); tp.empty();
                      tp.append("<option value=> - Choose Skill - </option>")
                        data.skill.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                    }
                  })
          body+='</select></td>'+
          '<td><select name="score'+getSkill.no_skill+'" class="form-control">'+
            +'<option value=""> - Select Score - </option>'
            +'<option value=1>Low</option>'
            +'<option value=2>Medium</option>'
            +'<option value=3>High</option>'
            +'<option value=C>Enough</option>'
            +'<option value=excellent>excellent</option>'
            +'<option value=K>Less</option>'
          body+='</select></td>'+

          '<td><input type="text" placeholder="ex : Expert " class="form-control"  maxlength="50" name="skill_description'+getSkill.no_skill+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Skill" onclick="saveSkill('+getSkill.no_skill+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowSkill(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);
    number_valid_char();
    number_valid();

}

// function for delete row table skill
function deleteRowSkill(obj)
{
     $('#tableSkill tr:last').remove();
     getSkill.no_skill--;
     return false;
}

// function for save skill
function saveSkill(no)
{
    var id_no_skill = $('[name="id_no_skill'+no+'"]').val();
    var skill_name = $('[name="skill_name'+no+'"]').val();
    var score = $('[name="score'+no+'"]').val();
    var skill_description = $('[name="skill_description'+no+'"]').val();

    
    $.ajax({
        url:'{{route('form-complete.saveSkill')}}',
        type:'POST',
        data:{id_no_skill:id_no_skill,skill_name:skill_name,score:score,
            skill_description:skill_description,
            result:result,
            id:id,
            process_id:process_id
        },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                langSkill();
                refreshAlert();
                if(data.result==true)
                {
                    swal('Success','Data has been saved successfully','success').then(function(){
                        $(location).attr('href','/form-candidate/confirmation');

                    });
                }
                else
                {
                    swal('Success','Data has been saved successfully','success');
                }
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_skill);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_skill+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form skill
function editSkill(no)
{
    $('#rowSkillName'+no+',#rowScore'+no+',#rowSkillDescription'+no+'').removeAttr('disabled').focus();
    var skill_id = $('[name="skill_id'+no+'"]').val();

    $('#button-row'+no+'').html('<button class="btn btn-success" onclick="updateSkill('+skill_id+','+no+')"><i class="fa fa-save"></i> </button>');
}
    
// function for update skill
function updateSkill(id,no)
{
    var skill_id = id;
    var rowSkillName = $('[name="rowSkillName'+no+'"]').val();
    var rowScore = $('[name="rowScore'+no+'"]').val();
    var rowSkillDescription = $('[name="rowSkillDescription'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.updateSkill')}}',
        type:'POST',
        data:{skill_id:skill_id,rowSkillName:rowSkillName,rowScore:rowScore,
            rowSkillDescription:rowSkillDescription},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been updated successfully!','success');
                langSkill();
                refreshAlert();
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.skill_id+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for add family
function addEduBack()
{
    var table = $('#tableEduBack');
    no_eduBack++;
    var body  = '<tr>'+
          '<td><input name="id_no_eduBack'+no_eduBack+'" type="hidden" value="'+no_eduBack+'">'+no_eduBack+'</td>'+
           '<td><select name="edu_back_level'+no_eduBack+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropDownEducation')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='edu_back_level"+no_eduBack+"']"); tp.empty();
                      tp.append("<option value=> - Choose Level - </option>")
                        data.edu_back_level.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
          body+='</select></td>'+
    
         '<td width="20%"><div class="institution"><select name="institution'+no_eduBack+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropDownEducation')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='institution"+no_eduBack+"']"); tp.empty();
                      tp.append("<option value=''> - Choose Institution - </option>")
                        data.list_school.forEach(function(e){
                            tp.append("<option value='"+e.name+"''>"+e.name+"</option>")
                        })
                        
                    }
                  })
          body+='</select></div></td>'+
                '</div><span class="invalid-feedback" role="alert"></span></td>'+
         '<td><select name="major'+no_eduBack+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropDownEducation')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='major"+no_eduBack+"']"); tp.empty();
                      tp.append("<option value=''> - Choose Major - </option>")
                        data.major.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
          body+='</select></td>'+

          '<td><input type="text" placeholder="ex : 3.25 " maxlength="5" class="form-control number_valid" name="gpa'+no_eduBack+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : Jakarta" class="form-control" maxlength="50"  name="edu_back_city'+no_eduBack+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2001 " class="form-control number_valid_char" maxlength="4" name="start_edu_back'+no_eduBack+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2002 " class="form-control number_valid_char" maxlength="4" name="end_edu_back'+no_eduBack+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Education Background" onclick="saveEduBack('+no_eduBack+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowEduBack(this)" type="button"> <i class="fa fa-trash"></i> </button> </center> '+
          '</tr>'; 

    table.append(body);
     number_valid();
     number_valid_char();
    $('[name="institution'+no_eduBack+'"]').select2();
}

// function for delete row table family
function deleteRowEduBack(obj)
{
     $('#tableEduBack tr:last').remove();
     no_eduBack--;
     return false;
}

// function for save family
function saveEduBack(no)
{
    var id_no_eduBack = $('[name="id_no_eduBack'+no+'"]').val();
    var edu_back_level = $('[name="edu_back_level'+no+'"]').val();
    var institution = $('[name="institution'+no+'"]').val();
    var major = $('[name="major'+no+'"]').val();
    var gpa = $('[name="gpa'+no+'"]').val();
    var edu_back_city = $('[name="edu_back_city'+no+'"]').val();
    var start_edu_back = $('[name="start_edu_back'+no+'"]').val();
    var end_edu_back = $('[name="end_edu_back'+no+'"]').val();

    $.ajax({
        url:'{{route('form-complete.saveEduBack')}}',
        type:'POST',
        data:{
            id_no_eduBack:id_no_eduBack,edu_back_level:edu_back_level,institution:institution,
            major:major,gpa:gpa,
            edu_back_city:edu_back_city,start_edu_back:start_edu_back,
            end_edu_back:end_edu_back,
            result:result,
            id:id,
            process_id:process_id
        },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                eduBack();
                refreshAlert();
                if(data.result==true)
                {
                    swal('Success','Data has been saved successfully','success').then(function(){
                        $(location).attr('href','/form-candidate/confirmation');

                    });
                }
                else
                {
                    swal('Success','Data has been saved successfully','success');
                }
            }

        })
        .fail(function(data) { 
            var dt = data.responseJSON;
            console.log(dt.id_no_eduBack);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_eduBack+']';
                
                //// $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form family
function editEduBack(no)
{
    $('#rowEduBackLevel'+no+',#rowInstitution'+no+',#rowMajor'+no+',#rowGpa'+no+',#rowEduBackCity'+no+',#rowStartEduBack'+no+',#rowEndEduBack'+no+'').removeAttr('disabled').focus();
    var edu_back_id = $('[name="edu_back_id'+no+'"]').val();
    number_valid();
    number_valid_char();

    $("#rowInstitution"+no+"").select2();
    $('#rowBirthOfDate'+no+'').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
    $('#button-row'+no+'').html('<button class="btn btn-success" onclick="updateEduBack('+edu_back_id+','+no+')"><i class="fa fa-save"></i> </button>');
}
    
// function for update family
function updateEduBack(id,no)
{
    var id_no_eduBack = id;
    var rowEduBackLevel = $('[name="rowEduBackLevel'+no+'"]').val();
    var rowInstitution = $('[name="rowInstitution'+no+'"]').val();
    var rowMajor = $('[name="rowMajor'+no+'"]').val();
    var rowGpa = $('[name="rowGpa'+no+'"]').val();
    var rowEduBackCity = $('[name="rowEduBackCity'+no+'"]').val();
    var rowStartEduBack = $('[name="rowStartEduBack'+no+'"]').val();
    var rowEndEduBack = $('[name="rowEndEduBack'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.updateEduBack')}}',
        type:'POST',
        data:{id_no_eduBack:id_no_eduBack,rowEduBackLevel:rowEduBackLevel,rowInstitution:rowInstitution,
            rowMajor:rowMajor,rowGpa:rowGpa,
            rowEduBackCity:rowEduBackCity,rowStartEduBack:rowStartEduBack,
            rowEndEduBack:rowEndEduBack},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been update successfully!','success');
                eduBack();
                refreshAlert();
            }
        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_eduBack);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_eduBack+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for add JOb Experience
function addJobInterest(candidate_id)
{
    var table = $('#tableJobInterest');
    getJob.no_jobInterest++;

    var body  = '<tr>'+
          '<td><input name="id_no_JobInterest'+getJob.no_jobInterest+'" type="hidden" value="'+getJob.no_jobInterest+'">'+getJob.no_jobInterest+'</td>'+
          '<td><input type="text" placeholder="ex : PHP PROGRAMMER "  maxlength="30" class="form-control" name="type_of_work'+getJob.no_jobInterest+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 1 " class="form-control number_valid_char" maxlength="2" name="sort'+getJob.no_jobInterest+'"><span class="invalid-feedback" role="alert"></span></td>'+
         
          '<td width="12%"> <center> <button class="btn btn-success" type="button"  title="Save Job Experience" onclick="saveJobInterest('+getJob.no_jobInterest+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowJobInterest(this)" type="button"> <i class="fa fa-trash"></i> </button></center>'+
          '</tr>';
    table.append(body);
    number_valid_char();
    number_valid();
}


// function for delete row table job experience
function deleteRowJobInterest(obj)
{
     $('#tableJobInterest tr:last').remove();
     getJob.no_jobInterest--;
     return false;
}

// function for save table job Interest
function saveJobInterest(no,candidate_id)
{
    var id_no_JobInterest = $('[name="id_no_JobInterest'+no+'"]').val();
    var type_of_work = $('[name="type_of_work'+no+'"]').val();
    var sort = $('[name="sort'+no+'"]').val();

    $.ajax({
        url:'{{route('form-complete.saveJobInterest')}}',
        type:'POST',
        data:{
            id_no_JobInterest:id_no_JobInterest,
            type_of_work:type_of_work,
            sort:sort,
            candidate_id:candidate_id
        },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been saved successfully','success');
                jobExp(data.candidate_id);
                refreshAlert();
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.job_exp_id);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_JobInterest+']';                
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for update table job interest
function updateJobInterest(id,no)
{
    var id_no_JobInterest = id;
    var rowTypeOfWork = $('[name="rowTypeOfWork'+no+'"]').val();
    var rowSort = $('[name="rowSort'+no+'"]').val();
    $.ajax({
        url:'{{route('form-complete.updateJobInterest')}}',
        type:'POST',
        data:{id_no_JobInterest:id_no_JobInterest,rowTypeOfWork:rowTypeOfWork,rowSort:rowSort,
            },
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been update successfully!','success');
                jobExp(data.candidate_id);
                refreshAlert();
            }
        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_JobInterest);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_JobInterest+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for add family
function addJobExp()
{
    var table = $('#tableJobExp');
    getJob.no_jobExp++;

    var body  = '<tr>'+
          '<td><input name="id_no_JobExp'+getJob.no_jobExp+'" type="hidden" value="'+getJob.no_jobExp+'">'+getJob.no_jobExp+'</td>'+
          '<td><input type="text" placeholder="ex : PT SUBUR LEGOWO "  maxlength="50" class="form-control" name="company_name'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : MANAGER " class="form-control"  maxlength="50" name="position_exp'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : CAKUNG " class="form-control"  name="company_address'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+

            '<td><select name="terminated_reason'+getJob.no_jobExp+'" class="form-control">'+
          $.ajax({
                    url:'{{route('form-complete.getDropJob')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='terminated_reason"+getJob.no_jobExp+"']"); tp.empty();
                      tp.append("<option value=''> - Choose Reason - </option>")
                        data.reason.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>");
                        })
                        
                    }
                  })
          body+='</select></td>'+

          '<td><input type="text" placeholder="ex : 2002 " maxlength="4" class="form-control number_valid_char" name="start_job_exp'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2004 "  maxlength="4" class="form-control number_valid_char" name="end_job_exp'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+  
          '<td><input type="text" placeholder="ex : - " class="form-control"  maxlength="50" name="job_exp_desc'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"> <center> <button class="btn btn-success" type="button"  title="Save Job Experience" onclick="saveJobExp('+getJob.no_jobExp+')"> <i class="fa fa-save"></i> </button>  <button class="btn btn-danger" onclick="deleteRowJobExp(this)" type="button"> <i class="fa fa-trash"></i> </button></center>'+
          '</tr>';

    table.append(body);
    number_valid_char();
    number_valid();

}

// function for delete row table family
function deleteRowJobExp(obj)
{
     $('#tableJobExp tr:last').remove();
     getJob.no_jobExp--;
     return false;
}

// function for save family
function saveJobExp(no)
{
    var id_no_JobExp = $('[name="id_no_JobExp'+no+'"]').val();
    var company_name = $('[name="company_name'+no+'"]').val();
    var position_exp = $('[name="position_exp'+no+'"]').val();
    var company_address = $('[name="company_address'+no+'"]').val();
    var terminated_reason = $('[name="terminated_reason'+no+'"]').val();
    var start_job_exp = $('[name="start_job_exp'+no+'"]').val();
    var end_job_exp = $('[name="end_job_exp'+no+'"]').val();
    var job_exp_desc = $('[name="job_exp_desc'+no+'"]').val();

    $.ajax({
        url:'{{route('form-complete.saveJobExp')}}',
        type:'POST',
        data:{id_no_JobExp:id_no_JobExp,company_name:company_name,position_exp:position_exp,
            company_address:company_address,terminated_reason:terminated_reason,
            start_job_exp:start_job_exp,end_job_exp:end_job_exp,
            job_exp_desc:job_exp_desc},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been saved successfully','success');
                jobExp();
                refreshAlert();
            }
        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.job_exp_id);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_JobExp+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form family
function editJobExp(no)
{
    $('#rowCompanyName'+no+',#rowPositionExp'+no+',#rowCompanyAddress'+no+',#rowTerminatedReason'+no+',#rowStartJobExp'+no+',#rowEndJobExp'+no+',#rowJobExpDesc'+no+'').removeAttr('disabled').focus();
    var job_exp_id = $('[name="job_exp_id'+no+'"]').val();

    $('#rowBirthOfDate'+no+'').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
    $('#button-row'+no+'').html('<button class="btn btn-success" onclick="updateJobExp('+job_exp_id+','+no+')"><i class="fa fa-save"></i> </button>');
    number_valid();
    number_valid_char()

}

// function for edit form  job experience
function editJobInterest(no)
{
    $('#rowTypeOfWork'+no+',#rowSort'+no+'').removeAttr('disabled').focus();
    var job_interest_id = $('[name="job_interest_id'+no+'"]').val();

    $('#button-row-interest'+no+'').html('<button class="btn btn-success" onclick="updateJobInterest('+job_interest_id+','+no+')"><i class="fa fa-save"></i> </button>');
    number_valid();
    number_valid_char()
}

// function for update family
function updateJobExp(id,no)
{
    var id_no_JobExp = id;
    var rowCompanyName = $('[name="rowCompanyName'+no+'"]').val();
    var rowPositionExp = $('[name="rowPositionExp'+no+'"]').val();
    var rowCompanyAddress = $('[name="rowCompanyAddress'+no+'"]').val();
    var rowTerminatedReason = $('[name="rowTerminatedReason'+no+'"]').val();
    var rowStartJobExp = $('[name="rowStartJobExp'+no+'"]').val();
    var rowEndJobExp = $('[name="rowEndJobExp'+no+'"]').val();
    var rowJobExpDesc = $('[name="rowJobExpDesc'+no+'"]').val();
    
    $.ajax({
        url:'{{route('form-complete.updateJobExp')}}',
        type:'POST',
        data:{id_no_JobExp:id_no_JobExp,rowCompanyName:rowCompanyName,rowPositionExp:rowPositionExp,
            rowCompanyAddress:rowCompanyAddress,rowTerminatedReason:rowTerminatedReason,
            rowStartJobExp:rowStartJobExp,rowEndJobExp:rowEndJobExp,
            rowJobExpDesc:rowJobExpDesc},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Data has been update successfully!','success');
                jobExp(data.candidate_id);
                refreshAlert();
            }
        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_JobExp);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_JobExp+']';
                
                //$(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for delete family
function deleteFamily(family_id)
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
            url:'form-complete/deleteFamily/'+family_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data  has been deleted successfully!','success');
                    familyInfo();
                    refreshAlert();
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}

// function for delete Course
function deleteCourse(course_info_id)
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
            url:'form-complete/deleteCourse/'+course_info_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data  has been deleted successfully!','success');
                    courseInfo();
                    refreshAlert();
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}


// function for delete Language Skill 

function deleteLangSkill(lang_skill_id)
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
            url:'form-complete/deleteLangSkill/'+lang_skill_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data  has been deleted successfully!','success');
                    langSkill();
                    refreshAlert();
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}

// function for delete Language Skill 
function deleteSkill(Skill_id)
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
            url:'form-complete/deleteSkill/'+Skill_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data   has been deleted successfully!','success');
                    langSkill();
                    refreshAlert();
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}

// function for delete Language Skill 
function deleteOrganization(org_information_id)
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
            url:'form-complete/deleteOrganization/'+org_information_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data has been deleted successfully!','success');
                    orgInfo();
                    refreshAlert();
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}

// function for delete Education Background
function deleteEduBack(edu_back_id)
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
            url:'form-complete/deleteEduBack/'+edu_back_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data  has been deleted successfully!','success');
                    eduBack();
                    refreshAlert();
                }
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}

// function for delete Education Background
function deleteJobExp(job_exp_id)
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
            url:'form-complete/deleteJobExp/'+job_exp_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data  has been deleted successfully!','success');
                    jobExp();
                    refreshAlert();
                }
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}

// function for delete JOb Interest
function deleteJobInterest (job_interest_id)
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
            url:'form-complete/deleteJobInterest/'+job_interest_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data has been deleted successfully!','success');
                    jobExp(get.candidate_id);
                    refreshAlert();
                }
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
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



</script>