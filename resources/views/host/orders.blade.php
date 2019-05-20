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
          <h1>{{__('website.Booking History')}} </h1>
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
                              <th>{{__('website.Buyer Name')}}</th>
                              <th>{{__('website.Email')}}</th>
                              <th>{{__('website.Mobile')}}</th>
                              <th>{{__('website.Payment Type')}}</th>
                              <th>{{__('website.Amount')}}</th>
                              <th>{{__('website.Date')}}</th>
                            </tr>
                            @foreach($orders as $order)
                              <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->mobile }}  </td>
                                <td>@switch($order->payment_type)
                                      @case(\App\Models\Booking::PAYMENT_TYPE_KNET)
                                  Knet
                                      @break
                                      @case(\App\Models\Booking::PAYMENT_TYPE_MASTER)
                                  MasterCard
                                    @break
                                      @case(\App\Models\Booking::PAYMENT_TYPE_VISA)
                                  Visa
                                  @endswitch</td>
                                <td>{{ $order->total }}{{ $selected_currency->symbol }}</td>
                                <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
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
        <div class="row"></div>
      </div>
    </section>
  </div>
@endsection
