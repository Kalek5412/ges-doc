<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        
    @vite(['resources/template/dist/css/adminlte.min.css','resources/template/plugins/fontawesome-free/css/all.min.css',
     'resources/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css'])    
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>SISTEMA DE ACCESO</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">iniciar session</p>
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-6 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-6 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
                                    </button>

                                </div>
                            </div>
                            
                            <div class="row mb-0">
                                <div class="col-md-12 ">
                                    <a href="{{url('/register')}}">registrate qui</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <!-- jQuery -->
    @vite(['resources/template/plugins/jquery/jquery.min.js','resources/template/plugins/bootstrap/js/bootstrap.bundle.min.js',
     'resources/template/dist/js/adminlte.min.js']) 
</body>

</html>

