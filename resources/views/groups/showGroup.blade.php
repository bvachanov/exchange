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

    <center>Name: {{$group->name}}</center>

    <center>Description: {{$group->description}}</center>

    <center>Course: {{$discipline->name}}</center>

    <center><a href="{{url('group/edit', [$group->id])}}"><button>Edit group</button></a></center>
    <center><a href="{{url('group/delete', [$group->id])}}"><button>Delete group</button></a></center>
    <h2>Students:</h2>
    <div class="row">
        @foreach ($students as $student)
        <div class="col-md-2 col-sm-3 col-sm-6">{{$student->faculty_number}}</div>
        @endforeach
    </div>

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
                <td><a href="{{url('group/file/download/lecture', [$lecture->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete/lecture', [$lecture->id])}}"><button>Delete file</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>no lectures</p>
    @endif

    <h2>Exercises:</h2>
    @if(!empty($exercises))
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Uploaded on</th>
                <th>End Date</th>
                <th>Assigned to</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exercises as $exercise)
            <tr>
                <td><a href="{{url('group/exercise/show', [$exercise->id])}}">{{$exercise->name}}</a></td>
                <td>{{$exercise->created_at}}</td>
                <td>{{$exercise->end_date}}</td>
                <td>@foreach( $studentsToExercise[$exercise->id] as $ex)
                    {{$ex. " "}}
                @endforeach</td>
                <td><a href="{{url('group/file/download/exercise', [$exercise->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete/exercise', [$exercise->id])}}"><button>Delete file</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>no exercises</p>
    @endif

    <h2>Assignments:</h2>
    @if(!empty($assignments))
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Uploaded on</th>
                <th>End Date</th>
                <th>Assigned to</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $assignment)
            <tr>
                <td><a href="{{url('group/assignment/show', [$assignment->id])}}">{{$assignment->name}}</a></td>
                <td>{{$assignment->created_at}}</td>
                <td>{{$assignment->end_date}}</td>
                <td>@foreach( $studentsToAssignment[$assignment->id] as $ass)
                    {{$ass. " "}}
                @endforeach</td>
                <td><a href="{{url('group/file/download/assignment', [$assignment->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete/assignment', [$assignment->id])}}"><button>Delete file</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>no assignments</p>
    @endif

    <h2>Other:</h2>
    @if(!empty($others))
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
            @foreach ($others as $other)
            <tr>
                <td>{{$other->name}}</td>
                <td>{{$other->created_at}}</td>
                <td><a href="{{url('group/file/download/other', [$other->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete/other', [$other->id])}}"><button>Delete file</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>no other uploads</p>
    @endif

    <!-- lectures, exercises, assignments -->

    @include('groups.upload')
</div>
@endsection

