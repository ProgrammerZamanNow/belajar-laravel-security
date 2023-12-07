<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Database\Seeders\TodoSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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

    public function testView()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);
        $user = User::where("email", "eko@localhost")->firstOrFail();
        Auth::login($user);

        $todos = Todo::query()->get();

        $this->view("todos", [
            "todos" => $todos
        ])->assertSeeText("Edit")
            ->assertSeeText("Delete")
            ->assertDontSeeText("No Edit")
            ->assertDontSeeText("No Delete");
    }

    public function testViewGuest()
    {
        $this->seed([UserSeeder::class, TodoSeeder::class]);

        $todos = Todo::query()->get();

        $this->view("todos", [
            "todos" => $todos
        ])->assertSeeText("No Edit")
            ->assertSeeText("No Delete");
    }


}
