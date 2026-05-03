@extends('layouts.admin')

@section('title', 'Create Course - Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-1">
                                <i class="bi bi-plus-circle me-2"></i>
                                Create New Course
                            </h2>
                            <p class="mb-0 opacity-75">
                                Set up the basic information for your new course
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-light">
                                <i class="bi bi-arrow-left me-2"></i>
                                Back to Courses
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Creation Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Course Information
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.courses.store') }}">
                        @csrf

                        <!-- Course Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g., French for Beginners" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Course Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Course Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required
                                      placeholder="Describe what students will learn in this course...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Language and Level -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="language" class="form-label">Language <span class="text-danger">*</span></label>
                                <select class="form-select @error('language') is-invalid @enderror"
                                        id="language" name="language" required>
                                    <option value="">Select Language</option>
                                    <option value="french" {{ old('language') === 'french' ? 'selected' : '' }}>French</option>
                                    <option value="spanish" {{ old('language') === 'spanish' ? 'selected' : '' }}>Spanish</option>
                                    <option value="german" {{ old('language') === 'german' ? 'selected' : '' }}>German</option>
                                    <option value="italian" {{ old('language') === 'italian' ? 'selected' : '' }}>Italian</option>
                                </select>
                                @error('language')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="level" class="form-label">Difficulty Level <span class="text-danger">*</span></label>
                                <select class="form-select @error('level') is-invalid @enderror"
                                        id="level" name="level" required>
                                    <option value="">Select Level</option>
                                    <optgroup label="Beginner">
                                        <option value="A1" {{ old('level') === 'A1' ? 'selected' : '' }}>A1 - Breakthrough</option>
                                        <option value="A2" {{ old('level') === 'A2' ? 'selected' : '' }}>A2 - Waystage</option>
                                    </optgroup>
                                    <optgroup label="Intermediate">
                                        <option value="B1" {{ old('level') === 'B1' ? 'selected' : '' }}>B1 - Threshold</option>
                                        <option value="B2" {{ old('level') === 'B2' ? 'selected' : '' }}>B2 - Vantage</option>
                                    </optgroup>
                                    <optgroup label="Advanced">
                                        <option value="C1" {{ old('level') === 'C1' ? 'selected' : '' }}>C1 - Proficiency</option>
                                        <option value="C2" {{ old('level') === 'C2' ? 'selected' : '' }}>C2 - Mastery</option>
                                    </optgroup>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Teacher Assignment -->
                        <div class="mb-3">
                            <label for="teacher_id" class="form-label">Assign Teacher <span class="text-danger">*</span></label>
                            <select class="form-select @error('teacher_id') is-invalid @enderror" 
                                    id="teacher_id" name="teacher_id" required>
                                <option value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }} ({{ ucfirst($teacher->role) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price and Duration -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Course Price (USD)</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', 0) }}" 
                                           min="0" step="0.01" placeholder="0.00">
                                </div>
                                <small class="form-text text-muted">Leave as 0 for free courses</small>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="duration_hours" class="form-label">Estimated Duration (Hours)</label>
                                <input type="number" class="form-control @error('duration_hours') is-invalid @enderror" 
                                       id="duration_hours" name="duration_hours" value="{{ old('duration_hours', 1) }}" 
                                       min="1" placeholder="1">
                                @error('duration_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Course Options -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Course Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Course Options</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured" 
                                           {{ old('featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">
                                        <i class="bi bi-star me-1"></i>
                                        Featured Course
                                    </label>
                                    <small class="form-text text-muted d-block">Featured courses appear on the homepage</small>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle me-2"></i>
                                Create Course & Continue to Builder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Section -->
    <div class="row mt-4">
        <div class="col-lg-8 mx-auto">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="bi bi-lightbulb me-2"></i>
                        Course Creation Tips
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Course Title</h6>
                            <ul class="small">
                                <li>Keep it clear and descriptive</li>
                                <li>Include the language and level</li>
                                <li>Make it appealing to students</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Description</h6>
                            <ul class="small">
                                <li>Explain what students will learn</li>
                                <li>Mention prerequisites if any</li>
                                <li>Highlight unique features</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Pricing</h6>
                            <ul class="small">
                                <li>Free courses attract more students</li>
                                <li>Premium courses should offer extra value</li>
                                <li>Consider your target audience</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Status</h6>
                            <ul class="small">
                                <li><strong>Draft:</strong> Work in progress, not visible to students</li>
                                <li><strong>Published:</strong> Live and available for enrollment</li>
                                <li><strong>Archived:</strong> Hidden but preserved</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate course title suggestions based on language and level
    const languageSelect = document.getElementById('language');
    const levelSelect = document.getElementById('level');
    const titleInput = document.getElementById('title');

    function updateTitleSuggestion() {
        const language = languageSelect.value;
        const level = levelSelect.value;
        
        if (language && level && !titleInput.value) {
            const languageName = language.charAt(0).toUpperCase() + language.slice(1);
            const levelName = level.charAt(0).toUpperCase() + level.slice(1);
            titleInput.placeholder = `${languageName} for ${levelName}s`;
        }
    }

    languageSelect.addEventListener('change', updateTitleSuggestion);
    levelSelect.addEventListener('change', updateTitleSuggestion);
});
</script>
@endpush
@endsection
