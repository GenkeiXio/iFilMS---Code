<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset - iFiLMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px;
        }

        .email-header {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .email-footer {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #888;
        }

        .btn-reset {
            background-color: #0d6efd;
            color: #fff;
            padding: 10px 24px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-reset:hover {
            background-color: #084298;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <h2>Password Reset Request</h2>
        </div>

        <p>Hi,</p>
        <p>You requested to reset your password for your iFiLMS Staff account. Click the button below to proceed:</p>

        <a href="{{ url('/staff/reset-password/' . $token) }}" class="btn-reset">Reset Password</a>

        <p style="margin-top: 25px;">If you didn’t request this, you can safely ignore this email. Your password won’t be changed unless you click the button above and complete the process.</p>

        <div class="email-footer">
            &mdash; iFiLMS Team
        </div>
    </div>

</body>
</html>
