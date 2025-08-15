<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | iFiLMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            border-radius: 1rem;
            max-width: 500px;
            width: 100%;
        }
        .form-control {
            border-radius: .5rem;
        }
        .btn-custom {
            background-color: #f7941e;
            color: white;
            border-radius: .5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow p-4">
            <h3 class="text-center mb-3">Forgot Password</h3>
            <p class="text-center">Enter your email to receive a reset link</p>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('staff.password.email') }}">
                @csrf
                <div class="mb-3">
                    <input type="email" name="username" class="form-control" placeholder="Email Address" required>
                </div>
                <button type="submit" class="btn btn-custom w-100">Send Reset Link</button>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
