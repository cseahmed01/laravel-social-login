<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Social Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
        }
        .btn-logout {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }
        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#" style="color: #667eea;">
                <i class="fas fa-shield-alt me-2"></i>Social Login
            </a>

            <div class="d-flex align-items-center">
                <span class="me-3 text-muted">Welcome, {{ Auth::user()->name }}!</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <!-- Welcome Section -->
        <div class="welcome-section dashboard-card">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">Welcome to Your Dashboard</h1>
                    <p class="lead mb-0">You have successfully logged in. Explore your personalized dashboard and manage your account settings.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <h5>{{ Auth::user()->name }}</h5>
                    <p class="mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Account Information -->
            <div class="col-lg-8 mb-4">
                <div class="dashboard-card p-4">
                    <h3 class="fw-bold mb-4">
                        <i class="fas fa-user-circle me-2" style="color: #667eea;"></i>Account Information
                    </h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded">
                                <h6 class="text-muted mb-1">Full Name</h6>
                                <p class="mb-0 fw-semibold">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded">
                                <h6 class="text-muted mb-1">Email Address</h6>
                                <p class="mb-0 fw-semibold">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded">
                                <h6 class="text-muted mb-1">Registration Date</h6>
                                <p class="mb-0 fw-semibold">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 border rounded">
                                <h6 class="text-muted mb-1">Login Method</h6>
                                <p class="mb-0 fw-semibold">
                                    @if(Auth::user()->provider)
                                        <span class="badge bg-primary">{{ ucfirst(Auth::user()->provider) }}</span>
                                    @else
                                        <span class="badge bg-secondary">Email & Password</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="col-lg-4 mb-4">
                <div class="dashboard-card p-4">
                    <h4 class="fw-bold mb-4">
                        <i class="fas fa-chart-line me-2" style="color: #667eea;"></i>Quick Stats
                    </h4>

                    <div class="stat-card mb-3">
                        <i class="fas fa-calendar-check fa-2x mb-2"></i>
                        <h4 class="mb-1">{{ Auth::user()->created_at->diffInDays(now()) }}</h4>
                        <p class="mb-0">Days with us</p>
                    </div>

                    <div class="stat-card">
                        <i class="fas fa-shield-alt fa-2x mb-2"></i>
                        <h4 class="mb-1">Secure</h4>
                        <p class="mb-0">Account Status</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="dashboard-card p-4">
            <h3 class="fw-bold mb-4">
                <i class="fas fa-history me-2" style="color: #667eea;"></i>Recent Activity
            </h3>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="p-3 border rounded text-center">
                        <i class="fas fa-sign-in-alt fa-2x mb-2" style="color: #28a745;"></i>
                        <h6>Last Login</h6>
                        <p class="text-muted mb-0">{{ now()->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="p-3 border rounded text-center">
                        <i class="fas fa-user-plus fa-2x mb-2" style="color: #007bff;"></i>
                        <h6>Account Created</h6>
                        <p class="text-muted mb-0">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="p-3 border rounded text-center">
                        <i class="fas fa-lock fa-2x mb-2" style="color: #6c757d;"></i>
                        <h6>Security Status</h6>
                        <p class="text-muted mb-0">Protected</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>