<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\Time;

class AppServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('time', function ($attribute, $value, $parameters, $validator) {
            return (new Time)->passes($attribute, $value);
        });
    }
}