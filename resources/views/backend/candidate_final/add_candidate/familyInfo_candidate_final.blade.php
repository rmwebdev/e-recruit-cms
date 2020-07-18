<div class="col-12" style="">
  <div class="row">
    <h4>Family Information</h4>
  </div>
  <div class="row">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addFamily()"> <i class="fa fa-plus"></i> Add Family </button></label>
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

      </tbody>

    </table>
  </div>  
</div><!-- CARD BOTTOM --->

<div class="col-12" style="">
  <div class="row">
    <h4>Emergency Contact</h4>
  </div>
  <div class="row">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addEmergencyContact()"> <i class="fa fa-plus"></i> Add Emergency Contact </button></label>
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
        
      </tbody>

    </table>
  </div>  
</div><!-- CARD BOTTOM --->


<script type="text/javascript">
    var row_family  = 0;  
    var row_emergency_contact= 0; 

</script>


