@extends('app')
@section('content')


    
    
    <div class="row">
        <h1>{{trans('translations.assignmentDetails')}}</h1>
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
            <tr>
                <td>{{$assignment->name}}</td>
                <td>{{$assignment->created_at}}</td>
                <td>{{$assignment->end_date}}</td>
                <td>@foreach( $assignedTo as $a)
                    <a href='{{url('/user/show', $a->user_id)}}'>{{$a->faculty_number}}</a>
                @endforeach</td>
                <td><a href="{{url('group/file/download/assignment', [$assignment->id])}}"><button>{{trans('translations.download')}}</button></a></td>
                <td><a href="{{url('group/file/delete/assignment', [$assignment->id])}}"><button>{{trans('translations.delete')}}</button></a></td>
            </tr>
        </tbody>
    </table>
    </div>
    
    <h1>{{trans('translations.solutions')}}</h1>
    @if(count($uploadsToAssignment)>0)
    <table class="table">
        <thead>
            <tr>
                <th>{{trans('translations.facNumber')}}</th>
                <th>{{trans('translations.uploadedOn')}}</th>
                <th>{{trans('translations.download')}}</th>
                <th>{{trans('translations.feedback')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploadsToAssignment as $upload)
            
            {!! Form::open(array('url' => array('group/assignment/feedback', $upload->id))) !!}
            <tr>
                <td>{{$authors[$upload->id]->faculty_number}}</td>
                <td>{{$upload->created_at}}</td>
                <td><a href="{{url('group/file/download/assignment/solution', [$upload->id])}}">{{trans('translations.download')}}</a></td>
                <td>
                    {!! Form::textarea('feedback', $upload->feedback) !!}
                    {!!Form::submit(trans('translations.storeFeedback'))!!}
                <td>
            </tr>
            {!!Form::close()!!}
            
            @endforeach
        </tbody>
    </table>
    @else
    <p>{{trans('translations.noSolutions')}}</p>
    @endif
    

@endsection
