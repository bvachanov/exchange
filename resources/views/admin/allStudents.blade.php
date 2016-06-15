@extends('app')
@section('content')


<h1>{{trans('translations.allStudents')}}</h1>
    <div class="row">
        @if(count($students)>0)
        <table class="table" id="students">
            <thead>
                <tr>
                    <th>{{trans('translations.facNumber')}}</th>
                    <th>{{trans('translations.name')}}</th>
                    <th>{{trans('translations.email')}}</th>
                    <th>{{trans('translations.delete')}}</th>  
                </tr>
            </thead>
            <tbody>
                @foreach($students as $s)
                <tr>
                    <td><a href="{{url('user/show', [$s->id])}}">{{$s->faculty_number}}</a></td>
                    <td>{{$s->first_name. " ". $s->last_name}}</td>
                    <td>{{$s->email}}</td>
                    <td><a href="{{url('admin/user/delete', [$s->id])}}">{{trans('translations.delete')}}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noStudents')}}</p>
        @endif
    </div>
<div class="row">
    <center><a href="{{url('/admin/student/register')}}"><button class="styledButtons">{{trans('translations.registerStudent')}}</button></a></center>
</div>
   
    <script>
    $(document).ready(function(){
    $('#students').DataTable();
});
    </script>

@endsection
