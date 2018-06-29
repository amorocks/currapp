@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.edit', $qualification) }}" class="btn btn-outline-gray"><i class="fas fa-pen"></i> {{ $qualification->title }} aanpassen</a>
	<a href="{{ route('qualifications.edit', $qualification) }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuw cohort</a>
@endsection

@section('content')
	
<div class="breadcrumbs">
	<small>Kwalificaties &gt; {{ $qualification->title }} &gt; cohorten</small>
</div>
<ul class="list-unstyled">
	@foreach($cohorts as $cohort)
		<li>
			<a href="#">
				<h2>{{ $cohort->title }}</h2>
				<p>{{ $qualification->title }}</p>
			</a>
		</li>
	@endforeach
</ul>

@endsection
