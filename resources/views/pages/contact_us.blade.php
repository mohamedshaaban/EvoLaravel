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
                    {{__('website.Contact Us')}}
                </div>
                <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 eventdetails-info">

                        <div class="contact-img">
                            <img src="{{ asset('images/contact_us.jpg') }}">
                        </div>


                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 eventdetails-info">
                        <div class="txt-editer-content">
                            <h1> {{__('website.Support')}}</h1>
                            <p>
                                <strong> {{__('website.Email')}} </strong>
                                <a href="#"> {{ $setting->email_support}}</a>
                            </p>
                            <p>
                                <strong> {{__('website.Phone')}} </strong> {{ $setting->phone}} , {{ $setting->mobile}}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 eventdetails-info">
                        <div class="form-hold">
                            <div class="blue-head" style="margin-top:20px;"> {{__('website.Send us a Message')}} </div>
                            <form method="post" action="{{ route('store_contact_us')}}">
                                {{ csrf_field() }}
                                <ul>
                                    <li>
                                        <label>{{__('website.Subject')}} </label>
                                        <select name="type" class="selectpicker">
                                <option value="Feedback">{{__('website.Feedback')}}</option>
                                <option value="Complaint">{{__('website.Complaint')}}</option>
                                <option value="Enquire">{{__('website.Enquire')}}</option>
                                <option value="Suggestion">{{__('website.Suggestion')}} </option>
                    
                              </select>
                                    </li>
                                    <li>
                                        <label>{{__('website.First Name*')}} </label>
                                        <input name="first_name" type="text" class="normal-text-box">
                                    </li>
                                    <li>
                                        <label>{{__('website.Last Name*')}} </label>
                                        <input name="last_name" type="text" class="normal-text-box">
                                    </li>
                                    <li>
                                        <label>{{__('website.Email*')}} </label>
                                        <input name="email" type="email" class="normal-text-box">
                                    </li>
                                    <li>
                                        <label>{{__('website.Country')}} </label>
                                        <select name="country" class="selectpicker">
                                <option value="Kuwait">{{__('website.Kuwait')}}</option>
                                <option value="UAE">{{__('website.UAE')}}</option>
                                <option value="Saudi Arabiya">{{__('website.Saudi Arabiya')}} </option>
                                <option value="Qatar">{{__('website.Qatar')}} </option>
                              </select>
                                    </li>
                                    <li>
                                        <label>{{__('website.Phone*')}} </label>
                                        <input name="phone" type="text" class="normal-text-box">
                                    </li>

                                    <li class="fullwidth-li">
                                        <div class="cmnt-box">
                                            <label> {{__('website.Your Message*')}} </label>
                                            <textarea name="message" style="width:89%; line-height:normal;">  </textarea>
                                        </div>
                                    </li>
                                    <li class="fullwidth-li">
                                        <button type="submit" class="normal-btn blue-button big-button "> {{__('website.Submit')}} </button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>
@endsection