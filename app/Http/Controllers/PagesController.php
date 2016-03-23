<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Message;
use App\Models\Book;

class PagesController extends Controller
{
    public function getHome()
    {
        $messages = Message::orderBy('created_at', 'DESC')->get();
        $descriptions = Book::orderBy('created_at', 'DESC')->get();
        return view('home', compact('descriptions'));
    }
}
