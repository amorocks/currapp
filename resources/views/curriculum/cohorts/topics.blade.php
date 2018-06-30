@extends('layouts.app')

@section('buttons')
<a class="btn btn-outline-gray" href="{{ URL::previous() }}">
    <i class="fas fa-times" aria-hidden="true"></i> <span>Annuleren</span>
</a>
@endsection

@section('subnav')
	<nav class="navbar subnav navbar-dark bg-secondary align-items-center justify-content-between">
        <div class="d-flex align-items-center">
    		<h2 class="mr-3">{{ $qualification->title }} {{ $cohort->title }}</h2>
    		<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.show', [$qualification, $cohort]) }}">Overzicht</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qualifications.cohorts.terms.index', [$qualification, $cohort]) }}">Periodes</a>
                </li>
            </ul>
        </div>
        <div class="btn-group">
            <button disabled class="btn btn-light"><i class="fas fa-pen"></i> Leerlijnen aanpassen</a>
        </div>
	</nav>
@endsection

@section('content')

    <h3>Leerlijnen in <strong>{{ $qualification->title }} {{ $cohort->title }}</strong>:</h3>


    <form method="POST" action="{{ route('qualifications.cohorts.topics.update', [$qualification, $cohort]) }}">
        <table>
        	@foreach($topics as $topic)
                <tr>
                    <td><input type="checkbox" id="topic{{ $loop->index }}" name="topics[{{ $topic->id }}]" value="{{ $topic->id }}" @if($cohort->topics->contains($topic)) checked @endif></td>
                    <td><label for="topic{{ $loop->index }}">{{ $topic->title }}</label></td>
                </tr>
            @endforeach
        </table>
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="far fa-save" aria-hidden="true"></i> Opslaan
        </button>
    </form>

@endsection
