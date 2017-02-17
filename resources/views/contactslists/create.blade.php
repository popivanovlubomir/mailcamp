@extends('master')
@section('content')
    <form method="POST" action="{{ route('savecontactslist') }}">
        <div class="form-group">
            <label for="name">List title</label>
            <input type="text" name="name" placeholder="The name of your list." required>
        </div>

        <input type="submit" value="Submit" class="btn btn-success">

        {{ csrf_field() }}
        @include('includes.errors')
    </form>
    <a href="{{ route('contactslist') }}" class="btn btn-lg btn-info" role="button">Back to contacts lists</a>
@endsection