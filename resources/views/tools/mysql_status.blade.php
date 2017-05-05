@extends('layouts.app')

@section('content')
<v-container>
    <v-row>
        <v-col xs12>
            <h4>MySQL Database Status</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Engine</th>
                        <th>Row format</th>
                        <th>Rows</th>
                        <th>Collation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>{{$table->Name}}</td>
                            <td>{{$table->Engine}}</td>
                            <td>{{$table->Row_format}}</td>
                            <td>{{$table->Rows}}</td>
                            <td>{{$table->Collation}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Host</th>
                        <th>Database</th>
                        <th>Command</th>
                        <th>Time</th>
                        <th>State</th>
                        <th>Info</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processes as $process)
                        <tr>
                            <td>{{$process->Id}}</td>
                            <td>{{$process->User}}</td>
                            <td>{{$process->Host}}</td>
                            <td>{{$process->db}}</td>
                            <td>{{$process->Command}}</td>
                            <td>{{$process->Time}}</td>
                            <td>{{$process->State}}</td>
                            <td>{{$process->Info}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </v-col>
    </v-row>
</v-container>
@endsection
