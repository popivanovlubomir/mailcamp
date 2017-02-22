@extends('master')
@section('content')
    <h2>Senders list</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nickname</th>
            <th>From data</th>
            <th>Verified</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($senders as $sender)
                <tr>
                    <td>{{ $sender->id }}</td>
                    <td><a href="{{ route('viewsender', $sender->id) }}">{{ $sender->nickname }}</a></td>
                    <td>{{ $sender->from->email }} {{ $sender->from->name }}</td>
                    <td>{{ $sender->verified->status }}</td>
                    <td><a href="{{ route('listsenders') }}" class=" btn btn-info" role="button">Resend verification mail</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('createsender') }}" class="btn btn-lg btn-success" role="button">Add Sender</a>
@endsection