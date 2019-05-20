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
                    @include('includes/customer_leftside')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">
                    <h1>{{__('website.Booking History')}}  </h1>
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
                                                            <th>{{__('website.Category')}} /
                                                                {{__('website.Sub Categories')}}
                                                            </th>
                                                            <th>{{__('website.Host Name')}}
                                                            </th>
                                                            <th>
                                                            </th>
                                                        </tr>
                                                        @foreach($myevents as $event)
                                                        <tr>
                                                            @php
                                                                $parent_category= null ;
                                                                if($event->event->category->category_id!= 0)
                                                                {
                                                                 $parent_category = \App\Models\Category::where('id' ,$event->event->category->category_id)->first();
                                                                }

                                                            @endphp
                                                            <td>{{ $event->created_at }}</td>

                                                            <td><a href="{{ route('event_details',['event_id'=>$event->event->id]) }}"> {{ $event->event['title_'.$lang]  }}</a></td>
                                                            <td>@if($parent_category){{ $parent_category['name_'.$lang] }} / @endif {{ $event->event->category['name_'.$lang] }}  </td>
                                                            <td>{{ $event->event->host->user->name  }}</td>
                                                            <td><a href="{{ route('customer.my_booking_detail',['id'=>$event->id])}}"> <button class="btn  violate-btn">  {{__('website.Details')}}</button></a></td>
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
