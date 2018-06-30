@extends('layouts.app')

@section('buttons')
	<a href="{{ route('courses.index') }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
	<a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-gray"><i class="fas fa-pen"></i> {{ $course->title }} aanpassen</a>
@endsection

@section('content')

@endsection
