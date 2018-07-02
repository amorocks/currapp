@extends('layouts.app')
@section('content')

<h2 class="mt-4">Mijn opleidingen</h2>
@if(count($user->cohorts))
	<ul class="list-unstyled">
		@foreach($user->cohorts as $cohort)
			<li>
				<a href="{{ route('qualifications.cohorts.show', [$cohort->qualification, $cohort]) }}">
					{{ $cohort->qualification->title }} {{ $cohort->title }}
				</a>
			</li>
		@endforeach
	</ul>
@else
	<ul>
		<li>Je volgt nog geen opleidingen!</li>
		<li>Ga naar <em>Curriculum</em>, klik op een opleiding en <em>volg</em> jouw cohort.</li>
	</ul>
@endif

@endsection
