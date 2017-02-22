@extends('master')
@section('content')
    <h2>Campaign Details</h2>
    <div class="row">
        <div class="col-sm-5 col-md-4">
            <h3>ID</h3>
        </div>
        <div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0">
            <h3>{{ $campaign_data->id }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Status</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $campaign_data->status }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Title</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $campaign_data->title }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Plain Content</h3>
        </div>
        <div class="col-sm-5">
            <textarea cols="70" rows="10" disabled>{{ $campaign_data->plain_content }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>HTML Content</h3>
        </div>
        <div class="col-sm-5">
            <textarea cols="70" rows="10" disabled>{{ $campaign_data->html_content }}</textarea>
        </div>
    </div>
    @if($sheduled_data->send_at)
        <div class="row">
            <div class="col-sm-5">
                <h3>Campaign shedule: </h3>
            </div>
            <div class="col-sm-5">
                <h3>{{ date('d-m-Y H:i', $sheduled_data->send_at) }}</h3>
            </div>
        </div>
    @endif
    @if($lists_data)
        <div class="row">
            <div class="col-sm-5">
                <h3>Assigned Lists: </h3>
            </div>
            <div class="col-sm-5">
                <div class="row">
                    <div class="col-sm-2"><h4>List id</h4></div>
                    <div class="col-sm-6"><h4>List name</h4></div>
                    <div class="col-sm-4"><h4>Recipient count</h4></div>
                </div>
                @foreach($lists_data as $data)
                    <div class="row">
                        <div class="col-sm-2">{{ $data['id'] }}</div>
                        <div class="col-sm-6">{{ $data['name'] }}</div>
                        <div class="col-sm-3">{{ $data['recipient_count'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-5">
            <a href="{{ route('listcampaigns') }}" class="btn btn-lg btn-success" role="button">Campaign list</a>
        </div>
    </div>
@endsection