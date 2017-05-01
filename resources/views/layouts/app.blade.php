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
    <link href="/css/app.css" rel="stylesheet">

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
        <section class="hero is-info is-bold">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">MailLight</h1>
                    <h2 class="subtitle">Dashboard</h2>
                </div>
            </div>
        </section>
        <nav class="nav has-shadow">
          <div class="container">
                <div class="nav-left">
                    <a href="{{route('home')}}" class="nav-item is-tab @if(Route::is('home')) is-active @endif">Dashboard</a>
                    <a href="{{route('messages')}}" class="nav-item is-tab @if(Route::is('messages')) is-active @endif">Recent messages</a>
                    <a href="{{route('lists')}}" class="nav-item is-tab @if(Route::is('lists')) is-active @endif">Lists</a>
                    <a href="{{route('quarantine')}}" class="nav-item is-tab @if(Route::is('quarantine')) is-active @endif">Quarantine</a>
                    <a href="{{route('reports')}}" class="nav-item is-tab @if(Route::is('reports')) is-active @endif">Reports</a>
                    <a href="{{route('tools')}}" class="nav-item is-tab @if(Route::is('tools')) is-active @endif">Tools</a>
                    <a href="{{route('systeminfo')}}" class="nav-item is-tab @if(Route::is('systeminfo')) is-active @endif">System information</a>
                    <a href="{{route('settings')}}" class="nav-item is-tab @if(Route::is('settings')) is-active @endif">Server settings</a>
                    <a href="{{route('logout')}}" class="nav-item is-tab">Logout</a>
                </div>
            </div>
        </nav>
        @yield('before_content')
        <main class="content">
            <hr>
            @yield('content')
            <hr>
        </main>
        @yield('after_content')
        <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">

                </div>
            </div>
        </footer>
        <div class="modal is-active" v-show="is_loading">
            <div class="modal-background"></div>
            <!--<div class="modal-content"> -->
                <!--<span class="icon">
                    <i class="fa fa-circle-o-notch fa-spin fa-fw" style="font-size: 50px; color: white;"></i>
                    <span class="sr-only">Loading...</span>
                </span>-->
                <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle class="path" fill="none" stroke-width="3" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                </svg>
            <!--</div>-->
        </div>
        <div class="modal is-active" v-if="!js_enabled">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Warning!</p>
                </header>
                <section class="modal-card-body">
                    <p>
                        Please be aware that this application requires JavaScript to be enabled to work properly.
                    </p>
                </section>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    @yield('scripts', '<script async src="/js/app.js"></script>')
</body>
</html>
