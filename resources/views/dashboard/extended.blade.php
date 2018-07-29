@extends('layouts.app')
@section('content')

<h2 class="mt-4">Welkom, {{ Auth::user()->first_name }}</h2>
<p>Dit zijn de opleidingen die je volgt:</p>
@foreach($terms as $term)
	
	<div class="dashboard-item">
		<h3>
			{{ $term->cohort->qualification->title }}
			@if(Auth::user()->type == 'teacher')
				{{ $term->cohort->title }}
			@endif
		</h3>	
		<div class="content">
			<div>
				<p>Het is nu <a href="{{ route('qualifications.cohorts.terms.show', [$term->cohort->qualification, $term->cohort, $term]) }}">{{ $term->title }}</a>, met daarin de vakken:</p>	
				<ul>
					@foreach($term->courses as $course)
						<li>{{ $course->title }}</li>
					@endforeach
				</ul>
			</div>
			@includeWhen(count($term->cohort->assets), 'dashboard.partials.assets')
		</div>
	</div>
@endforeach

@endsection
