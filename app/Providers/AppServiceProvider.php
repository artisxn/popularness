<?php

namespace App\Providers;

use App\Observers\PlayListObserver;
use App\Observers\UserObserver;
use App\Observers\VideoObserver;
use App\Observers\VideoObserverNova;
use App\User;
use App\UserPlayList;
use Illuminate\Support\ServiceProvider;
use App\Video;
use Laravel\Nova\Nova;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function () {
            Video::observe(VideoObserverNova::class);
        });

        Video::observe(VideoObserver::class);
        UserPlayList::observe(PlayListObserver::class);
        User::observe(UserObserver::class);
    }
}
