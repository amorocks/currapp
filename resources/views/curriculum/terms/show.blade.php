@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.cohorts.terms.index', [$qualification, $cohort]) }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
@endsection

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-start">
		<h2>
			{{ $qualification->title }} {{ $cohort->title }}
			&nbsp;&nbsp;&gt;&nbsp;&nbsp;
			{{ $term->title }}
		</h2>
	</nav>
@endsection

@section('content')

	<div class="term-grid">
		<div class="term-column">
			<div class="course-title">&nbsp;</div>
	        @for($i = 1; $i <= 8; $i++)
	            <div class="week-number">
	                <h5>{{ $i }}</h5>
	            </div>
	        @endfor
	    </div>

        @foreach ($term->courses as $course)
            
            <div class="term-column">
	            <div class="course-title">
	                <div>
	                    <h5>{{ $course->title }}</h5>
	                    <p>{{ $course->topic->title }}</p>
	                </div>
	            </div>
	        </div>
       	
        @endforeach
    </div>

@endsection
