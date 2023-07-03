@extends('layouts.auth')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card o-hidden border-0 shadow-lg my-5 w-50">
            <div class="card-body p-0">
                <div class="p-5">
                    <div class="text-center">
                        <h5 class="mb-0"><strong>Login Page</strong></h5>
                        <p class="text-muted mt-2">Sign in to continue to Dashboard.</p>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Gagal!</strong>
                                <p>{{ $errors->first() }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="user">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control form-control-user email" id="email" placeholder="Enter Email Address...">
                            {{-- @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user password" id="password" placeholder="Password">
                            {{-- @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror --}}
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                    </form>
                    <hr>
                    {{-- <div class="text-center">
                        <a class="small" href="{{ route('forgot-password') }}">Forgot Password?</a>
                    </div> --}}
                    {{-- <div class="text-center">
                        <label class="small" for="">Don't have an account?</label>
                        <a class="small" href="{{ route('register') }}">Register!</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
