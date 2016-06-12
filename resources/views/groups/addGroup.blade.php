@extends('app')
@section('content')

    <center><h1>{{trans('translations.addGroup')}}</h1></center>
    {!! Form::open(array('url' => 'group/create')) !!}
    <div class="col-md-12">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="row">
            {!! Form::label('name', trans('translations.name')) !!}
            {!! Form::text('name' , '', ['class'=>'form-control']) !!}       
        </div>

        <div class="row">
            {!! Form::label('description', trans('translations.description')) !!}
            {!! Form::textarea('description','', ['class'=>'form-control']) !!}      
        </div>
        <div class="row">
            {!! Form::label('discipline', trans('translations.course')) !!}
            {!! Form::select('discipline', $disciplines, '', ['class'=>'form-control']) !!}      
        </div>
        
    </div>
    <div class="row"> 
        <div class="col-md-12">
        <p>{{trans('translations.students')}}:</p>
        </div>
        <div class="col-md-6">
            {!! Form::label('coursesOfStudies', trans('translations.courseOfStudies')) !!}
            {!! Form::select('coursesOfStudies', $coursesOfStudies, '', ['id'=>'course', 'class'=>'form-control']) !!}  
        </div>
        <div class="col-md-6">
            {!! Form::label('years', trans('translations.year')) !!}
            {!! Form::select('years', $years, 'Select year', ['id'=>'year', 'class'=>'form-control']) !!}  
        </div>   
    </div>

    <div class="row">
        @foreach($users as $user)
        <div class="col-md-2 col-sm-3 col-sm-6" id='student{{$user->user_id}}'>
            <input type="checkbox" name="students[]" id='studentCheck{{$user->user_id}}' value="{{$user->user_id}}"><a href='{{url('/user/show', $user->user_id)}}'>{{$user->faculty_number}}</a></input>
        </div>
        @endforeach
    </div>
    <div class="row">
       
         <button class="submitButton"> {{trans('translations.store')}}</button>

    </div>



    {!! Form::close() !!}


<script>
    $(document).ready(function () {

    $('#course').change(function () {
    var courseId = $(this).val();
    console.log(courseId);
    @foreach($users as $student)
            if ({{$student -> course_of_studies}} == courseId)
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
    var year = $(this).val();
    @foreach($users as $student)
            if ({{$student -> year}} == year)
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

