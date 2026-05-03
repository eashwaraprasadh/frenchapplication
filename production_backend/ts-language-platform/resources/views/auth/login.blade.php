@extends('layouts.app')

@section('title', 'Login - TS Language Platform')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Welcome Back
                    </h4>
                    <p class="mb-0 mt-2 opacity-75">Sign in to continue your learning</p>
                </div>
                <div class="card-body p-4">
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Role-based login info -->
                    @if(request('role'))
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            @if(request('role') === 'student')
                                Signing in to <strong>Student Portal</strong>
                            @elseif(request('role') === 'teacher')
                                Signing in to <strong>Teacher Portal</strong>
                            @elseif(request('role') === 'admin')
                                Signing in to <strong>Admin Panel</strong>
                            @endif
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Sign In
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-2">Don't have an account?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                <i class="bi bi-person-plus me-2"></i>
                                Create Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Access Cards -->
            <div class="row mt-4">
                <div class="col-4">
                    <a href="{{ route('login') }}?role=student" class="text-decoration-none">
                        <div class="card text-center h-100 {{ request('role') === 'student' ? 'border-primary' : '' }}">
                            <div class="card-body py-3">
                                <i class="bi bi-person text-primary fs-4"></i>
                                <div class="small mt-1">Student</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{ route('login') }}?role=teacher" class="text-decoration-none">
                        <div class="card text-center h-100 {{ request('role') === 'teacher' ? 'border-success' : '' }}">
                            <div class="card-body py-3">
                                <i class="bi bi-person-workspace text-success fs-4"></i>
                                <div class="small mt-1">Teacher</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{ route('login') }}?role=admin" class="text-decoration-none">
                        <div class="card text-center h-100 {{ request('role') === 'admin' ? 'border-warning' : '' }}">
                            <div class="card-body py-3">
                                <i class="bi bi-shield-check text-warning fs-4"></i>
                                <div class="small mt-1">Admin</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
