@extends('layouts.app') 
@section('content')
    <div class="full-width">
        <section class="container   inner-page-listing">
            <div class="filter-part ">

                <div class="flter-search-txt-box">
                    <ul>
                        <form  method="post">
                        <li> <span> {{__('website.Search by name:')}} </span></li>
                        <li>
                            <input type="text" class="normal-text-box" data-ref="input-search" placeholder="{{__('website.Search by name')}}"/>
                        </li>

                        </form>
                    </ul>
                </div>


                <div class="sort-btn simple-listbox">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle " type="button" id="filterdropdownMenuButtonxx" onclick="$('#showfiltermenu').toggle()" aria-haspopup="true" aria-expanded="false">
                            {{__('website.Filter By')}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="filterdropdownMenuButtonxx" id="showfiltermenu">
                            <a class="dropdown-item" href="#"  data-filter="all">{{__('website.All')}}</a>
                            @foreach($professions as $profession)
                            <a class="dropdown-item" href="#"  data-toggle=".{{ $profession->en_name }}">{{ $profession->en_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="sort-btn simple-listbox">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButtonxx" onclick="$('#showfilter').toggle()" aria-haspopup="true" aria-expanded="false">
                            {{__('website.Sort By')}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="showfilter">
                            <a class="dropdown-item" href="#" data-sort="text:asc"> {{__('website.Ascending')}}</a>
                            <a class="dropdown-item" href="#" data-sort="text:desc"> {{__('website.Descending')}}</a>
                            <a class="dropdown-item" href="#" data-sort="rate:desc">{{__('website.rating-highest')}}</a>
                            <a class="dropdown-item" href="#" data-sort="rate:asc">{{__('website.rating-lowet')}}</a>
                        </div>
                    </div>
                </div>



            </div>



        </section>




    </div>

    <div class="full-width">
        <section class="container   inner-page-listing">
            <div class="full-width tab_cov">


                <div class="listing-title">
                    <h1>  </h1>
                </div>
                <div class="tab-content ">
                    <div role="tabpanel" class="tab-pane active " id="week">
                        <div class="innerpage-listing four_inrow ">
                            <ul  class="mixContainer container"  data-ref="mixContainer">


                                @foreach($hosts as $company)
                                    <li data-text={{ $company['company_name'] }} class="mix {{ $company['company_name'] }} @foreach($company->user->profession as $prof) {{ $prof->en_name }} @endforeach"  data-rate={{ abs($company->user->ratingpositive($company->user_id) - $company->user->ratingnegative($company->user_id)) }}>
                                        <div class="home-host-slide"> <a href="{{ route('host_profile',['host_name'=>$company->user->name]) }}"><img src="{{ $company->img }}" class="img">
                                                <div class="host-rating-hold ">
                                                    <h2> {{ $company['company_name'] }}</h2>
                                                    <ul>
                                                        <li>
                                                            <div class="rating-image "> <img src="{{ asset('images/rating_high.png')}}"> </div>
                                                            <div class="rating-value r-hi">
                                                                <p>{{ $company->user->ratingpositive($company->user_id) }} </p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="rating-image "> <img src="{{ asset('images/rating_med.png')}}"> </div>
                                                            <div class="rating-value r-me">
                                                                <p>{{ $company->user->ratingneutral($company->user_id) }} </p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="rating-image  "> <img src="{{ asset('images/rating_down.png')}}"> </div>
                                                            <div class="rating-value r-do">
                                                                <p>{{ $company->user->ratingnegative($company->user_id) }} </p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </a> </div>
                                    </li>
                                @endforeach



                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>

        var disabledDays = ["2018-8-21", "2018-8-24", "2018-8-27", "2018-8-30"];




    </script>
    <script>
        var container = document.querySelector('[data-ref="mixContainer"]');
        console.log(container);
        var inputSearch = document.querySelector('[data-ref="input-search"]');
        var keyupTimeout;



        // Set up a handler to listen for "keyup" events from the search input

        inputSearch.addEventListener('keyup', function() {
            var searchValue;

            if (inputSearch.value.length < 3) {
                // If the input value is less than 3 characters, don't send

                searchValue = '';
            } else {
                searchValue = inputSearch.value.toLowerCase().trim();
            }

            // Very basic throttling to prevent mixer thrashing. Only search
            // once 350ms has passed since the last keyup event

            clearTimeout(keyupTimeout);

            keyupTimeout = setTimeout(function() {
                filterByString(searchValue);
            }, 350);
        });

        /**
         * Filters the mixer using a provided search string, which is matched against
         * the contents of each target's "class" attribute. Any custom data-attribute(s)
         * could also be used.
         *
         * @param  {string} searchValue
         * @return {void}
         */

        function filterByString(searchValue) {
            if (searchValue) {
                // Use an attribute wildcard selector to check for matches

                mixer.filter('[class*="' + searchValue + '"]');
            } else {
                // If no searchValue, treat as filter('all')

                mixer.filter('all');
            }
        }
    </script>
@endsection
