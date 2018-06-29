@extends('layouts.app')
@section('content')

<ul class="list-unstyled qualifications">
	<li class="d-flex justify-content-end">
		<small>Volg dit vak:</small>
	</li>
	@foreach($qualifications as $q)
		<li>
			<a href="#">
				<h2>{{ $q->title }}</h2>
				<p class="crebo">#{{ $q->crebo }}</p>
				<p>{{ $q->sub_title }}</p>
			</a>
			<i class="far fa-bookmark fa-lg"></i>
	</li>
	@endforeach
</ul>

@endsection