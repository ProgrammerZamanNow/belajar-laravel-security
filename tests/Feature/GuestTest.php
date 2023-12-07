<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class GuestTest extends TestCase
{
    public function testGuest()
    {
        self::assertTrue(Gate::allows("create", User::class));
    }

    public function testUser()
    {
        $this->seed([UserSeeder::class]);

        $user = User::where("email", "eko@localhost")->firstOrFail();
        Auth::login($user);

        self::assertFalse(Gate::allows("create", User::class));
    }


}
