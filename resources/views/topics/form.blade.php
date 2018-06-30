@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($topic->exists)
        <form method="POST" action="{{ route('topics.update', $topic) }}">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="{{ route('topics.store') }}">
    @endif

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="title" value="{{ old('title', $topic->title) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Leerlijn-coördinator</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="owner" value="{{ old('owner', $topic->owner) }}" placeholder="ab01">
                <small class="form-text text-muted">Vul een docent-code in, bijvoorbeeld ab01.</small>
            </div>
        </div>
        
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($topic->exists)
        <a class="btn btn-danger" href="{{ route('topics.delete', $topic) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection
