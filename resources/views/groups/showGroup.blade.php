@extends('app')
@section('content')

<div class="container">

    <center> {{$group->name}}</center>
    
    <center> {{$group->description}}</center>
    
     <center> {{$discipline->name}}</center>
     
     <h2>Students:</h2>
     @foreach ($students as $student)
     <p>{{$student->faculty_number}}</p>
     @endforeach
     
     <h2>Lectures:</h2>
     @if(!empty($lectures))
     @foreach ($lectures as $lecture)
     <p>{{$lecture->name}}</p>
     @endforeach
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
     {!! Form::submit('submit') !!}
       
    </div>
    
    
    {!! Form::close() !!}
     
</div>

@endsection

