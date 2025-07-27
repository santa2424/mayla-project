@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center px-3 py-5">

  <div class="card shadow border-0 w-100" style="max-width: 600px; min-width: 400px;">


        <div class="card-body p-4">
            <!-- Logo + Title -->
            <div class="text-center mb-4">
                <div class="d-flex justify-content-center mb-3">
                    <div class="bg-light border p-2 rounded-circle">
                        <i class="fas fa-shield-alt fa-lg" style="color: #FFC8C8;"></i>
                    </div>
                </div>
                <h4 class="font-weight-bold text-dark">Welcome to Mayla</h4>
                <p class="text-muted small">Secure authentication system</p>
            </div>

            <!-- Tabs -->
            <div class="d-flex justify-content-center mb-4">
                <a href="{{ route('login') }}" class="btn btn-dark btn-sm rounded-0">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-light btn-sm border rounded-0">Sign Up</a>
            </div>

            <!-- Alert -->
            @if (session('status'))
                <div class="alert alert-success text-center small">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="small">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="password" class="small">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group form-check mt-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-dark btn-block mt-3">Sign In</button>
                <hr class="my-4">


                
                       
       
    </div>
</div>
@endsection

