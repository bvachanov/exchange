@extends('app')
@section('content')



    <div class="row">
        <center><h1>{{trans('translations.registerProfessor')}}</h1></center>
        <div class="col-md-2 col-sm-1"></div>
        <div class="col-md-8 col-sm-10 col-xs-12">
            {!! Form::open(array('url' => 'admin/professor/register')) !!}
            <div class="form-group">
                  {!! Form::label('name', trans('translations.name')) !!}
                 {!! Form::text('name','' ,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">                 
                 {!! Form::label('email', trans('translations.email')) !!}
                 {!! Form::email('email','' ,['class'=>'form-control']) !!}
            </div>
             <div class="form-group">
                  {!! Form::label('first_name', trans('translations.firstName')) !!}
                 {!! Form::text('first_name','' ,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                  {!! Form::label('last_name', trans('translations.lastName')) !!}
                 {!! Form::text('last_name','' ,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                  {!! Form::label('academic_title', trans('translations.acadTitle')) !!}
                 {!! Form::text('academic_title','' ,['class'=>'form-control']) !!}
            </div>
            
           
            
           
            {!! Form::submit(trans('translations.submit')) !!}
        </div>
        <div class="col-md-2 col-sm-1"></div>
    </div>
    {!! Form::close() !!}

@endsection
