@extends('app')
@section('content')


    <center><h1>{{trans('translations.editGroup')}}</h1></center>
    {!! Form::open(array('url' => array('group/edit', $group->id))) !!}
    <div class="col-md-12">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="row">
            {!! Form::label('name', trans('translations.name')) !!}
            {!! Form::text('name', $group->name, ['class'=>'form-control']) !!}       
        </div>
        <div class="row">
            {!! Form::label('description', trans('translations.description')) !!}
            {!! Form::textarea('description', $group->description , ['class'=>'form-control']) !!}      
        </div>
        <div class="row">
             {!! Form::label('discipline', trans('translations.course')) !!}  
            {!! Form::select('discipline',$disciplines, $group->course_id, ['class'=>'form-control']) !!}      
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>{{trans('translations.students')}}:</p>
        </div>
        <div class="col-md-6">
             {!! Form::label('coursesOfStudies', trans('translations.courseOfStudies')) !!}
            {!! Form::select('coursesOfStudies', [0=>'All'] + $coursesOfStudies, null, ['id'=>'course', 'class'=>'form-control']) !!}  
        </div>
        <div class="col-md-6">
             {!! Form::label('years', trans('translations.year')) !!}
            {!! Form::select('years',[0=>'All'] + $years, null,  ['id'=>'year', 'class'=>'form-control']) !!}  
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
        {!! Form::submit(trans('translations.store')) !!}

    </div>



    {!! Form::close() !!}

<script>
    $(document).ready(function () {

    @foreach($students as $student)
            $('#studentCheck{{$student->user_id}}').prop('checked', true);
    @endforeach


            $('#course').change(function () {
    var courseId = $(this).val();
    console.log(courseId);
    @foreach($users as $student)
            if ({{$student -> course_of_studies}} == courseId)
    {
    $('#student{{$student->user_id}}').show();
    $('#studentCheck{{$student->user_id}}').prop('checked', true);
    }
    else if (courseId == 0)
    {
    $('#student{{$student->user_id}}').show();
    $('#studentCheck{{$student->user_id}}').prop('checked', false);
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
    else if (year == 0)
    {
    $('#student{{$student->user_id}}').show();
    $('#studentCheck{{$student->user_id}}').prop('checked', false);
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

