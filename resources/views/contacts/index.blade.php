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
                        <p>Last clicked: @if($contact->last_clicked) {{ date('d-m-Y H:i', $contact->last_clicked) }} @endif</p>
                        <p>Last emailed: @if($contact->last_emailed) {{ date('d-m-Y H:i', $contact->last_emailed) }} @endif</p>
                        <p>Last opened: @if($contact->last_opened) {{ date('d-m-Y H:i', $contact->last_opened) }} @endif</p>
                        <p>Updated: @if($contact->updated_at) {{ date('d-m-Y H:i', $contact->updated_at) }} @endif</p>
                    </td>
                    <td>
                        <a href="{{ route('viewcontacts', $list_id) }}" class="btn btn-info">Edit contact</a>
                        <a href="{{ route('removecontactslistc') }}" class="btn btn-danger">Delete contact</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('createcontact', $list_id) }}" class="btn btn-lg btn-success" role="button">Add new contact</a>
    <a href="{{ route('contactslist') }}" class="btn btn-lg btn-primary" role="button">Back to lists</a>

    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#import">Import from CSV</button>
    <div id="import" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form method="POST" action="{{ route('importcontacts', $list_id) }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Import contacts from CSV</h4>
                    </div>
                    <div class="modal-body">

                            <div class="form-group row">
                                <label class="custom-file">
                                    <input type="file" name="contacts_lits" class="custom-file-input">
                                    <span class="custom-file-control"></span>
                                </label>
                            </div>

                            {{ csrf_field() }}
                            @include('includes.errors')

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="{{ $list_id }}" name="list_id">
                        <input type="submit" value="Submit" class="btn btn-success">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @include('includes.errors')
@endsection