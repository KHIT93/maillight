@extends('layouts.app')

@section('content')
<v-container>
    <v-row>
        <v-col xs12>
            <table class="datatable table">
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
        </v-col>
    </v-row>
</v-container>
@endsection
