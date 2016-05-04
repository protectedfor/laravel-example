<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Book;
use App\Models\Category;
use App\Models\Work;
use Illuminate\Http\Request;
use Mail;

class PagesController extends Controller
{
    public function getHome(Request $request)
    {
        $categories = Category::roots()->get();
        return view('home', compact('categories'));
    }

    public function getBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('books', compact('books'));
    }

}
