@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.cohorts.index', $qualification) }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
@endsection

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-between">
        <div class="d-flex align-items-center">
    		<h2 class="mr-3">{{ $qualification->title }} {{ $cohort->title }}</h2>
    		<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}">Overzicht</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.assets.index', [$qualification, $cohort]) }}">Bestanden</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.terms.index', [$qualification, $cohort]) }}">Periodes</a>
                </li>
            </ul>
        </div>
        <div class="btn-group">
            <a href="{{ route('assets.create', ['file', 'cohort', $cohort]) }}" class="btn btn-outline-light"><i class="fas fa-plus"></i> Nieuw bestand</a>
        </div>
	</nav>
@endsection

@section('content')
	
	<ul class="list-unstyled">
		@foreach($cohort->assets as $asset)
			<li>
				<a target="_blank" href="{{ route('assets.show', $asset) }}">
					<h2>{{ $asset->title }}</h2>
				</a>
			</li>
		@endforeach
	</ul>

@endsection
