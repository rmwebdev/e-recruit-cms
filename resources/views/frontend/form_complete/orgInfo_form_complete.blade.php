<div class="col-12" style="">
  <div class="row">
    <h4 class="font-20"> ORGANIZATION INFORMATION </h4>
  </div>
  <div class="row mt-3">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addOrgInfo()"> <i class="fa fa-plus"></i> ADD ORGANIZATION </button></label>
    <div class="table-responsive">
    <table style="font-size:12px" id="tableOrgInfo" class="table table-bordered table-striped mdl-data-table">
      <thead>
          <tr align="center" style="font-weight:bold">
            <th>NO</th>
            <th>ORGANIZATION</th>
            <th>POSITION</th>
            <th>START YEAR</th>
            <th>END YEAR</th>
            <th>ACTION</th>
          </tr>
      </thead>
      <tbody>
        @php $no=1; @endphp
        @foreach($orgInfo as $org)
          <tr>
            <td>{{$no}}</td>
            <td>
              <input type="hidden" name="org_information_id{{$org->org_information_id}}" value="{{$org->org_information_id}}">
              <input type="text" name="rowOrganization{{$org->org_information_id}}" maxlength="30" id="rowOrganization{{$org->org_information_id}}" class="form-control" value="{{$org->organization}}" disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
                <input type="text" name="rowPosition{{$org->org_information_id}}"  maxlength="30"  id="rowPosition{{$org->org_information_id}}" class="form-control" value="{{$org->position}}"  disabled>
                  <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowStartYear{{$org->org_information_id}}" maxlength="4" id="rowStartYear{{$org->org_information_id}}" class="form-control number_valid_char" value="{{$org->start_year}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowEndYear{{$org->org_information_id}}" maxlength="4" id="rowEndYear{{$org->org_information_id}}" class="form-control number_valid_char" value="{{$org->end_year}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
          
            <td  width="15%"> <center id="button-row{{$org->org_information_id}}"><button class="btn btn-primary" onclick="editOrgInfo('{{$org->org_information_id}}')"><i class="fa fa-edit"></i></button>   <button class="btn btn-danger" onclick="deleteOrganization('{{$org->org_information_id}}')"><i class="fa fa-trash"></i></button> </center> </td>
          </tr>
        @php $no++; @endphp
        @endforeach
      </tbody>

    </table>
  </div>
  </div>
  
</div><!-- CARD BOTTOM --->
<script type="text/javascript">
    var row_orgInfo = {{count($orgInfo)}};  
</script>


