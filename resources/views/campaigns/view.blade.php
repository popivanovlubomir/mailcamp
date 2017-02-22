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
    <div class="row">
        <div class="col-sm-5">
            <h3>Subject</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ $campaign_data->subject }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <h3>Categories</h3>
        </div>
        <div class="col-sm-5">
            <h3>{{ implode(", ", $campaign_data->categories )}}</h3>
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
        <button type="button" class="btn btn-info btn-danger btn-lg" data-toggle="modal" data-target="#sendCampaign">Send Campaign</a>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sendTest">Send test email</button>
        <a href="{{ route('listcampaigns') }}" class="btn btn-lg btn-success" role="button">Back to campaign list</a>
    </div>

    <div id="sendTest" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form method="POST" action="{{ route('testcampaign', $campaign_data->id ) }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Send test campaign email</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="subject" class="col-sm-2 col-form-label col-form-label-lg" >Email</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" name="email" value="{{ old('email') }}" placeholder="The email to send to" required>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <p>Important: If your email persists in unsubscribed group of the campaign you will not receive it!</p>
                            </div>
                        </div>

                        {{ csrf_field() }}


                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="{{ $campaign_data->id }}" name="campaign_id">
                        <input type="submit" value="Send" class="btn btn-success">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="sendCampaign" class="modal alert-danger fade" tabindex="-1" role="alertdialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form method="POST" action="{{ route('sendcampaign') }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirm sending campaign!</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <p>Please confirm sending the Campaign!</p>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="{{ $campaign_data->id }}" name="campaign_id">
                        <input type="submit" value="Confirm" class="btn btn-success">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        @include('includes.errors')
    </div>
@endsection