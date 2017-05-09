@extends('layouts.app')

@section('content')
<v-container>
        <h4>{{ ($user->uuid) ? 'Edit '.$user->name:'Create new user' }}</h4>
        <form name="user_form" role="form" action="{{($user->uuid) ? '/users/'.$user->uuid.'/update':'/users/create'}}" method="POST">
            {!! method_field((($user->uuid) ? 'PATCH':'PUT')) !!}
            {!! csrf_field() !!}
            <v-row row>
                <v-col xs3>
                  <v-subheader>Name</v-subheader>
                </v-col>
                <v-col xs9>
                  <v-text-field
                    name="name"
                    label="Name"
                    required
                    value="{{$user->name}}"
                  />
                </v-col>
            </v-row>
            <v-row row>
                <v-col xs3>
                  <v-subheader>Email</v-subheader>
                </v-col>
                <v-col xs9>
                  <v-text-field
                    name="email"
                    label="Email"
                    required
                    value="{{$user->email}}"
                    type="email"
                  />
                </v-col>
            </v-row>
            <v-row row>
                <v-col xs3>
                  <v-subheader>Password</v-subheader>
                </v-col>
                <v-col xs9>
                  <v-text-field
                    name="password"
                    label="Password"
                    @if(!$user->uuid) required @endif
                    type="password"
                  />
                </v-col>
            </v-row>
            <v-row row>
                <v-col xs3>
                  <v-subheader>Confirm Password</v-subheader>
                </v-col>
                <v-col xs9>
                  <v-text-field
                    name="confirm_password"
                    label="Confirm Password"
                    @if(!$user->uuid) required @endif
                    type="password"
                  />
                </v-col>
            </v-row>
            <v-row row>
                <v-col xs3>
                </v-col>
                <v-col xs9>
                    <v-checkbox label="Send Daily reports" v-model="report_checked" primary value="1" light {{($user->quarantine_report) ? 'checked':''}}/>
                </v-col>
            </v-row>
            <v-row row>
                <v-col xs3>
                  <v-subheader>Report Recipient</v-subheader>
                </v-col>
                <v-col xs9>
                  <v-text-field
                    name="quarantine_rcpt"
                    label="Confirm Password"
                    type="email"
                    value="{{$user->quarantine_rcpt}}"
                  />
                </v-col>
            </v-row>
            <v-row row>
                <v-col xs3></v-col>
                <v-col xs9>
                    <v-btn primary type="submit">Save</v-btn>
                    <a href="/users/create" class="btn btn--light btn--flat">Cancel</a>
                </v-col>
            </v-row>
        </form>
</v-container>
@endsection

@section('scripts')
<script async src="/js/user_form.js"></script>
@endsection
