@extends('layouts.app')

@section('before_content')
<v-container>
    <v-row>
        <v-col xs12>
            {{ $messages->links('partials.simple-vuetify') }}
        </v-col>
    </v-row>
</v-container>
@endsection

@section('content')
<v-container fluid>
    <div class="table__overflow">
        <table class="datatable table">
            <thead>
                <tr>
                    <th>Host</th>
                    <th>Date/Time</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th>SA Score</th>
                    <th>MCP Score</th>
                    <th>Status</th>
                 </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr class="{{$message->get_status_classes()}}">
                        <td>{{ $message->hostname }}</td>
                        <td align="center">{{ $message->date }} {{ $message->time }}</td>
                        <td>{{ $message->from_address }}</td>
                        <td>{{ $message->to_address }}</td>
                        <td>{{ $message->subject }}</td>
                        <td align="right">{{ $message->sa_score }}</td>
                        <td align="right">{{ $message->mcp_sa_score }}</td>
                        <td>{{ implode(' ', $message->status()) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</v-container>
@endsection
