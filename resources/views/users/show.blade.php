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

    <h1>{{trans('translations.userDetails')}}</h1>
    <div class="row">
        <p>{{trans('translations.name')}}: {{$user->name}}</p>
        <p>{{trans('translations.email')}}: {{$user->email}}</p>
        <p>{{trans('translations.accType')}}: {{$accountType}}</p>
        @if($user->account_type==2)
        <p>{{trans('translations.acadTitle')}}: {{$additionalData->academic_title}}</p>
        <p>{{trans('translations.firstName')}}: {{$additionalData->first_name}}</p>
        <p>{{trans('translations.lastName')}}: {{$additionalData->last_name}}</p>
        @elseif ($user->account_type==3)
        <p>{{trans('translations.firstName')}}: {{$additionalData->first_name}}</p>
        <p>{{trans('translations.lastName')}}: {{$additionalData->last_name}}</p>
        <p>{{trans('translations.facNumber')}}: {{$additionalData->faculty_number}}</p>
        <p>{{trans('translations.year')}}: {{$additionalData->year}}</p>
        <p>{{trans('translations.acadGroup')}}: {{$additionalData->group_number}}</p>
        <p>{{trans('translations.courseOfStudies')}}: {{$courseOfStudies}}</p>
        @endif
    </div>
</div>
@endsection