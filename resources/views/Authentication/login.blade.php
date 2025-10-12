<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bicol University | iFILMS Login</title>

  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
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

                    <!-- Username -->
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Email or Username" required>
                    </div>

                    <!-- Password with Eye Icon -->
                        <div class="form-group" style="position: relative;">
                        <input 
                            type="password" 
                            id="passwordInput" 
                            name="password" 
                            placeholder="Password" 
                            required
                            style="width: 100%; padding-right: 40px;"
                        >
                        <button 
                            type="button" 
                            id="togglePassword" 
                            style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: none; border: none; cursor: pointer;"
                        >
                            <i data-lucide="eye" class="text-muted"></i>
                        </button>
                        </div>

                    <!-- Submit -->
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

        <footer class="footer">
            <div class="footer-container" style="max-width: 1400px; margin: 0 auto; padding: 0 60px;">
                <div class="footer-top" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
                    <div class="footer-left" style="display: flex; align-items: center; gap: 15px;">
                        <img src="{{ asset('images/BU logo-trans.png') }}" alt="BU Logo" class="footer-logo" style="width: 60px; height: auto;">
                        <div class="footer-text">
                        <h4><span class="bicol">BICOL</span> <span class="university">UNIVERSITY</span></h4>
                        <p>Bicol University Office of the University and Board Secretary</p>
                        </div>
                    </div>

                    <div class="footer-right" style="text-align: right;">
                        <p>📍 2F, Building, Bicol University Main Campus, Legazpi Philippines</p>
                        <p>📞 (+63) 9510168807</p>
                        <p>📧 bu.oubs@bicol-u.edu.ph</p>
                        <p>🌐 www.bicol-u.edu.ph</p>
                    </div>
                </div>

                <hr style="margin: 15px 0; border: 0; border-top: 1px solid #ddd;">

                <div class="footer-bottom" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <p style="margin: 0;">© 2025 Bicol University Office of the University and Board Secretary</p>
                    <p style="margin: 0;">All Rights Reserved.</p>
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
            document.addEventListener("DOMContentLoaded", function () {
                lucide.createIcons(); // Initialize icons

                const passwordInput = document.getElementById("passwordInput");
                const toggleButton = document.getElementById("togglePassword");

                toggleButton.addEventListener("click", function () {
                    const iconName = passwordInput.type === "password" ? "eye-off" : "eye";

                    // Toggle password visibility
                    passwordInput.type = passwordInput.type === "password" ? "text" : "password";

                    // Update icon visually
                    toggleButton.innerHTML = `<i data-lucide="${iconName}" class="text-muted"></i>`;
                    lucide.createIcons();

                    // Optional: add color feedback
                    if (passwordInput.type === "text") {
                    toggleButton.querySelector("svg").style.color = "#007bff"; // blue when visible
                    }
                });
            });
        </script>
    </body>
</html>
