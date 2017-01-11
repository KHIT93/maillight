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
            @foreach($messages as $message)
            <tr class="{{ $message->get_status_classes() }}">
                <td align="center">[<a href="/messages/{{ $message->uuid }}">&nbsp;&nbsp;</a>]</td>
                <td>{{ $message->hostname }}</td>
                <td align="center">{{ $message->date }} {{ $message->time }}</td>
                <td>{{ $message->from_address }}</td>
                <td>{{ $message->to_address }}</td>
                <td>{{ $message->subject }}</td>
                <td align="right">{{ $message->size }}</td>
                <td align="right">{{ $message->sascore }}</td>
                <td align="right">{{ $message->mcpsascore }}</td>
                <td>{{ implode('<br/>', $message->status()) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
