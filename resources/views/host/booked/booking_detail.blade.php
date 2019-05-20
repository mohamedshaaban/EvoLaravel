@extends('layouts.app')
@section('content')
  <style>
    .accordion li li {
      color: unset;
    }

    li .row {
      border-bottom: 1px solid #9E9E9E;
      margin-bottom: 5px;
      padding-bottom: 12px
    }
  </style>
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
          @if(Auth::user()->role_id == \App\User::HOST_USER_ROLE_ID)
          @include('includes/host_leftside')
            @else
            @include('includes/customer_leftside')
          @endif
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">
          <h1>{{__('website.Booking Detail')}} </h1>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-contents-left">
              <div class="profile-info-hold">
                <div class="table-data">
                  <ul id="filter" class="accordion">
                    <li class="active">

                      <ul class="panel loading category-filter">
                        <li>
                          <div class="col-md-12"><br><br><br></div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Type</b></div>
                            <div class="col-md-9">@if($event->maintype) {{ $event->maintype->name() }}@endif</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Title (English)</b></div>
                            <div class="col-md-9">{{ $event->title_en }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Title (Arabic)</b></div>
                            <div class="col-md-9">{{ $event->title_ar }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Description (English)</b></div>
                            <div class="col-md-9">{{ $event->description_en }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Description (Arabic)</b></div>
                            <div class="col-md-9">{{ $event->description_ar }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Category</b></div>
                            <div class="col-md-9">{{ optional($event->category->parent)->name_en }}
                              / {{ $event->category->name() }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>capacity</b></div>
                            <div class="col-md-9">{{ $event->capacity }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Date & Time</b></div>
                            <div
                                class="col-md-9">{{  \Carbon\Carbon::parse($event->date_from)->format('d-M-y') .' '.date('H:i', strtotime($event->time_from)).' - '. \Carbon\Carbon::parse($event->date_to)->format('d-m-y') .' '.date('H:i', strtotime($event->time_to)) }}</div>
                          </div>
                        </li>
                        @if(!($event->age_from == 0 && $event->age_to ==0))
                          <li>
                            <div class="row">
                              <div class="col-md-3"><b>Age</b></div>
                              <div class="col-md-9">{{ $event->age_from.' - '.$event->age_to }}</div>
                            </div>
                          </li>
                        @endif
                        <li>
                          @if(Auth::user()->role_id == \App\User::HOST_USER_ROLE_ID)
                          <div class="row">
                            <div class="col-md-3 col-md-offset-3">
                              <a href="{{ route('host.my_event_ticket', $event->id) }}" class="btn violate-btn"> Tickets </a>
                            </div>
                          </div>
                          @endif
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Total Revenue</b></div>
                            <div class="col-md-9">{{ $event->location_name_ar }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Gender</b></div>
                            <div
                                class="col-md-9">{{ $event->gender==\App\Models\Event::GENDER_MALE? 'Male':($event->gender==\App\Models\Event::GENDER_FEMALE? 'Femail': 'Both') }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Location Name (English)</b></div>
                            <div class="col-md-9">{{ $event->location_name_en }}</div>
                          </div>
                        </li>
                        <li>
                          <div class="row">
                            <div class="col-md-3"><b>Location Name (Arabic)</b></div>
                            <div class="col-md-9">{{ $event->location_name_ar }}</div>
                          </div>
                        </li>
                        @if($event->multi_price)
                          @foreach($event->multiplePrice as $row)
                            <div class="col-md-offset-3 col-9">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="basic-table">
                                <tr>
                                  <th colspan="2"> {{ $row->name() }}, {{ $row->cost }} {{ $selected_currency->symbol }} /Ticket</th>
                                </tr>
                                <tr>
                                  <th>Tickets #</th>
                                  <th>Price</th>
                                </tr>
                                @foreach($row->groupPrice as $valG)
                                  <tr>
                                    <td>{{ $valG->ticket_no }} Tickets</td>
                                    <td>{{ $valG->price }} {{ $selected_currency->symbol }} </td>
                                  </tr>
                                @endforeach
                              </table>
                            </div>
                            <h3></h3>
                          @endforeach

                        @elseif($event->fee==0)
                          <ul>
                            <li>Free</li>
                          </ul>
                        @else
                          <ul>
                            <li>Fee = {{ $event->fee }}</li>
                          </ul>
                        @endif
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
