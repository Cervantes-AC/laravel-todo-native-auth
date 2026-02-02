<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META CONFIGURATION -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Todo App')</title>

    <style>
        /* GLOBAL RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* FLOATING CIRCLES AS BACKGROUND DECOR */
        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            animation: float 25s infinite linear;
            z-index: 1;
        }

        .circle1 { width: 300px; height: 300px; background: #ff7e5f; top: -50px; left: -50px; }
        .circle2 { width: 200px; height: 200px; background: #feb47b; bottom: -50px; right: -50px; animation-delay: 5s; }
        .circle3 { width: 150px; height: 150px; background: #ff7e5f; top: 20%; right: 10%; animation-delay: 3s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        /* CONTAINER FOR PAGE CONTENT */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* NAVBAR */
        .navbar {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border: 2px solid rgba(255,215,0,0.4);
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: #ffd700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .navbar-menu a {
            color: #ffd700;
            text-decoration: none;
            padding: 0.7rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .navbar-menu a:hover {
            background: rgba(255, 215, 0, 0.2);
            border-color: #ffd700;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }

        .logout-btn {
            background: linear-gradient(135deg, #8b0000, #5a0000);
            color: #ffd700 !important;
            border: 2px solid #ffd700;
            cursor: pointer;
            padding: 0.7rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #5a0000, #3a0000);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 0, 0, 0.5);
        }

        /* CONTENT CARD */
        .content {
            background: rgba(255,255,255,0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.3);
            border: 2px solid #ffd700;
            position: relative;
        }

        /* Decorative corners */
        .content::before {
            content: '🎋';
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 2rem;
            opacity: 0.3;
        }

        .content::after {
            content: '🎋';
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 2rem;
            opacity: 0.3;
        }

        /* ALERT MESSAGES */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            border-left: 5px solid;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #fff8dc, #fffacd);
            color: #8b4513;
            border-left-color: #ffd700;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
        }

        .alert-error {
            background: linear-gradient(135deg, #ffe4e1, #ffcccb);
            color: #8b0000;
            border-left-color: #dc143c;
            box-shadow: 0 5px 15px rgba(220, 20, 60, 0.2);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            .navbar-menu {
                flex-direction: column;
                width: 100%;
            }
            .navbar-menu a {
                width: 100%;
                text-align: center;
            }
            .circle {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Floating decorative circles -->
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="circle circle3"></div>

    <div class="container">
        @if(session()->has('user_id'))
            <nav class="navbar">
                <div class="navbar-brand">🏮 Task Management</div>
                <div class="navbar-menu">
                    <a href="{{ route('tasks.index') }}">🎋 Tasks</a>
                    <a href="{{ route('profile.show') }}">👤 Profile</a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-btn">🚪Logout</button>
                    </form>
                </div>
            </nav>
        @endif

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">✨ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">⚠️ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
