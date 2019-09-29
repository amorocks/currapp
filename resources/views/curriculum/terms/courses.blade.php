@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
@endsection

@section('content')

	<h3>{{ $qualification->title }} {{ $term->full_title }}</h3>

	<div class="nav nav-tabs">
		<span class="nav-item">
			<a class="nav-link active" href="{{ route('qualifications.cohorts.terms.courses', [$qualification, $cohort, $term]) }}">Vakken</a>
		</span>
		<span class="nav-item">
			<a class="nav-link" href="{{ route('qualifications.cohorts.terms.assets.index', [$qualification, $cohort, $term]) }}">Bestanden</a>
		</span>
	</div>

	<div class="courses row" data-controller="courses" data-term="{{ $term->id }}">
		<div class="col-md-6" data-controller="filter">
			<h5>Vakken in periode</h5>
			<input class="form-control" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter">
			<ul data-target="courses.assigned">
				@foreach($term->courses as $course)
					<li data-id="{{ $course->id }}" data-target="filter.list" data-action="click->courses#toggle">
						<i class="fas fa-fw fa-trash"></i>
						{{ $course->title }}
					</li>
				@endforeach
			</ul>
			<a href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}" class="btn btn-success"><i class="fas fa-check"></i> Klaar</a>
		</div>
	
		<div class="col-md-6" data-controller="filter">
			<h5>Beschikbare vakken</h5>
			<input class="form-control" placeholder="Filter lijst" type="text" data-target="filter.query" data-action="input->filter#filter">
			<ul data-target="courses.available">
				@foreach($courses as $course)
					<li data-id="{{ $course->id }}" data-target="filter.list" data-action="click->courses#toggle">
						<i class="fas fa-fw fa-plus"></i>
						{{ $course->title }}
					</li>
				@endforeach
			</ul>
		</div>
	</div>

@endsection
