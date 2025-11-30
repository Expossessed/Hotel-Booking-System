<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                        url('https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg')
                        center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            width: 100%;
            max-width: 900px;
            min-height: 530px; /* FIXED HEIGHT — no movement */
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: 0px 8px 25px rgba(0,0,0,0.4);
            background: white;
        }

        .left-panel {
            background: url('https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg')
                       center/cover no-repeat;
            flex: 1;
        }

        .right-panel {
            flex: 1;
            padding: 50px 40px;
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd !important;
        }

        .hotel-title {
            font-family: 'Georgia', serif;
            font-weight: bold;
            color: #0d6efd;
        }

        /* Smooth fade but no movement */
        .tab-pane {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

@auth
<script> window.location.href = "{{ route('dashboard') }}"; </script>
@endauth

@guest
<div class="auth-card container">
    
    <!-- LEFT SIDE IMAGE -->
    <div class="left-panel d-none d-md-block"></div>

    <!-- RIGHT SIDE FORM -->
    <div class="right-panel">
        <h3 class="text-center hotel-title mb-2">Hotel Bookie</h3>
        <p class="text-center text-muted mb-4">Luxury • Comfort • Convenience</p>

        <!-- TAB BUTTONS -->
        <ul class="nav nav-pills mb-4 justify-content-center" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#login">Login</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#register">Register</button>
            </li>
        </ul>

        <!-- FIXED-SIZE TAB CONTENT (NO MOVEMENT) -->
        <div class="tab-content" style="min-height: 340px;">
            <!-- LOGIN -->
            <div class="tab-pane fade show active" id="login">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
            </div>

            <!-- REGISTER -->
            <div class="tab-pane fade" id="register">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <button class="btn btn-success w-100">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endguest

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
