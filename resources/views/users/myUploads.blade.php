@extends('app')
@section('content')


<h1>{{trans('translations.myUploads')}}</h1>
    <div class="row">
        <h2>{{trans('translations.exercises')}}</h2>
        @if(count($exercises)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{trans('translations.exerciseDetails')}}</th>
                    <th>{{trans('translations.group')}}</th>
                    <th>{{trans('translations.feedback')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exercises as $ex)
                <tr>
                    <td><a href="{{url('studexercise/show', [$exTask[$ex->id]->id])}}">{{$exTask[$ex->id]->name}}</a></td>
                    <td><a href='{{url('studgroup/show', [$exGroup[$ex->id]->id])}}'>{{$exGroup[$ex->id]->name}}</a></td>
                    <td>{{$ex->feedback}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noUploads')}}</p>
        @endif
    </div>
    
     <div class="row">
        <h2>{{trans('translations.assignments')}}:</h2>
        @if(count($assignments)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{trans('translations.assignmentDetails')}}</th>
                    <th>{{trans('translations.group')}}</th>
                    <th>{{trans('translations.feedback')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $a)
                <tr>
                    <td><a href="{{url('studassignment/show', [$assignTask[$a->id]->id])}}">{{$assignTask[$a->id]->name}}</a></td>
                    <td><a href='{{url('studgroup/show', [$assignGroup[$a->id]->id])}}'>{{$assignGroup[$a->id]->name}}</a></td>
                    <td>{{$a->feedback}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noUploads')}}</p>
        @endif
    </div>

@endsection