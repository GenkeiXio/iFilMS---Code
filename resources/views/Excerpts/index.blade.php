<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Excerpts • iFiLMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f7f7f7; }
    .card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(0,0,0,.08); }
  </style>
</head>
<body>
<nav class="navbar navbar-light bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/dashboard') }}">iFiLMS Dashboard</a>
  </div>
</nav>

<div class="container py-5">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h3 class="m-0">Excerpts</h3>
    <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <a href="{{ route('excerpts.board') }}" class="text-decoration-none">
        <div class="card card-hover h-100">
          <div class="card-body">
            <h5 class="card-title">Board Meeting Excerpts</h5>
            <p class="card-text text-muted">View and upload excerpts for Board Meetings.</p>
            <span class="btn btn-primary">Open</span>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
