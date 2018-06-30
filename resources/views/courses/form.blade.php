@extends('layouts.app')

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
            <label class="col-sm-2 col-form-label">Leerlijn</label>
            <div class="col-sm-10">
                <select class="form-control" name="topic_id" id="topic_id">
                    <option value="0">- kies -</option>
                    @foreach($topics as $topic)
                        <option value="{{ $topic->id }}" @if(old('topic_id', $course->topic->id) == $topic->id) selected @endif>{{ $topic->title }}</option>
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
