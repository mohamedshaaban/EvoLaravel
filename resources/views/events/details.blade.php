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
            <div class="profile-hold right-blue-pattern">
                <div class="eventdetails-top-part">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 details-slider-image">

                            <div class="details-image-hold">
                                <ul class="banner-slider">

                                    @foreach($event->media as $media)
                                        @if($media->type==1)
                                    <li> <div class="detail-image-contain"><img  class="img" src="{{ asset($media->link) }}"> </div></li>
                                    @else     
                                    <li> <div class="detail-image-contain">
                                          <iframe width="100%"  src="{{ asset($media->link) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                          
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 eventdetails-info">
                            <div class="detailspage-info-hold">
                                <div class="profile-info-hold">

                                    <div class="profile-image"><a href="{{ route('host_profile',['host_name'=> $event->host->user->name ]) }}"><img src="{{ $event->host->user->avatar }}"  class="img"></a></div>
                                    <div class="profile-details">

                                        <h1> {{ $event['title_'.$lang] }} </h1>
                                        <div class="eventdetail-cat-type"> <a href="#"> {{ $event->category['name_'.$lang] }}</a> <span> - </span> <a href="#"> {{ $event->maintype['name_'.$lang] }}</a> </div>

                                        <div class="eventdetail-sponsor"> <a href="{{ route('host_profile',['host_name'=> $event->host->user->name ]) }}">{{ $event->host->company_name }}</a> </div>

                                            <div class="host-rating-hold" data-toggle="modal" data-target="#rate_comment">
                                            <ul>
                                                <li>
                                                    <div class="rating-image "> <img src="{{ asset('images/rating_high.png')}}"> </div>
                                                    <div class="rating-value r-hi">
                                                        <p>{{ $event->ratingpositive($event->id) }} </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="rating-image "> <img src="{{ asset('images/rating_med.png')}}"> </div>
                                                    <div class="rating-value r-me">
                                                        <p>{{ $event->ratingneutral($event->id) }}  </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="rating-image  "> <img src="{{ asset('images/rating_down.png')}}"> </div>
                                                    <div class="rating-value r-do">
                                                        <p>{{ $event->ratingnegative($event->id) }} </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="share-flag"> <a class="a2a_dd" id="a2a_dd" href="https://www.addtoany.com/share"> <img src="{{ asset('images/share.jpg')}}"> </a>
                                            <a data-toggle="modal" data-target="#report_event" href="#"> <img src="{{ asset('images/flag2.jpg')}}"> </a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                    </div>
                                </div>
                                <div class="homesubslide-details-hold  detailspage-info-part">
                                    <div class="detail-points">
                                        <ul>
                                            <li> <span> <img src="{{ asset('images/event_date_blue.png')}}"> </span>

                                                    <p>{{  \Carbon\Carbon::parse($event->date_from)->format('d-M-y')  }}</p>

                                            </li>
                                            <li> <span> <img src="{{ asset('images/event_time_blue.png')}}"> </span>
                                                <p>{{  date('H:i', strtotime( $event->time_from)).'-'.date('H:i', strtotime( $event->time_to))}} </p>
                                            </li>
                                            <li> <span> <img src="{{ asset('images/event_duration_blue.png')}}"> </span>
                                                <?php
                                                $datework = strtotime($event->date_to );
                                                $dateworkto = strtotime($event->date_from );

                                                $testdate =($datework - $dateworkto) / 86400;
                                                if($testdate == 0)
                                                        {
                                                            $testdate = 1;
                                                        }
                                                ?>
                                                <p> {{  $testdate }} {{__('website.Days')}}</p>

                                            </li>
                                            <li> <span> <img src="{{ asset('images/event_people_blue.png')}}"> </span>
                                                <p> {{ $event->event_attendes_num($event->id) }}/ {{ $event->capacity }}</p>
                                            </li>
                                            <li> <span> <img src="{{ asset('images/event_mf_blue.png')}}"> </span>
                                                <p> @if($event->gender == 1) {{__('website.Male')}} @elseif($event->gender == 2) {{__('website.Female')}} @else {{__('website.Both')}} @endif </p>
                                            </li>
                                            @if($event->age_from!=0 )
                                            <li> <span> <img src="{{ asset('images/event_cat_blue.png')}}"> </span>
                                                <p> {{ $event->age_from.' - '.$event->age_to }} </p>
                                            </li>
                                            @endif
                                            <li> <span> <img src="{{ asset('images/event_location_blue.png')}}"> </span>
                                                <p> {{ $event['location_name_'.$lang] }} </p>
                                            </li>
                                            
                                            <li> <span> <img src="{{ asset('images/cost_blue.png')}}"> </span>
                                                
                                                <p> @if($event->multiplePrice()->count()==0)  {{__('website.Unpaid')}} @else {{ $event->multiplePrice()->orderBy('cost')->first(['cost'])->cost }}  @endif</p>
                                            </li>
                                        </ul>
                                         @if($event->multiplePrice()->count()==0 && Auth::User() && Auth::User()->role_id != App\User::GROUP_USER_TYPE_ID && Auth::User()->role_id != App\User::COMPANY_USER_TYPE_ID)
                                         <form action="{{ route('event.booking',['id'=>$event->id]) }}">
                                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  event-pricing">
                                                        <div class="book-btn"> <span>
                                            <button class="normal-btn blue-button  booking-btn-style"> + {{__('website.Rizit')}} </button>
                                            </span> </div>
                                                    </div>
                                                    </form>
                                         @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($event->multiplePrice()->count()>0 && Auth::User() && Auth::User()->role_id != App\User::GROUP_USER_TYPE_ID && Auth::User()->role_id != App\User::COMPANY_USER_TYPE_ID  )
            <div class="profile-hold">
                <div class="price-book-event form-hold">
                    <div class="row">

                        <form action="{{ route('event.booking',['id'=>$event->id]) }}">


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  event-pricing">

                            <div class="ticket-head">
                                {{__('website.Ticket Price')}}
                            </div>

                            <div class="review-hold ticketprice-acc">
                                <ul id="review" class="accordion">
                                    @foreach($event->multiplePrice()->orderBy('cost')->get() as $price)
                                        <li>
                                            <h3 class="ticket-title"> {{ $price->name() }} {{__('website.Ticket')}}</h3>
                                            <ul class="panel loading category-filter ">
                                                <div class="event-pricing-items">
                                                    <ul>
                                                        <li>
                                                            <div class="value-hold">
                                                                <strong> {{ $price->name() }} </strong> <span> {{ $price->cost }} {{ $selected_currency->symbol }} </span>
                                                            </div>
                                                            <ul>
                                                                <div class="ticket-subtitle">
                                                                    {{__('website.Group')}} {{ $price->name() }} {{__('website.Tickets')}}
                                                                </div>
                                                                @foreach($price->groupPrice()->orderBy('ticket_no')->get() as $group)
                                                                    <li>
                                                                        <div class="value-hold">
                                                                            <strong> {{ $price->name() }} {{ $group->ticket_no }} {{__('website.Tickets')}} </strong> <span> {{ $group->price }}
                                                                                    {{ $selected_currency->symbol }} </span>
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
                            <div class="book-btn"> <span>
                <button class="normal-btn blue-button  booking-btn-style"> + {{__('website.Rizit')}} </button>
                </span> </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <div class="event-details-contentpart">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12  event-details-left">
                    <p>
                       {!! $event['description_'.$lang] !!}

                     </p>
                     <p>
                      {{ $event->city->name_en }} {{ $event->address_block }} {{ $event->address_street  }} {{ $event->address_building  }}{{ $event->address_floor }}{!! $event->address_text !!}

                     </p>
                        <div class="event-map">

                            <iframe src = "https://maps.google.com/maps?q={{ $event->address_lat  }},{{ $event->address_long }}&hl=es;z=14&amp;output=embed" width="100%" height="100%" frameborder="0" style="border:0; min-height:252px;" allowfullscreen></iframe>
                        </div>
                        <div class="listing-title blue-title">

                        </div>
                        <div class="eventdtata-cat-list-hold">
                            <div class="section-title">
                                <h1> {{__('website.Professionals')}} </h1>
                            </div>
                            <div class="sub-section-slider-hold">
                                <ul class="home-host-section-slider">

                                    @foreach($event->professional as $professional)

                                    <li>
                                        <div class="home-host-slide"> <a href="{{ route('host_profile',['host_name'=>$professional->name]) }}">
												<div class="logo-image-contain">
                                                <img src="{{ asset($professional->avatar) }}"  class="img">
                                                </div>

                                                <div class="host-rating-hold ">

                                                    <h2> {{ $professional['name'] }}</h2>
                                                    <ul>
                                                        <li>
                                                            <div class="rating-image ">
                                                                <img src="{{ asset('images/rating_high.png')}}">
                                                            </div>
                                                            <div class="rating-value r-hi">
                                                                <p>{{ $professional->ratingpositive($professional->id) }} </p>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-image ">
                                                                <img src="{{ asset('images/rating_med.png')}}">
                                                            </div>
                                                            <div class="rating-value r-me">
                                                                <p>{{ $professional->ratingneutral($professional->id) }} </p>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-image  ">
                                                                <img src="{{ asset('images/rating_down.png')}}">
                                                            </div>
                                                            <div class="rating-value r-do">
                                                                <p>{{ $professional->ratingnegative($professional->id) }} </p>
                                                            </div>
                                                        </li>
                                                    </ul>



                                                </div>
                                            </a> </div>
                                    </li>
                                        @endforeach

<?php $added = $event->addedprofessional($event->id);

?>

                                        @foreach($added as $professional)

                                            <li>
                                                <div class="home-host-slide"> <a href="#">
	 <div class="logo-image-contain">
                                                        <img src="/{{ $professional->img }}"  onerror="this.onerror=null;this.src='/images/Rizit_logo.png';" class="img">
                                                        </div>

                                                        <div class="host-rating-hold ">

                                                            <h2> {{ $professional['name_'.$lang] }}</h2>
                                                            



                                                        </div>
                                                    </a> </div>
                                            </li>
                                        @endforeach


                                </ul>

                            </div>
                        </div>

                        @if($event->company->count()>0 || $event->addedcompany($event->id)->count()>0)
                        <div class="eventdtata-cat-list-hold">
                            <div class="section-title">
                                <h1> {{__('website.Groups and Companies')}}</h1>
                            </div>
                            <div class="sub-section-slider-hold">
                                <ul class="home-host-section-slider">
                                    @foreach($event->company as $company)
                                    <li>
                                        <div class="home-host-slide"> <a href="{{ route('host_profile',['host_name'=>$company->name]) }}">
                                        <div class="logo-image-contain">
                                        <img src="{{ $company->avatar }}" class="img">
                                        </div>
                                                <div class="host-rating-hold ">
                                                    <h2> {{ $company['name'] }}</h2>
                                                    <ul>
                                                        <li>
                                                            <div class="rating-image ">
                                                                <img src="{{ asset('images/rating_high.png')}}">
                                                            </div>
                                                            <div class="rating-value r-hi">
                                                                <p>{{ $company->ratingpositive($company->id) }} </p>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-image ">
                                                                <img src="{{ asset('images/rating_med.png')}}">
                                                            </div>
                                                            <div class="rating-value r-me">
                                                                <p>{{ $company->ratingneutral($company->id) }} </p>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="rating-image  ">
                                                                <img src="{{ asset('images/rating_down.png')}}">
                                                            </div>
                                                            <div class="rating-value r-do">
                                                                <p>{{ $company->ratingnegative($company->id) }} </p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </a> </div>
                                    </li>
                                    @endforeach

<?php
                                        $added = $event->addedcompany($event->id);
                                        ?>
                                        @foreach($added as $company)
                                        
                                            <li>
                                                <div class="home-host-slide"> <a href="#"><img src="/{{ $company->img }}" class="img">
                                                        <div class="host-rating-hold ">
                                                            <h2> {{ $company['name_'.$lang] }}</h2>
                                                            
                                                        </div>
                                                    </a> </div>
                                            </li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if($event->sponsor->count()>0||$event->addedsponsor($event->id)->count()>0)
                        <div class="eventdtata-cat-list-hold">
                            <div class="section-title">
                                <h1>{{__('website.Sponsors')}}</h1>
                            </div>
                            <div class="sub-section-slider-hold">
                                <ul class="home-host-section-slider">
                                    @foreach($event->sponsor as $sponsor)
                                    
                                        <li>
                                            <div class="home-host-slide"> <a href="{{ route('host_profile',['host_name'=>$sponsor->name]) }}">
                                                    <div class="logo-image-contain">
                                                      <img src="{{ $sponsor->avatar }}" onerror="this.onerror=null;this.src='/images/Rizit_logo.png';" class="img">
                                                    </div>
                                                    <div class="host-rating-hold ">
                                                        <h2> {{ $sponsor['name'] }}</h2>
                                                        <ul>
                                                            <li>
                                                                <div class="rating-image ">
                                                                    <img src="{{ asset('images/rating_high.png')}}">
                                                                </div>
                                                                <div class="rating-value r-hi">
                                                                    <p>{{ $sponsor->ratingpositive($sponsor->id) }} </p>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="rating-image ">
                                                                    <img src="{{ asset('images/rating_med.png')}}">
                                                                </div>
                                                                <div class="rating-value r-me">
                                                                    <p>{{ $sponsor->ratingneutral($sponsor->id) }} </p>
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="rating-image  ">
                                                                    <img src="{{ asset('images/rating_down.png')}}">
                                                                </div>
                                                                <div class="rating-value r-do">
                                                                    <p>{{ $sponsor->ratingnegative($sponsor->id) }} </p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                        </li>
                                    @endforeach
<?php $added = $event->addedsponsor($event->id); ?>

                                        @foreach($added as $sponsor)
                                            <li>
                                                <div class="home-host-slide"> <a href="#"><img src="/{{ $sponsor->img }}" onerror="this.onerror=null;this.src='/images/Rizit_logo.png';" class="img">
                                                        <div class="host-rating-hold ">
                                                            <h2> {{ $sponsor['name_'.$lang] }}</h2>
                                                            
                                                        </div>
                                                    </a> </div>
                                            </li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if($event->attendes->count()>0)
                        <div class="listing-title blue-title">
                            <h1> <span> {{__('website.Attendees')}} </span> </h1>
                        </div>
                        <div class="sub-section-slider-hold">
                            <ul class="profile-slider-slick">

                                @foreach($event->attendes as $attend)
                                
                                    <li>
                                        <div class="profile-list">

                                            <a href="{{ route('user_profile',[$attend->id]) }}">
                                                <div class="pro-image"> <img src="{{ $attend->avatar }}" onerror="this.onerror=null;this.src='/images/Rizit_logo.png';" class="img"> </div>
                                                <h2> {{ $attend->name }} </h2>
                                            </a>

                                        </div>
                                    </li>
                                    @endforeach


                            </ul>
                        </div>
                        @endif
                        <div class="listing-title blue-title">
                            <h1> <span> {{__('website.Reviews')}} </span> </h1>
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="width: 100%;">{{ Session::get('message') }}</p>
                            @elseif(Session::has('alert'))
                                <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}" style="width: 100%;">{{ Session::get('alert') }}</p>
                            @endif
                        </div>

                        <div class="review-list">

                            <ul>
                                @foreach($event->EventReviews as $review)
                                <li>
                                    <div class="profile-review">
                                        <a href="{{ route('user_profile',[$review->user->id]) }}">
                                            <img src="{{ $review->user->avatar }}" onerror="this.onerror=null;this.src='/images/Rizit_logo.png';" class="img">
                                            <span>

            {{ $review->user->name }}

            </span>
                                        </a>
                                    </div>

                                    <div class="review-rating-icon">
                                        <div class="rating-image ">
                                            @if($review->rating ==1 )
                                                <img src="{{ asset('images/rating_high.png')}}">
                                                @elseif($review->rating ==2)
                                                <img src="{{ asset('images/rating_med.png')}}">
                                                @elseif ($review->rating ==3)
                                                <img src="{{ asset('images/rating_down.png')}}">
                                                @endif

                                        </div>
                                    </div>

                                    <p>{{ $review->comment }}</p>
                                </li>
                                    @endforeach
                            </ul>
                        </div>
                      
                        @if(Auth::User() && Auth::user()->id != $event->host->user->id && !App\Models\EventReviews::where( 'user_id', Auth::user()->id )->where( 'event_id', $event->id )->first()  )
                        <form action="{{ route('review_event') }}" method="post">
                            <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            {{ csrf_field() }}
                        <div class="rating-comment">

                            <div class="rating-chkboxs">
                                <ul>
                                    <li>

                                        <div class="rating-value">

                                            <label class="checkbox-container">
                                                <img src="{{ asset('images/rating_high.png')}}">
                                                <input type="radio"  name="rating" value="1" required>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                    </li>
                                    <li>

                                        <div class="rating-value">

                                            <label class="checkbox-container">
                                                <img src="{{ asset('images/rating_med.png')}}">
                                                <input type="radio"  name="rating" value="2" required>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                    </li>
                                    <li>

                                        <div class="rating-value">

                                            <label class="checkbox-container">
                                                <img src="{{ asset('images/rating_down.png')}}">
                                                <input type="radio"  name="rating" value="3" required >
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                    </li>
                                </ul>
                            </div>

                            <div class="cmnt-box">
                                <label> {{__('website.Enter your Comment')}} </label>
                                <textarea name="comment" required>  </textarea>
                            </div>

                            <div  class="full-width">
                                <button type="submit" class="normal-btn blue-button big-button next-step"> {{__('website.Submit')}} </button>
                            </div>



                        </div>
                        </form>
                        @endif
                        <div class="review-share">
                            <h4> {{__('website.Share with friends')}}</h4>
                            <div class="contact-socialmedia">
                                <ul onclick="$('#a2a_dd').click()">
                                    <div class="sharethis-inline-share-buttons"></div>
                                </ul>
                            </div>
                        </div>
                        <script src="//platform-api.sharethis.com/js/sharethis.js#property=5bbf3ed8ddd604001160446f&product=inline-share-buttons"></script>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  event-details-right">

                        <div class="related-events">
                            <h1> {{__('website.More from this host')}}</h1>
                            <ul class="relative-events-slider">
                                @foreach($host_events as $host_event)
                                <li>
                                    <div class="home-sub-slide">
                                        @if(!$host_event->media|| sizeof($host_event->media)<1)
                                            <div class="small-image-contain">

                                                <img src="/uploads/Rizit_logo.png" class="img">

                                            </div>
                                        @else
                                        @foreach($host_event->media as $media)
                                            <div class="small-image-contain">
                                            <a href="{{ route('event_details' ,['event_id'=> $host_event->id]) }}">
                                            <img  class="img" onerror="this.onerror=null;this.src='/images/Rizit_logo.png';" src="{{ asset($media->link) }}">
                                             </a>
                                            </div>
                                            @break
                                        @endforeach
                                        @endif
                                        <div class="homesubslide-details-hold">
                                            <div class="add-button">
                                                <a href="{{ route('event_details' ,['event_id'=> $host_event->id]) }}" tabindex="0">
                                                    <img src="{{ asset('images/add_button.png')}}">
                                                </a>
                                            </div>
                                            <div class="sponsor-logo-new">
                                                <a href="{{ route('host_profile',['host_name'=> $host_event->host->user->name ]) }}"> <img src="{{ (isset($host_event->host))?$host_event->host->user->avatar:'' }}" onerror="this.onerror=null;this.src='/images/Rizit_logo.png';" class="img">
                                                </a>
                                            </div>

                                            <div class="detail-points">
                                                <h1> <a href="{{ route('event_details' ,['event_id'=> $host_event->id]) }}">{{ $host_event['title_'.$lang] }} </a></h1>
                                                <div class="eventdetail-cat-type"> <a href="{{ route('eventscategory',['category_id'=>$host_event->category_id]) }}"> {{ $host_event->category['name_'.$lang] }}</a> <span> - </span> <a href="#"> {{ $host_event->maintype['name_'.$lang] }}</a> </div>

                                                <div class="eventdetail-sponsor"> <a href="{{ route('host_events',['host_id'=> $host_event->host->id ]) }}">{{ $host_event->host->company_name }}</a> </div>
                                                <ul>
                                                    <li> <span> <img src="{{ asset('images/event_date_blue.png')}}"> </span>
                                                        <p>{{  \Carbon\Carbon::parse($host_event->date_from)->format('d-M-y')  }} </p>
                                                    </li>
                                                    <li> <span> <img src="{{ asset('images/event_time_blue.png')}}"> </span>
                                                        <p>{{ date('H:i', strtotime( $host_event->time_from)).'-'.date('H:i', strtotime($host_event->time_to)) }} </p>
                                                    </li>
                                                    <li> <span> <img src="{{ asset('images/event_duration_blue.png')}}"> </span>
                                                        <?php
                                                        $datework = strtotime($host_event->date_to );
                                                        $dateworkto = strtotime($host_event->date_from );

                                                        $testdate =($datework - $dateworkto) / 86400;
                                                        if($testdate == 0)
                                                        {
                                                            $testdate = 1;
                                                        }
                                                        ?>
                                                        <p> {{  $testdate }} Days</p>
                                                    </li>
                                                    <li> <span> <img src="{{ asset('images/event_people_blue.png')}}"> </span>
                                                        <p> {{ $host_event->event_attendes_num($host_event->id) }}/ {{ $host_event->capacity }}</p>
                                                    </li>
                                                    <li> <span> <img src="{{ asset('images/event_mf_blue.png')}}'"> </span>
                                                        <p> @if($host_event->gender == 1) {{__('website.Male')}} @elseif($host_event->gender == 2) {{__('website.Female')}} @else {{__('website.Both')}} @endif </p>
                                                    </li>
                                                    <li> <span> <img src="{{ asset('images/event_cat_blue.png')}}"> </span>
                                                        <p> {{ $host_event->age_from.' - '.$host_event->age_to }} </p>
                                                    </li>
                                                    <li> <span> <img src="{{ asset('images/event_location_blue.png')}}"> </span>
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
                                <a href="{{ route('host_events',['host_id'=>$event->host_id]) }}"> {{__('website.See all')}}  </a>
                            </div>
                        </div>

                        <div class="related-events">
                            <h1> {{__('website.More Like this')}}</h1>
                            <ul class="relative-events-slider">

                                @foreach($similar_events as $host_event)
                                    <li>
                                        <div class="home-sub-slide">
                                            @if(!$host_event->media|| sizeof($host_event->media)<1)
                                                <div class="small-image-contain">
                                                    <img src="/uploads/Rizit_logo.png" class="img">
                                                </div>
                                            @else
                                            @foreach($host_event->media as $media)
                                                <div class="small-image-contain">
												<a href="#">
                                                <img class="img" src="{{ asset($media->link) }}">
                                                </a>
                                                </div>
                                                @break
                                            @endforeach
                                            @endif
                                            <div class="homesubslide-details-hold">
                                                <div class="add-button">
                                                    <a href="{{ route('event_details' ,['event_id'=> $host_event->id]) }}" tabindex="0">
                                                        <img src="{{ asset('images/add_button.png')}}">
                                                    </a>
                                                </div>
                                                <div class="sponsor-logo-new">
                                                <a href="{{ route('host_profile',['host_name'=> $host_event->host->user->name ]) }}">
                                                    <img src="{{ (isset($host_event->host))?$host_event->host->user->avatar:'' }}" class="img">
                                                    </a>
                                                </div>

                                                <div class="detail-points">
                                                    <h1> <a href="#"> {{ $host_event['title_'.$lang] }} </a></h1>
                                                    <p> <a href="#"> {{ $host_event->category['name_'.$lang] }} </a></p>
                                                    <span> - </span>
                                                    <p> <a href="#">  {{ $host_event->maintype['name_'.$lang] }} </a> </p>
                                                    <ul>
                                                        <li> <span> <img src="{{ asset('images/event_date_blue.png')}}"> </span>
                                                            <p> {{  \Carbon\Carbon::parse($host_event->date_from)->format('d-M-y')  }} </p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_time_blue.png')}}"> </span>
                                                            <p>{{ date('H:i', strtotime( $host_event->time_from)).'-'.date('H:i', strtotime( $host_event->time_to)) }} </p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_duration_blue.png')}}"> </span>
                                                            <?php
                                                            $datework = strtotime($host_event->date_to );
                                                            $dateworkto = strtotime($host_event->date_from );

                                                            $testdate =($datework - $dateworkto) / 86400;
                                                            if($testdate == 0)
                                                                {
                                                                    $testdate = 1;
                                                                }
                                                            ?>
                                                            <p> {{  $testdate }} {{__('website.Days')}}</p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_people_blue.png')}}"> </span>
                                                            <p> {{ $host_event->event_attendes_num($host_event->id) }}/ {{ $host_event->capacity }}</p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_mf_blue.png')}}"> </span>
                                                            <p> @if($host_event->gender == 1) Male @elseif($host_event->gender == 2) Female @else Both @endif </p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_cat_blue.png')}}"> </span>
                                                            <p> {{ $host_event->age_from.' - '.$host_event->age_to }} </p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_location_blue.png')}}"> </span>
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
                                <a href="{{ route('type_events',['type_id'=>$event->main_type_id]) }}"> {{__('website.See all')}}  </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="rate_comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{__('website.Rate and Comment')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @if(Auth::User())
                    <form action="{{ route('review_event') }}" method="post">
                <div class="modal-body full-width">

                            <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            {{ csrf_field() }}
                            <div class="rating-comment">

                                <div class="rating-chkboxs">
                                    <ul>
                                        <li>

                                            <div class="rating-value">

                                                <label class="checkbox-container">
                                                    <img src="{{ asset('images/rating_high.png')}}">
                                                    <input type="radio"  name="rating" value="1" required>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>

                                            <div class="rating-value">

                                                <label class="checkbox-container">
                                                    <img src="{{ asset('images/rating_med.png')}}">
                                                    <input type="radio"  name="rating" value="2" required>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                        </li>
                                        <li>

                                            <div class="rating-value">

                                                <label class="checkbox-container">
                                                    <img src="{{ asset('images/rating_down.png')}}">
                                                    <input type="radio"  name="rating" value="3" required >
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                        </li>
                                    </ul>
                                </div>

                                <div class="cmnt-box">
                                    <label> {{__('website.Enter your Comment')}} </label>
                                    <textarea name="comment" required>  </textarea>
                                </div>




</div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="normal-btn grey-button big-button " data-dismiss="modal">{{__('website.Close')}}</button>
                    <button type="submit" class="normal-btn blue-button big-button ">{{__('website.Submit')}} </button>
                </div>

                </form>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="report_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{__('website.Report an Event')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @if(Auth::User())
                    <form action="{{ route('report_event') }}" method="post">
                        <div class="modal-body full-width">

                            <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            {{ csrf_field() }}
                            <div class="rating-comment">



                                <div class="cmnt-box">
                                    <label> {{__('website.Enter your Report')}} </label>
                                    <textarea name="comment" required>  </textarea>
                                </div>




                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="normal-btn grey-button big-button " data-dismiss="modal">{{__('website.Close')}}</button>
                            <button type="submit" class="normal-btn blue-button big-button ">{{__('website.Submit')}}'</button>
                        </div>

                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
