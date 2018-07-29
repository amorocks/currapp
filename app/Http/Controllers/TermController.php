<?php

namespace App\Http\Controllers;

use App\Qualification;
use App\Cohort;
use App\Term;
use App\Course;
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

    public function show(Qualification $qualification, Cohort $cohort, Term $term)
    {
        return view('curriculum.terms.show')
            ->with(compact('qualification'))
            ->with(compact('cohort'))
            ->with(compact('term'));
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

        if(!$term->cohort->topics->pluck('id')->contains($course->topic_id))
        {
            $term->cohort->topics()->attach($course->topic_id);
        }

        return count($status['attached']);
    }
}