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
                    <h1>{{__('website.Invitations')}}  </h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-contents-left">
                            <div class="profile-info-hold">
                                <div class="table-data">
                                    <ul id="filter" class="accordion">
                                        <li class="active">

                                            <ul class="panel loading category-filter">
                                                <li>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="basic-table">
                                                        <tr>
                                                            <th>{{__('website.Date')}}
                                                            </th>
                                                            <th>{{__('website.Event Name')}}
                                                            </th>
                                                            <th>{{__('website.Category / Sub Categories')}}
                                                            </th>
                                                            <th>{{__('website.Host Name')}}
                                                            </th>
                                                            <th>{{__('website.Inviatations')}}
                                                            </th>
                                                            <th>
                                                            </th>
                                                        </tr>
                                                        @foreach($myevents as $event)
                                                        <tr>
                                                            @php
                                                                $parent_category= null ;
                                                                if($event->category->category_id!= 0)
                                                                {
                                                                 $parent_category = \App\Models\Category::where('id' ,$event->category->category_id)->first();
                                                                }

                                                            @endphp
                                                            <td>{{  \Carbon\Carbon::parse($event->date_from)->format('d-M-y')  }}</td>
                                                            <td><a href="{{ route('event_details',['event_id'=>$event->id]) }}"> {{ $event['title_'.$lang]  }}</a></td>
                                                            <td>@if($parent_category){{ $parent_category['name_'.$lang] }} / @endif{{ $event->category['name_'.$lang] }}  / {{ $event->maintype['name_'.$lang] }}</td>
                                                            <td><a href="{{ route('host_profile', $event->host->user->name) }}">{{ $event->host->company_name }}</a></td>
                                                            <td>
                                                                @foreach($event->EventInvitation as $EventInvitation)
                                                                @if($EventInvitation->user_id == Auth::User()->id)
                                                                {{ $EventInvitation->email }}<br />
                                                                @endif
                                                                @endforeach
                                                                
                                                            </td>
                                                            <td><a href="{{ route('event_details',['event_id'=>$event->id]) }}"><button class="btn  violate-btn">  {{__('website.Details')}}</button></a></td>
                                                        </tr>
                                                            @endforeach
                                                    </table>
                                                </li>
                                            </ul>
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
