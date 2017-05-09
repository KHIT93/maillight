@foreach ((array) session('flash_notification') as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <v-alert {{ ($message['level'] == 'danger') ? error: $message['level'] }} v-bind:value="true" {{ ($message['important']) ? : dismissible }}>
            {!! $message['message'] !!}
        </v-alert>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
