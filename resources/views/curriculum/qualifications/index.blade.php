@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe kwalificatie</a>
@endsection

@section('content')

<div class="breadcrumbs">
	<small>Kwalificaties</small>
</div>
<ul class="list-unstyled qualifications">
	@foreach($qualifications as $q)
		<li>
			<a href="{{ route('qualifications.cohorts.index', $q) }}">
				<h2>{{ $q->title }}</h2>
				<p class="crebo">#{{ $q->crebo }}</p>
				<p>{{ $q->sub_title }}</p>
			</a>
			@if($q->is_subscribed)
				<div>
					<a href="{{ route('qualifications.cohorts.index', $q) }}">
						<i class="fas fa-fw fa-bookmark fa-lg"></i>
					</a>
				</div>
			@endif
		</li>
	@endforeach
</ul>

@endsection