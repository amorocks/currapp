<?php

namespace App\Http\Controllers;

use App\TagType;
use Illuminate\Http\Request;

class TagTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tag_types.index')
            ->with('types', TagType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag_types.form')
            ->with('type', new TagType());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate(request(), [
            'title' => 'required|string',
            'color' => 'required|string',
        ]);

        TagType::create($request->all());
        return redirect()->route('tag-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TagType  $tagType
     * @return \Illuminate\Http\Response
     */
    public function edit(TagType $tagType)
    {
        return view('tag_types.form')
            ->with('type', $tagType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TagType  $tagType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagType $tagType)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'color' => 'required|string',
        ]);

        $tagType->title = $request->title;
        $tagType->color = $request->color;
        $tagType->save();

        return redirect()->route('tag-types.index');
    }

    public function delete(TagType $tagType)
    {
        return view('tag_types.delete')
            ->with(compact('tagType'));
    }

    public function destroy(TagType $tagType)
    {
        $tagType->delete();
        return redirect()->route('tag-types.index')->with('status', [
            'success' => 'Tagsoort verwijderd!'
        ]);
    }
}
