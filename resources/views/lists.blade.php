@extends('layouts.app')

@section('content')
<div class="container is-fluid">
	<a class="button" @click.prevent="toggle_modal()">Add entry</a>
	<div class="modal is-active" v-show="show_entry_modal">
		<div class="modal-background"></div>
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Modal title</p>
				<button class="delete" @click.prevent="toggle_modal()"></button>
			</header>
			<section class="modal-card-body">
				<label class="label">List</label>
				<p class="control">
			  		<span class="select">
				    	<select v-model="entry.list">
				    		<option value="">-- Select --</option>
				      		<option value="blacklist">Blacklist</option>
				      		<option value="whitelist">Whitelist</option>
				    	</select>
			  		</span>
				</p>
				<label class="label">From</label>
				<p class="control">
			  		<input class="input" type="text" placeholder="john@example.com" v-model="entry.from_address">
				</p>
				<label class="label">To</label>
				<p class="control has-addons">
			  		<input class="input" type="text" placeholder="john" v-model="entry.to_address">
			  		<a class="button" disabled>@</a>
			  		<input class="input" type="text" placeholder="example.com" v-model="entry.to_domain">
				</p>
			</section>
			<footer class="modal-card-foot">
				<a class="button is-primary" @click.prevent="submit_entry()">Save changes</a>
				<a class="button" @click.prevent="toggle_modal()">Cancel</a>
			</footer>
		</div>
	</div>
	<hr>
	<div class="columns">
		<div class="column is-half">
			<h2>Whitelisted</h2>
			<p class="control has-addons">
		  		<input class="input is-expanded" type="text" placeholder="Search..." v-model="whitelist.search_key">
			  	<a class="button is-info" @click.prevent="search_whitelist()">
			    	Search
			  	</a>
			</p>
			<table class="table is-narrow">
				<thead>
					<tr>
						<th>From</th>
						<th>To</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="entry in whitelist.entries">
						<td>@{{ entry.from_address }}</td>
						<td>@{{ entry.to_address }}</td>
						<td><a class="button is-danger is-small" :href="'/whitelist/destroy/'+entry.uuid" @click.prevent="delete_entry('whitelist', entry.uuid)">Delete</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="column is-half">
			<h2>Blacklisted</h2>
			<p class="control has-addons">
		  		<input class="input is-expanded" type="text" placeholder="Search..." v-model="blacklist.search_key">
			  	<a class="button is-info" @click.prevent="search_blacklist()">
			    	Search
			  	</a>
			</p>
			<table class="table is-narrow">
				<thead>
					<tr>
						<th>Fromt</th>
						<th>To</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="entry in blacklist.entries">
						<td>@{{ entry.from_address }}</td>
						<td>@{{ entry.to_address }}</td>
						<td><a class="button is-danger is-small" :href="'/blacklist/destroy/'+entry.uuid" @click.prevent="delete_entry('blacklist', entry.uuid)">Delete</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script async src="/js/lists.js"></script>
@endsection