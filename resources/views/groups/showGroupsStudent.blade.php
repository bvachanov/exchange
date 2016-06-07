@extends('app')
@section('content')
    <div class="row">
        <center><h1>{{trans('translations.myGroups')}}</h1></center>
        @if(count($groups)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{trans('translations.name')}}</th>
                    <th>{{trans('translations.prof')}}</th>
                    <th>{{trans('translations.course')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($groups as $group)
            <tr>
                <td><a href="{{url('studgroup/show', [$group->id])}}">{{$group->name}}</a></td>
                <td><a href='{{url('/user/show', $professors[$group->id]->user_id)}}'>{{$professors[$group->id]->academic_title." ".$professors[$group->id]->first_name. " ".$professors[$group->id]->last_name }}</a></td>
                <td><a href="{{url('course/show', $courses[$group->id]->id)}}">{{$courses[$group->id]->name}}</a></td>
              
            </tr>
            @endforeach 
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noGroups')}}</p>
        @endif
        
    </div>


@endsection