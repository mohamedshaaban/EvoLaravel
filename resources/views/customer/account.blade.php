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
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @elseif(Session::has('alert'))
                        <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}">{{ Session::get('alert') }}</p>
                    @endif
                    <h1>My Account  </h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-contents-left">
                            <div class="my-account-home">
                                <h2> {{__('website.Hello,')}} {{ Auth::User()->name }}! </h2>
                                <p> {{__('website.From_your_dashboard_you_have_the_ability_to_view_a_snapshot_of_your_recent_account_activity_and_update_your_account_information')}}</p>
                                <div class="quick-link-hold">
                                    <ul>
                                        <li>
                                            <div class="quick-icon">
                                                <a href="{{ route('my_calendar') }}">
                                                    <img src="/images/my_calendar.png">
                                                    <span> {{__('website.My Calendar')}} </span>
                                                    <div class="btn violate-btn view-btn">
                                                        {{__('website.View')}}
                                                     </div>
                                                 </a>
                                             </div>
                                         </li>

                                         <li>
                                             <div class="quick-icon">
                                                 <a href="{{ route('my_profile') }}">
                                                    <img src="/images/my_profile.png">
                                                    <span> {{__('website.My Profile')}} </span>
                                                    <div class="btn violate-btn view-btn">
                                                        {{__('website.View')}}
                                                    </div>
                                                </a>
                                            </div>
                                        </li>


                                        <li>
                                            <div class="quick-icon">
                                                <a href="{{ route('my_bookings') }}">
                                                    <img src="/images/my_history.png">
                                                    <span> {{__('website.My History')}} </span>
                                                    <div class="btn violate-btn view-btn">
                                                        {{__('website.View')}}
                                                    </div>
                                                </a>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="quick-icon">
                                                <a href="{{ route('my_contacts') }}">
                                                    <img src="/images/add_contact.png">
                                                    <span> {{__('website.Add Contact')}} </span>
                                                    <div class="btn violate-btn view-btn">
                                                        {{__('website.View')}}
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="blue-head "> {{__('website.Change Password')}} </div>

                                <div class="form-hold">
                                    <form action="{{ route('change_password') }}" method="post" >
                                    <ul>
                                        {{ csrf_field() }}


                                        <li>
                                            <label>{{__('website.Old Password*')}} </label>
                                            <input type="password" class="normal-text-box">
                                        </li>
                                        <li>
                                            <label>{{__('website.New Password*')}} </label>
                                            <input type="password" name="new_password" required class="normal-text-box">
                                        </li>
                                        <li>
                                            <label>{{__('website.Confirm Password*')}} </label>
                                            <input type="password" name="confirmed" required class="normal-text-box">
                                        </li>

                                        <li class="fullwidth-li">
                                            <button type="submit" class="normal-btn blue-button big-button next-step"> {{__('website.Change Password')}} </button>
                                        </li>
                                    </ul>
                                    </form>
                                </div>

                                <div class="blue-head "> {{__('website.Change Notification Setting')}} </div>

                                <div class="form-hold">
                                    <form action="{{ route('change_notification_setting') }}" method="post" >
                                        <ul>
                                            {{ csrf_field() }}


                                            <li>
                                            <li class="height-limit-list">
                                                <label> Notification* </label>
                                                <select name="notification_type" class="selectpicker">

                                                    <option value="{{ \App\User::All_NOTIFICATION_TYPE }}" @if(Auth::user()->notification_type==\App\User::All_NOTIFICATION_TYPE) selected @endif>{{__('website.Email & Mobile')}}</option>
                                                    <option value="{{ \App\User::EMAIL_NOTIFICATION_TYPE }}" @if(Auth::user()->notification_type==\App\User::EMAIL_NOTIFICATION_TYPE) selected @endif>{{__('website.Email')}} </option>
                                                    <option value="{{ \App\User::SITE_NOTIFICATION_TYPE }}" @if(Auth::user()->notification_type==\App\User::SITE_NOTIFICATION_TYPE) selected @endif>{{__('website.Mobile')}}</option>

                                                </select>
                                            </li>
                                            </li>

                                            <li class="fullwidth-li">
                                                <button type="submit" class="normal-btn blue-button big-button next-step"> {{__('website.Change Notification Setting')}} </button>
                                            </li>
                                        </ul>
                                    </form>
                                </div>

                            </div>


                        </div>

                    </div>
                </div>
                <div class="row"> </div>
            </div>
        </section>
    </div>
@endsection
