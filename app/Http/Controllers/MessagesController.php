<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Message;
use Illuminate\Http\Request;
use Session;

class MessagesController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:7'
        ]);
        Message::create($request->all());

        Session::flash('success', true);

        return redirect()->back();
    }
}
