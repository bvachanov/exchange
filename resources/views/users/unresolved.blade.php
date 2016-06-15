@extends('app')
@section('content')



<h1>{{trans('translations.unresolved')}}</h1>
    <div class="row">
        <h2>{{trans('translations.exercises')}}</h2>
        @if(count($exercises)>0)
        <table class="table" id="unreslovedE">
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
        <table class="table" id="unresolvedA">
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
    <script>
    $(document).ready(function(){
    $('#unresolvedE').DataTable();
    $('#unresolvedA').DataTable();
});
    </script>
@endsection