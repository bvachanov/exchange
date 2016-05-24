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

    <center>Name: {{$group->name}}</center>

    <center>Description: {{$group->description}}</center>

    <center>Discipline: {{$discipline->name}}</center>

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
                <th>End Date</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($lectures as $lecture)
            <tr>
                <td>{{$lecture->name}}</td>
                <td>{{$lecture->created_at}}</td>
                <td>{{$lecture->end_date}}</td>
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
        <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Uploaded on</th>
                <th>End Date</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($exercises as $exercise)
     <tr>
                <td>{{$exercise->name}}</td>
                <td>{{$exercise->created_at}}</td>
                <td>{{$exercise->end_date}}</td>
                <td><a href="{{url('group/file/download', [$exercise->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete', [$exercise->id])}}"><button>Delete file</button></a></td>
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
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($assignments as $assignment)
      <tr>
                <td>{{$assignment->name}}</td>
                <td>{{$assignment->created_at}}</td>
                <td>{{$assignment->end_date}}</td>
                <td><a href="{{url('group/file/download', [$assignment->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete', [$assignment->id])}}"><button>Delete file</button></a></td>
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
                <th>End Date</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($others as $other)
      <tr>
                <td>{{$other->name}}</td>
                <td>{{$other->created_at}}</td>
                <td>{{$other->end_date}}</td>
                <td><a href="{{url('group/file/download', [$other->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete', [$other->id])}}"><button>Delete file</button></a></td>
            </tr>
    @endforeach
            </tbody>
    </table>
    @else
    <p>no assignments</p>
    @endif

    <!-- lectures, exercises, assignments -->

    @include('groups.upload')
</div>
@endsection

