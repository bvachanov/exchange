@extends('app')
@section('content')

    <h1>{{trans('translations.assignmentDetails')}}</h1>
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
            
            <tr>
                <td>{{$assignment->name}}</td>
                <td>{{$assignment->created_at}}</td>
                <td>{{$assignment->end_date}}</td>
                <td><a href="{{url('group/file/download/assignment', [$assignment->id])}}"><button class="styledButtons">{{trans('translations.download')}}</button></a></td>              
            </tr>
            
        </tbody>
    </table>
    
      <h1>{{trans('translations.solutions')}}</h1>
    @if(count($solutions)>0)
    <table class="table">
        <thead>
            <tr>
                <th>{{trans('translations.uploadedOn')}}</th>
                <th>{{trans('translations.feedback')}}</th>
                <th>{{trans('translations.download')}}</th> 
                <th>{{trans('translations.delete')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solutions as $solution)
            <tr>
                <td>{{$solution->created_at}}</td>
                <td>{{$solution->feedback}}</td>
                <td><a href="{{url('group/file/download/exercise/solution', [$solution->id])}}"><button class="styledButtons">{{trans('translations.download')}}</button></a></td>  
                <td><a href="{{url('group/file/delete/exercise/solution', [$solution->id])}}"><button class="styledButtons">{{trans('translations.delete')}}</button></a></td>
            </tr> 
            @endforeach
        </tbody>
    </table>
    @else
    <p>{{trans('translations.noSolutions')}}</p>
    @endif
  @include('assignments.uploadAssignment')  

@endsection