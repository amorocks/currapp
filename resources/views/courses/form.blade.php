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
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Doel, relevantie en / of achterliggende gedachte van het vak</label>
            <div class="col-sm-10 py-2">
                <input type="hidden" name="description" id="description" value="{{ old('description', $course->description) }}">
                <trix-editor input="description" class="trix-content"></trix-editor>
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
