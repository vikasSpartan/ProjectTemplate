@extends('auth.loginlayout')
@section('title', 'Login - SB Admin')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 dark-bg login-form">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                        <div class="card-body">
                            <form action="{{route('loginUser')}}" method="post" onsubmit="return validateLogin();">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="inputEmail" id="inputEmail" type="email" placeholder="name@example.com" @if(isset($_COOKIE['login_email'])) value="{{$_COOKIE['login_email']}}" @endif />
                                    <label for="inputEmail">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="inputPassword" id="inputPassword" type="password" placeholder="Password" @if(isset($_COOKIE['login_pass']))value="{{$_COOKIE['login_pass']}}"@endif />
                                    <label for="inputPassword">Password</label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="rememberPass" id="rememberPass" type="checkbox" value="1" @if(isset($_COOKIE['login_pass']) && isset($_COOKIE['login_pass'])) checked @endif />
                                    <label class="form-check-label" for="rememberPass">Remember Password</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="{{ route('forgotPassword') }}">Forgot Password?</a>
                                    <button class="btn btn-primary" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                        @if (Route::has('register'))
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    @if(Session::has('error'))
        <script>
            alertify.error('Either Email Id or Password does not match');
        </script>
    @endif
    @if(Session::has('emailsent'))
        <script>
            alertify.success('Reset Password email sent successfully');
        </script>
    @endif
    @if(Session::has('errValidate'))
        <script>
            alertify.error("{{Session::get('errValidate')}}");
        </script>
    @endif
@endpush