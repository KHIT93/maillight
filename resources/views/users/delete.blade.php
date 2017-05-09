@extends('layouts.app')

@section('content')
<v-container>
    <v-row>
        <v-col xs12>
            <h4>Delete {{$user->name}}</h4>
            <form name="user_form" role="form" action="/users/{{$user->uuid}}/delete" method="POST">
                {!! method_field('DELETE') !!}
                {!! csrf_field() !!}
                <p>Are you absolutely sure that you want to delete {{$user->name}}(<em>{{$user->email}}</em>)</p>
                <v-btn error type="submit">Confirm</v-btn>
                <a href="/users" class="btn btn--light btn--flat">Cancel</a>
            </form>
        </v-col>
    </v-row>
</v-container>
@endsection
