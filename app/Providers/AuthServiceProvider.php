<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Policies\AccountingPolicy;
use App\Policies\HRPolicy;
use App\Policies\TabelPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => [
            TabelPolicy::class,
            HRPolicy::class,
            AccountingPolicy::class,
        ],
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

        //
    }
}
