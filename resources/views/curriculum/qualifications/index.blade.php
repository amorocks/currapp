@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe kwalificatie</a>
@endsection

@section('content')

<ul class="list-unstyled qualifications">
	<li class="d-flex justify-content-end">
		<small>Volg deze kwalificatie:</small>
	</li>
	@foreach($qualifications as $q)
		<li>
			<a href="#">
				<h2>{{ $q->title }}</h2>
				<p class="crebo">#{{ $q->crebo }}</p>
				<p>{{ $q->sub_title }}</p>
			</a>
			<div data-controller="subscribe" data-id="{{ $q->id }}">
				<i data-action="click->subscribe#toggle" class="{{ $q->is_subscribed ? 'fas' : 'far' }} fa-fw fa-bookmark fa-lg"></i>
			</div>
	</li>
	@endforeach
</ul>

@endsection