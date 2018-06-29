@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.edit', $qualification) }}" class="btn btn-outline-gray"><i class="fas fa-pen"></i> {{ $qualification->title }} aanpassen</a>
@endsection

@section('content')
	
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
