@extends('layouts.app') 
@section('content')
    <div class="full-width">
        <section class="container profile-frame-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"> {{__('Home')}} </a></li>
                    <li><a href="#"> {{__('Home')}} </a></li>
                    <li><a href="#"> {{__('Home')}} </a></li>
                </ul>
            </div>
            <div class="profile-hold">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 left-links-hold">
                    @include('includes/customer_leftside')

                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">
                    <h1>{{__('website.Badges')}}  </h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-contents-left">
                            <div class="badges-list-normal">
                                <ul>


                                    @foreach($user->badges as $badges)
                                    <li><a href="#"> {{ HTML::image('uploads/'.$badges->logo) }}
                                            <p>{{ $badges['name_'.$lang] }}</p> </a> </li>
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
