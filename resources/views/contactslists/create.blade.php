@extends('master')
@section('content')
    <form method="POST" action="{{ route('savecontactslist') }}">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label col-form-label-lg">List title</label>
            <div class="col-sm-10">
                <input class="class="form-control form-control-lg" type="text" name="name" placeholder="The name of your list." required>
            </div>
        </div>

        <input type="submit" value="Submit" class="btn btn-success">

        {{ csrf_field() }}
        @include('includes.errors')
    </form>
    <a href="{{ route('contactslist') }}" class="btn btn-lg btn-info" role="button">Back to contacts lists</a>
@endsection