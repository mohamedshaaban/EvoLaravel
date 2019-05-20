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
                        <p> {{ date('M d', strtotime($event->date_from) ) }} </p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_time_blue.png') }}"> </span>
                        <p> {{ date('H:i', strtotime($event->time_from)) }}
                          – {{ date('H:i', strtotime($event->time_to)) }} </p>
                      </li>
                      <li><span> <img src="{{ asset('/images/event_duration_blue.png') }}"> </span>
                        <p> {{ (new \Carbon\Carbon($event->date_from))->diffInDays($event->date_to)+1 }} @lang("event.days")</p>
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
            <form action="{{ route('event.checkout', $event->id) }}" method="post">
              @csrf

              @php
                $q = request('quantity', '[]');
                $q = is_string($q)? $q: json_encode($q)
              @endphp
              <input type="hidden" name="quantity" value="{{ $q }}">

              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12  event-pricing">
                <div class="balance-hold">

                  <div class="timer-hold">
                    <div class="timer-img">
                      <img src="{{ asset('images/timer.png') }}">
                    </div>
                    <div class="timer-txt">
                      <p> @lang('event.kindly_complete_your_booking_and_payment_in')
                        <span class="bal-time" id="time" data-suffix="@lang('event.min')">  5:00 @lang('event.min')</span>
                      </p>
                    </div>
                  </div>

                  <div class="balance-buying">
                    <h1> @lang("event.ticket_holder_information")</h1>
                    <p> Donec lectus turpis, suscipit non varius in, consectetur vitae sapien. Praesent nibh orci,
                      placerat eget semper vitae, suscipit et nibh. <br></p>
                  </div>

                  <div class="form-hold">
                    <ul>

                      <li>
                        <label>@lang("event.name") * </label>
                        <input type="text" name="name" class="normal-text-box" value="{{ old('name') }}">
                      </li>
                      <li>
                        <label>@lang("event.email") * </label>
                        <input type="email" name="email" class="normal-text-box" value="{{ old('email') }}">
                      </li>
                      <li>
                        <label>@lang("event.mobile") * </label>
                        <input type="text" name="mobile" class="normal-text-box" value="{{ old('mobile') }}">
                      </li>

                    </ul>
                  </div>
                </div>

                <div class="balance-hold">
                  <div class="balance-buying">
                    <h1> @lang("event.select_your_payment_option")</h1>
                    <p> Donec lectus turpis, suscipit non varius in, consectetur vitae sapien. Praesent nibh orci,
                      placerat eget semper vitae, suscipit et nibh. <br></p>
                  </div>

                  <div class="rating-chkboxs">
                    <ul>
                      <li>
                        <div class="rating-value">
                          <label class="checkbox-container">
                            <img src="{{ asset('images/kent_card.jpg') }}">
                            <input type="radio" name="payment_type" checked=""
                                   value="{{ \App\Models\Booking::PAYMENT_TYPE_KNET }}">
                            <span class="checkmark"></span>
                          </label>
                        </div>
                      </li>
                      <li>

                        <div class="rating-value">

                          <label class="checkbox-container">
                            <img src="{{ asset('images/master_card.jpg') }}">
                            <input type="radio" name="payment_type"
                                   value="{{ \App\Models\Booking::PAYMENT_TYPE_MASTER }}">
                            <span class="checkmark"></span>
                          </label>
                        </div>

                      </li>
                      <li>

                        <div class="rating-value">

                          <label class="checkbox-container">
                            <img src="{{ asset('images/visa_card.jpg') }}">
                            <input type="radio" name="payment_type"
                                   value="{{ \App\Models\Booking::PAYMENT_TYPE_VISA }}">
                            <span class="checkmark"></span>
                          </label>
                        </div>

                      </li>
                    </ul>
                  </div>

                  <div class="form-hold">
                    <ul>
                      <li class="fullwidth-li">
                        <button type="button" onclick="history.go(-1);"
                                class="normal-btn grey-button big-button "> @lang('event.back')</button>
                        <button type="submit"
                                class="normal-btn blue-button big-button "> @lang('event.proceed')</button>

                      </li>
                    </ul>
                  </div>

                </div>
              </div>
            </form>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  event-pricing">
              <div class="ticket-head-inner">
                @lang('event.ticket_price')
              </div>

              <div class="total-summary">

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-types ticket-booking-table">
                  <tr>
                    <th width="22%" class="balance-head">@lang('event.ticket_name')</th>
                    <th width="36%" class="balance-head">@lang('event.quantity')</th>
                    <th width="30%" align="right" valign="middle" class="balance-head ">@lang('event.total')</th>
                  </tr>

                  @php
                    $total = 0;
                  @endphp

                  @foreach(json_decode($q, true) as $key=>$row)
                    @php
                    
                      if($event->use_seatmap){
                      $multiP = $event->getMultiplePrice($row['typeId']);
                        $subTotal = $multiP->getTotalPrice(count($row['seats']));
                      }
                      elseif($event->multi_price==1) {
                        $multiP = $event->getMultiplePrice($key);
                        $subTotal = $multiP->getTotalPrice($row);
                      }
                      else {
                        $multiP = null;
                        $subTotal = $row * $event->fee;
                      }
                        $total += $subTotal;
                        
                    @endphp
                    <tr>
                      <td>
                        <div class="ticket-types-val"> {{ $multiP? $multiP->name(): '-' }} </div>
                      </td>
                      <td>
                        <div class="ticket-types-val"> {{ isset($row['seats'])? count($row['seats']): $row }} </div>
                      </td>
                      <td>
                        <div class="ticket-types-val"> {{ $subTotal }} {{ $selected_currency->symbol }} </div>
                      </td>
                    </tr>
                  @endforeach

                </table>

                <div class="total-amt1 summry-totl" style="text-align:center;"> @lang('event.total')
                  : {{ $total }} {{ $selected_currency->symbol }} </div>
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
      setInterval(function () {
          var $time = $('#time');
          if ($time.data('time') == undefined) {
              $time.data('time', 5*60);
          }

          $new = $time.data('time')-1;
          $time.data('time', $new);

          $time.text(parseInt($new/60)+':'+String(($new%60)/100).substring(2)+' '+$time.data('suffix'));

          if($new==60){
              swal("", "@lang("event.you_time_about_to_finish")", "warning");
          }
          else if($new==0){
              swal("", "@lang("event.time_run_out_you_have_to_start_over")", "warning").then(function () {
                  window.location.href = '{{ route('event_details', $event->id) }}';
              });
          }

      }, 1000);
  </script>
@endsection