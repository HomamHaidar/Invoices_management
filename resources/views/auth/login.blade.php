<!DOCTYPE html>
<html>
<head>
    <title>Login - Invoices Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0000;
        }
        .logo {
            display: flex;
            justify-content: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .card {
            margin-top: 50px;
            margin-bottom: 50px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }
        .card-header {
            background-color: #1a2a57;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            border-bottom: none;
        }
        .card-body {
            padding: 30px;
            background-color: #fff;
            border-radius: 5px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            height: 50px;
            font-size: 18px;
            border-radius: 5px;
            padding: 10px;
            box-shadow: none;
            border: 1px solid #ccc;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }
        .form-control::-webkit-input-placeholder {
            color: #aaa;
        }
        .form-control:-ms-input-placeholder {
            color: #aaa;
        }
        .form-control::-ms-input-placeholder {
            color: #aaa;
        }
        .form-control::placeholder {
            color: #aaa;
        }
        .btn {
            font-size: 18px;
            border-radius: 5px;
            padding: 10px 20px;
            background-color: #1a2a57;
            color: #fff;
            border: none;
            box-shadow: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #1a2a80;
        }
        .forgot-password {
            font-size: 14px;
            color: #007bff;
        }
        .forgot-password:hover {
            color: #0069d9;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="logo">
   <img src="{{URL::asset('assets/img/brand/fatora.png')}}" class="sign-favicon ht-40" style="width: 568px; height: 175px" alt="logo">
</div>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required autofocus autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                             {{ __('remember me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit"  class="btn btn-primary btn-block">
                    {{ __('LOGIN') }}
                </button>

            </form>
        </div>
    </div>
</form>

</body>
</html>

{{--@extends('layouts.master2')--}}

{{--@section('title')--}}
{{--    تسجيل دخول--}}
{{--@stop--}}

{{--@section('title')--}}
{{--    تسجيل الدخول - مورا سوفت للادارة القانونية--}}
{{--@stop--}}


{{--@section('css')--}}
{{--    <!-- Sidemenu-respoansive-tabs css -->--}}
{{--    <link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <div >--}}
{{--        <div class="row no-gutter">--}}
{{--            <!-- The image half -->--}}
{{--            <!-- The content half -->--}}
{{--            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">--}}
{{--                <div class="login d-flex align-items-center py-2">--}}
{{--                    <!-- Demo content-->--}}
{{--                    <div class="container p-0">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">--}}
{{--                                <div class="card-sigin">--}}
{{--                                    <div class="mb-5 d-flex">--}}
{{--                                        <a href="{{ url('/' . $page='home') }}"><img src="{{URL::asset('assets/img/brand/fatora.jpg')}}" class="sign-favicon ht-40" style="width: 568px; height: 175px" alt="logo"></a>--}}
{{--                                    <div class="card-sigin">--}}
{{--                                        <div class="main-signup-header">--}}
{{--                                            <h2>مرحبا بك</h2>--}}
{{--                                            <h5 class="font-weight-semibold mb-4"> تسجيل الدخول</h5>--}}
{{--                                            <form method="POST" action="{{ route('login') }}">--}}
{{--                                                @csrf--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>البريد الالكتروني</label>--}}
{{--                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                                                    @error('email')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                     <strong>{{ $message }}</strong>--}}
{{--                                                     </span>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}

{{--                                                <div class="form-group">--}}
{{--                                                    <label>كلمة المرور</label>--}}

{{--                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                                    @error('password')--}}
{{--                                                    <span class="invalid-feedback" role="alert">--}}
{{--                                                  <strong>{{ $message }}</strong>--}}
{{--                                                  </span>--}}
{{--                                                    @enderror--}}
{{--                                                    <div class="form-group row">--}}
{{--                                                        <div class="col-md-6 offset-md-4">--}}
{{--                                                            <div class="form-check">--}}
{{--                                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
{{--                                                                <label class="form-check-label" for="remember">--}}
{{--                                                                    {{ __('تذكرني') }}--}}
{{--                                                                </label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <button type="submit" class="btn btn-main-primary btn-block">--}}
{{--                                                    {{ __('تسجيل الدخول') }}--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!-- End -->--}}
{{--                </div>--}}
{{--            </div><!-- End -->--}}



{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
{{--@section('js')--}}
{{--@endsection--}}
