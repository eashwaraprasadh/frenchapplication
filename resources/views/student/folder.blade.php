@extends('layouts.app')

@section('title', $course->title . ' • ' . $folder->name . ' - TS Language Platform')

@section('content')
  <style>
    .folder-hero {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      padding: 2rem 0;
      border-radius: 0 0 24px 24px;
      margin-bottom: 2rem;
    }

    .content-wrap {
      display: grid;
      grid-template-columns: 350px 1fr;
      gap: 2rem;
    }

    @media (max-width: 768px) {
      .content-wrap {
        grid-template-columns: 1fr;
      }
    }

    .panel {
      background: white;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      padding: 1.5rem;
    }

    .content-item {
      display: flex;
      align-items: center;
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: .5rem;
      transition: .2s;
      border: 1px solid transparent;
    }

    .content-item:hover {
      background: #f8faff;
      border-color: #e0e7ff;
    }

    .content-icon {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      color: #fff;
    }

    .icon-folder {
      background: linear-gradient(135deg, #10b981, #059669);
    }

    .icon-lesson {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    }

    .icon-test {
      background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .content-title {
      font-weight: 600;
    }

    .content-meta {
      font-size: .8rem;
      opacity: .7;
    }

    .breadcrumb a {
      color: rgba(255, 255, 255, .9);
    }
  </style>

  <div class="folder-hero">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('student.courses') }}">My Courses</a></li>
          <li class="breadcrumb-item"><a href="{{ route('student.course.show', $course) }}">{{ $course->title }}</a></li>
          @if(!empty($breadcrumbs))
            @foreach($breadcrumbs as $crumb)
              @if($loop->last)
                <li class="breadcrumb-item active text-white">{{ $crumb->name }}</li>
              @else
                <li class="breadcrumb-item"><a
                    href="{{ route('student.course.folder', ['course' => $course->id, 'folder' => $crumb->id]) }}">{{ $crumb->name }}</a>
                </li>
              @endif
            @endforeach
          @else
            <li class="breadcrumb-item active text-white">{{ $folder->name }}</li>
          @endif
        </ol>
      </nav>
      <h1 class="mb-0">{{ $folder->name }}</h1>
    </div>
  </div>

  <div class="container">
    <div class="content-wrap">
      <!-- Sidebar -->
      <div class="panel">
        <h6 class="mb-3">This Folder</h6>
        <div class="small text-muted mb-2">Subfolders</div>
        @forelse($subFolders as $sub)
          <a href="{{ route('student.course.folder', ['course' => $course->id, 'folder' => $sub->id]) }}"
            class="text-decoration-none text-dark">
            <div class="content-item">
              <div class="content-icon icon-folder"><i class="bi bi-folder2-open"></i></div>
              <div>
                <div class="content-title">{{ $sub->name }}</div>
                <div class="content-meta">
                  @php
                    $subMetaParts = [];
                    $subLessons = $subFolderCounts[$sub->id]['lessons'] ?? 0;
                    $subTests = $subFolderCounts[$sub->id]['tests'] ?? 0;
                    
                    if ($subLessons > 0) {
                      $subMetaParts[] = $subLessons . ' ' . Str::plural('lesson', $subLessons);
                    }
                    if ($subTests > 0) {
                      $subMetaParts[] = $subTests . ' ' . Str::plural('test', $subTests);
                    }
                  @endphp
                  Folder{{ !empty($subMetaParts) ? ' • ' . implode(', ', $subMetaParts) : '' }}
                </div>
              </div>
            </div>
          </a>
        @empty
          <div class="text-muted mb-3">No subfolders.</div>
        @endforelse

        <div class="mt-3 small text-muted">Lessons</div>
        @forelse($folderLessons as $lesson)
          <a href="{{ route('student.lesson.show', $lesson) }}" class="text-decoration-none text-dark">
            <div class="content-item">
              <div class="content-icon icon-lesson"><i class="bi bi-play-fill"></i></div>
              <div>
                <div class="content-title">{{ $lesson->title }}</div>
                <div class="content-meta">Lesson • {{ $lesson->estimated_duration ?? '10' }} min</div>
              </div>
            </div>
          </a>
        @empty
          <div class="text-muted">No lessons in this folder.</div>
        @endforelse

        <div class="mt-3 small text-muted">Tests</div>
        @forelse($folderTests as $test)
          <a href="{{ route('student.test.show', $test) }}" class="text-decoration-none text-dark">
            <div class="content-item">
              <div class="content-icon icon-test"><i class="bi bi-clipboard-check"></i></div>
              <div>
                <div class="content-title">{{ $test->title }}</div>
                <div class="content-meta">Test • {{ $test->questions()->count() }} questions</div>
              </div>
            </div>
          </a>
        @empty
          <div class="text-muted">No tests in this folder.</div>
        @endforelse

        <div class="mt-3 small text-muted">Files</div>
        @forelse($folderFiles as $file)
          <div class="content-item">
            <div class="content-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563); color: white;">
              @if(Str::contains($file->mime_type, ['image', 'jpg', 'png', 'jpeg']))
                <i class="bi bi-image"></i>
              @elseif(Str::contains($file->mime_type, ['pdf']))
                <i class="bi bi-file-earmark-pdf"></i>
              @else
                <i class="bi bi-file-earmark-text"></i>
              @endif
            </div>
            <div class="flex-grow-1">
              <div class="content-title">{{ $file->original_name }}</div>
              <div class="content-meta">
                {{ strtoupper($file->type) }} •
                @if($file->downloadable)
                  <a href="{{ route('file.download', $file) }}" class="text-primary text-decoration-none me-2" download>
                    <i class="bi bi-download"></i> Download
                  </a>
                @endif
                @if($file->viewable)
                  @php
                    $isGoogleViewable = in_array($file->type, ['PowerPoint', 'Word', 'Excel']);
                    $isBrowserViewable = in_array($file->type, ['PDF', 'Image', 'Video', 'Audio']);
                  @endphp

                  @if($isBrowserViewable)
                    <a href="javascript:void(0)" onclick="openSecureViewer('{{ URL::temporarySignedRoute('file.download', now()->addMinutes(2), ['file' => $file->id]) }}', '{{ $file->type }}')"
                      class="text-info text-decoration-none">
                      <i class="bi bi-eye"></i> View
                    </a>
                  @elseif($isGoogleViewable)
                    <a href="javascript:void(0)"
                      onclick="openSecureViewer('https://docs.google.com/gview?url={{ urlencode(URL::temporarySignedRoute('file.download', now()->addMinutes(2), ['file' => $file->id])) }}&embedded=true', 'google')"
                      class="text-info text-decoration-none">
                      <i class="bi bi-eye"></i> View
                    </a>
                  @endif
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="text-muted">No files in this folder.</div>
        @endforelse
      </div>

      <!-- Main area (can be extended later) -->
      <div class="panel">
        <div class="text-center py-5">
          <i class="bi bi-folder2-open" style="font-size:3rem;color:#10b981"></i>
          <h4 class="mt-3">{{ $folder->name }}</h4>
          <p class="text-muted">Browse subfolders, lessons, and tests in this folder.</p>
          <a href="{{ route('student.course.show', $course) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Course
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Secure Viewer Modal -->
  <div class="modal fade" id="secureViewerModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content bg-dark">
        <div class="modal-header border-secondary py-2">
          <h6 class="modal-title text-white"><i class="bi bi-shield-lock me-2"></i>Secure Viewer</h6>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0 position-relative" style="height: 100%; overflow: hidden; background: #333;">
          {{-- The Toolbar Blocker: Covers the top 55px of the iframe --}}
          <div id="toolbarBlocker"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 55px; background: transparent; z-index: 1056; cursor: not-allowed;"
            title="External tools disabled"></div>

          <iframe id="secureFrame" src="" style="width: 100%; height: 100%; border: none;" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      function openSecureViewer(url, type) {
        const frame = document.getElementById('secureFrame');
        const blocker = document.getElementById('toolbarBlocker');

        // Reset src
        frame.src = 'about:blank';

        // Determine URL to load
        let finalUrl = url;

        // Show blocker by default for Google/Office
        blocker.style.display = (type === 'google' || type === 'PowerPoint' || type === 'Word' || type === 'Excel') ? 'block' : 'none';

        // If PDF, we can also try to hide toolbar via URL hash parameters
        if (type === 'PDF') {
          finalUrl += '#toolbar=0&navpanes=0&scrollbar=0&view=FitH';
          blocker.style.display = 'block';
        }

        frame.src = finalUrl;

        const modal = new bootstrap.Modal(document.getElementById('secureViewerModal'));
        modal.show();
      }
    </script>
  @endpush
@endsection