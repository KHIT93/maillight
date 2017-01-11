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
                    <a href="/" class="nav-item is-tab is-active">Dashboard</a>
                    <a href="/messages" class="nav-item is-tab">Recent messages</a>
                    <a href="/lists" class="nav-item is-tab">Lists</a>
                    <a href="/quarantine" class="nav-item is-tab">Quarantine</a>
                    <a href="/reports" class="nav-item is-tab">Reports</a>
                    <a href="/tools" class="nav-item is-tab">Tools</a>
                    <a href="/systeminfo" class="nav-item is-tab">System information</a>
                    <a href="/settings" class="nav-item is-tab">Server settings</a>
                    <a href="/auth/logout" class="nav-item is-tab">Logout</a>
                </div>
            </div>
        </nav>
        <main class="content">
            <hr>
            @yield('content')
            <hr>
        </main>
        <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <p>
                        <strong>Bulma</strong> by <a href="http://jgthms.com">Jeremy Thomas</a>. The source code is licensed
                        <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
                        is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC ANS 4.0</a>.
                    </p>
                    <p>
                        <a class="icon" href="https://github.com/jgthms/bulma">
                            <i class="fa fa-github"></i>
                        </a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    @yield('scripts')
</body>
</html>
