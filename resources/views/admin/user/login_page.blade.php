<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! str_replace('-', ' ',  config('app.name')) !!}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/mwadmin') }}"><b>{!! str_replace('-', ' ',  config('app.name')) !!}</b></a>
    </div>
    <!-- /.login-logo -->

    <!-- /.login-box-body -->
    <div class="card">
        <div class="card-body login-card-body">
            <form method="post" action="{{ url('/mwadmin') }}">

            <p class="login-box-msg">
                @if ($data['is_company'] == true)
                    Company User
                    <input type="hidden" name="employee_type" value="company">
                    {{-- This is to identify for login --}}

                @endif
                @if ($data['is_company'] == false)
                    Employee User
                    <input type="hidden" name="employee_type" value="user">
                @endif
                Sign in
            </p>



                @csrf

                <div class="input-group mb-3">
                    <input type="name"
                           name="username"
                           value="{{ old('username') }}"

                           placeholder="User Name"
                           class="form-control @error('username') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('username')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           placeholder="Password"
                           class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>
                @if ($message = Session::get('error'))
                <div class="alert alert-warning alert-block">

                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="row">


                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                </div>
            </form>

        </div>
        <div class="col-8 pull-left">
            @if ($data['is_company'] == false)
                    Are you a  company <a href="{{ url('company_login')}}">here</a>
            @endif
            @if ($data['is_company'] == true)
                Are you a employee <a href="{{ url('mwadmin')}}">here</a>
            @endif

        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
