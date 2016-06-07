@extends('app')
@section('content')



    <h1>{{trans('translations.allTasks')}}</h1>
    <div class="row">
        <h2>{{trans('translations.allExercises')}}</h2>       
        @if(count($exercises)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{trans('translations.exerciseDetails')}}</th>
                    <th>{{trans('translations.group')}}</th>
                    <th>{{trans('translations.endDate')}}</th>
                    <th>{{trans('translations.countOfNotReviewed')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exercises as $ex)
                <tr>
                    <td><a href="{{url('group/exercise/show', [$ex->id])}}">{{$ex->name}}</a></td>
                    <td><a href='{{url('group/show', [$ex->group_id])}}'>{{$eGroupName[$ex->id]}}</a></td>
                    <td>{{$ex->end_date}}</td>
                    <td>{{$eWithoutReview[$ex->id]}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noExercises')}}</p>
        @endif
    </div>
    
     <div class="row">
        <h2>{{trans('translations.allAssignments')}}</h2>
        @if(count($assignments)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{trans('translations.assignmentDetails')}}</th>
                    <th>{{trans('translations.group')}}</th>
                    <th>{{trans('translations.endDate')}}</th>
                    <th>{{trans('translations.countOfNotReviewed')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $a)
                <tr>
                    <td><a href="{{url('group/assignment/show', [$a->id])}}">{{$a->name}}</a></td>
                    <td><a href='{{url('group/show', [$a->group_id])}}'>{{$aGroupName[$a->id]}}</a></td>
                    <td>{{$a->end_date}}</td>
                    <td>{{$aWithoutReview[$a->id]}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noAssignments')}}</p>
        @endif
    </div>

@endsection

