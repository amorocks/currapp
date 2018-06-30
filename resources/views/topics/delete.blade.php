@extends('layouts.app')

@section('buttons')
    <a class="btn btn-outline-gray" href="{{ URL::previous() }}">
        <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
    </a>
@endsection

@section('content')
  
  <h2>Weet je het zeker?</h2>
  <p>Je staat op het punt de leerlijn <strong>{{ $topic->title }}</strong> te verwijderen. Onderliggende vakken zijn hierna niet meer vindbaar!</p>
  
  <form method="POST" action="{{ route('topics.destroy', $topic) }}">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">
      <i class="far fa-trash-alt" aria-hidden="true"></i> Ga door met verwijderen
    </button>
  </form>
    
@endsection
