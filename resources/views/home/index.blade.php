@extends('layouts.app')

@section('content')
<v-container fluid>
    <v-row>
        <v-col xs6>
            <v-card class="elevation-0">
                <v-card-text>
                    <v-row>
                        <v-col xs4>
                            <figure class="image is-64x64">
                                <img src="http://placehold.it/128x128" alt="Image">
                            </figure>
                        </v-col>
                        <v-col xs8>
                            <v-col xs12>
                                <p>
                                    <strong>Recieved messages</strong> <small>within the last</small> <small>1 hour</small>
                                </p>
                            </v-col>
                            <v-col xs12><v-btn primary dark href="/messages">View message activity</v-btn></v-col>
                        </v-col>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col xs6>
            <v-card class="elevation-0">
                <v-card-text>
                    <v-row>
                        <v-col xs4>
                            <figure class="image is-64x64">
                                <img src="http://placehold.it/128x128" alt="Image">
                            </figure>
                        </v-col>
                        <v-col xs8>
                            <v-col xs12>
                                <p>
                                    <strong>Sent messages</strong> <small>within the last</small> <small>1 hour</small>
                                </p>
                            </v-col>
                        </v-col>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
    <v-row>
        <v-col xs6>
            <v-card class="elevation-0">
                <v-card-text>
                    <v-row>
                        <v-col xs4>
                            <figure class="image is-64x64">
                                <img src="http://placehold.it/128x128" alt="Image">
                            </figure>
                        </v-col>
                        <v-col xs8>
                            <v-col xs12>
                                <p>
                                    <strong>Infected messages</strong> <small>within the last</small> <small>1 hour</small>
                                </p>
                            </v-col>
                            <v-col xs12><v-btn primary dark href="/reports">Go to reports</v-btn></v-col>
                        </v-col>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col xs6>
            <v-card class="elevation-0">
                <v-card-text>
                    <v-row>
                        <v-col xs4>
                            <figure class="image is-64x64">
                                <img src="http://placehold.it/128x128" alt="Image">
                            </figure>
                        </v-col>
                        <v-col xs8>
                            <v-col xs12>
                                <p>
                                    <strong>Released messages</strong> <small>within the last</small> <small>1 hour</small>
                                </p>
                            </v-col>
                            <v-col xs12><v-btn primary dark href="/reports/audit">View audit logs</v-btn></v-col>
                        </v-col>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
    <v-row>
        <v-col xs6>
            <v-card class="elevation-0">
                <v-card-text>
                    <v-row>
                        <v-col xs4>
                            <figure class="image is-64x64">
                                <img src="http://placehold.it/128x128" alt="Image">
                            </figure>
                        </v-col>
                        <v-col xs8>
                            <v-col xs12>
                                <p>
                                    <strong>Spam messages</strong> <small>within the last</small> <small>1 hour</small>
                                </p>
                            </v-col>
                            <v-col xs12><v-btn primary dark href="/reports">Go to reports</v-btn></v-col>
                        </v-col>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col xs6>
            <v-card class="elevation-0">
                <v-card-text>
                    <v-row>
                        <v-col xs4>
                            <figure class="image is-64x64">
                                <img src="http://placehold.it/128x128" alt="Image">
                            </figure>
                        </v-col>
                        <v-col xs8>
                            <v-col xs12>
                                <p>
                                    <strong>Messages quarantined</strong> <small>within the last</small> <small>1 hour</small>
                                </p>
                            </v-col>
                            <v-col xs12>
                                <v-btn primary dark href="/messages">View messages</v-btn>
                                <v-btn primary dark href="mailto:support@localhost">Contact support</v-btn>
                            </v-col>
                        </v-col>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</v-container>
@endsection
