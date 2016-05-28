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
    
    {!! Form::open(array('url' => 'course/create')) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        <p>Name:</p>
        {!! Form::text('name') !!}       
    </div>
     <div class="row">
        <p>Language:</p>
        {!! Form::text('language') !!}       
    </div>
    <div class="row">
        <p>Description:</p>
        {!! Form::textarea('description') !!}      
    </div>
    
    
    <div class="row">
            <p>Course:</p>
           {!! Form::select('course_of_studies', $courses, ['id'=>'course']) !!}          
    </div>
    
    <div class="row">
            <p>Professor:</p>
           {!! Form::select('professor', $professors, ['id'=>'professor']) !!}          
    </div>
    
    <div class="row">
        {!! Form::submit('submit') !!}

    </div>



    {!! Form::close() !!}
    
</div>
@endsection
