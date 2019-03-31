@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($type->exists)
        <form method="POST" action="{{ route('tag-types.update', $type) }}">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="{{ route('tag-types.store') }}">
    @endif

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="title" value="{{ old('title', $type->title) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kleur</label>
            <div class="col-sm-10">
                <input type="color" required name="color" value="{{ old('color', $type->color) }}">
                <small class="form-text text-muted">Alle tags van dit type krijgen deze kleur mee.</small>
            </div>
        </div>
        
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($type->exists)
        <a class="btn btn-danger" href="{{ route('tag-types.delete', $type) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection
