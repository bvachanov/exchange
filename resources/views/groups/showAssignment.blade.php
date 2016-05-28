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
    
    
    <div class="row">
        <h1>Assignment details</h1>
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
            <tr>
                <td>{{$assignment->name}}</td>
                <td>{{$assignment->created_at}}</td>
                <td>{{$assignment->end_date}}</td>
                <td>@foreach( $assignedTo as $a)
                    {{$a->faculty_number. " "}}
                @endforeach</td>
                <td><a href="{{url('group/file/download/assignment', [$assignment->id])}}"><button>Download file</button></a></td>
                <td><a href="{{url('group/file/delete/assignment', [$assignment->id])}}"><button>Delete file</button></a></td>
            </tr>
        </tbody>
    </table>
    </div>
    
    <h1>Solutions</h1>
    @if(count($uploadsToAssignment)>0)
    <table class="table">
        <thead>
            <tr>
                <th>Faculty number</th>
                <th>Uploaded on</th>
                <th>Download</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploadsToAssignment as $upload)
            
            {!! Form::open(array('url' => array('group/assignment/feedback', $upload->id))) !!}
            <tr>
                <td>{{$authors[$upload->id]->faculty_number}}</td>
                <td>{{$upload->created_at}}</td>
                <td><a href="{{url('group/file/download/assignment/solution', [$upload->id])}}">Download file</a></td>
                <td>
                    {!! Form::textarea('feedback', $upload->feedback) !!}
                    {!!Form::submit('submit feedback')!!}
                <td>
            </tr>
            {!!Form::close()!!}
            
            @endforeach
        </tbody>
    </table>
    @else
    <p>No uploads.</p>
    @endif
    
</div>
@endsection
