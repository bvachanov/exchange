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

    <center><h1>Add Group</h1></center>
    {!! Form::open(array('url' => 'group/create')) !!}
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        <p>Name:</p>
        {!! Form::text('name') !!}       
    </div>
    <div class="row">
        <p>Description:</p>
        {!! Form::textarea('description') !!}      
    </div>
    <div class="row">
        <p>Discipline:</p>
        {!! Form::select('discipline', $disciplines, 'Select discipline') !!}      
    </div>
    
    <div class="row">
        <p>Students:</p>
        <div class="col-md-6">
            <p>Course:</p>
           {!! Form::select('coursesOfStudies', $coursesOfStudies, 'Select course', ['id'=>'course']) !!}  
        </div>
        <div class="col-md-6">
            <p>Year:</p>
           {!! Form::select('years', $years, 'Select year', ['id'=>'year']) !!}  
        </div>   
    </div>

    <div class="row">
        <p>Results:</p>
    @foreach($users as $user)
    <div class="row" id='student{{$user->user_id}}'>
        <input type="checkbox" name="students[]" id='studentCheck{{$user->user_id}}' value="{{$user->user_id}}">{{$user->faculty_number}}</input>
    </div>
    @endforeach
    </div>
    <div class="row">
        {!! Form::submit('submit') !!}

    </div>



    {!! Form::close() !!}

</div>

<script>
    $(document).ready(function () {
      
        $('#course').change(function () {
            var courseId=$(this).val();
            console.log(courseId);
            @foreach($users as $student)
            if({{$student->course_of_studies}} == courseId)
            {
                $('#student{{$student->user_id}}').show();
                $('#studentCheck{{$student->user_id}}').prop('checked', true);               
            }
            else
            {
                 $('#student{{$student->user_id}}').hide();
                $('#studentCheck{{$student->user_id}}').prop('checked', false);   
            }
            @endforeach
        });
        $('#year').change(function () {
             var year=$(this).val();
             @foreach($users as $student)
            if({{$student->year}} == year)
             {
                $('#student{{$student->user_id}}').show();
                $('#studentCheck{{$student->user_id}}').prop('checked', true);               
            }
            else
            {
                 $('#student{{$student->user_id}}').hide();
                $('#studentCheck{{$student->user_id}}').prop('checked', false);   
            }
            @endforeach
        });

    });
</script>

@endsection

