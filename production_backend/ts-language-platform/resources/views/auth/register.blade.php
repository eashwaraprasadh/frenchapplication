@extends('layouts.app')

@section('title', 'Register - TS Language Platform')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-person-plus me-2"></i>
                        Join TS Language Platform
                    </h4>
                    <p class="mb-0 mt-2 opacity-75">Start your French learning journey today</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Role Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">I want to join as:</label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role_student" value="student" {{ old('role', 'student') == 'student' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="role_student">
                                            <div class="card h-100 border-2" id="student-card">
                                                <div class="card-body text-center">
                                                    <i class="bi bi-person fs-1 text-primary"></i>
                                                    <h6 class="mt-2">Student</h6>
                                                    <small class="text-muted">Learn French with interactive lessons</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="role_teacher" value="teacher" {{ old('role') == 'teacher' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="role_teacher">
                                            <div class="card h-100 border-2" id="teacher-card">
                                                <div class="card-body text-center">
                                                    <i class="bi bi-person-workspace fs-1 text-success"></i>
                                                    <h6 class="mt-2">Teacher</h6>
                                                    <small class="text-muted">Create and manage French courses</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Personal Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <!-- Optional Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                           id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Student-specific fields -->
                        <div id="student-fields" style="display: none;">
                            <div class="mb-3">
                                <label for="language_level" class="form-label">Current French Level</label>
                                <select class="form-select @error('language_level') is-invalid @enderror"
                                        id="language_level" name="language_level">
                                    <option value="">Select your level</option>
                                    <option value="beginner" {{ old('language_level') == 'beginner' ? 'selected' : '' }}>Beginner (A1)</option>
                                    <option value="elementary" {{ old('language_level') == 'elementary' ? 'selected' : '' }}>Elementary (A2)</option>
                                    <option value="intermediate" {{ old('language_level') == 'intermediate' ? 'selected' : '' }}>Intermediate (B1)</option>
                                    <option value="upper_intermediate" {{ old('language_level') == 'upper_intermediate' ? 'selected' : '' }}>Upper Intermediate (B2)</option>
                                    <option value="advanced" {{ old('language_level') == 'advanced' ? 'selected' : '' }}>Advanced (C1-C2)</option>
                                </select>
                                @error('language_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="mb-4">
                            <label for="bio" class="form-label">About Me</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror"
                                      id="bio" name="bio" rows="3" placeholder="Tell us a bit about yourself...">{{ old('bio') }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-primary">Terms of Service</a> and
                                    <a href="#" class="text-primary">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-person-plus me-2"></i>
                                Create Account
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <p class="mb-0">Already have an account?
                                <a href="{{ route('login') }}" class="text-primary text-decoration-none">Sign in here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const studentRadio = document.getElementById('role_student');
    const teacherRadio = document.getElementById('role_teacher');
    const studentFields = document.getElementById('student-fields');
    const studentCard = document.getElementById('student-card');
    const teacherCard = document.getElementById('teacher-card');

    function updateRoleSelection() {
        if (studentRadio.checked) {
            studentFields.style.display = 'block';
            studentCard.classList.add('border-primary');
            teacherCard.classList.remove('border-success');
        } else if (teacherRadio.checked) {
            studentFields.style.display = 'none';
            teacherCard.classList.add('border-success');
            studentCard.classList.remove('border-primary');
        }
    }

    studentRadio.addEventListener('change', updateRoleSelection);
    teacherRadio.addEventListener('change', updateRoleSelection);

    // Initialize on page load
    updateRoleSelection();
});
</script>
@endpush
@endsection
