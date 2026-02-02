@extends('layouts.app')

{{-- 
    Page Title
    Sets the title of the page, used in the <title> tag of the layout.
--}}
@section('title', 'My Tasks')

@section('content')
{{-- 
    Inline CSS styling specific to this "My Tasks" page. 
    It includes styles for:
        - Header section
        - Task statistics cards
        - Task grid and individual task cards
        - Buttons for actions (toggle, edit, delete)
        - Empty state display
        - Responsive behavior for mobile
--}}
<style>
    /* Header section containing the title and "Add Task" button */
    .tasks-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
        padding-bottom: 1.5rem;
        border-bottom: 3px solid #ffd700;
    }

    .tasks-header h1 {
        color: #c9292a;
        font-size: 2.5rem;
        text-shadow: 2px 2px 4px rgba(201, 41, 42, 0.1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .add-task-btn {
        padding: 0.9rem 2rem;
        background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
        color: #ffd700;
        text-decoration: none;
        border-radius: 15px;
        font-weight: bold;
        transition: all 0.3s;
        display: inline-block;
        border: 3px solid #ffd700;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }

    .add-task-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(201, 41, 42, 0.4);
    }

    /* Stats section displaying total, pending, and completed tasks */
    .tasks-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #c9292a 0%, #8b0000 100%);
        color: #ffd700;
        padding: 2rem;
        border-radius: 20px;
        text-align: center;
        border: 3px solid #ffd700;
        box-shadow: 0 10px 30px rgba(201, 41, 42, 0.3);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '✨';
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 1.5rem;
        opacity: 0.5;
    }

    .stat-card h3 {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .stat-card p {
        opacity: 0.95;
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Grid layout for task cards */
    .tasks-grid {
        display: grid;
        gap: 1.5rem;
    }

    /* Individual task card styling */
    .task-card {
        background: linear-gradient(135deg, #fffaf0 0%, #fff8dc 100%);
        padding: 1.8rem;
        border-radius: 20px;
        border-left: 6px solid #c9292a;
        border: 4px solid #ffd700;
        transition: all 0.3s;
        position: relative;
    }

    .task-card::before {
        content: '🏮';
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 1.5rem;
        opacity: 0.2;
    }

    .task-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(201, 41, 42, 0.2);
    }

    /* Completed task card */
    .task-card.completed {
        opacity: 0.75;
        border-left-color: #228b22;
    }

    .task-card.completed::before {
        content: '✅';
    }

    /* Header within each task card */
    .task-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .task-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #8b4513;
        flex: 1;
    }

    /* Style for completed task title */
    .task-card.completed .task-title {
        text-decoration: line-through;
        color: #666;
    }

    /* Task status badges */
    .task-status {
        padding: 0.4rem 1.2rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: bold;
        border: 2px solid;
        white-space: nowrap;
    }

    .status-pending {
        background: linear-gradient(135deg, #fff8dc 0%, #fffacd 100%);
        color: #8b4513;
        border-color: #ffd700;
    }

    .status-completed {
        background: linear-gradient(135deg, #90ee90 0%, #98fb98 100%);
        color: #228b22;
        border-color: #228b22;
    }

    /* Task description */
    .task-description {
        color: #8b4513;
        margin-bottom: 1.5rem;
        line-height: 1.7;
        font-size: 1.05rem;
    }

    /* Meta info like creation date and time ago */
    .task-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #b8860b;
        margin-bottom: 1.2rem;
        padding-top: 1rem;
        border-top: 2px dashed #ffd700;
    }

    /* Action buttons container */
    .task-actions {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
    }

    /* Common button styling */
    .btn {
        padding: 0.6rem 1.3rem;
        border: 2px solid;
        border-radius: 10px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        font-size: 0.95rem;
    }

    /* Toggle complete button */
    .btn-toggle {
        background: linear-gradient(135deg, #228b22 0%, #006400 100%);
        color: white;
        border-color: #228b22;
    }

    .btn-toggle:hover {
        background: linear-gradient(135deg, #006400 0%, #004d00 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(34, 139, 34, 0.3);
    }

    /* Edit button */
    .btn-edit {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #8b4513;
        border-color: #daa520;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
    }

    /* Delete button */
    .btn-delete {
        background: linear-gradient(135deg, #8b0000 0%, #5a0000 100%);
        color: #ffd700;
        border-color: #8b0000;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #5a0000 0%, #3a0000 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 0, 0, 0.3);
    }

    /* Empty state when no tasks exist */
    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        background: linear-gradient(135deg, #fffaf0 0%, #fff8dc 100%);
        border-radius: 20px;
        border: 3px dashed #ffd700;
    }

    .empty-state h2 {
        color: #c9292a;
        margin-bottom: 1rem;
        font-size: 2rem;
    }

    .empty-state p {
        color: #8b4513;
        font-size: 1.2rem;
    }

    .empty-lantern {
        font-size: 5rem;
        margin-bottom: 1rem;
        opacity: 0.4;
        animation: swing 3s ease-in-out infinite;
    }

    @keyframes swing {
        0%, 100% { transform: rotate(-5deg); }
        50% { transform: rotate(5deg); }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .tasks-header {
            flex-direction: column;
            align-items: stretch;
        }

        .add-task-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

{{-- Header with page title and "Add Task" button --}}
<div class="tasks-header">
    <h1>🏮 My Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="add-task-btn">✨ Add Task</a>
</div>

{{-- Task statistics cards --}}
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

{{-- Task grid: displays all tasks if they exist --}}
@if($tasks->count() > 0)
    <div class="tasks-grid">
        @foreach($tasks as $task)
            {{-- Single task card --}}
            <div class="task-card {{ $task->completed ? 'completed' : '' }}">
                {{-- Task header with title and status --}}
                <div class="task-header">
                    <div class="task-title">{{ $task->title }}</div>
                    <span class="task-status {{ $task->completed ? 'status-completed' : 'status-pending' }}">
                        {{ $task->completed ? '✅ Completed' : '⏳ Pending' }}
                    </span>
                </div>

                {{-- Optional task description --}}
                @if($task->description)
                    <div class="task-description">{{ $task->description }}</div>
                @endif

                {{-- Meta info: creation date and time ago --}}
                <div class="task-meta">
                    <span>📅 {{ $task->created_at->format('M d, Y') }}</span>
                    <span>🕒 {{ $task->created_at->diffForHumans() }}</span>
                </div>

                {{-- Task actions: toggle, edit, delete --}}
                <div class="task-actions">
                    {{-- Toggle complete/pending --}}
                    <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-toggle">
                            {{ $task->completed ? '↩️ Pending' : '✅ Mark Complete' }}
                        </button>
                    </form>

                    {{-- Edit task --}}
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-edit">✏️ Edit</a>

                    {{-- Delete task with confirmation --}}
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;" 
                          onsubmit="return confirm('Are you sure you want to permanently delete this?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">🗑️ Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    {{-- Empty state display when no tasks exist --}}
    <div class="empty-state">
        <div class="empty-lantern">🏮</div>
        <h2>No tasks yet!</h2>
        <p>Create your first Lantern Rite task!</p>
    </div>
@endif
@endsection
