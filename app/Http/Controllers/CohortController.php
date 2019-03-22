<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Qualification;
use App\Cohort;
use App\Term;
use Illuminate\Http\Request;

class CohortController extends Controller
{

    public function index(Qualification $qualification)
    {
        return view('curriculum.cohorts.index')
            ->with('qualification', $qualification)
            ->with('cohorts', $qualification->cohorts()->orderBy('start_year', 'desc')->get());
    }

    public function create(Qualification $qualification)
    {
        return view('curriculum.cohorts.create')
            ->with('qualification', $qualification)
            ->with('cohort', new Cohort());
    }

    public function store(Request $request, Qualification $qualification)
    {
        $this->validate(request(), [
            'start_year' => 'required|integer',
            'duration' => 'required|integer|min:1',
            'terms_per_year' => 'required|integer|min:1'
        ]);

        $cohort = new Cohort();
        $cohort->start_year = $request->start_year;
        $cohort->exam_year = $cohort->start_year + $request->duration;
        $cohort->terms_per_year = $request->terms_per_year;
        $cohort = $qualification->cohorts()->save($cohort);

        if($request->create_terms == 'yes')
        {
            $terms = $request->duration * $request->terms_per_year;
            for($i = 1; $i <= $terms; $i++)
            {
                $cohort->terms()->save(new Term([
                    'order' => $i,
                ]));
            }
        }

        return redirect()->route('qualifications.cohorts.index', $qualification);
    }

    public function show(Qualification $qualification, Cohort $cohort)
    {
        $types = array();
        foreach($cohort->terms as $term)
        {
            foreach ($term->courses as $course)
            {
                $types[$course->type->id] = $course->type->title;
            }
        }

        return view('curriculum.cohorts.show')
            ->with(compact('qualification'))
            ->with(compact('cohort'))
            ->with(compact('types'));
    }
}
