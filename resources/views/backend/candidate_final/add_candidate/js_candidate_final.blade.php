<script type="text/javascript">
// var no_fam = 0;

var status =  '{{ (empty($_GET['status']))  ? "" : $_GET['status'] }}'; 
var q =  '{{ (empty($_GET['q']))  ? "" : $_GET['q']  }}' ; 
var tot =  '{{ (empty($_GET['tot']))  ? "" : $_GET['tot'] }}' ; 
var type =  '{{ (empty($_GET['type']))  ? "" : $_GET['type'] }}' ; 

$(document).ready(function(){
    personalInfo(candidate_id);
	datepicker();
})
function hoverAdmin(param)
{
    if(param == "familyInfo" )
    {
        $("#familyInfoAdmin").addClass('active_card');
        $("#eduBackAdmin").removeClass('active_card');
        $("#jobExpAdmin").removeClass('active_card');
        $("#otherAdmin").removeClass('active_card');
        $("#langSkillAdmin").removeClass('active_card');
        $("#orgInfoAdmin").removeClass('active_card');
        $("#personalInfoAdmin").removeClass('active_card');
        $("#courseInfoAdmin").removeClass('active_card');
    }
    else if(param == "eduBack")
    {
        $("#eduBackAdmin").addClass('active_card');
        $("#familyInfoAdmin").removeClass('active_card');
        $("#jobExpAdmin").removeClass('active_card');
        $("#otherAdmin").removeClass('active_card');
        $("#langSkillAdmin").removeClass('active_card');
        $("#orgInfoAdmin").removeClass('active_card');
        $("#personalInfoAdmin").removeClass('active_card');
        $("#courseInfoAdmin").removeClass('active_card');

    }
    else if(param == "jobExp")
    {
        $("#jobExpAdmin").addClass('active_card');
        $("#eduBackAdmin").removeClass('active_card');
        $("#familyInfoAdmin").removeClass('active_card');
        $("#otherAdmin").removeClass('active_card');
        $("#langSkillAdmin").removeClass('active_card');
        $("#orgInfoAdmin").removeClass('active_card');
        $("#personalInfoAdmin").removeClass('active_card');
        $("#courseInfoAdmin").removeClass('active_card');

    }
    else if(param == "other")
    {
        $("#otherAdmin").addClass('active_card');
        $("#eduBackAdmin").removeClass('active_card');
        $("#familyInfoAdmin").removeClass('active_card');
        $("#jobExpAdmin").removeClass('active_card');
        $("#langSkillAdmin").removeClass('active_card');
        $("#orgInfoAdmin").removeClass('active_card');
        $("#personalInfoAdmin").removeClass('active_card');
        $("#courseInfoAdmin").removeClass('active_card');

    }
    else if(param == "langSkill")
    {
        $("#langSkillAdmin").addClass('active_card');
        $("#eduBackAdmin").removeClass('active_card');
        $("#familyInfoAdmin").removeClass('active_card');
        $("#jobExpAdmin").removeClass('active_card');
        $("#otherAdmin").removeClass('active_card');
        $("#orgInfoAdmin").removeClass('active_card');
        $("#personalInfoAdmin").removeClass('active_card');
        $("#courseInfoAdmin").removeClass('active_card');

    }

    else if(param == "orgInfo")
    {
        $("#orgInfoAdmin").addClass('active_card');
        $("#eduBackAdmin").removeClass('active_card');
        $("#familyInfoAdmin").removeClass('active_card');
        $("#jobExpAdmin").removeClass('active_card');
        $("#otherAdmin").removeClass('active_card');
        $("#langSkillAdmin").removeClass('active_card');
        $("#personalInfoAdmin").removeClass('active_card');
        $("#courseInfoAdmin").removeClass('active_card');

    }

    else if(param == "personalInfo")
    {
        $("#personalInfoAdmin").addClass('active_card');
        $("#eduBackAdmin").removeClass('active_card');
        $("#familyInfoAdmin").removeClass('active_card');
        $("#jobExpAdmin").removeClass('active_card');
        $("#otherAdmin").removeClass('active_card');
        $("#langSkillAdmin").removeClass('active_card');
        $("#orgInfoAdmin").removeClass('active_card');
        $("#courseInfoAdmin").removeClass('active_card');
    }

    else if(param == "courseInfo")
    {
        $("#courseInfoAdmin").addClass('active_card');
        $("#eduBackAdmin").removeClass('active_card');
        $("#familyInfoAdmin").removeClass('active_card');
        $("#jobExpAdmin").removeClass('active_card');
        $("#otherAdmin").removeClass('active_card');
        $("#langSkillAdmin").removeClass('active_card');
        $("#orgInfoAdmin").removeClass('active_card');
        $("#personalInfoAdmin").removeClass('active_card');
    }
}


//function for update candidate
function saveCandidate()
{   
     swal({
      title: "Are you sure?",
      text: "Save this data ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            var dataFile =  new FormData($("#form-candidate-edit")[0]);
            if($('[name="job"]').val() == "")
            {
                swal('Error','The job field is required','error');
                $('[name="job"]').focus();
                return false;
            }else if($('[name="city"]').val() == "")
            {
                swal('Error','The city field is required','error');
                $('[name="city"]').focus();
                return false;
            }
            $.ajax({
                url:'{{route('candidate-final-add.save_candidate')}}',
                dataType: "json",
                data: dataFile,
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                cache:false,
                contentType:false,
                processData:false,
            })
             .done(function(data) {
             	   swal('Success','Data has been update successfully!','success');
                    $(location).attr('href','/rec-process/view_all?status=Registered&q=all_registered&tot=1&search_q='+$('[name="name_holder"]').val()+'&type=view-all');    
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
}

// get data family

var no_family;
var no_emergency_contact; 
var getFamily = {};

function familyInfo(id)
{

  hoverAdmin('familyInfo');
	$.ajax({
        url:'/candidate-final-add/familyInfo/',
        type:'GET',
        success:function(data)
        {	
        	$('#content-candidate').html(data);
        	datepicker();

            return  getFamily = {no_family:row_family,no_emergency_contact:row_emergency_contact};

        }
    })
}

// get data personal info
function personalInfo(id)
{

  hoverAdmin('personalInfo');
	$.ajax({
        url:'/candidate-final-add/personalInfo/',
        type:'GET',
        success:function(data)
        {	
        	$('#content-candidate').html(data);
            $('#link_').attr('href','rec-process/view_all?status='+status+'&q='+q+'&tot='+tot+'&type='+type+'');
            number_valid();
            number_valid_char();
            $('.date_of_birth').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
            $('[name="edu_university"]').select2();
            $('[name="city"]').select2();
            $('[name="job"]').select2();
            
        }
    })
}

var no_course; 

// get data course
function courseInfo(id)
{
    hoverAdmin('courseInfo');
    $.ajax({
        url:'/candidate-final-add/courseInfo/',
        type:'GET',
        success:function(data)
        {   
            $('#content-candidate').html(data);
            return no_course = row_courseInfo
        }
    })
}

var no_orgInfo; 

// get data Org
function orgInfo(id)
{
    hoverAdmin('orgInfo');
    $.ajax({
        url:'/candidate-final-add/orgInfo/',
        type:'GET',
        success:function(data)
        {   
            $('#content-candidate').html(data);
            return no_orgInfo = row_orgInfo
        }
    })
}


var no_langSkill; 
var no_skill; 
var getSkill = {};

// get data Org
function langSkill(id)
{
    hoverAdmin('langSkill');
    $.ajax({
        url:'/candidate-final-add/langSkill/',
        type:'GET',
        async:false,
        success:function(data)
        {   
            $('#content-candidate').html(data);
            return  getSkill = {no_skill:row_skill,no_langSkill:row_langSkill};

        }
    })
       
}


var no_eduBack; 

// get data Org
function eduBack(id)
{
    hoverAdmin('eduBack');
    $.ajax({
        url:'/candidate-final-add/eduBack/',
        type:'GET',
        success:function(data)
        {   
            $('#content-candidate').html(data);
            return no_eduBack = row_eduBack
        }
    })
}


var no_jobExp; 
var no_jobInterest; 
var getJob = {}; 

// get data Org
function jobExp(id)
{
    hoverAdmin('jobExp');
    $.ajax({
        url:'/candidate-final-add/jobExp/',
        type:'GET',
        success:function(data)
        {   
            $('#content-candidate').html(data);
            return getJob = {no_jobExp:row_jobExp,no_jobInterest:row_jobInterest}
        }
    })
}


// get data Org
function other(id)
{
  hoverAdmin('other');
	$.ajax({
        url:'/candidate-final-add/other/',
        type:'GET',
        success:function(data)
        {	
        	$('#content-candidate').html(data);
        }
    })
}



// function for add family
function addFamily(candidate_id)
{   

    var table = $('#tableFamily');
    getFamily.no_family++;


    var body  = '<tr>'+
          '<td><input name="id_no'+getFamily.no_family+'"  type="hidden" value="'+getFamily.no_family+'">'+getFamily.no_family+'</td>'+
          '<td><input type="text" placeholder="ex : Budi " maxlength="50" class="form-control" name="name'+getFamily.no_family+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><select name="relationship'+getFamily.no_family+'" class="form-control">'+
          $.ajax({
                    url:'{{route('candidate-final-add.getDropDownFamily')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='relationship"+getFamily.no_family+"']"); tp.empty();
                      tp.append("<option value=> - Choose Relationship - </option>")
                        data.relationship.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
          body+=
          '</select></td>'+
          '<td><select name="gender'+getFamily.no_family+'" class="form-control">'+
          $.ajax({
                    url:'{{route('candidate-final-add.getDropDownFamily')}}',
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
                    url:'{{route('candidate-final-add.getDropDownFamily')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='last_education"+getFamily.no_family+"']"); tp.empty();
                      tp.append("<option value=> - Choose Occupaciton - </option>")
                        data.last_education.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
         body+='</select></td>'+
         '<td><select name="occupation'+getFamily.no_family+'" class="form-control">'+
             $.ajax({
                    url:'{{route('candidate-final-add.getDropDownFamily')}}',
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
    
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Family" onclick="saveFamily('+getFamily.no_family+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowFamily(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
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
                    url:'{{route('candidate-final-add.getDropDownFamily')}}',
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
          '<td><input type="text" placeholder="ex : 021-88788888 " class="form-control number_valid_char" maxlength="15"  name="emergency_phone'+getFamily.no_emergency_contact+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Family" onclick="saveEmergencyContact('+getFamily.no_emergency_contact+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowEmergencyContact(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';
        table.append(body);
           number_valid();
           number_valid_char();


}

// function for delete row table family
function deleteRowFamily(obj)
{
     $('#tableFamily tr:last').remove();
     getFamily.no_family--;
     return false;
}


// function for delete row table family
function deleteRowEmergencyContact(obj)
{
     $('#tableEmergencyContact tr:last').remove();
     getFamily.no_emergency_contact--;
     return false;
}

// function for save family
function saveFamily(no,candidate_id)
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
        url:'{{route('candidate-final-add.saveFamily')}}',
        type:'POST',
        data:{id_no:id_no,name:name,relationship:relationship,
            gender:gender,birth_place:birth_place,
            birth_of_date:birth_of_date,last_education:last_education,
            occupation:occupation,candidate_id:candidate_id},
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
                swal('Success','Family has been saved successfully!','success');
                familyInfo(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
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
        url:'{{route('candidate-final-add.saveEmergencyContact')}}',
        type:'POST',
        data:{
            id_no:id_no,
            emergency_name:emergency_name,
            emergency_address:emergency_address,
        	emergency_relation:emergency_relation,
            emergency_phone:emergency_phone,
            candidate_id:candidate_id
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
                swal('Success','Family has been saved successfully!','success');
                familyInfo(data.candidate_id);
            }
        })
        .fail(function(data) {
            var dt = data.responseJSON;
            console.log(dt.id_no);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no+']';
                // $(input + '+span').html('<strong>'+ value +'</strong>');
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

// function for edit form family
function editEmergencyContact(no)
{
	$('#rowEmergencyName'+no+',#rowEmergencyAddress'+no+',#rowEmergencyRelation'+no+',#rowEmergencyPhone'+no+'').removeAttr('disabled').focus();
    var emergency_contact_id = $('[name="emergency_contact_id'+no+'"]').val();
       number_valid();
       number_valid_char();

    $('#button-row-emergency'+no+'').html('<button class="btn btn-success" onclick="updateEmergencyContact('+emergency_contact_id+','+no+')"><i class="fa fa-save"></i> </button>');
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
        url:'{{route('candidate-final-add.updateFamily')}}',
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
                swal('Success','Family has been update successfully!','success');
                familyInfo(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.family_id);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.family_id+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
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
        url:'{{route('candidate-final-add.updateEmergencyContact')}}',
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
                swal('Success','Family has been update successfully!','success');
                familyInfo(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.emergency_contact_id);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.emergency_contact_id+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for add course
function addCourse(candidate_id)
{
    var table = $('#tableCourse');
    no_course++;

    var body  = '<tr>'+
          '<td><input name="id_no_course'+no_course+'" type="hidden" value="'+no_course+'">'+no_course+'</td>'+
          '<td><input type="text" placeholder="ex : English "  maxlength="30" class="form-control"  name="course_type'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : Conversation "  maxlength="30"  class="form-control" name="topic'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : LIA " class="form-control"  maxlength="50" name="institution'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2010 " maxlength="4" class="form-control number_valid_char" name="start_year'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2011" maxlength="4" class="form-control number_valid_char"  name="end_year'+no_course+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Course" onclick="saveCourse('+no_course+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowCourse(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);
    number_valid();
    number_valid_char();

}

// function for delete row table course
function deleteRowCourse(obj)
{
     $('#tableCourse tr:last').remove();
     no_course--
     return false;
}


// function for save family
function saveCourse(no,candidate_id)
{
    var id_no_course = $('[name="id_no_course'+no+'"]').val();
    var course_type = $('[name="course_type'+no+'"]').val();
    var topic = $('[name="topic'+no+'"]').val();
    var institution = $('[name="institution'+no+'"]').val();
    var start_year = $('[name="start_year'+no+'"]').val();
    var end_year = $('[name="end_year'+no+'"]').val();
    
    $.ajax({
        url:'{{route('candidate-final-add.saveCourse')}}',
        type:'POST',
        data:{id_no_course:id_no_course,course_type:course_type,topic:topic,
            institution:institution,start_year:start_year,
            end_year:end_year,candidate_id:candidate_id},
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
                swal('Success','Course has been saved successfully!','success');
                courseInfo(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_course);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_course+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
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
        url:'{{route('candidate-final-add.updateCourse')}}',
        type:'POST',
        data:{course_info_id:course_info_id,rowCourseType:rowCourseType,rowTopic:rowTopic,
            rowInstitution:rowInstitution,rowStartYear:rowStartYear,
            rowEndYear:rowEndYear},
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
                swal('Success','Course has been updated successfully!','success');
                courseInfo(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.course_info_id+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}


// function for add organization
function addOrgInfo(candidate_id)
{
    var table = $('#tableOrgInfo');
    no_orgInfo++;

    var body  = '<tr>'+
          '<td><input name="id_no_orgInfo'+no_orgInfo+'" type="hidden" value="'+no_orgInfo+'">'+no_orgInfo+'</td>'+
          '<td><input type="text" placeholder="ex : BEM "  maxlength="30" class="form-control" name="organization'+no_orgInfo+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : Ketua BEM "  maxlength="30"  class="form-control" name="position'+no_orgInfo+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2010 " class="form-control number_valid_char" maxlength="4" name="start_year'+no_orgInfo+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2011" class="form-control number_valid_char"  maxlength="4" name="end_year'+no_orgInfo+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save OrgInfo" onclick="saveOrgInfo('+no_orgInfo+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowOrgInfo(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);
    number_valid();
    number_valid_char();

}

// function for delete row table organization
function deleteRowOrgInfo(obj)
{
     $('#tableOrgInfo tr:last').remove();
     no_orgInfo--;
     return false;
}


// function for save organization
function saveOrgInfo(no,candidate_id)
{
    var id_no_orgInfo = $('[name="id_no_orgInfo'+no+'"]').val();
    var organization = $('[name="organization'+no+'"]').val();
    var position = $('[name="position'+no+'"]').val();
    var start_year = $('[name="start_year'+no+'"]').val();
    var end_year = $('[name="end_year'+no+'"]').val();
    
    $.ajax({
        url:'{{route('candidate-final-add.saveOrgInfo')}}',
        type:'POST',
        data:{id_no_orgInfo:id_no_orgInfo,organization:organization,position:position,
            start_year:start_year,
            end_year:end_year,candidate_id:candidate_id},
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
                swal('Success','Organization has been saved successfully!','success');
                orgInfo(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_orgInfo);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_orgInfo+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
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
    number_valid_char();


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
        url:'{{route('candidate-final-add.updateOrgInfo')}}',
        type:'POST',
        data:{org_information_id:org_information_id,rowOrganization:rowOrganization,rowPosition:rowPosition,
            rowStartYear:rowStartYear,
            rowEndYear:rowEndYear},
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
                swal('Success','Organization has been updated successfully!','success');
                orgInfo(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.org_information_id+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}




// function for add skill
function addLangSkill(candidate_id)
{
    getSkill.no_langSkill++;
    

    var table = $('#tableLangSkill');

    var body  = '<tr>'+
          '<td><input name="id_no_langSkill'+getSkill.no_langSkill+'" type="hidden" value="'+getSkill.no_langSkill+'">'+getSkill.no_langSkill+'</td>'+
          '<td><select name="language_name'+getSkill.no_langSkill+'" class="form-control">'+
              $.ajax({
                    url:'{{route('candidate-final-add.getDropDownSkill')}}',
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
            '<option value=0>0</option>'
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
            '<option value=0>0</option>'
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
            '<option value=0>0</option>'
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
            '<option value=0>0</option>'
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
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save LangSkill" onclick="saveLangSkill('+getSkill.no_langSkill+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowLangSkill(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);

    number_valid();
    number_valid_char();


}

// function for delete row table skill
function deleteRowLangSkill(obj)
{
     $('#tableLangSkill tr:last').remove();
     getSkill.no_langSkill--;
     return false;
}


// function for save skill
function saveLangSkill(no,candidate_id)
{
    var id_no_langSkill = $('[name="id_no_langSkill'+no+'"]').val();
    var language_name = $('[name="language_name'+no+'"]').val();
    var read_score = $('[name="read_score'+no+'"]').val();
    var speak_score = $('[name="speak_score'+no+'"]').val();
    var write_score = $('[name="write_score'+no+'"]').val();
    var listen_score = $('[name="listen_score'+no+'"]').val();
    
    $.ajax({
        url:'{{route('candidate-final-add.saveLangSkill')}}',
        type:'POST',
        data:{id_no_langSkill:id_no_langSkill,language_name:language_name,read_score:read_score,
            speak_score:speak_score,
            write_score:write_score,listen_score:listen_score,candidate_id:candidate_id},
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
                swal('Success','Language skill has been saved successfully!','success');
                langSkill(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_langSkill);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_langSkill+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
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

    number_valid();
    number_valid_char();

    $('#button-row-lang'+no+'').html('<button class="btn btn-success" onclick="updateLangSkill('+lang_skill_id+','+no+')"><i class="fa fa-save"></i> </button>');
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
        url:'{{route('candidate-final-add.updateLangSkill')}}',
        type:'POST',
        data:{id_no_langSkill:lang_skill_id,rowLanguageName:rowLanguageName,rowReadScore:rowReadScore,
            rowSpeakScore:rowSpeakScore,
            rowWriteScore:rowWriteScore,rowListenScore:rowListenScore},
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
                swal('Success','Language skill has been updated successfully!','success');
                langSkill(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_langSkill+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}





// function for add skill
function addSkill(candidate_id)
{
    getSkill.no_skill++;
    var table = $('#tableSkill');
    


    var body  = '<tr>'+
          '<td><input name="id_no_skill'+getSkill.no_skill+'" type="hidden" value="'+getSkill.no_skill+'">'+getSkill.no_skill+'</td>'+
        
          '<td><select name="skill_name'+getSkill.no_skill+'" class="form-control">'+
          $.ajax({
                    url:'{{route('candidate-final-add.getDropDownSkill')}}',
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
            '<option value=0>0</option>'
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
          '<td><input type="text" placeholder="ex : Expert " class="form-control" maxlength="50" name="skill_description'+getSkill.no_skill+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Skill" onclick="saveSkill('+getSkill.no_skill+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowSkill(this)" type="button"> <i class="fa fa-trash"></i> </button></center> '+
          '</tr>';

    table.append(body);
    number_valid();
    number_valid_char();

}

// function for delete row table skill
function deleteRowSkill(obj)
{
     $('#tableSkill tr:last').remove();
     getSkill.no_skill--;
     return false;
}


// function for save skill
function saveSkill(no,candidate_id)
{
    var id_no_skill = $('[name="id_no_skill'+no+'"]').val();
    var skill_name = $('[name="skill_name'+no+'"]').val();
    var score = $('[name="score'+no+'"]').val();
    var skill_description = $('[name="skill_description'+no+'"]').val();

    
    $.ajax({
        url:'{{route('candidate-final-add.saveSkill')}}',
        type:'POST',
        data:{id_no_skill:id_no_skill,skill_name:skill_name,score:score,
            skill_description:skill_description,candidate_id:candidate_id},
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
                swal('Success','Skill has been saved successfully!','success');
                langSkill(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_skill);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_skill+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
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

    number_valid();
    number_valid_char();

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
        url:'{{route('candidate-final-add.updateSkill')}}',
        type:'POST',
        data:{skill_id:skill_id,rowSkillName:rowSkillName,rowScore:rowScore,
            rowSkillDescription:rowSkillDescription},
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
                swal('Success','Skill has been updated successfully!','success');
                langSkill(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.skill_id+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}



// function for add education
function addEduBack(candidate_id)
{
    var table = $('#tableEduBack');
    no_eduBack++;

    var body  = '<tr>'+
          '<td><input name="id_no_eduBack'+no_eduBack+'" type="hidden" value="'+no_eduBack+'">'+no_eduBack+'</td>'+
           '<td><select name="edu_back_level'+no_eduBack+'" class="form-control">'+
          $.ajax({
                    url:'{{route('candidate-final-add.getDropDownEducation')}}',
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


         '<td width="20%"><select name="institution'+no_eduBack+'" class="form-control">'+
          $.ajax({
                    url:'{{route('candidate-final-add.getDropDownEducation')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='institution"+no_eduBack+"']"); tp.empty();
                      tp.append("<option value=''> - Choose Level - </option>")
                        data.list_school.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
          body+='</select></td>'+


            '<td><select name="major'+no_eduBack+'" class="form-control">'+
             $.ajax({
                    url:'{{route('candidate-final-add.getDropDownEducation')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='major"+no_eduBack+"']"); tp.empty();
                      tp.append("<option value=''> - Choose Level - </option>")
                        data.major.forEach(function(e){
                            tp.append("<option value='"+e.name+"''>"+e.name+"</option>")
                        })
                        
                    }
                  })
            body+='</select></td>'+

          '<td><input type="text" placeholder="ex : 3.25 " maxlength="5" class="form-control number_valid" name="gpa'+no_eduBack+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : Jakarta" class="form-control"  name="edu_back_city'+no_eduBack+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2001 " class="form-control number_valid_char" maxlength="4" name="start_edu_back'+no_eduBack+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2002 " class="form-control number_valid_char" maxlength="4" name="end_edu_back'+no_eduBack+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"><center>  <button class="btn btn-success" type="button"  title="Save Education Background" onclick="saveEduBack('+no_eduBack+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowEduBack(this)" type="button"> <i class="fa fa-trash"></i> </button> </center> '+
          '</tr>'; 

    table.append(body);
    number_valid();
    number_valid_char();

    $('[name="institution'+no_eduBack+'"]').select2();
}

// function for delete row table education
function deleteRowEduBack(obj)
{
     $('#tableEduBack tr:last').remove();
     no_eduBack--;
     return false;
}

// function for save education
function saveEduBack(no,candidate_id)
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
        url:'{{route('candidate-final-add.saveEduBack')}}',
        type:'POST',
        data:{id_no_eduBack:id_no_eduBack,edu_back_level:edu_back_level,institution:institution,
            major:major,gpa:gpa,
            edu_back_city:edu_back_city,start_edu_back:start_edu_back,
            end_edu_back:end_edu_back,candidate_id,candidate_id},
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
                swal('Success','Education Background has been saved successfully!','success');
                eduBack(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_eduBack);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_eduBack+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form education
function editEduBack(no)
{
    $('#rowEduBackLevel'+no+',#rowInstitution'+no+',#rowMajor'+no+',#rowGpa'+no+',#rowEduBackCity'+no+',#rowStartEduBack'+no+',#rowEndEduBack'+no+'').removeAttr('disabled').focus();
    var edu_back_id = $('[name="edu_back_id'+no+'"]').val();

    $('#rowBirthOfDate'+no+'').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
    number_valid();
    number_valid_char();
    $("#rowInstitution"+no+"").select2();



    $('#button-row'+no+'').html('<button class="btn btn-success" onclick="updateEduBack('+edu_back_id+','+no+')"><i class="fa fa-save"></i> </button>');
}
    
// function for update education
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
        url:'{{route('candidate-final-add.updateEduBack')}}',
        type:'POST',
         data:{id_no_eduBack:id_no_eduBack,rowEduBackLevel:rowEduBackLevel,rowInstitution:rowInstitution,
            rowMajor:rowMajor,rowGpa:rowGpa,
            rowEduBackCity:rowEduBackCity,rowStartEduBack:rowStartEduBack,
            rowEndEduBack:rowEndEduBack},
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
                swal('Success','Education Background has been update successfully!','success');
                eduBack(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_eduBack);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_eduBack+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}



// function for add JOb Experience
function addJobExp(candidate_id)
{
    
    var table = $('#tableJobExp');
    getJob.no_jobExp++;

    var body  = '<tr>'+
          '<td><input name="id_no_JobExp'+getJob.no_jobExp+'" type="hidden" value="'+getJob.no_jobExp+'">'+getJob.no_jobExp+'</td>'+
          '<td><input type="text" placeholder="ex : PT SUBUR LEGOWO "   maxlength="50" class="form-control" name="company_name'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : MANAGER " class="form-control"  maxlength="50"  name="position_exp'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : CAKUNG " class="form-control" name="company_address'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><select name="terminated_reason'+getJob.no_jobExp+'" class="form-control">'+
          $.ajax({
                    url:'{{route('candidate-final-add.getDropJob')}}',
                    type:'POST',
                     headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success:function(data){
                      var tp = $("[name='terminated_reason"+getJob.no_jobExp+"']"); tp.empty();
                      tp.append("<option value=''> - Choose Reason - </option>")
                        data.reason.forEach(function(e){
                            tp.append("<option value='"+e.name+"'>"+e.name+"</option>")
                        })
                        
                    }
                  })
          body+='</select></td>'+
          '<td><input type="text" placeholder="ex : 2002 " maxlength="4" class="form-control number_valid_char" name="start_job_exp'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 2004 "  maxlength="4" class="form-control number_valid_char'+getJob.no_jobExp+'" name="end_job_exp'+getJob.no_jobExp+'"><span class="invalid-feedback" role="alert"></span></td>'+  
          '<td><input type="text" placeholder="ex : - " class="form-control" name="job_exp_desc"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td width="12%"> <center> <button class="btn btn-success" type="button"  title="Save Job Experience" onclick="saveJobExp('+getJob.no_jobExp+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowJobExp(this)" type="button"> <i class="fa fa-trash"></i> </button></center>'+
          '</tr>';

    table.append(body);
    number_valid();
    number_valid_char();


}

// function for add JOb Experience
function addJobInterest(candidate_id)
{
    
    var table = $('#tableJobInterest');
    getJob.no_jobInterest++;

    var body  = '<tr>'+
          '<td><input name="id_no_JobInterest'+getJob.no_jobInterest+'" type="hidden" value="'+getJob.no_jobInterest+'">'+getJob.no_jobInterest+'</td>'+
          '<td><input type="text" placeholder="ex : PHP PROGRAMMER " maxlength="30" class="form-control" name="type_of_work'+getJob.no_jobInterest+'"><span class="invalid-feedback" role="alert"></span></td>'+
          '<td><input type="text" placeholder="ex : 1 " class="form-control number_valid_char" maxlength="2" name="sort'+getJob.no_jobInterest+'"><span class="invalid-feedback" role="alert"></span></td>'+
         
          '<td width="12%"> <center> <button class="btn btn-success" type="button"  title="Save Job Experience" onclick="saveJobInterest('+getJob.no_jobInterest+','+candidate_id+')"> <i class="fa fa-save"></i> </button> | <button class="btn btn-danger" onclick="deleteRowJobInterest(this)" type="button"> <i class="fa fa-trash"></i> </button></center>'+
          '</tr>';

    table.append(body);
    number_valid();
    number_valid_char();
}

// function for delete row table job experience
function deleteRowJobExp(obj)
{
     $('#tableJobExp tr:last').remove();
     getJob.no_jobExp--;
     return false;
}


// function for delete row table job experience
function deleteRowJobInterest(obj)
{
     $('#tableJobInterest tr:last').remove();
     getJob.no_jobInterest--;
     return false;
}

// function for save table job experience
function saveJobExp(no,candidate_id)
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
        url:'{{route('candidate-final-add.saveJobExp')}}',
        type:'POST',
        data:{id_no_JobExp:id_no_JobExp,company_name:company_name,position_exp:position_exp,
            company_address:company_address,terminated_reason:terminated_reason,
            start_job_exp:start_job_exp,end_job_exp:end_job_exp,
            job_exp_desc:job_exp_desc,candidate_id:candidate_id},
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
                swal('Success','Job Experience has been saved successfully!','success');
                jobExp(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.job_exp_id);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_JobExp+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for save table job Interest
function saveJobInterest(no,candidate_id)
{
    var id_no_JobInterest = $('[name="id_no_JobInterest'+no+'"]').val();
    var type_of_work = $('[name="type_of_work'+no+'"]').val();
    var sort = $('[name="sort'+no+'"]').val();

    
    $.ajax({
        url:'{{route('candidate-final-add.saveJobInterest')}}',
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
        success:function(data)
        {   
            
        }
    })
     .done(function(data) {
            if(data.status == 'success')
            {
                swal('Success','Job Experience has been saved successfully!','success');
                jobExp(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.job_exp_id);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_JobInterest+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
                $(input).addClass('is-invalid');
                $(input).focus();
                $(input).change(function(){
                    $(input).removeClass('is-invalid');
                })
            });
        });
}

// function for edit form  job experience
function editJobExp(no)
{
    $('#rowCompanyName'+no+',#rowPositionExp'+no+',#rowCompanyAddress'+no+',#rowTerminatedReason'+no+',#rowStartJobExp'+no+',#rowEndJobExp'+no+',#rowJobExpDesc'+no+'').removeAttr('disabled').focus();
    var job_exp_id = $('[name="job_exp_id'+no+'"]').val();

    $('#rowBirthOfDate'+no+'').datepicker({uiLibrary: 'bootstrap4', format: 'yyyy-mm-dd'});
    $('#button-row'+no+'').html('<button class="btn btn-success" onclick="updateJobExp('+job_exp_id+','+no+')"><i class="fa fa-save"></i> </button>');
    number_valid();
    number_valid_char();
}


// function for edit form  job experience
function editJobInterest(no)
{
    $('#rowTypeOfWork'+no+',#rowSort'+no+'').removeAttr('disabled').focus();
    var job_interest_id = $('[name="job_interest_id'+no+'"]').val();

    $('#button-row-interest'+no+'').html('<button class="btn btn-success" onclick="updateJobInterest('+job_interest_id+','+no+')"><i class="fa fa-save"></i> </button>');
    number_valid();
    number_valid_char();
}


    
// function for update table job experience
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
        url:'{{route('candidate-final-add.updateJobExp')}}',
        type:'POST',
        data:{id_no_JobExp:id_no_JobExp,rowCompanyName:rowCompanyName,rowPositionExp:rowPositionExp,
            rowCompanyAddress:rowCompanyAddress,rowTerminatedReason:rowTerminatedReason,
            rowStartJobExp:rowStartJobExp,rowEndJobExp:rowEndJobExp,
            rowJobExpDesc:rowJobExpDesc},
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
                swal('Success','Job Experience has been update successfully!','success');
                jobExp(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_JobExp);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_JobExp+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
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
        url:'{{route('candidate-final-add.updateJobInterest')}}',
        type:'POST',
        data:{id_no_JobInterest:id_no_JobInterest,rowTypeOfWork:rowTypeOfWork,rowSort:rowSort,
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
                swal('Success','Job Experience has been update successfully!','success');
                jobExp(data.candidate_id);
            }

        })
        .fail(function(data) {
            
            var dt = data.responseJSON;
            console.log(dt.id_no_JobInterest);
            $.each(dt.errors, function (key, value) {
                var input = '[name=' + key + ''+dt.id_no_JobInterest+']';
                
                // $(input + '+span').html('<strong>'+ value +'</strong>');
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
            url:'deleteFamily/'+family_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data family has been deleted successfully!','success');
                    familyInfo(get.candidate_id);
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
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
            url:'deleteEmergencyContact/'+emergency_contact_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data emergency contact has been deleted successfully!','success');
                    familyInfo(get.candidate_id);
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
            url:'deleteCourse/'+course_info_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data Course has been deleted successfully!','success');
                    courseInfo(get.candidate_id);
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
            url:'deleteLangSkill/'+lang_skill_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data Language skill has been deleted successfully!','success');
                    langSkill(get.candidate_id);
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
            url:'deleteSkill/'+Skill_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data  Skill has been deleted successfully!','success');
                    langSkill(get.candidate_id);
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
            url:'deleteOrganization/'+org_information_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data Organization has been deleted successfully!','success');
                    orgInfo(get.candidate_id);
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
            url:'deleteEduBack/'+edu_back_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data Organization has been deleted successfully!','success');
                    eduBack(get.candidate_id);
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}


// function for delete job experience
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
            url:'deleteJobExp/'+job_exp_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data Organization has been deleted successfully!','success');
                    jobExp(get.candidate_id);
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
            url:'deleteJobInterest/'+job_interest_id,
            dataType:'JSON',
            type:'DELETE',
            headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success:function(get){
                if(get.status=='success')
                {
                    swal('Success','Data Organization has been deleted successfully!','success');
                    jobExp(get.candidate_id);
                }
               
            },
              error: function (xhr, ajaxOptions, thrownError) {
                    swal("error!", thrownError, "error");
              },
        })
      } 
    });
}



//this function for change file photo profile 
function changePhoto(input) 
{   
 
  var dataFile =  new FormData($("#form-candidate-edit")[0]);
  $.ajax({

        url: "{{route('candidate-final-add.changePhoto')}}", 
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

        url: "{{route('candidate-final-add.changeCV')}}", 
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