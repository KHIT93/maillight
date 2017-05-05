@extends('layouts.app')

@section('content')
<v-container>
	<v-row>
		<v-col xs7>
			<a href="/messages/{{ $message->uuid }}/content" class="btn btn--small info">View message</a>
			<a class="btn btn--small info" @click="sa_release('{{ $message->uuid }}')">Release message</a>
			<a class="btn btn--small info" @click="sa_remove('{{ $message->uuid }}')">Remove message</a>
		</v-col>
	</v-row>
	<v-row>
		<v-col xs6>
			<form action="/sa/learn" method="POST" @submit.prevent="sa_learn('{{ $message->uuid }}')">
				{!! csrf_field() !!}
				<v-row>
					<v-col xs7>
						<v-select
				            v-bind:items="sa_options"
				            v-model="sa_action"
				            label="Choose an action"
				            light
				            single-line
				            auto
							hint="Tell the system how it should handle this type of email to prevent false postives and false negatives in the future"
							persistent-hint
				          />
				  </v-col>
				  <v-col xs5>
					  <v-btn primary dark small type="submit">Submit</v-btn>
				  </v-col>
			  </v-row>
		  	</form>
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Recieved on:</strong>
		</v-col>
		<v-col xs10>
			{{ $message->date->format('l jS \of F Y') }} {{ $message->time }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Recieved by:</strong>
		</v-col>
		<v-col xs10>
			{{ $message->hostname }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Origin:</strong>
		</v-col>
		<v-col xs10>
			<p><strong>IP Address:</strong> {{ $message->clientip }}</p>
			<p><strong>Hostname:</strong> {{ $message->sender_hostname() }}</p>
			<p><strong>Country:</strong> {{ $message->geodata()->country }}</p>
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Message ID:</strong>
		</v-col>
		<v-col xs10>
			{{ $message->mailwatch_id }}
		</v-col>
	</v-row>
	<hr>
	<v-row>
		<v-col xs2>
			<strong>Headers:</strong>
		</v-col>
		<v-col xs10>
			{{ $message->headers }}
		</v-col>
	</v-row>
	<hr>
	<h4>Anti-virus protection</h4>
	<v-row>
		<v-col xs2>
			<strong>Virus:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->virus_infected) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Blocked file:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->name_infected) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Oher infection:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->other_infected) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<hr>
	<h4>Spam analysis</h4>
	<v-row>
		<v-col xs2>
			<strong>Spam:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->is_spam) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>High scoring spam:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->is_highspam) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>SpamAssassin detected Spam:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->is_sa_spam) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Listed in RBL:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->is_rbl_spam) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Spam whitelisted:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->spam_whitelisted) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Spam blacklisted:</strong>
		</v-col>
		<v-col xs10>
			{{ ($message->spam_blacklisted) ? 'Yes' : 'No' }}
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>Spam score:</strong>
		</v-col>
		<v-col xs10>
			{{ $message->sa_score }}
		</v-col>
	</v-row>
	<hr>
	<v-row>
		<v-col xs12><h5>Spam report</h5></v-col>
	</v-row>
	<v-row>
		<v-col xs12>{!! $message->spamreport_formatted() !!}</v-col>
	</v-row>
	<hr>
	<h4>Message Content Protection (MCP)</h4>
	<v-row>
		<v-col xs2>
			<strong>MCP:</strong>
		</v-col>
		<v-col xs10>
			No
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>High MCP:</strong>
		</v-col>
		<v-col xs10>
			No
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>SpamAsassin MCP:</strong>
		</v-col>
		<v-col xs10>
			No
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>MCP Whitelisted:</strong>
		</v-col>
		<v-col xs10>
			No
		</v-col>
	</v-row>
	<v-row>
		<v-col xs2>
			<strong>MCP Blacklisted:</strong>
		</v-col>
		<v-col xs10>
			No
		</v-col>
	</v-row>
</v-container>
@endsection

@section('scripts')
<script async src="/js/message_details.js"></script>
@endsection
