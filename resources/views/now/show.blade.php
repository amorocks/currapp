@extends('layouts.app')

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-between">
        <div class="d-flex align-items-center">
    		<h2 class="mr-3">{{ $qualification->title }}</h2>
    		<ul class="navbar-nav">
    			@for($i = $schoolyear-1; $i < $schoolyear+3; $i++)
	                <li class="nav-item @if($i == $schoolyear) active @endif">
	                    <a class="nav-link" href="{{ route('now.show.schoolyear', [$qualification, $i]) }}">{{ $i }} - {{ $i+1 }}</a>
	                </li>
	             @endfor
            </ul>
        </div>
	</nav>
@endsection

@section('container', 'container-fluid')


@section('content')

	<div class="curriculum">
        
        <div class="topics" style="
            grid-template-columns: 120px repeat({{ $cohorts->max('terms_per_year')  }}, 1fr);
        ">
            @for($i = 1; $i <= $cohorts->max('terms_per_year'); $i++)
				<div class="topic" style="
                    grid-column: {{ $i+1 }}
                ">p{{ str_pad($i, '2', '0', STR_PAD_LEFT) }}</div>
			@endfor
        </div>

        @foreach($cohorts as $cohort)
            <div class="term" style="
                grid-template-columns: 120px repeat({{ $cohorts->max('terms_per_year')  }}, 1fr);
                ">

				<?php
				$year_in_study = $loop->iteration;
				$term_end = $cohort->terms_per_year * $year_in_study;
				$term_start = $term_end - $cohort->terms_per_year + 1; 
				$terms = $cohort->terms()->whereBetween('order', [$term_start, $term_end])->get();
				?>

                <div class="number">
                	Jaar {{ $loop->iteration }}<br />
                    <small>{{ $cohort->title }}</small>
                </div>
                @foreach($terms as $term)
                    <div class="course" style="
                        grid-column: {{ $term->order - ($year_in_study-1)*$cohort->terms_per_year + 1 }}
                    ">
                    	@foreach($term->courses->sortBy('type_id') as $course)
                    		<a href="{{ route('courses.show', $course) }}" target="_blank">{{ $course->type->title }} {{ $course->title }}</a><br />
                    	@endforeach
                    </div>
                @endforeach
            </div>
        @endforeach 
    </div>

@endsection