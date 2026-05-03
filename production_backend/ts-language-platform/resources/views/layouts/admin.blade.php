<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel - TS Language Platform')</title>

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
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <!-- Sidebar Toggle -->
            <button class="btn btn-outline-light sidebar-toggle me-3" type="button" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-mortarboard me-2"></i>
                TS Admin Panel
            </a>

            <!-- Right Side Navigation -->
            <div class="navbar-nav ms-auto">
                <!-- Notifications -->
                <div class="nav-item dropdown me-3">
                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">Notifications</li>
                        <li><a class="dropdown-item" href="#">
                            <i class="bi bi-person-plus me-2"></i>New student registered
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <i class="bi bi-file-earmark me-2"></i>Course submission pending
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <i class="bi bi-exclamation-triangle me-2"></i>System maintenance due
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                    </ul>
                </div>

                <!-- User Dropdown -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <div class="user-avatar me-2">
                            {{ Auth::user()->initials }}
                        </div>
                        <div class="d-none d-md-block">
                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                            <small class="text-light opacity-75">Administrator</small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-header">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar large me-3">
                                    {{ Auth::user()->initials }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2"></i>Profile Settings
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}">
                            <i class="bi bi-house me-2"></i>View Site
                        </a></li>
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
                </div>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <h6 class="mb-0 text-white">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Admin Panel
                </h6>
            </div>

            <nav class="sidebar-nav">
                <ul class="nav flex-column">
                    <!-- Overview -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            Overview
                        </a>
                    </li>

                    <!-- Users -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" 
                           href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people"></i>
                            Users
                        </a>
                    </li>

                    <!-- Courses -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.courses*') ? 'active' : '' }}" 
                           href="{{ route('admin.courses.index') }}">
                            <i class="bi bi-book"></i>
                            Courses
                        </a>
                    </li>

                    <!-- Course Builder -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.course-builder*') ? 'active' : '' }}" 
                           href="{{ route('admin.course-builder.index') }}">
                            <i class="bi bi-tools"></i>
                            Course Builder
                        </a>
                    </li>

                    <!-- Course Assignments -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.assignments*') ? 'active' : '' }}" 
                           href="{{ route('admin.assignments.index') }}">
                            <i class="bi bi-clipboard-check"></i>
                            Course Assignments
                        </a>
                    </li>

                    <!-- Analytics -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.analytics*') ? 'active' : '' }}" 
                           href="{{ route('admin.analytics.index') }}">
                            <i class="bi bi-graph-up"></i>
                            Analytics
                        </a>
                    </li>

                    <!-- Test Submissions -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.test-submissions*') ? 'active' : '' }}" 
                           href="{{ route('admin.test-submissions.index') }}">
                            <i class="bi bi-file-earmark-text"></i>
                            Test Submissions
                        </a>
                    </li>

                    <!-- File Management -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.files*') ? 'active' : '' }}" 
                           href="{{ route('admin.files.index') }}">
                            <i class="bi bi-folder"></i>
                            File Management
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" 
                           href="{{ route('admin.settings.index') }}">
                            <i class="bi bi-gear"></i>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="admin-content flex-grow-1" id="adminContent">
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Content -->
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('adminSidebar');
            const content = document.getElementById('adminContent');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    content.classList.toggle('expanded');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                        sidebar.classList.remove('show');
                        content.classList.remove('expanded');
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
