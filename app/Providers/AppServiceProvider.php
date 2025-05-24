<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();   
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        View::composer('*', function ($view) {
            $unReadNotiCount = 0;
            if(auth()->guard('web')->check()){
                $unReadNotiCount = auth()->guard('web')->user()->unreadNotifications()->count();
            }

            $view->with('unReadNotiCount', $unReadNotiCount);
        });
    }
}
