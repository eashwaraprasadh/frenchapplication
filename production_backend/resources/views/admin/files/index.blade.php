@extends('layouts.admin')

@section('title', 'File Management - Admin Panel')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark mb-1">File Management</h2>
            <p class="text-muted mb-0">Manage uploaded files and media assets</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal"
                data-bs-target="#uploadModal">
                <i class="bi bi-cloud-upload me-2"></i>Upload File
            </button>
            <button class="btn btn-outline-primary rounded-pill px-4 ms-2" data-bs-toggle="modal"
                data-bs-target="#createFolderModal">
                <i class="bi bi-folder-plus me-2"></i>New Folder
            </button>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.files.index') }}" class="text-decoration-none text-primary fw-medium">
                            <i class="bi bi-hdd-network me-1"></i> Home
                        </a>
                    </li>
                    @php
                        $segments = explode('/', $path);
                        $currentPath = '';
                    @endphp
                    @foreach($segments as $segment)
                        @if(!empty($segment))
                            @php $currentPath .= $segment . '/'; @endphp
                            <li class="breadcrumb-item active" aria-current="page">{{ $segment }}</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4 py-3 text-secondary small text-uppercase">Name</th>
                            <th class="border-0 py-3 text-secondary small text-uppercase">Size</th>
                            <th class="border-0 py-3 text-secondary small text-uppercase">Modified</th>
                            <th class="border-0 py-3 text-secondary small text-uppercase text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($path)
                            <tr>
                                <td colspan="4" class="px-4 py-2">
                                    <a href="{{ route('admin.files.index', ['path' => dirname($path) == '.' ? '' : dirname($path)]) }}"
                                        class="text-decoration-none text-muted d-flex align-items-center">
                                        <i class="bi bi-arrow-return-left me-2"></i> Back to parent
                                    </a>
                                </td>
                            </tr>
                        @endif

                        <!-- Directories -->
                        @foreach($directories as $dir)
                            <tr>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.files.index', ['path' => ($path ? $path . '/' : '') . $dir['name']]) }}"
                                        class="d-flex align-items-center text-decoration-none text-dark fw-medium">
                                        <div class="icon-box-sm bg-warning bg-opacity-10 text-warning rounded p-2 me-3">
                                            <i class="bi bi-folder-fill fs-5"></i>
                                        </div>
                                        {{ $dir['name'] }}
                                    </a>
                                </td>
                                <td class="text-muted small">-</td>
                                <td class="text-muted small">-</td>
                                <td class="text-end px-4">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light rounded-circle" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                            <li>
                                                <form action="{{ route('admin.files.destroy') }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this folder?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="path" value="{{ $dir['path'] }}">
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        <!-- Files -->
                        @foreach($files as $file)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box-sm bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                                            @if(in_array($file['type'], ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                <i class="bi bi-image"></i>
                                            @elseif(in_array($file['type'], ['pdf']))
                                                <i class="bi bi-file-earmark-pdf"></i>
                                            @elseif(in_array($file['type'], ['mp4', 'mov', 'avi']))
                                                <i class="bi bi-film"></i>
                                            @else
                                                <i class="bi bi-file-earmark"></i>
                                            @endif
                                        </div>
                                        <a href="{{ $file['url'] }}" target="_blank"
                                            class="text-dark text-decoration-none">{{ $file['name'] }}</a>
                                    </div>
                                </td>
                                <td class="text-muted small">{{ $file['size'] }}</td>
                                <td class="text-muted small">{{ $file['modified'] }}</td>
                                <td class="text-end px-4">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light rounded-circle" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ $file['url'] }}" download>
                                                    <i class="bi bi-download me-2 text-primary"></i>Download
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" onclick="copyToClipboard('{{ $file['url'] }}')">
                                                    <i class="bi bi-clipboard me-2 text-secondary"></i>Copy Link
                                                </button>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.files.destroy') }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this file?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="path" value="{{ $file['path'] }}">
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if($directories->isEmpty() && $files->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-folder2-open fs-1 d-block mb-3"></i>
                                        No files found in this folder
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Upload File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="path" value="{{ $path }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select File</label>
                            <input type="file" name="file" class="form-control" required>
                            <div class="form-text">Max size: 50MB. Supported formats: Images, PDF, Video.</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Folder Modal -->
    <div class="modal fade" id="createFolderModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">New Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.files.create-folder') }}" method="POST">
                    @csrf
                    <input type="hidden" name="path" value="{{ $path }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Folder Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., resources" required
                                pattern="[a-zA-Z0-9_\-\s]+">
                            <div class="form-text">Allowed characters: Letters, numbers, spaces, hyphens, underscores.</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function () {
                alert('Link copied to clipboard!');
            }, function (err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
@endsection