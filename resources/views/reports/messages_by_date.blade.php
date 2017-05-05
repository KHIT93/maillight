@extends('layouts.app')

@section('content')
<v-container>
	<v-row>
		<v-col xs12>
			<p class="has-text-centered">
				<span v-if="!report_ready && !report_error">
					Generating your report. Please wait while we collect the necessary data...
				</span>
				<span v-text="report_error_message" v-if="report_error"/>
			</p>

			<div v-show="report_ready">
				<!-- Chart.js graph here -->
				<h2 class="has-text-centered">Total mail processed by date</h2>
				<canvas id="mailreport_graph"></canvas>
				<!-- Chart.js graph end -->
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Mail</th>
							<th>Virus</th>
							<th>Ratio</th>
							<th>Spam</th>
							<th>Ratio</th>
							<th>Volume</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="day in statistics">
							<td>@{{ day.label }}</td>
							<td>@{{ day.messages }}</td>
							<td>@{{ day.virus }}</td>
							<td>@{{ Math.round(day.msg_virus_ratio * 100) / 100 }}</td>
							<td>@{{ day.spam }}</td>
							<td>@{{ Math.round(day.msg_spam_ratio * 100) / 100 }}</td>
							<td>@{{ day.volume }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</v-col>
	</v-row>
</v-container>
@endsection

@section('scripts')
<script async src="/js/reports_messages_by_date.js"></script>
@endsection
