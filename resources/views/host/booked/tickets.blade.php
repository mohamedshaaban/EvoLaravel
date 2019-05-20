@extends('layouts.app')
@section('content')
  <div class="full-width">
    <section class="container profile-frame-container">
      <div class="breadcrumb">
        <ul>
          <li><a href="#"> {{__('website.Home')}} </a></li>
          <li><a href="#"> {{__('website.Home')}}' </a></li>
          <li><a href="#"> {{__('website.Home')}} </a></li>
        </ul>
      </div>
      <div class="profile-hold">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 left-links-hold">
          @include('includes/host_leftside')
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">
          <h1>{{__('website.Attendees')}} </h1>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-contents-left">
              <div class="profile-info-hold">
                <div class="table-data">
                  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table id="attendeeTab" class="basic-table">
                          <thead>
                          <tr>
                            {{--<th>QR</th>--}}
                            <th>{{__('website.Name')}}</th>
                            <th>{{__('website.Email')}}</th>
                            <th>{{__('website.Mobile')}}</th>
                            <th>{{__('website.Ticket Type')}}</th>
                            <th>{{__('website.qr')}}</th>
                            <th>{{__('website.Seat #')}}</th>
                            <th>{{__('website.Status')}}</th>
                            <th></th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($orders as $order)
                            @foreach($order->attendees as $attendee)
                              <tr>
                                {{--<td>{{ $attendee->qr }}</td>--}}
                                <td>{{ $attendee->name }}</td>
                                <td>{{ $attendee->email }}</td>
                                <td>{{ $attendee->mobile }}  </td>
                                <td>{{ $attendee->ticketType->name() }}  </td>
                                <td>{{ $attendee->qr }}  </td>
                                <td>{{ $attendee->seat_no }}  </td>
                                <td class="status">
                                  @if($attendee->canceled_at)
                                    {{ __('Canceled') }}
                                  @else
                                    @switch($attendee->status)
                                      @case(\App\Models\Attendee::STATUS_ATTENDED)
                                      {{ __('Attended') }}
                                      @break
                                      @case(\App\Models\Attendee::STATUS_ABSENT)
                                      {{ __('Absent') }}
                                    @endswitch
                                  @endif
                                </td>
                                <td>
                                @if(
                                  is_null($attendee->canceled_at) &&
                                  $order->event->cancellation &&
                                  (strtotime($order->event->date_from)-($order->event->cancellation_days*24*60*60)>time())
                                )
                                  <button class="btn btn-danger btn-block cancel" data-id="{{ $attendee->id }}">
                                    Cancel
                                  </button>
                                @endif
                                </td>
                              </tr>
                            @endforeach
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row"></div>
      </div>
    </section>
  </div>
@endsection

@section("lower_javascript")
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <script>
      $('#attendeeTab').dataTable();

      $(document).on('click', '.cancel', function () {
          var $this = $(this);

          if(prompt("{{ __('You are going to cancel This Ticket, Do you want to continue?') }}")) {
              $.post('{{ route('host.cancel') }}', {
                  "attendee_id": $this.data('id'),
                  'data': $this.hasClass('attendee') ? {{ \App\Models\Attendee::STATUS_ATTENDED }}: {{ \App\Models\Attendee::STATUS_ABSENT }}})
                  .success(function (d) {
                      if (d.success) {
                          $this.parent().parent().find('.status').text(d.data);
                          $this.remove();
                      }
                  });
          }
      });

  </script>
@endsection