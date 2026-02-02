@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<style>
    .profile-header {
        text-align: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 3px solid #ffd700;
    }

    .profile-avatar {
        width: 140px;
        height: 140px;
        background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: #ffd700;
        margin: 0 auto 1.5rem;
        border: 5px solid #ffd700;
        box-shadow: 0 10px 30px rgba(201, 41, 42, 0.3);
        position: relative;
        overflow: hidden;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.3s;
    }

    .profile-avatar:hover img {
        transform: scale(1.05);
    }

    .profile-avatar::before {
        content: '✨';
        position: absolute;
        top: -10px;
        right: 10px;
        font-size: 2rem;
    }

    .profile-header h1 {
        color: #c9292a;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(201, 41, 42, 0.1);
    }

    .profile-header p {
        color: #8b4513;
        font-size: 1.1rem;
    }

    .profile-form {
        max-width: 700px;
        margin: 0 auto;
    }

    .form-section {
        background: linear-gradient(135deg, #fffaf0 0%, #fff8dc 100%);
        padding: 2.5rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        border: 4px solid #ffd700;
        box-shadow: 0 10px 30px rgba(201, 41, 42, 0.2);
        position: relative;
    }

    .form-section::before {
        content: '🏮';
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 2rem;
        opacity: 0.2;
    }

    .form-section h2 {
        color: #c9292a;
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
        text-shadow: 1px 1px 2px rgba(201, 41, 42, 0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #8b4513;
        font-weight: 700;
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

    .update-btn {
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

    .update-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(201, 41, 42, 0.4);
        background: linear-gradient(135deg, #8b0000 0%, #5a0000 100%);
    }

    .help-text {
        font-size: 0.9rem;
        color: #b8860b;
        margin-top: 0.5rem;
        font-style: italic;
    }

    .section-divider {
        background: linear-gradient(135deg, #fff8dc 0%, #fffacd 100%);
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        border-left: 5px solid #ffd700;
        color: #8b4513;
        font-weight: 600;
    }
</style>
<div class="profile-header">
    <div class="profile-avatar">
        {{-- Show user's avatar if exists, otherwise show a placeholder icon --}}
        <img id="avatarPreview" 
             src="{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}" 
             alt="{{ $user->name }}'s Avatar">
    </div>

    <h1>My Profile</h1>
    <p>Manage your Account</p>
</div>

<div class="profile-form">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Profile Image Upload -->
        <div class="form-section">
            <h2>🖼 Profile Image</h2>
            <div class="form-group">
                <label for="avatar">Upload Profile Image</label>
                <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)">
                @error('avatar')
                    <div class="error-text">{{ $message }}</div>
                @enderror
                <div class="help-text">Choose a new profile picture (optional)</div>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="form-section">
            <h2>📋 Basic Information</h2>
            <div class="form-group">
                <label for="name">👤 Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">📧 Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Change Password -->
        <div class="form-section">
            <h2>🔒 Change Password</h2>
            <div class="section-divider">💡 Leave blank to keep current password</div>

            <div class="form-group">
                <label for="password">🔑 New Password</label>
                <input type="password" id="password" name="password">
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
                <div class="help-text">Minimum 6 characters</div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">🔐 Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
                <div class="help-text">Re-enter your new password</div>
            </div>
        </div>

        <button type="submit" class="update-btn">💾 Update Profile</button>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('avatarPreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection