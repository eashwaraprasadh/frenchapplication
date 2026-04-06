@extends('layouts.admin')

@section('title', 'Course Builder - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Course Builder</h1>
        <p class="text-muted">Build and manage course content</p>
    </div>
    <div>
        <button class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>New Course
        </button>
    </div>
</div>

<div class="row">
    @forelse($courses as $course)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary">{{ ucfirst($course->level) }}</span>
                        <span class="badge bg-secondary">{{ $course->lessons_count }} lessons</span>
                    </div>
                </div>
                <div class="card-footer d-flex gap-2">
                    <a href="{{ route('admin.courses.builder', $course) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-tools me-1"></i>Open Builder
                    </a>
                    <button class="btn btn-outline-secondary btn-sm" onclick='openMoveCourse({{ $course->id }}, @json($course->title))'>
                        <i class="bi bi-arrows-move me-1"></i>Move
                    </button>
                        <button class="btn btn-outline-warning btn-sm" onclick='openMergeCourse({{ $course->id }}, @json($course->title))'>
                            <i class="bi bi-arrow-left-right me-1"></i>Merge into...
                        </button>

                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="bi bi-tools fs-1 text-muted"></i>
                <h4 class="mt-3">No courses available</h4>
                <p class="text-muted">Create your first course to get started</p>
                <button class="btn btn-primary">Create Course</button>
            </div>

        </div>
    @endforelse
</div>

<!-- Move Course Modal -->
<div class="modal fade" id="moveCourseModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-arrows-move me-2"></i>Move Course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="moveCollectionSelect" class="form-label">Destination Folder</label>
          <select id="moveCollectionSelect" class="form-select">
            <option value="">Root</option>
          </select>
          <div class="form-text">Group courses by placing them into folders. Choose Root to remove from a folder.</div>
        </div>
        <button type="button" class="btn btn-link p-0" onclick="openCreateCollection()">
          <i class="bi bi-folder-plus me-1"></i>Create New Folder
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="submitMoveCourse()">Move</button>
      </div>
    </div>
  </div>
</div>

<!-- Create Folder (Collection) Modal -->
<div class="modal fade" id="createCollectionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-folder-plus me-2"></i>Create Folder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="collectionNameInput" class="form-label">Folder Name</label>
          <input type="text" id="collectionNameInput" class="form-control" placeholder="e.g., TCF Canada" />
        </div>
        <div class="mb-3">
          <label for="collectionParentSelect" class="form-label">Parent Folder (optional)</label>
          <select id="collectionParentSelect" class="form-select">
            <option value="">Root</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="submitCreateCollection()">Create</button>

<!-- Merge Course Modal -->
<div class="modal fade" id="mergeCourseModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-arrow-left-right me-2"></i>Merge Course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="mergeDestinationSelect" class="form-label">Destination Course</label>
          <select id="mergeDestinationSelect" class="form-select"></select>
          <div class="form-text">Choose the course to receive all content. The source will be added as a new top-level folder inside the destination.</div>
        </div>

        <div class="border rounded p-3 mb-3" id="mergePreview">
          <div class="d-flex align-items-center mb-2">
            <i class="bi bi-eye me-2"></i>
            <strong>Preview</strong>
          </div>
          <div class="row g-3">
            <div class="col-6 col-md-3"><div class="small text-muted">Folders</div><div id="mergePreviewFolders" class="fw-semibold">—</div></div>
            <div class="col-6 col-md-3"><div class="small text-muted">Lessons</div><div id="mergePreviewLessons" class="fw-semibold">—</div></div>
            <div class="col-6 col-md-3"><div class="small text-muted">Tests</div><div id="mergePreviewTests" class="fw-semibold">—</div></div>
            <div class="col-6 col-md-3"><div class="small text-muted">Files</div><div id="mergePreviewFiles" class="fw-semibold">—</div></div>
          </div>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="mergeConfirmCheckbox" onchange="updateMergeExecuteState()">
          <label class="form-check-label" for="mergeConfirmCheckbox">
            I understand this will add all content from the source into the selected destination as a new top-level folder.
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="mergeExecuteBtn" class="btn btn-warning" onclick="submitMergeCourse()" disabled>
          <span class="btn-text">Merge</span>
          <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </button>
      </div>
    </div>
  </div>
</div>

      </div>
    </div>
  </div>
</div>

<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  let moveCourseId = null;

  async function loadCollectionOptions(selectEl) {
    try {
      const res = await fetch('/admin/course-collections/options');
      const data = await res.json();
      selectEl.innerHTML = '<option value="">Root</option>';
      (data.options || []).forEach(opt => {
        const o = document.createElement('option');
        o.value = opt.id;
        o.textContent = opt.path;
        selectEl.appendChild(o);
      });
    } catch (e) {
      console.error('Load collections failed:', e);
      alert('Unable to load folders');
    }
  }

  async function openMoveCourse(courseId, courseTitle) {
    moveCourseId = courseId;
    // Update modal title with course name
    const modalTitle = document.querySelector('#moveCourseModal .modal-title');
    if (modalTitle) {
      modalTitle.innerHTML = '<i class="bi bi-arrows-move me-2"></i>Move Course' + (courseTitle ? (': ' + courseTitle) : '');
    }
    const select = document.getElementById('moveCollectionSelect');
    await loadCollectionOptions(select);
    const modal = new bootstrap.Modal(document.getElementById('moveCourseModal'));
    modal.show();
  }

  async function submitMoveCourse() {
    if (!moveCourseId) return;
    const select = document.getElementById('moveCollectionSelect');
    const dest = select.value;
    try {
      const res = await fetch(`/admin/courses/${moveCourseId}/move-collection`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ destination_collection_id: dest || null })
      });
      const data = await res.json();
      if (data.success) {
        bootstrap.Modal.getInstance(document.getElementById('moveCourseModal')).hide();


        // Simple approach: reload to reflect new grouping when we add folder filters later
        location.reload();
      } else {
        alert(data.message || 'Unable to move course');
      }
    } catch (e) {
      console.error('Move course failed:', e);
      alert('Network error moving course');
    }
  }

  async function openCreateCollection(parentId = '') {
    const parentSelect = document.getElementById('collectionParentSelect');
    await loadCollectionOptions(parentSelect);
    parentSelect.value = parentId || '';
    document.getElementById('collectionNameInput').value = '';
    const modal = new bootstrap.Modal(document.getElementById('createCollectionModal'));
    modal.show();
  }

  async function submitCreateCollection() {
    const name = document.getElementById('collectionNameInput').value.trim();
    const parentId = document.getElementById('collectionParentSelect').value;
    if (!name) {
      alert('Please enter a folder name');
      return;
    }
    try {
      const res = await fetch('/admin/course-collections', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ name, parent_collection_id: parentId || null })
      });
      const data = await res.json();
      if (data.success) {
        // Close create modal
        bootstrap.Modal.getInstance(document.getElementById('createCollectionModal')).hide();
        // Refresh destination options in Move modal and preselect the new folder
        const select = document.getElementById('moveCollectionSelect');
        await loadCollectionOptions(select);
        if (data.collection && data.collection.id) {
          select.value = String(data.collection.id);
        }
      } else {
        alert(data.message || 'Unable to create folder');
      }
    } catch (e) {
      console.error('Create folder failed:', e);
      alert('Network error creating folder');
    }

  // ===== Merge Course Feature =====
  let mergeSourceId = null;

  function resetMergePreview() {
    document.getElementById('mergePreviewFolders').textContent = '—';
    document.getElementById('mergePreviewLessons').textContent = '—';
    document.getElementById('mergePreviewTests').textContent = '—';
    document.getElementById('mergePreviewFiles').textContent = '—';
  }

  function updateMergeExecuteState() {
    const btn = document.getElementById('mergeExecuteBtn');
    const dest = document.getElementById('mergeDestinationSelect').value;
    const confirmed = document.getElementById('mergeConfirmCheckbox').checked;
    btn.disabled = !(dest && confirmed);
  }

  async function loadMergeOptions(sourceId) {
    const select = document.getElementById('mergeDestinationSelect');
    select.innerHTML = '';
    try {
      const res = await fetch(`/admin/courses/${sourceId}/merge-options`);
      const data = await res.json();
      (data.options || []).forEach(c => {
        const o = document.createElement('option');
        o.value = c.id;
        o.textContent = `${c.title}`;
        select.appendChild(o);
      });
      updateMergeExecuteState();
    } catch (e) {
      console.error('Load merge options failed:', e);
      alert('Unable to load destination courses');
    }
  }

  async function loadMergeStats(sourceId) {
    resetMergePreview();
    try {
      const res = await fetch(`/admin/courses/${sourceId}/merge-stats`);
      const data = await res.json();
      if (data.success) {
        document.getElementById('mergePreviewFolders').textContent = data.stats.folders;
        document.getElementById('mergePreviewLessons').textContent = data.stats.lessons;
        document.getElementById('mergePreviewTests').textContent = data.stats.tests;
        document.getElementById('mergePreviewFiles').textContent = data.stats.files;
      }
    } catch (e) {
      console.error('Load merge stats failed:', e);
    }
  }

  async function openMergeCourse(sourceId, sourceTitle) {
    mergeSourceId = sourceId;
    const modalTitle = document.querySelector('#mergeCourseModal .modal-title');
    if (modalTitle) {
      modalTitle.innerHTML = '<i class="bi bi-arrow-left-right me-2"></i>Merge Course' + (sourceTitle ? (': ' + sourceTitle) : '');
    }
    document.getElementById('mergeConfirmCheckbox').checked = false;
    updateMergeExecuteState();
    resetMergePreview();

    await Promise.all([
      loadMergeOptions(sourceId),
      loadMergeStats(sourceId)
    ]);

    const modal = new bootstrap.Modal(document.getElementById('mergeCourseModal'));
    modal.show();
  }

  function setMergeLoading(loading) {
    const btn = document.getElementById('mergeExecuteBtn');
    const spinner = btn.querySelector('.spinner-border');
    const text = btn.querySelector('.btn-text');
    if (loading) {
      btn.disabled = true;
      spinner.classList.remove('d-none');
      text.textContent = 'Merging...';
    } else {
      spinner.classList.add('d-none');
      text.textContent = 'Merge';
      updateMergeExecuteState();
    }
  }

  async function submitMergeCourse() {
    if (!mergeSourceId) return;
    const dest = document.getElementById('mergeDestinationSelect').value;
    const confirmed = document.getElementById('mergeConfirmCheckbox').checked;
    if (!dest) { alert('Please select a destination course'); return; }
    if (!confirmed) { alert('Please confirm to proceed'); return; }

    setMergeLoading(true);
    try {
      const res = await fetch(`/admin/courses/${mergeSourceId}/merge`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ destination_course_id: dest })
      });
      const data = await res.json();
      if (data.success) {
        bootstrap.Modal.getInstance(document.getElementById('mergeCourseModal')).hide();
        alert(`Successfully merged ${data.moved.folders} folders, ${data.moved.lessons} lessons, ${data.moved.tests} tests, ${data.moved.files} files.`);
        location.reload();
      } else {
        alert(data.message || 'Merge failed');
      }
    } catch (e) {
      console.error('Merge failed:', e);
      alert('Network error during merge');
    } finally {
      setMergeLoading(false);
    }
  }

</script>

@endsection
