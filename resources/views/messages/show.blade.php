@extends('layouts.app')

@section('content')
<div class="container">
	<div class="columns">
		<div class="column is-2"><a href="/messages/{{ $message->uuid }}/content" class="button is-primary">View message</a></div>
		<div class="column is-2"><a href="#" class="button is-primary" @click="sa_release('{{ $message->uuid }}')">Release message</a></div>
		<div class="column is-2"><a href="#" class="button is-primary" @click="sa_remove('{{ $message->uuid }}')">Remove message</a></div>
		<div class="column is-6">
			<form action="/sa/learn" method="POST" @submit.prevent="sa_learn('{{ $message->uuid }}')">
				{!! csrf_field() !!}
				<div class="field has-addons is-horizontal">
			  		<p class="control is-expanded">
				    	<span class="select">
							<select name="learn_type">
								<option value="ham">The message is clean</option>
								<option value="spam">The message is spam</option>
								<option value="report">Report and mark as spam</option>
								<option value="revoke">Report as clean and release</option>
							</select>
				    	</span>
				    	<button type="submit" class="button is-primary">Choose</button>
						<span class="help">Tell the system how it should handle this type of email to prevent false postives and false negatives in the future</span>
			  		</p>
				</div>
			</form>
		</div>
	</div>
	<hr>
	<div class="columns">
		<div class="column is-2"><strong>Recieved on:</strong></div>
		<div class="column auto">{{ $message->date->format('l jS \of F Y') }} {{ $message->time }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Recieved by:</strong></div>
		<div class="column auto">{{ $message->hostname }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Origin:</strong></div>
		<div class="column auto">
			<p><strong>IP Address:</strong> {{ $message->clientip }}</p>
			<p><strong>Hostname:</strong> {{ $message->sender_hostname() }}</p>
			<p><strong>Country:</strong> {{ $message->geodata()->country }}</p>
		</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Message ID:</strong></div>
		<div class="column auto">{{ $message->mailwatch_id }}</div>
	</div>
	<hr>
	<div class="columns">
		<div class="column is-2"><strong>Headers:</strong></div>
		<div class="column auto">
			{!! nl2br($message->headers) !!}
		</div>
	</div>
	<hr>
	<h2>Anti-virus protection</h2>
	<div class="columns">
		<div class="column is-2"><strong>Virus:</strong></div>
		<div class="column auto">{{ ($message->virus_infected) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Blocked file:</strong></div>
		<div class="column auto">{{ ($message->name_infected) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Other infection:</strong></div>
		<div class="column auto">{{ ($message->other_infected) ? 'Yes' : 'No' }}</div>
	</div>
	<hr>
	<h2>Spam analysis</h2>
	<div class="columns">
		<div class="column is-2"><strong>Spam:</strong></div>
		<div class="column auto">{{ ($message->is_spam) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>High scoring spam:</strong></div>
		<div class="column auto">{{ ($message->is_highspam) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>SpamAssasion Spam:</strong></div>
		<div class="column auto">{{ ($message->is_sa_spam) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Listed in RBL:</strong></div>
		<div class="column auto">{{ ($message->is_rbl_spam) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Spam Whitelisted:</strong></div>
		<div class="column auto">{{ ($message->spam_whitelisted) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Spam Blacklisted:</strong></div>
		<div class="column auto">{{ ($message->spam_blacklisted) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Spam Score:</strong></div>
		<div class="column auto">{{ $message->sa_score }}</div>
	</div>
	<hr>
	<div class="columns">
		<div class="column is-offset-2"><h3>Spam report</h3></div>
	</div>
	<div class="columns">
		<div class="column is-offset-2">
			{!! $message->spamreport_formatted() !!}
		</div>
	</div>
	<hr>
	<h2>Message Content Protection (MCP)</h2>
	<div class="columns">
		<div class="column is-2"><strong>MCP:</strong></div>
		<div class="column auto">No</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>High MCP:</strong></div>
		<div class="column auto">No</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>SpamAssasin MCP:</strong></div>
		<div class="column auto">No</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>MCP Whitelisted:</strong></div>
		<div class="column auto">No</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>MCP Blacklisted:</strong></div>
		<div class="column auto">No</div>
	</div>
</div>
@endsection

@section('scripts')
<script async src="/js/message_details.js"></script>
@endsection
