<div class="col-12" style="">
  <div class="row">
    <h4 class="font-20">  SKILL </h4>
  </div>
  <div class="row mt-3">
    <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addSkill()"> <i class="fa fa-plus"></i> ADD SKILL </button></label>
    <div class="table-responsive">
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
                <option value=""> - Select Score - </option>'
                <option value="1" {!!($sk->score == 1) ? "selected" : "" !!}>Low</option>'
                <option value="2" {!!($sk->score == 2) ? "selected" : "" !!} >Medium</option>'
                <option value="3" {!!($sk->score == 3) ? "selected" : "" !!} >High</option>'
                <option value="C" {!!($sk->score == "C") ? "selected" : "" !!} >Enough</option>'
                <option value="excellent" {!!($sk->score == "excellent") ? "selected" : "" !!} >excellent</option>'
                <option value="K" {!!($sk->score == "K") ? "selected" : "" !!}>Less</option>'
              </select>
              <span class="invalid-feedback" role="alert"></span>
            </td>
            <td>
              <input type="text" name="rowSkillDescription{{$sk->skill_id}}"  maxlength="50" id="rowSkillDescription{{$sk->skill_id}}" class="form-control" value="{{$sk->skill_description}}"  disabled>
                <span class="invalid-feedback" role="alert"></span>
            </td>
           
          
            <td> <center id="button-row{{$sk->skill_id}}"><button class="btn btn-primary" onclick="editSkill('{{$sk->skill_id}}')"><i class="fa fa-edit"></i></button> <button class="btn btn-danger" onclick="deleteSkill('{{$sk->skill_id}}')"><i class="fa fa-trash"></i></button></center> </td>
          </tr>
        @php $no++; @endphp
        @endforeach
      </tbody>

    </table>
  </div>
  </div>



<div class="row">
  <h4 class="font-18"> LANGUAGE SKILL </h4>
</div>
<div class="row mt-3">
  <label class="control-label"> <button class="btn btn-primary" type="button" onclick="addLangSkill()"> <i class="fa fa-plus"></i> ADD LANGUAGE </button></label>
  <div class="table-responsive">
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
            <select name="rowReadScore{{$ss->lang_skill_id}}" class="form-control" id="rowReadScore{{$ss->lang_skill_id}}" disabled>
              @for($i= 0;$i<=10;$i++)
                  <option value="{!!$i!!}" {!!($i == $ss->read_score) ? "selected" : "" !!}>{!!$i!!}</option>
              @endfor
            </select>
          </td>
          <td>
            <select name="rowSpeakScore{{$ss->lang_skill_id}}" class="form-control" id="rowSpeakScore{{$ss->lang_skill_id}}" disabled>
              @for($i= 0;$i<=10;$i++)
                  <option value="{!!$i!!}" {!!($i == $ss->speak_score) ? "selected" : "" !!}>{!!$i!!}</option>
              @endfor
            </select>
              <span class="invalid-feedback" role="alert"></span>
          </td>
          <td>
            <select name="rowWriteScore{{$ss->lang_skill_id}}" class="form-control" id="rowWriteScore{{$ss->lang_skill_id}}" disabled>
              @for($i= 0;$i<=10;$i++)
                  <option value="{!!$i!!}" {!!($i == $ss->write_score) ? "selected" : "" !!}>{!!$i!!}</option>
              @endfor
            </select>
              <span class="invalid-feedback" role="alert"></span>
          </td>
          <td>

            <select name="rowListenScore{{$ss->lang_skill_id}}" class="form-control" id="rowListenScore{{$ss->lang_skill_id}}" disabled>
              @for($i= 0;$i<=10;$i++)
                  <option value="{!!$i!!}" {!!($i == $ss->listen_score) ? "selected" : "" !!}>{!!$i!!}</option>
              @endfor
            </select>
              <span class="invalid-feedback" role="alert"></span>
          </td>
        
          <td width="15%"> <center id="button-row-lang{{$ss->lang_skill_id}}"><button class="btn btn-primary" onclick="editLangSkill('{{$ss->lang_skill_id}}')"><i class="fa fa-edit"></i></button> <button class="btn btn-danger" onclick="deleteLangSkill('{{$ss->lang_skill_id}}')"><i class="fa fa-trash"></i></button></center> </td>
        </tr>
      @php $no++; @endphp
      @endforeach
    </tbody>

  </table>
</div>
</div>
  
  
</div><!-- CARD BOTTOM --->
<script type="text/javascript">
    var row_langSkill = {{count($langSkill)}};  
    var row_skill = {{count($skill)}};  
</script>


