@extends('layouts.app')

@section('content')

    <div class="d-md-flex">
        <table class="table table-hover table-striped mr-md-5 table-sm">
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

        <table class="table table-hover table-striped ml-md-5 mt-5 mt-md-0">
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