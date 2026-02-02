@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<style>
    .edit-header {
        text-align: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 3px solid #ffd700;
    }

    .edit-header h1 {
        color: #c9292a;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(201, 41, 42, 0.1);
    }

    .edit-header p {
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

    .error-text {
        color: #8b0000;
        font-size: 0.9rem;
        margin-top: 0.5rem;
        font-weight: bold;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #fff8dc 0%, #fffacd 100%);
        border-radius: 15px;
        border: 3px solid #ffd700;
    }

    .checkbox-group input[type="checkbox"] {
        width: 30px;
        height: 30px;
        cursor: pointer;
    }

    .checkbox-group label {
        margin: 0;
        cursor: pointer;
        font-size: 1.1rem;
        color: #8b4513;
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
    }

    .cancel-btn {
        background: linear-gradient(135deg, #8b4513 0%, #654321 100%);
        color: #ffd700;
        border-color: #b8860b;
    }

    .cancel-btn:hover {
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
</style>

<div class="edit-header">
    <h1>✏️ Edit Task</h1>
    <p>Edit Your Lantern Rite Task</p>
</div>

<div class="task-form">
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">🏮 Task Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required>
            @error('title')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <span class="helper-text">Update your task title</span>
        </div>

        <div class="form-group">
            <label for="description">📝 Description</label>
            <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <span class="helper-text">Add or modify task details</span>
        </div>

        <div class="form-group">
            <label>✅ Task Status</label>
            <div class="checkbox-group">
                <input type="checkbox" id="completed" name="completed" value="1" 
                       {{ $task->completed ? 'checked' : '' }}>
                <label for="completed">Mark as completed</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="submit-btn">💾 Update</button>
            <a href="{{ route('tasks.index') }}" class="cancel-btn">❌  Cancel</a>
        </div>
    </form>
</div>
@endsection