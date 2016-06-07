@extends('app')
@section('content')

    <center><h1>{{trans('translations.showGroup')}}</h1></center>
    <center>{{trans('translations.name')}}: {{$group->name}}</center>

    <center>{{trans('translations.description')}}: {{$group->description}}</center>

    <center>{{trans('translations.course')}}: {{$discipline->name}}</center>

    <center><a href="{{url('group/edit', [$group->id])}}"><button>{{trans('translations.edit')}}</button></a></center>
    <center><a href="{{url('group/delete', [$group->id])}}"><button>{{trans('translations.delete')}}</button></a></center>
    <h2>{{trans('translations.students')}}:</h2>
    <div class="row">
        @foreach ($students as $student)
        <div class="col-md-2 col-sm-3 col-sm-6"><a href='{{url('/user/show', $student->user_id)}}'>{{$student->faculty_number}}</a></div>
        @endforeach
    </div>

    <h2>{{trans('translations.lectures')}}:</h2>
    @if(!empty($lectures))
    <table class="table">
        <thead>
            <tr>
                <th>{{trans('translations.name')}}</th>
                <th>{{trans('translations.uploadedOn')}}</th>
                <th>{{trans('translations.download')}}</th>
                <th>{{trans('translations.delete')}}</th>
            </tr>
        </thead>
        <tbody>            
            @foreach ($lectures as $lecture)
            <tr>
                <td>{{$lecture->name}}</td>
                <td>{{$lecture->created_at}}</td>
                <td><a href="{{url('group/file/download/lecture', [$lecture->id])}}"><button>{{trans('translations.download')}}</button></a></td>
                <td><a href="{{url('group/file/delete/lecture', [$lecture->id])}}"><button>{{trans('translations.delete')}}</button></a></td>
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
                <th>{{trans('translations.assignedTo')}}</th>
                <th>{{trans('translations.download')}}</th>
                <th>{{trans('translations.delete')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exercises as $exercise)
            <tr>
                <td><a href="{{url('group/exercise/show', [$exercise->id])}}">{{$exercise->name}}</a></td>
                <td>{{$exercise->created_at}}</td>
                <td>{{$exercise->end_date}}</td>
                <td>@foreach( $studentsToExercise[$exercise->id] as $ex)
                    <a href='{{url('/user/show', $ex->user_id)}}'>{{$ex->faculty_number}}</a>
                @endforeach</td>
                <td><a href="{{url('group/file/download/exercise', [$exercise->id])}}"><button>{{trans('translations.download')}}</button></a></td>
                <td><a href="{{url('group/file/delete/exercise', [$exercise->id])}}"><button>{{trans('translations.delete')}}</button></a></td>
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
                <th>{{trans('translations.assignedTo')}}</th>
                <th>{{trans('translations.download')}}</th>
                <th>{{trans('translations.delete')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignments as $assignment)
            <tr>
                <td><a href="{{url('group/assignment/show', [$assignment->id])}}">{{$assignment->name}}</a></td>
                <td>{{$assignment->created_at}}</td>
                <td>{{$assignment->end_date}}</td>
                <td>@foreach( $studentsToAssignment[$assignment->id] as $ass)
                    <a href='{{url('/user/show', $ass->user_id)}}'>{{$ass->faculty_number}}</a>
                @endforeach</td>
                <td><a href="{{url('group/file/download/assignment', [$assignment->id])}}"><button>{{trans('translations.download')}}</button></a></td>
                <td><a href="{{url('group/file/delete/assignment', [$assignment->id])}}"><button>{{trans('translations.delete')}}</button></a></td>
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
                <th>{{trans('translations.name')}}</th>
                <th>{{trans('translations.uploadedOn')}}</th>
                <th>{{trans('translations.download')}}</th>
                <th>{{trans('translations.delete')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($others as $other)
            <tr>
                <td>{{$other->name}}</td>
                <td>{{$other->created_at}}</td>
                <td><a href="{{url('group/file/download/other', [$other->id])}}"><button>{{trans('translations.download')}}</button></a></td>
                <td><a href="{{url('group/file/delete/other', [$other->id])}}"><button>{{trans('translations.delete')}}</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>{{trans('translations.noOthers')}}</p>
    @endif

    <!-- lectures, exercises, assignments -->

    @include('groups.upload')
@endsection

