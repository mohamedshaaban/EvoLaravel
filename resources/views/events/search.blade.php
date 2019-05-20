@extends('layouts.app')
@section('content')
<style>
    #Container .mix{
        /*visibility: hidden;*/
    }
</style>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<div class="full-width">
    @if($events->count() > 0)
    <section class="container   inner-page-listing">

        <div class="filter-part ">

            <div class="sort-btn simple-listbox">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle " type="button" id="filterdropdownMenuButtonxx" onclick="$('#showfiltermenu').toggle()" aria-haspopup="true" aria-expanded="false">
                        {{__('website.Filter By')}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="filterdropdownMenuButtonxx" id="showfiltermenu">
                        <a class="dropdown-item" href="#"  data-filter="all">{{__('website.All')}}</a>
                        <a class="dropdown-item" href="#"  data-toggle=".male">{{__('website.Male')}}</a>
                        <a class="dropdown-item" href="#"  data-toggle=".female">{{__('website.Female')}}</a>
                        <a class="dropdown-item" href="#"  data-toggle=".both">{{__('website.Both')}}</a>
                    </div>
                </div>
            </div>

            <div class="sort-btn simple-listbox">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButtonxx" onclick="$('#showfilter').toggle()" aria-haspopup="true" aria-expanded="false">
                    {{__('website.Sort By')}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="showfilter">
                    <a class="dropdown-item" href="#" data-sort="date:asc">{{__('website.Date Ascending')}}</a>
                    <a class="dropdown-item" href="#" data-sort="date:desc">{{__('website.Date Descending')}}</a>
                    <a class="dropdown-item" href="#" data-sort="price:asc">{{__('website.lowest-highest')}}</a>
                    <a class="dropdown-item" href="#" data-sort="price:desc">{{__('website.highest-lowet')}}</a>
                    <a class="dropdown-item" href="#" data-sort="rate:desc">{{__('website.rating-highest')}}</a>
                    <a class="dropdown-item" href="#" data-sort="rate:asc">{{__('website.rating-lowet')}}</a>
                </div>
            </div>
        </div>



        {{--<div class="sort-btn simple-listbox">--}}
                {{--<div class="dropdown">--}}
                    {{--<button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">--}}
                        {{--Dropdown button--}}
                    {{--</button>--}}
                    {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}



        </div>





    </section>
    @endif



</div>

    <div  class="full-width">
        <section class="container   inner-page-listing">
            <div class="full-width tab_cov">

                <!-- Nav tabs -->
                <div class="controls"><?php $i =0; ?>
                    <b class="alert">{{__('website.eventscount').$events->count().__('website.found')}} </b>
                



                </div>
                <!-- /.nav_tabs -->

                <div class="listing-title">
                    <h1></h1>
                </div>
                <div class="tab-content ">


                        <div role="tabpanel" class="tab-pane active " id="week">
                            <div class="innerpage-listing ">
                                <ul class="mixContainer">
                                    @if($events->count() <1)
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  event-pricing">
                                            <div class="book-btn"> <span>
                <b class="alert">{{__('website.noEventsFound')}} </b>
                </span> </div>
                                        </div>
                                        @endif
                                    @foreach($events as $event)
                                        <?php
                                            $gender='both';
                                            if($event->gender==1)
                                                {
                                                    $gender ='male';
                                                }
                                                else if($event->gender == 2)
                                                    {
                                                        $gender ='female';
                                                    }
                                        $cost = __('website.Unpaid');
                                        $cprice = 0 ;

                                        if($event->multiplePrice()->orderBy('cost')->first(['cost']))
                                        {
                                            $cost = $event->multiplePrice()->orderBy('cost')->first(['cost'])->cost;
                                            $cprice = $event->multiplePrice()->orderBy('cost')->first(['cost'])->cost;
                                        }
                                        ?>

                                    <li  class="mix <?php echo str_replace(' ', '_', $event->category['name_'.$lang])?> {{ $gender }}" data-attendes = {{ $i }} data-date={{ $event->date_from }} data-price={{ $cprice }} data-rate={{ abs($event->ratingpositive($event->id) - $event->ratingnegative($event->id)) }}>
                                        <div class="home-sub-slide">
                                            <?php $i++; ?>
 @if(!$event->media|| sizeof($event->media)<1)
                        <div class="small-image-contain">

                          <img src="/uploads/Rizit_logo.png" class="img">

                        </div>
                      @else
                                            @foreach($event->media as $media)<?php

                                                ?>

                                                <div class="small-image-contain">

												<a href="#">
                                                <img src="{{ asset($media->link) }}" class="img">
                                                </a>

                                                </div>
                                                @break
    @endforeach

@endif


                                            <div class="homesubslide-details-hold">
                                                <div class="add-button"> <a href="{{ route('event_details' ,['event_id'=> $event->id]) }}"> <img src="{{ asset('images/add_button.png') }}"> </a> </div>

                                                <div class="sponsor-logo-new"> <a href="#"> <img src="{{ $event->host->user->avatar }}" class="img"> </a> </div>
                                                <div class="detail-points">
                                                    <h1> <a href="#"> {{ $event['title_'.$lang] }} </a></h1>
                                                    <p> <a href="#"> {{ $event->category['name_'.$lang] }}  </a> </p>
                                                    <span> - </span>
                                                    <p> <a href="#"> {{ $event->maintype['name_'.$lang] }} </a> </p>
                                                    <ul>
                                                        <li> <span> <img src="{{ asset('images/event_date_blue.png') }}"> </span>
                                                            <p> {{  \Carbon\Carbon::parse($event->date_from)->format('d-M-y')  }} </p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_time_blue.png')}}"> </span>
                                                            <p>{{ date('g:i', strtotime( $event->time_from)).'-'.date('g:i', strtotime( $event->time_to)) }}</p>
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
                                                            <p> {{ $i }}/600</p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_mf_blue.png')}}"> </span>
                                                            <p> @if($event->gender == 1) Male @elseif($event->gender == 2) Female @else Both @endif </p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_cat_blue.png')}}"> </span>
                                                            <p> {{ $event->age_from.' - '.$event->age_to }} </p>
                                                        </li>
                                                        <li> <span> <img src="{{ asset('images/event_location_blue.png')}}"> </span>
                                                            <p> {{ $event['location_name_'.$lang] }} </p>
                                                        </li>

                                                            <li><span> <img src="{{ asset('images/cost_blue.png')}}"> </span>
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

@endsection
