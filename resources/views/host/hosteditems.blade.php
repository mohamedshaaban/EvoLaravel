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
                   @include('includes/profile_host_leftside')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 content-half">

                            <div class="user-calendar-hold cal-style">
                                <div class="sub-datepicker-display sub-cal"> </div>

                                <div class="advance-filter-hold">
                                    <ul id="filter" class="accordion">
                                        <li>
                                            <h3> {{__('website.Advance Filter')}}</h3>
                                            <form action="{{ route('filter_host_calendar',$host->id) }}" method="post">
                                                <input type="hidden" name="date" class="FromToDate">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user_id" value="{{ $host->id }}">
                                                <ul class="panel loading category-filter">
                                                    <li>
                                                        <div class="advance-filter">
                                                            <ul>
                                                                <li class="height-limit-list">  <label>{{__('website.Events Types')}}  </label>
                                                                    <select name="main_type" id="main_type" class="selectpicker">
                                                                        <option value="1">{{__('website.Select Event Type')}}</option>
                                                                        
                                                                            <option value="2">{{ __('website.Activity' )}}</option>
                                                                            <option value="1">{{ __('website.Events' )}}</option>
                                                                            <option value="3">{{ __('website.Services' )}}</option>
                                                                        
                                                                    </select></li>

                                                                <li class="height-limit-list">  <label>{{__('website.Events Categories')}}  </label>
                                                                    <select name="type" id="type" class="selectpicker">
                                                                        <option >{{__('website.Select Event Category')}}</option>
                                                                        @foreach($categories as $category)
                                                                            <option value="{{ $category->id }}">{{ $category['name_'.$lang] }}</option>
                                                                        @endforeach
                                                                    </select></li>
                                                                <li> 
                                                                    
                                                                    <button type="submit" class="stndrd-btn blue-btn"> {{__('website.Filter')}} </button></li>
                                                            </ul>
                                                        </div>
                                                    </li>


                                                </ul>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 content-half">

                            <div class="event-list-hold">
                                <ul class="profile-event-list">
                                    <?php
                                    $dates = array();
                                    ?>

                                    @foreach($events as $event)

                                        <?php
                                        $dates[]='"'.$event->date.'"';
                                        ?>
                                        <li>
                                            <a href="{{ route('event_details',['event_id'=>$event->id]) }}">
                                                <div class="event-item">
                                                    <div class="image-hold">

                                                        {{--                                                    {{ dd($event->event->media[0]->link) }}--}}
                                                        @if($event->media->count())
                                                            <img src="{{ asset($event->media[0]->link) }}">
                                                        @endif
                                                    </div>
                                                    <div class="event-data">

                                                        <div class="detail-points">
                                                            <h1> {{ $event['title_'.$lang]    }} </h1>
                                                            <p> {{ $event->category['name_'.$lang] }}  </p><p> / </p><p>{{ $event->maintype['name_'.$lang] }}</p>
                                                            <ul>
                                                                <li>  <span> <img src="/images/event_date_blue.png">  </span> <p>{{  \Carbon\Carbon::parse($event->date_from)->format('d-M-y')  }}</p></li>
                                                                <li>  <span> <img src="/images/event_time_blue.png">  </span> <p>{{ date('H:i', strtotime( $event->time_from)).'-'.date('H:i', strtotime( $event->time_to)) }}</p></li>
                                                               <!-- <li>  <span> <img src="/images/event_location_blue.png">  </span> <p>{{ $event['location_name_'.$lang] }}</p></li>-->
                                                            </ul>
                                                        </div>


                                                        <!--<div class="event-type">
                                                            {{ $event->category['name_'.$lang] }}
</div>-->

</div>

</div>
</a>
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
</section>
</div>

<script>

var disabledDays = [<?php echo implode(',',$dates); ?>];
</script>
@include('includes/js')

@endsection
{{-- javascript --}}

