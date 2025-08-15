<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iFilMS LogIn</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Link to your external CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo-wrapper">
                <img src="{{ asset('images/BU logo-trans.png') }}" alt="Bicol University Logo" class="logo">
                <div class="text-group">
                    <h1>
                        <span class="bicol">BICOL</span> <span class="university">UNIVERSITY</span>
                    </h1>
                    <p>Information and File Management System</p>
                </div>
            </div>
        </div>
    </header>

    <main class="login-main">
        <div class="login-container">
            <div class="login-left">
                <div class="branding">
                    <img src="{{ asset('images/BU logo-trans.png') }}" alt="Bicol University Logo" class="logo">
                    <h1><span style="color: #f7941e;">iFiLMS</span></h1>
                    <p>Centralized Web-Based <br>Information and File Management System</p>
                </div>
            </div>

            <div class="login-right">
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
                    <button type="submit" class="login-btn">Log In</button>

                    <div class="text-end mt-2">
                        <a href="{{ route('staff.password.request') }}" class="text-decoration-none text-primary">Forgot Password?</a>
                    </div>

                    @if ($errors->any())
                        <div class="error-message" id="login-error-message" style="display:none;">
                            {{ $errors->first('error') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </main>

    <!-- Modal Alert -->
    <div class="modal-overlay" id="unauthorizedModal">
        <div class="modal-content">
            <h2>Access Denied</h2>
            <p>Authorized personnel Only.</p>
            <button onclick="closeModal()">OK</button>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-top">
            <div class="footer-left">
                <img src="{{ asset('images/BU logo-trans.png') }}" alt="BU Logo" class="footer-logo">
                <div class="footer-brand">
                <h2>BICOL UNIVERSITY</h2>
                <p>Bicol University Office of the<br>University and Board Secretary</p>
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
            <p>© 2025 Bicol University Office of University and Board Secretary</p>
            <p>All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
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
