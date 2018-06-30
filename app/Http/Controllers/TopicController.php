<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{

    public function index()
    {
        return view('topics.index')
            ->with('topics', Topic::all());
    }

    public function create()
    {
        return view('topics.form')
            ->with('topic', new Topic());
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'owner' => 'required|alpha_dash'
        ]);

        Topic::create($request->all());
        return redirect()->route('topics.index');
    }

    public function show(Topic $topic)
    {
        return view('topics.show')
            ->with(compact('topic'));
    }

    public function edit(Topic $topic)
    {
        return view('topics.form')
            ->with(compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $this->validate(request(), [
            'title' => 'required|alpha_dash',
            'owner' => 'required|alpha_dash'
        ]);

        $topic->title = $request->title;
        $topic->owner = $request->owner;
        $topic->save();

        return redirect()->route('topics.show', $topic);
    }

    public function delete(Topic $topic)
    {
        return view('topics.delete')
            ->with(compact('topic'));
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index')->with('status', [
            'success' => 'Leerlijn verwijderd!'
        ]);
    }
}
