@extends('layouts.admin')

@section('title', 'Edit Course - ' . $course->title)

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-1">
                                <i class="bi bi-pencil-square me-2"></i>
                                Edit Course
                            </h2>
                            <p class="mb-0 opacity-75">
                                Update the course information and settings
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-dark">
                                <i class="bi bi-arrow-left me-2"></i>
                                Back to Courses
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Edit Form -->
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
                    <form method="POST" action="{{ route('admin.courses.update', $course) }}">
                        @csrf
                        @method('PUT')

                        <!-- Course Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $course->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Course Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Course Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description', $course->description) }}</textarea>
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
                                    <option value="french" {{ old('language', $course->language) === 'french' ? 'selected' : '' }}>French</option>
                                    <option value="spanish" {{ old('language', $course->language) === 'spanish' ? 'selected' : '' }}>Spanish</option>
                                    <option value="german" {{ old('language', $course->language) === 'german' ? 'selected' : '' }}>German</option>
                                    <option value="italian" {{ old('language', $course->language) === 'italian' ? 'selected' : '' }}>Italian</option>
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
                                        <option value="A1" {{ old('level', $course->level) === 'A1' ? 'selected' : '' }}>A1 - Breakthrough</option>
                                        <option value="A2" {{ old('level', $course->level) === 'A2' ? 'selected' : '' }}>A2 - Waystage</option>
                                    </optgroup>
                                    <optgroup label="Intermediate">
                                        <option value="B1" {{ old('level', $course->level) === 'B1' ? 'selected' : '' }}>B1 - Threshold</option>
                                        <option value="B2" {{ old('level', $course->level) === 'B2' ? 'selected' : '' }}>B2 - Vantage</option>
                                    </optgroup>
                                    <optgroup label="Advanced">
                                        <option value="C1" {{ old('level', $course->level) === 'C1' ? 'selected' : '' }}>C1 - Proficiency</option>
                                        <option value="C2" {{ old('level', $course->level) === 'C2' ? 'selected' : '' }}>C2 - Mastery</option>
                                    </optgroup>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Duration and Price -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="duration_hours" class="form-label">Duration (Hours)</label>
                                <input type="number" class="form-control @error('duration_hours') is-invalid @enderror" 
                                       id="duration_hours" name="duration_hours" min="1" max="500" 
                                       value="{{ old('duration_hours', $course->duration_hours) }}">
                                @error('duration_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" min="0" step="0.01" 
                                       value="{{ old('price', $course->price) }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Teacher Assignment -->
                        <div class="mb-3">
                            <label for="teacher_id" class="form-label">Assigned Teacher</label>
                            <select class="form-select @error('teacher_id') is-invalid @enderror" 
                                    id="teacher_id" name="teacher_id">
                                <option value="">No specific teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" 
                                            {{ old('teacher_id', $course->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }} ({{ ucfirst($teacher->role) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Course Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Course Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="draft" {{ old('status', $course->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $course->status) === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status', $course->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Featured Course -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                       {{ old('featured', $course->featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">
                                    Featured Course
                                </label>
                                <div class="form-text">Featured courses appear on the homepage</div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>
                                Cancel
                            </a>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Update Course
                                </button>
                                <a href="{{ route('admin.courses.builder', $course) }}" class="btn btn-success ms-2">
                                    <i class="bi bi-tools me-2"></i>
                                    Course Builder
                                </a>
                            </div>
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
    // Auto-generate course title suggestions based on language and level
    const languageSelect = document.getElementById('language');
    const levelSelect = document.getElementById('level');
    const titleInput = document.getElementById('title');

    function updateTitleSuggestion() {
        const language = languageSelect.value;
        const level = levelSelect.value;
        
        if (language && level && !titleInput.value) {
            const languageName = language.charAt(0).toUpperCase() + language.slice(1);
            titleInput.placeholder = `${languageName} ${level} Course`;
        }
    }

    languageSelect.addEventListener('change', updateTitleSuggestion);
    levelSelect.addEventListener('change', updateTitleSuggestion);
});
</script>
@endpush
@endsection
