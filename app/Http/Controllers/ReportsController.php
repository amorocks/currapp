<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TagType;
use App\Course;
use App\Cohort;
use App\User;

class ReportsController extends Controller
{
    public function ownership()
    {

    	//The list needs to be sorted by term, then by owner. This can be done only with text sort, wich places '10' after '1', and then '2' and '20' and so on. This is prevented by replacing the term-number with a letter.

    	$termToLetter = array(
    		1 => 'a',
    		2 => 'b',
    		3 => 'c',
    		4 => 'd',
    		5 => 'e',
    		6 => 'f',
    		7 => 'g',
    		8 => 'h',
    		9 => 'i',
    		10 => 'j',
    		11 => 'k',
    		12 => 'l',
    		13 => 'm',
    		14 => 'n',
    		15 => 'o',
    		16 => 'p',
    		17 => 'q',
    		18 => 'r',
    		19 => 's',
    		20 => 't'
    	);

        $courses = Course::all()->sortBy('owner')->sortBy(function($item) use($termToLetter){
        	if(count($item->terms)){
        		return
        			$termToLetter[$item->terms->pluck('order')->min()]
        			. '-' .
        			$item->owner;
        	} 
        	return 99999;
        });

        $grouped = $courses->groupBy('owner')->sortKeys();

        return view('reports.ownership')
        	->with(compact('courses'))
        	->with(compact('grouped'));
    }

    public function empty()
    {
        $courses = Course::whereNull('description')->orderBy('owner')->get();
        return view('reports.empty')
            ->with(compact('courses'));
    }

    public function tags_load(Request $request)
    {
        return redirect()->route('reports.tags', [$request->type_id, $request->cohort_id]);
    }

    public function tags(TagType $tagtype = null, Cohort $cohort = null)
    {
        $type = $tagtype ?? TagType::first();
        $cohort = $cohort ?? Cohort::where('start_year', date('Y') - 1)->first();
        $tags = $type->tags;

        //Build empty array
        $data = collect();
        foreach($tags as $tag)
        {
            $data[$tag->id] = collect();
        }

        //Fill it up
        foreach ($cohort->courses as $course)
        {
            foreach($course->tags->where('tag_type_id', $type->id) as $tag)
            {
                $data[$tag->id][] = $course;
            }
        }
        
        //Sort by count of tags
        $tags = $tags->sortBy(function($tag, $key) use($data){
            return count($data[$tag->id]);
        });

        return view('reports.tags')
            ->with('types', TagType::all())
            ->with('cohorts', Cohort::orderBy('qualification_id')->orderBy('start_year', 'DESC')->get())
            ->with(compact('type'))
            ->with(compact('cohort'))
            ->with(compact('tags'))
            ->with(compact('data'));
    }
}
