<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Message;

class PagesController extends Controller
{
    public function getHome()
    {
        $messages = Message::all();
        return view('home', compact('messages'));
    }
}
