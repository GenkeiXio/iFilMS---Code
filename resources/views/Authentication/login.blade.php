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
                        <h1><span class="orange">iFilMS</span></h1>
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
                            <input type="password" id="passwordInput" name="password" placeholder="Password" requiredstyle="width: 100%; padding-right: 40px;">
                                <button 
                                    type="button" id="togglePassword" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
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

        <!-- Enhanced Login Success Modal -->
        <!--SUCCESS MODAL -->
        <div class="modal-overlay" id="successModal">
            <div class="modal-content success-modal">
                <div class="checkmark-wrapper">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14 27l7 7 16-16"/>
                    </svg>
                </div>
                <h2>Access Granted</h2>
                <p class="redirect-text">Redirecting to your dashboard
                <span class="dots"><span>.</span><span>.</span><span>.</span></span>
                </p>
                <div class="spinner"></div>
            </div>
        </div>

        <!-- ACCESS DENIED MODAL -->
        <div class="modal-overlay" id="unauthorizedModal">
            <div class="modal-content error-modal">
                <div class="error-wrapper">
                    <svg class="error-mark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="error-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="error-cross" d="M16 16 36 36 M36 16 16 36"/>
                    </svg>
                </div>
                <h2>Access Denied</h2>
                <p>Authorized personnel only.</p>
                <button onclick="closeModal()">OK</button>
            </div>
        </div>

        <!-- ACCOUNT INACTIVE MODAL -->
        <div class="modal-overlay" id="inactiveModal">
            <div class="modal-content error-modal">
                <div class="error-wrapper">
                <svg class="error-mark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="error-circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="error-cross" d="M16 16 36 36 M36 16 16 36"/>
                </svg>
                </div>
                <h2>Account Inactive</h2>
                <p>Your account is inactive.<br>Please contact the administrator.</p>
                <button onclick="closeInactiveModal()">OK</button>
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

            document.addEventListener("DOMContentLoaded", function () {
                lucide.createIcons();

                // ===== Password Toggle (UNCHANGED) =====
                const passwordInput = document.getElementById("passwordInput");
                const toggleButton = document.getElementById("togglePassword");

                toggleButton.innerHTML = `<i data-lucide="eye-off" class="text-muted"></i>`;
                lucide.createIcons();

                toggleButton.addEventListener("click", function () {
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        toggleButton.innerHTML = `<i data-lucide="eye" class="text-muted"></i>`;
                    } else {
                        passwordInput.type = "password";
                        toggleButton.innerHTML = `<i data-lucide="eye-off" class="text-muted"></i>`;
                    }

                    lucide.createIcons();
                });

                /* =====================================================
                ACCESS DENIED MODAL (SESSION-BASED)
                ====================================================== */
                @if(session('access_denied'))
                    const deniedModal = document.getElementById('unauthorizedModal');
                    deniedModal.style.display = 'flex';

                    deniedModal.querySelector('.modal-content')
                        .style.animation = 'shake 0.4s ease, fadeIn 0.4s ease';

                    deniedModal.querySelector('p').innerText =
                        "{{ session('message') ?? 'Authorized personnel only.' }}";
                @endif


                /* =====================================================
                ACCESS GRANTED MODAL (ADMIN / STAFF)
                ====================================================== */
                @if(session('access_granted'))
                    const successModal = document.getElementById('successModal');
                    successModal.style.display = 'flex';
                    successModal.style.animation = 'fadeIn 0.4s ease forwards';

                    //Dynamic text
                    successModal.querySelector('h2').innerText =
                        "{{ session('message') ?? 'Access Granted' }}";

                    // Fade out animation
                    setTimeout(() => {
                        successModal.style.animation = 'fadeOut 0.6s ease forwards';
                    }, 1800);

                    // Role-based redirect
                    setTimeout(() => {
                        @if(session('role') === 'admin')
                            window.location.href = "{{ route('admin.admindashboard') }}";
                        @else
                            window.location.href = "{{ route('dashboard') }}";
                        @endif
                    }, 2400);
                @endif
            });
            function closeInactiveModal() {
                document.getElementById('inactiveModal').style.display = 'none';
            }

            @if(session('account_inactive'))
                const inactiveModal = document.getElementById('inactiveModal');
                inactiveModal.style.display = 'flex';

                inactiveModal.querySelector('.modal-content')
                    .style.animation = 'shake 0.4s ease, fadeIn 0.4s ease';
            @endif
        </script>
    </body>
</html>
