@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.cohorts.index', $qualification) }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
@endsection

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-between">
        <div class="d-flex align-items-center">
    		<h2 class="mr-3">{{ $qualification->title }} {{ $cohort->title }}</h2>
    		<ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}">Overzicht</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.terms.index', [$qualification, $cohort]) }}">Periodes</a>
                </li>
            </ul>
        </div>
        <div class="btn-group">
            <a href="{{ route('qualifications.cohorts.topics.edit', [$qualification, $cohort]) }}" class="btn btn-outline-light"><i class="fas fa-pen"></i> Leerlijnen aanpassen</a>
        </div>
	</nav>
@endsection

@section('content')

	<div class="curriculum">

        @foreach($topics as $topic)
            <div class="topic" style="
                grid-column: {{ $loop->iteration+1 }}
            ">{{ $topic->title }}</div>
        @endforeach

        @foreach($terms as $term)
            <div class="term" style="
                grid-row: {{ $term->order+1 }};
            ">{{ $term->title }}</div>
        @endforeach   
    </div>

@endsection
