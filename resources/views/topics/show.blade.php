@extends('layouts.app')

@section('buttons')
	<a href="{{ route('topics.index') }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
	<a href="{{ route('topics.edit', $topic) }}" class="btn btn-outline-gray"><i class="fas fa-pen"></i> {{ $topic->title }} aanpassen</a>
@endsection

@section('content')

@endsection
