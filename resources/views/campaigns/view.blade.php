@extends('master')
@section('content')
    <h1>Campaign Details</h1>
    <div class="row">
        <div class=".col-sm-5 .col-md-6">
            <h2>ID</h2>
        </div>
        <div class=".col-sm-5 .col-md-6">
            <h2>{{ $campaign_data->id }}</h2>
        </div>
    </div>
    <div class="row">
        <div class=".col-sm-5 .col-md-6">
            <h2>Status</h2>
        </div>
        <div class=".col-sm-5 .col-md-6">
            <h2>{{ $campaign_data->status }}</h2>
        </div>
    </div>
    <div class="row">
        <div class=".col-sm-5 .col-md-6">
            <h2>Title</h2>
        </div>
        <div class=".col-sm-5 .col-md-6">
            <h2>{{ $campaign_data->title }}</h2>
        </div>
    </div>
    <div class="row">
        <div class=".col-sm-5 .col-md-6">
            <h2>Plain Content</h2>
        </div>
        <div class=".col-sm-5 .col-md-6">
            <h2>{{ $campaign_data->plain_content }}</h2>
        </div>
    </div>
    <div class="row">
        <div class=".col-sm-5 .col-md-6">
            <h2>HTML Content</h2>
        </div>
        <div class=".col-sm-5 .col-md-6">
            <h2>{{ $campaign_data->html_content }}</h2>
        </div>
    </div>
    @if($sheduled_data->send_at)
        <div class="row">
            <div class=".col-sm-5 .col-md-6">
                <h2>Campaign shedule: </h2>
            </div>
            <div class=".col-sm-5 .col-md-6">
                <h2>{{ $sheduled_data->send_at->format('d-m-Y i') }}</h2>
            </div>
        </div>
    @endif
    <div class="row">
        <div class=".col-sm-5 .col-md-6">
            <a href="{{ route('listcampaigns') }}" class="btn btn-lg btn-success" role="button">Campaign list</a>
        </div>
    </div>
@endsection