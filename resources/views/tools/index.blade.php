@extends('layouts.app')

@section('content')
<v-container>
    <v-row>
        <v-col xs12>
            <v-list two-line subheader>
                <v-subheader inset>Tools</v-subheader>
                <v-list-item>
                    <v-list-tile avatar href="/users">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>User Management</v-list-tile-title>
                            <v-list-tile-sub-title>Manage user accounts with access to the application</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
                <v-divider inset></v-divider>
                <v-list-item>
                    <v-list-tile avatar href="/tools/mysql-status">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>MySQL Database Status</v-list-tile-title>
                            <v-list-tile-sub-title>Check how your MySQL server is doing</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
                <v-divider inset></v-divider>
                <v-list-item>
                    <v-list-tile avatar href="/tools/mailscanner-config">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>View MailScanner Configuration</v-list-tile-title>
                            <v-list-tile-sub-title>See how the underlying MailScanner instance is configured</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
                <v-divider inset></v-divider>
                <v-list-item>
                    <v-list-tile avatar @click.native="update_geoip">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>Update GeoIP Database</v-list-tile-title>
                            <v-list-tile-sub-title>Update the geographical information regarding IP-adresses</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
                <v-divider inset></v-divider>
                <v-list-item>
                    <v-list-tile avatar @click.prevent="update_sa_rules">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>Update Spam Rule Descriptions</v-list-tile-title>
                            <v-list-tile-sub-title>Perform an update of the descriptions related to the spam rule definitions</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
                <v-divider inset></v-divider>
                <v-subheader inset>Links</v-subheader>
                <v-list-item>
                    <v-list-tile avatar href="https://mxtoolbox.com" target="_blank">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>MXToolbox</v-list-tile-title>
                            <v-list-tile-sub-title>Use this well respected tool to perform various checks about email delivery, blacklist status and DNS</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
            </v-list>
        </v-col>
    </v-row>
</v-container>
@endsection

@section('scripts')
<script async src="/js/tools.js"></script>
@endsection
