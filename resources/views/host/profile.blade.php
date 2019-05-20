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
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 right-contents-left">
                        <h1> {{__('website.My Profile')}} </h1>
                        <div class="profile-info-hold ">
                            <div class="profile-image ">

                                {{--<img src="{{asset()}}" class="ican-edit">--}} {{ HTML::image($user->avatar) }}
                                <div class="changeimage-btn"data-toggle="modal" data-target="#exampleModal">{{__('website.Change Image')}} </div>
                            </div>
                            <div class="profile-details ">
                                <h1><a href="#" id="username" data-type="text" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}"
                                        data-title="Enter username">{{ $user->name }}</a></h1>
                                <h1><a href="#" id="email" data-type="text" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}"
                                       data-title="Enter Email">{{ $user->email }}</a></h1>
                                <br />
                               
<br />



                                <div class="contact-socialmedia ican-edit">

                                    <h4> {{__('website.Social Media')}}</h4>
                                    <ul>
                                        @foreach($user->socailMedia as $social) @if($social->type == 1 )
                                        <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/ins_contact.jpg') }}"> </a> </li>
                                        @elseif ($social->type == 2 )
                                        <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/fb_contact.jpg') }}"> </a> </li>
                                        @else
                                        <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/tw_contact.jpg') }}"> </a> </li>
                                        @endif @endforeach




                                    </ul>
                                </div>

                                <!--<div class="button-hold" style="margin-top:30px;">
                                   <button class="btn btn-secondary   blue-btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Save Changes
                        </button>
                        </div>-->

                            </div>
                        </div>
					
                    <div class="infotext">
                    
                     <p> <a href="#" id="description" data-type="textarea" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}" data-title="Enter description">{{ $user->host->description }}</a></p>
                    
                    </div>
			
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 right-contents">
                        <div class="right-profile-contact">
                            <h1> {{__('website.Contact Details')}} </h1>
                            <ul>
                                <li><a href="#" id="hostwebsite" data-type="text" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}"
                                       data-title="Enter website" class="website-style"> {{ $user->host->website }}</a></li>
                                <li> <a href="#" id="hostcontactemail" data-type="text" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}"
                                        data-title="Enter Contact Email" class="email-style"> {{ $user->host->user->contact_email }}</a></li>
                                <li> <a href="#" id="hostlandline" data-type="text" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}"
                                        data-title="Enter landline" class="phone-style"> {{ $user->host->landline }}</a></li>
                                <li> <a href="#" id="hostmobile" data-type="text" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}"
                                        data-title="Enter mobile" class="phone-style"> {{ $user->host->mobile }}</a></li>

                                <li> <a href="#" id="hostwhatsapp" data-type="text" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}"
                                        data-title="Enter whatsapp" class="fa-whatsapp"> {{ $user->host->whatsapp }}</a></li>
                                <li> <a href="#" id="hostlocation" data-type="text" data-pk="{{ $user->id }}" data-url="{{ route('host.edit_user') }}"
                                        data-title="Enter location" class="location-style">{{ $user->host->location }}</a></li>
                            </ul>
                        </div>
                        <div class="contact-socialmedia">
                            <ul>
                                @foreach($user->socailMedia as $social) @if($social->type == 1 )
                                    <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/ins_contact.jpg') }}"> </a> </li>
                                @elseif ($social->type == 2 )
                                    <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/fb_contact.jpg') }}"> </a> </li>
                                @else
                                    <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/tw_contact.jpg') }}"> </a> </li>
                                @endif @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row"> </div>
        </div>



        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('host.update_host_profile') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('website.Profile Info')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                X
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-hold">
                            <ul>

                                <div class="edit-cat">
                                    <h4> {{__('website.Basic Information')}} </h4>
                                </div>


                                <li>
                                    <label>{{__('website.Name')}}* </label>
                                    <input type="text" name="name" value="{{ $user->name }}" required class="normal-text-box">
                                </li>
                                <li>
                                    <label>{{__('website.Password')}}* </label>
                                    <input type="password" required class="normal-text-box">
                                </li>
                                <li>
                                    <label>{{__('website.Re-Enter Password')}}* </label>
                                    <input type="password" name="password_confirmation" required class="normal-text-box">
                                </li>
                                <li>
                                    <label>{{__('website.Email')}}* </label>
                                    <input type="email" name="contact_email" required value="{{ $user->contact_email }}" class="normal-text-box">
                                </li>
                                <li>
                                    <label>{{__('website.Profile Image')}} </label>
                                    <div class="upload-btn-wrapper">
                                        <button class="normal-btn blue-button">Browse </button>
                                        <input type="file" class="upload" name="avatar">
                                        <div class="filename"></div>
                                    </div>
                                </li>
                                <li class="fullwidth-li">

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="normal-btn grey-btn big-button" data-dismiss="modal">{{__('website.Close')}}</button>
                        <button type="submit" class="normal-btn blue-btn big-button">{{__('website.Save changes')}}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



    </section>
</div>
@endsection
