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
        return view('home', compact('messages'));
    }

    public function getBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('books', compact('books'));
    }

}
