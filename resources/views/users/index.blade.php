@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Users</h2>
    <a href="/users/create" class="button is-primary">Create User</a>
    <hr>
    <table class="table">
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
                    <td>{{$user->quarantine_report}}</td>
                    <td>{{$user->quarantine_rcpt}}</td>
                    <td>
                        <a class="button" href="/users/{{$user->uuid}}/update">Edit</a>
                        <a class="button is-danger" href="/users/{{$user->uuid}}/delete">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
