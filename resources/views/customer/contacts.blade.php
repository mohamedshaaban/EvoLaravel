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
                    <h1>{{__('website.Contacts')}}  </h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-contents-left">
                            <div class="sub-section-slider-hold">
                                <ul class="profile-slider-slick">
                                    @foreach($user->UserContacts as $usercontact)
                                        <li>
                                            <div class="profile-list"> <a href="#">
                                                    <div class="pro-image">{{ HTML::image('uploads/users/'.$usercontact->image) }} </div>
                                                    <h2>{{ $usercontact->name }}</h2>
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
