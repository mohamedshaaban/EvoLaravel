@extends('layouts.app')
@section('content')
  <div class="full-width">
    <section class="container profile-frame-container">
      <div class="breadcrumb">
        <ul>
          <li><a href="#"> Home </a></li>
          <li><a href="#"> Home </a></li>
          <li><a href="#"> Home </a></li>
        </ul>
      </div>
      <div class="profile-hold">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 left-links-hold">
          @include('includes.host_leftside')
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">
          <h1> @lang("event.start_hosting") </h1>
          <div class="steps-wrap">
            <div class="row steps-row">
              <section>
                <div class="wizard">
                  <div class="wizard-inner eleven-steps">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="@lang("event.step_1")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.type")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="@lang("event.step_2")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.info")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="@lang("event.step_3")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.location")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="@lang("event.step_4")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.attendees")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="@lang("event.step_5")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.fees")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step6" data-toggle="tab" aria-controls="step6" role="tab" title="@lang("event.step_6")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.seating")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step7" data-toggle="tab" aria-controls="step7" role="tab" title="@lang("event.step_7")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.media")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step8" data-toggle="tab" aria-controls="step8" role="tab" title="@lang("event.step_8")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.exposure")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step9" data-toggle="tab" aria-controls="step9" role="tab" title="@lang("event.step_9")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.participants")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step10" data-toggle="tab" aria-controls="step10" role="tab" title="@lang("event.step_10")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.repeat_option")</i> </span>
                        </a>
                      </li>
                      <li role="presentation" class="disabled">
                        <a href="#step11" data-toggle="tab" aria-controls="step11" role="tab" title="@lang("event.step_11")">
                          <span class="round-tab"> <i class="glyphicon  "> @lang("event.review")</i> </span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <form id="event-form" role="form">
                    <div class="tab-content">

                      <!--  Step 1-->

                      <div class="tab-pane active" role="tabpanel" id="step1">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>  Type </h2>
                        </div>
                          <span class="invalid-feedback error-area" role="alert"></span>
                          <ul>
                            <li class="fullwidth-li cart-table-hold">
                              <table width="100%" border="0" cellspacing="0"
                                     cellpadding="0" class="table-types">
                                <tr>
                                  <th>
                                    <div class="type-icon"><img src="{{ asset('images/event_icon.png') }}">
                                      <div class="value-status"> @lang("event.event") <a href="#"> {{ auth()->user()->number_of_events ?: 0 }} </a></div>
                                    </div>
                                  </th>
                                  <th>
                                    <div class="type-icon"><img src="{{ asset('images/activity_icon.png') }}">
                                      <div class="value-status"> @lang("event.activity") <a href="#"> {{ auth()->user()->number_of_activity ?: 0  }} </a></div>
                                    </div>
                                  </th>
                                  <th>
                                    <div class="type-icon"><img src="{{ asset('images/services_icon.png') }}">
                                      <div class="value-status"> @lang("event.service") <a href="#"> {{ auth()->user()->number_of_services ?: 0}} </a></div>
                                    </div>
                                  </th>
                                </tr>
                                @foreach(range(0, max(count($mainTypeEvents), count($mainTypeActivity), count($mainTypeService))-1) as $key)
                                  <tr>
                                    <td>
                                      @if(isset($mainTypeEvents[$key]))
                                        <label class="checkbox-container">{{ $mainTypeEvents[$key]['name_'.$lang] }}
                                          @if(auth()->user()->number_of_events>0)
                                          <input type="radio" class="pChk" name="event-types" data-type="{{ \App\Models\Event::TYPE_EVENT }}" value="{{ $mainTypeEvents[$key]['id'] }}">
                                          <span class="checkmark"></span>
                                          @endif
                                        </label>
                                      @endif
                                    </td>
                                    <td>
                                      @if(isset($mainTypeActivity[$key]))
                                        <label class="checkbox-container">{{ $mainTypeActivity[$key]['name_'.$lang] }}
                                          @if(auth()->user()->number_of_activity>0)
                                          <input type="radio" class="pChk" name="event-types" data-type="{{ \App\Models\Event::TYPE_ACTIVITY }}" value="{{ $mainTypeActivity[$key]['id'] }}">
                                          <span class="checkmark"></span>
                                          @endif
                                        </label>
                                      @endif
                                    </td>
                                    <td>
                                      @if(isset($mainTypeService[$key]))
                                        <label class="checkbox-container">{{ $mainTypeService[$key]['name_'.$lang] }}
                                          @if(auth()->user()->number_of_services>0)
                                          <input type="radio" class="pChk" name="event-types" data-type="{{ \App\Models\Event::TYPE_SERVICE }}" value="{{ $mainTypeService[$key]['id'] }}">
                                          <span class="checkmark"></span>
                                          @endif
                                        </label>
                                      @endif
                                    </td>
                                  </tr>
                                @endforeach
                              </table>
                            </li>
                            <li class="fullwidth-li">
                              <button type="button" class="normal-btn blue-button big-button next-step" data-id="1"> @lang("event.next")
                              </button>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <!--  Step 2-->

                      <div class="tab-pane" role="tabpanel" id="step2">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>   Info </h2>
                        </div>
                          <span class="invalid-feedback error-area" role="alert"></span>
                          <ul>
                            <li>
                              <label>@lang("event.english_title") * </label>
                              <input type="text" class="normal-text-box" name="title_en">
                            </li>
                            <li>
                              <label>@lang("event.arabic_title") * </label>
                              <input type="text" class="normal-text-box" name="title_ar">
                            </li>
                            <li class="fullwidth-li">
                              <label>@lang("event.english_description") * </label>
                              <textarea class="normal-text-box" name="description_en"> </textarea>
                            </li>
                            <li class="fullwidth-li">
                              <label>@lang("event.arabic_description") * </label>
                              <textarea class="normal-text-box" name="description_ar"> </textarea>
                            </li>
                          </ul>
                          <ul>
                            <li class="half-li height-limit-list">
                              <label> @lang("event.category") * </label>
                              <select id="category" class="selectpicker" onchange="get_sub_category(this.value)" data-placeholder="@lang("event.select_category")">
                                <option></option>
                                @foreach($categories->filter(function($row){ return $row->category_id==0; }) as $category)
                                  <option value="{{ $category->id }}">{{ $category->name() }}</option>
                                @endforeach
                              </select>
                            </li>
                            <li class="half-li height-limit-list" >
                              <label> @lang("event.sub_category") * </label>
                               
                              <select id="subcategory" name="category" class="selectpicker"  data-placeholder="@lang("event.select_sub_category")">
                              <option> </option>
                              </select>
                                
                            </li>
                          </ul>
                          <ul>
                            <li>
                              <label for="from">@lang("From") *</label>
                              <input type="text" id="from" name="date_from" class="normal-text-box">
                            </li>
                            <li>
                              <label for="to">@lang("event.to") *</label>
                              <input type="text" id="to" name="date_to" class="normal-text-box">
                            </li>
                          </ul>
                          <ul>
                            <div class="chkbox-label"> @lang("event.working_hours") </div>
                            <li class="half-half-li height-limit-list">
                              <label> @lang("event.from")  </label>
                              @php 
                              date_default_timezone_set("Europe/London");
                                    $range=range(strtotime("00:00"),strtotime("24:00"),30*60);
                                  
                              @endphp
                              <select name="time_from" class="selectpicker">
                                @foreach($range as $time)
                                  <option value="{{  date("H:i",$time) }}">{{  date("H:i",$time) }}</option>
                                @endforeach
                              </select>
                            </li>
                            <li class="half-half-li height-limit-list">
                              <label> @lang("event.to") </label>
                              <select name="time_to" class="selectpicker">
                                @foreach($range as $time)
                                  <option value="{{  date("H:i",$time) }}">{{  date("H:i",$time) }}</option>
                                @endforeach
                              </select>
                            </li>
                          </ul>
                          <ul>
                            <div class="chkbox-label"> @lang("event.break_hours_if_statement")
                            </div>
                            <li class="half-half-li height-limit-list">
                              <label> @lang("event.from")  </label>
                              <select name="break_from" class="selectpicker">
                                
                                @foreach($range as $time)
                                  <option value="{{  date("H:i",$time) }}">{{  date("H:i",$time) }}</option>
                                @endforeach
                              </select>
                            </li>
                            <li class="half-half-li height-limit-list">
                              <label> @lang("event.to") </label>
                              <select name="break_to" class="selectpicker">
                                @foreach($range as $time)
                                  <option value="{{  date("H:i",$time) }}">{{  date("H:i",$time) }}</option>
                                @endforeach
                              </select>
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button" class="normal-btn grey-button big-button prev-step"> @lang("event.back") </button>
                              <button type="button" class="normal-btn blue-button big-button next-step" data-id="2"> @lang("event.next") </button>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <!--  Step 3-->

                      <div class="tab-pane" role="tabpanel" id="step3">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>   Location </h2>
                        </div>
                          <span class="invalid-feedback error-area" role="alert"></span>
                          <ul>
                            <li>
                              <label>@lang("event.location_name_english") *</label>
                              <input type="text" name="location_name_en" class="normal-text-box">
                            </li>
                            <li>
                              <label>@lang("event.location_name_arabic") </label>
                              <input type="text" name="location_name_ar" class="normal-text-box">
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li">
                              <div class="map-width">
                                <div class="map_canvas"></div>
                                <input name="address_lat" id="address_lat" type="hidden">
                                <input name="address_long" id="address_long" type="hidden">
                              </div>
                            </li>
                            <li class="fullwidth-li">
                              <input class="normal-text-box" id="geocomplete" name="address_text" type="text" placeholder="Type in an address" size="90"/>
                            </li>
                          </ul>
                          <ul>
                            <li>
                              <label> @lang("event.country") * </label>
                              <select name="address_country" id="country" class="selectpicker">
                                <option></option>
                                @foreach(\App\Models\Country::all() as $country)
                                  <option value="{{ $country->id }}">{{ $country->name() }}</option>
                                @endforeach
                              </select>
                            </li>
                            <li>
                              <label> @lang("event.city") * </label>
                              <select name="address_city" id="city" class="selectpicker">
                                <option></option>
                                @foreach(\App\Models\Country::where('id', auth()->user()->country_id? :116)->first()->cities()->get() as $city)
                                  <option value="{{ $city->id }}">{{ $city->name() }}</option>
                                @endforeach
                              </select>
                            </li>
                            <li>
                              <label>@lang("event.block") </label>
                              <input name="address_block" type="text" class="normal-text-box">
                            </li>
                            <li>
                              <label>@lang("event.street") *</label>
                              <input name="address_street" type="text" class="normal-text-box">
                            </li>
<!--                            <li>
                              <label>@lang("event.avenue") </label>
                              <input name="address_avenue" type="text" class="normal-text-box">
                            </li>-->
                            <li>
                              <label>@lang("event.building_house") *</label>
                              <input name="address_building" type="text" class="normal-text-box">
                            </li>
                            <li>
                              <label>@lang("event.floor") </label>
                              <input name="address_floor" type="text" class="normal-text-box">
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button" class="normal-btn grey-button big-button prev-step">@lang("event.back")</button>
                              <button type="button" class="normal-btn blue-button big-button next-step" data-id="3"> @lang("event.next")</button>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <!--  Step 4-->

                      <div class="tab-pane" role="tabpanel" id="step4">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>    Attendees </h2>
                        </div>
                          <span class="invalid-feedback error-area" role="alert"></span>
                          <ul class="ul-border">
                            <div class="chkbox-label"> @lang("event.age_group") *</div>
                            <li class="half-half-li">
                              <label> @lang("event.from") * </label>
                              <select name="age_from" id="age_from" class="selectpicker">
                                <option value="0">@lang("event.all")</option>
                                @foreach(range(0, 65) as $key)
                                  <option>{{ $key }}</option>
                                @endforeach
                              </select>
                            </li>
                            <li class="half-half-li">
                              <label> @lang("event.to") * </label>
                              <select name="age_to" id="age_to" class="selectpicker">
                                <option value="0">@lang("event.all")</option>
                                @foreach(range(0, 65) as $key)
                                  <option>{{ $key }}</option>
                                @endforeach
                              </select>
                            </li>
                            <li>
                              <label> @lang("event.gender_group") * </label>
                              <select name="gender" class="selectpicker">
                                <option selected="selected"
                                        value="{{ \App\Models\Event::GENDER_BOTH }}">@lang("event.both")</option>
                                <option value="{{ \App\Models\Event::GENDER_MALE }}">@lang("event.male")</option>
                                <option value="{{ \App\Models\Event::GENDER_FEMALE }}">@lang("event.female")</option>
                              </select>
                            </li>
                            <li>
                              <div class="chkbox-label"> @lang("event.private_public_listing")</div>
                              <div class="chkbox-container-hold">
                                <label class="checkbox-container">@lang("event.make_attendees_list_private")
                                  <input type="checkbox" name="attendees_listing" value="1"/>
                                  <span class="checkmark"></span> </label>
                              </div>
                            </li>
                          </ul>
                          
                          <ul class="ul-border">
                            <li>
                              <div class="chkbox-label"> @lang("event.cancellation") *</div>
                              <div class="chkbox-container-hold">
                                <label class="checkbox-container">@lang("event.yes")
                                  <input type="radio" name="cancellation" value="1" checked="checked">
                                  <span class="checkmark"></span> </label>
                                <label class="checkbox-container" checked="checked">@lang("event.no")
                                  <input type="radio" name="cancellation" value="0">
                                  <span class="checkmark"></span> </label>
                              </div>
                            </li>
                            <li>
                              <label for="to">@lang("event.cancellation_days") *</label>
                              <input type="number" name="cancellation_days" class="normal-text-box numeric"
                                     placeholder="@lang("event.enter_a_number")" value="0">
                            </li>
                            <li>
                              <div class="chkbox-label"> @lang("event.generate_qr_code")</div>
                              <div class="chkbox-container-hold">
                                <label class="checkbox-container">@lang("event.generate")
                                  <input name="make_qr_code" type="checkbox" value="1">
                                  <span class="checkmark"></span> </label>
                              </div>
                            </li>
                          </ul>
                          <ul  class="ul-border">
                            <li class="fullwidth-li">
                              <div class="chkbox-label"> @lang("event.data_required_from_the_attendee") </div>
                              <div class="profession-list-hold">
                                @foreach($requireData as $row)
                                  <label class="checkbox-container">{{ $row->name() }}
                                    <input type="checkbox" name="require_data_id_{{ $row->id }}" value="{{ $row->id }}">
                                    <span class="checkmark"></span> </label>
                                @endforeach
                              </div>
                            </li>
                            <li class="fullwidth-li">
                              <label class="checkbox-container">@lang("event.cannot_find_the_data")
                                <input type="checkbox" class="pChk" name="require_data_more" value="1">
                                <span class="checkmark"></span> </label>
                              <div id="optional-profession" class="fullwidth-li"
                                   style="min-height:auto; margin-bottom:20px;">
                                {{--TODO: Data required not implement --}}
                                <label>@lang("event.data_required") </label>
                                <input type="text" class="normal-text-box" style="max-width:200px;"
                                       name="require_data_extra">
                              </div>
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button"
                                      class="normal-btn grey-button big-button prev-step">@lang("event.back")</button>
                              <button type="button" class="normal-btn blue-button big-button next-step"
                                      data-id="4"> @lang("event.next")</button>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <!--  Step 5-->

                      <div class="tab-pane" role="tabpanel" id="step5">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>    Fees </h2>
                        </div>
                          <span class="invalid-feedback error-area" role="alert"></span>
                          <ul>
                            <li>
                              <div class="chkbox-label"></div>
                              <div class="chkbox-container-hold">
                                <label class="checkbox-container">@lang("event.fee")
                                  <input type="radio" name="fee_type" class="fee-event" value="1">
                                  <span class="checkmark"></span> </label>
                                <label class="checkbox-container">@lang("event.free")
                                  <input type="radio" checked="checked" name="fee_type" class="free-event" value="2">
                                  <span class="checkmark"></span> </label>
                              </div>
                            </li>
                          </ul>
                          <ul class="pattern-options ul-border" style="display:none">
                            <li class="fullwidth-li">
                              <div class="chkbox-label"> @lang("event.pricing_pattern")</div>
                              <div class="chkbox-container-hold">
                                <label class="checkbox-container">@lang("event.single_price")
                                  <input type="radio" checked="checked" name="multi_price" class="single-pattern"
                                         value="0">
                                  <span class="checkmark"></span> </label>
                                <label
                                    class="checkbox-container">@lang("event.multiple_pricing_require_more_than_one_price")
                                  <input type="radio" name="multi_price" class="multi-pattern" value="1">
                                  <span class="checkmark"></span> </label>
                              </div>
                            </li>
                          </ul>
                          <ul id="its-single" class="pattern-options ul-border" style="display:none">
                            <li>
                              <label>@lang("event.price") *</label>
                              <input type="text" name="fee" class="normal-text-box decimal">
                            </li>
                            <li>
                              <label> </label>
                              <p> {{ $selected_currency->symbol }} </p>
                            </li>
                          </ul>
                          <ul style="display:none" id="its-multi" class="ul-border">
                            <li class="fullwidth-li">
                              <div class="multiple-pricing-hold">
                                <div class="number-selection">
                                  <label> @lang("event.select_number_of_sections") </label>
                                  <select name="" class="selectpicker section-select" style="max-width:200px">
                                    @foreach(range(1, 15) as $row)
                                      <option value="{{ $row }}">{{ $row }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="pricing-list">
                                  <ol class="section-appendto">
                                    <li class="repete-li">
                                      <div class="pricing-row">
                                        <div class="pricing-item">
                                          <label>@lang("event.section_name_english")</label>
                                          <input type="text" name="event_multiple_price_name_en[1]"
                                                 class="normal-text-box">
                                        </div>
                                        <div class="pricing-item">
                                          <label>@lang("event.section_name_arabic")</label>
                                          <input type="text" name="event_multiple_price_name_ar[1]"
                                                 class="normal-text-box">
                                        </div>
                                        <div class="pricing-item kwd-before">
                                          <label>@lang("event.cost")</label>
                                          <input type="text" name="event_multiple_price_cost[1]"
                                                 class="normal-text-box decimal">
                                        </div>
                                      </div>
                                    </li>
                                  </ol>
                                </div>
                              </div>
                            </li>
                          </ul>
                          <ul style="display:none" id="its-multi-group">
                            <div class="chkbox-label"> @lang("event.Groups"):</div>
                            <li class="fullwidth-li">
                              <div class="multiple-pricing-hold">
                                <div class="number-selection">
                                  <label> @lang("event.select_number_of_sections") </label>
                                  <select name="event_group_price" class="selectpicker group-select"
                                          style="max-width:200px">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                  </select>
                                </div>
                                <div class="pricing-list">
                                  <ol class="section-appendto2">
                                    <li class="repete-li2">
                                      <div class="pricing-row">
                                        <div class="pricing-item">
                                          <label> @lang("event.select_price") </label>
                                          <select name="event_group_price_price_type_id[1]" class="selectpicker">
                                            <option value="1">1</option>
                                          </select>
                                        </div>
                                        <div class="pricing-item">
                                          <label> @lang("event.number_of_tickets") </label>
                                          <select name="event_group_price_ticket_no[1]" class="selectpicker">
                                              @for($i = 2 ; $i< 100;$i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                          </select>
                                        </div>
                                        <div class="pricing-item kwd-before">
                                          <label>@lang("event.group_price")</label>
                                          <input type="text" name="event_group_price_price[1]"
                                                 class="normal-text-box decimal">
                                        </div>
                                      </div>
                                    </li>
                                  </ol>
                                </div>
                              </div>
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button"
                                      class="normal-btn grey-button big-button prev-step">@lang("event.back")</button>
                              <button type="button" class="normal-btn blue-button big-button next-step"
                                      data-id="5"> @lang("event.next")</button>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <!--  Step 6-->

                      <div class="tab-pane" role="tabpanel" id="step6">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>    Seatings </h2>
                        </div>
                          <span class="invalid-feedback error-area" role="alert"></span>
                          <ul class="ul-border">
                            <li>
                              <div class="chkbox-label"> @lang("event.seating") *</div>
                              <div class="chkbox-container-hold">
                                <label class="checkbox-container"  title="@lang("event.seating_assigned_option")">@lang("event.assigned")
                                  <input type="radio" name="seating_booking_type"
                                         title="@lang("event.seating_assigned_option")"
                                         value="{{ \App\Models\Event::SEATING_BOOKING_TYPE_ASSIGNED }}">
                                  <span class="checkmark"></span> </label>
                                <label class="checkbox-container">@lang("event.random")
                                  <input type="radio" name="seating_booking_type" checked="checked"
                                         value="{{ \App\Models\Event::SEATING_BOOKING_TYPE_RANDOM }}">
                                  <span class="checkmark"></span> </label>
                              </div>
                            </li>
                            <li class="half-half-li height-limit-list">
                              <label> @lang("event.bookings_per_user") * </label>
                              <select name="booking_per_user" class="selectpicker">
                                @foreach(range(1, 21) as $key)
                                  <option value="{{ $key }}">{{ $key }}</option>
                                @endforeach
                              </select>
                            </li>
                            <li>
                              <label for="to">@lang("event.maximum_attendees_allowed") *</label>
                              <input type="text" id="to" name="capacity" class="normal-text-box"
                                     placeholder="@lang("event.enter_a_number")">
                            </li>
                          </ul >
                          <ul class="ul-border">
                            <li>
                              <label for="location_id"> @lang("event.location") * </label>
                              <select name="location_id" id="location_id" class="selectpicker">
                                <option value="0"></option>
                                @foreach($locations=\App\Models\Location::with('venues')->get() as $location)
                                  <option value="{{ $location->id }}">{{ $location['name_'.$lang] }}</option>
                                @endforeach
                              </select>
                            </li>
                            <!--Commented based on customer requirement-->
<!--                            <li>
                              <label for="venue_id"> @lang("event.venue") * </label>
                              <select name="venue_id" id="venue_id" class="selectpicker"></select>
                            </li>-->
                          </ul>

<!--                          <ul class="ul-border">
                            <li>
                              <label>@lang('event.if_venue_not_available_add_venu_below')</label>
                              <input type="text" id="add_venue" name="add_venue" class="normal-text-box">
                            </li>
                          </ul>-->


                          <div class="row col-xs-12">
                            <ul class="generateMap col-xs-12">
                              <li>
                                <div class="chkbox-label"></div>
                                <div class="chkbox-container-hold">
                                  <label class="checkbox-container">@lang("event.upload_seatmap")
                                    <input type="radio" name="use_seatmap" class="fee-event" value="1">
                                    <span class="checkmark"></span> </label>
                                  <label class="checkbox-container">@lang("event.without_seatmap")
                                    <input type="radio" checked="checked" name="use_seatmap" class="free-event" value="0">
                                    <span class="checkmark"></span> </label>
                                </div>
                              </li>
                            </ul>
                          </div>

                          <!--SEAT MAP HTML-->
                          <div class="row col-xs-12 ul-border" id="seatmap-container" style="display: none;">
                            <ul class="generateMap col-xs-12">
                              <li>
                                <label>@lang('event.upload_seatmap')</label>
                                <div class="upload-btn-wrapper">
                                  <button class="normal-btn blue-button">@lang('event.browse') </button>
                                  <input id="seatMapImg" type="file" class="upload-certificate" name="seat_map_img" />
                                  <div class="filename-certificate"></div>
                                </div>
                              </li>
                              <li>
                                <label>@lang('event.seats_in_each_row')</label>
                                <input id="seatRows" placeholder="rows" name="rows" class="form-control" type="number" />
                              </li>
                              <li>
                                <label>@lang('event.seatmap_columns')</label>
                                <input id="seatcols" placeholder="columns" name="cols" class="form-control" type="number" />
                              </li>
                              <input type="hidden" id="seatmapInput" name="seatmap" value="" />
                            </ul>
                            <ul class="generateMap generateSubmit col-xs-12">
                              <li>
                                <button id="gBtn" type="button" class="normal-btn blue-button"> @lang('event.generate') </button>
                              </li>
                            </ul>

                            <div class="propertyMapNext col-xs-12 padd0">

                              <div class="row col-xs-12">
                                <button id="bgBtn" class="right normal-btn blue-button" type="button" style="display: none;"> << @lang('event.generate_seatmap') </button>
                                <button id="nBtn" class="left normal-btn blue-button" type="button" style="display: none;">  @lang('event.types_color_next') >> </button>
                              </div>
                              <div id="map-container" class="right"></div>
                            </div>

                            <div class="propertyMapDone right col-xs-12 padd0" style="display: none;">
                              <div class="row col-xs-12">
                                <button id="bnBtn" class="right normal-btn blue-button" type="button"> << @lang('event.seatmap_settings') </button>
                                <button id="dBtn" class="left normal-btn blue-button" type="button"> @lang('event.save_seat_map') </button>
                              </div>

                              <div class="row col-xs-12">
                                <h3 class="seatChart-title">@lang('event.choose_each_price_type_color'):</h3>
                                <ul id="chosenPriceTypeColor"></ul>
                              </div>

                              <div class="right">

                              </div>
                            </div>
                          </div>
                          <!--END SEAT MAP HTML-->

                          <ul>
                            <li class="fullwidth-li">
                              <button type="button"
                                      class="normal-btn grey-button big-button prev-step">@lang("event.back")</button>
                              <button type="button" class="normal-btn blue-button big-button next-step"
                                      data-id="6"> @lang("event.next")</button>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <!--  Step 7-->

                      <div class="tab-pane" role="tabpanel" id="step7">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>    Media </h2>
                        </div>
                          <span class="invalid-feedback error-area" role="alert"></span>
                          <ul>
                            <li>
                              <label>@lang("event.main_picture") *</label>
                              <div class="upload-btn-wrapper">
                                <button class="normal-btn blue-button">@lang("event.browse")</button>
                                <input type="file" class="upload-certificate" id="main-pic"/>
                                <input type="hidden" name="main-pic">
                                <div class="filename-certificate"></div>
                              </div>
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li ul-border">
                              <div class="multiple-pricing-hold">
                                <div class="pricing-list">
                                  <ol class="section-appendto3">
                                    <li class="repete-li3">
                                      <div class="pricing-row">
                                        <div class="pricing-item">
                                          <label>@lang("event.upload_pictures")</label>
                                          <div class="upload-btn-wrapper">
                                            <button class="normal-btn blue-button">@lang("event.browse")</button>
                                            <input type="file" class="upload-certificate myfile"/>
                                            <input type="hidden" name="myfiles[]">
                                            <div class="filename-certificate"></div>
                                          </div>
                                        </div>
                                        <div class="pricing-item">
                                          <label>@lang("event.picture_caption")</label>
                                          <input type="text" name="files_caption[]" class="normal-text-box">
                                        </div>
                                      </div>
                                    </li>
                                  </ol>
                                </div>
                                <label> @lang("Add more Pictures") </label>
                                <a class="normal-btn blue-button small-add-btn add-pic"> + </a></div>
                            </li>
                            <li class="fullwidth-li ul-border">
                              <div class="multiple-pricing-hold">
                                <div class="pricing-list">
                                  <ol class="section-appendto4 ">
                                    <li class="repete-li4">
                                      <div class="pricing-row">
                                        <div class="pricing-item">
                                          <label>@lang("event.video_link")</label>
                                          <input type="text" name="video_link[]" class="normal-text-box">
                                        </div>
                                        <div class="pricing-item">
                                          <label>@lang("event.video_caption")</label>
                                          <input type="text" name="video_caption[]" class="normal-text-box">
                                        </div>
                                      </div>
                                    </li>
                                  </ol>
                                </div>
                                <label> @lang("event.add_more_videos") </label>
                                <a class="normal-btn blue-button small-add-btn add-vid"> + </a></div>
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button"
                                      class="normal-btn grey-button big-button prev-step">@lang("event.back")</button>
                              <button type="button" class="normal-btn blue-button big-button next-step"
                                      data-id="7"> @lang("event.next")</button>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <!--  Step 8-->

                      <div class="tab-pane" role="tabpanel" id="step8">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>    Exposure </h2>
                        </div>
                          <span class="invalid-feedback error-area" role="alert"></span>
                          <ul>
                            <li>
                              <div class="chkbox-label"> @lang("event.private_public")</div>
                              <div class="chkbox-container-hold">
                                <label
                                    class="checkbox-container">@lang("event.make_this_event_activity_service_private")
                                  <input type="checkbox" name="private_event" value="1"/>
                                  <span class="checkmark"></span> </label>
                              </div>
                            </li>
                          </ul>
                          <ul>
                            <li class="half-width">
                              <label>@lang("event.send_invitations") </label>
                              <input type="text" name="item" id="add" class="normal-text-box"
                                     placeholder="@lang("event.enter_the_user_professional_invite")">
                            </li>

                            <li class="fullwidth-li">
                              <div class="inv-collection-hold">
                                <ul id="list" class="list-group">
                                </ul>
                              </div>
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button"
                                      class="normal-btn grey-button big-button prev-step">@lang("event.back")</button>
                              <button type="button" class="normal-btn blue-button big-button next-step"
                                      data-id="8"> @lang("event.next")</button>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <!--  Step 9-->

                      <div class="tab-pane" role="tabpanel" id="step9">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>    Participants </h2>
                        </div>
                          <div class="add-list-container ul-border ">
                            <span class="invalid-feedback error-area" role="alert"></span>
                            <ul>
                              <li class="half-width">
                                <label>@lang("event.add_professionals") </label>
                                <input type="text" name="item" id="add-pro" class="normal-text-box"
                                       placeholder="@lang("event.enter_professional_s_name")">
                              </li>
                            </ul>
                            <ul>
                              <div class="chkbox-label"> @lang("event.if_the_professional_is_not_available")</div>
                              <li class="half-width">
                                <label>@lang("event.new_professional_name")</label>
                                <input type="text" name="item" id="add-pro-new" class="normal-text-box"
                                       placeholder="@lang("event.type_professional_name")">
                              </li>
                              <li>
                                <label>@lang("event.upload_picture")</label>
                                <div class="upload-btn-wrapper">
                                  <button class="normal-btn blue-button">@lang("event.browse")</button>
                                  <input type="file" class="upload-certificate" name="myfile-pro"/>
                                  <div class="filename-certificate"></div>
                                </div>
                              </li>
                              <li class="half-half-li">
                                <label> </label>
                                <input type="button" id="addbtn-pro-new" value=" @lang("event.add_to_list")"
                                       class="normal-btn blue-button"/>
                              </li>
                              <li class="fullwidth-li">
                                <div class="inv-collection-hold">
                                  <ul id="list-pro" class="list-group">
                                    <h1> @lang("event.professionals") </h1>
                                  </ul>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="add-list-container ul-border ">
                            <ul>
                              <li class="half-width">
                                <label>@lang("event.add_groups_companies")</label>
                                <input type="text" name="item" id="add-gro" class="normal-text-box"
                                       placeholder="@lang("event.enter_the_vendor_s_name")">
                              </li>
                            </ul>
                            <ul>
                              <div class="chkbox-label">@lang("event.if_the_groups_companies_are_not_available")</div>
                              <li class="half-width">
                                <label>@lang("event.new_vendor_name")</label>
                                <input type="text" name="item" id="add-gro-new" class="normal-text-box"
                                       placeholder="@lang("event.type_company_name")">
                              </li>
                              <li>
                                <label>@lang("event.upload_picture")</label>
                                <div class="upload-btn-wrapper">
                                  <button class="normal-btn blue-button">@lang("event.browse")</button>
                                  <input type="file" class="upload-certificate" name="myfile-gro"/>
                                  <div class="filename-certificate"></div>
                                </div>
                              </li>
                              <li class="half-half-li">
                                <label> </label>
                                <input type="button" id="addbtn-gro-new" value=" @lang("event.add_to_list")"
                                       class="normal-btn blue-button"/>
                              </li>
                              <li class="fullwidth-li">
                                <div class="inv-collection-hold">
                                  <ul id="list-gro" class="list-group">
                                    <h1> @lang("event.groups_companies") </h1>
                                  </ul>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="add-list-container ul-border ">
                            <ul>
                              <li class="half-width">
                                <label>@lang("event.add_sponsors")</label>
                                <input type="text" name="item" id="add-spo" class="normal-text-box"
                                       placeholder="@lang("event.enter_the_sponsor_s_name")">
                              </li>
                            </ul>
                            <ul>
                              <div class="chkbox-label"> @lang("event.if_the_sponsor_are_not_available")</div>
                              <li class="half-width">
                                <label>@lang("event.new_sponsor_s_name")</label>
                                <input type="text" name="item" id="add-spo-new" class="normal-text-box"
                                       placeholder="@lang("event.type_vendor_name")">
                              </li>
                              <li>
                                <label>@lang("event.upload_picture")</label>
                                <div class="upload-btn-wrapper">
                                  <button class="normal-btn blue-button">@lang("event.browse")</button>
                                  <input type="file" class="upload-certificate" name="myfile-spo"/>
                                  <div class="filename-certificate"></div>
                                </div>
                              </li>
                              <li class="half-half-li">
                                <label> </label>
                                <input type="button" id="addbtn-spo-new" value=" @lang("event.add_to_list")"
                                       class="normal-btn blue-button"/>
                              </li>
                              <li class="fullwidth-li">
                                <div class="inv-collection-hold">
                                  <ul id="list-spo" class="list-group">
                                    <h1> @lang("event.sponsors")</h1>
                                  </ul>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button"
                                      class="normal-btn grey-button big-button prev-step">@lang("event.back")</button>
                              <button type="button" class="normal-btn blue-button big-button next-step"
                                      data-id="9">@lang("event.save")</button>
                            </li>
                          </ul>
                        </div>
                      </div>


                      <!--  Step 10-->

                      <div class="tab-pane" role="tabpanel" id="step10">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>    Repeat </h2>
                        </div>
                        <span class="invalid-feedback error-area" role="alert"></span>
                          <ul>
                            <li>
                              <div class="chkbox-label"> @lang("event.repeat_option")</div>
                              <div class="chkbox-container-hold">
                                <label
                                    class="checkbox-container">@lang("event.repeat_hosting")
                                  <input type="checkbox" name="repeat" id="repeat" value="1"/>
                                  <span class="checkmark"></span> </label>
                              </div>
                            </li>
                          </ul>
                          <ul id="repeat_section" style="display: none;">
                            <li class="half-width">
                              <label>@lang("event.the_number_of_times") </label>
                              <select name="repeat_count" id="repeat_count" class="form-control">
                                <option>1</option>
                              </select>
                            </li>

                            <li class="fullwidth-li">
                              <ul id="repeat_container">
                                  <li class="fullwidth-li"><label>#1</label><input type="text" data-id="1" name="repeat_date[!]" class="normal-text-box datepicker"></li>
                              </ul>
                            </li>
                          </ul>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button"
                                      class="normal-btn grey-button big-button prev-step">@lang("event.back")</button>
                              <button type="button" class="normal-btn blue-button big-button next-step"
                                      data-id="9">@lang("event.save")</button>
                            </li>
                          </ul>
                        </div>
                      </div>


                      <!--  Step 11 -->

                      <div class="tab-pane" role="tabpanel" id="step11">
                        <div class="form-hold">
                        <div class="step-head">
                        <h2>    Review </h2>
                        </div>
                          <ul id="eventNews"></ul>
                          <ul>
                            <li class="fullwidth-li">
                              <button type="button" class="normal-btn grey-button big-button"
                                      id="closebtn">@lang("event.close")</button>
                              <button type="button" class="normal-btn blue-button big-button"
                                      id="livebtn">@lang("event.live_preview")</button>
                              <button type="button" class="normal-btn blue-button big-button"
                                      id="publishbtn">@lang("event.publish")</button>

                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </form>
                </div>
              </section>
            </div>
          </div>
        </div>
        <div class="row"></div>
      </div>
    </section>
  </div>

@endsection

@section('lower_javascript')

  <script type="text/javascript" src="{{ asset('js/seatchart.js') }}"></script>
  <script>
      
      $('#country').change(function(){
  var data= $(this).val();
  
  $('#city').empty();

            var newOption = $('<option value="">{{ __('website.Select Country') }}</option>');
                    $('#city').append(newOption);
                    
                      $_token = "<?php echo e(csrf_token(), false); ?>";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "<?php echo route('get_cities') ; ?>",
            type: 'POST',
            cache: false,
            data: {'type':data, '_token': $_token }, //see the $_token
            // datatype: 'html',
            beforeSend: function() {
                //something before send



            },
            success: function(data) {
                data.forEach(function(entry) {

                    var newOption = $('<option value="'+entry.id+'">'+entry.name_en+'</option>');
                    $('#city').append(newOption);

                });
                $('#city').trigger('liszt:updated');
            }
        });
  
  
});
      
$('#age_from').change(function(){
  var data= $(this).val();
  $('#age_to').empty();
  if(data == 0 )
  {
      $("#age_to").append($("<option>").attr("value", 0).text("All"));
               for(i = 1; i < 65; i++)
               {
                   $("#age_to").append($("<option>").attr("value", i).text(i));
               }
  }
  else 
  {
               for(i = parseInt(data)+1; i < 65; i++)
               {
                   $("#age_to").append($("<option>").attr("value", i).text(i));
               }
              
  }
  $('#age_to').trigger('liszt:updated');
});
      String.prototype.isEmpty = function () {
          return this.trim() == "" || this == 'null';
      };

      function setError(_errNo, _html) {
          if (typeof _html == "string") {
              $('#step' + _errNo + ' span.error-area').html(_html);
              return;
          }
          $('#step' + _errNo + ' span.error-area').append(_html);
      }

      $('#event-form').submit(function(e){
          e.defaultPrevented();
          return false;
      });

      $('button.next-step').click(function () {

          var _stepID = $(this).data('id');
          var $_step = $('#step' + _stepID);

          setError(_stepID, "");

          // debugger;

          switch (_stepID) {
              case 1:
                  if ($_step.find('input[name="event-types"]:checked').length == 0) {
                      swal("", "@lang("event.please_fill_in_the_required_fields")", "error");
                      setError(_stepID, "<strong>@lang("event.you_have_to_select_type")</strong><br>");
                      return;
                  }
                  nextStep();
                  break;

              case 2:
                  $errors = [];

                  if (String($_step.find('input[name="title_en"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.english_title_is_required")'));
                      $errors.push("<br />");
                  }

                  if (String($_step.find('input[name="title_ar"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.arabic_title_is_required")'));
                      $errors.push("<br />");
                  }

                  if (String($_step.find('input[name="description_en"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.english_description_is_required")'));
                      $errors.push("<br />");
                  }

                  if (String($_step.find('input[name="description_ar"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.arabic_description_is_required")'));
                      $errors.push("<br />");
                  }

                  if ($('#subcategory').val() == null) {
                      $errors.push($("<strong>").text('@lang("event.sub_category_is_required")'));
                      $errors.push("<br />");
                  }

                  if (String($('input[name="date_from"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.hosting_from_date_is_required")'));
                      $errors.push("<br />");
                  }

                  if (String($('input[name="date_to"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.hosting_to_date_is_required")'));
                      $errors.push("<br />");
                  }

                  if (parseInt($('select[name="time_from"]').val()) > parseInt($('select[name="time_to"]').val())) {
                      $errors.push($("<strong>").text('@lang("event.working_hours_range_is_not_correct")'));
                      $errors.push("<br />");
                  }

                  if (!(parseInt($('select[name="break_from"]').val()) == 0 || parseInt($('select[name="break_to"]').val()) == 0)
                      &&(
                          parseInt($('select[name="break_from"]').val()) >= parseInt($('select[name="break_to"]').val())
                          ||
                          parseInt($('select[name="break_from"]').val()) >= parseInt($('select[name="time_to"]').val())
                          ||
                          parseInt($('select[name="break_to"]').val()) >= parseInt($('select[name="time_to"]').val()))
                  )
                  {



                      $errors.push($("<strong>").text('@lang("event.break_time_range_is_not_correct")'));
                      $errors.push("<br />");

                  }

                  if ($errors.length > 0) {
                      setError(_stepID, $errors);
                      swal("", "@lang("event.please_fill_in_the_required_fields")", "error");
                      return;
                  }

                  nextStep();
                  break;

              case 3:

                  $errors = [];

                  if (String($_step.find('input[name="location_name_en"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.english_location_name_is_required")'));
                      $errors.push("<br />");
                  }

                  if (String($_step.find('input[name="location_name_ar"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.arabic_location_name_is_required")'));
                      $errors.push("<br />");
                  }

                  if (String($('#address_lat').val()).isEmpty()
                      || String($('#address_long').val()).isEmpty()
                      || String($('#geocomplete').val()).isEmpty()
                  ) {
                      $errors.push($("<strong>").text('@lang("event.select_location_is_required")'));
                      $errors.push("<br />");
                  }



                  if (String($_step.find('select[name="address_city"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.city_is_required")'));
                      $errors.push("<br />");
                  }

                {{--if (String($_step.find('input[name="address_block"]').val()).isEmpty()) {--}}
                    {{--$errors.push($("<strong>").text('@lang("event.block_field_is_required")'));--}}
                    {{--$errors.push("<br />");--}}
                    {{--}--}}

                if (String($_step.find('input[name="address_street"]').val()).isEmpty()) {
                    $errors.push($("<strong>").text('@lang("event.street_field_is_required")'));
                    $errors.push("<br />");
                }

                  if (String($_step.find('input[name="address_building"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.building_house_is_required")'));
                      $errors.push("<br />");
                  }

                  if ($errors.length > 0) {
                      setError(_stepID, $errors);
                      swal("", "@lang("event.please_fill_in_the_required_fields")", "error");
                      return;
                  }

                  nextStep();
                  break;

              case 4:
                  $errors = [];


                  if (!(parseInt($('select[name="age_from"]').val()) == 0 || parseInt($('select[name="age_to"]').val()) == 0) &&
                      parseInt($('select[name="age_from"]').val()) >= parseInt($('select[name="age_to"]').val())) {
                      $errors.push($("<strong>").text('@lang("event.age_range_is_not_correct")'));
                      $errors.push("<br />");
                  }

                  if (String($_step.find('select[name="gender"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.gender_group_is_required")'));
                      $errors.push("<br />");
                  }

                  

                  if (String($_step.find('select[name="booking_per_user"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.bookings_per_user_is_required")'));
                      $errors.push("<br />");
                  }


                  if ($_step.find('input[name="cancellation"]').val() == 1) {
                      if (String($_step.find('input[name="cancellation_days"]').val()).isEmpty()) {
                          $errors.push($("<strong>").text('@lang("event.cancellation_days_is_required")'));
                          $errors.push("<br />");
                      }
                  }

//                  if ($_step.find('input[name*="require_data_id_"]:checked, input[name="require_data_more"]:checked').length == 0) {
//                      $errors.push($("<strong>").text('@lang("event.data_required_is_required")'));
//                      $errors.push("<br />");
//                  }

                  if ($errors.length > 0) {
                      setError(_stepID, $errors);
                      swal("", "@lang("event.please_fill_in_the_required_fields")", "error");
                      return;
                  }

                  nextStep();
                  break;

              case 5:

                  $errors = [];

                  if ($_step.find('input[name="fee_type"]:checked').val() == 1) {
                      if ($_step.find('input[name="multi_price"]:checked').val() == 0) {
                          if (parseFloat($_step.find('input[name="fee"]').val()) == 0 || isNaN(parseFloat($_step.find('input[name="fee"]').val()))) {
                              $errors.push($("<strong>").text('@lang("event.price_is_required")'));
                              $errors.push("<br />");
                          }
                      }
                      else {
                          $_error1 = false;
                          $_empty1 = false;

                          if ($_step.find('#its-multi .pricing-list')) {
                              $_step.find('#its-multi .pricing-list li.repete-li').each(function () {
                                  $_empty1 = $_empty1 || !String($(this).find('[name="event_multiple_price_name_en[]"]').val()).isEmpty();
                                  $_empty1 = $_empty1 || !String($(this).find('[name="event_multiple_price_name_ar[]"]').val()).isEmpty();
                                  $_empty1 = $_empty1 || !String($(this).find('[name="event_multiple_price_cost[]"]').val()).isEmpty();
                                  if (
                                      !(String($(this).find('[name="event_multiple_price_name_en[]"]').val()).isEmpty() &&
                                          String($(this).find('[name="event_multiple_price_name_ar[]"]').val()).isEmpty() &&
                                          String($(this).find('[name="event_multiple_price_cost[]"]').val()).isEmpty())
                                  ) {
                                      if (
                                          (!String($(this).find('[name="event_multiple_price_name_en[]"]').val()).isEmpty() ||
                                              !String($(this).find('[name="event_multiple_price_name_ar[]"]').val()).isEmpty() ||
                                              !String($(this).find('[name="event_multiple_price_cost[]"]').val()).isEmpty())
                                          &&
                                          !(!String($(this).find('[name="event_multiple_price_name_en[]"]').val()).isEmpty() &&
                                              !String($(this).find('[name="event_multiple_price_name_ar[]"]').val()).isEmpty() &&
                                              !String($(this).find('[name="event_multiple_price_cost[]"]').val()).isEmpty())
                                      ) {
                                          $_error1 = true;
                                      }
                                  }
                              });
                          }

                          $_empty2 = false;

                          if ($_step.find('#its-multi-group .pricing-list')) {
                              $_step.find('#its-multi-group .pricing-list li.repete-li2').each(function () {
                                  $_empty2 = $_empty2 || !String($(this).find('[name="event_group_price_price[]"]').val()).isEmpty();
                              });
                          }

                          if (!$_empty1 && !$_empty2) {
                              $errors.push($("<strong>").text('@lang("event.you_have_enter_at_least_one_record_of_priceing")'));
                              $errors.push("<br />");
                          }

                          if ($_error1) {
                              $errors.push($("<strong>").text('@lang("event.you_have_enter_at_mised_some_fields")'));
                              $errors.push("<br />");
                          }
                      }
                  }


                  if ($errors.length > 0) {
                      setError(_stepID, $errors);
                      swal("", "@lang("event.please_fill_in_the_required_fields")", "error");
                      return;
                  }


                  $('#rows').change();

                  if($('[name="asdasd' +
                    'fee_type"]:checked').val()==1 && $('[name="multi_price"]:checked').val()==1){
                    min=999;

                    $('[name*="event_group_price_ticket_no"]').each(function () {
                      min = Math.min(min, $(this).val());
                    });

                    $_step.find('[name="booking_per_user"]').empty();
                    for(i=0; i<9; i++) {
                      $_step.find('[name="booking_per_user"]').append($('<option>').text(min + i * 5).val(min + i * 5));
                    }

                    $_step.find('[name="booking_per_user"]').trigger('liszt:updated');
                  }

                  nextStep();
                  break;

              case 6:

                  $errors = [];

                  if (String($_step.find('input[name="capacity"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.maximum_attendees_allowed_is_required")'));
                      $errors.push("<br />");
                  }
                  else{
                    if ($_step.find('input[name="capacity"]').val() < $_step.find('input[name="booking_per_user"]').val()) {
                      $errors.push($("<strong>").text('@lang("event.maximum_attendees_should_not_be_less_than_bookings_per_user_value")'));
                      $errors.push("<br />");
                    }
                  }

                  if ($_step.find('#location_id').val() == 0) {
                      $errors.push($("<strong>").text('@lang("event.select_location_is_required")'));
                      $errors.push("<br />");
                  }

                  if ($_step.find('#venue_id').val() == 0) {
                      $errors.push($("<strong>").text('@lang("event.venue_is_required")'));
                      $errors.push("<br />");
                  }




                  if ($_step.find('input[name="seating_booking_type"]:checked').length == 0) {
                        $errors.push($("<strong>").text('@lang("event.seating_type_is_required")'));
                        $errors.push("<br />");
                  }

                  if($('input[name="use_seatmap"]:checked').val()==1) {
                      $seatmapInput = $_step.find('#seatmapInput').val();
                      try {
                          JSON.parse($seatmapInput);
                      } catch (e) {
                          $errors.push($("<strong>").text('@lang("event.please_click_on") [@lang('event.save_seat_map')] @lang("event.to_continue")'));
                          $errors.push("<br />");
                      }


                      if ($_step.find('#seatRows').val() == 0) {
                          $errors.push($("<strong>").text('@lang('event.seats_in_each_row') @lang("event.is_required")'));
                          $errors.push("<br />");
                      }

                      if ($_step.find('#seatMapImg').val() == '') {
                          $errors.push($("<strong>").text('@lang('event.seatmap_image') @lang("event.is_required")'));
                          $errors.push("<br />");
                      }

                      if ($_step.find('#seatcols').val() == 0) {
                          $errors.push($("<strong>").text('@lang('event.seatmap_columns') @lang("event.is_required")'));
                          $errors.push("<br />");
                      }

                      if ($_step.find('input[name="multi_price"]:checked').val() == 0) {
                          if (parseFloat($_step.find('input[name="fee"]').val()) == 0 || isNaN(parseFloat($_step.find('input[name="fee"]').val()))) {
                              $errors.push($("<strong>").text('@lang("event.price_is_required")'));
                              $errors.push("<br />");
                          }
                      }
                  }


                  if ($errors.length > 0) {
                      setError(_stepID, $errors);
                      swal("", "@lang("event.please_fill_in_the_required_fields")", "error");
                      return;
                  }

                  nextStep();
                  break;

              case 7:

                  $errors = [];

                  if (String($_step.find('input[name="main-pic"]').val()).isEmpty()) {
                      $errors.push($("<strong>").text('@lang("event.main_picture_is_required")'));
                      $errors.push("<br />");
                  }

                  urlTest = new RegExp("https?:\\/\\/(www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-z0-9]{1,6}\\b([-a-zA-Z0-9@:%_\\+.~#?&//=]*)");

                  $linkError = false;
                  $_step.find('input[name="video_link[]"]').each(function () {
                      if (!String(this.value).isEmpty() && !urlTest.test(this.value)) {
                          $linkError = true;
                      }
                  });

                  if ($linkError) {
                      $errors.push($("<strong>").text('@lang("event.video_link_is_not_correct")'));
                      $errors.push("<br />");
                  }

                  if ($errors.length > 0) {
                      setError(_stepID, $errors);
                      swal("", "@lang("event.please_fill_in_the_required_fields")", "error");
                      return;
                  }

                  nextStep();
                  break;

              case 8:

                  $errors = [];

                  nextStep();
                  break;

              case 9:

                  $errors = [];

                  nextStep();
                  break;

              case 10:

                  $errors = [];

                  $.post('{{ route('event.news') }}', $('#event-form').serialize())
                      .success(function (d) {
                          if (d.status) {
                              $('#eventNews').html(d.html);

                              $("#review").accordion({
                                  canToggle: true,
                                  canOpenMultiple: true
                              });

                              nextStep();
                          }
                          else {
                              swal("", d.msg.join('<br>'), "error");
                          }
                      })
                      .error(function () {
                          swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
                      });
                  break;

          }

      });

      $('#livebtn').click(function () {
          window.open('{{ route('event.live_preview1') }}?' + $('#event-form').serialize());
      });

      $('#publishbtn').click(function () {

          var formData = new FormData();

          var formArray = $('#event-form').serializeArray();

          var formRow;
          var fileFile;

          for(var ii=0; formRow=formArray[ii]; ii++){
              formData.append(formRow['name'], formRow['value']);
          }

          if($('[name="use_seatmap"]:checked').val()==1) {
              fileFile = $('#seatMapImg')[0];

              formData.append("seat_map_img", fileFile.files[0], fileFile.files[0].name);
          }

          $.ajax({
              type: "POST",
              url: "{{ route('event.save') }}",
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function (d) {
                  if (d.status) {
                      location.href = d.url; //TODO: change it later
                      return;
                  }
                  swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
              },
              error: function () {
                  swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
              }
          });
      });

      $('#closebtn').click(function () {
          location.href = '/'; //TODO: change it later
      });

      var categories_arr = {!! json_encode(array_values($categories->filter(function($row){ return $row->category_id!=0; })->toArray())) !!};
//
//      $('#category').change(function () {
//          var cate;
//
//          $('#subcategory').empty();
//
//          for (i = 0; cate = categories_arr[i]; i++) {
//              $('#subcategory').append(new Option(cate.name_{{ $lang }}, cate.id, i == 0, i == 0));
//          }
//
//          $('#subcategory').chosen({display_disabled_options: false}).trigger('liszt:updated').each(function () {
//              $(this).on('chosen:showing_dropdown', function (event, params) {
//                  $('option:contains("shop")', $(this)).attr('disabled', true);
//                  $(this).trigger("chosen:updated");
//              });
//          });
//
//      });
//
      $('#country').change(function () {
          $('#city').empty().trigger('liszt:updated');

          $.get('{{ route('settings.city', '') }}/' + $(this).val())
              .success(function (d) {
                  var city;

                  for (i = 0; city = d[i]; i++) {
                      $('#city').append(new Option(city.name_{{ $lang }}, city.id, false, false));
                  }
                  $('#city').trigger('liszt:updated');
              })
              .fail(function () {
                  swal("", "@lang("event.server_error_please_contact_the_website_owner")", "error");
              })


      });

      $("#geocomplete").bind("geocode:result", function (event, result) {
          $('#address_lat').val($("#geocomplete").geocomplete('marker').position.lat());
          $('#address_long').val($("#geocomplete").geocomplete('marker').position.lng());
      });

      $(document).on("change", ".upload-certificate", function () {
          var that;

          if (this.files.length == 0) {
              $(this).parent().find('[type="hidden"]').val('');
              $(this).parent().find(".filename-certificate").html('');
              return;
          }

          that = this;

          $(this).parent().find(".filename-certificate").html($('<img>').attr('src', '{{ asset('images/loading.gif') }}'));

          var formData = new FormData();

          formData.append("file", this.files[0], this.files[0].name);

          $.ajax({
              type: "POST",
              url: "{{ route('event.upload') }}",
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function (data) {
                  if (data.status) {
                      $(that).parent().find('[type="hidden"]').val(data.data);
                      $(that).parent().find(".filename-certificate").html(that.files[0].name);
                  }
                  else {
                      swal("", data.msg, "error");
                  }
              },
              error: function () {
                  swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
              }
          });
      });


      $('#list').delegate(".listelement", "click", function () {
          var elemid = $(this).attr('data-id');
          $("#" + elemid).remove();
      });


      var cacheUser = {};

      $("#add").autocomplete({
          minLength: 3,
          close: function () {
              $(this).val('');
          },
          source: function (request, response) {
              var term = request.term;
              if (term in cacheUser) {
                  response(cacheUser[term]);
                  return;
              }

              $.post("{{ route('settings.user') }}", request)
                  .success(function (data) {
                      if (data.status) {
                          cacheUser[term] = data.data;
                          response(data.data);
                          return;
                      }

                      response({});
                  })
                  .fail(function () {
                      swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
                  });
          },
          focus: function (event, ui) {
              $(this).val(ui.item.name);
              return false;
          },
          select: function (event, ui) {

              var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));

              if ($('#list').find('input[name="event_invitation_user_id[]"][value="' + ui.item.id + '"]').length > 0) {
                  $(this).val('');
                  return false;
              }

              $('#list').append('<a id="' + uniqid + '"> <li id="' + uniqid + '" class="list-group-item">' +
                  '<input type="button" data-id="' + uniqid + '" class="listelement" value="X" /> ' +
                  "<div><b>" + ui.item.name + "</b><br><sub>" + ui.item.email + "</sub></div>" +
                  '<input type="hidden" name="event_invitation_user_id[]" value="' + ui.item.id + '"></li> </a>');

              $(this).val('');
              return false;
          }
      })
          .autocomplete("instance")._renderItem = function (ul, item) {
          return $("<li>")
              .append("<div><b>" + item.name + "</b><br><sub>" + item.email + "</sub></div>")
              .appendTo(ul);
      };


      (function () {
          var cachePro = {};

          $("#add-pro").autocomplete({
              minLength: 3,
              close: function () {
                  $(this).val('');
              },
              source: function (request, response) {
                  var term = request.term;
                  if (term in cachePro) {
                      response(cachePro[term]);
                      return;
                  }

                  $.post("{{ route('event.professional') }}", request)
                      .success(function (data) {
                          if (data.status) {
                              cachePro[term] = data.data;
                              response(data.data);
                              return;
                          }

                          response({});
                      })
                      .fail(function () {
                          swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
                      });
              },
              focus: function (event, ui) {
                  $(this).val(ui.item.name_{{ $lang }});
                  return false;
              },
              select: function (event, ui) {

                  var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));

                  if ($('#list-pro').find('input[name="event_professional_professional_id[]"][value="' + ui.item.id + '"]').length > 0) {
                      $(this).val('');
                      return false;
                  }

                  $('#list-pro').append('<a id="' + uniqid + '"> <li id="' + uniqid + '" class="list-group-item">' +
                      '<input type="button" data-id="' + uniqid + '" class="listelement" value="X" /> ' +
                      "<div>" + ui.item.name_{{ $lang }} + "</div>" +
                      '<input type="hidden" name="event_professional_professional_id[]" value="' + ui.item.id + '"></li> </a>');

                  $(this).val('');
                  return false;
              }
          })
              .autocomplete("instance")._renderItem = function (ul, item) {
              return $("<li>")
                  .append("<div>" + item.name_{{ $lang }} + "</div>")
                  .appendTo(ul);
          };


          $('#addbtn-pro-new').click(function () {

              var that;

              if ($('[name="myfile-pro"]')[0].files.length == 0 || String($('#add-pro-new').val()).isEmpty()) {
                  swal("", "@lang("event.you_have_type_the_professional_name_and_chose_a_picture")", "error");
                  return;
              }

              var formData = new FormData();

              formData.append("name", $('#add-pro-new').val());
              formData.append("file", $('[name="myfile-pro"]')[0].files[0], $('[name="myfile-pro"]')[0].files[0].name);

              that = this;

              $.ajax({
                  type: "POST",
                  url: "{{ route('event.professional.add') }}",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (data) {
                      var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));

                      if (data.status) {

                          $('#list-pro').append('<a id="' + uniqid + '"> ' +
                              '<li id="' + uniqid + '" class="list-group-item">' +
                              '<input type="button" data-id="' + uniqid + '" class="listelement" value="X" /> ' +
                              formData.get('name') + '<input type="hidden" name="event_added_professional_professional_id[]" value="' + data.data + '"></li> </a>');
                          $('#add').val('');
                          $('#add-pro-new').val('');
                          $(that).parent().find(".filename-certificate").html('');
                      }
                      else {
                          swal("", data.msg, "error");
                      }
                  },
                  error: function () {
                      swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
                  }
              });

              return false;
          });
          $('#list-pro').delegate(".listelement", "click", function () {
              var elemid = $(this).attr('data-id');
              $("#" + elemid).remove();
          });
      })();

      (function () {
          var cacheGro = {};

          $("#add-gro").autocomplete({
              minLength: 3,
              close: function () {
                  $(this).val('');
              },
              source: function (request, response) {
                  var term = request.term;
                  if (term in cacheGro) {
                      response(cacheGro[term]);
                      return;
                  }

                  $.post("{{ route('event.company') }}", request)
                      .success(function (data) {
                          if (data.status) {
                              cacheGro[term] = data.data;
                              response(data.data);
                              return;
                          }

                          response({});
                      })
                      .fail(function () {
                          swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
                      });
              },
              focus: function (event, ui) {
                  $(this).val(ui.item.name_{{ $lang }});
                  return false;
              },
              select: function (event, ui) {
                  var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));

                  if ($('#list-gro').find('input[name="event_company_company_id[]"][value="' + ui.item.id + '"]').length > 0) {
                      $(this).val('');
                      return false;
                  }

                  $('#list-gro').append('<a id="' + uniqid + '"> <li id="' + uniqid + '" class="list-group-item">' +
                      '<input type="button" data-id="' + uniqid + '" class="listelement" value="X" /> ' +
                      "<div>" + ui.item.name_{{ $lang }}+ "</div>" +
                      '<input type="hidden" name="event_company_company_id[]" value="' + ui.item.id + '"></li> </a>');

                  $(this).val('');
                  return false;
              }
          })
              .autocomplete("instance")._renderItem = function (ul, item) {
              return $("<li>")
                  .append("<div>" + item.name_{{ $lang }}+ "</div>")
                  .appendTo(ul);
          };


          $('#addbtn-gro-new').click(function () {

              var that;

              if ($('[name="myfile-gro"]')[0].files.length == 0 || String($('#add-gro-new').val()).isEmpty()) {
                  swal("", "@lang("event.you_have_type_the_vendor_name_and_chose_a_picture")", "error");
                  return;
              }

              var formData = new FormData();

              formData.append("name", $('#add-gro-new').val());
              formData.append("file", $('[name="myfile-gro"]')[0].files[0], $('[name="myfile-gro"]')[0].files[0].name);

              that = this;

              $.ajax({
                  type: "POST",
                  url: "{{ route('event.company.add') }}",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (data) {
                      var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));

                      if (data.status) {

                          $('#list-gro').append('<a id="' + uniqid + '"> ' +
                              '<li id="' + uniqid + '" class="list-group-item">' +
                              '<input type="button" data-id="' + uniqid + '" class="listelement" value="X" /> ' +
                              formData.get('name') + '<input type="hidden" name="event_added_company_company_id[]" value="' + data.data + '"></li> </a>');
                          $('#add').val('');
                          $('#add-gro-new').val('');
                          $(that).parent().find(".filename-certificate").html('');
                      }
                      else {
                          swal("", data.msg, "error");
                      }
                  },
                  error: function () {
                      swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
                  }
              });

              return false;
          });
          $('#list-gro').delegate(".listelement", "click", function () {
              var elemid = $(this).attr('data-id');
              $("#" + elemid).remove();
          });
      })();

      rowsCahnge = function() {
          var $level = $('<span>');
          var $rows = $(this).val();
          var $tab = $('#seats-table');

          $tab.find('tbody').empty();

          if ($('[name="fee_type"]:checked').val() == 2) {
              $level = $("<span>{{ __('event.free') }}<input type='hidden' value=0 /></span>");
          }
          else {
              if ($('[name="multi_price"]:checked').val() == 1) {
                  $level = $("<span>{{ __('event.free') }}<input type='hidden' value=0 /></span>");
                  $nameEn = $('[name*="event_multiple_price_name_en"]');
                  $nameAr = $('[name*="event_multiple_price_name_ar"]');

                  for (i = 0; i < $nameEn.length; i++) {
                      valArr = String($nameEn.eq(i).attr('name')).match(/\d+/);
                      val0 = 0;
                      if (valArr.length > 0) {
                          val0 = valArr[0];
                      }
                      $level.append($('<option>').val(val0).text($nameEn.eq(i).val()));
                  }
              }
              else {
                  // TODO: Currency not implemented
                  $level = $('[name="fee"]').val() + " KWD<input type='hidden' value=0 />";
              }
          }

          for (i = 1; i <= $rows; i++) {
              $tab.find('tbody').append(
                  $('<tr>')
                      .append('<td>' + i + '<input type="hidden" value="' + i + '"></td>')
                      .append('<td><input type="text" style="float: unset;" value="' + String.fromCharCode(64 + i) + '" /></td>')
                      .append('<td><input type="color" value="#000000" /></td>')
                      .append($('<td>').append($level.clone()))
              )
          }


      };

      (function () {
          var cacheSpo = {};

          $("#add-spo").autocomplete({
              minLength: 3,
              close: function () {
                  $(this).val('');
              },
              source: function (request, response) {
                  var term = request.term;
                  if (term in cacheSpo) {
                      response(cacheSpo[term]);
                      return;
                  }

                  $.post("{{ route('event.sponsor') }}", request)
                      .success(function (data) {
                          if (data.status) {
                              cacheSpo[term] = data.data;
                              response(data.data);
                              return;
                          }

                          response({});
                      })
                      .fail(function () {
                          swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
                      });
              },
              focus: function (event, ui) {
                  $(this).val(ui.item.name_{{ $lang }});
                  return false;
              },
              select: function (event, ui) {

                  var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));

                  if ($('#list-spo').find('input[name="event_sponsor_sponsor_id[]"][value="' + ui.item.id + '"]').length > 0) {
                      $(this).val('');
                      return false;
                  }

                  $('#list-spo').append('<a id="' + uniqid + '"> <li id="' + uniqid + '" class="list-group-item">' +
                      '<input type="button" data-id="' + uniqid + '" class="listelement" value="X" /> ' +
                      "<div>" + ui.item.name_{{ $lang }}+ "</div>" +
                      '<input type="hidden" name="event_sponsor_sponsor_id[]" value="' + ui.item.id + '"></li> </a>');

                  $(this).val('');
                  return false;
              }
          })
              .autocomplete("instance")._renderItem = function (ul, item) {
              return $("<li>")
                  .append("<div>" + item.name_{{ $lang }} + "</div>")
                  .appendTo(ul);
          };


          $('#addbtn-spo-new').click(function () {

              var that;

              if ($('[name="myfile-spo"]')[0].files.length == 0 || String($('#add-spo-new').val()).isEmpty()) {
                  swal("", "@lang("event.you_have_type_the_professional_name_and_chose_a_picture")", "error");
                  return;
              }

              var formData = new FormData();

              formData.append("name", $('#add-spo-new').val());
              formData.append("file", $('[name="myfile-spo"]')[0].files[0], $('[name="myfile-spo"]')[0].files[0].name);

              that = this;

              $.ajax({
                  type: "POST",
                  url: "{{ route('event.sponsor.add') }}",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function (data) {
                      var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));

                      if (data.status) {

                          $('#list-spo').append('<a id="' + uniqid + '"> ' +
                              '<li id="' + uniqid + '" class="list-group-item">' +
                              '<input type="button" data-id="' + uniqid + '" class="listelement" value="X" /> ' +
                              formData.get('name') + '<input type="hidden" name="event_added_sponsor_sponsor_id[]" value="' + data.data + '"></li> </a>');
                          $('#add').val('');
                          $('#add-spo-new').val('');
                          $(that).parent().find(".filename-certificate").html('');
                      }
                      else {
                          swal("", data.msg, "error");
                      }
                  },
                  error: function () {
                      swal("", "@lang("event.server_error_try_later_or_contact_owner")", "error");
                  }
              });

              return false;
          });
          $('#list-spo').delegate(".listelement", "click", function () {
              var elemid = $(this).attr('data-id');
              $("#" + elemid).remove();
          });


          $locations = {!! json_encode($locations->toArray()) !!};

          $('#location_id').change(function () {
              var $val = $(this).val();
              var $venue = $('#venue_id');

              $venue.empty();

              for (var i = 0; $location = $locations[i]; i++) {
                  if ($location.id == $val) {
                      for (j = 0; venue = $location.venues[j]; j++) {
                          $venue.append($('<option>').text(venue['name_' + '{{ $lang }}']).val(venue.id));
                      }
                      $venue.trigger("liszt:updated");
                      break;
                  }
              }

          });


          $('#rows').change(rowsCahnge);
      })();

  </script>
  <script>
      $(document).ready(function () {
          var priceTypes = [
              { id: '0', value: 'VIP' },
              { id: '1', value: 'Normal' },
              { id: '2', value: 'Child' },
              { id: '3', value: 'known' }
              ];

          $balances = {
              events   : {{ intval(auth()->user()->number_of_events) }},
              activity : {{ intval(auth()->user()->number_of_activity) }},
              services : {{ intval(auth()->user()->number_of_services) }}
          };




          var rows = 0;
          var cols = 0;

          var selectedRowsPriceType = [];
          var allRowsPriceType = [];
          var rowsPrefix = [];

          //THE MOST IMPORTANT ARRAY
          var seatMapSettings = {};

          //check duplication in prefix inputs to insure being unique
          function hasDuplicates(array) {
              return (new Set(array)).size !== array.length;
          }


          $("#gBtn").on("click", function () {
              if ($("#seatRows").val() != '' && $("#seatcols").val() != '' && $('#seatMapImg').val() != '') {

                  $("#seatRows").removeClass("error");
                  $("#seatcols").removeClass("error");
                  $('#seatMapImg').parent().find(".normal-btn").removeClass("error");
                  // Reserved and disabled seats are indexed
                  // from left to right by starting from 0.
                  // Given the seatmap as a 2D array and an index [R, C]
                  // the following values can obtained as follow:
                  // I = cols * R + C
                  rows = $("#seatRows").val();
                  cols = $("#seatcols").val();



                  var map = {
                      rows: rows,
                      cols: cols,
                      // e.g. First Reserved Seat [1, 2] = 7 * 1 + 2 = 9
                      reserved: [9, 14, 17],
                      //disabled: [12, 21, 23]
                  };

                  var types = [
                      { type: "regular", color: "orange", price: 10 }
                  ];
                  var sc = new SeatchartJS(map, types);
                  sc.setAssetsSrc("{{ asset('assets') }}");
                  sc.setCurrency("kd");
                  sc.setSoundEnabled(true);
                  //sc.setShoppingCartWidth(200);
                  //sc.setShoppingCartHeight(250);
                  // sc.setMouseDownInterval(100);


                  //creating seat prices type select option


                  // var select = $('<li class="priceTypeUnit"><select></select></li>');
                  //var select = $('<select></select>');
                  // var i;
                  // for (i = 0; i < priceTypes.length; i++) {
                  //     select.find('select').append('<option key="' + priceTypes[i].key + '"  value="' + priceTypes[i].value + '">' + priceTypes[i].value + '</option>');
                  //}

                  sc.createMap("map-container");
                  $('.generateMap').slideUp();
                  $('#bgBtn').css('display', 'inline-block');
                  $('#nBtn').css('display', 'inline-block');
                  //sc.createLegend("legend-container");
                  //sc.createShoppingCart("shoppingCart-container");





                  $.each($(".seatChart-row"), function (i, l) {
                      if (i >= 2) {
                          $(this).find(".seatChart-seat.index").html('<input id="' + (i - 2) + '" type="text" style="width:100%"/>');
                          $(this).find(".seatChart-seat:last-child").after('<select class="priceTypeSelect"></select>');

                          $(this).find('.priceTypeSelect').append(function(){
                              $level = [];

                              if ($('[name="multi_price"]:checked').val() == 1) {
                                  $nameEn = $('[name*="event_multiple_price_name_en"]');

                                  for (i = 0; i < $nameEn.length; i++) {
                                      valArr = String($nameEn.eq(i).attr('name')).match(/\d+/);
                                      val0 = 0;
                                      if (valArr.length > 0) {
                                          val0 = valArr[0];
                                      }
                                      $level.push($('<option>').val(val0).data('id', val0).text($nameEn.eq(i).val()));
                                  }
                              }
                              else {
                                  $level.push($('<option>').val(0).data('id', 0).text('@lang('event.one_level')'));
                              }

                              return $level;
                          });

                          // var j;
                          //
                          // for (j = 0; j < priceTypes.length; j++) {
                          //     $(this).find('.priceTypeSelect').append(
                          //         '<option data-id="' + priceTypes[j].id + '"  value="' + priceTypes[j].value + '">'
                          //         + priceTypes[j].value + '</option>'
                          //     );
                          // }
                          $(this).find('.priceTypeSelect').attr('id', (i - 2));
                          //$(select).clone().appendTo("#priceType");
                          //$("#priceType").append(select);
                      }
                      //START generate seats with num 1 and continue regarding columns
                        $.each($(".seatChart-seat[id^=" + i + "]"), function (j, seat) {
                            $(this).text(j + 1);
                        });
                        //END generate seats with num 1 and continue regarding columns
                      
                  });
              }
              else {
                  if ($("#seatRows").val() == '') {
                      $("#seatRows").addClass("error");
                  } else {
                      $("#seatRows").removeClass("error");
                  }
                  if ($("#seatcols").val() == '') {
                      $("#seatcols").addClass("error");
                  } else {
                      $("#seatcols").removeClass("error");
                  }
                  if ($('#seatMapImg').val() == '') {
                      $('#seatMapImg').parent().find(".normal-btn").addClass("error");
                  } else {
                      $("#seatMapImg").parent().find(".normal-btn").removeClass("error");
                  }
              }
          });// end gBtn click

          $("#bgBtn").on("click", function () {
              if (confirm("Are you sure you want to discard your changes and start again ?")) {
                  $('#map-container').empty();
                  $('.generateMap').slideDown();
                  $('#bgBtn').css('display', 'none');
                  $('#nBtn').css('display', 'none');
              }
          });


          $("#nBtn").on("click", function () {


              rowsPrefix = [];

              $.each($(".seatChart-seat.index input"), function (i, l) {
                  if ($(this).val() == '') {
                      $(this).addClass("error");
                  } else {
                      $(this).removeClass("error");
                  }
              });

              //save rows prefix
              $.each($(".seatChart-seat.index input"), function (i, l) {
                  if ($(this).val() != '') {
                      rowsPrefix.push($(this).val());
                  }
              });

              if (rowsPrefix.length == $(".seatChart-seat.index input").length) {

                  if (hasDuplicates(rowsPrefix)) {
                      alert("Each Row Prefix Must Be Unique");
                  }
                  else {

                      //get chosen prices types
                      $.each($("select.priceTypeSelect"), function (i, l) {

                          var currentSelectVal = $(this).val();

                          var found = selectedRowsPriceType.some(function (el) {
                              return el.id === currentSelectVal;
                          });

                          if (!found) {
                              selectedRowsPriceType.push({
                                  id: $(this).find("option:selected").val(),
                                  value: $(this).find("option:selected").text()
                              });
                          }

                          allRowsPriceType.push({
                              id: $(this).find("option:selected").val(),
                              value: $(this).find("option:selected").text()
                          });
                      });

                      //render chosen prices types to select its colors
                      $("#chosenPriceTypeColor").empty();
                      var colorUnits = $(' <li><label></label><input type="color" class="colorType" name="color" value="#e66465" /></li>');
                      var x;
                      for (x = 0; x < selectedRowsPriceType.length; x++) {
                          colorUnits.find('label').text(selectedRowsPriceType[x].value);
                          colorUnits.find('label').attr('data-id', selectedRowsPriceType[x].id);
                          colorUnits.find('label').attr('value', selectedRowsPriceType[x].value);
                          $(colorUnits).clone().appendTo("#chosenPriceTypeColor");
                      }

                      $(".propertyMapNext").slideUp(function () {
                          $(".propertyMapDone").slideDown();
                      });
                  }
              }
          });


          $('input[name="use_seatmap"]').click(function(){
              $('#seatmap-container').toggle($(this).val()==1);
          });
          $("#bnBtn").on("click", function () {
              if (confirm("Are you sure you want to discard your changes and back to map again ?")) {
                  $(".propertyMapDone").slideUp(function () {
                      $(".propertyMapNext").slideDown();
                  });
              }
          });


          $("#dBtn").on("click", function () {

              $.each($("#chosenPriceTypeColor li"), function (i, l) {

                  var typeId = $(this).find('label').attr('data-id');
                  var typeVal = $(this).find('label').attr('value');
                  var typeColor = $(this).find('input').val();


                  var found = selectedRowsPriceType.some(function (el) {
                      return el.value === typeVal;
                  });
                  if (found) {
                      selectedRowsPriceType.forEach(function (myTypes) {
                          if (myTypes.value == typeVal) {
                              myTypes.color = typeColor;
                          }
                      })
                  } else {
                      selectedRowsPriceType.push({
                          id: typeId,
                          value: typeVal,
                          color: typeColor
                      })
                  }


                  var find = allRowsPriceType.some(function (el) {
                      return el.value === typeVal;
                  });
                  if (find) {
                      allRowsPriceType.forEach(function (myTypes) {
                          if (myTypes.value == typeVal) {
                              myTypes.color = typeColor;
                          }
                      })
                  }
              });
              // console.log('selectedRowsPriceType');
              // console.log(selectedRowsPriceType);
              //
              // console.log('allRowsPriceType');
              // console.log(allRowsPriceType);
              var y;
              var x;
              for (y = 0; y < allRowsPriceType.length; y++) {
                  for (x = 0; x < rowsPrefix.length; x++) {
                      if (x == y) {
                          allRowsPriceType[y].prefix = rowsPrefix[x];
                      }
                  }
              }


              // console.log('allRowsPriceType');
              // console.log(allRowsPriceType);
              $('#seatmapInput').val(JSON.stringify(allRowsPriceType));
              // seatMapSettings={
              //     rows: parseInt(rows),
              //     cols: parseInt(cols),
              //     mapRows: allRowsPriceType
              // };

              // console.log('seatMapSettings');
              // console.log(seatMapSettings);

          });

          $('#repeat').click(function(){
             $('#repeat_section').toggle($(this).prop('checked'));
          });

          $('#repeat_count').change(function () {

              var $repeat_container = $('#repeat_container');

              $repeat_container.empty();

              for(var i=1; i<=$(this).val(); i++ ){
                  $repeat_container.append('<li class="fullwidth-li"><label>#'+i+'</label><input type="text" data-id="'+i+'" name="repeat_date['+i+']" class="normal-text-box datepicker"></li>');
              }

              $repeat_container.find(".datepicker").datepicker({
                  defaultDate: "+1w",
                  changeMonth: true,
                  numberOfMonths: 1,
                  // format:'yyyy-mm-dd',
                  minDate: 0
              })
                .on("change", function() {
                    $('.datepicker[name="repeat_date['+(parseInt($(this).data('id'))+1)+']"]')
                        .datepicker("option", "minDate", getDate(this));
                });

              function getDate(element) {
                  var dateFormat = "mm/dd/yy";

                  var date;
                  try {
                      date = $.datepicker.parseDate(dateFormat, element.value);
                  } catch (error) {
                      date = null;
                  }

                  return date;
              }
          });

          function addOptions($v){
              $('#repeat_count').empty();
              $('#repeat_count').append(function(){
                  $options = [];

                  for(var j=1; j<=$v; j++){
                      $options.push('<option>'+j+'</option>');
                  }

                  return $options;
              });
          }

          $('input[name="event-types"]').click(function() {
              var $tabID = $(this).data('type');

              switch ($tabID){
                  case {{ \App\Models\Event::TYPE_EVENT }}:
                      addOptions($balances.events);
                      break;

                  case {{ \App\Models\Event::TYPE_ACTIVITY }}:
                      addOptions($balances.activity);
                      break;

                  case {{ \App\Models\Event::TYPE_SERVICE }}:
                      addOptions($balances.services);
                      break;
              }
          })
      });
      function get_sub_category(id)
      {
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          
          $.ajax({
          url: '/getSubCategory',
          type: 'POST',
          data: {
            _token: CSRF_TOKEN,
            id : id,
          
          },
          dataType: 'JSON',
          success: function (data) { 
              $('#subcategory').empty();
                        $.each( data, function( key, value ) {

                $('#subcategory').append(new Option(value ,key));

            });
            
            
        $('#subcategory').trigger("liszt:updated");
          }
      }); 
      }
  </script>

@endsection

@section('css')

  <!--SEAT MAP CSS-->
  <link rel="stylesheet" href="{{ asset('css/build/seatchart.css') }}">
  <!--END SEAT MAP CSS-->

  <!--SEAT MAP STYLE-->
  <style>
    .right {
      float: left !important;
      display: inline-block;
    }
    .left {
      float: right !important;
      display: inline-block;
    }
    #priceType,
    #color {
      list-style-type: none;
      padding-left: 0;
      margin-top: 46px;
    }

    #map-container {
      overflow-x: auto;
      overflow-y: hidden;
      max-width: 100%;
      margin: 20px 0;
      display: block;
      width: 100%;
    }
    .seatChart-container{
      margin: 0 auto;
    }
    #chosenPriceTypeColor li{
      display: inline-block;
      width: auto;
    }
    .priceTypeSelect {
      height: 32px;
      margin: 4px;
    }

    .error, .form-hold .blue-button.error {
      border: 1px solid red;
    }

    ul.generateSubmit li {
      width: 100%;
      text-align: center;
    }

    ul.generateSubmit li button {
      float: none !important;
    }

    .padd0 {
      padding-left: 0 !important;
      padding-right: 0 !important;
    }

    .seatChart-title {
      text-align: left;
      padding: 20px 0;
      color: #000000;
      font-size: 13px;
      float: left;
      width: 100%;
      font-weight: 300;
      margin: 0 0 5px 0;
      min-height: 13px;
    }
  </style>
  <!--END SEAT MAP STYLE-->


@endsection