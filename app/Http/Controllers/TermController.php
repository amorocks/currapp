<?php

namespace App\Http\Controllers;

use App\Qualification;
use App\Cohort;
use App\Term;
use App\Course;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function create(Qualification $qualification, Cohort $cohort)
    {
        return view('curriculum.terms.create')
            ->with(compact('qualification'))
            ->with(compact('cohort'));
    }

    public function store(Qualification $qualification, Cohort $cohort, Request $request)
    {
        $this->validate(request(), [
            'order' => 'required|integer|min:1'
        ]);

        $term = new Term();
        $term->order = $request->order;
        $term = $cohort->terms()->save($term);

        return redirect()->route('qualifications.cohorts.show', [$qualification, $cohort]);
    }

    public function courses(Qualification $qualification, Cohort $cohort, Term $term)
    {
    	$courses = Course::whereDoesntHave('terms', function ($query) use($term) {
            $query->where('term_id', $term->id);
        })->get();

        return view('curriculum.terms.courses')
            ->with(compact('qualification'))
            ->with(compact('cohort'))
            ->with(compact('term'))
            ->with('courses', $courses);
    }

    public function toggle_course(Term $term, Course $course)
    {
        $status = $term->courses()->toggle($course);
        return count($status['attached']);
    }
}
