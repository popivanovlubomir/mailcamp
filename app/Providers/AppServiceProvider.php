<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        //validate has subscribe tag
        Validator::extend('has_unsubscribe_tag', function($attribute, $value, $parameters, $validator) {

            if(!empty($value) && (preg_match('/(\[unsubscribe\])/', $value)) >= 1){
                return true;
            }

            return false;

        });
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
