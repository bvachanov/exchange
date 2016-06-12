@extends('app')
@section('content')

    <h1>{{trans('translations.addCourse')}}</h1>
    {!! Form::open(array('url' => 'course/create')) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        {!! Form::label('name', trans('translations.name')) !!}
        {!! Form::text('name' , '', ['class'=>'form-control']) !!}       
    </div>
     <div class="row">
        {!! Form::label('language', trans('translations.lang')) !!}
        {!! Form::text('language', '', ['class'=>'form-control']) !!}       
    </div>
    <div class="row">
         {!! Form::label('description', trans('translations.description')) !!}
        {!! Form::textarea('description','', ['class'=>'form-control']) !!}      
    </div>
    
    
    <div class="row">
            {!! Form::label('course_of_studies', trans('translations.courseOfStudies')) !!}
           {!! Form::select('course_of_studies', $courses, null, ['id'=>'course' , 'class'=>'form-control']) !!}          
    </div>
    
    <div class="row">
            {!! Form::label('professor', trans('translations.prof')) !!}
           {!! Form::select('professor', $professors, null, ['id'=>'professor', 'class'=>'form-control']) !!}          
    </div>
    
    <div class="row">
        <button class="submitButton"> {{trans('translations.store')}}</button>

    </div>



    {!! Form::close() !!}

@endsection
