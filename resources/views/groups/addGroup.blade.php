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

    <center><h1>Add Group</h1></center>
    {!! Form::open(array('url' => 'group/create')) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        {!! Form::text('name') !!}       
    </div>
    <div class="row">
        {!! Form::textarea('description') !!}      
    </div>
    <div class="row">
        {!! Form::select('discipline', $disciplines, 'Select discipline') !!}      
    </div>


    @foreach($users as $user)
    <div class="row">
        <input type="checkbox" name="students[]" value="{{$user->user_id}}">{{$user->faculty_number}}</input>
    </div>
    @endforeach

    <div class="row">
        {!! Form::submit('submit') !!}

    </div>



    {!! Form::close() !!}

</div>

@endsection

