@extends('app')
@section('content')

<div class="container">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong><br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (Session::has('flash_message_error'))
    <div class="alert alert-danger">{{ Session::get('flash_message_error') }}</div>
    @endif


<h1>{{trans('translations.unresolved')}}</h1>
    <div class="row">
        <h2>{{trans('translations.exercises')}}</h2>
        @if(count($exercises)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{trans('translations.exerciseDetails')}}</th>
                    <th>{{trans('translations.group')}}</th>
                    <th>{{trans('translations.endDate')}}</th>
            <thed>
            <tbody>
                @foreach($exercises as $ex)
                <tr>
                    <td><a href="{{url('studexercise/show', [$exTask[$ex->id]->id])}}">{{$exTask[$ex->id]->name}}</a></td>
                    <td><a href='{{url('studgroup/show', [$exGroup[$ex->id]->id])}}'>{{$exGroup[$ex->id]->name}}</a></td>
                    <td>{{$exTask[$ex->id]->end_date}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>{{trans('translations.allExercisesResolved')}}</p>
        @endif
    </div>
    
     <div class="row">
        <h2>{{trans('translations.assignments')}}</h2>
        @if(count($assignments)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{trans('translations.assignmentDetails')}}</th>
                    <th>{{trans('translations.group')}}</th>
                    <th>{{trans('translations.endDate')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $a)
                <tr>
                    <td><a href="{{url('studassignment/show', [$assignTask[$a->id]->id])}}">{{$assignTask[$a->id]->name}}</a></td>
                    <td><a href='{{url('studgroup/show', [$assignGroup[$a->id]->id])}}'>{{$assignGroup[$a->id]->name}}</a></td>
                    <td>{{$assignTask[$a->id]->end_date}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
         <p>{{trans('translations.allAssignmentsResolved')}}</p>
        @endif
    </div>

</div>
@endsection