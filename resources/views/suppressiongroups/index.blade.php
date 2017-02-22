@extends('master')
@section('content')
    <h2>Senders list</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Members</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($suppression_groups as $suppression_group)
                <tr>
                    <td>{{ $suppression_group->id }}</td>
                    <td><a href="{{ route('viewsuppressiongroup', $suppression_group->id) }}">{{ $suppression_group->name }}</a></td>
                    <td>{{ $suppression_group->description }}</td>
                    <td>{{ $suppression_group->unsubscribes }}</td>
                    <td><a href="#" class=" btn btn-info" role="button">Delete group</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('createsuppressiongroup') }}" class="btn btn-lg btn-success" role="button">Add Suppression group</a>
@endsection