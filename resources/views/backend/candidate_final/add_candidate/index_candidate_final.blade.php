@extends('layouts.app')

@section('content')
<style type="text/css">
  .box{
    padding:20px;
  }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-list"></i> CANDIDATE COMPLETE DETAILS 
                </div>
                @php 
                  $candidate_id = Request::segment(2);
                @endphp 
                <div class="card-body">
                    {{-- <div class="col-12">
                      <div class="row">
                          <div class="col-3">
                                
                              <div class="card card-hover">
                                  <div class="box bg-biru-muda text-center" id="personalInfoAdmin"  onclick="personalInfo('{!! $candidate_id !!}')" style="cursor: pointer;">
                                      <i class="fa fa-user fa-2x text-white"></i><br>
                                      <h6 class="text-white">Personal Information</h6>
                                  </div>
                              </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box bg-hijau text-center" id="familyInfoAdmin"   onclick="familyInfo('{!! $candidate_id !!}')" style="cursor: pointer;">
                                        <i class="fa fa-users fa-2x text-white"></i><br>
                                        <h6 class="text-white">Family Information</h6>
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                               
                                <div class="card card-hover">
                                    <div class="box bg-kuning text-center" id="eduBackAdmin" onclick="eduBack('{!! $candidate_id !!}')"  style="cursor: pointer;">
                                      <i class="fa fa-graduation-cap fa-2x text-white"></i><br>
                                      <h6 class="text-white">Educational Background</h6>
                                  </div>
                                </div>
                          </div>
                          <div class="col-3">
                                
                                <div class="card card-hover">
                                  <div class="box bg-merah text-center" id="courseInfoAdmin"  onclick="courseInfo('{!! $candidate_id !!}')" style="cursor: pointer;">
                                      <i class="fa fa-tasks fa-2x text-white"></i><br>
                                      <h6 class="text-white">Course Information</h6>
                                  </div>
                                </div>
                          </div>
                      </div><!-- CARD TOP --->

                      <div class="row" style="margin-top:13px"> 
                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box bg-biru text-center" id="langSkillAdmin" onclick="langSkill('{!! $candidate_id !!}')"  style="cursor: pointer;">
                                      <i class="fa fa-trophy fa-2x text-white"></i><br>
                                      <h6 class="text-white">Skill</h6>
                                  </div>
                              </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box bg-merah text-center" id="orgInfoAdmin"  onclick="orgInfo('{!! $candidate_id !!}')" style="cursor: pointer;">
                                        <i class="fa fa-address-book fa-2x text-white"></i><br>
                                        <h6 class="text-white">Organization</h6>
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box bg-biru-muda text-center"  id="jobExpAdmin" onclick="jobExp('{!! $candidate_id !!}')" style="cursor: pointer;">
                                        <i class="fa fa-building fa-2x text-white"></i><br>
                                        <h6 class="text-white">Job Experience</h6>
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box bg-hijau text-center" id="otherAdmin"  onclick="other('{!! $candidate_id !!}')"  style="cursor: pointer;">
                                      <i class="fa fa-pencil fa-2x text-white"></i><br>
                                      <h6 class="text-white">Other</h6>
                                  </div>
                              </div>
                          </div>
                      </div><!-- CARD BOTTOM --->
                    </div><!-- END COL 12 -->
 --}}


                    {{-- <br><br><br> --}}
                    

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
    <script type="text/javascript">
      var candidate_id = '{{$candidate_id}}';
    </script>
    @include('backend.candidate_final.add_candidate.js_candidate_final')
@endsection
