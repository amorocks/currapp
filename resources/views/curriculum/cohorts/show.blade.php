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
                    <a class="nav-link" href="{{ route('qualifications.cohorts.assets.index', [$qualification, $cohort]) }}">Bestanden</a>
                </li>
            </ul>
        </div>
        <div class="btn-group">
            <a href="{{ route('qualifications.cohorts.terms.create', [$qualification, $cohort]) }}" class="btn btn-outline-light"><i class="fas fa-plus"></i> Nieuwe periode</a>
        </div>
	</nav>
@endsection

@section('container', 'container-fluid')

@section('content')

	<div class="curriculum">
        
        <div class="topics" style="
            grid-template-columns: 45px repeat({{ count($types)  }}, 1fr) 30px;
        ">
            @foreach($types as $key => $type)
                <div class="topic" style="
                    grid-column: {{ $loop->iteration+1 }}
                ">{{ $type }}</div>
                <?php $types[$key] = $loop->iteration+1 ?>
            @endforeach
        </div>

        @foreach($cohort->terms as $term)

            @if(!($loop->index % $cohort->terms_per_year))
                <div class="spacer"></div>
            @endif

            <div class="term" style="
                grid-template-columns: 45px repeat({{ count($types) ?: 1  }}, 1fr) 30px;
                ">
                <div class="number">
                    {{ $term->title }}
                </div>
                @foreach($term->courses as $course)
                    <div class="course" style="
                        grid-column: {{ $types[$course->type->id] }}
                    ">{{ $course->title }}</div>
                @endforeach
                <a class="add-course" href="{{ route('qualifications.cohorts.terms.courses', [$qualification, $cohort, $term]) }}" style="grid-column: {{ (count($types) ?: 1)+2  }};"><i class="fas fa-pen"></i></a>
            </div>
        @endforeach 
    </div>

@endsection
