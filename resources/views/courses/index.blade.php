@extends('layouts.app')

@section('buttons')
	<a href="{{ route('courses.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuw vak</a>
@endsection

@section('content')
@includeWhen(count($courses) < 1, 'layouts.empty', ['type' => 'vak'])

<ul class="list-unstyled">
	@foreach($courses as $course)
		<li>
			<a href="{{ route('courses.show', $course) }}">
				<h2>{{ $course->title }}</h2>
				<p>{{ $course->type->title }}, vakeigenaar: {{ $course->owner }}</p>
			</a>
		</li>
	@endforeach
</ul>

@endsection
