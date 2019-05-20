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
                      <span> / </span> <a href="#"> {{ $event->category->name() }}</a>
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
                        <p> {{ date('M d', strtotime($event->date_from) ) }} </p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_time_blue.png') }}"> </span>
                        <p> {{ date('H:i', strtotime($event->time_from)) }}
                          – {{ date('H:i', strtotime($event->time_to)) }} </p>
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
      <div class="profile-hold">
        <div class="price-book-event form-hold">
          <div class="row">
            <form action="{{ route('event.place_order', $event->id) }}" method="post">
              @csrf

              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12  event-pricing">
                <div class="balance-hold">


                  <div class="balance-buying">
                    <h1> @lang("event.select_ticket_quantity")Selected Ticket Quantity</h1>
                    <p> Donec lectus turpis, suscipit non varius in, consectetur vitae sapien. Praesent nibh orci,
                      placerat eget semper vitae, suscipit et nibh.</p>
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
                          @foreach($event->multiplePrice as $price)
                            <tr>
                              <td>
                                <div class="ticket-types-val"> {{ $price->name() }} </div>
                              </td>

                              <td>
                                <div class="ticket-types-val"> {{ $price->cost }} {{ $selected_currency->symbol }}</div>
                              </td>

                              <td class="height-limit-list">
                                <select name="quantity[{{ $price->id }}]" data-id="{{ $price->id }}" data-cost="{{ $price->cost }}" class="selectpicker" style="max-width:100px!important;">
                                  @foreach(range(0, $event->capacity) as $key)
                                    <option value="{{ $key }}">{{ $key }}</option>
                                  @endforeach
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
                </div>

                <div class="book-btn">
                <span>
                  <button type="submit" class="normal-btn blue-button big-button next-step"> @lang("event.next") </button>
                </span>
                </div>
              </div>
            </form>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  event-pricing">
              <div class="ticket-head-inner">
                @lang("event.ticket_price")
              </div>
              <div class="review-hold ticketprice-acc">
                <ul id="review" class="accordion">
                  @foreach($event->multiplePrice()->orderBy('cost')->get() as $price)
                    <li>
                      <h3 class="ticket-title"> {{ $price->name() }} @lang("event.ticket")</h3>
                      <ul class="panel loading category-filter ">
                        <div class="event-pricing-items">
                          <ul>
                            <li>
                              <div class="value-hold">
                                <strong> {{ $price->name() }} </strong> <span> {{ $price->cost }} {{ $selected_currency->symbol }}/@lang("event.ticket_price") </span>
                              </div>
                              <ul>
                                <div class="ticket-subtitle">
                                  @lang("event.group") {{ $price->name() }} @lang("event.tickets")
                                </div>
                                @foreach($price->groupPrice()->orderBy('ticket_no')->get() as $group)
                                  <li>
                                    <div class="value-hold">
                                      <strong> {{ $price->name() }} {{ $group->ticket_no }} @lang("event.tickets") </strong> <span> {{ $group->price }}
                                          {{ $selected_currency->symbol }}/@lang("event.ticket_price") </span>
                                    </div>
                                  </li>
                                @endforeach
                              </ul>
                            </li>

                          </ul>
                        </div>
                      </ul>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('lower_javascript')
  <script>

      $price = {!! json_encode($event->multiplePrice) !!};

      $('select[name*="quantity"]').change(function () {

          getTotal();
      });

      function getTotal() {

          var total = 0;
          $('select[name*="quantity"]').each(function () {
              var multP, groupP, i, j;
              var subTotal = 0;
              var countT = $(this).val();

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
          });

          $('#totla-mt').text(total + '{{ $selected_currency->symbol }}');

      }

      @if(Session::has('alert'))
      swal('error', '{{Session::get('alert')}}', 'error');
    @endif
  </script>
@endsection