<div class="col-12" style="">
  <div class="row">
    <h4 class="font-20"> JOB EXPERIENCE </h4>
  </div>
  <div class="row mt-3">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addJobExp()"> <i class="fa fa-plus"></i> ADD JOB EXPERIENCE </button></label>
    <div class="table-responsive">
    <table style="font-size:12px" id="tableJobExp" class="table table-bordered table-striped mdl-data-table">
      <thead>
          <tr align="center" style="font-weight:bold">
            <th>NO</th>
            <th>COMPANY NAME</th>
            <th>POSITION</th>
            <th>COMPANY ADDRESS</th>
            <th>REASON OF TERMINATION</th>
            <th>START</th>
            <th>END</th>
            <th>DESCRIPTION</th>
            <th>ACTION</th>
          </tr>
      </thead>
      <tbody>
        @php $no=1; @endphp
        @foreach($jobExp as $job)
          <tr>
            <td>{{$no}}</td>
            <td>
              <input type="hidden" name="job_exp_id{{$job->job_exp_id}}" value="{{$job->job_exp_id}}">
              <input type="text" name="rowCompanyName{{$job->job_exp_id}}"  maxlength="50"  id="rowCompanyName{{$job->job_exp_id}}" class="form-control" value="{{$job->company_name}}" disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
                <input type="text" name="rowPositionExp{{$job->job_exp_id}}"  maxlength="50" id="rowPositionExp{{$job->job_exp_id}}" class="form-control" value="{{$job->position_exp}}"  disabled>
                  <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowCompanyAddress{{$job->job_exp_id}}" id="rowCompanyAddress{{$job->job_exp_id}}" class="form-control" value="{{$job->company_address}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <select name="rowTerminatedReason{{$job->job_exp_id}}" id="rowTerminatedReason{{$job->job_exp_id}}" class="form-control" disabled>
                  @foreach($resign_cause as $rc)
                      <option value="{{$rc->name}}" {{($rc->name == $job->terminated_reason) ? 'selected':''}}>{{$rc->name}}</option>
                  @endforeach
                </select>

                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowStartJobExp{{$job->job_exp_id}}"  maxlength="4" id="rowStartJobExp{{$job->job_exp_id}}" class="form-control number_valid_char" value="{{$job->start_job_exp}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowEndJobExp{{$job->job_exp_id}}"  maxlength="4" id="rowEndJobExp{{$job->job_exp_id}}" class="form-control number_valid_char" value="{{$job->end_job_exp}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowJobExpDesc{{$job->job_exp_id}}" maxlength="50" id="rowJobExpDesc{{$job->job_exp_id}}" class="form-control" value="{{$job->job_exp_desc}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td width="15%"> <center id="button-row{{$job->job_exp_id}}"><button class="btn btn-primary" onclick="editJobExp('{{$job->job_exp_id}}')"><i class="fa fa-edit"></i></button>   <button class="btn btn-danger" onclick="deleteJobExp('{{$job->job_exp_id}}')"><i class="fa fa-trash"></i></button></center> </td>
          </tr>
        @php $no++; @endphp
        @endforeach
      </tbody>

    </table>
  </div>
  </div>
  
</div><!-- CARD BOTTOM --->


<div class="col-12" style="">
  <div class="row">
    <h4 class="font-18"> JOB INTEREST </h4>
  </div>
  <div class="row mt-3">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addJobInterest()"> <i class="fa fa-plus"></i> ADD JOB INTEREST  </button></label>
    <div class="table-responsive">
    <table style="font-size:12px" id="tableJobInterest" class="table table-bordered table-striped mdl-data-table">
      <thead>
          <tr align="center" style="font-weight:bold">
            <th>NO</th>
            <th>TYPE Of WORK</th>
            <th>SORTING</th>
            <th>ACTION</th>
          </tr>
      </thead>
      <tbody>
        @php $no=1; @endphp
        @foreach($jobInterest as $jobInt)
          <tr>
            <td>{{$no}}</td>
            <td>
              <input type="hidden" name="job_interest_id{{$jobInt->job_interest_id}}" value="{{$jobInt->job_interest_id}}">
              <input type="text" name="rowTypeOfWork{{$jobInt->job_interest_id}}"   maxlength="30" id="rowTypeOfWork{{$jobInt->job_interest_id}}" class="form-control" value="{{$jobInt->type_of_work}}" disabled>
                <span class="invalid-feedback" role="alert"></span>

            </td>
            <td>
              <input type="text" name="rowSort{{$jobInt->job_interest_id}}"  maxlength="2"  id="rowSort{{$jobInt->job_interest_id}}" class="form-control number_valid" value="{{$jobInt->sort}}" disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            
            <td width="15%"> <center id="button-row-interest{{$jobInt->job_interest_id}}"><button class="btn btn-primary" onclick="editJobInterest('{{$jobInt->job_interest_id}}')"><i class="fa fa-edit"></i></button>   <button class="btn btn-danger" onclick="deleteJobInterest('{{$jobInt->job_interest_id}}')"><i class="fa fa-trash"></i></button></center> </td>
          </tr>
        @php $no++; @endphp
        @endforeach
      </tbody>

    </table>
  </div>
  </div>
  
</div><!-- CARD BOTTOM --->



<script type="text/javascript">
    var row_jobExp = {{count($jobExp)}};  
    var row_jobInterest = {{count($jobInterest)}};  

</script>


