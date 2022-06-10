@extends('layout.main')
@section('content')
<!-- Main -->
        <div id="main">
            <div class="inner">
                <header>
                    <h1>Events Calendar (Admin).</h1>
                    <p>All the events are shown here. Please approve the events</p>
                </header>
                <section>
                    <table class="table datatables" id="table_id">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Created On</th>
                                <th>Created By</th>
                                <th>Updated On</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tablecontents">
                            {{-- @php $count = 1; @endphp --}}
                            @if($events) @foreach ($events as $event)
                            <tr class="row1" data-id="{{$event->id}}">
                                <td></td>
                                <td><a href="{{URL::to('admin/view-event/'.$event->id)}}">{{$event->event_name}}</a></td>
                                <td>{{$event->created_at->diffForHumans()}}</td>
                                <td>{{$event->creator->name}}</td>
                                <td>{{$event->updated_at->diffForHumans()}}</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="is_approved" data-id="{{$event->id}}"
                                            class="custom-control-input course-checkbox" id="event_{{$event->id}}"
                                            @if($event->is_approved) checked @endif>
                                        <label class="custom-control-label" for="event_{{$event->id}}"></label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach @endif
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
@endsection
@push('style')
<style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
</style>
@endpush
@push('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
    //approve event
    $(document).ready(function() {
        $('input[name="is_approved"]').change(function() {
            $.ajax({
                type: "POST", 
                dataType: "json", 
                url: "{{ url('admin/update-event-status') }}",
                data: {
                id : $(this).data('id'),
                status : $(this).is(":checked"),
                _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    if (response.status) {
                        Toast.fire(response.head, response.body, "success");
                    } else {
                    console.log(response);
                    }
                }
            });
        });
    });
</script>
@endpush