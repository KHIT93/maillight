@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-6">
            <div class="columns">
                <div class="column is-3">Date</div>
                <div class="column auto">{{ $message->date->format('l jS \of F Y') }} {{ $message->time }}</div>
            </div>
            <div class="columns">
                <div class="column is-3">From</div>
                <div class="column auto">{{ $message->from_address }}</div>
            </div>
            <div class="columns">
                <div class="column is-3">To</div>
                <div class="column auto">{{ $message->to_address }}</div>
            </div>
            <div class="columns">
                <div class="column is-3">Subject</div>
                <div class="column auto">{{ $message->subject }}</div>
            </div>
            <div class="columns">
                <div class="column is-3">Queue ID</div>
                <div class="column auto">{{ $message->mailwatch_id }}</div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <div class="columns">
        <div class="column">
            {{ $file }}
        </div>
    </div>
</div>
@endsection
