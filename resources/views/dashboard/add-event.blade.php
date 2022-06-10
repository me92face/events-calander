@extends('layout.main')
@section('content')
<!-- Main -->
        <div id="main">
            <div class="inner">
                <header>
                    <h1>Events Calendar.</h1>
                    <p>Add new event.</p>
                </header>
                <section>
                    <form method="post" enctype="multipart/form-data" action="{{URL::to('add-new-event')}}">
                        @csrf
                        <div class="fields">
                            <div class="field form-group col-12">
                                <label for="event_name">Event Name</label>
                                <input type="text" name="event_name" class="form-control" id="event_name" required placeholder="Event Name">
                            </div>
                            <div class="field form-group col-12">
                                <label for="event_description">Event Description</label>
                                <textarea name="event_description" class="form-control" id="event_description" placeholder="Event Description" required></textarea>
                            </div>
                            <div class="field form-group col-12">
                                <label for="event_timestamp">Event Date &amp; Time</label>
                                <input type="datetime-local" name="event_timestamp" class="form-control" id="event_timestamp" required placeholder="Event Name">
                            </div>
                            <div class="field form-group col-12">
                                <input type="submit" value="SUBMIT" class="primary" />
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
@endsection