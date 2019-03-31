@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($tag->exists)
        <form method="POST" action="{{ route('tags.update', $tag) }}">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="{{ route('tags.store') }}">
    @endif

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="title" value="{{ old('title', $tag->title) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tagsoort</label>
            <div class="col-sm-10">
                <select name="tag_type_id" id="tag_type_id" class="form-control">
                    <option value="0">- kies -</option>
                    @foreach($tagTypes as $type)
                        <option value="{{ $type->id }}" @if(old('tag_type_id', optional($tag->type)->id) == $type->id) selected @endif>{{ $type->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($tag->exists)
        <a class="btn btn-danger" href="{{ route('tags.delete', $tag) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection
