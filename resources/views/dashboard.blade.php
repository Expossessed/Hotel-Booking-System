<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Bookie | Dashboard</title>

    <!-- Bootstrap for consistency with login/register -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0,0,0,0.7)),
                        url('https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg')
                        center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: "Segoe UI", sans-serif;
        }

        .dashboard-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 60px;
            border-radius: 20px;
            backdrop-filter: blur(8px);
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.5);
            max-width: 700px;
        }

        .hotel-title {
            font-family: "Georgia", serif;
            font-weight: bold;
            font-size: 55px;
            letter-spacing: 2px;
            color: #ffffff;
        }

        .dashboard-btn {
            padding: 12px 40px;
            font-size: 18px;
            border-radius: 30px;
            font-weight: 600;
            border: none;
            backdrop-filter: blur(6px);
            transition: all 0.3s ease;
        }

        .dashboard-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }

        p {
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="dashboard-box">
    <h1 class="hotel-title">Hotel Bookie</h1>

    <p class="mt-3 mb-4">
        Welcome to your dashboard!  
        Your stay begins here — where comfort meets convenience.
    </p>

    <a href="{{ auth()->user()->isAdmin() ? route('admin.front') : route('rooms.list') }}"
       class="btn btn-light dashboard-btn">
        Explore Rooms
    </a>
</div>

</body>
</html>
