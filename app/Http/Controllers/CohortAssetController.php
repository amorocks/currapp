<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Cohort;
use App\Qualification;
use Illuminate\Http\Request;
use Auth;

class CohortAssetController extends Controller
{

    public function index(Qualification $qualification, Cohort $cohort)
    {
        return view('curriculum.cohorts.assets.index')
            ->with(compact('qualification'))
            ->with(compact('cohort'));
    }

}
