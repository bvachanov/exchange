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

    <center> {{$group->name}}</center>

    <center> {{$group->description}}</center>

    <center> {{$discipline->name}}</center>

    <h2>Students:</h2>
    @foreach ($students as $student)
    <p>{{$student->faculty_number}}</p>
    @endforeach

    <h2>Lectures:</h2>
    @if(!empty($lectures))
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Uploaded on</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($lectures as $lecture)
            <tr>
                <td>{{$lecture->name}}</td>
                <td>{{$lecture->created_at}}</td>
                <td><a href="{{url('group/file/download', [$lecture->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete', [$lecture->id])}}"><button>Delete file</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>no lectures</p>
    @endif

    <h2>Exercises:</h2>
    @if(!empty($exercises))
    @foreach ($exercises as $exercise)
    <p>{{$exercise->name}}</p>
    @endforeach
    @else
    <p>no exercises</p>
    @endif

    <h2>Assignments:</h2>
    @if(!empty($assignments))
    @foreach ($assignments as $assignment)
    <p>{{$assignment->name}}</p>
    @endforeach
    @else
    <p>no assignments</p>
    @endif

    <!-- lectures, exercises, assignments -->

    <h2>upload file</h2>

    {!! Form::open(array('url' => array('group/upload', $group->id ), 'files' => true )) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        {!! Form::text('name') !!}       
    </div>
    <div class="row">
        {!! Form::file('file') !!}      
    </div>
    <div class="row">
        {!! Form::select('type', $materialTypes, 'Select type') !!}      
    </div>

    <div class="row">
        {!!Form::hidden('is_public',0)!!}
        <input type="checkbox" name="is_public" value="1">public</input>
    </div>


    <div class="row">
        {!! Form::submit('submit') !!}

    </div>


    {!! Form::close() !!}

</div>

@endsection

