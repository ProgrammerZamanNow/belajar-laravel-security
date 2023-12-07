<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\TodoSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    public function testTodo()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);

        $this->post("/api/todo")
            ->assertStatus(403);

        $user = User::where("email", "eko@localhost")->firstOrFail();
        $this->actingAs($user)
            ->post("/api/todo")
            ->assertStatus(200);
    }

}
