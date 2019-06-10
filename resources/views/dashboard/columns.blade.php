@extends('layouts.app')

@section('content')

<h2 class="mt-5 mb-4">Welkom op CurrApp 2.0</h2>

<div class="card-deck">
	<div class="card">
		<h3 class="card-title p-4 m-0">Mijn vakken</h3>
		<ul class="list-group list-group-flush">
			@foreach($my_courses as $course)
				<li class="list-group-item"><a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></li>
			@endforeach
		</ul>
	</div>
	<div class="card text-muted">
		<h3 class="card-title p-4 m-0">Mijn taken</h3>
		<ul class="list-group list-group-flush list-group-icons">
			<!-- foreach -->
		</ul>
	</div>
	<div class="card">
		<h3 class="card-title p-4 m-0">
			Incomplete vakken<br />
			<small style="font-size: 50%;">Doel, toetsing of tijden ontbreken nog</small>
		</h3>
		<ul class="list-group list-group-flush list-group-icons">
			@foreach($courses_empty as $course)
				<li class="list-group-item"><a href="{{ route('courses.edit', $course) }}" target="_blank">{{ $course->title }}<i class="fas fa-external-link-alt"></i></a></li>
			@endforeach
			@foreach($editions_empty as $edition)
				<li class="list-group-item"><a href="{{ route('courses.show.edition', [$edition->course, $edition]) }}" target="_blank">{{ $edition->course->title }} in {{ $edition->term->full_title }}<i class="fas fa-external-link-alt"></a></i></li>
			@endforeach
		</ul>
	</div>
</div>

<div class="bg-light fixed-bottom p-3">
	<h5 class="mb-0">Feedback</h5>
	<p class="mb-0">Maak <a href="https://github.com/amorocks/currapp/issues/new/choose" target="_blank">direct een issue aan</a> voor idee&euml;n, suggesties of problemen, of stuur een e-mail naar <a href="mailto:br10@rocwb.nl">br10@rocwb.nl</a>.</p>
</div>

@endsection
