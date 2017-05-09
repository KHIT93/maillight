@extends('layouts.app')
@section('navigation')
@endsection
<!-- Main Content -->
@section('content')
<v-dialog v-model="show_dialog" persistent width="600">
    <v-card>
        <v-card-row>
            <v-card-title>Forgot your password?</v-card-title>
        </v-card-row>
        <v-card-row>
            <v-card-text>
                <p>Please type in your email address and we will send you a link to reset your password</p>
                <form role="form" method="POST" action="{{ url('/password/email') }}" @submit.prevent="send_link">
                    {{ csrf_field() }}
                    <v-alert error :value="error">
                        <template v-for="item in error">
                            <template v-for="message in item">
                                @{{ message }}<br/>
                            </template>
                        </template>
                    </v-alert>
                    <v-alert info :value="status">
                        @{{ status }}
                    </v-alert>
                    <v-row row>
                        <v-col xs12>
                          <v-text-field
                            name="email"
                            label="Email"
                            required
                            v-model="email"
                            type="email"
                            autofocus
                          />
                        </v-col>
                    </v-row>
                    <v-btn info :loading="loading" :disabled="loading" type="submit" @click.native="loading = true">
                        Send Password Reset Link
                        <span slot="loader" class="custom-loader">
                          <v-icon>cached</v-icon>
                        </span>
                    </v-btn>
                </form>
            </v-card-text>
        </v-card-row>
    </v-card>
</v-dialog>
@endsection

@section('scripts')
<script async src="/js/password_reset.js"></script>
@endsection
