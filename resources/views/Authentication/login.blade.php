<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bicol University | iFILMS Login</title>

  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <body>
        <!-- Header -->
        <header class="login-header">
            <div class="container d-flex align-items-center justify-content-start py-3">
            <img src="{{ asset('images/BU logo-trans.png') }}" alt="Bicol University Logo" class="bu-logo">
            <div class="ms-3">
                <h1><span class="bicol">BICOL</span> <span class="university">UNIVERSITY</span></h1>
                <p class="subtitle">OUBS Information and File Management System</p>
            </div>
            </div>
        </header>

        <!-- Main Login Section -->
        <main class="login-section">
            <div class="login-card">
            <!-- Left: Branding -->
            <div class="login-left">
                <div class="branding">
                <img src="{{ asset('images/BU logo-trans.png') }}" alt="BU Logo" class="branding-logo">
                <h1><span class="orange">iFiLMS</span></h1>
                <p>Centralized Web-Based <br> Information and File Management System</p>
                </div>
            </div>

            <!-- Right: Login Form -->
            <div class="login-right">
                <div class="form-wrapper">
                <h2>Access to the platform</h2>
                <p>Enter your details below</p>

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                    <input type="text" name="username" placeholder="Email or Username" required>
                    </div>

                    <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn-login">Log In</button>

                    <div class="text-end mt-3">
                    <a href="{{ route('staff.password.request') }}" class="forgot-link">Forgot Password?</a>
                    </div>

                    @if ($errors->any())
                    <div class="error-message" id="login-error-message" style="display:none;">
                        {{ $errors->first('error') }}
                    </div>
                    @endif
                </form>
                </div>
            </div>
            </div>
        </main>

        <!-- Unauthorized Modal -->
        <div class="modal-overlay" id="unauthorizedModal">
            <div class="modal-content">
            <h2>Access Denied</h2>
            <p>Authorized personnel only.</p>
            <button onclick="closeModal()">OK</button>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-container">
            <div class="footer-top">
                <div class="footer-left">
                <img src="{{ asset('images/BU logo-trans.png') }}" alt="BU Logo" class="footer-logo">
                <div class="footer-text">
                    <h3><span class="bicol">BICOL</span> <span class="university">UNIVERSITY</span></h3>
                    <p>Bicol University Office of the University and Board Secretary</p>
                </div>
                </div>
                <div class="footer-right">
                <p>📍 2F, Building, Bicol University Main Campus, Legazpi Philippines</p>
                <p>📞 (+63) 9510168807</p>
                <p>📧 bu.oubs@bicol-u.edu.ph</p>
                <p>🌐 www.bicol-u.edu.ph</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2025 Bicol University Office of the University and Board Secretary</p>
                <p>All Rights Reserved.</p>
            </div>
            </div>
        </footer>

        <!-- Modal Script -->
        <script>
            function closeModal() {
            document.getElementById('unauthorizedModal').style.display = 'none';
            }

            window.addEventListener('DOMContentLoaded', () => {
            const errorDiv = document.getElementById('login-error-message');
            if (errorDiv) {
                document.getElementById('unauthorizedModal').style.display = 'flex';
            }
            });
        </script>
    </body>
</html>
