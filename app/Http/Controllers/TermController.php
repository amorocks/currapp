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
