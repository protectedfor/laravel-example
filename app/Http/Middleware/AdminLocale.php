<?php namespace App\Http\Middleware;

use Closure;
use Config;
use Illuminate\Http\Request;
use Session;

class AdminLocale
{

    public function handle(Request $request, Closure $next)
    {
        if (preg_match('/\/admin/', $request->url()))
        {
            if ( ! Session::has('admin.locale'))
            {
                $locales = Config::get('translatable.locales');
                Session::put('admin.locale', $request->getPreferredLanguage($locales));
            }

            app()->setLocale(Session::get('admin.locale'));
        }

        return $next($request);
    }

}