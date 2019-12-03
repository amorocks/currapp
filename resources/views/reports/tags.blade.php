@extends('layouts.app')

@section('content')
    
    <h3>Tags versus vakken</h3>
    <form action="{{ route('reports.tags_load') }}" method="POST" class="form-inline mb-4">
        @csrf
        <div class="input-group mr-sm-2">
            <div class="input-group-prepend"><span class="input-group-text">Tagsoort:</span></div>
            <select class="form-control" name="type_id" id="type_id">
                <option value="0">- kies -</option>
                @foreach($types as $t)
                    <option value="{{ $t->id }}" @if(old('type_id', $type->id) == $t->id) selected @endif>
                        {{ $t->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-group mr-sm-2">
            <div class="input-group-prepend"><span class="input-group-text">Cohort:</span></div>
            <select class="form-control" name="cohort_id" id="cohort_id">
                <option value="0">- kies -</option>
                @foreach($cohorts as $c)
                    <option value="{{ $c->id }}" @if(old('cohort_id', $cohort->id) == $c->id) selected @endif>
                        {{ $c->qualification->title }} {{ $c->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-outline-primary">Laden</button>
    </form>

    <table class="table table-striped">
        <tr>
            <th class="text-center" style="width: 70px;">#</th>
            <th>Tag</th>
            <th style="width: 50%;"></th>
        </tr>
        
        @foreach($tags as $tag)
            
            <?php
            $count = count($data[$tag->id]);
            if($count  > 1) $class = 'success';
            if($count == 1) $class = 'warning';
            if($count  < 1) $class = 'danger';
            ?>

            <tr data-controller="collapse" data-action="click->collapse#toggle">
                <th class="bg-{{ $class }} align-middle text-center">
                    {{ $count }}
                </th>
                <td class="align-middle">
                    {{ $tag->title }}
                </td>
                <td class="align-middle text-right">
                    @if($count)
                        <a>+ vakken</a>
                    @endif
                    <div class="collapse m-0" data-target="collapse.collapse">
                        @foreach($data[$tag->id] as $course)
                            <a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a><br />  
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </table>


@endsection