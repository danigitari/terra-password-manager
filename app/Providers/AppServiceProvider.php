<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;


  /**
     * Register any application services.
     */
    class AppServiceProvider extends ServiceProvider
    {
        
        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            if($this->app->environment('production')) {
                URL::forceScheme('https');
            }
        }
    }
    

