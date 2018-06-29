@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
  
  <h2>Weet je het zeker?</h2>
  <p>Je staat op het punt de kwalificatie <strong>{{ $qualification->title }}</strong> te verwijderen. Alle onderliggend cohorten, vakken, etc. worden ook verwijderd!</p>
  
  <form method="POST" action="{{ route('qualifications.destroy', $qualification) }}">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">
      <i class="far fa-trash-alt" aria-hidden="true"></i> Ga door met verwijderen
    </button>
  </form>
    
@endsection
