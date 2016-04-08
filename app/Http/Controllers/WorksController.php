<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreWorkRequest;
use App\Models\Photo;
use App\Models\Work;
use Auth;
use Illuminate\Http\Request;
use Session;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkRequest $request)
    {
        $request->merge([
            'user_id' => Auth::id()
        ]);
        $work = Work::create($request->all());

        $imgs = [];

        if ($request->images) {
            foreach ($request->images as $img) {
                $imgs[] = Photo::create(['imageable_id' => $work->id, 'path' => $img]);
            }
            $work->photos()->saveMany($imgs);
        }

        if ($request->ajax())
            return ['success' => 1, 'message' => 'Work added successfully!'];

        Session::flash('success', 'Ваша работа добавлена!');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $work = Work::findOrFail($id);
        return view('works.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $work = Work::findOrFail($id);
        $work->update($request->all());

        if ($request->ajax())
            return ['success' => 1, 'message' => 'Work edited successfully!'];

        Session::flash('success', 'Ваша работа отредактирована!');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
