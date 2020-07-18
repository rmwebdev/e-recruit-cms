@extends('layouts.app')

@section('content')
<style type="text/css">
  /*.box{
    padding:20px;
  }*/
  .card{
    border:none;
  }
</style>


<div class="container" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
                    <h4 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Candidate Complete Details </h4>   
                </div>
              </div>
            </nav>
        </div>
    </div>
</div>


<div class="container mt-3"  style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                @php 
                  $candidate_id = Request::segment(2);
                @endphp 
                <div class="card-body">
                  <div class="col-12">
                    <div class="row">
                          <div class="col-3">
                                
                              <div class="card card-hover">
                                  <div class="box  text-center" id="personalInfoAdmin"  onclick="personalInfo('{!! $candidate_id !!}')" style="cursor: pointer;">
                                    
                                  </div>
                              </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box text-center" id="familyInfoAdmin"   onclick="familyInfo('{!! $candidate_id !!}')" style="cursor: pointer;">
                                       
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                               
                                <div class="card card-hover">
                                    <div class="box text-center" id="eduBackAdmin" onclick="eduBack('{!! $candidate_id !!}')"  style="cursor: pointer;">
                                      
                                  </div>
                                </div>
                          </div>
                          <div class="col-3">
                                
                                <div class="card card-hover">
                                  <div class="box text-center" id="courseInfoAdmin"  onclick="courseInfo('{!! $candidate_id !!}')" style="cursor: pointer;">
                                    
                                  </div>
                                </div>
                          </div>
                      </div><!-- CARD TOP --->

                      <div class="row" style="margin-top:13px"> 
                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box text-center" id="langSkillAdmin" onclick="langSkill('{!! $candidate_id !!}')"  style="cursor: pointer;">
                                     
                                  </div>
                              </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box  text-center" id="orgInfoAdmin"  onclick="orgInfo('{!! $candidate_id !!}')" style="cursor: pointer;">
                                        
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                                <div class="card card-hover">
                                    <div class="box  text-center"  id="jobExpAdmin" onclick="jobExp('{!! $candidate_id !!}')" style="cursor: pointer;">
                                        
                                    </div>
                                </div>
                          </div>
                          <div class="col-3">
                              <div class="card card-hover">
                                  <div class="box text-center" id="otherAdmin"  onclick="other('{!! $candidate_id !!}')"  style="cursor: pointer;">
                                    
                                  </div>
                              </div>
                          </div>
                      </div><!-- CARD BOTTOM --->
                    </div><!-- END COL 12 -->
                </div>  <!-- END CARD BODY -->
            </div><!-- END CARD -->
        </div>
    </div>
</div>



<div id="content-candidate" class="mt-3">
</div>

@endsection

@section('js')
    <script type="text/javascript">
      var candidate_id = '{{$candidate_id}}';
    </script>
    @include('backend.candidate_final.js_candidate_final')
@endsection
