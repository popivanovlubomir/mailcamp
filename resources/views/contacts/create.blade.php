@extends('master')
@section('content')
    <form method="POST" action="{{ route('savecontact', $list_id) }}">
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" placeholder="email" class="form-control form-control-lg" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-form-label col-form-label-lg">First Name</label>
            <div class="col-sm-10">
                <input type="text" name="first_name" placeholder="First name" class="form-control form-control-lg">
            </div>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label col-form-label-lg">Last Name</label>
            <div class="col-sm-10">
                <input type="text" name="last_name" placeholder="Last name" class="form-control form-control-lg">
            </div>
        </div>
        <input type="hidden" value="{{ $list_id }}" name="list_id">
        <input type="submit" value="Submit" class="btn btn-success">

        {{ csrf_field() }}
        @include('includes.errors')
    </form>
    <a href="{{ route('viewcontacts', $list_id) }}" class="btn btn-lg btn-info" role="button">Contacts</a>
@endsection