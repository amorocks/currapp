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

@section('container', 'container-fluid')

@section('content')

	<div class="curriculum">
        
        <div class="topics" style="
            grid-template-columns: 45px repeat({{ $cohort->topics->count()  }}, 1fr) 30px;
        ">
            @foreach($topics as $topic)
                <div class="topic" style="
                    grid-column: {{ $topic_numbers[$topic->id] }}
                ">{{ $topic->title }}</div>
            @endforeach
        </div>

        @foreach($terms as $term)

            @if(!($loop->index % $qualification->terms_per_year))
                <div class="spacer"></div>
            @endif

            <div class="term" style="
                grid-template-columns: 45px repeat({{ $cohort->topics->count() ?: 1  }}, 1fr) 30px;
                ">
                <div class="number">{{ $term->title }}</div>
                @foreach($term->courses as $course)
                    <div class="course" style="
                        grid-column: {{ $topic_numbers[$course->topic->id] }}
                    ">{{ $course->title }}</div>
                @endforeach
                <a class="add-course" href="{{ route('qualifications.cohorts.terms.courses', [$qualification, $cohort, $term]) }}" style="grid-column: {{ ($cohort->topics->count() ?: 1)+2  }};"><i class="fas fa-pen"></i></a>
            </div>
        @endforeach 
    </div>

@endsection
