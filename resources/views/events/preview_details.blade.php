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
      <div class="profile-hrequest right-blue-pattern">
        <div class="eventdetails-top-part">
          <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 details-slider-image">

              <div class="details-image-hrequest">
                <ul class="banner-slider">
                  <li><img class="img" src="{{ asset(request("main-pic")) }}"></li>
                  
                  @foreach(request('myfiles', []) as $media)
                    @php
                      if(is_null($media)){
                          continue;
                      }
                    @endphp
                    <li><img class="img" src="{{ asset($media) }}"></li>
                  @endforeach

                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdetails-info">
              <div class="detailspage-info-hrequest">
                <div class="profile-info-hrequest">
                  <div class="profile-image"><img src="{{ auth()->check()? auth()->user()->avatar: '' }}" class="img">
                  </div>
                  <div class="profile-details">

                    <h1> {{ request('title_'.$lang) }} </h1>
                    <div class="eventdetail-cat-type"><a href="#"> @php
                          $cate = \App\Models\Category::with('parent')->find(request('category', 0));
                          echo optional($cate->parent)->name();
                        @endphp </a> <span> - </span> <a href="#"> {{ $cate->name() }}</a></div>

                    <div class="host-rating-hrequest">
                      <ul>
                        <li>
                          <div class="rating-image "><img src="{{ asset('images/rating_high.png')}}"></div>
                          <div class="rating-value r-hi">
                            <p>120 </p>
                          </div>
                        </li>
                        <li>
                          <div class="rating-image "><img src="{{ asset('images/rating_med.png')}}'"></div>
                          <div class="rating-value r-me">
                            <p>8 </p>
                          </div>
                        </li>
                        <li>
                          <div class="rating-image  "><img src="{{ asset('images/rating_down.png')}}"></div>
                          <div class="rating-value r-do">
                            <p>36 </p>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="share-flag"><a href="#"> <img src="{{ asset('images/share.jpg')}}"> </a> <a href="#">
                        <img src="{{ asset('images/flag2.jpg')}}"> </a></div>
                  </div>
                </div>
                <div class="homesubslide-details-hrequest  detailspage-info-part">
                  <div class="detail-points">
                    <ul>
                      <li><span> <img src="{{ asset('images/event_date_blue.png')}}'"> </span>
                        <p> {{ request('date_from') }} </p>
                      </li>
                      <li><span> <img src="{{ asset('images/event_time_blue.png')}}"> </span>
                        <p> {{ request('time_from') . '-' . request('time_to') }} </p>
                      </li>
                      <li><span> <img src="{{ asset('images/event_duration_blue.png')}}"> </span>
						  <?php
						  $datework = strtotime( request( 'date_to' ) );
						  $dateworkto = strtotime( request( 'date_from' ) );

						  $testdate = ( $datework - $dateworkto ) / 86400;
                                                  if($testdate == 0)
                                                        {
                                                            $testdate = 1;
                                                        }
						  ?>
                        <p> {{  $testdate }} @lang('event.days')</p>

                      </li>
                      <li><span> <img src="{{ asset('images/event_people_blue.png')}}"> </span>
                        <p> 504/600</p>
                      </li>
                      <li><span> <img src="{{ asset('images/event_mf_blue.png')}}"> </span>
                        <p> @if(request('gender') == 1) @lang('event.male') @elseif(request('gender') == 2) @lang('event.female') @else @lang('event.both') @endif </p>
                      </li>
                      <li><span> <img src="{{ asset('images/event_cat_blue.png')}}"> </span>
                        <p> {{ request('age_from').' - '.request('age_to') }} </p>
                      </li>
                      <li><span> <img src="{{ asset('images/event_location_blue.png')}}"> </span>
                        <p> {{ request('location_name_'.$lang) }} </p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-hrequest">
        <div class="price-book-event form-hrequest">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  event-pricing">

              <div class="ticket-head">
                Ticket Price
              </div>

              <div class="review-hrequest ticketprice-acc">
                <ul id="review" class="accordion">
                    
                  @foreach(request( 'event_multiple_price_name_en', [] ) as $key=>$row)
                    <li>
                      <h3 class="ticket-title"> {{ $row }} @lang('event.tickets')</h3>
                      <ul class="panel loading category-filter ">
                        <div class="event-pricing-items">
                          <ul>
                            <li>
                              <div class="value-hrequest">
                                <strong> @lang('event.per_ticket') </strong> <span> {{ request( 'event_multiple_price_cost' )[ $key ] }}
                                    {{ $selected_currency->symbol }}  </span>
                              </div>

                              <ul>
                                <div class="ticket-subtitle">
                                  @lang("event.group") {{ $row }} @lang("event.tickets")
                                </div>
                                @foreach(request( 'event_group_price_ticket_no' ) as $keyG => $valG)

                                  <li>
                                    <div class="value-hrequest">
                                      <strong> {{ $valG }} @lang("event.ticket") </strong> <span> {{ request( 'event_group_price_price' )[ $keyG ] }}
                                          {{ $selected_currency->symbol }} @lang("event.per_ticket") </span>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  event-pricing">
              <div class="book-btn">
                <span>
                    <button class="normal-btn blue-button  booking-btn-style"> + Rizit </button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="event-details-contentpart">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12  event-details-left">
            {!! request('description_'.$lang) !!}
            <div class="event-map">
              <iframe
                  src="https://maps.google.com/maps?q={{ request('address_lat') }},{{ request('address_long') }}&hl=es;z=14&amp;output=embed"
                  width="100%" height="100%" frameborder="0" style="border:0; min-height:252px;"
                  allowfullscreen></iframe>
            </div>
            <div class="listing-title blue-title">
              <h1><span> 24 Activities found </span></h1>
            </div>
            <div class="eventdtata-cat-list-hrequest">
              <div class="section-title">
                <h1> @lang("event.professionals") </h1>
              </div>
              <div class="sub-section-slider-hrequest">
                <ul class="home-host-section-slider">
                    
                  @php
                  if(request("event_professional_professional_id"))
                  {
                    $professionals = \App\Models\AddedProfessional::whereIn('id' , request("event_professional_professional_id"))->get();
                    
                  @endphp
                 
                  @foreach($professionals as $professional)
                    <li>
                      <div class="home-host-slide"><a href="#"> <img src="{{ $professional->img }}" class="img">
                          <div class="host-rating-hrequest ">
                            <h2> {{ $professional['name_'.$lang] }}</h2>
                            <ul>
                              <li>
                                <div class="rating-image ">
                                  <img src="{{ asset('images/rating_high.png')}}">
                                </div>
                                <div class="rating-value r-hi">
                                  <p>{{ auth()->user()->ratingpositive($professional->id) }} </p>
                                </div>
                              </li>

                              <li>
                                <div class="rating-image ">
                                  <img src="{{ asset('images/rating_med.png')}}">
                                </div>
                                <div class="rating-value r-me">
                                  <p>{{ auth()->user()->ratingneutral($professional->id) }} </p>
                                </div>
                              </li>

                              <li>
                                <div class="rating-image  ">
                                  <img src="{{ asset('images/rating_down.png')}}">
                                </div>
                                <div class="rating-value r-do">
                                  <p>{{ auth()->user()->ratingnegative($professional->id) }} </p>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </a></div>
                    </li>
                  @endforeach
                   @php
                   
                 }
                    
                  @endphp
                  
                </ul>
              </div>
            </div>
            <div class="eventdtata-cat-list-hrequest">
              <div class="section-title">
                <h1> @lang("event.groups_companies")</h1>
              </div>
              <div class="sub-section-slider-hrequest">
                <ul class="home-host-section-slider">
                  @php
                  if(request("event_company_company_id"))
                  {
                    $companies = \App\Models\AddedCompany::whereIn('id' , request("event_company_company_id"))->get();
                  @endphp
                  @foreach($companies as $company)
                    <li>
                      <div class="home-host-slide">
                        <a href="#"><img src="{{ $company->img }}" class="img">
                          <div class="host-rating-hrequest ">
                            <h2> {{ $company['name_'.$lang] }}</h2>
                            <ul>
                              <li>
                                <div class="rating-image ">
                                  <img src="{{ asset('images/rating_high.png')}}">
                                </div>
                                <div class="rating-value r-hi">
                                  <p>{{ auth()->user()->ratingpositive($company->id) }} </p>
                                </div>
                              </li>

                              <li>
                                <div class="rating-image ">
                                  <img src="{{ asset('images/rating_med.png')}}">
                                </div>
                                <div class="rating-value r-me">
                                  <p>{{ auth()->user()->ratingneutral($company->id) }} </p>
                                </div>
                              </li>

                              <li>
                                <div class="rating-image  ">
                                  <img src="{{ asset('images/rating_down.png')}}">
                                </div>
                                <div class="rating-value r-do">
                                  <p>{{ auth()->user()->ratingnegative($company->id) }} </p>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </a>
                      </div>
                    </li>
                  @endforeach
                  @php 
                  }
                  @endphp
                </ul>
              </div>
            </div>
            <div class="eventdtata-cat-list-hrequest">
              <div class="section-title">
                <h1>@lang("event.sponsors")</h1>
              </div>
              <div class="sub-section-slider-hrequest">
                <ul class="home-host-section-slider">
                  @php
                  if(request("event_sponsor_sponsor_id"))
                  {                  
                    $sponsors = \App\Models\AddedSponsor::whereIn('id' , request("event_sponsor_sponsor_id"))->get();
                  @endphp
                  @foreach($sponsors as $sponsor)
                    <li>
                      <div class="home-host-slide"><a href="#"><img src="{{ $sponsor->img }}" class="img">
                          <div class="host-rating-hrequest ">
                            <h2> {{ $sponsor['name_'.$lang] }}</h2>
                            <ul>
                              <li>
                                <div class="rating-image ">
                                  <img src="{{ asset('images/rating_high.png')}}">
                                </div>
                                <div class="rating-value r-hi">
                                  <p>{{ auth()->user()->ratingpositive($sponsor->id) }} </p>
                                </div>
                              </li>

                              <li>
                                <div class="rating-image ">
                                  <img src="{{ asset('images/rating_med.png')}}">
                                </div>
                                <div class="rating-value r-me">
                                  <p>{{ auth()->user()->ratingneutral($sponsor->id) }} </p>
                                </div>
                              </li>

                              <li>
                                <div class="rating-image  ">
                                  <img src="{{ asset('images/rating_down.png')}}">
                                </div>
                                <div class="rating-value r-do">
                                  <p>{{ auth()->user()->ratingnegative($sponsor->id) }} </p>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </a></div>
                    </li>
                  @endforeach
                  @php
                  }
                  @endphp
                </ul>
              </div>
            </div>
            <div class="listing-title blue-title">
              <h1><span> @lang("event.attendees") </span></h1>
            </div>
            <div class="sub-section-slider-hrequest">
              <ul class="profile-slider-slick">
              </ul>
            </div>
            <div class="listing-title blue-title">
              <h1><span> @lang("event.review") </span></h1>
            </div>

            <div class="review-list">
              <ul>
              </ul>
            </div>

            <div class="rating-comment">

              <div class="rating-chkboxs">
                <ul>
                  <li>

                    <div class="rating-value">

                      <label class="checkbox-container">
                        <img src="{{ asset('images/rating_high.png')}}">
                        <input type="radio" name="rating" value="1" required>
                        <span class="checkmark"></span>
                      </label>
                    </div>

                  </li>
                  <li>

                    <div class="rating-value">

                      <label class="checkbox-container">
                        <img src="{{ asset('images/rating_med.png')}}'">
                        <input type="radio" name="rating" value="2" required>
                        <span class="checkmark"></span>
                      </label>
                    </div>

                  </li>
                  <li>

                    <div class="rating-value">

                      <label class="checkbox-container">
                        <img src="{{ asset('images/rating_down.png')}}">
                        <input type="radio" name="rating" value="3" required>
                        <span class="checkmark"></span>
                      </label>
                    </div>

                  </li>
                </ul>
              </div>

              <div class="cmnt-box">
                <label> @lang("event.enter_your_comment") </label>
                <textarea name="comment" required>  </textarea>
              </div>

              <div class="full-width">
                <button type="button" class="normal-btn blue-button big-button next-step"> @lang("event.submit")</button>
              </div>
            </div>

            <div class="review-share">
              <h4> @lang("event.share_with_friends")</h4>
              <div class="contact-socialmedia">
                <ul>
                  <li><a href="#"> <img src="{{ asset('images/fb_contact.jpg')}}"> </a></li>
                  <li><a href="#"> <img src="{{ asset('images/tw_contact.jpg')}}"> </a></li>
                  <li><a href="#"> <img src="{{ asset('images/ins_contact.jpg')}}"> </a></li>
                  <li><a href="#"> <img src="{{ asset('images/in_contact.jpg')}}"> </a></li>
                </ul>
              </div>
            </div>

          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  event-details-right">

            <div class="related-events">
              <h1> @lang("event.more_from_this_host")</h1>
              <ul class="relative-events-slider">
                @foreach($host_events as $host_event)
                  <li>
                    <div class="home-sub-slide">
                      @foreach($host_event->media as $media)

                        <img class="img" src="{{ asset($media->link) }}">
                        @break
                      @endforeach
                      <div class="homesubslide-details-hrequest">
                        <div class="add-button">
                          <a href="{{ route('event_details' ,['event_id'=> $host_event->id]) }}" tabindex="0">
                            <img src="{{ asset('images/add_button.png')}}">
                          </a>
                        </div>
                        <div class="sponsor-logo-new">
                          <img src="{{ $host_event->host->user->avatar }}" class="img">
                        </div>

                        <div class="detail-points">
                          <h1> {{ $host_event['title_'.$lang] }} </h1>
                          <p> {{ $host_event->category['name_'.$lang] }} </p>
                          <span> - </span>
                          <p> {{ $host_event->maintype['name_'.$lang] }} </p>
                          <ul>
                            <li><span> <img src="{{ asset('images/event_date_blue.png')}}"> </span>
                              <p> {{  \Carbon\Carbon::parse($host_event->date_from)->format('d-M-y')  }} </p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_time_blue.png')}}"> </span>
                              <p>{{ date('H:i', strtotime( $host_event->time_from)).'-'.date('H:i', strtotime( $host_event->time_to)) }} </p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_duration_blue.png')}}"> </span>
								<?php
								$datework = strtotime( $host_event->date_to );
								$dateworkto = strtotime( $host_event->date_from );

								$testdate = ( $datework - $dateworkto ) / 86400;
                                                                if($testdate == 0)
                                                                {
                                                                    $testdate = 1;
                                                                }
								?>
                              <p> {{  $testdate }} @lang("event.days")</p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_people_blue.png')}}"> </span>
                              <p> 504/600</p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_mf_blue.png')}}'"> </span>
                              <p> @if($host_event->gender == 1) @lang("event.male") @elseif($host_event->gender == 2) @lang("event.female") @else
                                  @lang("event.both") @endif </p>
                            </li>
                            @if(!($host_event->age_from=0 && $host_event->age_from=$host_event->age_to))
                            <li><span> <img src="{{ asset('images/event_cat_blue.png')}}"> </span>
                              <p> {{ $host_event->age_from.' - '.$host_event->age_to }} </p>
                            </li>
                            @endif
                            <li><span> <img src="{{ asset('images/event_location_blue.png')}}"> </span>
                              <p> {{ $host_event['location_name_'.$lang] }} </p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>

              <div class="list-all">
                <a href="#"> @lang("event.see_all") </a>
              </div>
            </div>

            <div class="related-events">
              <h1> @lang("event.more_from_this")</h1>
              <ul class="relative-events-slider">

                @foreach($similar_events as $host_event)
                  <li>
                    <div class="home-sub-slide">
                      @foreach($host_event->media as $media)

                        <img class="img" src="{{ asset($media->link) }}">
                        @break
                      @endforeach
                      <div class="homesubslide-details-hrequest">
                        <div class="add-button">
                          <a href="{{ route('event_details' ,['event_id'=> $host_event->id]) }}" tabindex="0">
                            <img src="{{ asset('images/add_button.png')}}">
                          </a>
                        </div>
                        <div class="sponsor-logo-new">
                          <img src="{{ $host_event->host->user->avatar }}" class="img">
                        </div>

                        <div class="detail-points">
                          <h1> {{ $host_event['title_'.$lang] }} </h1>
                          <p> {{ $host_event->category['name_'.$lang] }} </p>
                          <span> - </span>
                          <p> {{ $host_event->maintype['name_'.$lang] }} </p>
                          <ul>
                            <li><span> <img src="{{ asset('images/event_date_blue.png')}}"> </span>
                              <p> {{  \Carbon\Carbon::parse($host_event->date_from)->format('d-M-y') .' : '. \Carbon\Carbon::parse($host_event->date_to)->format('d-M-y')  }} </p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_time_blue.png')}}"> </span>
                              <p> {{ date('H:i', strtotime( $host_event->time_from)).'-'.date('H:i', strtotime( $host_event->time_to)) }} </p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_duration_blue.png')}}"> </span>
								<?php
								$datework = strtotime( $host_event->date_to );
								$dateworkto = strtotime( $host_event->date_from );

								$testdate = ( $datework - $dateworkto ) / 86400;
                                                                if($testdate == 0)
                                                                {
                                                                    $testdate = 1;
                                                                }
								?>
                              <p> {{  $testdate }} @lang("event.days")</p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_people_blue.png')}}"> </span>
                              <p> 504/600</p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_mf_blue.png')}}"> </span>
                              <p> @if($host_event->gender == 1) @lang("event.male") @elseif($host_event->gender == 2) @lang("event.female") @else
                                  @lang("event.both") @endif </p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_cat_blue.png')}}'"> </span>
                              <p> {{ $host_event->age_from.' - '.$host_event->age_to }} </p>
                            </li>
                            <li><span> <img src="{{ asset('images/event_location_blue.png')}}"> </span>
                              <p> {{ $host_event['location_name_'.$lang] }} </p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach

              </ul>
              <div class="list-all">
                <a href="#"> @lang("event.see_all") </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
