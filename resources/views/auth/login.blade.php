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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left-links-hold">
                <div class="login-hold">
                    <h1> {{__('website.Sign in to your Account')}}</h1>
                    <p> {{__('website.If_you_are_a_registered_User_or_Host,_please_enter_your_username_and_password_Here:')}}</p>
                    <div class="form-hold">
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <ul>
                                <li>
                                    <label>{{__('website.Email')}}* </label>
                                    <input name="email" type="text" id="useremail" class="normal-text-box">
                                    
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </li>
                                <li>
                                    <label>{{__('website.Password')}}* </label>
                                    <input id="password" name="password"  type="password" class="normal-text-box">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </li>
                                <li>
                                    <button type="submit" class="normal-btn violate-btn "> {{__('website.Login')}} </button>
                                </li>
                                <li>
                                    <div class="chkbox-container-hold contact-chkbox">
                                        <label class="checkbox-container">{{__('website.Remember me on this PC')}}
                                        <input name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} >
                                        <span class="checkmark"></span> </label>
                                    </div>
                                </li>

                                <li class="fullwidth-li">
                                    <a href="{{ route('password.request') }}" class="frgt-password">{{__('website.Forgot Password?')}} </a>
                                </li>
                            </ul>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 right-contents-hold">
                <h1>{{__('website.Not a Registered Member?')}} </h1>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-contents-left">
                        <div class="login-reg-options">
                            <div class="form-hold">
                                <ul>
                                    <li>
                                        <a class="normal-btn violate-btn" href="{{ route('register')}}"> {{__('website.Register as a User')}}</a>
                                    </li>
                                    <li>
                                       <a class="normal-btn blue-btn" href="{{ route('register')}}"> {{__('website.Register as a Host')}} </a>
                                    </li>

                                </ul>
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