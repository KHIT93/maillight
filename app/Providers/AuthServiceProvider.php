<?php

namespace MailLight\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'MailLight\Model' => 'MailLight\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        try
        {
            foreach ($this->getPermissions() as $permission)
            {
                Gate::define($permission->name, function($user) use ($permission)
                {
                    return $user->hasRole($permission->roles);
                });
            }
        }
        catch(\PDOException $ex)
        {
        }
    }
    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return \MailLight\Models\Permission::with('roles')->get();
    }
}
