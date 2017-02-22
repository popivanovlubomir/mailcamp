@extends('master')
@section('content')
    <form method="POST" action="{{ route('savesender') }}">
        <div class="form-group row">
            <label for="nickname" class="col-sm-2 col-form-label col-form-label-lg">Nickname</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="nickname" value="{{ old('nickname') }}" placeholder="Sender nickname" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="from_name" class="col-sm-2 col-form-label col-form-label-lg">From name</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="from_name" value="{{ old('from_name') }}" placeholder="Sender from name" >
            </div>
        </div>
        <div class="form-group row">
            <label for="from_email" class="col-sm-2 col-form-label col-form-label-lg" >From email</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="from_email" value="{{ old('from_email') }}" placeholder="Sender email" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="reply_name" class="col-sm-2 col-form-label col-form-label-lg">Reply To name</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="reply_name" value="{{ old('reply_name') }}" placeholder="Sender reply to name" >
            </div>
        </div>
        <div class="form-group row">
            <label for="reply_email" class="col-sm-2 col-form-label col-form-label-lg" >Reply To email</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="reply_email" value="{{ old('reply_email') }}" placeholder="Sender reply to email" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-sm-2 col-form-label col-form-label-lg" >Address</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="address" value="{{ old('address') }}" placeholder="Sender address" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="address_2" class="col-sm-2 col-form-label col-form-label-lg" >Secondary address</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="address_2" value="{{ old('address_2') }}" placeholder="Sender secondary address">
            </div>
        </div>
        <div class="form-group row">
            <label for="city" class="col-sm-2 col-form-label col-form-label-lg" >City</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="city" value="{{ old('city') }}" placeholder="Sender city" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="country" class="col-sm-2 col-form-label col-form-label-lg" >Country</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="country" value="{{ old('country') }}" placeholder="Sender Country" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="state" class="col-sm-2 col-form-label col-form-label-lg" >State</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="state" value="{{ old('state') }}" placeholder="Sender State">
            </div>
        </div>
        <div class="form-group row">
            <label for="zip" class="col-sm-2 col-form-label col-form-label-lg" >Zip</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="zip" value="{{ old('zip') }}" placeholder="Sender Zip code">
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
        {{ csrf_field() }}
        @include('includes.errors')
    </form>
    <div class="row">
        <a href="{{ route('listsenders') }}" class="btn btn-lg btn-success" role="button">Back to senders list</a>
    </div>
@endsection