@extends('layouts.app')

@section('content')

<div class="breadcrumbs">
	<small>Kwalificaties</small>
</div>
<ul class="list-unstyled qualifications">
	@foreach($qualifications as $q)
		<li>
			<a href="{{ route('now.show', $q) }}">
				<h2>{{ $q->title }}</h2>
				<p class="crebo">#{{ $q->crebo }}</p>
				<p>{{ $q->sub_title }}</p>
			</a>
		</li>
	@endforeach
</ul>

@endsection