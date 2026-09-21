@extends('layouts.app')
@section('title')
    Register
@endsection
@section('content')


    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                sign up to your account.
            </p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="First Name"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="type" value="{{ old('type') }}" class="form-control" placeholder="Type"
                        required autocomplete="type" autofocus>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                        name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password"
                        placeholder="Password" @error('password') is-invalid @enderror>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password Confirmation"
                        name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <input id="remember-me" type="checkbox" class="form-check-input mx-2">
                    <label class="mx-4" for="remember-me">Remember Me</label>
                </div>
                <div class="p-2">
                    <button class="btn btn-primary ">Register</button>
                </div>

            </form>

            <!-- /.social-auth-links -->

            <p class="mb-1">
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
