@extends('app')
@section('content')
<div class="container">
    <div class="row">
        @if (Session::has('flash_message_error'))
            <div class="alert alert-danger">{{ Session::get('flash_message_error') }}</div>
        @endif
        <center><h1>{{trans('translations.myGroups')}}</h1></center>
        @if(count($groups)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{trans('translations.name')}}</th>
                    <th>{{trans('translations.showGroup')}} </th>
                    <th>{{trans('translations.editGroup')}}</th>
                    <th>{{trans('translations.deleteGroup')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($groups as $group)
            <tr>
                <td>{{$group->name}}</td>
                <td> <a href="{{url('group/show', [$group->id])}}"><button>{{trans('translations.show')}}</button></a></td>
                <td> <a href="{{url('group/edit', [$group->id])}}"><button>{{trans('translations.edit')}}</button></a></td>
                 <td> <a href="{{url('group/delete', [$group->id])}}"><button>{{trans('translations.delete')}}</button></a></td>
            </tr>
            @endforeach 
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noGroups')}}</p>
        @endif
        <a href="{{url('group/create')}}"><button>{{trans('translations.addGroup')}}</button></a>
    </div>


</div>

@endsection