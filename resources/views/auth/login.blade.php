<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login - {{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div id="app">
            <section class="hero is-fullheight is-dark is-bold">
                <div class="hero-body">
                    <div class="container">
                        <div class="columns is-vcentered">
                            <div class="column is-4 is-offset-4">
                                <h1 class="title">
                                    Login
                                </h1>
                                <div class="box">
                                    <form role="form" method="POST" action="{{ url('/login') }}" @submit="is_loading=true">
                                        {{ csrf_field() }}
                                        <div class="notification is-danger" v-if="error">
                                            <span v-text="error.response.data.email"/>
                                        </div>
                                        <label class="label">Email</label>
                                        <p class="control">
                                            <input v-model="user.email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="john@example.com" name="email" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <label class="label">Password</label>
                                        <p class="control">
                                            <input v-model="user.password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" type="password" placeholder="Password" name="password" value="{{ old('password') }}">
                                            @if ($errors->has('password'))
                                                <span class="help">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </p>
                                        <hr>
                                        <p class="control">
                                            <button type="submit" class="button is-primary" :class="loading">
                                                Login
                                            </button>
                                            <a class="button is-default" v-if="!is_loading" href="{{ url('/password/reset') }}">
                                                Forgot Your Password?
                                            </a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Scripts -->
        <script async src="/js/login.js"></script>
    </body>
</html>
