@extends('layouts.app')

@section('content')
<style type="text/css">
  .btn-warning{
    color:#fff;
  }
</style>
<div class="container">
   <nav class="navbar bg-white" style="height: 55px;border-radius: 5px;">
    <div class="row">
        <div class="col-12 font-weight-900 color-ungu">
          Setting Banner
        </div>
    </div>

    <div class="pull-right font-weight-900" style="font-size: 16px"> 
      <div class="row">
        <div class="col-md-12" style="">
          <span class="pull-right"> 
            <a href="#" class="btn bg-ungu color-white" data-target="#modal_setting_banner" data-toggle="modal">
              <i class="fa fa-plus"></i>
              <span>Add </span>
            </a>
          </span>
        </div>
      </div>
    </div>
  </nav>


    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="section">
                      <div class="table-responsive">
                        <table id="table-setting-banner" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>  Banner Name </th>
                              <th> Banner Description </th>
                              <th> Banner Type </th>
                              <th> Photo  </th>
                              <th> Insert Date  </th>
                              <th> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $no=1;
                            @endphp
                            @foreach($data as $banner)
                              <tr>
                                <td>{{$no}}</td>
                                <td>{{$banner->setting_banner_name}}</td>
                                <td>{{$banner->setting_banner_desc}}</td>
                                <td>{{($banner->setting_banner_type == 'warning') ? 'warning' : $banner->setting_banner_type}}</td>
                                <td>
                                  @php  
                                    $type = explode('.', $banner->setting_banner_pict);
                                  @endphp
                                   @if($type[1] == 'mp4')
                                      <video width="100px" height="100px" controls>
                                          <source src="{{asset('upload_file/'.$banner->setting_banner_pict.'')}}" type="video/mp4">
                                      </video> 
                                    @else
                                      <img src="{{asset('upload_file/'.$banner->setting_banner_pict.'')}}" width="100px" height="100px">
                                    @endif
                                </td>
                                <td>{{$banner->created_at}}</td>
                                <td><a class="btn btn-primary" onclick="edit_setting_banner('{{$banner->setting_banner_id}}')" href="#"><i class="fa fa-edit"></i></a> | <a onclick="delete_setting_banner('{{$banner->setting_banner_id}}')" href="#" class="btn btn-danger"><i class="fa fa-trash-o"></i> </a></td>
                              </tr>
                              @php
                                $no++;
                              @endphp
                            @endforeach
                          </tbody>
                        </table>
                      </div>
          </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal   Upload -->
<div class="modal fade" id="modal_setting_banner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document"  style="width:50%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Setting Banner</h5>
        <button type="button" class="close" onclick="closeModalBanner()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-setting-banner">
            <div class="form-group row">
               <label for="" class="col-sm-2 col-form-label">  Banner  Name : <span class="span-mandatory">*</span> </label>
              <div class="col-sm-9">
                <input type="hidden" class="validate form-control" id="setting_banner_id"  name="setting_banner_id" >
                <input type="text" class="validate form-control" id="setting_banner_name"  name="setting_banner_name" >
                <i class="invalid-feedback" role="alert"></i>  
              </div>
            </div>

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label"> Banner  Desc: <span class="span-mandatory">*</span> </label>
            <div class="col-sm-9">
              <textarea type="text" class="validate form-control" id="setting_banner_desc"  name="setting_banner_desc" ></textarea> 
              <i class="invalid-feedback" role="alert"></i>  
            </div>
          </div>

          <div class="form-group row">
            <input type="hidden" class="validate form-control" id="setting_banner_pict_edit"  name="setting_banner_pict_edit" >          
            <div class="col-sm-9" id="banner_pict">     
            </div>
          </div> 

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label"> Foto  Type: <span class="span-mandatory">*</span> </label>
            <div class="col-sm-9">
                <select class="validate form-control" id="setting_banner_type"  name="setting_banner_type" onchange="set_banner(this)">
                  <option value="banner"> Banner </option>
                  <option value="warning"> Warning </option>
                </select>
                <i class="invalid-feedback" role="alert"></i>  
            </div>
          </div>          

          <div class="form-group row" style="display: none" id="show_type">
            <label for="" class="col-sm-2 col-form-label"> Show Type: <span class="span-mandatory">*</span> </label>
            <div class="col-sm-9">
                <select class="validate form-control" id="status"  name="status" >
                  <option value="show"> Show </option>
                  <option value="not_show"> Not Show </option>
                </select>
                <i class="invalid-feedback" role="alert"></i>  
            </div>
          </div>

          <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"> Banner  : <span class="span-mandatory">*</span> </label>
              <div class="col-sm-9">
                <input type="file" class="validate form-control" id="setting_banner_pict"  name="setting_banner_pict" >
                <i class="invalid-feedback" role="alert"></i>  
              </div>
          </div>

          <div class="form-group row">
              <div class="col-sm-12">
                 <h6 style="color: #000;font-size: 12px;"> Untuk mendapatkan resolusi yang terbaik kami sarankan untuk upload banner dengan ukuran 1280 px X 458px  dan untuk foto pemberitahuan dengan ukuran  465px X 500px</h6>         
              </div>
          </div>
      </div>
  
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeModalBanner()" >Close</button>
          <button type="submit" class="btn btn-primary"> Save</button>
        </form>          
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

@endsection

@section('js')
    @include('backend.dashboard.js_dashboard')
@endsection

