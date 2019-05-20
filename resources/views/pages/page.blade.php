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
        <div class="profile-hold right-blue-pattern base-outter-padding">
            <div class="eventdetails-top-part">
                <div class="page-title">
                    {{ $data['title_'. $lang] }}
                </div>
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventdetails-info">


                        <div class="txt-editer-content">

                            {!! $data['content_' .$lang] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>
@endsection