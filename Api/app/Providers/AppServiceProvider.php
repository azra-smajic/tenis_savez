<?php

namespace App\Providers;

use App\Http\Services\UserService;
use App\Models\TennisAssociation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(TennisAssociation::class, function ($app) {
            return new TennisAssociation();
        });
        $this->app->scoped(UserService::class, function ($app) {
            return new UserService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Artisan::call('load:data-into-redis');
    }
}
