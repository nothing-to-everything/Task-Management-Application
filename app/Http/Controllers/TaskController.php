<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    // Display a list of the user's tasks
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id()); // Filter tasks by the authenticated user

        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Apply priority filter
        if ($request->has('priority') && $request->priority != 'All') {
            $query->where('priority', $request->priority);
        }

        // Apply due date filter
        if ($request->has('due_date') && !empty($request->due_date)) {
            $query->whereDate('due_date', $request->due_date);
        }

        if ($request->has('status')) {
            if ($request->status === 'completed') {
                $query->where('completed', true);
            } elseif ($request->status === 'overdue') {
                $query->whereDate('due_date', '<', now()->toDateString())->where('completed', false);
            }
        }

        // Get filtered tasks
        $tasks = $query->get();

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

    public function dashboard()
    {
        // Filter tasks for the logged-in user
        $userId = auth()->id();

        // Total number of tasks for the user
        $totalTasks = Task::where('user_id', $userId)->count();

        // Completed tasks for the user
        $completedTasks = Task::where('user_id', $userId)
            ->where('completed', true)
            ->count();

        // Overdue tasks for the user
        $overdueTasks = Task::where('user_id', $userId)
            ->where('completed', false)
            ->where('due_date', '<', now())
            ->count();

        // Tasks by priority for the user
        $tasksByPriority = Task::select('priority', DB::raw('count(*) as count'))
            ->where('user_id', $userId)
            ->groupBy('priority')
            ->get();

        // Completion percentage
        $completionPercentage = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;

        return view('dashboard', compact('totalTasks', 'completedTasks', 'overdueTasks', 'tasksByPriority', 'completionPercentage'));
    }

    public function updateStatus(Request $request, Task $task)
    {
        $task->completed = $request->input('completed');
        $task->save();

        return response()->json(['success' => true]);
    }
}

