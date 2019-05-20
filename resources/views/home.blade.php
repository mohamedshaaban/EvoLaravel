  @extends('layouts.app')
@section('content')

  <!-- banner section starts -->
  <div class="full-width">

    <section class="container bannerpart-hold">

      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 sponsors-section ">

          <div class="sponsor-slider-hold">
            <div class="section-title">
              <h1> {{__('website.Sponsored')}} </h1>
            </div>
            <ul class="banner-slider">

              @foreach($event_sliders as $slider)

                @if($slider->media)
                  @if($slider->host)
                    {{ $img = $slider->host->user->avatar }}
                  @else
                    {{ $img = 'uploads/users/default.png' }}
                  @endif

                  <li>
                    <div class="event-slide">
                      @if(!$slider->media|| sizeof($slider->media)<1)
                        <div class="image-contain">

                          <img src="/uploads/Rizit_logo.png" class="img">

                        </div>
                      @else
                      @foreach($slider->media as $media)
						<div class="image-contain">
                         <a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}">
                        <img src="{{ asset($media->link) }}" class="img">
                        </a>

                        </div>
                        @break
                      @endforeach
                      @endif
                      <div class="eventslide-details-hold ">
                        <div class="add-button"><a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}"><img
                                src="images/add_button.png"> </a></div>
                        <div class="sponsor-logo-new"> <a href="{{ route('host_profile',['host_name'=> $slider->host->user->name ]) }}"> <img src="{{ $img }}" class="img">  </a> </div>
                        <div class="detail-points">
                          <h1> <a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}">{{ $slider['title_'.$lang] }} </a> </h1>
                          <p> <a href="#"> {{ $slider->category['name_'.$lang] }}  </a></p>
                          <span> - </span>
                          <p> <a href="#">  {{ $slider->maintype['name_'.$lang] }} </a>  </p>
                          <ul>
                            <li><span> <img src="images/event_date.png"> </span>
                              <p> {{ \Carbon\Carbon::parse($slider->date_from)->format('d-M-y') }} </p>
                            </li>
                            <li><span> <img src="images/event_time.png"> </span>
                              <p>{{ date('H:i', strtotime( $slider->time_from)).'-'.date('H:i', strtotime( $slider->time_to)) }} </p>
                            </li>
                            <li><span> <img src="images/event_duration.png"> </span>
								<?php
								$datework = strtotime( $slider->date_to );
								$dateworkto = strtotime( $slider->date_from );

								$testdate = ( $datework - $dateworkto ) / 86400;
                                                                if($testdate == 0)
                                                                {
                                                                    $testdate = 1;
                                                                }
								?>
                              <p> {{  $testdate }} {{__('website.Days')}}</p>
                            </li>
                            <li><span> <img src="images/event_people.png"> </span>
                              <p> {{ $slider->event_attendes_num($slider->id) }}/ {{ $slider->capacity }}</p>
                            </li>
                            <li><span> <img src="images/event_mf.png"> </span>
                              <p> @if($slider->gender == 1) {{__('website.Male')}} @elseif($slider->gender == 2) {{__('website.Female')}} @else {{__('website.Both')}} @endif </p>
                            </li>
                            <li><span> <img src="images/event_cat.png"> </span>
                              <p> {{ $slider->age_from.' - '.$slider->age_to }} </p>
                            </li>
                            <?php
                              $cost = __('website.Unpaid');

                              if($slider->multiplePrice()->orderBy('cost')->first(['cost']))
                              {
                                  $cost = $slider->multiplePrice()->orderBy('cost')->first(['cost'])->cost;
                              }
                              ?>

                              <li><span> <img src="images/cost.png"> </span>
                                <p> {{ $cost }} </p>
                              </li>

                            <li><span> <img src="images/event_location.png"> </span>
                              <p> {{ $slider['location_name_'.$lang] }} </p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
        <form action="{{ route('search_filter') }}" method="post">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 calendar-section">
          <div class="listing-title blue-title home-listing-title">
            <h1><span> {{__('website.Looking for other events?')}} </span></h1>
          </div>

          <div class="cal-section-container">
            <div class="calendar-hold cal-style">
              <div class="datepicker-display1 expo-cal"></div>

            </div>
          </div>









          <div class="tab-hold">
            <div class="full-width tab_cov">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 search-left">
                <div class="event-serach-drop main-search-drop">
                  <div class="list-title">
                    <p> {{__('website.Events')}} </p>
                  </div>
                    <input type="hidden" name="date" class="FromToDate">
                  <select name="type[]" class="js-select2 " multiple="multiple" >
                    <option value="">{{__('website.Select Event Type')}}</option>
                    @foreach($types->where('event_type',1)  as $type)
                      <option value="{{ $type->id }}">{{ $type['name_'.$lang] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="activity-serach-drop main-search-drop">
                  <div class="list-title">
                    <p> {{__('website.Activities')}} </p>
                  </div>
                  <select name="type[]" class="js-select2 " multiple="multiple" >
                    <option value="">{{__('website.Select Event Type')}}</option>
                    @foreach($types->where('event_type',2)  as $type)
                      <option value="{{ $type->id }}">{{ $type['name_'.$lang] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="services-serach-drop main-search-drop">
                  <div class="list-title">
                    <p> {{__('website.Services')}} </p>
                  </div>
                  <select name="type[]" class="js-select2 " multiple="multiple" >
                    <option value="">{{__('website.Select Event Type')}}</option>
                    @foreach($types->where('event_type',3) as $type)
                      <option value="{{ $type->id }}">{{ $type['name_'.$lang] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 search-right">
                <div role="tabpanel" class="tab-pane" id="service">
                  <div class="ta-con service-tab search-right-hold">
                    <ul>
                      <li>
                        <label> {{__('website.Main Category')}}  </label>
                        <div class="multiselct-list-box-hold">
<!--                          <select  name="category[]" multiple class="js-select2-normal multiselct-list-box" placeholder="Select" >
                              {{--@foreach($categories as $row)--}}
                                      {{--<option value="{{ $row->id }}">{{ $row->name() }}</option>--}}
                              {{--@endforeach--}}
                            </select>-->
                            <select id="categories" name="categories[]" onchange="get_subcategory(this.value)" multiple="multiple" class="js-select2 multiselct-list-box"  placeholder="Select" >
                           @foreach($categories as $row)
                           <option value="{{ $row->id }}" data-badge="">{{ $row->name() }}</option>
                            @endforeach


                          </select>
                        </div>
                      </li>

                      <li>
                        <label> {{__('website.Sub Category')}} </label>
                        <div class="multiselct-list-box-hold">
                            <select id="sub_category1" name="categories[]" class="js-select2 multiselct-list-box" multiple="multiple"  placeholder="Select" >

                          </select>
                        </div>
                      </li>

                      <li class="height-limit-list">
                        <label> {{__('website.Age Group')}} </label>
                         <div class="single-list-box-hold">
                        <select name="age_from" class="js-select2-single">
                          <option value="">{{__('website.From')}}</option>
                          
                            <option value="0-10">0 - 10</option>
                          <option value="0-10">10 - 20</option>
                          <option value="0-10">20 - 30</option>
                          <option value="0-10">30 - 40</option>
                          <option value="0-10">40 - 50</option>
                          <option value="0-10">50 - 60</option>
                          
                        </select>
                        </div>
                      </li>
                      
                      <li>
                        <label>{{__('website.Gender')}}  </label>
                         <div class="single-list-box-hold">
                        <select name="gender" class="js-select2-single">
                          <option value="1">{{__('website.Male')}}</option>
                          <option value="2">{{__('website.Female')}}'</option>
                          <option value="3" selected="selected"> {{__('website.Male and Female')}}</option>
                        </select>
                        </div>
                      </li>
                      <li class="height-limit-list">
                        <label>{{__('website.Location')}} </label>
                         <div class="single-list-box-hold">
                        <select name="location" class="js-select2-single">
                          <option value="">{{__('website.Location')}}</option>
                          @foreach($locations as $location)
                            <option
                                value="{{ $location['location_name_'.$lang] }}">{{ $location['location_name_'.$lang] }}</option>
                          @endforeach
                        </select>
                        </div>
                      </li>
                      <li>
                        <div class="chkbox-container-hold">
                          <label class="checkbox-container">{{__('website.Paid')}}
                              <input type="checkbox"  name="paid[]" value="1" >
                            <span class="checkmark"></span> </label>
                          <label class="checkbox-container">{{__('website.Unpaid')}}
                            <input type="checkbox"  name="paid[]" value="0">
                            <span class="checkmark"></span> </label>
                        </div>
                      </li>
                      <li></li>
                      <li>
                        {{ csrf_field() }}
                        <button class="stndrd-btn blue-btn" type="submit"> Search </button>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>














        </div>
        </form>
      </div>
    </section>
  </div>
  <!-- banner section ends -->

  <!-- banner do in kuwait starts -->
  @if($event_sliders->count()>0)
    <div class="full-width">
      <section class="container home-sub-section doinkuwait-hold">
        <div class="section-title">
          <h1> {{__('website.What to do in Kuwait?')}} </h1>
        </div>

        <div class="sub-section-slider-hold">
          <ul class="home-sub-section-slider">
            @foreach($event_sliders as $slider)

              @if($slider->host)
                {{ $img = $slider->host->user->avatar }}
              @else
                {{ $img = 'uploads/users/default.png' }}
              @endif

              <li>
                <div class="home-sub-slide">

                  @if(!$slider->media|| sizeof($slider->media)<1)
                    <div class="small-image-contain">

                      <img src="/uploads/Rizit_logo.png" class="img">
                      </div>

                  @else
                  @foreach($slider->media as $media)
                  <div class="small-image-contain">
                  <a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}">
                    <img src="{{ asset($media->link) }}" class="img">
                    </a>
                    </div>
                    @break
                  @endforeach
                  @endif
                  <div class="homesubslide-details-hold">
                    <div class="add-button"><a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}"><img
                            src="images/add_button.png"> </a></div>
                    <div class="sponsor-logo-new"> <a href="{{ route('host_profile',['host_name'=> $slider->host->user->name ]) }}"> <img src="{{ $img }}" class="img"> </a></div>
                    <div class="detail-points">
                      <h1> <a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}"> {{ $slider['title_'.$lang] }} </a> </h1>
                      <p> <a href="#">{{ $slider->category['name_'.$lang] }} </a> </p>
                      <span> - </span>
                      <p> <a href="#"> {{ $slider->maintype['name_'.$lang] }}  </a> </p>
                      <ul>
                        <li><span> <img src="images/event_date_blue.png"> </span>
                          <p> {{  \Carbon\Carbon::parse($slider->date_from)->format('d-M-y')  }} </p>
                        </li>
                        <li><span> <img src="images/event_time_blue.png"> </span>
                          <p>{{ date('H:i', strtotime( $slider->time_from)).'-'.date('H:i', strtotime( $slider->time_to)) }} </p>
                        </li>
                        <li><span> <img src="images/event_duration_blue.png"> </span>
							<?php
							$datework = strtotime( $slider->date_to );
							$dateworkto = strtotime( $slider->date_from );

							$testdate = ( $datework - $dateworkto ) / 86400;
                                                        if($testdate == 0)
                                                        {
                                                            $testdate = 1;
                                                        }
							?>
                          <p> {{  $testdate }} Days</p>
                        </li>
                        <li><span> <img src="images/event_people_blue.png"> </span>
                          <p>  {{ $slider->event_attendes_num($slider->id) }}/ {{ $slider->capacity }}</p>
                        </li>
                        <li><span> <img src="images/event_mf_blue.png"> </span>
                          <p> @if($slider->gender == 1) {{__('website.Male')}} @elseif($slider->gender == 2) {{__('website.Female')}} @else {{__('website.Both')}} @endif </p>
                        </li>
                        <li><span> <img src="images/event_cat_blue.png"> </span>
                          <p> {{ $slider->age_from.' - '.$slider->age_to }} </p>
                        </li>
                        <li><span> <img src="images/event_location_blue.png"> </span>
                          <p> {{ $slider['location_name_'.$lang] }} </p>
                        </li>
                          <?php
                          $cost = __('website.Unpaid');

                          if($slider->multiplePrice()->orderBy('cost')->first(['cost']))
                          {
                              $cost = $slider->multiplePrice()->orderBy('cost')->first(['cost'])->cost;
                          }
                          ?>

                          <li><span> <img src="images/cost_blue.png"> </span>
                            <p> {{ $cost }} </p>
                          </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </section>
    </div>
  @endif
  <!-- banner do in kuwait ends -->

  @if($happening_events->count()>0)
    <!-- Happening This starts -->
    <div class="full-width">
      <section class="container home-sub-section happeningthis-hold">
        <div class="section-title">
          <h1>{{__('website.Happening This')}} </h1>
        </div>

        <div class="sub-section-slider-hold">
          <ul class="home-sub-section-slider">
            @foreach($happening_events as $slider)
              @if($slider->host)
                {{ $img = $slider->host->user->avatar }}
              @else
                {{ $img = 'uploads/users/default.png' }}
              @endif
              <li>
                <div class="home-sub-slide">
                  @if(!$slider->media)
                    <div class="small-image-contain">

                      <img src="/uploads/Rizit_logo.png" class="img">

                    </div>
                    @else

                  @foreach($slider->media as $media)
                  <div class="small-image-contain">
                  <a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}">
                    <img src="{{ asset($media->link) }}" class="img">
                    </a>
                    </div>
                    @break
                  @endforeach
                  @endif
                  <div class="homesubslide-details-hold">
                    <div class="add-button"><a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}"><img
                            src="images/add_button.png"> </a></div>
                    <div class="sponsor-logo-new"> <a href="{{ route('host_profile',['host_name'=> $slider->host->user->name ]) }}"> <img src="{{ $img }}" class="img"> </a></div>
                    <div class="detail-points">
                      <h1><a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}"> {{ $slider['title_'.$lang] }} </a> </h1>
                      <p> <a href="#"> {{ $slider->category['name_'.$lang] }} </a> </p>
                      <span> - </span>
                      <p> <a href="#"> {{ $slider->maintype['name_'.$lang] }} </a> </p>
                      <ul>
                        <li><span> <img src="images/event_date_blue.png"> </span>
                          <p> {{  \Carbon\Carbon::parse($slider->date_from)->format('d-M-y')  }} </p>
                        </li>
                        <li><span> <img src="images/event_time_blue.png"> </span>
                          <p>{{ date('H:i', strtotime( $slider->time_from)).'-'.date('H:i', strtotime( $slider->time_to)) }} </p>
                        </li>
                        <li><span> <img src="images/event_duration_blue.png"> </span>
							<?php
							$datework = strtotime( $slider->date_to );
							$dateworkto = strtotime( $slider->date_from );

							$testdate = ( $datework - $dateworkto ) / 86400;
                                                        if($testdate == 0)
                                                        {
                                                            $testdate = 1;
                                                        }
							?>
                          <p> {{  $testdate }} {{__('website.Days')}}</p>
                        </li>
                        <li><span> <img src="images/event_people_blue.png"> </span>
                          <p>  {{ $slider->event_attendes_num($slider->id) }}/ {{ $slider->capacity }}</p>
                        </li>
                        <li><span> <img src="images/event_mf_blue.png"> </span>
                          <p> @if($slider->gender == 1) {{__('website.Male')}} @elseif($slider->gender == 2) {{__('website.Female')}} @else {{__('website.Both')}} @endif </p>
                        </li>
                        <li><span> <img src="images/event_cat_blue.png"> </span>
                          <p> {{ $slider->age_from.' - '.$slider->age_to }} </p>
                        </li>
                        <li><span> <img src="images/event_location_blue.png"> </span>
                          <p> {{ $slider['location_name_'.$lang] }} </p>
                        </li>
                          <?php
                          $cost = __('website.Unpaid');

                          if($slider->multiplePrice()->orderBy('cost')->first(['cost']))
                          {
                              $cost = $slider->multiplePrice()->orderBy('cost')->first(['cost'])->cost;
                          }
                          ?>

                          <li><span> <img src="images/cost_blue.png"> </span>
                            <p> {{ $cost }} </p>
                          </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </section>
    </div>

    <!-- Happening This ends -->
  @endif

  @if($popular_events->count()>0)
    <!-- Popular Activities starts -->
    <div class="full-width">
      <section class="container home-sub-section popularactivities-hold">
        <div class="section-title">
          <h1>{{__('website.Popular Activites')}}</h1>
        </div>

        <div class="sub-section-slider-hold">
          <ul class="home-sub-section-slider">
            @foreach($popular_events as $slider)
              @if($slider->host)
                {{ $img = $slider->host->user->avatar }}
              @else
                {{ $img = '/uploads/users/default.png' }}
              @endif
              <li>
                <div class="home-sub-slide">
                  @foreach($slider->media as $media)
                   <div class="small-image-contain">
                  <a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}">
                    <img src="{{ asset($media->link) }}" class="img">
                    </a>
                    </div>
                    @break
                  @endforeach
                  <div class="homesubslide-details-hold">
                    <div class="add-button"><a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}"><img
                            src="images/add_button.png"> </a></div>
                    <div class="sponsor-logo-new"> <a href="{{ route('host_profile',['host_name'=> $slider->host->user->name ]) }}"> <img src="{{ $img }}" class="img"> </a></div>
                    <div class="detail-points">
                      <h1> <a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}">{{ $slider['title_'.$lang] }} </a> </h1>
                      <p> <a href="#"> {{ $slider->category['name_'.$lang] }} </a> </p>
                      <span> - </span>
                      <p> <a href="#">  {{ $slider->maintype['name_'.$lang] }} </a> </p>
                      <ul>
                        <li><span> <img src="images/event_date_blue.png"> </span>
                          <p> {{  \Carbon\Carbon::parse($slider->date_from)->format('d-M-y')  }} </p>
                        </li>
                        <li><span> <img src="images/event_time_blue.png"> </span>
                          <p>{{ date('H:i', strtotime( $slider->time_from)).'-'.date('H:i', strtotime( $slider->time_to)) }} </p>
                        </li>
                        <li><span> <img src="images/event_duration_blue.png"> </span>
							<?php
							$datework = strtotime( $slider->date_to );
							$dateworkto = strtotime( $slider->date_from );

							$testdate = ( $datework - $dateworkto ) / 86400;
                                                        if($testdate == 0)
                                                        {
                                                            $testdate = 1;
                                                        }
							?>
                          <p> {{  $testdate }} {{__('website.Days')}}</p>
                        </li>
                        <li><span> <img src="images/event_people_blue.png"> </span>
                          <p>  {{ $slider->event_attendes_num($slider->id) }}/ {{ $slider->capacity }}</p>
                        </li>
                        <li><span> <img src="images/event_mf_blue.png"> </span>
                          <p> @if($slider->gender == 1) {{__('website.Male')}} @elseif($slider->gender == 2) {{__('website.Female')}} @else {{__('website.Both')}} @endif </p>
                        </li>
                        <li><span> <img src="images/event_cat_blue.png"> </span>
                          <p> {{ $slider->age_from.' - '.$slider->age_to }} </p>
                        </li>
                        <li><span> <img src="images/event_location_blue.png"> </span>
                          <p> {{ $slider['location_name_'.$lang] }} </p>
                        </li>
                          <?php
                          $cost = __('website.Unpaid');

                          if($slider->multiplePrice()->orderBy('cost')->first(['cost']))
                          {
                              $cost = $slider->multiplePrice()->orderBy('cost')->first(['cost'])->cost;
                          }
                          ?>

                          <li><span> <img src="images/cost_blue.png"> </span>
                            <p> {{ $cost }} </p>
                          </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </section>
    </div>
    <!-- Popular Activities ends -->
  @endif

  @if($popular_hosts->count()>0)
    <div class="full-width host-logo-section">

      <section class="container home-sub-section sponsoredhost-hold ">
        <div class="section-title">
          <h1>{{__('website.Sponsored host')}}</h1>
        </div>

        <div class="sub-section-slider-hold">
          <ul class="home-host-section-slider">
            @foreach($sponsored_hosts as $host)
              <li>
                <div class="home-host-slide">
                  <a href="{{ route('host_profile',['host_name'=>$host->user->name]) }}">
                  <div class="homelogo-image-contain">
                     <img src="{{ $host->user->avatar }}" class="img">
                    </div>
                    <div class="host-rating-hold ">
                      <h2>{{ $host->company_name }}</h2>
                      <ul>
                        <li>
                          <div class="rating-image ">
                            <img src="images/rating_high.png">
                          </div>
                          <div class="rating-value r-hi">
                            <p>{{ $host->user->ratingpositive($host->user_id) }} </p>
                          </div>
                        </li>

                        <li>
                          <div class="rating-image ">
                            <img src="images/rating_med.png">
                          </div>
                          <div class="rating-value r-me">
                            <p>{{ $host->user->ratingneutral($host->user_id) }} </p>
                          </div>
                        </li>

                        <li>
                          <div class="rating-image  ">
                            <img src="images/rating_down.png">
                          </div>
                          <div class="rating-value r-do">
                            <p>{{ $host->user->ratingnegative($host->user_id) }} </p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </a>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </section>
      <section class="container home-sub-section popularhost-hold ">
        <div class="section-title">
          <h1>{{__('website.Popular Hosts')}} </h1>
        </div>

        <div class="sub-section-slider-hold">
          <ul class="home-host-section-slider">
            @foreach($popular_hosts as $host)
              <li>
                <div class="home-host-slide">
                  <a href="{{ route('host_profile',['host_name'=>$host->user->name]) }}">
                  <div class="homelogo-image-contain">
                    <img src="{{ $host->user->avatar }}" class="img">
                    </div>
                    <div class="host-rating-hold ">
                      <h2>{{ $host->company_name }}</h2>
                      <ul>
                        <li>
                          <div class="rating-image ">
                            <img src="images/rating_high.png">
                          </div>
                          <div class="rating-value r-hi">
                            <p>{{ $host->user->ratingpositive($host->user_id) }} </p>
                          </div>
                        </li>

                        <li>
                          <div class="rating-image ">
                            <img src="images/rating_med.png">
                          </div>
                          <div class="rating-value r-me">
                            <p>{{ $host->user->ratingneutral($host->user_id) }} </p>
                          </div>
                        </li>

                        <li>
                          <div class="rating-image  ">
                            <img src="images/rating_down.png">
                          </div>
                          <div class="rating-value r-do">
                            <p>{{ $host->user->ratingnegative($host->user_id) }} </p>
                          </div>
                        </li>
                      </ul>

                    </div>
                  </a>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </section>



      <section class="container home-sub-section newproffessionals-hold ">
        <div class="section-title">
          <h1>{{__('website.New Proffessionals')}}</h1>
        </div>

        <div class="sub-section-slider-hold">
          <ul class="home-host-section-slider">
            @foreach($professions as $host)
              <li>
                <div class="home-host-slide">
                  <a href="{{ route('host_profile',['host_name'=>$host->user->name]) }}">
                  <div class="homelogo-image-contain">
                    <img src="{{ $host->user->avatar }}" class="img">
                    </div>
                    <div class="host-rating-hold ">
                      <h2>{{ $host->company_name }}</h2>
                      <ul>
                        <li>
                          <div class="rating-image ">
                            <img src="images/rating_high.png">
                          </div>
                          <div class="rating-value r-hi">
                            <p>{{ $host->user->ratingpositive($host->user_id) }} </p>
                          </div>
                        </li>

                        <li>
                          <div class="rating-image ">
                            <img src="images/rating_med.png">
                          </div>
                          <div class="rating-value r-me">
                            <p>{{ $host->user->ratingneutral($host->user_id) }} </p>
                          </div>
                        </li>

                        <li>
                          <div class="rating-image  ">
                            <img src="images/rating_down.png">
                          </div>
                          <div class="rating-value r-do">
                            <p>{{ $host->user->ratingnegative($host->user_id) }} </p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </a>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </section>
    </div>
  @endif
  <script>
      var disabledDays = ["2018-8-21", "2018-8-24", "2018-8-27", "2018-8-30"];
  </script>
@endsection

@section('lower_javascript')
  <script>
      new UISearch(document.getElementById('sb-search'));
  </script>

  <script>
      $(function () {
          $(".dropdown-menu li a").click(function () {
              var selText = $(this).html();
              $(this).parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
          });

      });

      $('[name="category[]"]').chosen({width: "100%"});
  </script>
@endsection
