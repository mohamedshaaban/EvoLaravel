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
                    {{__('website.FAQ')}}
                </div>
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="review-hold">
                            <ul id="review" class="accordion">
                                @foreach ($faqs as $faq)
                                <li>
                                    <h3>{{ $faq['question_' . $lang] }}</h3>
                                    <ul class="panel loading category-filter">
                                        <div class="txt-editer-content">
                                            {!! $faq['answer_' . $lang] !!}
                                        </div>
                                    </ul>
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
@endsection