<?php

namespace App\Http\Controllers;

use App\Qualification;
use Illuminate\Http\Request;
use Route;

class QualificationController extends Controller
{
    public function index()
    {
        return view('curriculum.qualifications.index')
            ->with('qualifications', Qualification::all());
    }

    public function create()
    {
        return view('curriculum.qualifications.form')
            ->with('qualification', new Qualification());
    }

    public function store(Request $request)
    {
        $this->validate(request(), [

            'title' => 'required|alpha_dash',
            'crebo' => 'required|alpha_dash',
            'owner' => 'required|alpha_dash',
            'duration' => 'required|integer|min:1',
            'terms_per_year' => 'required|integer|min:1'

        ]);

        Qualification::create($request->all());
        return redirect()->route('qualifications.index');
    }

    public function edit(Qualification $qualification)
    {
        return view('curriculum.qualifications.form')
            ->with('qualification', $qualification);
    }

    public function update(Request $request, Qualification $qualification)
    {
        $this->validate(request(), [
            'crebo' => 'required|alpha_dash',
            'owner' => 'required|alpha_dash'
        ]);

        $qualification->sub_title = $request->sub_title;
        $qualification->crebo = $request->crebo;
        $qualification->owner = $request->owner;
        $qualification->save();

        return redirect()->route('qualifications.show', $qualification);
    }

    public function delete(Qualification $qualification)
    {
        return view('curriculum.qualifications.delete')
            ->with('qualification', $qualification);
    }

    public function destroy(Qualification $qualification)
    {
        $qualification->delete();
        return redirect()->route('qualifications.index')->with('status', [
            'success' => 'Kwalificatie verwijderd!'
        ]);
    }
}
