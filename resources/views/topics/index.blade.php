@extends('layouts.app')

@section('buttons')
	<a href="{{ route('topics.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe leerlijn</a>
@endsection

@section('content')

<ul class="list-unstyled">
	@foreach($topics as $topic)
		<li>
			<a href="{{ route('topics.show', $topic) }}">
				<h2>{{ $topic->title }}</h2>
				<p>Coördinator: {{ $topic->owner }}</p>
			</a>
		</li>
	@endforeach
</ul>

@endsection
