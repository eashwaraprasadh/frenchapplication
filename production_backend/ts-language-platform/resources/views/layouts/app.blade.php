<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'TS Language Learning Platform')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-translate me-2"></i>
                TS Language
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @guest
                        <!-- Public navigation for non-authenticated users -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-house me-1"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('courses.index') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                                <i class="bi bi-book me-1"></i>Courses
                            </a>
                        </li>
                    @endguest

                    @auth
                        @if(auth()->user()->role === 'student')
                            <!-- Student navigation -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
                                   href="{{ route('student.dashboard') }}">
                                    <i class="bi bi-house me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('student.courses') ? 'active' : '' }}"
                                   href="{{ route('student.courses') }}">
                                    <i class="bi bi-book me-1"></i>My Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('student.progress') ? 'active' : '' }}"
                                   href="{{ route('student.progress') }}">
                                    <i class="bi bi-graph-up me-1"></i>Progress
                                </a>
                            </li>
                        @elseif(auth()->user()->role === 'admin')
                            <!-- Admin navigation -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                   href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}"
                                   href="{{ route('admin.courses.index') }}">
                                    <i class="bi bi-book me-1"></i>Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.assignments.*') ? 'active' : '' }}"
                                   href="{{ route('admin.assignments.index') }}">
                                    <i class="bi bi-person-check me-1"></i>Assignments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                                   href="{{ route('admin.users.index') }}">
                                    <i class="bi bi-people me-1"></i>Users
                                </a>
                            </li>
                        @elseif(auth()->user()->role === 'teacher')
                            <!-- Teacher navigation -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}"
                                   href="{{ route('teacher.dashboard') }}">
                                    <i class="bi bi-house me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('teacher.courses') ? 'active' : '' }}"
                                   href="{{ route('teacher.courses') }}">
                                    <i class="bi bi-book me-1"></i>My Courses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('teacher.students') ? 'active' : '' }}"
                                   href="{{ route('teacher.students') }}">
                                    <i class="bi bi-people me-1"></i>Students
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                Sign In
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-warning ms-2" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>
                                Sign Up
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="user-avatar me-2">
                                    {{ Auth::user()->initials }}
                                </div>
                                <div class="d-none d-md-block">
                                    <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                    <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-header">
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2">
                                            {{ Auth::user()->initials }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                            <small class="text-muted">{{ Auth::user()->email }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                @if(auth()->user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                    </a></li>
                                @elseif(auth()->user()->role === 'student')
                                    <li><a class="dropdown-item" href="{{ route('student.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Student Dashboard
                                    </a></li>
                                @elseif(auth()->user()->role === 'teacher')
                                    <li><a class="dropdown-item" href="{{ route('teacher.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Teacher Dashboard
                                    </a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i>Profile Settings
                                </a></li>
                                @if(auth()->user()->role === 'student')
                                    <li><a class="dropdown-item" href="{{ route('student.progress') }}">
                                        <i class="bi bi-graph-up me-2"></i>My Progress
                                    </a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">TS Language Platform</h5>
                    <p class="text-muted">Master French with our comprehensive online learning platform.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold">Learn</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('courses.index') }}" class="text-muted text-decoration-none">Courses</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Lessons</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Tests</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold">Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">Help Center</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Contact</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold">Company</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">About</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Privacy</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Terms</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted mb-0">&copy; {{ date('Y') }} TS Language Platform. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">Made with <i class="bi bi-heart-fill text-danger"></i> for language learners</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
