@extends('layouts.app')

@section('buttons')
	<a href="{{ route('types.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe vaksoort</a>
@endsection

@section('content')

<ul class="list-unstyled">
	@foreach($types as $type)
		<li>
			<a href="{{ route('types.edit', $type) }}">
				<h2>{{ $type->title }}</h2>
			</a>
		</li>
	@endforeach
</ul>

@endsection
