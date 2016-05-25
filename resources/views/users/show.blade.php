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


    <div class="row">
        <p>Name: {{$user->name}}</p>
        <p>Email: {{$user->email}}</p>
        <p>Account type: {{$accountType}}</p>
        @if($user->account_type==2)
        <p>Academic title: {{$additionalData->academic_title}}</p>
        <p>First name: {{$additionalData->first_name}}</p>
        <p>Last name: {{$additionalData->last_name}}</p>
        @elseif ($user->account_type==3)
        <p>First name: {{$additionalData->first_name}}</p>
        <p>Last name: {{$additionalData->last_name}}</p>
        <p>Faculty number: {{$additionalData->faculty_number}}</p>
        <p>Year: {{$additionalData->year}}</p>
        <p>Academical group: {{$additionalData->group_number}}</p>
        <p>Course of studies: {{$courseOfStudies}}</p>
        @endif
    </div>
</div>
@endsection