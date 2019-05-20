@extends('layouts.app')

@section('content')
  <div class="full-width">
    <section class="container profile-frame-container">
      <div class="breadcrumb">
        <ul>
          <li><a href="#"> Home </a></li>
          <li><a href="#"> Home </a></li>
          <li><a href="#"> Home </a></li>
        </ul>
      </div>
      <div class="profile-hold ">
        <div class="eventdetails-top-part event-booking-top">
          <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventdetails-info">
              <div class="thankyou-hold">
                <div class="thnk-img">
                  <img src="{{ asset('/images/thankyouheart.png') }}">
                </div>

                <h2> @lang("event.thank_you") </h2>
                <p> @lang("event.copy_of_this_ticket_message", ['email' => $booking->email]) </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-hold ">
        <div class="eventdetails-top-part event-booking-top">
          <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 thankyou-table " style="padding:2%;">
              <style>
                .thankyou-table table {
                  margin-bottom: 20px;
                  font-family: Verdana, Geneva, sans-serif;
                }

                .thankyou-table table tr th {
                  font-weight: bold;
                  padding: 10px 0 10px 0;
                }

                .thankyou-table h2 {
                  color: #002a81;
                  font-weight: bold;
                  font-size: 18px;
                  text-transform: uppercase;
                  margin: 0 0 11px 0;
                  width: 100%;
                  background: #dee5f2;
                  padding: 10px;
                  font-family: Verdana, Geneva, sans-serif;
                }

                .thankyou-table table tr td h2 {
                  color: #002a81;
                  font-weight: bold;
                  font-size: 18px;
                  text-transform: uppercase;
                  margin: 0 0 11px 0;
                  width: 100%;
                }

                .thankyou-table table tr td {
                  padding: 4px 0 4px 0;
                  border-bottom: solid 1px #ced1d8;
                }

                .thankyou-table table tr td span {
                  margin: 11px 0 10px 0;
                  float: left;
                  width: 100%;
                }

                .thankyou-table table tr .event-title-tbl img {
                  max-width: 100px;
                }

                .thankyou-table table tr .event-title-tbl h1 {
                  font-size: 20px;
                  font-weight: bold;
                  float: left;
                }

              </style>

              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="60%" align="left" valign="middle"><img src="{{ asset('images/Rizit_logo.png') }}"></td>
                  <td width="40%" align="right" valign="middle"><span> @lang("event.order_id")
                      Order ID: #{{ $booking->id }} </span>
                    <span> @lang("event.date") : {{ date('Y-m-d') }} </span>
                  </td>
                </tr>
              </table>

              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="83%" align="left" valign="top" class="event-title-tbl">
                    <h1 style="font-size:20px;font-weight:bold; float:left;"> Aliquam urna metus, sagittis nec
                      turpis </h1>
                    <p style="width:100%; float:left;"> Mauris consectetur tincidunt nisi, nec tincidunt nibh lobortis
                      et.</p>
                    <p style="width:100%; float:left;"> >@lang("event.event_date"): {{  \Carbon\Carbon::parse($booking->event->date_from)->format('d-M-y')  }}</p>
                    <p style="width:100%; float:left;"> >@lang("event.event_location")
                      : {{ $booking->event->location_name() }}</p>
                  </td>

                  <td width="17%" align="right" valign="top" class="event-title-tbl">
                    <img src="{{ asset('images/download.png') }}">
                  </td>

                </tr>
              </table>


              <h2>@lang("event.ticket_holder_details"):</h2>

              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="18%">@lang("event.name")</td>
                  <td width="82%">{{ $booking->name }}</td>
                </tr>
                <tr>
                  <td>@lang('website.Phone')</td>
                  <td>{{ $booking->mobile }}</td>
                </tr>
                <tr>
                  <td>@lang("event.email")</td>
                  <td>{{ $booking->email }}</td>
                </tr>
              </table>
              <h2>@lang("event.ticket_details"):</h2>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <th width="35%">@lang("event.ticket_name")</th>
                  <th width="40%">@lang("event.quantity")</th>
                  <th width="25%">@lang("event.total")</th>
                </tr>
                @php
                  $total = 0;
                @endphp
                @foreach($booking->details as $row )
                
                  <tr>
                    @if($booking->event->use_seatmap)
                      <td>{{ $row->groupPrice->name() }}</td>
                    @elseif($row->groupPrice)
                      <td> {{ $row->groupPrice->name() }}</td>
                      @else 
                      <td></td>
                    @endif
                    <td>{{ $row->quantity }}</td>
                    <td>{{ $row->total_price }} {{ $selected_currency->symbol }}</td>
                  </tr>
                  @php
                    $total += $row->total_price;
                  @endphp
                @endforeach
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td style="font-weight:bold; font-size:17px; color:#00246f; padding:10px 0 10px 0;">@lang("event.total")
                    : {{ $total }} {{ $selected_currency->symbol }}</td>
                </tr>
              </table>

              <button type="button" onclick="window.print()"
                      class="normal-btn blue-button big-button next-step"> @lang("event.print")</button>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
