<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Auth;

class TypeController extends Controller
{

    public function index()
    {
        $types = Type::all();
        return view('types.index')
            ->with(compact('types'));
    }

    public function create()
    {
        return view('types.form')
            ->with('type', new Type());
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'order' => 'required|integer',
        ]);

        Type::create($request->all());
        return redirect()->route('types.index');
    }

    public function edit(Type $type)
    {
        return view('types.form')
            ->with(compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $this->validate(request(), [
            'title' => 'required|alpha_dash',
            'order' => 'required|integer',
        ]);

        $type->title = $request->title;
        $type->order = $request->order;
        $type->save();

        return redirect()->route('types.index', $type);
    }

    public function delete(Type $type)
    {
        return view('types.delete')
            ->with(compact('type'));
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index')->with('status', [
            'success' => 'Vaksoort verwijderd!'
        ]);
    }
}
