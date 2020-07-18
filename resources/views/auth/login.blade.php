<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>Login E-Recruitment</title>
    <link rel="stylesheet" type="text/css" href="{{asset('style_login/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style_login/css/my-login.css')}}">
    <style type="text/css">
        .my-login-page .card-wrapper{
            width: 500px;
        }
        .card-body{
            line-height: 1.5;
        }
    </style>
</head>
<body class="my-login-page" style="background: url('/images/imageslide1.JPG') no-repeat center; background-size:cover;">
   <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">


                    <div class="card fat" style="margin-top:100px;">
                        <div class="card-body">

                            <h2 class="card-title" style="text-align: center"> E-Recruitment </h2>
                            @if(Session::get('statusMsg'))
                                <div class="alert alert-danger" role="alert">
                                  {{    Session::get('statusMsg') }}
                                </div>
                            @endif
{{--                             <form method="POST" action="{{ route('new-login') }}">
 --}}
                             <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="login">Username</label>

                                    <input id="login" type="login" value="{{ old('username') ?: old('email') }}"   required autofocus  class="form-control" name="login" value="" required autofocus>
                                        @if ($errors->has('username') || $errors->has('email'))
                                                <strong style="font-size: 13px;color:red">{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">Password
                                    </label>
                                    <input id="password" type="password" class="form-control" name="password" required data-eye>
                                      @if ($errors->has('password'))
                                                <strong  style="font-size: 13px;color:red">{{ $errors->first('password') }}</strong>
                                      @endif
                                </div>

                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
        
                            </form>
                        </div>
                    </div>
                    <div class="footer" style="color:#fff">
                        Copyright &copy; Puninar  {{date('Y')}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('style_login/js/jquery.min.js')}}"></script>
    <script src="{{asset('style_login/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('style_login/js/my-login.js')}}"></script>
</body>
</html>

