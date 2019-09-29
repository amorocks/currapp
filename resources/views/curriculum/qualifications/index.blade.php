@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe kwalificatie</a>
@endsection

@section('content')
@includeWhen(count($qualifications) < 1, 'layouts.empty', ['type' => 'opleiding'])

<div class="breadcrumbs">
	<small>Kwalificaties</small>
</div>
<ul class="list-unstyled qualifications">
	@foreach($qualifications as $q)
		<li>
			<a href="{{ route('qualifications.cohorts.show', [$q, 
					$q->cohorts->where('start_year', (date('m') > 6) ? date('Y') : date('Y')-1)->first()
				]) }}">
				<h2>{{ $q->title }}</h2>
				<p class="crebo">#{{ $q->crebo }}</p>
				<p>{{ $q->sub_title }}</p>
			</a>
		</li>
	@endforeach
</ul>

@endsection