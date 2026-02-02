@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<style>
    .profile-header {
        text-align: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 3px solid #667eea;
    }

    .profile-header h1 {
        color: #333;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        margin: 0 auto 1rem;
    }

    .profile-form {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-section {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .form-section h2 {
        color: #667eea;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #333;
        font-weight: 600;
    }

    input {
        width: 100%;
        padding: 0.9rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .error-text {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 0.3rem;
    }

    .update-btn {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .update-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .help-text {
        font-size: 0.85rem;
        color: #666;
        margin-top: 0.3rem;
    }
</style>

<div class="profile-header">
    <div class="profile-avatar">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
    <h1>My Profile</h1>
    <p style="color: #666;">Manage your account information</p>
</div>

<div class="profile-form">
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div class="form-section">
            <h2>📋 Basic Information</h2>
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-section">
            <h2>🔒 Change Password</h2>
            <p class="help-text" style="margin-bottom: 1rem;">Leave blank if you don't want to change your password</p>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password">
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
                <div class="help-text">Minimum 6 characters</div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>
        </div>

        <button type="submit" class="update-btn">💾 Update Profile</button>
    </form>
</div>
@endsection