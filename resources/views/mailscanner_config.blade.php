@extends('layouts.app')

@section('content')
<div class="container">
    <h2>MailScanner Configuration</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Option</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($config as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
</div>
@endsection
