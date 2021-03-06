@extends('layouts.app')

@section('buttons')
	<a href="{{ route('qualifications.index') }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
@endsection

@section('subnav')
    <nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <h2 class="mr-3">{{ $qualification->title }}</h2>
            <ul class="navbar-nav">
                <?php $c = $qualification->cohorts()->where('start_year', $cohort->start_year - 1)->first(); ?>
                @if($c)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('qualifications.cohorts.show', [$qualification, $c]) }}">{{ $c->title }}</a>
                    </li>
                @endif
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}">{{ $cohort->title }}</a>
                </li>
                <?php $c = $qualification->cohorts()->where('start_year', $cohort->start_year + 1)->first(); ?>
                @if($c)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('qualifications.cohorts.show', [$qualification, $c]) }}">{{ $c->title }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endsection

@section('container', 'container-fluid')

@section('content')

    <div class="d-none d-print-block my-5">
        <h3><em>{{ $qualification->title }} {{ $cohort->title }}</em></h3>
    </div>

	<div class="curriculum">
        
        <div class="topics" style="
            grid-template-columns: 45px repeat({{ count($types)  }}, 1fr) 30px;
        ">
            <?php $order = array(); ?>
            @foreach($types as $key => $type)
                <div class="topic" style="
                    grid-column: {{ $loop->iteration+1 }}
                ">{{ $type['title'] }}</div>
                <?php $order[$type['id']] = $loop->iteration+1; ?>
            @endforeach
        </div>

    
        @foreach($cohort->terms as $term)

            @if(!($loop->index % $cohort->terms_per_year))
                <div class="spacer"></div>
            @endif

            <div class="term" style="
                grid-template-columns: 45px repeat({{ count($order) ?: 1  }}, 1fr) 30px;
                ">
                <div class="number">
                    <a href="{{ route('qualifications.cohorts.terms.courses', [$qualification, $cohort, $term]) }}">
                        {{ $term->title }}
                    </a>
                </div>
                @foreach($term->courses as $course)
                    <div class="course" style="
                        grid-column: {{ $order[$course->type->id] }}
                    ">
                        <a href="{{ route('courses.show.edition', [$course, $course->pivot]) }}" target="_blank">{{ $course->title }}</a>
                    </div>
                @endforeach
                <a class="add-course" href="{{ route('qualifications.cohorts.terms.courses', [$qualification, $cohort, $term]) }}" style="grid-column: {{ (count($order) ?: 1)+2  }};"><i class="fas fa-pen"></i></a>
            </div>
        @endforeach 
    </div>

@endsection
