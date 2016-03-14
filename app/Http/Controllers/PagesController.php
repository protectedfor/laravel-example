<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Feed;

class PagesController extends Controller
{
    public function getHome()
    {
        $feeds = Feed::all();
        return view('welcome', compact('feeds'));
    }
}
