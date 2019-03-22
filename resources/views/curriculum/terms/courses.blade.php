@extends('layouts.app')

@section('buttons')
	<a class="btn btn-outline-gray" href="{{ URL::previous() }}"><i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span></a>
@endsection

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-between">
        <div class="d-flex align-items-center">
    		<h2 class="mr-3">{{ $qualification->title }} {{ $cohort->title }}</h2>
    		<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}">Overzicht</a>
                </li>
            </ul>
        </div>
	</nav>
@endsection

@section('content')

	<div class="courses" data-controller="filter courses" data-term="{{ $term->id }}">
		<h3>Vakken in deze periode</h3>
		<ul data-target="courses.assigned">
			@foreach($term->courses as $course)
				<li data-id="{{ $course->id }}" data-action="click->courses#toggle">
					<i class="fas fa-fw fa-trash"></i>
					{{ $course->title }}
				</li>
			@endforeach
		</ul>
		<a href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}" class="btn btn-success"><i class="fas fa-check"></i> Klaar</a>

		<h3 class="mt-5">Beschikbare vakken</h3>
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

@endsection
