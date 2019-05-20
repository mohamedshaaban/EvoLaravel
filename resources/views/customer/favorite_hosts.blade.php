@extends('layouts.app') 
@section('content')
    <div class="full-width">
        <section class="container profile-frame-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"> {{__('website.Home')}} </a></li>
                    <li><a href="#"> {{__('website.Home')}} </a></li>
                    <li><a href="#"> {{__('website.Home')}} </a></li>
                </ul>
            </div>
            <div class="profile-hold">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 left-links-hold">
                    @include('includes/customer_leftside')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">
                    <h1>{{__('website.Favorite Hosts')}} </h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-contents-left">
                            <div class="sub-section-slider-hold">
                                <ul class="fav-hosts-user">


                                        @foreach( $hosts as $host)

                                        {!! $host->user->name !!}

                                    <li>
                                        <div class="home-host-slide"> <a href="#"> {{ HTML::image($host->user->avatar) }}
                                                <div class="host-rating-hold ">
                                                    <h2> {{ $host->user->name }}</h2>
                                                    <ul>
                                                        <li>
                                                            <div class="rating-image "> <img src="/images/rating_high.png"> </div>
                                                            <div class="rating-value r-hi">
                                                                <p>{{ $host->user->ratingpositive($host->user_id) }}</p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="rating-image "> <img src="/images/rating_med.png"> </div>
                                                            <div class="rating-value r-me">
                                                                <p>{{ $host->user->ratingneutral($host->user_id) }} </p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="rating-image  "> <img src="/images/rating_down.png"> </div>
                                                            <div class="rating-value r-do">
                                                                <p>{{ $host->user->ratingnegative($host->user_id) }} </p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </a> </div>
                                    </li>

                                    @endforeach
                                </ul>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="row"> </div>
            </div>
        </section>
    </div>
@endsection
