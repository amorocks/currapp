@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.cohorts.index', $qualification) }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
@endsection

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-start">
		<h2 class="mr-3">
			<a href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}">{{ $qualification->title }} {{ $cohort->title }}</a>
			&nbsp;&nbsp;&gt;&nbsp;&nbsp; {{ $term->title }}
		</h2>
	</nav>
@endsection

@section('content')

	@foreach($term->courses as $course)
		<p>{{ $course->title }}</p>
	@endforeach

@endsection
