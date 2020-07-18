<div class="col-12" style="">
  <div class="row">
    <h4>  Skill</h4>
  </div>
  <div class="row">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addSkill('{{$candidate_id}}')"> <i class="fa fa-plus"></i> Add Skill </button></label>
    <table style="font-size:12px" id="tableSkill" class="table table-bordered table-striped mdl-data-table">
      <thead>
          <tr align="center" style="font-weight:bold">
            <th>NO</th>
            <th>SKILL NAME</th>
            <th>SCORE</th>
            <th>SKILL DESCRIPTION</th>
            <th>ACTION</th>
          </tr>
      </thead>
      <tbody>
        @php $no=1; @endphp
        @foreach($skill as $sk)
          <tr>
            <td>{{$no}}</td>
            <td>
              <input type="hidden" name="skill_id{{$sk->skill_id}}" value="{{$sk->skill_id}}">
              <select name="rowSkillName{{$sk->skill_id}}" id="rowSkillName{{$sk->skill_id}}" class="form-control" disabled>
                  @foreach($list_skill as $ls)
                      <option value="{{$ls->name}}" {{($ls->name == $sk->skill_name) ? 'selected':''}}>{{$ls->name}}</option>
                  @endforeach
                </select>
            
              <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
                <select name="rowScore{{$sk->skill_id}}" class="form-control" id="rowScore{{$sk->skill_id}}" disabled>
                  @for($i= 0;$i<=10;$i++)
                      <option value="{!!$i!!}" {!!($i == $sk->score) ? "selected" : "" !!}>{!!$i!!}</option>
                  @endfor
                </select>

                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowSkillDescription{{$sk->skill_id}}"  maxlength="50" id="rowSkillDescription{{$sk->skill_id}}" class="form-control" value="{{$sk->skill_description}}"  disabled>
            </td>
           
          
            <td> <center id="button-row{{$sk->skill_id}}"><button class="btn btn-primary" onclick="editSkill('{{$sk->skill_id}}')"><i class="fa fa-edit"></i></button> |  <button class="btn btn-danger" onclick="deleteSkill('{{$sk->skill_id}}')"><i class="fa fa-trash"></i></button></center> </td>
          </tr>
        @php $no++; @endphp
        @endforeach
      </tbody>

    </table>
  </div>



   <div class="row">
    <h4> Language Skill</h4>
  </div>
  <div class="row">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addLangSkill({{$candidate_id}})"> <i class="fa fa-plus"></i> Add Language </button></label>
    <table style="font-size:12px" id="tableLangSkill" class="table table-bordered table-striped mdl-data-table">
      <thead>
          <tr align="center" style="font-weight:bold">
            <th>NO</th>
            <th>LANGUAGE</th>
            <th>READING</th>
            <th>SPEAKING</th>
            <th>WRITING</th>
            <th>LISTENING</th>
            <th>ACTION</th>
          </tr>
      </thead>
      <tbody>
        @php $no=1; @endphp
        @foreach($langSkill as $ss)
          <tr>
            <td>{{$no}}</td>
            <td>
              <input type="hidden" name="lang_skill_id{{$ss->lang_skill_id}}" value="{{$ss->lang_skill_id}}">
              <select name="rowLanguageName{{$ss->lang_skill_id}}" id="rowLanguageName{{$ss->lang_skill_id}}" class="form-control" disabled>
                  @foreach($language as $la)
                      <option value="{{$la->name}}" {{($la->name == $ss->language_name) ? 'selected':''}}>{{$la->name}}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
                <input type="text" name="rowReadScore{{$ss->lang_skill_id}}" id="rowReadScore{{$ss->lang_skill_id}}" class="form-control number_valid" value="{{$ss->read_score}}" maxlength="2"  disabled>
                  <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowSpeakScore{{$ss->lang_skill_id}}" id="rowSpeakScore{{$ss->lang_skill_id}}"  maxlength="2" class="form-control number_valid" value="{{$ss->speak_score}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowWriteScore{{$ss->lang_skill_id}}" id="rowWriteScore{{$ss->lang_skill_id}}"  maxlength="2" class="form-control number_valid" value="{{$ss->write_score}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowListenScore{{$ss->lang_skill_id}}" id="rowListenScore{{$ss->lang_skill_id}}"  maxlength="2" class="form-control number_valid" value="{{$ss->listen_score}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
          
            <td width="15%"> <center id="button-row-lang{{$ss->lang_skill_id}}"><button class="btn btn-primary" onclick="editLangSkill('{{$ss->lang_skill_id}}')"><i class="fa fa-edit"></i></button> |  <button class="btn btn-danger" onclick="deleteLangSkill('{{$ss->lang_skill_id}}')"><i class="fa fa-trash"></i></button></center> </td>
          </tr>
        @php $no++; @endphp
        @endforeach
      </tbody>

    </table>
  </div>
  
  
</div><!-- CARD BOTTOM --->
<script type="text/javascript">
    var row_langSkill = {{count($langSkill)}};  
    var row_skill = {{count($skill)}};  
</script>


