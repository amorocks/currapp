@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
    
    <form method="POST" action="{{ route('assets.store', ['file', $assetable_type, $assetable_id]) }}" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Titel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="title" value="{{ old('title') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Bestand</label>
            <div class="col-sm-10">
                <input type="file" class="form-control-file" required name="file">
            </div>
        </div>
        <div class="form-group row">
            <span class="col-sm-2 col-form-label">Zichtbaarheid</span>
            <div class="col-sm-10">
                <input type="radio" name="visibility" value="student" checked id="vis-stud"><label for="vis-stud">Iedereen</label>
                <input type="radio" name="visibility" value="teacher" id="vis-teach"><label for="vis-teach">Docenten</label>
            </div>
        </div>

        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>

    </form>

@endsection
