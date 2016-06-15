@extends('app')
@section('content')


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
                    @if($course->user_id!=null)
                    <td><a href='{{url('/user/show', $course->user_id)}}'>{{$course->academic_title." ".$course->first_name. " ".$course->last_name }}</a></td>
                    @else
                    <td>{{trans('translations.noProfessor')}}</td>
                    @endif
                    <td>{{$course->course_name}}</td>
                    <td>{{$course->acad}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(Auth::user()->account_type==1)
    <div class="row">
        <center> <a href="{{url('course/create')}}"><button class="styledButtons">{{trans('translations.addCourse')}}</button></a> </center>
    </div>
    @endif

@endsection


