@extends('master')
@section('content')
    <form method="POST" action="{{ route('savecampaign') }}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="The display title of your campaign. This will be viewable by you in the Marketing Campaigns List" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" placeholder="The subject of your campaign that your recipients will see">
        </div>
        <div class="form-group">
            <label for="html_content">Body html</label>
            <input type="text" name="html_content" placeholder="The HTML of your marketing email">
        </div>
        <div class="form-group">
            <label for="plain_content">Body plain text</label>
            <textarea name="plain_content" placeholder="The plain text content of your emails."></textarea>
        </div>
        <input type="submit" value="Submit">
        {{ csrf_field() }}
        @include('includes.errors')
    </form>
    <a href="{{ route('listcampaigns') }}">Campaign list</a>
@endsection