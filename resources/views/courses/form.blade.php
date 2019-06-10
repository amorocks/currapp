@extends('layouts.app')

@push('head')
    <link rel="stylesheet" type="text/css" href="/trix/trix.css">
    <script type="text/javascript" src="/trix/trix.js"></script>
@endpush

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($course->exists)
        <form method="POST" action="{{ route('courses.update', $course) }}">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="{{ route('courses.store') }}">
    @endif

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="title" value="{{ old('title', $course->title) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Vaksoort</label>
            <div class="col-sm-10">
                <select class="form-control" name="type_id" id="type_id">
                    <option value="0">- kies -</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @if(old('type_id', optional($course->type)->id) == $type->id) selected @endif>{{ $type->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Vak-eigenaar</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="owner" value="{{ old('owner', $course->owner) }}" placeholder="ab01">
                <small class="form-text text-muted">Vul een docent-code in, bijvoorbeeld ab01.</small>
            </div>
        </div>
        <div class="form-group row" data-controller="modal tags" data-course="{{ $course->id }}">
            <label class="col-sm-2 col-form-label">Tags</label>
            <select name="tags[]" id="" multiple data-target="tags.select" style="display: none;">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @if($course->tags->contains($tag)) selected @endif>
                        {{ $tag->title }}
                    </option>
                @endforeach
            </select>
            <div class="col-sm-10 d-flex align-items-center" data-target="tags.tags">
                @foreach($course->tags as $tag)
                    <span id="badge-{{ $tag->id }}" class="badge badge-pill mr-2" style="background-color: {{ $tag->type->back_color }}; color: {{ $tag->type->text_color }};">{{ $tag->title }}</span>
                @endforeach
                <span id="add-link"><a data-action="click->modal#open">+ aanpassen</a></span>
                <div class="modal fade" data-target="modal.modal">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body row tags">
                                <div class="col-sm">
                                    <h5>Tags</h5>
                                    <ul data-target="tags.assigned">
                                    @foreach($course->tags as $tag)
                                    <li data-id="{{ $tag->id }}" class="d-flex align-items-center mb-2" data-action="click->tags#toggle">
                                        <i class="fas fa-fw fa-trash mr-2"></i>
                                        <span class="badge badge-pill mr-2" style="background-color: {{ $tag->type->back_color }}; color: {{ $tag->type->text_color }};">
                                            {{ $tag->title }}
                                        </span>
                                    </li>
                                    @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm">
                                    <h5>Beschikbaar</h5>
                                    <ul data-target="tags.available">
                                    @foreach($available as $tag)
                                    <li data-id="{{ $tag->id }}" class="d-flex align-items-center mb-2" data-action="click->tags#toggle">
                                        <i class="fas fa-fw fa-plus mr-2"></i>
                                        <span class="badge badge-pill mr-2" style="background-color: {{ $tag->type->back_color }}; color: {{ $tag->type->text_color }};">
                                            {{ $tag->title }}
                                        </span>
                                    </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-action="click->modal#close">
                                    <i class="fas fa-check" aria-hidden="true"></i> Klaar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Doel, relevantie en / of achterliggende gedachte van het vak</label>
            <div class="col-sm-10 py-2">
                <input type="hidden" name="description" id="description" value="{{ old('description', $course->description) }}">
                <trix-editor input="description" class="trix-content" style="min-height: 150px;"></trix-editor>
            </div>
        </div>

        
        
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($course->exists)
        <a class="btn btn-danger" href="{{ route('courses.delete', $course) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection
