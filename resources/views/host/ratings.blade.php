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
                    @include('includes/host_leftside')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">
                    <h1>{{__('website.Reviews')}}</h1>
                    <div class="listing-title blue-title">

                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="width: 100%;">{{ Session::get('message') }}</p>
                        @elseif(Session::has('alert'))
                            <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}" style="width: 100%;">{{ Session::get('alert') }}</p>
                        @endif
                    </div>

                    <div class="review-list">

                        <ul>
                            @foreach($ratings as $review)
                                <li>
                                    <div class="profile-review">
                                        <a href="#">
                                            <img src="{{ $review->user->avatar }}" class="img">
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
                                    <div style="clear:both;"></div>
                                    <p>{{ $review->comment }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row"> </div>
            </div>
        </section>
    </div>

@endsection
