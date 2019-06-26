@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($type->exists)
        <form method="POST" action="{{ route('types.update', $type) }}">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="{{ route('types.store') }}">
    @endif

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="title" value="{{ old('title', $type->title) }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Volgorde</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" required name="order" value="{{ old('order', $type->order) }}">
            </div>
        </div>
        
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($type->exists)
        <a class="btn btn-danger" href="{{ route('types.delete', $type) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection
