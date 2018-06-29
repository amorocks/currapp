@extends('layouts.app')
@section('content')

<h2>Mijn opleidingen</h2>
<ul>
	@foreach($user->qualifications as $q)
		<li>{{ $q->title }}</li>
	@endforeach
</ul>

@endsection
