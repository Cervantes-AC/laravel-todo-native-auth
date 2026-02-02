<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lantern Rite Tasks</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated floating lanterns */
        .floating-lantern {
            position: absolute;
            font-size: 3rem;
            animation: float-up 12s ease-in-out infinite;
            opacity: 0.4;
        }

        .lantern-1 { left: 10%; animation-delay: 0s; }
        .lantern-2 { left: 30%; animation-delay: 3s; }
        .lantern-3 { right: 20%; animation-delay: 6s; }
        .lantern-4 { right: 40%; animation-delay: 9s; }

        @keyframes float-up {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.4;
            }
            90% {
                opacity: 0.4;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Sparkle effect */
        .sparkle {
            position: absolute;
            font-size: 1.5rem;
            animation: sparkle 3s ease-in-out infinite;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0); }
            50% { opacity: 1; transform: scale(1); }
        }

        .sparkle-1 { top: 10%; left: 15%; animation-delay: 0s; }
        .sparkle-2 { top: 20%; right: 20%; animation-delay: 1s; }
        .sparkle-3 { bottom: 15%; left: 25%; animation-delay: 2s; }
        .sparkle-4 { bottom: 25%; right: 15%; animation-delay: 1.5s; }

        .login-container {
            background: linear-gradient(135deg, #ffffff 0%, #fff8dc 100%);
            padding: 3rem;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(201, 41, 42, 0.4);
            width: 100%;
            max-width: 450px;
            border: 4px solid #ffd700;
            position: relative;
            z-index: 10;
        }

        .login-container::before {
            content: '🏮';
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 3rem;
            animation: swing 3s ease-in-out infinite;
        }

        @keyframes swing {
            0%, 100% { transform: translateX(-50%) rotate(-5deg); }
            50% { transform: translateX(-50%) rotate(5deg); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
            margin-top: 1rem;
        }

        .login-header h1 {
            color: #c9292a;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(201, 41, 42, 0.2);
        }

        .login-header p {
            color: #8b4513;
            font-size: 1.1rem;
        }

        .chinese-greeting {
            text-align: center;
            color: #ffd700;
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
            padding: 0.8rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(201, 41, 42, 0.3);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #8b4513;
            font-weight: 600;
            font-size: 1.1rem;
        }

        input {
            width: 100%;
            padding: 1rem;
            border: 3px solid #ffd700;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #fffaf0;
        }

        input:focus {
            outline: none;
            border-color: #c9292a;
            box-shadow: 0 0 0 4px rgba(201, 41, 42, 0.1);
            background: #ffffff;
        }

        .error-text {
            color: #8b0000;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            font-weight: bold;
        }

        .submit-btn {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
            color: #ffd700;
            border: 3px solid #ffd700;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(201, 41, 42, 0.5);
            background: linear-gradient(135deg, #8b0000 0%, #5a0000 100%);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #8b4513;
            font-size: 1rem;
        }

        .register-link a {
            color: #c9292a;
            text-decoration: none;
            font-weight: bold;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .register-link a:hover {
            color: #8b0000;
            border-bottom-color: #8b0000;
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-weight: 500;
            border-left: 5px solid;
        }

        .alert-success {
            background: linear-gradient(135deg, #fff8dc 0%, #fffacd 100%);
            color: #8b4513;
            border-left-color: #ffd700;
        }

        .alert-error {
            background: linear-gradient(135deg, #ffe4e1 0%, #ffcccb 100%);
            color: #8b0000;
            border-left-color: #dc143c;
        }

        .decoration-corner {
            position: absolute;
            font-size: 2rem;
            opacity: 0.3;
        }

        .corner-tl { top: 15px; left: 15px; }
        .corner-tr { top: 15px; right: 15px; }
        .corner-bl { bottom: 15px; left: 15px; }
        .corner-br { bottom: 15px; right: 15px; }
    </style>
</head>
<body>
    <!-- Floating lanterns -->
    <div class="floating-lantern lantern-1">🏮</div>
    <div class="floating-lantern lantern-2">🏮</div>
    <div class="floating-lantern lantern-3">🏮</div>
    <div class="floating-lantern lantern-4">🏮</div>

    <!-- Sparkles -->
    <div class="sparkle sparkle-1">✨</div>
    <div class="sparkle sparkle-2">✨</div>
    <div class="sparkle sparkle-3">✨</div>
    <div class="sparkle sparkle-4">✨</div>

    <div class="login-container">
        <!-- Decorative corners -->
        <div class="decoration-corner corner-tl">🎋</div>
        <div class="decoration-corner corner-tr">🎋</div>
        <div class="decoration-corner corner-bl">🎋</div>
        <div class="decoration-corner corner-br">🎋</div>

        <div class="login-header">
            <h1>Shark-AC</h1>
            <p>Welcome Back to Lantern Rite</p>
        </div>

        <div class="chinese-greeting">
            🏮 Log-In 🏮
        </div>

        @if(session('success'))
            <div class="alert alert-success">✨ {{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">⚠️ {{ session('error') }}</div>
        @endif

        <form action="/login" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">📧 Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">🔒 Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-btn">🎊 Enter 🎊</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="/register">🎉 Register</a>
        </div>
    </div>
</body>
</html>