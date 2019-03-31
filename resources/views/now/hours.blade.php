@extends('layouts.app')

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-between">
        <div class="d-flex align-items-center">
    		<h2 class="mr-3">{{ $qualification->title }}</h2>
    		<ul class="navbar-nav">
    			@for($i = $schoolyear-1; $i < $schoolyear+3; $i++)
	                <li class="nav-item @if($i == $schoolyear) active @endif">
	                    <a class="nav-link" href="{{ route('now.show.hours', [$qualification, $i]) }}">{{ $i }} - {{ $i+1 }}</a>
	                </li>
	             @endfor
            </ul>
        </div>
        <div class="btn-group">
            <a href="{{ route('now.show.schoolyear', [$qualification, $schoolyear]) }}" class="btn btn-outline-light"><i class="fas fa-times"></i> Sluit uren</a>
        </div>
	</nav>
@endsection

@section('container', 'container-fluid')


@section('content')

	<div class="curriculum">
        
        <div class="topics" style="
            grid-template-columns: 120px repeat({{ $cohorts->max('terms_per_year')  }}, 1fr);
        ">
            @for($i = 1; $i <= $cohorts->max('terms_per_year'); $i++)
				<div class="topic" style="
                    grid-column: {{ $i+1 }}
                ">p{{ str_pad($i, '2', '0', STR_PAD_LEFT) }}</div>
			@endfor
        </div>

        <?php
        $totals_vertical = array();
        for($i = 1; $i <= $cohorts->max('terms_per_year'); $i++)
        {
            $totals_vertical[$i] = 0;
        }

        $totals_horizontal = array();
        for($i = 1; $i <= count($cohorts); $i++)
        {
            $totals_horizontal[$i] = 0;
        }
        ?>

        @foreach($cohorts as $cohort)
            <div class="term" style="
                grid-template-columns: 120px repeat({{ $cohorts->max('terms_per_year')  }}, 1fr);
                ">

				<?php
				$year_in_study = $loop->iteration;
				$term_end = $cohort->terms_per_year * $year_in_study;
				$term_start = $term_end - $cohort->terms_per_year + 1; 
				$terms = $cohort->terms()->whereBetween('order', [$term_start, $term_end])->get();
				?>

                <div class="number">
                	Jaar {{ $loop->iteration }}<br />
                    <small>{{ $cohort->title }}</small>
                </div>
                @foreach($terms as $term)
                    <div style="
                        grid-column: {{ $term->order - ($year_in_study-1)*$cohort->terms_per_year + 1 }}
                    ">
                    	@foreach($term->courses->sortBy('type_id') as $course)

                            <?php
                            $hours = $course->pivot->classes_per_week * $course->pivot->hours_per_class;
                            $totals_vertical[$term->order - ($year_in_study-1)*$cohort->terms_per_year] += $hours * 8;
                            $totals_horizontal[$year_in_study] += $hours * 8; //for 8 weeks
                            ?>

                    		<a href="{{ route('courses.show', $course) }}" target="_blank">
                                {{ $course->type->title }} {{ $course->title }} (<em>{{ $hours  }}</em>)
                            </a><br />
                    	@endforeach
                    </div>
                @endforeach
                {{--
                <div class="total" style="
                        grid-column: {{ $cohorts->max('terms_per_year') + 2 }}
                    ">
                    {{ $totals_horizontal[$year_in_study] }}
                </div>
                --}}
            </div>
        @endforeach 

        <div class="term total" style="
            grid-template-columns: 120px repeat({{ $cohorts->max('terms_per_year')  }}, 1fr);
            ">
            @foreach($totals_vertical as $key => $total)
                <div class="course" style="grid-column: {{ $key+1 }}">
                    {{ $total }}
                </div>
            @endforeach
            {{--
            <div class="course total" style="grid-column: {{ $key+2 }}">
                <strong>
                    {{ array_sum($totals_horizontal) }}
                </strong>
            </div>
            --}}
        </div>
    </div>

    <div class="alert alert-secondary my-5">
        <i class="fas fa-info fa-fw"></i> Totalen zijn slechts indicatief, gezien uitzonderingen als toetsweek, GAP-week, etc. hierin niet zijn meegenomen.
    </div>

@endsection