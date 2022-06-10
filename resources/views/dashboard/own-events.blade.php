@extends('layout.main')
@section('content')
<!-- Main -->
        <div id="main">
            <div class="inner">
                <header>
                    <h1>Events Calendar.</h1>
                    <p>Your personal events are shown here. Click on any event to edit it</p>
                </header>
                <section class="tiles">
                    @foreach($events as $event)
                        <article class="style1">
                            <span class="image">
                                <img src="{{asset('dashboard/images/pic01.jpg')}}" alt="" />
                            </span>
                            <a href="{{URL::to('edit-event/'.$event->id)}}">
                                <h2>{{$event->event_name}}</h2>
                                <em>{{$event->event_timestamp->diffForHumans()}}</em>
                                <div class="content">
                                    <p>{{$event->event_description}}</p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </section>
            </div>
        </div>
@endsection