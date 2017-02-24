<table class=" table is-narrow sa_rules_report">
	<thead>
		<tr>
			<th>Score</th>
			<th>Matching Rule</th>
		</tr>
	</thead>
	<tbody>
	@if(count($report))
		@foreach($report as $item)
			<tr>
				<td>{{ $item['value'] }}</td>
				<td>{{ $item['key'] }}</td>
			</tr>
		@endforeach
	@endif
	</tbody>
</table>
