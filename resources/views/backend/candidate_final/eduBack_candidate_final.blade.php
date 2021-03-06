<div class="container mt-3" id="candidate_form"  style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <div class="col-12" style="">
                  <div class="row">
                    <h4>Education Background</h4>
                </div>
                <div class="row">
                  <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addEduBack('{{$candidate_id}}')"> <i class="fa fa-plus"></i> Add Education Background </button></label>
                  <table style="font-size:12px" id="tableEduBack" class="table table-bordered table-striped mdl-data-table">
                    <thead>
                        <tr align="center" style="font-weight:bold">
                          <th>NO</th>
                          <th>EDUCATION LEVEL</th>
                          <th>INSTITUTION</th>
                          <th>MAJOR</th>
                          <th>NEM / IPK / GPA</th>
                          <th>CITY</th>
                          <th>START YEAR</th>
                          <th>END YEAR</th>
                          <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php $no=1; @endphp
                      @foreach($eduBack as $edu)
                        <tr>
                          <td>{{$no}}</td>
                          <td>
                            <input type="hidden" name="edu_back_id{{$edu->edu_back_id}}" value="{{$edu->edu_back_id}}">
                              <select name="rowEduBackLevel{{$edu->edu_back_id}}" id="rowEduBackLevel{{$edu->edu_back_id}}" class="form-control" disabled>
                                @foreach($edu_back_level as $education)
                                    <option value="{{$education->name}}" {{($education->name == $edu->edu_back_level) ? 'selected':''}}>{{$education->name}}</option>
                                @endforeach
                              </select>
                              <span class="invalid-feedback" role="alert"></span>
                          </td>
                          <td width="20%">
                            <select name="rowInstitution{{$edu->edu_back_id}}" id="rowInstitution{{$edu->edu_back_id}}" class="form-control" disabled>
                                @foreach($list_school as $school)
                                    <option value="{{$school->name}}" {{(trim($school->name) == trim($edu->institution)) ? 'selected':''}}>{{$school->name}}</option>
                                @endforeach
                              </select>
                              <span class="invalid-feedback" role="alert"></span>
                          </td>
                          <td>
                              <select name="rowMajor{{$edu->edu_back_id}}" id="rowMajor{{$edu->edu_back_id}}" class="form-control" disabled>
                                @foreach($major as $mj)
                                  <option value="{{$mj->name}}" {{( trim($mj->name) == trim($edu->major) ) ? 'selected':''}}>{{$mj->name}}</option>
                                @endforeach
                              </select>
                              <span class="invalid-feedback" role="alert"></span>

                          </td>
                          <td>
                            <input type="text" name="rowGpa{{$edu->edu_back_id}}" maxlength="5" id="rowGpa{{$edu->edu_back_id}}" class="form-control number_valid" value="{{$edu->gpa}}"  disabled>
                              <span class="invalid-feedback" role="alert"></span>

                          </td>
                          <td>
                            <input type="text" name="rowEduBackCity{{$edu->edu_back_id}}" id="rowEduBackCity{{$edu->edu_back_id}}" class="form-control" value="{{$edu->edu_back_city}}"  disabled>
                              <span class="invalid-feedback" role="alert"></span>

                          </td>
                          <td>
                            <input type="text" name="rowStartEduBack{{$edu->edu_back_id}}" maxlength="4" id="rowStartEduBack{{$edu->edu_back_id}}" class="form-control number_valid" value="{{$edu->start_edu_back}}"  disabled>
                              <span class="invalid-feedback" role="alert"></span>

                          </td>
                          <td>
                            <input type="text" name="rowEndEduBack{{$edu->edu_back_id}}" maxlength="4" id="rowEndEduBack{{$edu->edu_back_id}}" class="form-control  number_valid" value="{{$edu->end_edu_back}}"  disabled>
                              <span class="invalid-feedback" role="alert"></span>

                          </td>
                          <td width="15%"> <center id="button-row{{$edu->edu_back_id}}"><button class="btn btn-primary" onclick="editEduBack('{{$edu->edu_back_id}}')"><i class="fa fa-edit"></i></button>  |   <button class="btn btn-danger" onclick="deleteEduBack('{{$edu->edu_back_id}}')"><i class="fa fa-trash"></i></button></center> </td>
                        </tr>
                      @php $no++; @endphp
                      @endforeach
                    </tbody>

                  </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    var row_eduBack = {{count($eduBack)}};  

</script>


