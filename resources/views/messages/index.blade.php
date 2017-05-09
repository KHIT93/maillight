@extends('layouts.app')

@section('content')
<v-container fluid>
    <v-data-table
        v-bind:headers="headers"
        v-model="messages"
        hide-actions
        class="elevation-2">
        <template slot="headers" scope="props">
            <span>
                @{{ props.item.value }}
            </span>
        </template>
        <template slot="items" scope="props">
            <td  class="text-xs-right">@{{ props.item.hostname }}</td>
            <td  class="text-xs-right">@{{ props.item.date }} @{{ props.item.time }}</td>
            <td  class="text-xs-right">@{{ props.item.from_address }}</td>
            <td  class="text-xs-right">@{{ props.item.to_address }}</td>
            <td  class="text-xs-right">@{{ props.item.subject }}</td>
            <td  class="text-xs-right">@{{ get_message_status(props.item).join(' ') }}</td>
      </template>
    </v-data-table>
</v-container>
@endsection

@section('scripts')
<script async src="/js/messages.js"></script>
@endsection
