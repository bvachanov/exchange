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
                    @if(Auth::id()== $discipline->professor_id)
                    <th>Edit</th>
                    @endif
                    @if(Auth::user()->account_type== 1)
                    <th>Edit</th>
                    <th>Delete</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$discipline->name}}</td>
                    <td>{{$discipline->language}}</td>
                    <td>{{$discipline->description}}</td>
                    <td>{{$professor->academic_title." ".$professor->first_name. " ".$professor->last_name }}</td>
                    <td>{{$course->name_bg}}</td>
                    <td>{{$degree->name_bg}}</td>
                     @if(Auth::id()== $discipline->professor_id)
                    <td>Edit</td>
                    @endif
                    @if(Auth::user()->account_type== 1)
                    <td>Edit</td>
                    <td>Delete</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection


