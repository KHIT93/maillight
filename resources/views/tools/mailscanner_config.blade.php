@extends('layouts.app')

@section('content')
<v-container>
    <v-row>
        <v-col xs12>
            <h4>MailScanner Configuration</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($config as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </v-col>
    </v-row>
</v-container>
@endsection
