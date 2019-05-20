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
          <h1> {{__('website.Calendar')}} </h1>

          <div class="tab-hold balance-details">
            <div class="full-width tab_cov">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs search-tabs balance-tabs" role="tablist">
                <div class="start-hosing-icon">
                  <a href="{{ route('event.create') }}">
                    <img src="{{ asset('images/start_hosting.png') }}">
                    <span>  {{__('website.Start Hosting')}}</span>
                  </a>
                </div>

                <li role="presentation" class="active">
                  <a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">
                    {{__('website.HOSTED')}} </a>
                </li>
                <li role="presentation">
                  <a href="#events" aria-controls="events" role="tab" data-toggle="tab">
                    {{__('website.BOOKED')}} </a>
                </li>
                <li role="presentation">
                  <a href="{{ route('host.my_history_hosted') }}" aria-controls="events" >
                    {{__('admin.list')}} </a>
                </li>
              </ul>
              <!-- /.nav_tabs -->

              <!-- Tab panes -->
              <div class="tab-content balance-buy">
                <div role="tabpanel" class="tab-pane active" id="activity">
                  <div class="ta-con activity-tab">
                    <div class="calendar-hold">
						<?php
						$calevents = array();
						?>
                      <div id="calendar" style="width: 100%; margin:30px auto"></div>
                    </div>
                  </div>
                </div>
                <!-- #home -->

                <div role="tabpanel" class="tab-pane" id="events">
                  <div class="ta-con activity-tab"></div>
                  <div id="calendar-booked" style="width: 100%; margin:30px auto"></div>
                </div>
                <!-- #profile -->

                <div role="tabpanel" class="tab-pane" id="service">
                  <div class="ta-con activity-tab">
                    <div class="balance-buying">
                      <h1>{{__('website.What_is_the_service_package,_what_you_will_gain_from_it.')}}</h1>
                      <p> {{__('website.A service enables you to generate an appointment or class. Type of services offered in Rizit  are:')}}
                      </p>
                    </div>
                    <ul>
                      <li>
                        <label class="checkbox-container">{{__('website.Appointment')}}
                          <input type="checkbox" class="pChk" name="event-types">
                          <span class="checkmark"></span> </label>
                      </li>
                      <li>
                        <label class="checkbox-container">{{__('website.Class')}}
                          <input type="checkbox" class="pChk" name="event-types">
                          <span class="checkmark"></span> </label>
                      </li>
                    </ul>
                  </div>

                  <div class="balance-buying">
                    <h1> {{__('website.Pricing and Duration')}}</h1>
                    <p> {{__('website.Buying_a_service_package_allow_the_host_an_unlimited_amount_of_service_per_month')}}</p>
                  </div>

                  <div class="form-hold">
                    <ul>
                      <li class="fullwidth-li">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-pricing-duration">
                          <tr>
                            <th>{{__('website.Services')}}:</th>
                            <th>{{__('website.Price')}} </th>
                            <th>{{__('website.Duration')}}</th>
                          </tr>
                          <tr>
                            <td>
                              <label class="checkbox-container">{{ $selected_currency->symbol }} 12</label>
                            </td>
                            <td>
                              <label class="checkbox-container">{{ $selected_currency->symbol }} 12</label>
                            </td>
                            <td>
                              <label class="checkbox-container">1 Month</label>
                            </td>
                          </tr>
                        </table>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="legend-list-hold">
       		
            <div class="legent-hold">
            		<div class="color-box" style="background-color:#ba68c8">
                    </div>
                    <div class="color-title">
                    <p>{{ __('website.Activity' )}}</p>
                    </div>
                    
            </div>
            
            
            
            <div class="legent-hold">
            		<div class="color-box" style="background-color:#f06292">
                    </div>
                    <div class="color-title">
                    <p>{{ __('website.Events' )}}</p>
                    </div>
                    
            </div>
            
            
            <div class="legent-hold">
            		<div class="color-box" style="background-color:#64b5f6">
                    </div>
                    <div class="color-title">
                    <p>{{ __('website.Services' )}}</p>
                    </div>
                    
            </div>
            
           
        </div>

          <div class="button-hold" style="margin-top:30px;">
            <button class="btn btn-secondary dropdown-toggle big-button blue-btn" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{__('website.Set your Plan')}}
            </button>
          </div>
        </div>

      </div>
    </section>
  </div>
  </section>
  </div>

  <script>
      var calevents = '';
  </script>
  @include('includes/js')

@endsection
{{-- javascript --}}

