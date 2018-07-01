@extends('layouts.app')
@section('content')


@foreach($user->qualifications as $q)
	@if(array_key_exists($q->id, $terms))
		<h2 class="mt-4">{{ $q->title }}</h2>
		<ul>
			
			@foreach($terms[$q->id] as $term)
				<li>{{ $term->title }}</li>
			@endforeach
			
		</ul>
	@endif
@endforeach

@endsection
