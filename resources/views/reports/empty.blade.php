@extends('layouts.app')

@section('content')

    <p>Vakken waarvan de beschrijving niet is ingevuld:</p>
    <div class="d-md-flex">
        <table class="table table-hover table-striped">
            <tr>
                <th>Vak</th>
                <th>Eigenaar</th>
            </tr>
            @foreach($courses as $course)

                <tr>
                    <td><a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></td>
                    <td>{{ $course->owner }}</td>
                </tr>

            @endforeach
        </table>
    </div>
    

@endsection