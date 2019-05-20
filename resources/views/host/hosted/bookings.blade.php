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
                  <ul class="nav nav-tabs search-tabs balance-tabs" role="tablist">
                    <div class="start-hosing-icon">
                      <a href="#">
                        <img src="{{ asset('images/start_hosting.png') }}">
                        <span>  {{__('website.Start Hosting')}}</span>
                      </a>
                    </div>

                    <li role="presentation">
                      <a href="{{ route('host.my_calendar') }}" aria-controls="activity">
                        {{__('website.Calendar')}} </a>
                    </li>
                    <li role="presentation" class="active">
                      <a href="{{ route('host.my_history_hosted') }}" aria-controls="events">
                        {{__('website.HOSTED')}} </a>
                    </li>
                    <li role="presentation">
                      <a href="{{ route('host.my_history_booked') }}" aria-controls="booking">
                        {{__('website.BOOKED')}} </a>
                    </li>
                  </ul>
                  <ul id="filter" class="accordion">

                    <li class="active">

                      <ul class="panel loading category-filter">
                        <li>
                          <form action="{{ route('host.my_history_hosted') }}">
                          <div class="col-md-3"><input class="form-control normal-text-box" value="{{ request('date', '') }}" name="date" id="datepicker" placeholder="{{__('website.Date')}}" type="text"></div>
                          <div class="col-md-3 height-limit-list">
                            <select class="js-select2-normal multiselct-list-box" placeholder="Select" multiple="multiple" data-placeholder="{{__('website.Category / Sub Categories')}}" name="cate[]">
                              @php
                                $cateID = '';
                              @endphp
                              @foreach($categories as $row)
                                @if($cateID != $row->parent->name())
                                  @if($cateID != '')
                                  </optgroup>
                                  @endif
                                  <optgroup label="{{ $cateID=$row->parent->name() }}" >
                                @endif
                                <option value="{{ $row->id }}" {{ in_array($row->id, (array) request('cate', []))? 'selected="selected"': '' }}>{{ $row->name() }}</option>
                              @endforeach
                              @if($cateID != '')
                                  </optgroup>
                              @endif
                            </select>
                          </div>
                          <div class="col-md-3 height-limit-list">
                            <select class="form-control" data-placeholder="{{__('website.Type')}}" name="type">
                              <option value="0">{{__('event.all')}}</option>
                              @php
                              $typeEvent = 0;
                              @endphp
                              @foreach(\App\Models\MainType::get() as $row)
                                @if($typeEvent != $row->event_type)
                                  @if($typeEvent != 0)
                                  </optgroup>
                                  @endif
                                  <optgroup label="{{ __('event.main_type_'.$row->event_type) }}" >
                                  @php
                                    $typeEvent = $row->event_type;
                                  @endphp
                                @endif
                                <option value="{{ $row->id }}" {{ $row->id==request('type', 0)? 'selected="selected"': '' }}>{{ $row['name_'.$lang] }}</option>
                              @endforeach
                              @if($typeEvent != 0)
                              </optgroup>
                              @endif
                            </select>
                          </div>
                          <div class="col-md-3">
                            <button type="submit" class="btn blue-btn" style="width: unset; margin: 0 5px 0px 0px; color:#fff;">{{ __('admin.filter') }}</button>
                            <a href="{{ route('host.my_history_hosted') }}" class="btn violate-btn" style="width: unset; color:#fff;">{{ __('admin.listbox.filter_clear') }}</a>
                          </div>
                          </form>
                        </li>
                        <li>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="basic-table">
                            <tr>
                              <th>{{__('website.Date')}}</th>
                              <th>{{__('website.Event Name')}}</th>
                              <th>{{__('website.Category / Sub Categories')}}</th>
                              <th>{{__('website.Type')}}</th>
                              <th></th>
                            </tr>
                            @foreach($myevents as $event)
                              <tr>
                                <td>{{  \Carbon\Carbon::parse($event->date_from)->format('d-M-y')  }}</td>
                                <td><a
                                      href="{{ route('event_details',['event_id'=>$event->id]) }}"> {{ $event['title_'.$lang]  }}</a>
                                </td>
                                <td>{{ $event->category->name() }}  </td>
                                <td>@if($event->maintype) {{ $event->maintype->name() }}@endif</td>
                                <td><a href="{{ route('host.my_booking_detail_hosted', $event->id) }}" class="btn violate-btn">
                                    {{__('website.Details')}}</a></td>
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

@section('lower_javascript')
  <script>
    $('#datepicker').datepicker();

    $('[name="cate[]"]').chosen({width: "100%"});
    $('[name="type"]').chosen({width: "100%"});
  </script>
@endsection
