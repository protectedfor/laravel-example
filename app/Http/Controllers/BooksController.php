<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Book;
use Illuminate\Http\Request;
use Session;


class BooksController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|min:1'
        ]);

        Book::create($request->all());

        Session::flash('success', true);

        return redirect()->back();
    }
}
