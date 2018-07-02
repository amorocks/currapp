@extends('layouts.app')
@section('content')

<h2 class="mt-4">Mijn opleidingen</h2>
@foreach($terms as $term)
	<h4 class="mt-4 mb-0">
		<a href="{{ route('qualifications.cohorts.terms.show', [$term->cohort->qualification, $term->cohort, $term]) }}">
			{{ $term->cohort->qualification->title }} {{ $term->title }}
		</a>
	</h4>
	<ul>
		@foreach($term->courses as $course)
			<li>{{ $course->title }}</li>
		@endforeach
	</ul>
@endforeach

@endsection
