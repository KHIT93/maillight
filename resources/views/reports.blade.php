@extends('layouts.app')

@section('content')
<div class="container">
	<div class="columns">
		<div class="column is-5">
			<h3>Add filter</h3>
			<label class="label">Field</label>
			<p class="control">
			  <span class="select">
			    <select v-model="new_filter.field">
			    	<template v-for="(value, key) in filter_options">
			    	<option :value="key">@{{ value }}</option>
			    	</template>
			    </select>
			  </span>
			</p>
			<label class="label">Operator</label>
			<p class="control">
			  <span class="select">
		    		<select v-model="new_filter.operator">
				 		<option value="=">is equal to</option>
				 		<option value="<>">is not equal to</option>
				 		<option value=">">is greater than</option>
				 		<option value=">=">is greater than or equal to</option>
				 		<option value="<">is less than</option>
				 		<option value="<=">is less than or equal to</option>
				 		<option value="LIKE">contains</option>
				 		<option value="NOT LIKE">does not contain</option>
				 		<option value="REGEXP">matches the regular expression</option>
				 		<option value="NOT REGEXP">does not match the regular expression</option>
				 		<option value="IS NULL">is null</option>
				 		<option value="IS NOT NULL">is not null</option>
					</select>
			  </span>
			</p>
			<label class="label">Value</label>
			<div class="columns">
				<div class="column is-9">
					<p class="control">
				  		<input class="input" type="text" v-model="new_filter.value">
					</p>
				</div>
				<div class="column">
					<p class="control has-text-right">
						<button class="button is-primary" @click="apply_filter()">Add</button>
					</p>
				</div>
			</div>
		</div>
		<div class="column is-one-third">
			<h3>Active filters</h3>
			<div class="columns" v-for="filter in active_filters">
				<div class="column is-9">
					@{{ filter.field }} @{{ filter.operator }} @{{ filter.value }}
				</div>
				<div class="column">
					<button class="button is-danger is-small" @click="remove_filter(filter)">Remove</button>
				</div>
			</div>
		</div>
		<div class="column">
			<div class="columns">
				<div class="column">
					<p class="has-text-left"><strong>Oldest record:</strong></p>
				</div>
				<div class="column">
					<p class="has-text-right">@{{ statistics.old }}</p>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<p class="has-text-left"><strong>Newest record:</strong></p>
				</div>
				<div class="column">
					<p class="has-text-right">@{{ statistics.new }}</p>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<p class="has-text-left"><strong>Message count:</strong></p>
				</div>
				<div class="column">
					<p class="has-text-right">@{{ statistics.count }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('after_content')
<div class="container">
<div class="columns">
	<div class="column">
		<aside class="menu">
			<p class="menu-label">
		    	Available reports
		  	</p>
		  	<ul class="menu-list">
			    <li><a href="/reports/messages">Message listings</a></li>
			    <li><a href="/reports/messages-by-date">Total messages by date</a></li>
			    <li v-if="false"><a href="/reports/mail-relays">Top mail relays</a></li>
			    <li><a href="/reports/audit">Audit log</a></li>
		  	</ul>
		</aside>
	</div>
</div>
</div>
@endsection

@section('scripts')
<script async src="/js/reports.js"></script>
@endsection