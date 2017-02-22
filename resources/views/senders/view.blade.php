@extends('master')
@section('content')
    <h2>Sender Details</h2>
    <div class="row">
        <div class="col-sm-5 col-md-4">
            <h3>ID</h3>
        </div>
        <div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">
            <h3>{{ $sender_data->id }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Nickname</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->nickname }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>From data</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->from->email }} {{ $sender_data->from->name }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Reply To</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->reply_to->email }} {{ $sender_data->reply_to->name }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Address</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->address }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Address 2</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->address_2 }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>City </h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->city }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>State </h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->state }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Zip </h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->zip }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Country </h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->country }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Verified </h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $sender_data->verified->status }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Created at </h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ date('d-m-Y H:i', $sender_data->created_at) }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Updated at </h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ date('d-m-Y H:i', $sender_data->updated_at) }}</h3>
        </div>
    </div>
    <div class="row">
        <a href="{{ route('listsenders') }}" class="btn btn-lg btn-success" role="button">Back to senders list</a>
    </div>

    <div class="row">
        @include('includes.errors')
    </div>
@endsection