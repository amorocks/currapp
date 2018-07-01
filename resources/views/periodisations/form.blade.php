@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')

    @if($periodisation->exists)
        <form method="POST" action="{{ route('periodisations.update', $periodisation) }}">
        {{ method_field('PATCH') }}
    @else
        <form method="POST" action="{{ route('periodisations.store') }}">
    @endif

        @if($periodisation->exists)
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-10">
                    {{ $periodisation->title }}
                </div>
            </div>
        @else
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-10">
                    <select class="form-control" name="term_order">
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}">{{ $i }} - {{ $i+4 }} - {{ $i+8 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Schooljaar</label>
                <div class="col-sm-10">
                    <select class="form-control" name="schoolyear">
                        @for($i = date('Y')-2; $i < date('Y')+3; $i++)
                            <option value="{{ $i }}" @if($i == date('Y')) selected @endif>{{ $i }} - {{ $i+1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        @endif
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Start-datum</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="start" value="{{ old('start', $periodisation->start) }}" placeholder="dd-mm-jjjj">
                <small class="form-text text-muted">Gebruik het formaat dd-mm-jjjj.</small>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Eind-datum</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="end" value="{{ old('end', $periodisation->end) }}" placeholder="dd-mm-jjjj">
                <small class="form-text text-muted">Je kunt toetsweken, uitloopweken, etc. het beste gewoon meetellen.</small>
            </div>
        </div>
        
        {{ csrf_field() }}

        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>


        @if($periodisation->exists)
        <a class="btn btn-danger" href="{{ route('periodisations.delete', $periodisation) }}">
            <i class="far fa-trash-alt" aria-hidden="true"></i> Verwijderen
        </a>
        @endif

    </form>

@endsection
