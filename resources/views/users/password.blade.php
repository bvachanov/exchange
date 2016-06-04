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


    <div class="row">
        <center><h1>{{trans('translations.changePassword')}}</h1></center>
        <div class="col-md-2 col-sm-1"></div>
        <div class="col-md-8 col-sm-10 col-xs-12">
            {!! Form::open(array('url' => 'user/password')) !!}
            <div class="form-group">
                 <p>{{trans('translations.oldPass')}}</p>
                 {!! Form::password('old_password', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                 <p>{{trans('translations.newPass')}}</p>
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                 <p>{{trans('translations.confirmPass')}}</p>
                  {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
            </div>
           
            
           
            {!! Form::submit(trans('translations.change')) !!}
        </div>
        <div class="col-md-2 col-sm-1"></div>
    </div>
    {!! Form::close() !!}

</div>

@endsection