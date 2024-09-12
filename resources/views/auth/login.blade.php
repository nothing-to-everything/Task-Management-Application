@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg border-0 animate__animated animate__fadeIn" style="max-width: 420px; width: 100%; background-color: #2C2F33; border-radius: 15px;">
            <div class="card-header text-center py-4" style="background-color: #7289DA; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h3 class="mb-0 text-white font-weight-bold">Login to Your Account</h3>
            </div>

            <div class="card-body p-5">
                {{-- Flash message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="email" class="text-light">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="password" class="text-light">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label text-light" for="remember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-block text-white font-weight-bold py-2" style="background-color: #7289DA; border-radius: 8px;">Login</button>
                </form>
            </div>

            <div class="card-footer text-center py-3">
                <small class="text-muted">Don't have an account?
                    <a href="{{ route('register') }}" class="text-info font-weight-bold">Register</a>
                    | <a href="{{ url('/') }}" class="text-info font-weight-bold">Home</a>
                </small>
            </div>
        </div>
    </div>
@endsection
