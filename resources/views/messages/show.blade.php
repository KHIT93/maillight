@extends('layouts.app')

@section('content')
<div class="container">
	<div class="columns">
		<div class="column is-2"><a href="#" class="button is-primary">View message</a></div>
		<div class="column auto"><a href="#" class="button is-primary">Actions</a></div>
	</div>
	<hr>
	<div class="columns">
		<div class="column is-2"><strong>Recieved on:</strong></div>
		<div class="column auto">{{ $message->date }} {{ $message->time }}</div>
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
		<div class="column auto">{{ ($message->virusinfected) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Blocked file:</strong></div>
		<div class="column auto">{{ ($message->nameinfected) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Other infection:</strong></div>
		<div class="column auto">{{ ($message->otherinfected) ? 'Yes' : 'No' }}</div>
	</div>
	<hr>
	<h2>Spam analysis</h2>
	<div class="columns">
		<div class="column is-2"><strong>Spam:</strong></div>
		<div class="column auto">{{ ($message->isspam) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>High scoring spam:</strong></div>
		<div class="column auto">{{ ($message->ishighspam) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>SpamAssasion Spam:</strong></div>
		<div class="column auto">{{ ($message->issaspam) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Listed in RBL:</strong></div>
		<div class="column auto">{{ ($message->isrblspam) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Spam Whitelisted:</strong></div>
		<div class="column auto">{{ ($message->spamwhitelisted) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Spam Blacklisted:</strong></div>
		<div class="column auto">{{ ($message->spamblacklisted) ? 'Yes' : 'No' }}</div>
	</div>
	<div class="columns">
		<div class="column is-2"><strong>Spam Score:</strong></div>
		<div class="column auto">{{ $message->sascore }}</div>
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
