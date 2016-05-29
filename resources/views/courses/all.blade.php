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

    <h1>{{trans('translations.allCourses')}}</h1>
    <div class="table-responsive">
        <table class='table'>
            <thead>
                <tr>
                    <th>{{trans('translations.name')}}</th>
                    <th>{{trans('translations.lang')}}</th>
                    <th>{{trans('translations.description')}}</th>
                    <th>{{trans('translations.prof')}}</th>
                    <th>{{trans('translations.courseOfStudies')}}</th>
                    <th>{{trans('translations.degree')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td><a href="{{url('course/show', [$course->id])}}">{{$course->name}}</a></td>
                    <td>{{$course->language}}</td>
                    <td>{{$course->description}}</td>
                    <td><a href='{{url('/user/show', $course->user_id)}}'>{{$course->academic_title." ".$course->first_name. " ".$course->last_name }}</a></td>
                    <td>{{$course->course_name}}</td>
                    <td>{{$course->acad}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(Auth::user()->account_type==1)
    <div class="row">
        <center> <a href="{{url('course/create')}}"><button>{{trans('translations.addCourse')}}</button></a> </center>
    </div>
    @endif
</div>
@endsection


