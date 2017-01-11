@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-half">
            <div class="box">
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="http://placehold.it/128x128" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>Recieved messages</strong> <small>within the last</small> <small>1 hour</small>
                            </p>
                            <p><a class="button">View message activity</a></p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="column is-half">
            <div class="box">
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="http://placehold.it/128x128" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>Sent messages</strong> <small>within the last</small> <small>1 hour</small>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column is-half">
            <div class="box">
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="http://placehold.it/128x128" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>Infected messages</strong> <small>within the last</small> <small>1 hour</small>
                            </p>
                            <p><a class="button">Go to reports</a></p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="column is-half">
            <div class="box">
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="http://placehold.it/128x128" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>Released messages</strong> <small>within the last</small> <small>1 hour</small>
                            </p>
                            <p><a class="button">View audit logs</a></p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
        <div class="columns">
        <div class="column is-half">
            <div class="box">
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="http://placehold.it/128x128" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>Spam messages</strong> <small>within the last</small> <small>1 hour</small>
                            </p>
                            <p><a class="button">Go to reports</a></p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="column is-half">
            <div class="box">
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="http://placehold.it/128x128" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>Messages quarantined</strong> <small>within the last</small> <small>1 hour</small>
                            </p>
                            <p><a class="button">View messages</a> <a class="button">Contact support</a></p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection
