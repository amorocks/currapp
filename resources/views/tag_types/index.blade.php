@extends('layouts.app')

@section('buttons')
	<a href="{{ route('tag-types.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe tagsoort</a>
@endsection

@section('content')

<ul class="list-unstyled mt-5">
	@foreach($types as $type)
		<li>
			<a href="{{ route('tag-types.edit', $type) }}" class="d-flex align-items-center">
				<span class="color-circle mr-3" style="background-color: {{ $type->color }}"></span>
				<h2>{{ $type->title }}</h2>
			</a>
		</li>
	@endforeach
</ul>

@endsection
