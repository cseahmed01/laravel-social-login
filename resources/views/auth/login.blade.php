<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Social Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e5e7eb;
        }
        .form-control {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .btn-primary {
            background: #3b82f6;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }
        .social-btn {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            background: white;
        }
        .social-btn:hover {
            border-color: #9ca3af;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .facebook-btn {
            color: #1877f2;
        }
        .google-btn {
            color: #ea4335;
        }
        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }
        .divider::before {
            margin-right: 12px;
        }
        .divider::after {
            margin-left: 12px;
        }
    </style>
</head>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="row w-100 justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-8">
                <div class="login-card p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="h3 fw-bold text-gray-900 mb-2">Welcome back</h1>
                        <p class="text-muted">Sign in to your account</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Sign in
                        </button>
                    </form>

                    <div class="divider">
                        <span class="text-muted small">or</span>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('auth.google') }}" class="social-btn google-btn text-center">
                            <i class="fab fa-google me-2"></i>Continue with Google
                        </a>
                        <a href="{{ route('auth.facebook') }}" class="social-btn facebook-btn text-center">
                            <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                        </a>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-decoration-none fw-medium" style="color: #3b82f6;">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>