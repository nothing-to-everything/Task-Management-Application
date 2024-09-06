<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total tasks
        $totalTasks = $user->tasks()->count();

        // Completed tasks
        $completedTasks = $user->tasks()->where('completed', true)->count();

        // Overdue tasks
        $overdueTasks = $user->tasks()->where('due_date', '<', Carbon::now())->where('completed', false)->count();

        // Tasks by priority
        $priorityCounts = $user->tasks()->select('priority', \DB::raw('count(*) as count'))
            ->groupBy('priority')
            ->pluck('count', 'priority')
            ->toArray();

        return view('dashboard', compact('totalTasks', 'completedTasks', 'overdueTasks', 'priorityCounts'));
    }
}
