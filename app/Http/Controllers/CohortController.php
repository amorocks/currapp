<?php

namespace App\Http\Controllers;

use App\Qualification;
use App\Cohort;
use Illuminate\Http\Request;

class CohortController extends Controller
{

    public function create(Qualification $qualification)
    {
        return view('curriculum.cohorts.form')
            ->with('qualification', $qualification)
            ->with('cohort', new Cohort());
    }

    public function store(Request $request, Qualification $qualification)
    {
        $this->validate(request(), [
            'start_year' => 'required|integer',
        ]);

        $cohort = new Cohort();
        $cohort->start_year = $request->start_year;
        $cohort->exam_year = $cohort->start_year + $qualification->duration;
        $qualification->cohorts()->save($cohort);

        if($request->create_terms == 'yes')
        {
            $terms = $qualification->duration * $qualification->terms_per_year;
            for($i = 1; $i <= $terms; $i++)
            {
                // $term = new Term();
                // $term->order = $i;
                // $term->duration = 1;
                // $cohorts->terms()->save($term);
            }
        }

        return redirect()->route('qualifications.show', $qualification);
    }

    public function show(Qualification $qualification, Cohort $cohort)
    {
        return view('curriculum.cohorts.show')
            ->with(compact('qualification'))
            ->with(compact('cohort'));
    }

}
