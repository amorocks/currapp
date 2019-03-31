@extends('layouts.app')

@section('buttons')
	<a href="{{ route('tags.create') }}" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe tag</a>
@endsection

@section('content')
@includeWhen(count($tags) < 1, 'layouts.empty', ['type' => 'tag'])

<ul class="list-unstyled mt-5">
	@foreach($tags as $tag)
		<li>
			<a href="{{ route('tags.edit', $tag) }}">
				<h2>{{ $tag->title }}</h2>
				<small class="d-flex align-items-center">
					<span class="color-circle mr-2" style="background-color: {{ $tag->type->color }}"></span>
					{{ $tag->type->title }}
				</small>
			</a>
		</li>
	@endforeach
</ul>

@endsection
