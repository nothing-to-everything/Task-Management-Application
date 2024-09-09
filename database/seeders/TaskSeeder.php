<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            Task::create([
                'user_id' => $user->id,
                'title' => 'Sample Task 1',
                'description' => 'This is a sample task description.',
                'due_date' => Carbon::now()->addDays(7),
                'priority' => 'Medium',
                'category' => 'Work',
                'completed' => false,
            ]);

            Task::create([
                'user_id' => $user->id,
                'title' => 'Sample Task 2',
                'description' => 'This is another sample task description.',
                'due_date' => Carbon::now()->subDays(1),
                'priority' => 'High',
                'category' => 'Personal',
                'completed' => true,
            ]);
        }
    }
}
