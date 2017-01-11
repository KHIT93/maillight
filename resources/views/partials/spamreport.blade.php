<table class=" table is-narrow sa_rules_report">
	<thead>
		<tr>
			<th>Score</th>
			<th>Matching Rule</th>
		</tr>
	</thead>
	<tbody>
	@foreach($report as $item)
		<tr>
			<td>{{ $item['value'] }}</td>
			<td>{{ $item['key'] }}</td>
		</tr>
	@endforeach()
	</tbody>
</table>
