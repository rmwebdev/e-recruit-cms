@extends('layouts.app')

@section('content')
<style type="text/css">
    .select2-container .select2-selection--single{
        width: 100%;
    }
</style>
<div class="container" style="max-width: 1203px">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
              <div class="row">
                <div class="col-12">
                    <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Formulir Penilaian Kinerja </h3>   
                </div>
              </div>
            </nav>
            
            <div class="card mt-3">
                <div class="card-body" style="background-color: #f0f0f0">
                    <div class="section">
                        <form id="form-fptk-outsource">

                            <div class="form-row">
                                <div class="col-md-6">
                                    <h5> <strong>LOGO dan NAMA PERUSAHAAN</strong> </h5>
                                    <br><br><br><hr>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama <span class="span-mandatory">*</span></label>
                                        <input type="text" name="ass_name" class="form-control number_valid_char">
                                        <i class="invalid-feedback" role="alert"></i>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Posisi <span class="span-mandatory">*</span></label>
                                        <input type="text" name="ass_posisi" class="form-control number_valid_char">
                                        <i class="invalid-feedback" role="alert"></i>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Projek <span class="span-mandatory">*</span> </label>
                                        <input type="text" name="ass_proyek" class="form-control number_valid_char">
                                        <i class="invalid-feedback" role="alert"></i>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Masa Kerja <span class="span-mandatory">*</span> </label>
                                        <input type="text" name="ass_masa_kerja" class="form-control number_valid_char">
                                        <i class="invalid-feedback" role="alert"></i>    
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5> <strong></strong> </h5>
                                    <br><br><br><br><hr>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" style="margin-bottom: 7px">Tanggal Join <span class="span-mandatory">*</span> </label>
                                        <input type="text" name="required_date_fptk" class="form-control datepicker" >
                                        <i class="invalid-feedback" role="alert"></i>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1" style="margin-bottom: 7px">Tanggal Akhir Kontrak <span class="span-mandatory">*</span> </label>
                                        <input type="text" name="ass_tgl_akhir_kontrak" class="form-control datepicker2" >
                                        <i class="invalid-feedback" role="alert"></i>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1" style="margin-bottom: 7px">Tanggal Penilaian <span class="span-mandatory">*</span> </label>
                                        <input type="text" name="ass_tgl_penilaian" class="form-control datepicker3" >
                                        <i class="invalid-feedback" role="alert"></i>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
        </div>

        <br>
        <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
          <div class="row">
            <div class="col-12">
                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Penilaian Kinerja </h3>   
            </div>
          </div>
        </nav>
        <div class="card mt-3">
            <div class="card-body" style="background-color: #f0f0f0">
                <div class="section">
                    <form id="form-fptk-outsource">
                      <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pencapaian Target Kerja / Target Achievement <span class="span-mandatory">*</span> </label>
                                    <select class="form-control   validate" name="ass_target_kerja" id="ass_target_kerja">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Kualitas Hasil Kerja / Quality <span class="span-mandatory">*</span></label>
                                    <select class="form-control   validate" name="ass_quality" id="ass_quality">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggung Jawab Kerja / Responsibility <span class="span-mandatory">*</span></label>
                                    <select class="form-control   validate" name="ass_responsibility" id="ass_responsibility">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Keahlian Kerja / Technical Skill <span class="span-mandatory">*</span></label>
                                    <select class="form-control   validate" name="ass_skill" id="ass_skill">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Disiplin Kerja / Disipline <span class="span-mandatory">*</span></label>
                                    <select class="form-control   validate" name="ass_disipline" id="ass_disipline">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>
                        </div>
                        <!-- End left form -->


                        <!-- Right form -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kehadiran / Attendance <span class="span-mandatory">*</span> </label>
                                    <select class="form-control   validate" name="ass_attendance" id="ass_attendance">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Sikap Kerja / Attitude <span class="span-mandatory">*</span></label>
                                    <select class="form-control   validate" name="ass_attitude" id="ass_attitude">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Kerjasama / Teamwork <span class="span-mandatory">*</span></label>
                                    <select class="form-control   validate" name="ass_teamwork" id="ass_teamwork">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Penyelesaian Masalah / Problem Solving <span class="span-mandatory">*</span></label>
                                    <select class="form-control   validate" name="ass_trouble" id="ass_trouble">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Inisiatif & Kreativitas / Initiative & Creativity<span class="span-mandatory">*</span></label>
                                    <select class="form-control   validate" name="ass_creativity" id="ass_creativity">
                                        <option value=""> - </option>
                                        <option value="1">1 (Kurang Sekali)</option>
                                        <option value="2">2 (Kurang)</option>
                                        <option value="3">3 (Cukup)</option>
                                        <option value="4">4 (Baik)</option>
                                        <option value="5">5 (Baik Sekali)</option>
                                    </select>
                                <i class="invalid-feedback" role="alert"></i>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>


        <br>
        <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
          <div class="row">
            <div class="col-12">
                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Penilaian Kedisiplinan </h3>   
            </div>
          </div>
        </nav>
        <div class="card mt-3">
            <div class="card-body" style="background-color: #f0f0f0">
                <div class="section">
                    <form id="form-fptk-outsource">
                      <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telat <span class="span-mandatory">*</span> </label>
                                <input type="text" name="ass_telat" class="form-control number_valid_char">
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Sakit <span class="span-mandatory">*</span></label>
                                <input type="text" name="ass_sakit" class="form-control number_valid_char">
                                <i class="invalid-feedback" role="alert"></i>
                            </div>
                        </div>
                        <!-- End left form -->


                        <!-- Right form -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Izin <span class="span-mandatory">*</span> </label>
                                <input type="text" name="ass_izin" class="form-control number_valid_char">
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Alpa <span class="span-mandatory">*</span></label>
                                <input type="text" name="ass_alpa" class="form-control number_valid_char">
                                <i class="invalid-feedback" role="alert"></i>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>


        <br>
        <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
          <div class="row">
            <div class="col-12">
                <h3 class="color-ungu  pl-3 mt-1 font-18 font-weight-900"> Catatan dan Pengembangan </h3>   
            </div>
          </div>
        </nav>
        <div class="card mt-3">
            <div class="card-body" style="background-color: #f0f0f0">
                <div class="section">
                    <form id="form-fptk-outsource">
                      <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="margin-left: 15px;"></label>
                                <input type="radio" class="form-check-input" name="optradio_1" value="1">
                                Perpanjang Kontrak 1 Bulan / Extend Contract 1 Month
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1" style="margin-left: 15px;"></label>
                                <input type="radio" class="form-check-input" name="optradio_2" value="2">
                                Perpanjang Kontrak 3 Bulan / Extend Contract 3 Month
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1" style="margin-left: 15px;"></label>
                                <input type="radio" class="form-check-input" name="optradio_3" value="3">
                                Perpanjang Kontrak 6 Bulan / Extend Contract 6 Month
                                <i class="invalid-feedback" role="alert"></i>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1" style="margin-left: 15px;"></label>
                                <input type="radio" class="form-check-input" name="optradio_4" value="4">
                                Perpanjang Kontrak 12 Bulan / Extend Contract 12 Month
                                <i class="invalid-feedback" role="alert"></i>
                            </div>
                        </div>
                </div>
            </div>
            <div style="clear:both"></div>
            <div class="card-footer" style="background-color: #f0f0f0">
                <center>
                    <!-- <button type="button" class="btn btn-success"  onclick="saveDraft('draft')">SAVE</button> -->
                    <button type="button" class="btn btn-success">SAVE</button>
                    <a href="{{url('create-fptk-outsource')}}" class="btn btn-default">CANCEL</a>
                </center>   
            </div>
        </div>
    </div>

    </div>
</div>
@endsection


@section('js')
    @include('backend.candidate_outsource.js_candidate_outsource')
    <script type="text/javascript">
        function get_reason(a)
        {
            if($(a).val()=='other')
            {
                $('#div_request_reason').show();
                $('#employee_name_replace').hide();
            }
            else if($(a).val()=='replacement')
            {
                $('#employee_name_replace').show();
            }
            else
            {
                $('#div_request_reason').hide();    
                $('#employee_name_replace').hide();
                $('[name="other_request_reason"]').val(''); 
            }
        }

        function get_project(b)
        {
            if($(b).val()=='OTHERS')
            {
                $('#div_other_project').show();
            }
            else
            {
                $('#div_other_project').hide(); 
                $('[name="other_project"]').val('');    
            }
        }

        function get_work_location(c)
        {
            if($(c).val()=='OTHERS')
            {
                $('#div_other_work_location').show();
            }
            else
            {
                $('#div_other_work_location').hide();   
                $('[name="other_work_location"]').val('');  
            }
        }

        function get_cost_center(d)
        {
            if($(d).val()=='OTHERS')
            {
                $('#div_other_cost_center').show();
            }
            else
            {
                $('#div_other_cost_center').hide(); 
                $('[name="other_cost_center"]').val('');    
            }
        }

        function get_major(e)
        {
            if($(e).val()=='Other')
            {
                $('#div_other_major').show();
            }
            else
            {
                $('#div_other_major').hide();   
                $('[name="other_major"]').val('');  
            }
        }
    </script>
@endsection