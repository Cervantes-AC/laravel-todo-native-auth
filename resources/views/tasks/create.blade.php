@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<style>
    .create-header {
        text-align: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 3px solid #ffd700;
    }

    .create-header h1 {
        color: #c9292a;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(201, 41, 42, 0.1);
    }

    .create-header p {
        color: #8b4513;
        font-size: 1.1rem;
    }

    .task-form {
        max-width: 750px;
        margin: 0 auto;
        background: linear-gradient(135deg, #fffaf0 0%, #fff8dc 100%);
        padding: 2.5rem;
        border-radius: 20px;
        border: 4px solid #ffd700;
        box-shadow: 0 10px 30px rgba(201, 41, 42, 0.2);
        position: relative;
    }

    .task-form::before {
        content: '🎋';
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 2rem;
        opacity: 0.2;
    }

    .task-form::after {
        content: '🎋';
        position: absolute;
        bottom: 20px;
        right: 20px;
        font-size: 2rem;
        opacity: 0.2;
    }

    .form-group {
        margin-bottom: 1.8rem;
    }

    label {
        display: block;
        margin-bottom: 0.6rem;
        color: #8b4513;
        font-weight: 700;
        font-size: 1.2rem;
    }

    input, textarea {
        width: 100%;
        padding: 1.1rem;
        border: 3px solid #ffd700;
        border-radius: 15px;
        font-size: 1.05rem;
        font-family: inherit;
        transition: all 0.3s;
        background: #fffaf0;
    }

    textarea {
        min-height: 180px;
        resize: vertical;
    }

    input:focus, textarea:focus {
        outline: none;
        border-color: #c9292a;
        box-shadow: 0 0 0 4px rgba(201, 41, 42, 0.1);
        background: #ffffff;
    }

    input::placeholder, textarea::placeholder {
        color: #b8860b;
        opacity: 0.7;
    }

    .error-text {
        color: #8b0000;
        font-size: 0.9rem;
        margin-top: 0.5rem;
        font-weight: bold;
    }

    .form-actions {
        display: flex;
        gap: 1.2rem;
        margin-top: 2.5rem;
    }

    .submit-btn, .cancel-btn {
        flex: 1;
        padding: 1.2rem;
        border: 3px solid;
        border-radius: 15px;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .submit-btn {
        background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
        color: #ffd700;
        border-color: #ffd700;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(201, 41, 42, 0.4);
        background: linear-gradient(135deg, #8b0000 0%, #5a0000 100%);
    }

    .cancel-btn {
        background: linear-gradient(135deg, #8b4513 0%, #654321 100%);
        color: #ffd700;
        border-color: #b8860b;
    }

    .cancel-btn:hover {
        background: linear-gradient(135deg, #654321 0%, #4a3319 100%);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(139, 69, 19, 0.4);
    }

    .helper-text {
        display: block;
        margin-top: 0.5rem;
        color: #b8860b;
        font-size: 0.9rem;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .form-actions {
            flex-direction: column;
        }

        .submit-btn, .cancel-btn {
            width: 100%;
        }
    }
</style>

<div class="create-header">
    <h1>✨ Create New Task</h1>
    <p>Create New Lantern Rite Task</p>
</div>

<div class="task-form">
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">🏮 Task Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" 
                   placeholder="Complete lantern decorations" required>
            @error('title')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <span class="helper-text">Give your task a clear and descriptive name</span>
        </div>

        <div class="form-group">
            <label for="description">📝 Description (Optional)</label>
            <textarea id="description" name="description" 
                      placeholder="... Add more details about your task...">{{ old('description') }}</textarea>
            @error('description')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <span class="helper-text">Describe the specific content and requirements of the task</span>
        </div>

        <div class="form-actions">
            <button type="submit" class="submit-btn">🎊 Create Task</button>
            <a href="{{ route('tasks.index') }}" class="cancel-btn">❌Cancel</a>
        </div>
    </form>
</div>
@endsection