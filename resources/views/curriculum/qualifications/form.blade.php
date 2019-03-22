@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($qualification->exists)
        <form method="POST" action="{{ route('qualifications.update', $qualification) }}">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="{{ route('qualifications.store') }}">
    @endif

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                @if($qualification->exists)
                    <input type="text" readonly class="form-control-plaintext" name="title" value="{{ $qualification->title }}">
                @else
                    <input type="text" class="form-control" required name="title" value="{{ old('title', $qualification->title) }}">
                @endif
                <small class="form-text text-muted">Titel kan later niet worden aangepast, de sub-titel wel.</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Sub-titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sub_title" value="{{ old('sub_title', $qualification->sub_title) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Crebo-code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="crebo" value="{{ old('crebo', $qualification->crebo) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Curriculum-coördinator</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="owner" value="{{ old('owner', $qualification->owner) }}" placeholder="ab01">
                <small class="form-text text-muted">Vul een docent-code in, bijvoorbeeld ab01.</small>
            </div>
        </div>

        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($qualification->exists)
        <a class="btn btn-danger" href="{{ route('qualifications.delete', $qualification) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection