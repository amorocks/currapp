@extends('layouts.app')

@section('buttons')
	<a href="{{ route('periodisations.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe periodisering</a>
@endsection

@section('content')
@includeWhen(count($periodisations) < 1, 'layouts.empty', ['type' => 'periodisering'])

<ul class="list-unstyled">
	@foreach($periodisations as $p)
		<li>
			<a href="{{ route('periodisations.edit', $p) }}">
				<h2>{{ $p->title }}</h2>
				<p class="text-muted">{{ $p->start }} - {{ $p->end }}</p>
			</a>
		</li>
	@endforeach
</ul>

@endsection
