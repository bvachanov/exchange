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
        <h1>Exercise uploads:</h1>
        @if(count($exercises)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>Details</th>
                    <th>Group</th>
                    <th>Feedback</th>
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
        <p>No exercise uploads.</p>
        @endif
    </div>
    
     <div class="row">
        <h1>Assignment uploads:</h1>
        @if(count($assignments)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>Details</th>
                    <th>Group</th>
                    <th>Feedback</th>
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
        <p>No assignment uploads.</p>
        @endif
    </div>

</div>
@endsection