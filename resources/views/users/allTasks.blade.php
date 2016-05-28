@extends('app')
@section('content')

<div class="container">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
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


    <div class="row">
        <h1>All exercises:</h1>       
        @if(count($exercises)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>Exercise Details</th>
                    <th>Group</th>
                    <th>End date</th>
                    <th>Count of not reviewed</th>
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
        <p>No exercises.</p>
        @endif
    </div>
    
     <div class="row">
        <h1>All assignments:</h1>
        @if(count($assignments)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>Assignment Details</th>
                    <th>Group</th>
                    <th>End date</th>
                    <th>Count of not reviewed</th>
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
        <p>No assignments.</p>
        @endif
    </div>

</div>
@endsection

