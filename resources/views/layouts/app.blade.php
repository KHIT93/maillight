<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
    <link href="/css/app.css" rel="stylesheet">
    <!--<link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">-->

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'api_token' => ((auth()->check()) ? auth()->user()->api_token : "")
        ]); ?>
    </script>
</head>
<body>

    <div id="app">
        <v-app>
            @section('navigation')
            <v-toolbar v-if="!is_loading" v-cloak>
                <v-toolbar-title>{{ config('app.name', 'Laravel') }}</v-toolbar-title>
                <v-toolbar-items class="hidden-md-and-down">
                    <v-toolbar-item ripple href="{{route('home')}}">Dashboard</v-toolbar-item>
                    <v-toolbar-item ripple href="{{route('messages')}}">Recent messages</v-toolbar-item>
                    <v-toolbar-item ripple href="{{route('lists')}}">Lists</v-toolbar-item>
                    <v-toolbar-item ripple href="{{route('quarantine')}}">Quarantine</v-toolbar-item>
                    <v-toolbar-item ripple href="{{route('reports')}}">Reports</v-toolbar-item>
                    <v-toolbar-item ripple href="{{route('tools')}}">Tools</v-toolbar-item>
                    <v-toolbar-item ripple href="{{route('systeminfo')}}">System information</v-toolbar-item>
                    <v-toolbar-item ripple href="{{route('settings')}}">Settings</v-toolbar-item>
                    <v-toolbar-item ripple href="{{route('logout')}}">Logout</v-toolbar-item>
                </v-toolbar-items>
            </v-toolbar>
            @show
            <template v-if="!is_loading">@yield('before_content')</template>
            <main v-if="!is_loading" v-cloak>
                <v-content v-show="!is_loading">
                    @yield('content')
                </v-content>
            </main>

            <template v-if="!is_loading">@yield('after_content')</template>

            @section('loader')
            <div class="dialog__container" v-if="is_loading">
                <div class="overlay overlay--active">
                    <v-progress-circular indeterminate class="primary--text" size="60"/>
                </div>
            </div>
            @show

            <!--<div class="dialog__container" v-if="!js_enabled">
                <div class="overlay overlay--active">
                    <div class="dialog dialog--active dialog--persistent" style="width: 400px;">
                        <div class="card" style="height: auto;">
                            <div class="card__row" style="height: auto;">
                                <div class="card__title">Warning!</div>
                            </div>
                            <div class="card__row" style="height: auto;">
                                <div class="card__text">
                                    <p>The application is loading</p>
                                    <p>Please be aware that this application requires JavaScript to be enabled to work.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </v-app>
    </div>
    <!-- Scripts -->
    @yield('scripts', '<script async src="/js/app.js"></script>')
</body>
</html>
