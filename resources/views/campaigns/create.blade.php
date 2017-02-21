@extends('master')
@section('content')
    <form method="POST" action="{{ route('savecampaign') }}">
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label col-form-label-lg">Title</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="title" value="{{ old('title') }}" placeholder="The display title of your campaign. This will be viewable by you in the Marketing Campaigns List" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="subject" class="col-sm-2 col-form-label col-form-label-lg" >Subject</label>
            <div class="col-sm-10">
                <input class="form-control form-control-lg" type="text" name="subject" value="{{ old('subject') }}" placeholder="The subject of your campaign that your recipients will see" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="html_content" class="col-sm-2 col-form-label col-form-label-lg">Body html</label>
            <div class="col-sm-10">
                <textarea name="html_content" placeholder="The HTML of your marketing email"cols="90" rows="20" value="{{ old('html_content') }}" required></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="plain_content" class="col-sm-2 col-form-label col-form-label-lg">Body plain text</label>
            <div class="col-sm-10">
                <textarea name="plain_content" placeholder="The plain text content of your emails." cols="90" rows="20" value="{{ old('plain_content') }}" required></textarea>
            </div>
        </div>
        @if($contacts_list)
            <div class="form-group row">
                <label for="contact_lists_ids" class="col-sm-2 col-form-label col-form-label-lg">Associate contacts list</label>
                <div class="col-sm-10">
                    <select multiple class="form-control[]" name="contact_lists_ids" value="{{ old('contact_lists_ids') }}" required>
                    @foreach($contacts_list as $list)
                        <option value="{{ $list->id }}" @if (!empty(old('contact_lists_ids')) && in_array($list->id, old('contact_lists_ids'))) selected @endif>
                            {{ $list->name }} ({{ $list->recipient_count }})
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if($senders_data)
            <div class="form-group row">
                <label for="sender_id" class="col-sm-2 col-form-label col-form-label-lg">Associate Sender</label>
                <div class="col-sm-10">
                    <select class="form-control" name="sender_id" required>
                        <option value=""></option>
                        @foreach($senders_data as $sender)
                            <option value="{{ $sender->id }}" @if ($sender->id == old('sender_id'))  selected @endif >
                                {{ $sender->nickname }} ( {{ $sender->from->email }} {{ $sender->from->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if($suppression_groups)
            <div class="form-group row">
                <label for="suppression_group_id" class="col-sm-2 col-form-label col-form-label-lg">Associate Suppression group</label>
                <div class="col-sm-10">
                    <select class="form-control" name="suppression_group_id" required>
                        <option value=""></option>
                        @foreach($suppression_groups as $group)
                            <option value="{{ $group->id }}" @if ($group->id == old('suppression_group_id'))  selected @endif >
                                {{ $group->name }} (Participants: {{ $group->unsubscribes }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <input type="submit" value="Submit" class="btn btn-primary">
        {{ csrf_field() }}
        @include('includes.errors')
    </form>
    <a href="{{ route('listcampaigns') }}" class="btn btn-success">Campaign list</a>
@endsection