<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Faculty;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        \View::composer('*', function($view){
            $faculties = \Cache::rememberForever('faculties', function(){
                return Faculty::all();
            });
            $view->with('faculties',$faculties);
        });
        // $this->app['request']->server->set('HTTPS', true);
        Validator::extend('recaptcha', 'App\Validators\Recaptcha@validate');

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
