<?php

namespace App\Providers\Guard;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class TokenGuard implements Guard
{
    use GuardHelpers;

    private Request $request;

    public function __construct(UserProvider $provider, Request $request){
        $this->provider = $provider;
        $this->request = $request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function user()
    {
        if($this->user != null){
            return $this->user;
        }

        $token = $this->request->header("API-Key");
        if($token){
            $this->user = $this->provider->retrieveByCredentials(["token" => $token]);
        }
        return $this->user;
    }

    public function validate(array $credentials = [])
    {
        return $this->provider->validateCredentials($this->user, $credentials);
    }
}
