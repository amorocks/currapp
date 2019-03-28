<?php

namespace App\Http\Controllers;

use App\Course;
use App\Type;
use Illuminate\Http\Request;
use Auth;

class CourseController extends Controller
{

    public function index()
    {
        //Sort with own courses first
        $courses = Course::all()->sortByDesc(function($course, $key){
            return (int)($course->owner == Auth::user()->id);
        })->values();

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
        return view('courses.show')
            ->with(compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.form')
            ->with(compact('course'))
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

}
