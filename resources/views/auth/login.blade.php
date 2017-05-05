@extends('layouts.app')
@section('navigation')
@endsection

@section('content')
<v-dialog v-model="show_dialog" persistent width="600">
    <v-card>
        <v-card-row>
            <v-card-title>Login</v-card-title>
        </v-card-row>
        <v-card-row>
            <v-card-text>
                <form role="form" method="POST" action="{{ url('/login') }}" @submit.prevent="login">
                    {{ csrf_field() }}
                    <v-alert error v-bind:value="error">
                        @{{ error }}
                    </v-alert>
                    <v-row row>
                        <v-col xs12>
                          <v-text-field
                            name="username"
                            label="Username"
                            required
                            v-model="user.email"
                            type="email"
                          />
                        </v-col>
                    </v-row>
                    <v-row row>
                        <v-col xs12>
                          <v-text-field
                            name="password"
                            label="Password"
                            required
                            v-model="user.password"
                            type="password"
                          />
                        </v-col>
                    </v-row>
                    <v-btn
                        info
                        v-bind:loading="loading"
                        v-on:click.native="loader = 'loading'"
                        v-bind:disabled="loading"
                        type="submit"
                        @click.native="loading = true"
                        >
                        Log in
                        <span slot="loader" class="custom-loader">
                          <v-icon>cached</v-icon>
                        </span>
                    </v-btn>
                    <v-btn class="blue--text darken-1" flat="flat" href="{{ url('/password/reset') }}">Forgot Password?</v-btn>
                </form>
            </v-card-text>
        </v-card-row>
        <v-card-row>
            <v-card-text>Please note that this application depends on JavaScript, so it is required that this is enabled in your web browser</v-card-text>
        </v-card-row>
    </v-card>
</v-dialog>
@endsection
@section('scripts')
<script async src="/js/login.js"></script>
@endsection
