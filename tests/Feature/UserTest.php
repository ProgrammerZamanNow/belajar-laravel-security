<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testAuth()
    {
        $this->seed(UserSeeder::class);

        $success = Auth::attempt([
            "email" => "eko@localhost",
            "password" => "rahasia"
        ], true);
        self::assertTrue($success);

        $user = Auth::user();
        self::assertNotNull($user);
        self::assertEquals("eko@localhost", $user->email);
    }

    public function testGuest()
    {
        $user = Auth::user();
        self::assertNull($user);
    }

    public function testLogin()
    {
        $this->seed([UserSeeder::class]);

        $this->get("/users/login?email=eko@localhost&password=rahasia")
            ->assertRedirect("/users/current");

        $this->get("/users/login?email=salah&password=rahasia")
            ->assertSeeText("Wrong credentials");
    }

    public function testCurrent()
    {
        $this->seed([UserSeeder::class]);

        $this->get("/users/current")
            ->assertSeeText("Hello Guest");

        $user = User::where("email", "eko@localhost")->firstOrFail();
        $this->actingAs($user)
            ->get("/users/current")
            ->assertSeeText("Hello Eko Kurniawan");
    }


}
