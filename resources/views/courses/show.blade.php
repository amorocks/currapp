@extends('layouts.app')

@push('head')
    <link rel="stylesheet" type="text/css" href="/trix/trix.css">
@endpush

@section('buttons')
	<a href="{{ route('courses.index') }}" class="btn btn-outline-gray"><i class="fas fa-chevron-up"></i> Omhoog</a>
	<a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-gray"><i class="fas fa-pen"></i> {{ $course->title }} aanpassen</a>
@endsection

@section('content')

<div class="course">
	<div class="d-flex justify-content-between">
		<div>
			<h2 class="mb-0">{{ $course->title }}</h2>
			<p class="lead font-weight-bold text-muted mb-0">{{ $course->type }}, vakeigenaar {{ $course->owner }}</p>
		</div>
		<div>
			@foreach($course->tags as $tag)
				<span class="badge badge-pill" style="background-color: {{ $tag->type->back_color }}; color: {{ $tag->type->text_color }};">{{ $tag->title }}</span>
			@endforeach
		</div>
	</div>

	@unless(empty($course->link))
		<div><a href="{{ $course->link }}" target="_blank">{{ $course->title }} op Itslearning <i class="fas fa-external-link-alt"></i></a></div>
	@endunless

	<div class="trix-content my-4">
		{!! $course->description ?? '<p><a class="underline" href="' . route('courses.edit', $course) . '">Vul het doel, relevantie en gedachte achter het vak in.</a></p>' !!}
	</div>
	

	@forelse($terms as $term)
	<div data-controller="modal">

		<!-- card -->
		<div class="card my-4 @if(optional($edition)->id == $term->pivot->id) border-secondary mb-5 emphasise @endif">
			<h4 class="card-header @if(optional($edition)->id == $term->pivot->id) bg-secondary text-white @endif">Editie {{ $term->full_title }}</h4>
			<div class="card-body">
				<p class="card-text">
					<i class="far fa-fw fa-clock"></i>
					@if($term->pivot->hours_per_class != null)
						 {{ $term->pivot->classes_per_week }} keer per week {{ $term->pivot->hours_per_class }} uur
					@else
						<a data-action="click->modal#open" class="underline">Tijden instellen</a>
					@endif
				</p>
				<p class="card-text">
					<i class="fas fa-fw fa-list-ol"></i>
					Toetsing: {!! $term->pivot->review ?? '<a data-action="click->modal#open" class="underline">nog invullen</a>.' !!}
				</p>
				<a data-action="click->modal#open" class="card-link text-secondary">Aanpassen</a>
				<a href="{{ route('qualifications.cohorts.show', [$term->cohort->qualification, $term->cohort]) }}" class="card-link text-secondary" target="_blank">Naar periode</a>
			</div>
		</div>

		<!-- modal -->
		<div class="modal fade" data-target="modal.modal">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<form method="POST" action="{{ route('editions.update', $term->pivot) }}">
        				{{ method_field('PATCH') }}
        				{{ csrf_field() }}
						<div class="modal-header">
							<h5 class="modal-title">{{ $course->title }} in {{ $term->full_title }}</h5>
						</div>
						<div class="modal-body">
							<div class="form-group">
            					<label for="classes_per_week" class="col-form-label">Aantal lessen per week:</label>
            					<input type="number" class="form-control" id="classes_per_week" name="classes_per_week" required value="{{ $term->pivot->classes_per_week }}">
          					</div>
          					<div class="form-group">
            					<label for="hours_per_class" class="col-form-label">Aantal uren per les:</label>
            					<input type="number" class="form-control" id="hours_per_class" name="hours_per_class" step="0.5" required value="{{ $term->pivot->hours_per_class }}">
          					</div>
          					<div class="form-group">
            					<label for="review" class="col-form-label">Beschrijf de toetsing van deze editie:</label>
            					<textarea rows="3" class="form-control" id="review" name="review" required>{{ $term->pivot->review }}</textarea>
          					</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-action="click->modal#close">
								<i class="fas fa-times" aria-hidden="true"></i> Sluiten
							</button>
							<button type="submit" class="btn btn-success">
					            <i class="far fa-save"></i> Opslaan
					        </button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	@empty
	
		<p class="mt-5"><em>Dit vak is nog niet gekoppeld aan een periode.<br />Ga daarvoor naar <a href="{{ route('qualifications.index') }}">Cohorten</a>, kies een opleiding, cohort, en pas de periode aan.</em></p>
	
	@endforelse

</div>
@endsection
	