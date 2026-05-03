<!-- Bulk Upload for Passage + Question + MCQ -->
<div class="modal fade" id="bulkPassageMcqModal" tabindex="-1" aria-labelledby="bulkPassageMcqLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bulkPassageMcqLabel">
          <i class="bi bi-upload me-2"></i>
          Bulk Upload CSV — Passage + Question + MCQ
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info">
          <div class="fw-bold mb-1">CSV Format (columns in exact order):</div>
          <div>1) Passage Text, 2) Question Text, 3) Option A, 4) Option B, 5) Option C, 6) Option D, 7) Correct Answer (A/B/C/D), 8) Points, 9) Explanation (optional)</div>
        </div>

        <div class="d-flex align-items-center gap-2 mb-3">
          <a href="/admin/tests/passage-mcq/bulk-template" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-download me-1"></i> Download CSV Template
          </a>
        </div>

        <div class="mb-3">
          <label class="form-label">Select CSV file</label>
          <input type="file" class="form-control" id="bulkPassageCsvInput" accept=".csv">
        </div>

        <div class="mb-3">
          <button type="button" class="btn btn-primary" id="btnBulkValidate">
            <i class="bi bi-eye me-1"></i> Validate & Preview
          </button>
        </div>

        <div id="bulkPreviewSection" class="d-none">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Preview</h6>
            <div>
              <span class="badge bg-secondary me-2"><span id="bulkTotalRows">0</span> rows</span>
              <span class="badge bg-success me-2"><span id="bulkValidCount">0</span> valid</span>
              <span class="badge bg-danger"><span id="bulkErrorCount">0</span> errors</span>
            </div>
          </div>
          <div class="table-responsive" style="max-height: 50vh;">
            <table class="table table-sm table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Passage</th>
                  <th>Question</th>
                  <th>A</th>
                  <th>B</th>
                  <th>C</th>
                  <th>D</th>
                  <th>Correct</th>
                  <th>Points</th>
                  <th>Explanation</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="bulkPreviewBody"></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="btnBulkImport" disabled>
          <i class="bi bi-check2-circle me-1"></i> Import <span id="bulkImportCount">0</span> Questions
        </button>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  const csvInput = document.getElementById('bulkPassageCsvInput');
  const btnValidate = document.getElementById('btnBulkValidate');
  const btnImport = document.getElementById('btnBulkImport');
  const previewSection = document.getElementById('bulkPreviewSection');
  const tbody = document.getElementById('bulkPreviewBody');
  const totalRowsEl = document.getElementById('bulkTotalRows');
  const validCountEl = document.getElementById('bulkValidCount');
  const errorCountEl = document.getElementById('bulkErrorCount');
  const importCountEl = document.getElementById('bulkImportCount');

  let parsedItems = []; // sanitized payload items ready for import
  let hasErrors = false;

  function setLoading(el, loading){
    if(!el) return;
    if(loading){ el.disabled = true; el.dataset._inner = el.innerHTML; el.innerHTML = '<i class="bi bi-arrow-repeat spin me-1"></i> Working...'; }
    else { el.disabled = false; if(el.dataset._inner){ el.innerHTML = el.dataset._inner; delete el.dataset._inner; } }
  }

  function renderPreview(rows){
    tbody.innerHTML = '';
    rows.forEach(r => {
      const tr = document.createElement('tr');
      if(r.errors && r.errors.length){ tr.classList.add('table-danger'); }
      tr.innerHTML = `
        <td>${r.row}</td>
        <td style="max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="${escapeHtml(r.passage)}">${escapeHtml(r.passage)}</td>
        <td style="max-width:260px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="${escapeHtml(r.question_text)}">${escapeHtml(r.question_text)}</td>
        <td>${escapeHtml(r.options[0] || '')}</td>
        <td>${escapeHtml(r.options[1] || '')}</td>
        <td>${escapeHtml(r.options[2] || '')}</td>
        <td>${escapeHtml(r.options[3] || '')}</td>
        <td>${r.correct_letter}</td>
        <td>${r.points}</td>
        <td>${escapeHtml(r.explanation || '')}</td>
        <td>${(r.errors && r.errors.length) ? '<span class="badge bg-danger">'+r.errors.join('<br>')+'</span>' : '<span class="badge bg-success">OK</span>'}</td>
      `;
      tbody.appendChild(tr);
    });
  }

  function escapeHtml(str){
    if(str == null) return '';
    return String(str).replace(/[&<>"']/g, s => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'}[s]));
  }

  btnValidate?.addEventListener('click', () => {
    const file = csvInput?.files?.[0];
    if(!file){ (window.showNotification||alert)('Please select a CSV file first','error'); return; }
    const fd = new FormData();
    fd.append('csv_file', file);
    setLoading(btnValidate, true);
    fetch(`/admin/tests/${testId}/questions/passage-mcq/bulk-parse`, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
      body: fd
    }).then(r => r.json()).then(data => {
      setLoading(btnValidate, false);
      if(!data.success){ (window.showNotification||alert)(data.message||'Validation failed','error'); return; }
      previewSection.classList.remove('d-none');
      totalRowsEl.textContent = data.totalRows || 0;
      validCountEl.textContent = data.validCount || 0;
      const errCount = (data.totalRows||0) - (data.validCount||0);
      errorCountEl.textContent = errCount;
      importCountEl.textContent = data.validCount || 0;
      hasErrors = !!data.hasErrors;
      parsedItems = data.items || [];
      renderPreview(data.preview || []);
      btnImport.disabled = hasErrors || (parsedItems.length === 0);
    }).catch(err => {
      setLoading(btnValidate, false);
      console.error('Parse error:', err);
      (window.showNotification||alert)('Error validating CSV','error');
    });
  });

  btnImport?.addEventListener('click', () => {
    if(!parsedItems || parsedItems.length === 0){ return; }
    if(hasErrors){ (window.showNotification||alert)('Please fix the errors before importing','error'); return; }
    setLoading(btnImport, true);
    fetch(`/admin/tests/${testId}/questions/passage-mcq/bulk-import`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ items: parsedItems })
    }).then(r => r.json()).then(data => {
      setLoading(btnImport, false);
      if(!data.success){ (window.showNotification||alert)(data.message||'Import failed','error'); return; }
      try {
        const container = document.getElementById('questionsContainer');
        const emptyState = document.getElementById('emptyState');
        if(emptyState) emptyState.style.display = 'none';
        (data.questionHtml || []).forEach(html => { container.insertAdjacentHTML('beforeend', html); });
        if(window.initializeSortable) initializeSortable();
      } catch (e) { console.warn('Render imported questions warning:', e); }
      (window.showNotification||alert)(`Imported ${data.count||parsedItems.length} questions successfully`, 'success');
      const modalEl = document.getElementById('bulkPassageMcqModal');
      const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
      modal.hide();
      csvInput.value = '';
      previewSection.classList.add('d-none');
      tbody.innerHTML = '';
      parsedItems = []; hasErrors = false;
    }).catch(err => {
      setLoading(btnImport, false);
      console.error('Import error:', err);
      (window.showNotification||alert)('Error importing questions','error');
    });
  });
})();
</script>

