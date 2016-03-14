<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class PagesController extends Controller
{
    public function getHome()
    {
        return view('welcome');
    }
}
