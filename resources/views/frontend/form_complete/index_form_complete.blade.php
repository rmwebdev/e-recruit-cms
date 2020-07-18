@extends('layouts.frontend')

@section('content_frontend')
@php
  $userinfo = Session::get('userinfo'); 
@endphp
<style type="text/css">
  
</style>


<div class="section mt-3">
  <div class="col-12 bg-light" style="padding-top: 100px;padding-bottom: 100px">
    <div class="container">
        <div style="margin-top: -50px;"></div>
        <div id="alertValid">
              @if(
                  //($npwp != "") || 
                  ($family != "") || ($emergency_contact != "") || ($education_background != "") || ($skill != "") || ($language_skill != "") || ($assess_can !="") 
                )
                
    
          <div class="alert alert-danger" role="alert">
                 Please complete data
                   <strong>  

                      @if ( ($family == 'Family Information, ' ) || ($emergency_contact == 'Emergency Contact, ' ))
                          {{"Family Information, "}}
                          <input type="hidden" name="box_action" value="family">
                      @endif

                      @if ( $education_background == 'Educational Background, ')
                          {{"Educational Background,  "}}
                          <input type="hidden" name="box_action" value="edu">
                      @endif

                      @if ( ($skill == 'Skill, ')  || ($language_skill == 'Language Skill, ') )
                            {{"Skill,  "}}
                            <input type="hidden" name="box_action" value="skill">
                      @endif
                      {{-- @if ($skill == 'NPWP, ')
                            {{"Personal Information,  "}} 
                            <input type="hidden" name="box_action" value="personal">
                      @endif
                       --}}
                      @if ($assess_can == 'Assessment, ')
                            {{"Assessment,  "}}
                            <input type="hidden" name="box_action" value="assessment">
                      @endif
                   </strong>  
                 for  next step . 
          </div>
          @endif
        </div>

        <br><br>

        <div style="margin-top: -55px;"></div>
        <div class="row">
          <div class="col-3" style="margin-bottom: 10px;">
            <div align="center">
                  <div class="box size_hp" id="personalInfo"  onclick="personalInfo()" style="">
                    <div style="margin-top: -10px;"></div>
                    <span style="color: red;font-size: 50px;margin-left: -80px;"> * </span>
                  </div>
            </div>
          </div>


          <div class="col-3" style="margin-bottom: 10px;">
            <div align="center">
                  <div class="box size_hp" id="familyInfo"  onclick="familyInfo()">
                    <div style="margin-top: -10px;"></div>
                    <span style="color: red;font-size: 50px;margin-left: -80px;"> * </span>
                  </div>
            </div>
          </div>


          <div class="col-3" style="margin-bottom: 10px;">
            <div align="center">
                  <div class="box size_hp" id="eduBack" onclick="eduBack()">
                    <div style="margin-top: -10px;"></div>
                    <span style="color: red;font-size: 50px;margin-left: -80px;"> * </span>
                  </div>
            </div>
          </div>


          <div class="col-3" style="margin-bottom: 10px;">
            <div align="center">
                  <div class="box size_hp" id="courseInfo"  onclick="courseInfo()">
                  </div>
            </div>
          </div>

        </div><!-- CARD TOP --->

        <div class="row" style="margin-top:13px"> 

          <div class="col-3" style="margin-bottom: 10px;">
            <div align="center">
                <div class="box size_hp" id="langSkill" onclick="langSkill()">
                  <div style="margin-top: -10px;"></div>
                  <span style="color: red;font-size: 50px;margin-left: -80px;"> * </span>
                </div>
            </div>
          </div>
          

          <div class="col-3" style="margin-bottom: 10px;">
            <div align="center">
                <div class="box size_hp" id="orgInfo"  onclick="orgInfo()">
                </div>
            </div>
          </div>



          <div class="col-3" style="margin-bottom: 10px;">
            <div align="center">
                <div class="box size_hp"  id="jobExp" onclick="jobExp()">
                </div>
            </div>
          </div>



          <div class="col-3" style="margin-bottom: 10px;">
            <div align="center">
                <div class="box size_hp" id="other"  onclick="other()">
                  <div style="margin-top: -10px;"></div>
                  <span style="color: red;font-size: 50px;margin-left: -80px;"> * </span>
                </div>
            </div>
          </div>

        </div><!-- CARD BOTTOM --->
    </div>
  </div><!-- END COL 12 -->
</div>


<div class="container mt-3 mb-5" style="max-width: 1400px">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light" style="border: none;" >
                <div class="card-body">
                    <div id="content-candidate">
                    </div>
                  <br><br>
                </div>  <!-- END CARD BODY -->
            </div><!-- END CARD -->
        </div>
    </div>
</div>
@endsection

@section('js')
    @include('frontend.form_complete.js_form_complete')
@endsection
