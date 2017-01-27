@if(isset($static_data))
@foreach($messages as $message)
<tr class="{{$message->get_status_classes()}}">
    <td align="center">[<a href="/messages/{{$message->uuid}}">&nbsp;&nbsp;</a>]</td>
    <td>{{ $message->hostname }}</td>
    <td align="center">{{ $message->date }} {{ $message->time }}</td>
    <td>{{ $message->from_address }}</td>
    <td>{{ $message->to_address }}</td>
    <td>{{ $message->subject }}</td>
    <td align="right">{{ $message->size }}</td>
    <td align="right">{{ $message->sascore }}</td>
    <td align="right">{{ $message->mcpsascore }}</td>
    <td>{{ implode(' ', $message->status()) }}</td>
</tr>
@endforeach
@else
<tr :class="message_status_class(message)" v-for="message in messages">
    <td align="center">[<a :href="'/messages/'+message.uuid">&nbsp;&nbsp;</a>]</td>
    <td>@{{ message.hostname }}</td>
    <td align="center">@{{ message.date }} @{{ message.time }}</td>
    <td>@{{ message.from_address }}</td>
    <td>@{{ message.to_address }}</td>
    <td>@{{ message.subject }}</td>
    <td align="right">@{{ message.size }}</td>
    <td align="right">@{{ message.sascore }}</td>
    <td align="right">@{{ message.mcpsascore }}</td>
    <td>@{{ get_message_status(message).join(' ') }}</td>
</tr>
@endif