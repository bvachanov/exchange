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
    
    <h1>Assignment details</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Uploaded on</th>
                <th>End Date</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <td>{{$assignment->name}}</td>
                <td>{{$assignment->created_at}}</td>
                <td>{{$assignment->end_date}}</td>
                <td><a href="{{url('group/file/download/assignment', [$assignment->id])}}"><button>Download file</button></a></td>              
            </tr>
            
        </tbody>
    </table>
    
    <h>Uploaded solutions:</h>
    @if(count($solutions)>0)
    <table class="table">
        <thead>
            <tr>
                <th>Uploaded on</th>
                <th>Feedback</th>
                <th>Download</th> 
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solutions as $solution)
            <tr>
                <td>{{$solution->created_at}}</td>
                <td>{{$solution->feedback}}</td>
                <td><a href="{{url('group/file/download/assignment/solution', [$solution->id])}}"><button>Download file</button></a></td>  
                <td><a href="{{url('group/file/delete/assignment/solution', [$solution->id])}}"><button>Delete file</button></a></td>
            </tr> 
            @endforeach
        </tbody>
    </table>
    @else
    <p>No solutions uploaded.</p>
    @endif
  @include('assignments.uploadAssignment')  
</div>
@endsection