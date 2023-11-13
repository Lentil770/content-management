<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // defining roles here
        Gate::define('is-admin', function ($user) {
            return $user->role_id === 1;
        });
        Gate::define('reading-view', function ($user) {
            return in_array($user->role_id, [1,2,3,4]);
        });
        Gate::define('video-view', function ($user) {
            return in_array($user->role_id, [1,2,4,5]);
        });
        Gate::define('library-view', function ($user) {
            return in_array($user->role_id, [1,2,7,4]);
        });
        Gate::define('reading-permission', function ($user) {
            return in_array($user->role_id, [1,2,3]);
        });
        Gate::define('library-permission', function ($user) {
            return in_array($user->role_id, [1,2,7]);
        });
        Gate::define('video-permission', function ($user) {
            return in_array($user->role_id, [1,2,6]);
        });
    }
}
