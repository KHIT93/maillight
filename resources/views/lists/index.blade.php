@extends('layouts.app')

@section('content')
<v-container>
	<v-dialog v-model="show_entry_modal" persistent width="600">
  		<v-btn primary dark slot="activator">Add Entry</v-btn>
	  	<v-card>
	    	<v-card-row>
	      		<v-card-title>Add Listing Entry</v-card-title>
	    	</v-card-row>
	    	<v-card-row>
	      		<v-card-text>
					<v-container fluid>
						<v-row>
							<v-col xs3>
				          		<v-subheader v-text="'List'" />
					        </v-col>
					        <v-col xs9>
					          	<v-select
					            	v-bind:items="list_types"
					            	v-model="entry.list"
					            	label="-- Select --"
					            	light
					            	single-line
					            	auto
					          />
					        </v-col>
						</v-row>
						<v-row row>
					        <v-col xs3>
					          <v-subheader>From</v-subheader>
					        </v-col>
					        <v-col xs9>
					          <v-text-field
					            name="from_address"
					            label="From"
								v-model="entry.from_address"
					          />
					        </v-col>
				      	</v-row>
						<v-row row>
					        <v-col xs3>
					          <v-subheader>To</v-subheader>
					        </v-col>
					        <v-col xs9>
					          <v-text-field
					            name="to_address"
								label="To"
								v-model="entry.to_address"
					          />
					        </v-col>
				      	</v-row>
					</v-container>
				</v-card-text>
	    	</v-card-row>
		    <v-card-row actions>
	      		<v-btn class="green--text darken-1" flat="flat" @click.native="toggle_modal">Cancel</v-btn>
	      		<v-btn class="green--text darken-1" flat="flat" @click.native="submit_entry">Save</v-btn>
		    </v-card-row>
	  	</v-card>
	</v-dialog>
</v-container>
<hr>
<v-container fluid>
	<v-row>
		<v-col sm6 xs12>
			<v-card>
				<v-card-title>
				    Whitelisted
				    <v-spacer></v-spacer>
				    <v-text-field
			      		append-icon="search"
				      	label="Search"
				      	single-line
				      	hide-details
				      	v-model="whitelist.search_key"
			    	></v-text-field>
			  	</v-card-title>
				<v-data-table
			        v-bind:headers="headers"
			        v-model="whitelist.entries"
					v-bind:search="whitelist.search_key"
					rows-per-page="25"
			        class="elevation-2">
			        <template slot="headers" scope="props">
			            <span>
			                @{{ props.item.value }}
			            </span>
			        </template>
			        <template slot="items" scope="props">
			            <td class="text-xs-right">@{{ props.item.from_address }}</td>
			            <td class="text-xs-right">@{{ props.item.to_address }}</td>
			            <td class="text-xs-right"><a href="#" class="btn btn--flat btn--light btn--raised error error--text" @click.prevent="delete_entry('whitelist', props.item.uuid)">Delete</a></td>
			      </template>
			    </v-data-table>
			</v-card>
		</v-col>
		<v-col sm6 xs12>
			<v-card>
				<v-card-title>
				    Blacklisted
				    <v-spacer></v-spacer>
				    <v-text-field
			      		append-icon="search"
				      	label="Search"
				      	single-line
				      	hide-details
				      	v-model="blacklist.search_key"
			    	></v-text-field>
			  	</v-card-title>
				<v-data-table
			        v-bind:headers="headers"
			        v-model="blacklist.entries"
					v-bind:search="blacklist.search_key"
					rows-per-page="25"
			        class="elevation-2">
			        <template slot="headers" scope="props">
			            <span>
			                @{{ props.item.value }}
			            </span>
			        </template>
			        <template slot="items" scope="props">
			            <td class="text-xs-right">@{{ props.item.from_address }}</td>
			            <td class="text-xs-right">@{{ props.item.to_address }}</td>
			            <td class="text-xs-right"><a href="#" class="btn btn--flat btn--light btn--raised error error--text" @click.prevent="delete_entry('blacklist', props.item.uuid)">Delete</a></td>
			      </template>
			    </v-data-table>
			</v-card>
		</v-col>
	</v-row>
</v-container>
@endsection
@section('scripts')
<script async src="/js/lists.js"></script>
@endsection
