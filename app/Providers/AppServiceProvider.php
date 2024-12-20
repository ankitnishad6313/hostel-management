<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Schema;
use Validator;

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
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
        // abort(404, view('errors.404'));

        Validator::extend('check_in_not_past', function ($attribute, $value, $parameters, $validator) {
            return strtotime($value) >= strtotime(date('Y-m-d'));
        });

        // Optionally, you can add a custom message
        Validator::replacer('check_in_not_past', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, ':attribute must be a date not in the past.');
        });
    }
}
