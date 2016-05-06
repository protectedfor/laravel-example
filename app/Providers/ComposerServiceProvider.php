<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use App\Models\Work;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin::default._partials.user', 'App\Http\ViewComposers\LocalesComposer');
//        View::composer(['home'], function($view){
//            $works = Work::with('photos')->orderBy('views', 'desc')->take(6)->get();
//            $view->with(compact('works'));
//        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
