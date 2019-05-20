@extends('admin::index') 
@section('content')
<section class="content-header">
    <h1>
        <span> Event ({{ $event_id }}) attendees Details </span>
    </h1>
</section>

<section class="content">
    @include('admin::partials.alerts')
    @include('admin::partials.exception')
    @include('admin::partials.toastr')

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>mobile</th>
                        <th>ticket type</th>
                        <th> seat # </th>
                        <th> status </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($eventAttendees as $eventAttendee)
                          @foreach($eventAttendee->attendees as $attendee)
                            <tr>
                              <td> {{ $loop->iteration }} </td>
                              <td>{{ $attendee->name }}</td>
                              <td>{{ $attendee->email }}</td>
                              <td>{{ $attendee->mobile }}  </td>
                              <td>{{ $attendee->ticketType->name() }}  </td>
                              <td>{{ $attendee->seat_no }}  </td>
                              <td class="status">@switch($attendee->status)
                                  @case(\App\Models\Attendee::STATUS_ATTENDED)
                                  Attended
                                  @break
                                  @case(\App\Models\Attendee::STATUS_ABSENT)
                                  ABSENT
                                @endswitch
                            </td>
                            </tr>
                          @endforeach
                        @endforeach
                </tbody>
            </table>
        </div>


        <div class="box-footer clearfix">
            {{ $eventAttendees->links() }}
        </div>
        <!-- /.box-body -->
    </div>


</section>
@endsection