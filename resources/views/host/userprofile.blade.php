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
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 right-contents-left">
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="width: 100%;">{{ Session::get('message') }}</p>
                            @elseif(Session::has('alert'))
                                <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}" style="width: 100%;">{{ Session::get('alert') }}</p>
                            @endif
                            <div class="profile-info-hold">
                                <div class="profile-image"> <img src="{{ $host->user->avatar }}"> </div>
                                <div class="profile-details">
                                    <h1>{{ $host->user->name }}</h1>
                                    <div class="sub-name">
                                        <p>{{ $host->company_name }}</p>
                                    </div>

                                    <?php
                                    $testdate = 0 ;
                                    $datework = strtotime($host->work_to );
                                    $dateworkto = strtotime($host->work_from );

                                    $testdate =floor(($datework - $dateworkto) / (60*60));
                                    ?>
                                    <div class="working-hours">{{__('website.Working Hours')}}:  
                                       {{ Carbon\Carbon::parse($host->work_from)->format('H:i') }} {{__('website.To')}} {{ Carbon\Carbon::parse($host->work_to)->format('H:i') }} 
                                    </div>
                                    <div class="working-hours">{{__('website.break Hours')}}: 
                                       {{ Carbon\Carbon::parse($host->break_from)->format('H:i') }} {{__('website.To')}} {{ Carbon\Carbon::parse($host->break_to)->format('H:i') }} 
                                    </div> 

                                    <div class="host-rating-hold">
                                        <ul>
                                            <li>
                                                <div class="rating-image ">
                                                    <img src="{{ asset('images/rating_high.png') }}">
                                                </div>
                                                <div class="rating-value r-hi">
                                                    <p>{{ $host->user->ratingpositive($host->user_id) }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="rating-image ">
                                                    <img src="{{ asset('images/rating_med.png') }}">
                                                </div>
                                                <div class="rating-value r-me">
                                                    <p>{{ $host->user->ratingneutral($host->user_id) }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="rating-image  ">
                                                    <img src="{{ asset('images/rating_down.png') }}">
                                                </div>
                                                <div class="rating-value r-do">
                                                    <p>{{ $host->user->ratingnegative($host->user_id) }} </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    @if(Auth::user())
                                        <?php
                                        $my_contacts = \App\Models\UserContacts::where('owner_id',$host->user_id)->where('user_id',Auth::user()->id)->first();

                                        ?>
                                        <div class="add-user-icon-wrap">
                                    <div class="report-hold">
                                        <a href="#" data-toggle="modal" title="Report" data-target="#exampleModal">   </a> </div>
                                        @if(!$my_contacts)
                                            <div class="adduser-hold"> <a href="#" title="Add User" onclick="add_contact({{ $host->user_id }})">   </a> </div>
                                        @endif
                                        <div class="addfavorite-hold"> <a href="#" title="Add to Favorite"  onclick="add_favorite({{ $host->id }})">   </a> </div>
                                        </div>
                                    @endif
                                    

                                </div>
                            </div>
                                <div class="infotext">
                                    {!! $host->description !!}
                                </div>
                            </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 right-contents">
                            <div class="right-profile-contact">
                                <h1> {{__('website.Contact Details')}} </h1>
                                <ul>
                                    @if($host->website)<li> <a href="#" class="website-style"> {{ $host->website }}</a></li>@endif
                                    @if($host->user->email)<li> <a href="#" class="email-style"> {{ $host->user->email }}</a></li>@endif
                                    @if($host->mobile)<li> <a href="#" class="phone-style"> {{ $host->landline }} - {{ $host->mobile }}</a></li>@endif
                                    @if($host->whatsapp)<li> <a href="#" class="watsup-style"> {{ $host->whatsapp }}</a></li>@endif
                                    @if($host->location)<li> <a href="#" class="location-style">{{ $host->location }}</a></li>@endif
                                </ul>
                            </div>
                            @if($host->user->socailMedia->count()>0)
                            <div class="contact-socialmedia">
                            <h2> Social Media</h2>
                                <ul>
                                    @foreach($host->user->socailMedia as $social) @if($social->type == 1 )
                                        <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/ins_contact.jpg') }}"> </a> </li>
                                    @elseif ($social->type == 2 )
                                        <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/fb_contact.jpg') }}"> </a> </li>
                                    @else
                                        <li><a href="{!! $social->link !!}"> <img src="{{ asset('images/tw_contact.jpg') }}"> </a> </li>
                                    @endif @endforeach
                                </ul>
                            </div>
                            @endif
                            @if(Auth::user())
                                <div class="chkbox-container-hold contact-chkbox">
                                    <label class="checkbox-container">{{__('website.Notify_me_when_this_company_is_hosting_something')}}
                                        <input type="checkbox" checked="{{ $checked }}" onclick="notifiy_host({{ $host->user->id }})" >
                                        <span class="checkmark"></span> </label>
                                </div>
                            @endif
                        </div>





                            <div class="table-data table-data-fullwidth">
                                <ul id="filter" class="accordion">
                                    <li class="active">
                                        <?php $total_years=0; ?>
                                        @if($host->user->userCertificate->count()>0)
                                        @foreach($host->user->userCertificate as $certificate)
                                        <?php
                                                    if(is_numeric($certificate->to) && is_numeric($certificate->from))
                                                        {
                                                            $years =  abs($certificate->to -  $certificate->from);
                                                            $total_years += $years;
                                                        }
                                                        else 
                                                        {
                                                        $from = explode('-', $certificate->from);
                                                        $to = explode('-', $certificate->to);
                                                            $from = $from[0];
                                                            $to = $to[0];
                                                            $years =  abs($to -  $from);
                                                            $total_years += $years;
                                                        }
                                                       
                                                        

                                         ?>
                                        @endforeach
                                            @endif

                                            @if($host->user->userCertificate->count()>0)
                                        <h3> Professional Experience ({{ $total_years }} Years)</h3>
                                        <ul class="panel loading category-filter">
                                            <li>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="basic-table">
                                                    <tr>
                                                        <th>{{__('website.Worked as')}}
                                                        </td>
                                                        <th>{{__('website.From')}}
                                                        </td>
                                                        <th>{{__('website.To')}}
                                                        </td>
                                                        <th>{{__('website.No. years')}}
                                                        </td>
                                                        <th>{{__('website.Certificate')}}
                                                        </td>
                                                    </tr>
                                                    @foreach($host->user->userCertificate as $certificate)
                                                    <tr>
                                                        @if($certificate)
                                                        <td>{{ $certificate->name }}</td>
                                                        <td>{{ $certificate->from }}</td>
                                                        <td>{{ $certificate->to }}</td>
                                                        @php 
                                                        $years = '-';
                                                        if (strpos($certificate->from, '-') !== false) {
                                                        
                                                        $from = explode('-', $certificate->from);
                                                        $to = explode('-', $certificate->to);
                                                            $from = $from[0];
                                                            $to = $to[0];
                                                            
                                                        }
                                                        else 
                                                        {
                                                        
                                                            $from = $certificate->from;
                                                            $to = $certificate->to;
                                                        }
                                                       
                                                        
                                                        $years = abs($to -  $from); 
                                                        
                                                        @endphp
                                                        <td>{{ $years }}</td>
                                                        <td><a href="{{ $certificate->certificate_file }}" data-lightbox="image-1" data-title="My Certificate"> {{__('website.View Certificate')}}</a></td>
                                                            @endif
                                                    </tr>
                                                        @endforeach

                                                </table>
                                            </li>
                                        </ul>
                                                @endif
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row"> </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report Host</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <form action="{{ route('send_problem') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="reported_id" value="{{ $host->user_id }}" />
                    <div class="modal-body full-width">
                        <div class="rating-comment">
                            <div class="cmnt-box">
                                <label> {{__('website.Title')}} </label>
                                <input type="text" name="title" class="normal-text-box">
                            </div>
                            <div class="cmnt-box">
                                <label> {{__('website.Enter your Comment')}} </label>
                                <textarea name="problem" required>  </textarea>
                            </div>

                        </div>
                    </div>






                    <div class="modal-footer">
                        <button type="button" class="normal-btn grey-btn big-button" data-dismiss="modal">{{__('website.Close')}}</button>
                        <button type="submit" class="normal-btn blue-btn big-button">{{__('website.Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
