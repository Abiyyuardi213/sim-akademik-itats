<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate untuk admin dan dosen
        Gate::define('akses-admin-dosen', function (User $user) {
            return in_array($user->role->role_name, ['admin', 'dosen']);
        });

        // Gate khusus admin saja
        Gate::define('akses-admin-saja', function (User $user) {
            return $user->role->role_name === 'admin';
        });

        // Gate untuk CSR
        Gate::define('akses-csr', function (User $user) {
            return $user->role->role_name === 'csr';
        });
    }
}
