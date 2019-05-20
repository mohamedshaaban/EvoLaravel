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
      <div class="profile-hold right-blue-pattern">
        <div class="eventdetails-top-part event-booking-top">
          <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdetails-info">
              <div class="detailspage-info-hold ticket-booking-info">
                <div class="profile-info-hold">
                  <div class="profile-image"><img src="{{ asset(Optional($event->main_media())->link) }}"></div>
                  <div class="profile-details">
                    <h1> {{ $event->title() }} </h1>
                    <div class="eventdetail-cat-type"><a href="#"> {{ Optional($event->category->parent)->name() }}</a>
                      <span> - </span> <a href="#"> {{ $event->category->name() }}</a>
                    </div>
                    <div class="eventdetail-sponsor"><a href="#"> {{ $event->host->company_name }}</a></div>
                    <div class="host-rating-hold">
                      <ul>
                        <li>
                          <div class="rating-image "><img src="{{ asset('/images/rating_high.png') }}"></div>
                          <div class="rating-value r-hi">
                            <p>{{ $event->ratingpositive($event->id)}} </p>
                          </div>
                        </li>
                        <li>
                          <div class="rating-image "><img src="{{ asset('/images/rating_med.png') }}"></div>
                          <div class="rating-value r-me">
                            <p>{{ $event->ratingneutral($event->id)}} </p>
                          </div>
                        </li>
                        <li>
                          <div class="rating-image  "><img src="{{ asset('/images/rating_down.png') }}"></div>
                          <div class="rating-value r-do">
                            <p>{{ $event->ratingnegative($event->id)}} </p>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="share-flag"><a href="#"> <img src="{{ asset('/images/share.jpg') }}"> </a> <a href="#">
                        <img
                            src="{{ asset('/images/flag2.jpg') }}"> </a></div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdetails-info">
              <div class="detailspage-info-hold">

                <div class="homesubslide-details-hold  detailspage-info-part">
                  <div class="detail-points">
                    <ul>
                      <li><span> <img src="{{ asset('/images/event_date_blue.png') }}"> </span>
                        <p>{{ date('M d', strtotime($event->date_from) ) }}</p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_time_blue.png') }}"> </span>
                        <p>{{ date('H:i', strtotime($event->time_from)) }}
                          – {{ date('H:i', strtotime($event->time_to)) }}</p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_duration_blue.png') }}"> </span>
                        <p> {{ (new \Carbon\Carbon($event->date_from))->diffInDays($event->date_to)+1 }} @lang('event.days')</p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_people_blue.png') }}"> </span>
                        <p> {{ $event->event_attendes_num($event->id) }}/ {{ $event->capacity }}</p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_mf_blue.png') }}"> </span>
                        <p> @php
                            switch($event->gender){
                             case \App\Models\Event::GENDER_MALE:
                             echo __("event.male");
                             break;
                             case \App\Models\Event::GENDER_FEMALE:
                             echo __("event.female");
                             break;
                             case \App\Models\Event::GENDER_BOTH:
                             echo __("event.both");
                             break;
                             }
                          @endphp</p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_cat_blue.png') }}"> </span>
                        <p> {{ $event->age_from }} - {{ $event->age_to }} </p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_location_blue.png') }}"> </span>
                        <p> {{ $event->location_name() }} </p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <form id="bookingForm" action="{{ route('event.place_order', $event->id) }}" method="post">
        @csrf
        <input type="hidden" name="quantity" id="quantity" value="[]" />

        <div class="profile-hold">
          <div class="price-book-event form-hold">
            <div class="row">
                @if($event->use_seatmap)
              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12  event-pricing">
                  @else 
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  event-pricing">
                  @endif
                <div class="balance-hold">

                  @if($event->use_seatmap)
                  <div class="balance-buying">
                    <div id="map-container" class="right col-xs-6"></div>
                    <ul class="seatChart-legend-list">
                      <li class="seatChart-legend-item">
                        <div class="seatChart-seat legend-style  clicked"
                             style="background-color: #ccc !important; border: 1px solid #b4b4b4;"></div>
                        <p class="seatChart-legend-description">@lang('event.previous_booked_seats')</p>
                      </li>
                      <li class="seatChart-legend-item">
                        <div class="seatChart-seat legend-style  clicked" style="background-color: orange"></div>
                        <p class="seatChart-legend-description">@lang('event.your_booked_seats')</p>
                      </li>
                    </ul>
                  </div>
                  @else
                    <div class="balance-buying">
                      <h1> @lang("event.select_ticket_quantity")</h1>
                      <p> <br /></p>
                    </div>


                    <div class="form-hold">

                      <ul>
                        <li class="fullwidth-li">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-types ticket-booking-table">
                            <tr>
                              <th width="26%" class="balance-head">@lang("event.ticket_name")</th>
                              <th width="22%" class="balance-head">@lang("event.price")</th>
                              <th width="22%" class="balance-head">@lang("event.quantity")</th>
                              <th width="30%" align="right" valign="middle" class="balance-head ">@lang("event.total")</th>
                            </tr>
                            
                            @if($event->multi_price==0)
                              <tr>
                                <td>
                                  <div class="ticket-types-val"> - </div>
                                </td>

                                <td>
                                  <div class="ticket-types-val"> {{ $event->fee }} {{ $selected_currency->symbol }}</div>
                                </td>

                                <td class="height-limit-list">
                                  <select name="quantity[0]" data-id="0" data-cost="{{ $event->fee }}" class="selectpicker" style="max-width:100px!important;">
                                    @foreach(range(0, $event->capacity - \App\Models\Attendee::whereNull('canceled_at')->where('event_id', $event->id)->count()) as $key)
                                      <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                  </select>
                                </td>

                                <td>
                                  <div class="ticket-types-val" id="quantity_0"> 0 {{ $selected_currency->symbol }}</div>
                                </td>
                              </tr>
                            @endif
                         
                         
                        
                            @foreach($event->multiplePrice as $price)
                            @php 
                            $cancalledTickets = \App\Models\Attendee::where('ticket_type',$price->id)->whereNotNull('canceled_at')->where('event_id', $event->id)->count();
                            
                            $restTickets = $event->capacity-\App\Models\BookingDetail::where('multiple_price_id',$price->id)->sum('quantity')+$cancalledTickets;
                            @endphp
                            
                              <tr>
                                <td>
                                  <div class="ticket-types-val"> {{ $price->name() }} </div>
                                </td>

                                <td>
                                  <div class="ticket-types-val"> {{ $price->cost }} {{ $selected_currency->symbol }}</div>
                                </td>

                                <td class="height-limit-list">
                                 
                                    <select name="quantity[{{ $price->id }}]" data-id="{{ $price->id }}" data-cost="{{ $price->cost }}" class="selectpicker" style="max-width:100px!important;">
                                     @if($restTickets > 0 )
                                      @foreach(range(0, $restTickets) as $key)
                                      <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach 
                                    @else 
                                    <option value="0">0</option>
                                    @endif
                                  </select>
                                 
                                </td>

                                <td>
                                  <div class="ticket-types-val" id="quantity_{{ $price->id }}"> 0 {{ $selected_currency->symbol }}</div>
                                </td>
                              </tr>
                            @endforeach

                            <tr>
                              <td>
                                <div class="ticket-types-val"></div>
                              </td>
                              <td>
                                <div class="ticket-types-val"></div>
                              </td>
                              <td></td>
                              <td>
                                <div class="total-amt1"> @lang("event.total"): <span id="totla-mt">0 {{ $selected_currency->symbol }}</span></div>
                              </td>
                            </tr>
                          </table>
                        </li>
                      </ul>
                    </div>

                  @endif

                </div>
              </div>
              @if($event->use_seatmap)
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  event-pricing">
                <img class="real-map-img" src="{{ asset($event->seat_map_img) }}" class="img-responsive"/>
                <div class="selectedseat">
                  <h1>@lang('event.selected_seats')</h1>
                  <table id="selseat" class="table table-hover table-bordered ">
                    <thead>
                    <tr>
                      <th>@lang('event.seats_type')</th>
                      <th>@lang('event.seats_name')</th>
                      <th>@lang('event.seats_qty')</th>
                      <th>@lang('event.seats_price')</th>
                    </tr>
                    </thead>
                    <tbody class="selseat"></tbody>
                  </table>

                  <div>
                    <span class="totalPriceTxt">@lang('event.total_is'):
                      <span id="totalPrice" class="totalPriceNum">0</span>
                    </span>
                  </div>
                </div>
              </div>

              @endif

              <div class="col-xs-12">
                <div class="book-btn">
                <span>
                    <button type="button" class="normal-btn blue-button big-button next-step"
                    id="submitNext" > @lang('event.next') </button>
                </span>
                </div>
              </div>
            </div>

          </div>
        </div>
      </form>

    </section>
  </div>
@endsection

@section('lower_javascript')

  @if($event->use_seatmap)

  <script type="text/javascript" src="{{ asset('js/seatchart.js') }}"></script>
  <script>
      var sc;
      $(document).ready(function () {

          $price = {!! json_encode($event->multiplePrice) !!};

          //THE MOST IMPORTANT ARRAY
          var seatMapSettings = {
              rows: {!! $event->rows !!},
              cols: {!! $event->cols !!},
              mapRows: {!! $event->seat_map_data !!}
          };


          //generate map with the previous booked seats
          var savedbookedSeats = {!! json_encode(\App\Models\Attendee::where('event_id', $event->id)->get(['seat_id'])->pluck('seat_id')) !!};

          var ii, seat_row, arrSeat;
          var reservedSeats = [];
          for (ii = 0; seat_row = savedbookedSeats[ii]; ii++) {
              arrSeat = String(seat_row).split('_');
              reservedSeats.push(seatMapSettings.cols * arrSeat[0] + parseInt(arrSeat[1]));
          }

          //create saved seat map
          var map = {
              rows: seatMapSettings.rows,
              cols: seatMapSettings.cols,
              reserved: reservedSeats,
              //disabled: [12, 21, 23]
          };

          var types = [
              {type: "booked", color: "orange", price: 0}
          ];

          sc = new SeatchartJS(map, types);
          sc.setAssetsSrc("{{ asset('assets') }}");
          sc.setCurrency("kd");
          sc.setSoundEnabled(true);
          sc.createMap("map-container");


          //generate client seatmap
          $.each($(".seatChart-row"), function (i, l) {
              if (i >= 2) {
                  var x;
                  for (x = 0; x < seatMapSettings.mapRows.length; x++) {
                      if ((i - 2) == x) {
                          $(this).find(".seatChart-seat.index").html(seatMapSettings.mapRows[x].prefix);
                          $.each($(".seatChart-seat[id^=" + x + "]"), function (j, seat) {
                              //generate seat attributes
                              $(this).attr('data-price-type-id', seatMapSettings.mapRows[x].id);
                              $(this).attr('data-price-type', seatMapSettings.mapRows[x].value);
                              $(this).attr('data-background-color', seatMapSettings.mapRows[x].color);
                              //generate seat design
                              $(this).text(seatMapSettings.mapRows[x].prefix + (j + 1));
                              $(this).css('background-color', seatMapSettings.mapRows[x].color);
                          });
                      }
                  }
              }
          });


          //on click seat

          var bookedSeats = [];

          $(".seatChart-seat.available").on("click", function () {

              $("tbody.selseat").empty();
              $('#totalPrice').empty();

              if (bookedSeats.length > 0) {
                  for (var i = 0; i < bookedSeats.length; i++) {
                      if ($(this).attr("data-price-type-id") == bookedSeats[i].typeId) {
                          var found = false;
                          for (var j = 0; j < bookedSeats[i].seats.length; j++) {
                              if (bookedSeats[i].seats[j].seatId == $(this).attr("id")) {
                                  found = true;
                                  break;
                              }
                          }
                          if (!found) {
                              bookedSeats[i].seats.push({
                                  seatId: $(this).attr("id"),
                                  seatName: $(this).text()
                              });
                              break;
                          } else {
                              if (!$(this).hasClass("booked")) {

                                  var removeItem = $(this).attr("id");
                                  bookedSeats[i].seats = jQuery.grep(bookedSeats[i].seats, function (value) {
                                      return value.seatId != removeItem;
                                  });

                                  if (bookedSeats[i].seats.length == 0) {
                                      var removeRow = bookedSeats[i];
                                      bookedSeats = jQuery.grep(bookedSeats, function (row) {
                                          return row != removeRow;
                                      });
                                  }
                                  $(this).css('background-color', $(this).attr("data-background-color"));
                                  break;

                              }
                          }
                      } else {
                          if (i == (bookedSeats.length - 1)) {
                              bookedSeats.push({
                                  typeId: $(this).attr("data-price-type-id"),
                                  typeValue: $(this).attr("data-price-type"),
                                  seats: [
                                      {
                                          seatId: $(this).attr("id"),
                                          seatName: $(this).text()
                                      }
                                  ]
                              });
                          }
                      }
                  }
              } else {
                  bookedSeats.push({
                      typeId: $(this).attr("data-price-type-id"),
                      typeValue: $(this).attr("data-price-type"),
                      seats: [
                          {
                              seatId: $(this).attr("id"),
                              seatName: $(this).text()
                          }
                      ]
                  });
              }

              //print seats summary
              for (var j = 0; j < bookedSeats.length; ++j) {

                  $('tbody.selseat').append('<tr>'
                      + '<td>' + bookedSeats[j].typeValue + '</td><td class="seatsName" style="font-size:10px;"></td>'
                      + '<td>' + bookedSeats[j].seats.length + '</td>'
                      + '<td>' + getTotalItem(bookedSeats[j].typeId, bookedSeats[j].seats.length) + '{{ $selected_currency->symbol }}</td></tr>');

                  for (var i = 0; i < bookedSeats[j].seats.length; ++i) {
                      if (i == 0) {
                          $('tbody.selseat').find(".seatsName")[j].append(bookedSeats[j].seats[i].seatName);
                      } else {
                          $('tbody.selseat').find(".seatsName")[j].append(',' + bookedSeats[j].seats[i].seatName);
                      }
                  }
              }
              $('#totalPrice').text(getTotal(bookedSeats) + ' {{ $selected_currency->symbol }}');

              $('#quantity').val(JSON.stringify(bookedSeats));
          });

      });
  </script>

  @else

  <script>
      $price = {!! json_encode($event->multiplePrice) !!};

      $('select[name*="quantity"]').change(function () {

          getTotal();

      });

      function getTotal() {
          var total = 0;

          $('tbody.selseat').empty();

          $('select[name*="quantity"]').each(function () {

              var subTotal = 0;
              var countT = $(this).val();

              @if($event->multi_price==0)

              subTotal =  countT * {{ $event->fee }};
              $('#quantity_' + $(this).data('id')).text(subTotal + '{{ $selected_currency->symbol }}');

              total += subTotal;

              @else

              var multP, groupP, i, j;

              for (i = 0; multP = $price[i]; i++) {
                  if (multP.id == $(this).data('id')) {
                      for (j = multP.group_price.length - 1; groupP = multP.group_price[j]; j--) {
                          if (groupP.ticket_no <= countT) {
                              w = parseInt(countT / (groupP.ticket_no==0? 1:groupP.ticket_no));
                              subTotal += w * groupP.price;
                              countT -= w * groupP.ticket_no;
                          }
                      }

                      break;
                  }
              }

              subTotal += countT * $(this).data('cost');

              subTotal = subTotal * 1000;
              subTotal = Math.round(subTotal);
              subTotal = subTotal / 1000;

              $('#quantity_' + $(this).data('id')).text(subTotal + '{{ $selected_currency->symbol }}');

              total += subTotal;

            @endif

          });

          $('#totla-mt').text(total + '{{ $selected_currency->symbol }}');

      }

      @if(Session::has('alert'))
      swal('error', '{{Session::get('alert')}}', 'error');
    @endif
  </script>

  @endif

  <script>

      $(document).ready(function () {

          $('#submitNext').click(function(){
              @if($event->use_seatmap)

              if($('#quantity').val() == '' || $('#quantity').val() == '[]' || $('#quantity').val() == '{}'){
                  alert('@lang('event.you_have_to_select_seat_first')');
                  return;
              }
              @endif

              $('#bookingForm').submit();
          });
      });

      function getTotalItem(id, qty) {

          var multP, groupP, i, j, w;
          var subTotal = 0;
          var countT = qty;

          for (i = 0; multP = $price[i]; i++) {
              if (multP.id == id) {
                  for (j = multP.group_price.length - 1; groupP = multP.group_price[j]; j--) {
                      if (groupP.ticket_no <= countT) {
                          w = parseInt(countT / (groupP.ticket_no == 0 ? 1 : groupP.ticket_no));
                          subTotal += w * groupP.price;
                          countT -= w * groupP.ticket_no;
                      }
                  }

                  subTotal += countT * multP.cost;

                  subTotal = subTotal * 1000;
                  subTotal = Math.round(subTotal);
                  subTotal = subTotal / 1000;

                  return subTotal;
              }
          }

          return 0;
      }


      @if($event->use_seatmap)
      function getTotal(bookedSeats) {
          var total = 0;
          var i, row;

          for(i=0; row = bookedSeats[i]; i++){
              total += getTotalItem(row.typeId, row.seats.length)
          }

          return total;
      }
      @endif

      @if(Session::has('alert'))
      swal('error', '{{Session::get('alert')}}', 'error');
      @endif
  </script>

@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/build/seatchart.css') }}">
  <style>
    .right {
      float: left !important;
      display: inline-block;
    }

    .left {
      float: right !important;
      display: inline-block;
    }

    #priceType,
    #color {
      list-style-type: none;
      padding-left: 0;
      margin-top: 46px;
    }

    #map-container {
      overflow-x: auto;
      overflow-y: hidden;
      max-width: 100%;
      margin: 20px 0;
      display: block;
      width: 100%;
    }

    .seatChart-container {
      margin: 0 auto;
    }

    #chosenPriceTypeColor li {
      display: inline-block;
      width: auto;
    }

    .priceTypeSelect {
      height: 32px;
      margin: 4px;
    }

    .error, .form-hold .blue-button.error {
      border: 1px solid red;
    }

    ul.generateSubmit li {
      width: 100%;
      text-align: center;
    }

    ul.generateSubmit li button {
      float: none !important;
    }

    .padd0 {
      padding-left: 0 !important;
      padding-right: 0 !important;
    }

    .seatChart-title {
      text-align: left;
      padding: 20px 0;
      color: #000000;
      font-size: 13px;
      float: left;
      width: 100%;
      font-weight: 300;
      margin: 0 0 5px 0;
      min-height: 13px;
    }

    .real-map-img {
      width: 100%;
      margin: 20px 0;
      border: 1px solid #ddd;
    }

    .seatsName {
      word-break: break-all;
    }

    .seatChart-legend-item {
      width: auto;
      margin: 0;
      padding: 10px 0 0;
      vertical-align: middle;
    }

    .seatChart-legend-description,
    .form-hold ul li p.seatChart-legend-description {
      display: inline-block;
      margin: 0 0 0 10px;
      padding: 0;
      width: auto;
    }

  </style>

@endsection