<?php

namespace App\Providers;

use App\Services\FirestoreDatabase;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(FirestoreDatabase::class, function () {
            return new FirestoreDatabase(config('services.firebase.project_id'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
