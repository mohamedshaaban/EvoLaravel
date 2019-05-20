@extends('layouts.app')
@section('content')
<style>
    #Container .mix{
        /*visibility: hidden;*/
    }
</style>
    <!-- banner section starts -->
    <div class="full-width">
        <section class="container bannerpart-hold">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 subpage-cal-section">
                    <form action="{{ route('search_filter') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="date" id="date" >
                    <div class="sub-calendar-hold cal-style">
                        <div class="sub-datepicker-display sub-cal"> </div>
                    </div>
                    <div class="search-form">
                        <div class="ta-con activity-tab">

                            <ul>
                                <li>
                                    <label>{{__('website.Events Types')}} </label>
                                    <select name="type" class="selectpicker">
                                        <option value="">{{__('website.Select Event Type')}}</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type['name_'.$lang] }}</option>
                                            @endforeach
                                    </select>
                                </li>
                                <li>
                                    <label>{{__('website.Categories')}} </label>
                                    <select name="category" class="selectpicker" onchange="get_subcategory(this.value)">
                                        <option value="">{{__('website.Main Category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category['name_'.$lang] }}</option>
                                            @endforeach
                                    </select>
                                </li>
                                <li>
                                    <select name="category" id="sub_category1" class="selectpicker">
                                        <option value="">{{__('website.Sub Category')}}</option>

                                    </select>
                                </li>
                                <li class="halfwidth-elements">
                                    <label> {{__('website.Age Group')}} </label>
                                    <select name="age_from" class="selectpicker halfwidth">
                                        <option value="">{{__('website.From')}}</option>
                                        @foreach($age_from as $age)

                                            <option value="{{ $age->age_from }}">{{ $age->age_from }}</option>
                                            @endforeach
                                    </select>
                                    <select name="age_to" class="selectpicker halfwidth">
                                        <option value="">{{__('website.To')}}</option>
                                        @foreach($age_to as $age)
                                            <option value="{{ $age->age_to }}">{{ $age->age_to }}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <label>{{__('website.Gender')}} </label>
                                    <select name="gender" class="selectpicker">
                                        <option value="1">{{__('website.Male')}}</option>
                                        <option value="2">{{__('website.Female')}}</option>
                                        <option value="3">{{__('website.Male and Female')}}</option>
                                    </select>
                                </li>
                                <li>
                                    <div class="chkbox-container-hold">
                                        <label class="checkbox-container">{{__('website.Paid')}}
                                            <input type="checkbox" name="paid" value="1" checked="checked">
                                            <span class="checkmark"></span> </label>
                                        <label class="checkbox-container">{{__('website.Unpaid')}}
                                            <input type="checkbox" name="unpaid" value="1">
                                            <span class="checkmark"></span> </label>
                                    </div>
                                </li>
                                <li>
                                    <label>{{__('website.Location')}} </label>
                                    <select name="location" class="selectpicker">
                                        <option value="">{{__('website.Location')}}</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location['location_name_'.$lang] }}">{{ $location['location_name_'.$lang] }}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <button class="stndrd-btn violate-btn" type="submit"> {{__('website.Search')}}</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 subpage-banner-section ">
                    <ul  class="sub-banner-slider">
                       @foreach($event_sliders as $slider)
                        <li>
                            <div class="event-slide"> @foreach($slider->media as $media)

                                    <img src="{{ asset($media->link) }}"  class="img">
                                    @break
                                @endforeach
                                <div class="eventslide-details-hold sub-slide-details-hold">
                                    <div class="add-button"><a href="{{ route('event_details' ,['event_id'=> $slider->id]) }}"><img src="images/add_button.png"> </a> </div>
                                    <div class="sponsor-logo-new"> <img src="{{ $slider->host->user->avatar }}"  class="img">  </div>
                                    <div class="detail-points">
                                        <h1> {{ $slider['title_'.$lang] }} </h1>
                                        <p> {{ $slider->category['name_'.$lang] }} </p>
                                        <span> - </span>
                                        <p> {{ $slider->maintype['name_'.$lang] }} </p>
                                        <ul>
                                            <li> <span> <img src="images/event_date_blue.png"> </span>
                                                <p> {{  \Carbon\Carbon::parse($slider->date_from)->format('d-M-y')  }} </p>
                                            </li>
                                            <li> <span> <img src="images/event_time_blue.png"> </span>
                                                <p>{{ date('H:i', strtotime( $slider->time_from)).'-'.date('H:i', strtotime( $slider->time_to)) }} </p>
                                            </li>
                                            <li> <span> <img src="images/event_duration_blue.png"> </span>
                                                <?php
                                                $datework = strtotime($slider->date_to );
                                                $dateworkto = strtotime($slider->date_from );

                                                $testdate =($datework - $dateworkto) / 86400;
                                                if($testdate == 0)
                                                        {
                                                            $testdate = 1;
                                                        }
                                                ?>
                                                <p> {{  $testdate }} {{__('website.Days')}}</p>
                                            </li>
                                            <li> <span> <img src="images/event_people_blue.png"> </span>
                                                <p> {{ $slider->event_attendes_num($slider->id) }}/ {{ $slider->capacity }}</p>
                                            </li>
                                            <li> <span> <img src="images/event_mf_blue.png"> </span>
                                                <p> @if($slider->gender == 1) Male @elseif($slider->gender == 2) Female @else Both @endif </p>
                                            </li>
                                            <li> <span> <img src="images/event_cat_blue.png"> </span>
                                                <p> {{ $slider->age_from.' - '.$slider->age_to }} </p>
                                            </li>
                                            <li> <span> <img src="images/event_location_blue.png"> </span>
                                                <p> {{ $slider['location_name_'.$lang] }} </p>
                                            </li>
                                            @if($slider->multiplePrice()->orderBy('cost')->first(['cost']))
                                                <li><span> <img src="images/cost.png"> </span>
                                                    <p> {{ $slider->multiplePrice()->orderBy('cost')->first(['cost'])->cost }} </p>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                           @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <!-- banner section ends -->

    <!-- banner do in kuwait starts -->

    <div  class="full-width">
        <section class="container   inner-page-listing">
            <div class="full-width tab_cov">

                <!-- Nav tabs -->
                <div class="controls">
                <ul class="nav nav-tabs listing-tabs" role="tablist">

                    @if($event_categories->count()>0)
                    <li class="control" data-filter="all"><span>{{__('website.All')}}</span></li>
                    @endif
                        @foreach($event_categories as $category)


                            <li role="presentation" class="control filter"  data-filter=".<?php echo str_replace(' ', '_', $category['name_'.$lang])?>" >{{ $category['name_'.$lang] }}</li>
                        @endforeach
                </ul>




                </div>
                <!-- /.nav_tabs -->

                <div class="listing-title">
                    <h1></h1>
                </div>
                <div class="tab-content ">


                    <?php $i =0; $cost =0; $cprice = 0 ; ?>
                        <div role="tabpanel" class="tab-pane active " id="week">
                            <div class="innerpage-listing ">
                                <ul class="mixContainer">
                                    @foreach($events as $event)
                                        <?php
                                        if($event->multiplePrice()->orderBy('cost')->first(['cost']))
                                        {
                                            $cost = $event->multiplePrice()->orderBy('cost')->first(['cost'])->cost;
                                            $cprice = $event->multiplePrice()->orderBy('cost')->first(['cost'])->cost;
                                        }
                                        ?>
                                        <li  class="mix <?php echo str_replace(' ', '_', $event->category['name_'.$lang])?>" data-attendes = {{ $i }} data-date={{ $event->date_from }} data-price={{ $cprice }}>
                                        <div class="home-sub-slide">
@foreach($event->media as $media)

                                                <img src="{{ asset($media->link) }}"  class="img">
                                                @break
    @endforeach




                                            <div class="homesubslide-details-hold">
                                                <div class="add-button"> <a href="{{ route('event_details' ,['event_id'=> $event->id]) }}"> <img src="images/add_button.png"> </a> </div>

                                                <div class="sponsor-logo-new"> <img src="{{ $event->host->user->avatar }}" class="img"> </div>
                                                <div class="detail-points">
                                                    <h1> {{ $event['title_'.$lang] }}</h1>
                                                    <p> {{ $event->category['name_'.$lang] }} </p>
                                                    <span> - </span>
                                                    <p> {{ $event->maintype['name_'.$lang] }} </p>
                                                    <ul>
                                                        <li> <span> <img src="images/event_date_blue.png"> </span>
                                                            <p> {{  \Carbon\Carbon::parse($event->date_from)->format('d-M-y')  }} </p>
                                                        </li>
                                                        <li> <span> <img src="images/event_time_blue.png"> </span>
                                                            <p>{{ date('H:i', strtotime( $event->time_from)).'-'.date('H:i', strtotime( $event->time_to)) }} </p>
                                                        </li>
                                                        <li> <span> <img src="images/event_duration_blue.png"> </span>
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
                                                        <li> <span> <img src="images/event_people_blue.png"> </span>
                                                            <p> {{ $event->event_attendes_num($event->id) }}/ {{ $event->capacity }}</p>
                                                        </li>
                                                        <li> <span> <img src="images/event_mf_blue.png"> </span>
                                                            <p> @if($event->gender == 1) Male @elseif($event->gender == 2) Female @else Both @endif </p>
                                                        </li>
                                                        <li> <span> <img src="images/event_cat_blue.png"> </span>
                                                            <p> {{ $event->age_from.' - '.$event->age_to }} </p>
                                                        </li>
                                                        <li> <span> <img src="images/event_location_blue.png"> </span>
                                                            <p> {{ $event['location_name_'.$lang] }} </p>
                                                        </li>
                                                        @if($event->multiplePrice()->orderBy('cost')->first(['cost']))
                                                            <li><span> <img src="images/cost.png"> </span>
                                                                <p> {{ $event->multiplePrice()->orderBy('cost')->first(['cost'])->cost }} </p>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                </div>
            </div>
        </section>
    </div>

{{--<button class="filter" data-filter=".category-1">Category 1</button>--}}
{{--<button class="filter" data-filter=".category-2">Category 2</button>--}}


{{--<div class="mixContainer">--}}


    {{--<div class="mix category-1" data-my-order="1"> .wwwwwwwwwwwwwwwwwwwwwwwwwww.. </div>--}}
    {{--<div class="mix category-1" data-my-order="2"> .wwwwwwwwwwwwwwwwwwwwwwwwwwww.. </div>--}}
    {{--<div class="mix category-2" data-my-order="3"> ..3333333333333333333333333333333333. </div>--}}
    {{--<div class="mix category-2" data-my-order="4"> ..4444444444444444444444444444444444444444444444. </div>--}}
{{--</div>--}}

    <script>

        var disabledDays = ["2018-8-21", "2018-8-24", "2018-8-27", "2018-8-30"];




    </script>
@endsection
