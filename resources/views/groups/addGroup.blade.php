@extends('app')
@section('content')

<div class="container">
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

