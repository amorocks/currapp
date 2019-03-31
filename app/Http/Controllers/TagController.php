<?php

namespace App\Http\Controllers;

use App\Tag;
use App\TagType;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tags.index')
            ->with('tags', Tag::orderBy('title')->get());
    }

    public function create()
    {
        return view('tags.form')
            ->with('tag', new Tag())
            ->with('tagTypes', TagType::all());
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'tag_type_id' => 'required|integer|min:1',
        ]);

        Tag::create($request->all());
        return redirect()->route('tags.index');
    }

    public function edit(Tag $tag)
    {
        return view('tags.form')
            ->with('tag', $tag)
            ->with('tagTypes', TagType::all());
    }

    public function update(Request $request, Tag $tag)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'tag_type_id' => 'required|integer|min:1',
        ]);

        $tag->title = $request->title;
        $tag->tag_type_id = $request->tag_type_id;
        $tag->save();

        return redirect()->route('tags.index');
    }

    public function delete(Tag $tag)
    {
        return view('tags.delete')
            ->with(compact('tag'));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('status', [
            'success' => 'Tag verwijderd!'
        ]);
    }
}
