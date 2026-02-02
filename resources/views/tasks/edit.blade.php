@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<style>
    .edit-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .edit-header h1 {
        color: #333;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .task-form {
        max-width: 700px;
        margin: 0 auto;
        background: #f8f9fa;
        padding: 2.5rem;
        border-radius: 15px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #333;
        font-weight: 600;
        font-size: 1.1rem;
    }

    input, textarea {
        width: 100%;
        padding: 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s;
    }

    textarea {
        min-height: 150px;
        resize: vertical;
    }

    input:focus, textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 1rem;
        background: white;
        border-radius: 10px;
    }

    .checkbox-group input[type="checkbox"] {
        width: 25px;
        height: 25px;
        cursor: pointer;
    }

    .checkbox-group label {
        margin: 0;
        cursor: pointer;
    }

    .error-text {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .submit-btn, .cancel-btn {
        flex: 1;
        padding: 1rem;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: transform 0.2s;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .submit-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .cancel-btn {
        background: #6c757d;
        color: white;
    }

    .cancel-btn:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
</style>

<div class="edit-header">
    <h1>✏ Edit Task</h1>
    <p style="color: #666;">Update your task details</p>
</div>

<div class="task-form">
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">📌 Task Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" 
                   placeholder="Enter task title..." required>
            @error('title')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">📝 Description (Optional)</label>
            <textarea id="description" name="description" 
                      placeholder="Add more details about your task...">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Task Status</label>
            <div class="checkbox-group">
                <input type="checkbox" id="completed" name="completed" value="1" 
                       {{ $task->completed ? 'checked' : '' }}>
                <label for="completed">✓ Mark as completed</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="submit-btn">💾 Update Task</button>
            <a href="{{ route('tasks.index') }}" class="cancel-btn">❌ Cancel</a>
        </div>
    </form>
</div>
@endsection