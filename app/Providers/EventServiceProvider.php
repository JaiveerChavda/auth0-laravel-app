<?php

namespace App\Providers;

use App\Listeners\LogSuccessfullLogin;
use App\Listeners\LogSuccessfullSignup;
use Auth0\Laravel\Events\LoginAttempting;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Auth0\Laravel\Events\AuthenticationSucceeded;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // LoginAttempting::class => [
        //     LogSuccessfullLogin::class,
        // ],
        Login::class => [
            LogSuccessfullLogin::class,
        ],
        // AuthenticationSucceeded::class => [
        //     LogSuccessfullSignup::class,
        // ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
