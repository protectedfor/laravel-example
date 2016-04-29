<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocalesComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $currentLocale = App::getLocale();
        $locales = LaravelLocalization::getSupportedLocales();

        $view->with(compact('locales', 'currentLocale'));
    }

}