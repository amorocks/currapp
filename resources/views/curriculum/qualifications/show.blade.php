@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.edit', $qualification) }}" class="btn btn-outline-gray"><i class="fas fa-pen"></i> {{ $qualification->title }} aanpassen</a>
@endsection
