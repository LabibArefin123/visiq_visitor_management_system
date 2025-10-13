<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Gate: D Admin (user_type = 4) cannot access these
        Gate::define('show-profiles', function (User $user) {
            return $user->user_type !== 4;
        });

        Gate::define('show-ai-chat', function (User $user) {
            return $user->user_type !== 4;
        });
    }
}
