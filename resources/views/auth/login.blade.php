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
                            label="Email"
                            required
                            v-model="user.email"
                            type="email"
                            autofocus
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
                        info :loading="loading" :disabled="loading" type="submit" @click.native="loading = true">
                        Log in
                        <span slot="loader" class="custom-loader">
                          <v-icon>cached</v-icon>
                        </span>
                    </v-btn>
                    <a class="blue--text darken-1 btn btn--flat btn--raised" href="{{ url('/password/reset') }}">
                        <span class="btn__content">Forgot Password?</span>
                    </a>
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
