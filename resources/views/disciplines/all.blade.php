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
                @foreach($disciplines as $discipline)
                <tr>
                    <td><a href="{{url('discipline/show', [$discipline->id])}}">{{$discipline->name}}</a></td>
                    <td>{{$discipline->language}}</td>
                    <td>{{$discipline->description}}</td>
                    <td>{{$discipline->academic_title." ".$discipline->first_name. " ".$discipline->last_name }}</td>
                    <td>{{$discipline->name_bg}}</td>
                    <td>{{$discipline->acad_bg}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


