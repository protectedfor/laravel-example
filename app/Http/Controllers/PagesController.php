<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Author;
use App\Models\Message;
use App\Models\Book;

class PagesController extends Controller
{
    public function getHome()
    {
//        dd($book->authors);
        $messages = Message::orderBy('created_at', 'DESC')->get();
        $books = Book::orderBy('created_at', 'DESC')->get();
        return view('home', compact('books'));
    }
}
