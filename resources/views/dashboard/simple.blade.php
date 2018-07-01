@extends('layouts.app')
@section('content')

<h2 class="mt-4">Mijn opleidingen</h2>
<ul class="list-unstyled">
	@foreach($user->qualifications as $q)
		<li>
			<a href="{{ route('qualifications.cohorts.index', $q) }}">{{ $q->title }}</a>
		</li>
	@endforeach
</ul>

@endsection
