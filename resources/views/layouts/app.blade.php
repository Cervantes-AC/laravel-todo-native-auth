<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Todo App')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Floating lanterns animation */
        body::before {
            content: '🏮';
            position: fixed;
            top: -50px;
            left: 10%;
            font-size: 3rem;
            animation: float 8s ease-in-out infinite;
            opacity: 0.6;
            z-index: 1;
        }

        body::after {
            content: '🏮';
            position: fixed;
            top: -50px;
            right: 15%;
            font-size: 2.5rem;
            animation: float 10s ease-in-out infinite 2s;
            opacity: 0.5;
            z-index: 1;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(100vh) rotate(180deg);
            }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .navbar {
            background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
            padding: 1.5rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(201, 41, 42, 0.4),
                        inset 0 2px 0 rgba(255, 215, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border: 3px solid #ffd700;
            position: relative;
        }

        .navbar::before {
            content: '✨';
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 1.5rem;
        }

        .navbar::after {
            content: '✨';
            position: absolute;
            top: -10px;
            right: 20px;
            font-size: 1.5rem;
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
            transition: all 0.3s;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid transparent;
        }

        .navbar-menu a:hover {
            background: rgba(255, 215, 0, 0.2);
            border-color: #ffd700;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }

        .logout-btn {
            background: linear-gradient(135deg, #8b0000 0%, #5a0000 100%);
            color: #ffd700 !important;
            border: 2px solid #ffd700;
            cursor: pointer;
            padding: 0.7rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s;
            font-weight: 600;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #5a0000 0%, #3a0000 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 0, 0, 0.5);
        }

        .content {
            background: linear-gradient(135deg, #ffffff 0%, #fff8dc 100%);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(201, 41, 42, 0.3);
            border: 3px solid #ffd700;
            position: relative;
        }

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

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            border-left: 5px solid;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #fff8dc 0%, #fffacd 100%);
            color: #8b4513;
            border-left-color: #ffd700;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
        }

        .alert-error {
            background: linear-gradient(135deg, #ffe4e1 0%, #ffcccb 100%);
            color: #8b0000;
            border-left-color: #dc143c;
            box-shadow: 0 5px 15px rgba(220, 20, 60, 0.2);
        }

        /* Decorative elements */
        .lantern-decoration {
            position: fixed;
            font-size: 4rem;
            opacity: 0.15;
            pointer-events: none;
            z-index: 1;
        }

        .lantern-top-left {
            top: 50px;
            left: 50px;
        }

        .lantern-top-right {
            top: 100px;
            right: 50px;
        }

        .lantern-bottom-left {
            bottom: 50px;
            left: 100px;
        }

        .lantern-bottom-right {
            bottom: 100px;
            right: 100px;
        }

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

            .lantern-decoration {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Decorative lanterns -->
    <div class="lantern-decoration lantern-top-left">🏮</div>
    <div class="lantern-decoration lantern-top-right">🏮</div>
    <div class="lantern-decoration lantern-bottom-left">🏮</div>
    <div class="lantern-decoration lantern-bottom-right">🏮</div>

    <div class="container">
        @if(session()->has('user_id'))
        <nav class="navbar">
            <div class="navbar-brand">🏮 Task Management</div>
            <div class="navbar-menu">
                <a href="{{ route('tasks.index') }}">🎋 Tasks</a>
                <a href="{{ route('profile.show') }}">👤 Profile</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
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