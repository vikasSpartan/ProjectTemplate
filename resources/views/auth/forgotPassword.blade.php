@extends('auth.loginlayout')
@section('title', 'Password Reset - SB Admin')
@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 dark-bg pass-sec">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                        <div class="card-body">
                            <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                            <form action="{{route('sendFPassEmail')}}" method="post">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" />
                                    <label for="email">Email address</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="{{route('login')}}">Return to login</a>
                                    <button class="btn btn-primary" type="submit">Reset Password</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a href="{{route('register')}}">Need an account? Sign up!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@section('content')

@section('authFooter')
    <div id="layoutAuthentication_footer">
        <footer class="py-3 bg-footer mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('js')
    @if(Session::has('errValidate'))
        <script>
            alertify.error("{{Session::get('errValidate')}}");
        </script>
    @endif
    @if(Session::has('error'))
        <script>
            alertify.error("{{Session::get('error')}}");
        </script>
    @endif
@endpush