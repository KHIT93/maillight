@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column">
            <table class="table">
                <thead>
                    <tr>
                        <th>Attribute</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Server OS</td>
                        <td>{{$data['os']}}</td>
                    </tr>
                    <tr>
                        <td>PHP Binary</td>
                        <td>{{$data['php_bin']}}</td>
                    </tr>
                    <tr>
                        <td>PHP Version</td>
                        <td>{{$data['php_version']}}</td>
                    </tr>
                    <tr>
                        <td>MailScanner Version</td>
                        <td>{{$data['mailscanner_version']}}</td>
                    </tr>
                    <tr>
                        <td>SpamAssassin Version</td>
                        <td>{{$data['sa_version']}}</td>
                    </tr>
                    <tr>
                        <td>Latest GeoIP update</td>
                        <td>{{$data['geoip_age']}}</td>
                    </tr>
                    <tr>
                        <td>Application core version</td>
                        <td>{{$data['core_version']}}</td>
                    </tr>
                </tbody>
            </table>
</div>
@endsection
