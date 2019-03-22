@extends('layouts.app')

@section('buttons')
<a class="btn btn-outline-gray" href="{{ URL::previous() }}">
    <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
</a>
@endsection

@section('content')

    <form method="POST" action="{{ route('qualifications.cohorts.store', $qualification) }}">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kwalificatie</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="{{ $qualification->title }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Start-jaar</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="start_year" value="{{ old('start_year', $cohort->start_year) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Duur in jaren</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="duration" value="{{ old('duration', 3) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Periodes per jaar</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" required name="terms_per_year" value="{{ old('terms_per_year', 4) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Periodes aanmaken</label>
            <div class="col-sm-10">
                <input type="checkbox" name="create_terms" value="yes" checked>
                <small class="form-text text-muted">Maakt in dit cohort vast alle periodes aan.</small>
            </div>
        </div>

        @csrf
        <button type="submit" class="btn btn-success">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
        </button>

    </form>

@endsection
