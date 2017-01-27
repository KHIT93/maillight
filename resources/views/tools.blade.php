@extends('layouts.app')

@section('content')
<div class="container">
    <p class="menu-label">
        Tools
    </p>
    <ul class="menu-list" style="list-style: none;">
        <li><a href="/users">User management</a></li>
        <li><a href="/tools/mysql-status">MySQL Database status</a></li>
        <li><a href="/tools/mailscanner-config">View Mailscanner configuration</a></li>
        <li><a href="/tools/update-geoip">Update GeoIP Database</a></li>
    </ul>
    <p class="menu-label">
        Links
    </p>
    <ul class="menu-list" style="list-style: none;">
        <li><a href="https://mxtoolbox.com" target="_blank">MXToolbox</a></li>
    </ul>
</div>
@endsection