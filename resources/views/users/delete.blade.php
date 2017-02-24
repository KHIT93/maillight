@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Delete {{$user->name}}</h2>
    <form name="user_form" role="form" action="/users/{{$user->uuid}}/delete" method="POST">
        {!! method_field('DELETE') !!}
        {!! csrf_field() !!}
        <p>Are you absolutely sure that you want to delete {{$user->name}}(<em>{{$user->email}}</em>)
        <div class="control is-grouped">
            <p class="control">
              <button class="button is-danger" type="submit">Confirm</button>
            </p>
            <p class="control">
              <a href="/users" class="button is-link">Cancel</a>
            </p>
        </div>
    </form>
</div>
@endsection
