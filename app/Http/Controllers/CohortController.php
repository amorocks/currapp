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
        ]);

        $cohort = new Cohort();
        $cohort->start_year = $request->start_year;
        $cohort->exam_year = $cohort->start_year + $qualification->duration;
        $cohort = $qualification->cohorts()->save($cohort);

        if($request->create_terms == 'yes')
        {
            $terms = $qualification->duration * $qualification->terms_per_year;
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
        return view('curriculum.cohorts.show')
            ->with(compact('qualification'))
            ->with(compact('cohort'))
            ->with('terms', $cohort->terms)
            ->with('topics', $cohort->topics);
    }

    public function edit_topics(Qualification $qualification, Cohort $cohort)
    {
        return view('curriculum.cohorts.topics')
            ->with(compact('qualification'))
            ->with(compact('cohort'))
            ->with('topics', Topic::all());
    }

    public function update_topics(Request $request, Qualification $qualification, Cohort $cohort)
    {
        $this->validate(request(), [
            'topics.*' => 'nullable|integer'
        ]);

        $topic_ids = collect($request->topics)->keys();
        $cohort->topics()->sync($topic_ids);

        return redirect()->route('qualifications.cohorts.show', [$qualification, $cohort]);
    }
}
