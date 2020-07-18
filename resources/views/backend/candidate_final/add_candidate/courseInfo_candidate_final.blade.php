<div class="col-12" style="">
  <div class="row">
    <h4>Course Information</h4>
  </div>
  <div class="row">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addCourse('{{$candidate_id}}')"> <i class="fa fa-plus"></i> Add Course </button></label>
    <table style="font-size:12px" id="tableCourse" class="table table-bordered table-striped mdl-data-table">
      <thead>
          <tr align="center" style="font-weight:bold">
            <th>NO</th>
            <th>COURSE TYPE</th>
            <th>TOPIC</th>
            <th>INSTITUTION</th>
            <th>START YEAR</th>
            <th>END YEAR</th>
            <th>ACTION</th>
          </tr>
      </thead>
      <tbody>
        @php $no=1; @endphp
        @foreach($courseInfo as $course)
          <tr>
            <td>{{$no}}</td>
            <td>
              <input type="hidden" name="course_info_id{{$course->course_info_id}}" value="{{$course->course_info_id}}">
              <input type="text" name="rowCourseType{{$course->course_info_id}}"  maxlength="30" id="rowCourseType{{$course->course_info_id}}" class="form-control" value="{{$course->course_type}}" disabled>
                  <span class="invalid-feedback" role="alert"></span>

            </td>
            <td>
                <input type="text" name="rowTopic{{$course->course_info_id}}"   maxlength="30" id="rowTopic{{$course->course_info_id}}" class="form-control" value="{{$course->topic}}"  disabled>
                    <span class="invalid-feedback" role="alert"></span>

            </td>
            <td>
              <input type="text" name="rowInstitution{{$course->course_info_id}}"  maxlength="50" id="rowInstitution{{$course->course_info_id}}" class="form-control" value="{{$course->institution}}"  disabled>
                  <span class="invalid-feedback" role="alert"></span>

            </td>
            <td>
              <input type="text" name="rowStartYear{{$course->course_info_id}}" maxlength="4" id="rowStartYear{{$course->course_info_id}}" class="form-control number_valid" value="{{$course->start_year}}"  disabled>
                  <span class="invalid-feedback" role="alert"></span>

            </td>
            <td>
              <input type="text" name="rowEndYear{{$course->course_info_id}}" maxlength="4" id="rowEndYear{{$course->course_info_id}}" class="form-control number_valid" value="{{$course->end_year}}"  disabled>
                  <span class="invalid-feedback" role="alert"></span>

            </td>
          
            <td width="15%"> <center id="button-row{{$course->course_info_id}}"><button class="btn btn-primary" onclick="editCourse('{{$course->course_info_id}}')"><i class="fa fa-edit"></i></button>  |   <button class="btn btn-danger" onclick="deleteCourse('{{$course->course_info_id}}')"><i class="fa fa-trash"></i></button></center> </td>
          </tr>
        @php $no++; @endphp
        @endforeach
      </tbody>

    </table>
  </div>
  
</div><!-- CARD BOTTOM --->
<script type="text/javascript">
    var row_courseInfo = {{count($courseInfo)}};  
</script>


