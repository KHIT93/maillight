@extends('layouts.app')

@section('content')
<v-container fluid>
    <v-row>
        <v-col xs12>
            <h4>Users</h4>
            <a href="/users/create" class="btn btn--light btn--raised primary">Create user</a>
            <hr>
            <table class="datatable table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Send Daily Report</th>
                        <th>Send Report To</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td></td>
                            <td>{{($user->quarantine_report === 1) ? 'Yes': 'No'}}</td>
                            <td>{{$user->quarantine_rcpt}}</td>
                            <td>
                                <a class="btn btn--flat btn--light btn--raised" href="/users/{{$user->uuid}}/update">Edit</a>
                                <a class="btn btn--flat btn--light btn--raised error error--text" href="/users/{{$user->uuid}}/delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </v-col>
    </v-row>
</v-container>
@endsection
