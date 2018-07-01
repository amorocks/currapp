<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodisation;

class PeriodisationController extends Controller
{
    public function index()
    {
    	return view('periodisations.index')
    		->with('periodisations', Periodisation::orderBy("start", "desc")->get());
    }

    public function create()
    {
    	return view('periodisations.form')
    		->with('periodisation', new Periodisation());
    }

    public function store(Request $request)
    {
    	$this->validate(request(), [
            'term_order' => 'required|integer',
            'schoolyear' => 'required|integer',
            'start' => 'required|date',
            'end' => 'required|date'
        ]);	

    	Periodisation::create($request->all());
        return redirect()->route('periodisations.index');
    }

    public function edit(Periodisation $periodisation)
    {
    	return view('periodisations.form')
    		->with(compact('periodisation'));
    }

    public function update(Request $request, Periodisation $periodisation)
    {
    	$this->validate(request(), [
            'start' => 'required|date',
            'end' => 'required|date'
        ]);	

    	$periodisation->start = date('Y-m-d', strtotime($request->start));
    	$periodisation->end = date('Y-m-d', strtotime($request->end));
    	$periodisation->save();
        return redirect()->route('periodisations.index');
    }
}
