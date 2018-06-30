<?php

namespace App\Http\Controllers;

use App\Qualification;
use App\Cohort;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index(Qualification $qualification, Cohort $cohort)
    {
        return view('curriculum.terms.index')
            ->with(compact('qualification'))
            ->with(compact('cohort'))
            ->with('terms', $cohort->terms);
    }
}
