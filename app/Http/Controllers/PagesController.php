<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Book;
use App\Models\Work;
use Illuminate\Http\Request;
use Mail;

class PagesController extends Controller
{
    public function getHome(Request $request)
    {
        $works = Work::with('photos')->orderBy('views', 'desc')->take(6)->get();
        return view('home', compact('works'));
    }

    public function getBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('books', compact('books'));
    }

}
