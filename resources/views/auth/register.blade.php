@extends('layouts.auth')
@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">                
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <form class="user" action="{{ route('register') }}" method="post">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Full Name" >
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email Address" >
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password1" class="form-control form-control-user" id="password1" placeholder="Password" >
                            </div>
                            <div class="col-sm-6">
                                <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Repeat Password" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ route('forgot-password') }}">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <label for="" class="small">Already have an account? </label>
                        <a class="small" href="{{ route('login') }}">Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection