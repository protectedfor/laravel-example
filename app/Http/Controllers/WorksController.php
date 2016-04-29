<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreWorkRequest;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Work;
use Auth;
use Illuminate\Http\Request;
use Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $work = Work::findOrFail($id);
        $work->increment('views');
        return view('works.show', compact('work'));
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
        if (!$work->canAccessed())
            throw new NotFoundHttpException;
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
        if (!$work->canAccessed())
            throw new NotFoundHttpException;
        $work->update($request->all());

        $work->photos()->delete();

        $imgs = [];

        if ($request->images) {
            foreach ($request->images as $img) {
                $imgs[] = Photo::create(['imageable_id' => $work->id, 'path' => $img]);
            }

            $work->photos()->saveMany($imgs);
        }

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

    public function storeComment(Request $request, $work_id)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $work = Work::findOrFail($work_id);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        // dd($request->all());

        //  $comment = Comment::create(['commentable_id' => $request->id, 'description' => $request->description, 'user_id' => $request->user_id]);
        $comment = Comment::create($request->all());

        $work->comments()->save($comment);

        Session::flash('success', 'Ваш комментарий добавлен!');
        return redirect()->back();
    }
}
