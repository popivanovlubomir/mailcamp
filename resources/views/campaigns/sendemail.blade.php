@extends('master')
@section('content')
    <form method="POST" action="{{ route('sendmassemail') }}" enctype="multipart/form-data">
      {{--  <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label col-form-label-lg">Title</label>
            <div class="col-sm-10">
                <input type="text" name="title" placeholder="Title of the campaign" class="form-control form-control-lg" required>
            </div>
        </div>--}}
        <div class="form-group row">
            <label for="subject" class="col-sm-2 col-form-label col-form-label-lg">Subject</label>
            <div class="col-sm-10">
                <input type="text" name="subject" placeholder="Subject" class="form-control form-control-lg" value="{{ old('subject') }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="plain_content" class="col-sm-2 col-form-label col-form-label-lg">Body plain text</label>
            <div class="col-sm-10">
                <textarea name="plain_content" placeholder="The plain text of your email" value="{{ old('plain_content') }}" cols="90" rows="20"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="html_content" class="col-sm-2 col-form-label col-form-label-lg">Body html</label>
            <div class="col-sm-10">
                <textarea class="richtext" name="html_content" placeholder="The plain text content of your emails." value="{{ old('html_content') }}" cols="90" rows="20"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="custom-file">
                <input type="file" name="contacts_lits" class="custom-file-input">
                <span class="custom-file-control"></span>
            </label>
        </div>

        <input type="submit" value="Submit" class="btn btn-primary">
        {{ csrf_field() }}
        @include('includes.errors')
    </form>
{{--    <a href="{{ route('listcampaigns') }}" class="btn btn-lg btn-info" role="button">Campaign list</a>--}}
@endsection