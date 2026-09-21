@extends('layouts.app')
@section('title')
    Login
@endsection
@section('content')

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" id="pass" name="password" required autocomplete="current-password">
                    <div class="input-group-append" id="pass_icon">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="icheck-primary">
                    <input type="checkbox" class="check" id="check">
                    <label for="check">
                        <span id="pass_text">Show Password</span>
                    </label>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember-me">
                            <label for="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Remember Me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- /.social-auth-links -->

            <p class="mb-1">
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>

    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // $('#pass').after('<br><p><input type="checkbox" class="check"> <span> Show Password</span></p>');
            $('.check').change(function() {
                if ($(this).is(':checked')) {
                    $('#pass_text').text('Hide Password');
                } else {
                    $('#pass_text').text('Show Password');
                }
                prev = $('#pass');
                val = prev.val();
                type = prev.attr('type');
                name = prev.attr('name');
                id = prev.attr('id');
                classs = prev.attr('class');
                text_type = (type == 'password') ? 'text' : 'password';
                prev.remove();
                $('#pass_icon').before('<input type="' + text_type + '" name="' + name + '" id="' +
                    id +
                    '" value="' + val + '" class="' + classs + '">');
            });
        });
    </script>
@endsection
