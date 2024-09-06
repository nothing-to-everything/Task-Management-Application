<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Display a list of the user's tasks
    public function index(Request $request)
    {
        // Get the current user
        $user = Auth::user();

        // Query tasks for the current user
        $tasks = $user->tasks();

        // Filter by priority if provided
        if ($request->has('priority') && $request->priority !== 'All') {
            $tasks->where('priority', $request->priority);
        }

        // Filter by due date range if provided
        if ($request->has('due_date') && $request->due_date !== null) {
            $tasks->where('due_date', '<=', $request->due_date);
        }

        // Execute query and get the tasks
        $tasks = $tasks->get();

        // Return the view with the tasks
        return view('tasks.index', compact('tasks'));
    }

    // Show form to create a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Store a newly created task in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show the form to edit an existing task
    public function edit(Task $task)
    {
        // Ensure the user owns the task
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    // Update an existing task
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        $task->update($request->only(['title', 'description', 'due_date', 'priority']));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete a task
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}

