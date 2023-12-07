<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Contact;
use App\Models\User;
use App\Providers\Guard\TokenGuard;
use App\Providers\User\SimpleProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::extend("token", function (Application $app, string $name, array $config) {
            $tokenGuard = new TokenGuard(Auth::createUserProvider($config["provider"]), $app->make(Request::class));
            $app->refresh("request", $tokenGuard, "setRequest");
            return $tokenGuard;
        });

        Auth::provider("simple", function (Application $app, array $config) {
            return new SimpleProvider();
        });

        Gate::define("get-contact", function (User $user, Contact $contact) {
            return $user->id == $contact->user_id;
        });
        Gate::define("update-contact", function (User $user, Contact $contact) {
            return $user->id == $contact->user_id;
        });
        Gate::define("delete-contact", function (User $user, Contact $contact) {
            return $user->id == $contact->user_id;
        });
    }
}
