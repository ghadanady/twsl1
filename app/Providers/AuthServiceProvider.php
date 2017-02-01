<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

       // $wishlistCount = 0;
       //  $auth = auth()->guard('members');
       //  if($auth->check()){
       //      $wishlistCount = $auth->user()->wishlistProducts->count();
       //  }
       //  view()->share('wishlistCount', $wishlistCount);
    }
}
