@extends('app')
@section('content')
<div class="container">
    <div class="row">
        @if (Session::has('flash_message_error'))
            <div class="alert alert-danger">{{ Session::get('flash_message_error') }}</div>
        @endif
        @if(count($groups)>0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Show group </th>
                    <th>Edit group</th>
                    <th>Delete group</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($groups as $group)
            <tr>
                <td>{{$group->name}}</td>
                <td> <a href="{{url('group/show', [$group->id])}}"><button>Show group</button></a></td>
                <td> <a href="{{url('group/edit', [$group->id])}}"><button>Edit group</button></a></td>
                 <td> <a href="{{url('group/delete', [$group->id])}}"><button>Delete group</button></a></td>
            </tr>
            @endforeach 
            </tbody>
        </table>
        @else
        <p>No groups created.</p>
        @endif
        <a href="{{url('group/create')}}"><button>Create group</button></a>
    </div>


</div>

@endsection