<li class="fullwidth-li">
  <div class="review-hold">
    <ul id="review" class="accordion">
      <li>
        <h3> Type</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">
            <p> {{ \App\Models\MainType::find(request()->get( 'event-types' ))->name() }}</p>
          </div>
        </ul>
      </li>
      <li>
        <h3> Info</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">
            <ul>
              <li>@lang('event.english_title')</li>
              <li style="color: #000">{{ request( 'title_en' ) }}</li>
              <li>@lang('event.arabic_title')</li>
              <li style="color: #000">{{ request( 'title_ar' ) }}</li>
            </ul>

            <ul>
              <li><li>@lang('event.english_description')</li>
            </ul>
            <p> {{ request('description_en') }}</p>

            <ul>
              <li><li>@lang('event.arabic_description')</li>
            </ul>
            <p> {{ request('description_ar') }}</p>
            @php
              $cate = \App\Models\Category::with('parent')->find(request('category', 0));
            @endphp
            <ul>
              <li><li>@lang('event.category')</li>
              <li style="color: #000">{{ optional($cate->parent)->name() }}</li>
              <li><li>@lang('event.sub_category')</li>
              <li style="color: #000">{{ $cate->name() }}</li>
            </ul>

            <ul>
              <li><li>@lang('event.from')</li>
              <li style="color: #000">{{ date_create_from_format( 'm/d/Y', request( 'date_from' ) )->format( 'Y-m-d' ).' '.request( 'time_from' ).":00" }}</li>
              <li><li>@lang('event.to')</li>
              <li style="color: #000">{{ date_create_from_format( 'm/d/Y', request( 'date_to' ) )->format( 'Y-m-d' ).' '.request( 'time_to' ).":00" }}</li>
            </ul>

            @if(request('break_from')!=0)
              <h3><li>@lang('event.break')</h3>
              <ul>
                <li>@lang('event.from')</li>
                <li style="color: #000">{{ request('break_from') }}</li>
                <li>@lang('event.to')</li>
                <li style="color: #000">{{ request('break_to') }}</li>
              </ul>
            @endif
          </div>
        </ul>
      </li>
      <li>
        <h3> @lang('event.location')</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">
            <ul>
              <li>@lang('event.location_name_english')</li>
              <li style="color: #000">{{ request('location_name_en') }}</li>
              <li>@lang('event.location_name_arabic')</li>
              <li style="color: #000">{{ request('location_name_ar') }}</li>
            </ul>

            <h3>@lang('event.address_type')</h3>
            <p>{{ \App\Models\AddressType::find(request('address_type'))->name() }}</p>

            <h3>@lang('event.address_information')</h3>
            <p>
            @php
              $city = \App\Models\City::with('country')->find(request('address_city'));

            @endphp
              {{ $city->country->name() }}, {{ $city->name() }}
              {{  request('address_block') }}, {{ request('address_street') }},
              @if(request('address_avenue', false))
                {{ request('address_avenue') }},
              @endif
              @lang('event.building_house') - {{ request('address_building') }},
              @if(request('address_floor'))
                @lang('event.floor') {{ request('address_floor') }},
              @endif
            </p>
          </div>
        </ul>
      </li>
      <li>
        <h3> @lang('event.attendees')</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">
            <h3>@lang('event.age_group')</h3>
            <ul>
              <li>@lang('event.from')</li>
              <li style="color: #000">{{ request('age_from') }}</li>
              <li>@lang('event.to')</li>
              <li style="color: #000">{{ request('age_to') }}</li>
            </ul>

            <h3>@lang('event.gender_group')</h3>
            <p>
              @switch(request('gender'))
                @case(\App\Models\Event::GENDER_BOTH):
                @lang('event.both')
                @break
                @case(\App\Models\Event::GENDER_FEMALE):
                @lang('event.female')
                @break
                @case(\App\Models\Event::GENDER_MALE):
                @lang('event.male')
              @endswitch
            </p>

            <h3>@lang('event.private_listing') ({{ request('attendees_listing')? __('event.yes'): __('event.no') }})</h3>
            <h3>@lang('event.seating')
              ({{ request('seating_booking_type')==\App\Models\Event::SEATING_BOOKING_TYPE_ASSIGNED? __('event.assigned'): __('event.random') }}
              )</h3>
            <h3>@lang('event.generate_qr_code') ({{ request('make_qr_code')? 'Yes': 'No' }})</h3>
            <h3>@lang('event.bookings_per_user') ({{ request('booking_per_user') }})</h3>
            <h3>@lang('event.cancellation') ({{ request('cancellation') }})</h3>
            @if(request('cancellation'))
              <h3>@lang('event.cancellation_days') ({{ request('cancellation_days') }})</h3>
            @endif

            <h3>@lang('event.data_required_from_the_attendee')</h3>
            <ul>
              @foreach( request()->all() as $key => $value )
			          @if( strpos( $key, 'require_data_id_' ) !== false ) {
              <li>{{ \App\Models\RequireData::find($value)->name() }}</li>
                @endif
              @endforeach
            </ul>
          </div>
        </ul>
      </li>
      <li>
        <h3> @lang('event.fees')</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">
            @if(count(request('event_multiple_price_name_en', [])))
              @lang('event.sections')
              @foreach(request( 'event_multiple_price_name_en', [] ) as $key=>$row)
                <h3> {{ $row }}, {{ request( 'event_multiple_price_cost' )[ $key ] }} {{ $selected_currency->symbol }} /@lang('event.ticket') </h3>

                @foreach(request( 'event_group_price_ticket_no' ) as $keyG => $valG)
                  <ul>
                    <li>{{ $valG }} @lang('event.tickets')</li>
                    <li>{{ request( 'event_group_price_price' )[ $keyG ] }} {{ $selected_currency->symbol }} </li>
                  </ul>
                @endforeach
              @endforeach

            @elseif(request( 'fee', 0 )==0)
              <ul>
                <li>@lang('event.free')</li>
              </ul>
            @else
              <ul>
                <li>@lang('event.fee') = {{ request( 'fee', 0 ) }}</li>
              </ul>
            @endif

          </div>
        </ul>
      </li>
      <li>
        <h3> @lang('event.seating')</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">

          </div>
        </ul>
      </li>
      <li>
        <h3> @lang('event.media')</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">

          </div>
        </ul>
      </li>
      <li>
        <h3> @lang('event.exposure')</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">

          </div>
        </ul>
      </li>
      <li>
        <h3> @lang('event.participants')</h3>
        <ul class="panel loading category-filter">
          <div class="review-content">
            <h3>@lang('event.professionals')</h3>
            <ul>
              @foreach(\App\Models\AddedProfessional::whereIn('id', request( 'event_professional_professional_id', [] )) as $row)
                <li>{{ $row->name() }}</li>
              @endforeach
            </ul>
            <h3>@lang('event.groups_companies')</h3>
            <ul>
              @foreach(\App\Models\AddedCompany::whereIn('id', request( 'event_company_company_id', [] )) as $row)
                <li>{{ $row->name() }}</li>
              @endforeach
            </ul>
            <h3>@lang('event.sponsors')</h3>
            <ul>
              @foreach(\App\Models\AddedSponsor::whereIn('id', request( 'event_sponsor_sponsor_id', [] )) as $row)
                <li>{{ $row->name() }}</li>
              @endforeach
            </ul>
          </div>
        </ul>
      </li>
    </ul>
  </div>
</li>