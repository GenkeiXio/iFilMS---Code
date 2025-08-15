<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | iFiLMS</title>
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
            <h3 class="text-center mb-3">Reset Your Password</h3>

            <form method="POST" action="{{ route('staff.password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <input type="email" name="username" class="form-control" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="New Password" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn btn-custom w-100">Reset Password</button>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
