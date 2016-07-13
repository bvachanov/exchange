@extends('app')
@section('content')


<h1>{{trans('translations.allProfessors')}}</h1>
    <div class="row">
        @if(count($professors)>0)
        <table class="table" id="professor">
            <thead>
                <tr>
                    <th>{{trans('translations.name')}}</th>
                    <th>{{trans('translations.email')}}</th>
                    <th>{{trans('translations.delete')}}</th>  
                    <th>{{trans('translations.resetPassword')}}</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($professors as $p)
                <tr>
                    <td><a href="{{url('user/show', [$p->id])}}">{{$p->academic_title.' '.$p->first_name. " ". $p->last_name}}</a></td>
                    <td>{{$p->email}}</td>
                    <td><a href="{{url('admin/user/delete', [$p->id])}}">{{trans('translations.delete')}}</a></td>
                      <td><a href="{{url('admin/password/reset', [$p->id])}}">{{trans('translations.resetPassword')}}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noProfessors')}}</p>
        @endif
    </div>
<div class="row">
    <center><a href="{{url('/admin/professor/register')}}"><button class="styledButtons">{{trans('translations.registerProfessor')}}</button></a></center>
</div>
   
    <script>
    $(document).ready(function(){
    $('#students').DataTable();
});
    </script>

@endsection
