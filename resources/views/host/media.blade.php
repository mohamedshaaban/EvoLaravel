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
                    <h1> <span> {{__('website.Media')}} </span> </h1>

                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="width: 100%;">{{ Session::get('message') }}</p>
                    @endif


                        <div class="listing-title blue-title">


                        </div>

                        <div class="media-list">

                            <ul>
                                @foreach($user->UserMedia as $file)
                                <li id="image{{ $file->id }}">

                                     <span class="del_media" onclick="delete_media({{ $file->id }})">{{__('website.delete media')}} </span>
                                    <div class="meida-item">
                                        <a href="{{ asset($file->media)  }}" data-lightbox="image-1" data-title="Media">
                                            @if($file->type ==2 )
                                            <img src="{{ asset($file->media)  }}" class="img">
                                             <h2>{{ $file->caption }}</h2>

                                            @elseif ($file->type == 3)
                                                {{--<iframe width="100" height="100" src="{{ $file->media  }}" frameborder="0" allowfullscreen></iframe>--}}
                                            <?php
                                                parse_str( parse_url($file->media , PHP_URL_QUERY ), $my_array_of_vars );
                                                $vedio_id =  $my_array_of_vars['v'];
                                                ?>
                                            
                                                <a href="{{ $file->media  }}" class="bla-1 vid_bt video-popup" >  <img src="https://img.youtube.com/vi/{{$vedio_id}}/0.jpg"> </a>

                                                {{--<span class="del_media" onclick="delete_media({{ $file->id }})">{{__('website.delete media')}} </span>--}}

                                            @endif
                                        </a>
                                        
                                    </div>

                                   
                                </li>
                                    @endforeach
                            </ul>
                        </div>
                    <div class="blue-head "> {{__('website.Change Profile Picture')}} </div>
                    <div class="form-hold upload_media">
                        <form action="{{ route('host.upload_media') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <ul>



                                <li>
                                    <select name="type"class="normal-text-box selectpicker"id="type" onchange="switch_fields(this.value)">

                                        <option value="2">{{__('website.Image')}}</option>
                                        <option value="3">{{__('website.Video')}}</option>
                                    </select>

                                    
                                   
                                </li>
                                <li> 
                                <input class="normal-text-box" name="image" id="image" type="file" placeholder="image">
                                <input class="normal-text-box" name="video" id="video" type="text" style="display: none" placeholder="video url">
                                
                                </li>
                                
                                <li> <input class="normal-text-box" name="caption" id="caption" type="text" placeholder="Title"> </li>
                                


                                <li class="fullwidth-li">
                                    <button type="submit" class="normal-btn blue-button big-button "> {{__('website.Upload')}} </button>
                                </li>
                            </ul>
                        </form>
                    </div>


                        <div class="review-share">
                            <h4> {{__('website.Share with friends')}}</h4>
                            <div class="contact-socialmedia">
                                <ul>
                                    <li><a href="#"> <img src="{{ asset('images/fb_contact.jpg')}}"> </a> </li>
                                    <li><a href="#"> <img src="{{ asset('images/tw_contact.jpg')}}"> </a> </li>
                                    <li><a href="#"> <img src="{{ asset('images/ins_contact.jpg')}}"> </a> </li>
                                    <li><a href="#"> <img src="{{ asset('images/in_contact.jpg')}}"> </a> </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
        function switch_fields(val)
        {
            if(val == 2)
            {
                $('#image').show();
                $('#video').hide();
            }
            else
            {
                $('#image').hide();
                $('#video').show();
            }
        }
        function delete_media(id)
        {
            $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: "{{ route('host.deleteimage') }}",
                type: 'POST',
                cache: false,
                data: {'media_id':id, '_token': $_token }, //see the $_token
                // datatype: 'html',
                beforeSend: function() {
                    //something before send



                },
                success: function(data) {
                    $( "#image"+id ).empty();
                }
            });

        }

    </script>
@endsection
