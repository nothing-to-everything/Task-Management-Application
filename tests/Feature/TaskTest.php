<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(); // Seed the database
    }

    /** @test */
    public function a_user_can_create_a_task()
    {
        $user = User::first();
        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'New Task',
            'description' => 'New task description',
            'due_date' => now()->addDays(2)->toDateString(),
            'priority' => 'High',
            'category' => 'Test',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['title' => 'New Task']);
    }

    /** @test */
    public function a_user_can_edit_a_task()
    {
        $user = User::first();
        $task = Task::first();
        $response = $this->actingAs($user)->put("/tasks/{$task->id}", [
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'due_date' => now()->addDays(3)->toDateString(),
            'priority' => 'Medium',
            'category' => 'Updated',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['title' => 'Updated Task']);
    }

    /** @test */
    public function a_user_can_delete_a_task()
    {
        $user = User::first();
        $task = Task::first();
        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");

        $response->assertRedirect('/tasks');
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
