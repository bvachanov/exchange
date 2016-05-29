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

    <h1>{{trans('translations.courseDetails')}}</h1>

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
                    @if(Auth::id()== $course->professor_id)
                    <th>{{trans('translations.edit')}}</th>
                    @endif
                    @if(Auth::user()->account_type== 1)
                    <th>{{trans('translations.edit')}}</th>
                    <th>{{trans('translations.delete')}}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$course->name}}</td>
                    <td>{{$course->language}}</td>
                    <td>{{$course->description}}</td>
                    <td><a href='{{url('/user/show', $professor->user_id)}}'>{{$professor->academic_title.' '.$professor->first_name.' '.$professor->last_name}}</a></td>
                    <td>{{$courseOfStudies->name}}</td>
                    <td>{{$degree->name}}</td>
                     @if(Auth::id()== $course->professor_id)
                    <td><a href="{{url('course/edit', [$course->id])}}">{{trans('translations.editCourse')}}</a></td>
                    @endif
                    @if(Auth::user()->account_type== 1)
                    <td><a href="{{url('course/edit', [$course->id])}}">{{trans('translations.editCourse')}}</a></td>
                    <td><a href="{{url('course/delete', [$course->id])}}">{{trans('translations.deleteCourse')}}</a></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection


