@extends('layouts.app')

@section('content')
<v-container>
	<v-row>
		<v-col sm5 xs12>
			<h5>Add Filter</h5>
			<v-container fluid>
				<v-row>
					<v-col xs3>
						<v-subheader v-text="'Field'" />
					</v-col>
					<v-col xs9>
						<v-select
							v-bind:items="filter_options"
							v-model="new_filter.field"
							label="-- Select --"
							light
							single-line
							auto
					  />
					</v-col>
				</v-row>
				<v-row>
					<v-col xs3>
						<v-subheader v-text="'Operator'" />
					</v-col>
					<v-col xs9>
						<v-select
							v-bind:items="operators"
							v-model="new_filter.operator"
							label="-- Select --"
							light
							single-line
							auto
					  />
					</v-col>
				</v-row>
				<v-row row>
					<v-col xs3>
					  <v-subheader>Value</v-subheader>
					</v-col>
					<v-col xs6>
					  <v-text-field
						name="value"
						label="Value"
						v-model="new_filter.value"
					  />
					</v-col>
					<v-col xs3>
						<v-btn primary dark @click.native="apply_filter">Add Entry</v-btn>
					</v-col>
				</v-row>
			</v-container>
		</v-col>
		<v-col sm4 xs12>
			<h5>Active Filters</h5>
			<template v-for="filter in active_filters">
				<v-row>
					<v-col xs8>
						<div tabindex="-1" class="input-group input-group--light">
							<div class="input-group__input">
								@{{ filter.field }} @{{ filter.operator }} @{{ filter.value }}
							</div>
							<div class="input-group__details">
								<div class="input-group__messages"></div>
							</div>
						</div>
					</v-col>
					<v-col xs3>
						<v-btn error dark @click.native="remove_filter(filter)">Remove</v-btn>
					</v-col>
				</v-row>
			</template>
		</v-col>
		<v-col sm3 xs12>
			<v-row>
				<v-col xs6>
					<strong>Oldest record:</strong>
				</v-col>
				<v-col xs6>
					@{{ statistics.old }}
				</v-col>
			</v-row>
			<v-row>
				<v-col xs6>
					<strong>Newest record:</strong>
				</v-col>
				<v-col xs6>
					@{{ statistics.new }}
				</v-col>
			</v-row>
			<v-row>
				<v-col xs6>
					<strong>Message count:</strong>
				</v-col>
				<v-col xs6>
					@{{ statistics.count }}
				</v-col>
			</v-row>
		</v-col>
	</v-row>
</v-container>
@endsection

@section('after_content')
<v-container>
	<v-row>
		<v-col xs12>
			<v-list two-line subheader>
                <v-subheader inset>Available reports</v-subheader>
                <v-list-item>
                    <v-list-tile avatar href="/reports/messages">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>Message listings</v-list-tile-title>
                            <v-list-tile-sub-title>See a list of messages that match your filtered results</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
                <v-divider inset></v-divider>
                <v-list-item>
                    <v-list-tile avatar href="/reports/messages-by-date">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>Total messages by date</v-list-tile-title>
                            <v-list-tile-sub-title>See some statistics about the messages in the filtered results</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
                <v-divider inset></v-divider>
                <v-list-item>
                    <v-list-tile avatar href="/reports/mail-relays">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>Top mail relays</v-list-tile-title>
                            <v-list-tile-sub-title>See where email was coming from and heading to, based on the filtered results</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
				<v-divider inset></v-divider>
				<v-list-item>
                    <v-list-tile avatar href="/reports/audit">
                        <v-list-tile-avatar>
                            <v-icon class=""></v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>Audit log</v-list-tile-title>
                            <v-list-tile-sub-title>View the audit log to see what users have been doing in the application. This is not affected by the filtering applied</v-list-tile-sub-title>
                        </v-list-tile-content>
                  </v-list-tile>
                </v-list-item>
            </v-list>
		</v-col>
	</v-row>
</v-container>
@endsection

@section('scripts')
<script async src="/js/reports.js"></script>
@endsection
