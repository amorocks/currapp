@extends('layouts.app')

@section('buttons')
	<a href="{{ route('courses.index') }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
	<a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-gray"><i class="fas fa-pen"></i> {{ $course->title }} aanpassen</a>
@endsection

@section('content')

	<h2>{{ $course->title }}</h2>
	<p class="mt-4 mb-0"><i class="far fa-fw fa-user"></i> Vakeigenaar: {{ $course->owner }}</p>
	<p class="mt-0 mb-3"><i class="far fa-fw fa-folder"></i> Leerlijn: {{ $course->topic->title }}</p>
	
	<h3>Planningen</h3>
	<ul>
		@foreach($course->terms as $term)
			<li>{{ $term->cohort->qualification->title }} {{ $term->cohort->title }}, {{ $term->title }}</li>
		@endforeach
	</ul>
@endsection
