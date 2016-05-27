@extends('app')
@section('content')
<div class="container">
    <div class="row">
        @if (Session::has('flash_message_error'))
            <div class="alert alert-danger">{{ Session::get('flash_message_error') }}</div>
        @endif
        @if(count($groups)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Professor </th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($groups as $group)
            <tr>
                <td><a href="{{url('studgroup/show', [$group->id])}}">{{$group->name}}</a></td>
                <td>{{$professors[$group->id]->academic_title." ".$professors[$group->id]->first_name. " ".$professors[$group->id]->last_name }}</td>
                <td><a href="{{url('course/show', $courses[$group->id]->id)}}">{{$courses[$group->id]->name}}</a></td>
              
            </tr>
            @endforeach 
            </tbody>
        </table>
        @else
        <p>No groups joined.</p>
        @endif
        
    </div>


</div>

@endsection