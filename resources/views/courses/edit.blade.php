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
    
    {!! Form::open(array('url' =>array( 'course/edit', $course->id))) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    @if(Auth::id()==$course->professor_id)
     <div class="row">
        <p>Name: {{$course->name}}</p>
            {!! Form::hidden('name', $course->name) !!}     
    </div>
     <div class="row">
        <p>Language: {{$course->language}}</p>  
         {!! Form::hidden('language', $course->language) !!}   
    </div>
        <div class="row">
            <p>Course:{{$courses[ $course->course_of_studies]}}</p> 
            {!! Form::hidden('course_of_studies', $course->course_of_studies) !!}  
    </div>
    
    <div class="row">
            <p>Professor:  {{$professors[$course->professor_id]}}</p> 
            {!! Form::hidden('professor', $course->professor_id) !!}  
    </div>
    <div class="row">
        <p>Description:</p>
        {!! Form::textarea('description', $course->description) !!}      
    </div>
    @endif
    @if(Auth::user()->account_type==1)
    <div class="row">
        <p>Name:</p>
        {!! Form::text('name', $course->name) !!}       
    </div>
     <div class="row">
        <p>Language:</p>
        {!! Form::text('language', $course->language) !!}       
    </div>
    <div class="row">
        <p>Description:</p>
        {!! Form::textarea('description', $course->description) !!}      
    </div>
    
    
    <div class="row">
            <p>Course:</p>
           {!! Form::select('course_of_studies', $courses, $course->course_of_studies, ['id'=>'course']) !!}          
    </div>
    
    <div class="row">
            <p>Professor:</p>
           {!! Form::select('professor', $professors, $course->professor_id ,['id'=>'professor']) !!}          
    </div>
    @endif
    <div class="row">
        {!! Form::submit('Store') !!}

    </div>



    {!! Form::close() !!}
    
</div>
@endsection
