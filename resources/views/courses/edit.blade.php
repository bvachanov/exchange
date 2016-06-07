@extends('app')
@section('content')

    <h1>{{trans('translations.editCourse')}}</h1>
    {!! Form::open(array('url' =>array( 'course/edit', $course->id))) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    @if(Auth::id()==$course->professor_id)
     <div class="row">
        <p>{{trans('translations.name')}}: {{$course->name}}</p>
            {!! Form::hidden('name', $course->name) !!}     
    </div>
     <div class="row">
        <p>{{trans('translations.lang')}}: {{$course->language}}</p>  
         {!! Form::hidden('language', $course->language) !!}   
    </div>
        <div class="row">
            <p>{{trans('translations.courseOfStudies')}}:{{$courses[ $course->course_of_studies]}}</p> 
            {!! Form::hidden('course_of_studies', $course->course_of_studies) !!}  
    </div>
    
    <div class="row">
            <p>{{trans('translations.prof')}}:  {{$professors[$course->professor_id]}}</p> 
            {!! Form::hidden('professor', $course->professor_id) !!}  
    </div>
    <div class="row">       
        {!! Form::label('description', trans('translations.description')) !!}
        {!! Form::textarea('description', $course->description, ['class'=>'form-control']) !!}      
    </div>
    @endif
    @if(Auth::user()->account_type==1)
    <div class="row">
        {!! Form::label('name', trans('translations.name')) !!}
        {!! Form::text('name', $course->name , ['class'=>'form-control']) !!}       
    </div>
     <div class="row">
        {!! Form::label('language', trans('translations.lang')) !!}
        {!! Form::text('language', $course->language , ['class'=>'form-control']) !!}       
    </div>
    <div class="row">
        {!! Form::label('description', trans('translations.description')) !!}
        {!! Form::textarea('description', $course->description, ['class'=>'form-control']) !!}      
    </div>
    
    
    <div class="row">
           {!! Form::label('course_of_studies', trans('translations.courseOfStudies')) !!}
           {!! Form::select('course_of_studies', $courses, $course->course_of_studies, ['id'=>'course', 'class'=>'form-control']) !!}          
    </div>
    
    <div class="row">
             {!! Form::label('professor', trans('translations.prof')) !!}
           {!! Form::select('professor', $professors, $course->professor_id ,['id'=>'professor', 'class'=>'form-control']) !!}            
    </div>
    @endif
    <div class="row">
        {!! Form::submit(trans('translations.store')) !!}

    </div>



    {!! Form::close() !!}

@endsection
