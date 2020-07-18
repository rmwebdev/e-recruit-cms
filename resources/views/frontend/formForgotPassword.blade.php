@extends('layouts.frontend')

@section('content_frontend')

<br><br>
<div class="col-sm-12 my-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"> Reset Password </h5>
        <br>
       <form class="form-forgot-password" id="form-forgot-password" method="POST">
        @csrf
        <div class="form-label-group  col-md-12">
          <label for="inputEmail">New Password</label>
          <input type="hidden" name="candidate_id" value="{{Request::segment(2)}}">
          <input type="hidden" name="email" value="{{$_GET['email']}}">
          <input type="password" class="form-control" name="password" placeholder="Input New Password" required autofocus>
          <span class="invalid-feedback" role="alert"></span>
        </div>
        <br>
        <div class="form-label-group col-md-12">
          <label for="inputPassword">Confirm Password</label>
          <input type="password"  class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
          <span class="invalid-feedback" role="alert"></span>
        </div>

       <br><br>

        <div class="clearfix">
          <a  href="{{url('/')}}" class="btn btn-default pull-left closeBtnLogin">Cancel</a>
          <button type="submit"   class="btn btn-success  pull-right loginBtn saveBtnLogin">Submit</button>
        </div>
     </form>  
      </div>
    </div>
  </div>

@endsection

@section('js')
    @include('frontend.js_frontend')
@endsection

