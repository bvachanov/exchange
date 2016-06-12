@extends('app')
@section('content')
    <div class="row">

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
                <td> <a href="{{url('group/show', [$group->id])}}"><button class="styledButtons">{{trans('translations.show')}}</button></a></td>
                <td> <a href="{{url('group/edit', [$group->id])}}"><button class="styledButtons">{{trans('translations.edit')}}</button></a></td>
                 <td> <a href="{{url('group/delete', [$group->id])}}"><button class="styledButtons">{{trans('translations.delete')}}</button></a></td>
            </tr>
            @endforeach 
            </tbody>
        </table>
        @else
        <p>{{trans('translations.noGroups')}}</p>
        @endif
        <a href="{{url('group/create')}}"><button class="styledButtons">{{trans('translations.addGroup')}}</button></a>
    </div>
@endsection