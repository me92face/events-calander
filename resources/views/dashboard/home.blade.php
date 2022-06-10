@extends('layout.main')
@section('content')
<!-- Main -->
        <div id="main">
            <div class="inner">
                <header>
                    <h1>Events Calendar.</h1>
                    <p>All the approved events are shown here.</p>
                </header>
                <p>
                    <section>
                        @foreach($events as $key => $eventGroup)
                        <section class="tiles">
                            <h2>Events for {{$key}}</h2>
                            @foreach($eventGroup as $event)
                            <article class="style1">
                                <span class="image">
                                    <img src="{{asset('dashboard/images/pic01.jpg')}}" alt="" />
                                </span>
                                <a href="{{URL::to('view-event/'.$event->id)}}">
                                    <h2>{{$event->event_name}}</h2>
                                    <em>{{$event->event_timestamp->diffForHumans()}}</em>
                                    <div class="content">
                                        <p>{{$event->event_description}}</p>
                                    </div>
                                </a>
                            </article>
                            @endforeach
                        </section>
                        @endforeach
                    </section>
                </p>
            </div>
        </div>
@endsection