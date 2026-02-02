<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Lantern Rite Tasks</title>
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

        /* Floating lanterns */
        .floating-lantern {
            position: absolute;
            font-size: 2.5rem;
            animation: float-up 10s ease-in-out infinite;
            opacity: 0.3;
        }

        .lantern-1 { left: 5%; animation-delay: 0s; }
        .lantern-2 { left: 25%; animation-delay: 2s; }
        .lantern-3 { right: 15%; animation-delay: 4s; }
        .lantern-4 { right: 35%; animation-delay: 6s; }
        .lantern-5 { left: 50%; animation-delay: 8s; }

        @keyframes float-up {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .register-container {
            background: linear-gradient(135deg, #ffffff 0%, #fff8dc 100%);
            padding: 2.5rem;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(201, 41, 42, 0.4);
            width: 100%;
            max-width: 480px;
            border: 4px solid #ffd700;
            position: relative;
            z-index: 10;
        }

        .register-container::before {
            content: '🎊';
            position: absolute;
            top: -25px;
            left: 30px;
            font-size: 2.5rem;
        }

        .register-container::after {
            content: '🎊';
            position: absolute;
            top: -25px;
            right: 30px;
            font-size: 2.5rem;
        }

        .register-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .register-header h1 {
            color: #c9292a;
            font-size: 2.3rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(201, 41, 42, 0.2);
        }

        .register-header p {
            color: #8b4513;
            font-size: 1rem;
        }

        .chinese-greeting {
            text-align: center;
            color: #ffd700;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
            padding: 0.7rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(201, 41, 42, 0.3);
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            color: #8b4513;
            font-weight: 600;
            font-size: 1rem;
        }

        input {
            width: 100%;
            padding: 0.9rem;
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
            padding: 1.1rem;
            background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
            color: #ffd700;
            border: 3px solid #ffd700;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            margin-top: 1rem;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(201, 41, 42, 0.5);
            background: linear-gradient(135deg, #8b0000 0%, #5a0000 100%);
        }

        .login-link {
            text-align: center;
            margin-top: 1.2rem;
            color: #8b4513;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #c9292a;
            text-decoration: none;
            font-weight: bold;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .login-link a:hover {
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

        .decoration-corner {
            position: absolute;
            font-size: 1.5rem;
            opacity: 0.3;
        }

        .corner-tl { top: 10px; left: 10px; }
        .corner-tr { top: 10px; right: 10px; }
        .corner-bl { bottom: 10px; left: 10px; }
        .corner-br { bottom: 10px; right: 10px; }
    </style>
</head>
<body>
    <!-- Floating lanterns -->
    <div class="floating-lantern lantern-1">🏮</div>
    <div class="floating-lantern lantern-2">🏮</div>
    <div class="floating-lantern lantern-3">🏮</div>
    <div class="floating-lantern lantern-4">🏮</div>
    <div class="floating-lantern lantern-5">🏮</div>

    <div class="register-container">
        <!-- Decorative corners -->
        <div class="decoration-corner corner-tl">🎋</div>
        <div class="decoration-corner corner-tr">🎋</div>
        <div class="decoration-corner corner-bl">🎋</div>
        <div class="decoration-corner corner-br">🎋</div>

        <div class="register-header">
            <h1>Shark-AC</h1>
            <p>Join the Lantern Rite Festival</p>
        </div>

        <div class="chinese-greeting">
            🎉 Registration 🎉
        </div>

        @if(session('success'))
            <div class="alert alert-success">✨ {{ session('success') }}</div>
        @endif

        <form action="/register" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">👤 Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter your name">
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">📧 Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">🔒 Password</label>
                <input type="password" id="password" name="password" required placeholder="Minimum 6 characters">
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">🔐 Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Re-enter your password">
            </div>

            <button type="submit" class="submit-btn">🎊 Create Account 🎊</button>
        </form>

        <div class="login-link">
            Already registered? <a href="/login">🏮 Login</a>
        </div>
    </div>
</body>
</html>