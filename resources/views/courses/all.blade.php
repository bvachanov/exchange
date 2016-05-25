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


    <div class="table-responsive">
        <table class='table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Language</th>
                    <th>Description</th>
                    <th>Professor</th>
                    <th>Course of studies</th>
                    <th>Academic Degree</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td><a href="{{url('course/show', [$course->id])}}">{{$course->name}}</a></td>
                    <td>{{$course->language}}</td>
                    <td>{{$course->description}}</td>
                    <td>{{$course->academic_title." ".$course->first_name. " ".$course->last_name }}</td>
                    <td>{{$course->name_bg}}</td>
                    <td>{{$course->acad_bg}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


