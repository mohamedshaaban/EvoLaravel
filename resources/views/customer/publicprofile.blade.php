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
                    <div class="left-link">
                        <ul>
                            <li class="active"> <a href="#"> {{__('website.Info')}} </a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="width: 100%;">{{ Session::get('message') }}</p>
                    @elseif(Session::has('alert'))
                        <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}" style="width: 100%;">{{ Session::get('alert') }}</p>
                    @endif
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 right-contents-left">
                            <div class="profile-info-hold">
                                <div class="profile-image"> {{ HTML::image($user->avatar) }} </div>
                                <div class="profile-details">
                                    <h1> {{ $user->name }}</h1>
                                    <div class="sub-name">
                                        <p> {{ $user->email }}</p>
                                    </div>
                                    <h2> {{__('website.Country')}} : {{ $user->customers->Country['name_'.$lang] }} </h2>
                                    @if(Auth::user())
                                        <?php
                                        $my_contacts = \App\Models\UserContacts::where('owner_id',$user->id)->where('user_id',Auth::user()->id)->first();

                                        ?>



                                    <div class="report-hold"> <a href="#" data-toggle="modal" data-target="#exampleModal"> {{__('website.Report Host')}} </a> </div>
                                    @if(!$my_contacts)
                                    <div class="adduser-hold"> <a href="#" onclick="add_contact({{ $user->id }})"> {{__('website.Add User')}} </a> </div></div>
                                @endif
                                @endif
                                </div>

                            <div class="infotext">
                                <p>{{ $user->customers->description }}</p>

                            </div>
                            <div class="table-data">
                                <ul id="filter" class="accordion">
                                    <li class="active">
                                        <h3><a class="accordion-opener" href="#open-panel"><a class="accordion-opener" href="#open-panel"> {{__('website.Status')}}</a></a></h3>
                                        <ul class="panel category-filter open" style="visibility: visible; display: block;">
                                            <li>
                                                <table class="basic-table" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tbody><tr>
                                                        <th>{{__('website.Date')}}
                                                        </th>
                                                        <th>{{__('website.Status')}}
                                                        </th>

                                                    </tr>
                                                    @foreach($user->userstatus as $events)
                                                        <tr>
                                                            <td>{{ $events->created_at }}</td>
                                                            <td>{{ $events->description }}</td>

                                                        </tr>
                                                        @endforeach



                                                    </tbody></table>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 right-contents">
                            <div class="right-profile-contact">
                                <h1> {{__('website.Social Media')}} </h1>

                            </div>
                            <div class="contact-socialmedia">
                                <ul>
                                    @foreach($user->socailMedia as $social)

                                        @if($social->type == 1 )
                                            <li><a href="{!! $social->link !!}"> <img src="/images/ins_contact.jpg"> </a> </li>
                                        @elseif ($social->type == 2 )
                                            <li><a href="{!! $social->link !!}"> <img src="/images/fb_contact.jpg"> </a> </li>
                                        @else
                                            <li><a href="{!! $social->link !!}"> <img src="/images/tw_contact.jpg"> </a> </li>
                                        @endif
                                    @endforeach




                                </ul>
                            </div>


                            <div class="right-profile-contact margin-top-30">
                                <h1> {{__('website.Badges')}} </h1>

                            </div>
                            <div class="badges-list">
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

            </div>






    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report Host</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <form action="{{ route('send_problem_cutomer') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="reported_id" value="{{ $user->id }}" />
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


    </section>
    </div>
<script>


</script>
@endsection
