<?php namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use SleepingOwl\Admin\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Boutique;
use Illuminate\Http\Request;
use Session;

class LocaleController extends Controller
{

    public function switchLocale()
    {
        $locale = \Input::get('locale', 'ru');
        Session::set('admin.locale', $locale);
        \Redirect::back()->send();
    }


}
