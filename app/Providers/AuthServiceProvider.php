<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Review;
use App\Policies\ReviewPolicy;
=======
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a

class AuthServiceProvider extends ServiceProvider
{
    /**
<<<<<<< HEAD
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Review::class => ReviewPolicy::class,
=======
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
<<<<<<< HEAD
=======

        //
>>>>>>> 8223bfc6b8ccc6f055c5b9948f8ff613e6bec14a
    }
}
