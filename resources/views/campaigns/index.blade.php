@extends('master')
@section('content')
    <h2>Campaigns list</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
                <tr>
                    <td>{{ $campaign->id }}</td>
                    <td><a href="{{ route('viewcampaign', $campaign->id) }}">{{ $campaign->title }}</a></td>
                    <td>{{ $campaign->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('createcampaign') }}" class="btn btn-lg btn-success" role="button">Add Campaign</a>
    <a href="{{ route('sendemailview') }}" class="btn btn-lg btn-success" role="button">Send Email</a>
@endsection