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
                    <h1> <span>{{__('website.My Ratings')}}</span> </h1>




                        <div class="listing-title blue-title">

                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="width: 100%;">{{ Session::get('message') }}</p>
                            @elseif(Session::has('alert'))
                                <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}" style="width: 100%;">{{ Session::get('alert') }}</p>
                            @endif
                        </div>

                        <div class="review-list">

                            <ul>
                                @foreach($user_reviews as $review)
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

                                    <p>{{ $review->comment }}</p>
                                </li>
                                    @endforeach
                            </ul>
                        </div>

                        @if(Auth::User() && Auth::User()->id!= $host->user_id )
                        <form action="{{ route('review_host') }}" method="post">
                            <input type="hidden" name="host_id" id="host_id" value="{{ $host->id }}">
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
                                <label> Enter your Comment </label>
                                <textarea name="comment" required maxlength="200">  </textarea>
                            </div>

                            <div  class="full-width">
                                <button type="submit" class="normal-btn blue-button big-button next-step"> Submit </button>
                            </div>



                        </div>
                        </form>
                        @endif
                        <!--<div class="review-share">
                            <h4> Share with friends</h4>
                            <div class="contact-socialmedia">
                                <ul>
                                    <li><a href="#"> <img src="{{ asset('images/fb_contact.jpg')}}"> </a> </li>
                                    <li><a href="#"> <img src="{{ asset('images/tw_contact.jpg')}}"> </a> </li>
                                    <li><a href="#"> <img src="{{ asset('images/ins_contact.jpg')}}"> </a> </li>
                                    <li><a href="#"> <img src="{{ asset('images/in_contact.jpg')}}"> </a> </li>
                                </ul>
                            </div>
                        </div>-->

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
