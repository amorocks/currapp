@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
  
  <h2>Weet je het zeker?</h2>
  <p>Je staat op het punt de tagsoort <strong>{{ $tagType->title }}</strong> te verwijderen. Alle onderliggende tags worden ook verwijderd!</p>
  
  <form method="POST" action="{{ route('tag-types.destroy', $tagType) }}">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">
      <i class="far fa-trash-alt" aria-hidden="true"></i> Ga door met verwijderen
    </button>
  </form>
    
@endsection
