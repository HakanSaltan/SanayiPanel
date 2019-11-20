<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Factory;
use App\userAyar;
use Illuminate\Support\Facades\Auth;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Factory $cache, Setting $settings)
    {
        $settings = $cache->remember('userAyar', 60, function() use ($settings)
        {
            return $settings->where('user_id','=',Auth::user()->id)->all();
        });
    
        config()->set('settings', $settings);
    }
}
