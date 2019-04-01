<?php

namespace App\Http\Controllers;

use App\Course;
use App\Type;
use App\Edition;
use App\Term;
use App\Tag;
use Illuminate\Http\Request;
use Auth;

class CourseController extends Controller
{

    public function index()
    {
        //Sort with own courses first
        $courses = Course::allWithMineOnTop();

        return view('courses.index')
            ->with(compact('courses'));
    }

    public function create()
    {
        return view('courses.form')
            ->with('course', new Course())
            ->with('types', Type::all());
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'type_id' => 'required|integer|min:1',
            'owner' => 'required|alpha_dash'
        ]);

        Course::create($request->all());
        return redirect()->route('courses.index');
    }

    public function show(Course $course)
    {
        $terms = $course->terms;
        return view('courses.show')
            ->with(compact('terms'))
            ->with(compact('course'))
            ->with('edition', null);
    }

    public function show_edition(Course $course, Edition $edition)
    {
        $terms = $course->terms->sortByDesc(function($term, $key) use ($edition){
            return (int)($term->pivot->id == $edition->id);
        })->values();

        return view('courses.show')
            ->with(compact('course'))
            ->with(compact('terms'))
            ->with(compact('edition'));
    }

    public function edit(Course $course)
    {

        $tags = Tag::whereDoesntHave('courses', function ($query) use($course) {
            $query->where('course_id', $course->id);
        })->get();

        return view('courses.form')
            ->with(compact('course'))
            ->with(compact('tags'))
            ->with('types', Type::all());
    }

    public function update(Request $request, Course $course)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'type_id' => 'required|integer|min:1',
            'owner' => 'required|alpha_dash'
        ]);

        $course->title = $request->title;
        $course->type_id = $request->type_id;
        $course->owner = $request->owner;
        $course->description = $request->description;
        $course->save();

        return redirect()->route('courses.show', $course);
    }

    public function delete(Course $course)
    {
        return view('courses.delete')
            ->with(compact('course'));
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index');
    }

    public function toggle_tag(Course $course, Tag $tag)
    {
        $status = $course->tags()->toggle($tag);
        return count($status['attached']);
    }

}
