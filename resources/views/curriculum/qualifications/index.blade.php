@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe kwalificatie</a>
@endsection

@section('content')

<div class="breadcrumbs d-flex justify-content-between">
	<small>Kwalificaties</small>
	<small>Volg deze kwalificatie:</small>
</div>
<ul class="list-unstyled qualifications">
	@foreach($qualifications as $q)
		<li>
			<a href="{{ route('qualifications.show', $q) }}">
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