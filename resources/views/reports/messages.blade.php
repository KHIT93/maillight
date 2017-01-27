@extends('layouts.app')

@section('before_content')
<div class="container is-fluid">
<div class="columns">
    <div class="column">{{ $messages->links('partials.simple-bulma') }}</div>
</div>
</div>
@endsection

@section('content')
<div class="container is-fluid">
    <table class="table is-narrow">
        <thead>
            <tr>
                <th>#</th>
                <th>Host</th>
                <th>Date/Time</th>
                <th>From</th>
                <th>To</th>
                <th>Subject</th>
                <th>Size</th>
                <th>SA Score</th>
                <th>MCP Score</th>
                <th>Status</th>
             </tr>
        </thead>
        <tbody>
            @include('partials.message_list')
        </tbody>
    </table>
</div>
@endsection