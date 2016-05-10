<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Book;
use App\Models\Category;
use App\Models\Work;
use Illuminate\Http\Request;
use Mail;
use App;

class PagesController extends Controller
{
    public function getHome(Request $request)
    {
        $works = Work::with('photos')->orderBy('views', 'desc')->take(6)->get();
        if($query = $request->get('query')){
            $works = Work::search($query)->get();
        }
        $categories = Category::roots()->get();
        return view('home', compact('categories', 'works'));
    }

    public function getBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('books', compact('books'));
    }

}
