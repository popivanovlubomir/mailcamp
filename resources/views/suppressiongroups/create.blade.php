@extends('master')
@section('content')
    <form method="POST" action="{{ route('savesuppressiongroup') }}">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="name" value="{{ old('name') }}" placeholder="Group name" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label col-form-label-lg" >Description</label>
            <div class="col-sm-10">
                <textarea name="description" placeholder="Description" cols="90" rows="10" required>{{ old('description') }}</textarea>
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
        {{ csrf_field() }}
        @include('includes.errors')
    </form>
    <div class="row">
        <a href="{{ route('listsuppressiongroups') }}" class="btn btn-lg btn-success" role="button">Back to groups list</a>
    </div>
@endsection