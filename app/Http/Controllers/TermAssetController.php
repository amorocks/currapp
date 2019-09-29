<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Term;
use App\Cohort;
use App\Qualification;
use Illuminate\Http\Request;

class TermAssetController extends Controller
{

    public function index(Qualification $qualification, Cohort $cohort, Term $term)
    {
        return view('curriculum.terms.assets.index')
            ->with(compact('qualification'))
            ->with(compact('cohort'))
            ->with(compact('term'));
    }

}
