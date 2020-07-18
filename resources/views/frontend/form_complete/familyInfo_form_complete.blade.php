<div class="col-12" style="">
  <div class="row">
    <h4 class="font-20"> FAMILY INFORMATION </h4>
  </div>
  <div class="row mt-3">
    <label cass="control-label"> <button class="btn btn-primary" type="button" onclick="addFamily()"> <i class="fa fa-plus"></i> ADD FAMILY </button></label>
    <div class="table-responsive">
    <table style="font-size:12px" id="tableFamily" class="table table-bordered table-striped mdl-data-table">
      <thead>
          <tr align="center" style="font-weight:bold">
            <th>NO</th>
            <th>NAME</th>
            <th>RELATIONSHIP</th>
            <th>GENDER</th>
            <th>BIRTH PLACE</th>
            <th>BIRTH OF DATE</th>
            <th>LAST EDUCATION</th>
            <th>OCCUPATION</th>
            <th>ACTION</th>
          </tr>
      </thead>
      <tbody>
        @php $no=1; @endphp
        @foreach($family as $fam)
          <tr>
            <td>{{$no}}</td>
            <td>
              <input type="hidden" name="family_id{{$fam->family_id}}" value="{{$fam->family_id}}">
              <input type="text" name="rowName{{$fam->family_id}}"  maxlength="50" id="rowName{{$fam->family_id}}" class="form-control" value="{{$fam->name}}" disabled>
              <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
                <select name="rowRelationship{{$fam->family_id}}" id="rowRelationship{{$fam->family_id}}" class="form-control" disabled>
                  @foreach($relationship as $rel)
                      <option value="{{$rel->name}}" {{($rel->name == $fam->relationship) ? 'selected':''}}>{{$rel->name}}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
               <select name="rowGender{{$fam->family_id}}" id="rowGender{{$fam->family_id}}" class="form-control" disabled>
                  @foreach($gender as $gen)
                      <option value="{{$gen->nama}}" {{($gen->nama == $fam->gender) ? 'selected':''}}>{{$gen->nama}}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowBirthPlace{{$fam->family_id}}"  maxlength="50" id="rowBirthPlace{{$fam->family_id}}" class="form-control" value="{{$fam->birth_place}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowBirthOfDate{{$fam->family_id}}"  id="rowBirthOfDate{{$fam->family_id}}" class="form-control" value="{{$fam->birth_of_date}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>

            <td>
               <select name="rowLastEducation{{$fam->family_id}}" id="rowLastEducation{{$fam->family_id}}" class="form-control" disabled>
                  @foreach($education as $edu)
                      <option value="{{$edu->name}}" {{($edu->name == $fam->last_education) ? 'selected':''}}>{{$edu->name}}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" role="alert"></span>
            </td>

            <td>
               <select name="rowOccupation{{$fam->family_id}}" id="rowOccupation{{$fam->family_id}}" class="form-control" disabled>
                  @foreach($occupation as $occ)
                      <option value="{{$occ->name}}" {{($occ->name == $fam->occupation) ? 'selected':''}}>{{$occ->name}}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" role="alert"></span>
            </td>

            <td width="15%"> <center id="button-row{{$fam->family_id}}"><button class="btn btn-primary" onclick="editFamily('{{$fam->family_id}}')"><i class="fa fa-edit"></i></button>  <button class="btn btn-danger" onclick="deleteFamily('{{$fam->family_id}}')"><i class="fa fa-trash"></i></button></center> </td>
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
    <h4 class="font-18"> EMERGENCY CONTACT</h4>
  </div>
  <div class="row mt-3">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addEmergencyContact()"> <i class="fa fa-plus"></i> ADD EMERGENCY CONTACT </button></label>
    <div class="table-responsive">
    <table style="font-size:12px" id="tableEmergencyContact" class="table table-bordered table-striped mdl-data-table">
      <thead>
          <tr align="center" style="font-weight:bold">
            <th>NO</th>
            <th>EMERGENCY NAME</th>
            <th>EMERGENCY ADDRESS</th>
            <th>EMERGENCY RELATION</th>
            <th>EMERGENCY PHONE</th>
            <th>ACTION</th>
          </tr>
      </thead>
      <tbody>
        @php $no=1; @endphp
        @foreach($emergency_contact as $emergency_cont)
          <tr>
            <td>{{$no}}</td>
            <td>
              <input type="hidden" name="emergency_contact_id{{$emergency_cont->emergency_contact_id}}" value="{{$emergency_cont->emergency_contact_id}}">
              <input type="text" name="rowEmergencyName{{$emergency_cont->emergency_contact_id}}"  maxlength="50" id="rowEmergencyName{{$emergency_cont->emergency_contact_id}}" class="form-control" value="{{$emergency_cont->emergency_name}}" disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
       
          
            <td>
              <input type="text" name="rowEmergencyAddress{{$emergency_cont->emergency_contact_id}}" id="rowEmergencyAddress{{$emergency_cont->emergency_contact_id}}" class="form-control" value="{{$emergency_cont->emergency_address}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
                <select name="rowEmergencyRelation{{$emergency_cont->emergency_contact_id}}" id="rowEmergencyRelation{{$emergency_cont->emergency_contact_id}}" class="form-control" disabled>
                  @foreach($relationship as $rela)
                      <option value="{{$rela->name}}" {{($rela->name == $emergency_cont->emergency_relation) ? 'selected':''}}>{{$rela->name}}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" role="alert"></span>
            </td>
     
            <td>
              <input type="text" name="rowEmergencyPhone{{$emergency_cont->emergency_contact_id}}"  maxlength="15" id="rowEmergencyPhone{{$emergency_cont->emergency_contact_id}}" class="form-control number_valid_char" value="{{$emergency_cont->emergency_phone}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td width="15%"> <center id="button-row-emergency{{$emergency_cont->emergency_contact_id}}"><button class="btn btn-primary" onclick="editEmergencyContact('{{$emergency_cont->emergency_contact_id}}')"><i class="fa fa-edit"></i></button>  <button class="btn btn-danger" onclick="deleteEmergencyContact('{{$emergency_cont->emergency_contact_id}}')"><i class="fa fa-trash"></i></button></center> </td>
          </tr>
        @php $no++; @endphp
        @endforeach
      </tbody>
    </table>
    <div>
  </div>  
</div><!-- CARD BOTTOM --->

<script type="text/javascript">
    var row_family = {{count($family)}};  
    var row_emergency_contact= {{count($emergency_contact)}};  

</script>


