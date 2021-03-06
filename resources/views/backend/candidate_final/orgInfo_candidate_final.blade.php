<div class="container mt-3" id="candidate_form"  style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12" style="">
                    <div class="row">
                      <h4> Organization Information</h4>
                    </div>
                    <div class="row">
                        <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addOrgInfo('{{$candidate_id}}')"> <i class="fa fa-plus"></i> Add Organization </button></label>
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
                                  <input type="text" name="rowOrganization{{$org->org_information_id}}"  maxlength="30"  id="rowOrganization{{$org->org_information_id}}" class="form-control" value="{{$org->organization}}" disabled>
                                    <span class="invalid-feedback" role="alert"></span>
                                </td>
                                <td>
                                    <input type="text" name="rowPosition{{$org->org_information_id}}"   maxlength="30" id="rowPosition{{$org->org_information_id}}" class="form-control" value="{{$org->position}}"  disabled>
                                      <span class="invalid-feedback" role="alert"></span>
                                </td>
                                <td>
                                  <input type="text" name="rowStartYear{{$org->org_information_id}}" maxlength="4" id="rowStartYear{{$org->org_information_id}}" class="form-control number_valid" value="{{$org->start_year}}"  disabled>
                                    <span class="invalid-feedback" role="alert"></span>
                                </td>
                                <td>
                                  <input type="text" name="rowEndYear{{$org->org_information_id}}" maxlength="4" id="rowEndYear{{$org->org_information_id}}" class="form-control number_valid" value="{{$org->end_year}}"  disabled>
                                    <span class="invalid-feedback" role="alert"></span>
                                </td>
                              
                                <td> <center id="button-row{{$org->org_information_id}}"><button class="btn btn-primary" onclick="editOrgInfo('{{$org->org_information_id}}')"><i class="fa fa-edit"></i></button>  |  <button class="btn btn-danger" onclick="deleteOrganization('{{$org->org_information_id}}')"><i class="fa fa-trash"></i></button> </center> </td>
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


<script type="text/javascript">
    var row_orgInfo = {{count($orgInfo)}};  
</script>


