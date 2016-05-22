@extends('app')
@section('content')

<div class="container">
    <center><h1>Add Group</h1></center>
    {!! Form::open(array('url' => 'group/create')) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
     {!! Form::text('name_bg') !!}       
    </div>
    <div class="row">
     {!! Form::text('name_en') !!}      
    </div>
    <div class="row">
     {!! Form::text('name_de') !!}      
    </div>
    <div class="row">
     {!! Form::select('discipline', $disciplines, 'Select discipline') !!}      
    </div>
    
    
    @foreach($users as $user)
    <div class="row">
     <input type="checkbox" name="students[]" value="{{$user->id}}">{{$user->name}}</input>
    </div>
    @endforeach
    
    <div class="row">
     {!! Form::submit('submit') !!}
       
    </div>
    
    
    {!! Form::close() !!}

</div>

@endsection

