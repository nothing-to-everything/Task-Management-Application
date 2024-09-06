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
        $user = Auth::user();
        $tasks = $user->tasks()
            ->when($request->input('search'), function($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            })
            ->when($request->input('priority') !== 'All', function($query) use ($request) {
                $query->where('priority', $request->input('priority'));
            })
            ->when($request->input('due_date'), function($query) use ($request) {
                $query->whereDate('due_date', $request->input('due_date'));
            })
            ->get();

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
            'category' => 'nullable|string',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'category' => $request->category,
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
            'category' => 'nullable|string',
        ]);

        $task->update($request->only(['title', 'description', 'due_date', 'priority', 'category']));

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

