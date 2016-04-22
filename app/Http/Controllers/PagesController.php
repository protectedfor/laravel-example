<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Book;
use App\Models\Message;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getHome(Request $request)
    {

//        dd($book->authors);
        $messages = Message::orderBy('created_at', 'DESC')->get();
        $books = Book::orderBy('created_at', 'DESC')->get();
        return view('home', compact('books'));
    }

    public function getBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('books', compact('books'));
    }

}
