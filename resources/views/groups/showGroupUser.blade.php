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

   <center><h1>{{trans('translations.showGroup')}}</h1></center>
    <center>{{trans('translations.name')}}: {{$group->name}}</center>

    <center>{{trans('translations.description')}}: {{$group->description}}</center>

    <center>{{trans('translations.course')}}: {{$discipline->name}}</center>
    
    <center>{{trans('translations.prof')}}: <a href='{{url('/user/show', $professor->user_id)}}'>{{$professor->academic_title.' '.$professor->first_name.' '.$professor->last_name}}</a> </center>

   

<h2>{{trans('translations.lectures')}}:</h2>
    @if(!empty($lectures))
    <table class="table">
        <thead>
            <tr>
                <th>{{trans('translations.name')}}</th>
                <th>{{trans('translations.uploadedOn')}}</th>
                <th>{{trans('translations.download')}}</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($lectures as $lecture)
            <tr>
                <td>{{$lecture->name}}</td>
                <td>{{$lecture->created_at}}</td>
                <td><a href="{{url('group/file/download/lecture', [$lecture->id])}}"><button>{{trans('translations.download')}}</button></a></td>             
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>{{trans('translations.noLectures')}}</p>
    @endif

    <h2>{{trans('translations.exercises')}}:</h2>
    @if(!empty($exercises))
    <table class="table">
        <thead>
            <tr>
                <th>{{trans('translations.name')}}</th>
                <th>{{trans('translations.uploadedOn')}}</th>
                <th>{{trans('translations.endDate')}}</th>
                <th>{{trans('translations.download')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exercises as $exercise)
            <tr>
                <td><a href="{{url('studexercise/show', [$exercise->id])}}">{{$exercise->name}}</a></td>
                <td>{{$exercise->created_at}}</td>
                <td>{{$exercise->end_date}}</td>
                <td><a href="{{url('group/file/download/exercise', [$exercise->id])}}"><button>{{trans('translations.download')}}</button></a></td>              
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>{{trans('translations.noExercises')}}</p>
    @endif

    <h2>{{trans('translations.assignments')}}:</h2>
    @if(!empty($assignments))
    <table class="table">
        <thead>
            <tr>
                <th>{{trans('translations.name')}}</th>
                <th>{{trans('translations.uploadedOn')}}</th>
                <th>{{trans('translations.endDate')}}</th>
                <th>{{trans('translations.download')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $assignment)
            <tr>
                <td><a href="{{url('studassignment/show', [$assignment->id])}}">{{$assignment->name}}</a></td>
                <td>{{$assignment->created_at}}</td>
                <td>{{$assignment->end_date}}</td>
                <td><a href="{{url('group/file/download/assignment', [$assignment->id])}}"><button>{{trans('translations.download')}}</button></a></td>              
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>{{trans('translations.noAssignments')}}</p>
    @endif

    <h2>{{trans('translations.others')}}:</h2>
    @if(!empty($others))
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Uploaded on</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($others as $other)
            <tr>
                <td>{{$other->name}}</td>
                <td>{{$other->created_at}}</td>
                <td><a href="{{url('group/file/download/other', [$other->id])}}"><button>{{trans('translations.download')}}</button></a></td>
              
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>{{trans('translations.noOthers')}}</p>
    @endif

</div>
@endsection

