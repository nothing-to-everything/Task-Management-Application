<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', ['email' => 'testuser@example.com']);
    }

    /** @test */
    public function a_user_can_login()
    {
        // Re-seed the database to ensure users are present
        $this->seed();

        // Retrieve the first user
        $user = User::first();
        if (!$user) {
            $this->fail('No users found in the database.');
        }

        // Attempt to log in with the user's credentials
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Assert that the user is redirected to the tasks page
        $response->assertRedirect('/dashboard');
    }

}
