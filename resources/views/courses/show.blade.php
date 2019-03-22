@extends('layouts.app')

@push('head')
    <link rel="stylesheet" type="text/css" href="/trix/trix.css">
@endpush

@section('buttons')
	<a href="{{ route('courses.index') }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
	<a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-gray"><i class="fas fa-pen"></i> {{ $course->title }} aanpassen</a>
@endsection

@section('content')

<div class="course">
	<h2>{{ $course->title }}</h2>
	<table class="table table-borderless table-sm mt-4">
		<tr>
			<td><i class="far fa-fw fa-user"></i></td>
			<td>Vakeigenaar:</td>
			<td>{{ $course->owner }}</td>
		</tr>
		<tr>
			<td><i class="far fa-fw fa-folder"></i></td>
			<td>Type:</td>
			<td>{{ $course->type }}</td>
		</tr>
	</table>

	<div class="trix-content mb-4">{!! $course->description !!}</div>
	
	<h3>Edities</h3>
	<ul>
		@foreach($course->terms as $term)
			<li>{{ $term->cohort->qualification->title }} {{ $term->cohort->title }}, {{ $term->title }}</li>
		@endforeach
	</ul>
</div>
@endsection
