@extends('layouts.app')

@section('buttons')
	<a href="#" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe periode</a>
@endsection

@section('content')
	
{{ $cohort->title }}

@endsection
