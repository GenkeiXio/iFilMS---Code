<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $title }} • Excerpts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f7f7f7; }
    .dropzone {
      border: 2px dashed #c9c9c9;
      border-radius: 10px;
      padding: 40px;
      text-align: center;
      transition: background .2s, border-color .2s;
    }
    .dropzone.dragover {
      background: #eef6ff;
      border-color: #66a3ff;
    }
    .file-list small { display:block; }
  </style>
</head>
<body>
<nav class="navbar navbar-light bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/dashboard') }}">iFiLMS Dashboard</a>
    <div>
      <a href="{{ route('excerpts.index') }}" class="btn btn-outline-secondary btn-sm">All Excerpts</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h4 class="mb-0">{{ $title }}</h4>
      <small class="text-muted">Upload and manage files for this category.</small>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload File</button>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-nowrap mb-0">
          <thead class="table-light">
            <tr>
              <th>Document Title</th>
              <th>File Type</th>
              <th>Date Uploaded</th>
              <th>Uploaded By</th>
              <th style="width:120px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($documents as $doc)
              <tr>
                <td>{{ $doc->title }}</td>
                <td class="fw-semibold text-uppercase">{{ $doc->file_type }}</td>
                <td>{{ $doc->created_at?->format('M d, Y') }}</td>
                <td>{{ $doc->staff?->name ?? 'Staff' }}</td>
                <td>
                  <div class="d-flex gap-2">
                    <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Download</a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center py-4 text-muted">No records yet</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Upload Modal --}}
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header">
        <h5 class="modal-title">Upload to: {{ $title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" action="{{ route('excerpts.upload') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="dropzone" id="dropzone">
            <p class="mb-2 fw-semibold">Drag & drop file here</p>
            <p class="text-muted small">or click to choose a file</p>
            <input type="file" id="fileInput" name="file" class="d-none"
                   accept=".pdf,.doc,.docx,.txt,.csv,.xls,.xlsx">
            <div class="file-list mt-3 text-muted small" id="fileList"></div>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
          <button class="btn btn-primary" type="submit">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (function() {
    const dropzone   = document.getElementById('dropzone');
    const fileInput  = document.getElementById('fileInput');
    const fileList   = document.getElementById('fileList');

    dropzone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
      fileList.innerHTML = '';
      if (fileInput.files.length) {
        [...fileInput.files].forEach(f => {
          const el = document.createElement('small');
          el.textContent = `• ${f.name}`;
          fileList.appendChild(el);
        });
      }
    });

    dropzone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
      dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropzone.classList.remove('dragover');

      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        fileList.innerHTML = '';
        [...e.dataTransfer.files].forEach(f => {
          const el = document.createElement('small');
          el.textContent = `• ${f.name}`;
          fileList.appendChild(el);
        });
      }
    });
  })();
</script>
</body>
</html>
