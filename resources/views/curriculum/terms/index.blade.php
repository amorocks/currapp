@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.cohorts.index', $qualification) }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
	<a href="#" class="btn btn-outline-gray"><i class="fas fa-plus"></i> Nieuwe periode</a>
@endsection

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-start">
		<h2 class="mr-3">{{ $qualification->title }} {{ $cohort->title }}</h2>
		<ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}">Overzicht</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('qualifications.cohorts.terms.index', [$qualification, $cohort]) }}">Periodes</a>
            </li>
        </ul>
	</nav>
@endsection

@section('content')

	<div class="cohort-grid" style="grid-template-columns: repeat({{ $qualification->terms_per_year }}, 1fr);">
	    @foreach ($terms as $term)
	        <a class="link-card" href="#"
	            style="grid-column: {{ $term->order_in_year }};">
	            <h4>{{ $term->title }}</h4>
	            <p class="card-text">{{ $term->sub_title }}</p>
	        </a>
	    @endforeach
	</div>

@endsection
