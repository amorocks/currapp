<?php

namespace App\Http\Controllers;

use App\Course;
use App\Topic;
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
            ->with('topics', Topic::all());
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'topic_id' => 'required|integer|min:1',
            'owner' => 'required|alpha_dash'
        ]);

        Course::create($request->all());
        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
