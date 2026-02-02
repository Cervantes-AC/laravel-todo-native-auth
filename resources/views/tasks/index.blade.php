@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
<style>
    .tasks-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .tasks-header h1 {
        color: #333;
        font-size: 2.5rem;
    }

    .add-task-btn {
        padding: 0.8rem 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: bold;
        transition: transform 0.2s;
        display: inline-block;
    }

    .add-task-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .tasks-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 15px;
        text-align: center;
    }

    .stat-card h3 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .stat-card p {
        opacity: 0.9;
    }

    .tasks-grid {
        display: grid;
        gap: 1.5rem;
    }

    .task-card {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 15px;
        border-left: 5px solid #667eea;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .task-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .task-card.completed {
        opacity: 0.7;
        border-left-color: #28a745;
    }

    .task-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .task-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #333;
        flex: 1;
    }

    .task-card.completed .task-title {
        text-decoration: line-through;
    }

    .task-status {
        padding: 0.3rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: bold;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-completed {
        background: #d4edda;
        color: #155724;
    }

    .task-description {
        color: #666;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .task-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: #999;
        margin-bottom: 1rem;
    }

    .task-actions {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.5rem 1.2rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-toggle {
        background: #28a745;
        color: white;
    }

    .btn-toggle:hover {
        background: #218838;
    }

    .btn-edit {
        background: #ffc107;
        color: #333;
    }

    .btn-edit:hover {
        background: #e0a800;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state img {
        width: 200px;
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .empty-state h2 {
        color: #666;
        margin-bottom: 1rem;
    }
</style>

<div class="tasks-header">
    <h1>📝 My Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="add-task-btn">➕ Add New Task</a>
</div>

<div class="tasks-stats">
    <div class="stat-card">
        <h3>{{ $tasks->count() }}</h3>
        <p>Total Tasks</p>
    </div>
    <div class="stat-card">
        <h3>{{ $tasks->where('completed', false)->count() }}</h3>
        <p>Pending</p>
    </div>
    <div class="stat-card">
        <h3>{{ $tasks->where('completed', true)->count() }}</h3>
        <p>Completed</p>
    </div>
</div>

@if($tasks->count() > 0)
    <div class="tasks-grid">
        @foreach($tasks as $task)
            <div class="task-card {{ $task->completed ? 'completed' : '' }}">
                <div class="task-header">
                    <div class="task-title">{{ $task->title }}</div>
                    <span class="task-status {{ $task->completed ? 'status-completed' : 'status-pending' }}">
                        {{ $task->completed ? '✓ Completed' : '⏳ Pending' }}
                    </span>
                </div>

                @if($task->description)
                    <div class="task-description">{{ $task->description }}</div>
                @endif

                <div class="task-meta">
                    <span>📅 Created: {{ $task->created_at->format('M d, Y') }}</span>
                    <span>🕒 {{ $task->created_at->diffForHumans() }}</span>
                </div>

                <div class="task-actions">
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-toggle">
                            {{ $task->completed ? '↩ Mark Pending' : '✓ Mark Complete' }}
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-edit">✏ Edit</a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" 
                          onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">🗑 Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <h2>No tasks yet!</h2>
        <p>Create your first task to get started.</p>
    </div>
@endif
@endsection