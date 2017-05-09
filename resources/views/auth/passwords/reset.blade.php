@extends('layouts.app')
@section('navigation')
@endsection
<!-- Main Content -->
@section('content')
<v-dialog v-model="show_dialog" persistent width="600">
    <v-card>
        <v-card-row>
            <v-card-title>Reset password</v-card-title>
        </v-card-row>
        <v-card-row>
            <v-card-text>
                <form role="form" method="POST" action="{{ url('/password/reset') }}" @submit.prevent="reset_password">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" v-model="reset_token">
                    <v-alert error :value="error">
                        <template v-for="item in error">
                            <template v-for="message in item">
                                @{{ message }}<br/>
                            </template>
                        </template>
                    </v-alert>
                    <v-alert info :value="status">
                        @{{ status }}
                        @if (session('status'))
                            {{ session('status') }}
                        @endif
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
                    <v-row row>
                        <v-col xs12>
                          <v-text-field
                            name="password"
                            label="Password"
                            required
                            v-model="password"
                            type="password"
                          />
                        </v-col>
                    </v-row>
                    <v-row row>
                        <v-col xs12>
                          <v-text-field
                            name="password_confirmation"
                            label="Confirm Password"
                            required
                            v-model="password_confirmation"
                            type="password"
                          />
                        </v-col>
                    </v-row>
                    <v-btn primary :loading="loading" :disabled="loading" type="submit" @click.native="loading = true">
                        Reset Password
                        <span slot="loader" class="custom-loader">
                          <v-icon>cached</v-icon>
                        </span>
                    </v-btn>
                </form>
            </v-card-text>
        </v-card-row>
    </v-card>
</v-dialog>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script async src="/js/password_reset.js"></script>
@endsection
