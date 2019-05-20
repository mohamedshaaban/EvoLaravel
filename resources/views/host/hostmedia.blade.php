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
                    <h1> <span> {{__('website.Media')}} </span> </h1>




                        <div class="listing-title blue-title">


                        </div>

                        <div class="media-list">
							<h2> Images</h2>
                            <ul>
                                @foreach($media as $file)
                                <li>
                                    <div class="profile-review">
                                        <a href="{{ asset($file->media)  }}" data-lightbox="image-1" data-title="Media">
                                            @if($file->type ==2 )
                                            <img src="{{ asset($file->media)  }}" class="img">
                                           
                                            @else
<a href="{{ $file->media }}">{{__('website.Download File')}}</a>
                                            @endif
                                        </a>
                                    </div>


                                </li>
                                    @endforeach
                            </ul>
                        </div>

                        <div class="media-list">
						<h2> Videos</h2>
                            <ul>
                                @foreach($videos as $file)
                                <li>
                                    <div class="profile-review">
                                        <a href="#">
                                            <?php
                                                parse_str( parse_url($file->media , PHP_URL_QUERY ), $my_array_of_vars );
                                                $vedio_id =  $my_array_of_vars['v'];
                                                ?>
                                            
                                                <a href="{{ $file->media  }}" class="bla-1 vid_bt video-popup" >  <img src="https://img.youtube.com/vi/{{$vedio_id}}/0.jpg"> </a>

                                                {{--<span class="del_media" onclick="delete_media({{ $file->id }})">{{__('website.delete media')}} </span>--}}
    
                                        </a>
                                    </div>


                                </li>
                                    @endforeach
                            </ul>
                        </div>
                        <!--<div class="review-share">
                            <h4> {{__('website.Share with friends')}}</h4>
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
