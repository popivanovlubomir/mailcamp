@extends('master')
@section('content')
    <form method="POST" action="{{ route('savecontact', $list_id) }}">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="email" required>
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" placeholder="First name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" placeholder="Last name">
        </div>
        <input type="hidden" value="{{ $list_id }}" name="list_id">
        <input type="submit" value="Submit" class="btn btn-success">

        {{ csrf_field() }}
        @include('includes.errors')
    </form>
    <a href="{{ route('viewcontacts', $list_id) }}" class="btn btn-lg btn-info" role="button">Contacts</a>
@endsection