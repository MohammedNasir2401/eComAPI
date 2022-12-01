<?php

namespace App\Providers;

use Illuminate\Http\Response;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Response::macro('success',function($data){
        //     return response()->json(['data'=>$data,'success'=>true]);
        // });
        // Response::macro('error',function($error,$status_code){
        //     return response()->json(['error'=>$error,'success'=>false],$status_code);
        // });
    }
}
