@extends('master')
@section('content')
    <h2>Contacts</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            {{--<th>ID</th>--}}
            <th>Email</th>
            <th>Name</th>
            <th>Last contact actions</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    {{--<td>{{ $contact->id }}</td>--}}
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td>
                        <p>Last clicked: {{ $contact->last_clicked }}</p>
                        <p>Last emailed: {{ $contact->last_emailed }}</p>
                        <p>Last opened: {{ $contact->last_opened }}</p>
                        <p>Updated: {{ $contact->updated_at }}</p>
                    </td>
                    <td>
                        <a href="{{ route('viewcontacts', $list_id) }}" class="btn btn-info">View contacts</a>
                        <a href="{{ route('removecontactslistc') }}" class="btn btn-danger">Delete list</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('createcontact', $list_id) }}" class="btn btn-lg btn-success" role="button">Add new contact</a>
    <a href="{{ route('contactslist') }}" class="btn btn-lg btn-primary" role="button">Back to lists</a>
@endsection