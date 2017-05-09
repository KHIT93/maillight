@extends('layouts.app')

@section('content')
<v-container>
    <v-row>
        <v-col xs12>
            <a href="/messages/{{ $message->uuid }}" class="btn">Go back</a>
        </v-col>
    </v-row>
    <v-row>
        <v-col xs6>
            <v-row>
                <v-col xs3>Date</v-col>
                <v-col xs9>{{ $message->date->format('l jS \of F Y') }} {{ $message->time }}</v-col>
            </v-row>
            <v-row>
                <v-col xs3>From</v-col>
                <v-col xs9>{{ $message->from_address }}</v-col>
            </v-row>
            <v-row>
                <v-col xs3>To</v-col>
                <v-col xs9>{{ $message->to_address }}</v-col>
            </v-row>
            <v-row>
                <v-col xs3>Subject</v-col>
                <v-col xs9>{{ $message->subject }}</v-col>
            </v-row>
            <v-row>
                <v-col xs3>Queue ID</v-col>
                <v-col xs9>{{ $message->mailwatch_id }}</v-col>
            </v-row>
        </v-col>
    </v-row>
</v-container>
<hr>
<v-container>
    <v-row>
        <v-col xs12>
            @if($file == null)
                <p>This email is no longer located on the recieving service node. It could have been manually deleted or deleted as part of another automated task that performs cleanup</p>
            @else
                {{ $file }}
            @endif
        </v-col>
    </v-row>
</v-container>
@endsection
