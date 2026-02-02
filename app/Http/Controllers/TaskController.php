<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    // Display all tasks for logged-in user
    public function index()
    {
        $tasks = Task::where('user_id', Session::get('user_id'))
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('tasks.index', compact('tasks'));
    }

    // Show create form
    public function create()
    {
        return view('tasks.create');
    }

    // Store new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Task::create([
            'user_id' => Session::get('user_id'),
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false
        ]);

        return redirect('/tasks')->with('success', 'Task created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $task = Task::where('id', $id)
                   ->where('user_id', Session::get('user_id'))
                   ->firstOrFail();
        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $task = Task::where('id', $id)
                   ->where('user_id', Session::get('user_id'))
                   ->firstOrFail();

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->has('completed')
        ]);

        return redirect('/tasks')->with('success', 'Task updated successfully!');
    }

    // Delete task
    public function destroy($id)
    {
        $task = Task::where('id', $id)
                   ->where('user_id', Session::get('user_id'))
                   ->firstOrFail();
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully!');
    }

    // Toggle task completion
    public function toggleComplete($id)
    {
        $task = Task::where('id', $id)
                   ->where('user_id', Session::get('user_id'))
                   ->firstOrFail();
        
        $task->completed = !$task->completed;
        $task->save();

        return back()->with('success', 'Task status updated!');
    }
}