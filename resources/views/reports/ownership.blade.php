@extends('layouts.app')

@section('content')

    <div class="d-flex">
        <table class="table table-hover table-striped mr-5 table-sm">
            <tr>
                <th>Vak</th>
                <th>Eigenaar</th>
            </tr>
            @foreach($courses as $course)

                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->owner }}</td>
                </tr>

            @endforeach
        </table>

        <table class="table table-hover table-striped ml-5">
            <tr>
                <th>Eigenaar</th>
                <th>Telling</th>
            </tr>
            @foreach($grouped as $owner => $list)

                <tr>
                    <td>{{ $owner }}</td>
                    <td>{{ count($list) }}</td>
                </tr>

            @endforeach
        </table>
    </div>
    

@endsection