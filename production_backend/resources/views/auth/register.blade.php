@extends('layouts.app')

@section('title', 'Register - TS Language Platform')

@section('content')
    <style>
        /* Custom Register Page Styles - Matching Login */
        .register-wrapper {
            min-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top right, rgba(79, 70, 229, 0.08), transparent 45%),
                radial-gradient(circle at bottom left, rgba(124, 58, 237, 0.08), transparent 45%);
            padding: 4rem 0;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 28px;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.08),
                0 0 0 1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .register-header {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.04) 0%, rgba(124, 58, 237, 0.04) 100%);
            padding: 3rem 2rem 2rem;
            text-align: center;
            border-bottom: 1px solid rgba(79, 70, 229, 0.06);
        }

        .register-title {
            font-weight: 800;
            color: #1e293b;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }

        .register-subtitle {
            color: #64748b;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .form-floating>.form-control {
            border-radius: 14px;
            border: 2px solid #e2e8f0;
            padding-left: 1.25rem;
            height: 3.5rem;
            /* Slightly smaller than login to fit more fields */
            font-size: 1.05rem;
            background-color: #f8fafc;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-floating>.form-control:focus {
            border-color: #6366f1;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        }

        .form-floating>label {
            padding-left: 1.25rem;
            padding-top: 0.85rem;
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .btn-register {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 14px;
            font-weight: 700;
            padding: 1rem;
            letter-spacing: 0.025em;
            font-size: 1.1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -10px rgba(79, 70, 229, 0.5);
        }

        .form-section-title {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            font-weight: 700;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
        }
    </style>

    <div class="register-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-7 col-xl-6">
                    <div class="glass-card">
                        <div class="register-header">
                            <img src="/ts_logo.png" alt="Logo" style="width: 80px; margin-bottom: 1rem;">
                            <h1 class="register-title">Create Account</h1>
                            <p class="register-subtitle">Join us to master the French language.</p>
                        </div>

                        <div class="card-body p-4 p-md-5 pt-2">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Default to Student Role -->
                                <input type="hidden" name="role" value="student">

                                <div class="form-section-title">Personal Details</div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name"
                                        value="{{ old('name') }}" required autofocus>
                                    <label for="name">Full Name</label>
                                    @error('name')
                                        <div class="text-danger small mt-2 ms-2"><i
                                                class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                        value="{{ old('email') }}" required>
                                    <label for="email">Email Address</label>
                                    @error('email')
                                        <div class="text-danger small mt-2 ms-2"><i
                                                class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Optional Info -->
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="phone" name="phone"
                                                placeholder="Phone" value="{{ old('phone') }}">
                                            <label for="phone">Phone (Optional)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                                placeholder="Date of Birth" value="{{ old('date_of_birth') }}">
                                            <label for="date_of_birth">Date of Birth</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section-title mt-4">Security</div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password" required>
                                            <label for="password">Password</label>
                                            @error('password')
                                                <div class="text-danger small mt-2 ms-2"><i
                                                        class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Confirm Password" required>
                                            <label for="password_confirmation">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required
                                            style="width: 1.2em; height: 1.2em; margin-top: 0.15em;">
                                        <label class="form-check-label text-secondary ms-2" for="terms">
                                            I agree to the <a href="#"
                                                class="text-primary text-decoration-none fw-semibold">Terms of Service</a>
                                            and <a href="#" class="text-primary text-decoration-none fw-semibold">Privacy
                                                Policy</a>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-register w-100 text-white shadow-lg mb-4">
                                    <i class="bi bi-person-plus-fill me-2"></i> Create Account
                                </button>

                                <div class="text-center">
                                    <p class="text-secondary mb-0">
                                        Already have an account?
                                        <a href="{{ route('login') }}"
                                            class="text-primary fw-bold text-decoration-none ms-1">Sign In</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection