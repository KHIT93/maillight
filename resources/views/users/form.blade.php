@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create new user</h2>
    <form name="user_form" role="form" action="{{($user->uuid) ? '/users/'.$user->uuid.'/update':'/users/create'}}" method="POST">
        {!! method_field((($user->uuid) ? 'PATCH':'PUT')) !!}
        {!! csrf_field() !!}
        <label class="label">Name</label>
        <p class="control">
            <input class="input" type="text" placeholder="John Doe" value="{{$user->name}}" name="name" required>
        </p>
        <label class="label">Email</label>
        <p class="control">
            <input class="input" type="email" placeholder="john@example.com" value="{{$user->email}}" name="email" required>
        </p>
        <label class="label">Password</label>
        <p class="control">
            <input class="input" type="password" name="password" required>
        </p>
        <label class="label">Confirm Password</label>
        <p class="control">
            <input class="input" type="password" name="confirm_password" required>
        </p>

        <!-- Role selection goes here -->
        <label class="label">Daily Report</label>
        <p class="control">
            <label class="checkbox">
                <input type="checkbox" value="1" name="quarantine_report" {{($user->quarantine_report) ? 'checked':''}}>
                Send daily reports
            </label>
        </p>
        <label class="label">Report Recipient</label>
        <p class="control">
            <input class="input" type="email" placeholder="jane@example.com" value="{{$user->quarantine_rcpt}}" name="quarantine_rcpt">
        </p>
        <div class="control is-grouped">
            <p class="control">
              <button class="button is-primary" type="submit">{{($user->uuid) ? 'Update user':'Create user'}}</button>
            </p>
            <p class="control">
              <a href="/users" class="button is-link">Cancel</a>
            </p>
        </div>
    </form>
</div>
@endsection
