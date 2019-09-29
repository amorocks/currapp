@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
@endsection

@section('content')

    <h3>{{ $qualification->title }} {{ $term->full_title }}</h3>

    <div class="nav nav-tabs justify-content-between">
        <div class="d-flex">
            <span class="nav-item">
                <a class="nav-link" href="{{ route('qualifications.cohorts.terms.courses', [$qualification, $cohort, $term]) }}">Vakken</a>
            </span>
            <span class="nav-item">
                <a class="nav-link active" href="{{ route('qualifications.cohorts.terms.assets.index', [$qualification, $cohort, $term]) }}">Bestanden</a>
            </span>
        </div>
        <span class="nav-item">
            <a class="nav-link" href="{{ route('assets.create', ['file', 'term', $term]) }}"><i class="fas fa-plus"></i> Nieuw</a>
        </span>
    </div>
	
	<ul class="list-unstyled">
		@foreach($term->assets as $asset)
			<li>
				<a target="_blank" href="{{ route('assets.show', $asset) }}">
					<h2>{{ $asset->title }}</h2>
				</a>
			</li>
		@endforeach
	</ul>

@endsection
