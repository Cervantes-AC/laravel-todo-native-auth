<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META TAGS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Lantern Aurora</title>

    <style>
        /* GLOBAL STYLING */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* FLOATING LANTERNS */
        .floating-lantern {
            position: absolute;
            font-size: 2.5rem;
            animation: floatUp 12s ease-in-out infinite;
            opacity: 0.3;
        }

        .lantern1 { left: 10%; animation-delay: 0s; }
        .lantern2 { left: 30%; animation-delay: 2s; }
        .lantern3 { right: 20%; animation-delay: 4s; }
        .lantern4 { right: 40%; animation-delay: 6s; }
        .lantern5 { left: 50%; animation-delay: 8s; }

        @keyframes floatUp {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10%, 90% { opacity: 0.3; }
            100% { transform: translateY(-50px) rotate(360deg); opacity: 0; }
        }

        /* LOGIN CONTAINER */
        .login-container {
            background: linear-gradient(135deg, #ffffff 0%, #fff8dc 100%);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 15px 50px rgba(201, 41, 42, 0.4);
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 10;
            border: 4px solid #ffd700;
        }

        /* HEADER */
        .login-container h2 {
            text-align: center;
            font-size: 2rem;
            color: #c9292a;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(201,41,42,0.2);
            position: relative;
        }

        .login-container h2::after {
            content: '🎋';
            display: block;
            font-size: 2rem;
            margin: 8px auto 0 auto;
        }

        /* FORM ELEMENTS */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #8b4513;
        }

        input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border-radius: 12px;
            border: 3px solid #ffd700;
            background: #fffaf0;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #c9292a;
            box-shadow: 0 0 0 4px rgba(201,41,42,0.1);
            background: #ffffff;
        }

        .error-text {
            font-size: 12px;
            color: #8b0000;
            margin-top: 5px;
            font-weight: bold;
        }

        /* LOGIN BUTTON */
        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 15px;
            border: 3px solid #ffd700;
            cursor: pointer;
            background: linear-gradient(135deg, #c9292a, #8b0000);
            color: #ffd700;
            transition: all 0.3s;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(201,41,42,0.5);
            background: linear-gradient(135deg, #8b0000, #5a0000);
        }

        /* REGISTER LINK */
        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #8b4513;
        }

        .register-link a {
            color: #c9292a;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media(max-width: 500px) {
            .login-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Lanterns -->
    <div class="floating-lantern lantern1">🏮</div>
    <div class="floating-lantern lantern2">🏮</div>
    <div class="floating-lantern lantern3">🏮</div>
    <div class="floating-lantern lantern4">🏮</div>
    <div class="floating-lantern lantern5">🏮</div>

    <!-- LOGIN CONTAINER -->
    <div class="login-container">
        <h2>Login</h2>

        <form action="/login" method="POST">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            Don’t have an account? <a href="/register">Register</a>
        </div>
    </div>

</body>
</html>
