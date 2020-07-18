@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:#fff">
                    <i class="fa fa-list"></i> EXPORT DATA
                </div>

                <div class="card-body">
                    <form id="formExport">
                      <div class="form-group row">
                        <label for="Pilih Tipe" class="col-sm-2 col-form-label">PILIH TIPE :</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="itipe">
                                <option value="job_fptk"> JOB FPTK </option>
                                <option value="candidate"> LIST CANDIDATE </option>
                            </select>
                            <span class="invalid-feedback" role="alert"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="Create Start Date" class="col-sm-2 col-form-label">CREATE DATE START :</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control datepicker2" name="cd_start" readonly placeholder="Start Date">
                          <span class="invalid-feedback cd_start" role="alert"></span>
                        </div>
                      </div> 
                      <div class="form-group row">
                        <label for="Create End Date" class="col-sm-2 col-form-label">CREATE DATE END :</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control datepicker1" name="cd_end" readonly placeholder="End Date">
                          <span class="invalid-feedback cd_end" role="alert"></span>
                        </div>
                      </div>
                      <div align="center"> 
                        <button type="submit" class="btn btn-primary">EXPORT DATA</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @include('backend.export_data.js_export_data')
@endsection
