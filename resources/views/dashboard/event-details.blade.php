@extends('layout.main')
@section('content')
<!-- Main -->
        <div id="main">
            <div class="inner">
                <header>
                    <h1>Events Calendar.</h1>
                    <p>Event Details.</p>
                </header>
                <section>
                    <h2>{{$event->event_name}}</h2>
                    <p>Scheduled On: {{$event->event_timestamp}}</p>
                    <blockquote>
                        {{$event->event_description}}
                    </blockquote>
                </section>
            </div>
        </div>
@endsection