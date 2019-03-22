@extends('layouts.app')

@section('buttons')
<a class="btn btn-outline-gray" href="{{ URL::previous() }}">
    <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
</a>
@endsection

@section('content')

    <form method="POST" action="{{ route('qualifications.cohorts.terms.store', [$qualification, $cohort]) }}">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kwalificatie</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="{{ $qualification->title }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Cohort</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="{{ $cohort->title }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Periode-nummer</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" required name="order" value="{{ old('order') }}">
            </div>
        </div>
        
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> Opslaan
        </button>

    </form>

@endsection
