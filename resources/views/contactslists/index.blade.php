@extends('master')
@section('content')
    <h2>Contacts list</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contacts count</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach($contacts_lists as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->recipient_count }}</td>
                    <td>
                        <a href="{{ route('viewcontacts', $list->id) }}" class="btn btn-info">View contacts</a>
                        <a href="{{ route('removecontactslistc') }}" class="btn btn-danger">Delete list</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('createcontactslist') }}" class="btn btn-lg btn-success" role="button">Add new list</a>
@endsection