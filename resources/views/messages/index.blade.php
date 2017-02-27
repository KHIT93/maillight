@extends('layouts.app')

@section('content')
<div class="">
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

@section('scripts')
<script async src="/js/messages.js"></script>
@endsection
