<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Minutes • iFiLMS</title>
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
    <h3 class="m-0">Meeting Minutes</h3>
    <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <a href="{{ route('minutes.list', 'academic-council') }}" class="text-decoration-none">
        <div class="card card-hover h-100">
          <div class="card-body">
            <h5 class="card-title">Academic Council Minutes</h5>
            <p class="card-text text-muted">View and upload minutes for Academic Council.</p>
            <span class="btn btn-primary">Open</span>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="{{ route('minutes.list', 'administrative-council') }}" class="text-decoration-none">
        <div class="card card-hover h-100">
          <div class="card-body">
            <h5 class="card-title">Administrative Council Minutes</h5>
            <p class="card-text text-muted">View and upload minutes for Administrative Council.</p>
            <span class="btn btn-primary">Open</span>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-4">
      <a href="{{ route('minutes.list', 'board-meetings') }}" class="text-decoration-none">
        <div class="card card-hover h-100">
          <div class="card-body">
            <h5 class="card-title">Board Meeting Minutes</h5>
            <p class="card-text text-muted">View and upload minutes for Board Meetings.</p>
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
