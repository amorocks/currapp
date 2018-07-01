@extends('layouts.app')
@section('content')


@foreach($user->qualifications as $q)
	@if(array_key_exists($q->id, $terms))
		<h2 class="mt-4">{{ $q->title }}</h2>
		<ul>
			
			@foreach($terms[$q->id] as $term)
				<li>
					<a href="{{ route('qualifications.cohorts.show', [$q, $term->cohort]) }}">{{ $term->title }}</a>
					<ul>
						@foreach($term->courses as $course)
							<li>{{ $course->title }}</li>
						@endforeach
					</ul>
				</li>
			@endforeach
			
		</ul>
	@endif
@endforeach

@endsection
