<!-- Header section starts here -->

<header class="full-width">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 logo"> <a href="{{ url('/')}}"><img src="{{ asset('images/Rizit_logo.png') }}" alt="logo" /></a> </div>
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 login-menus-hold">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-login-part">
            <div class="icon-menu-hold login_menus pull-right">
              <ul>
                @guest
                <li>
                  <div class="dropdown register-icon simple-listbox">
                    <button class="btn btn-secondary dropdown-toggle" type="button"  id="dropdownMenuButton"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('website.Register')}} </button>
                    <div class="dropdown-menu icon-link-drop" aria-labelledby="dropdownMenuButton" id="showreg">
                      <a class="dropdown-item register-options" href="{{ route('host_register')}}">{{__('website.Vendor')}} </a>
                      <a class="dropdown-item register-options" href="{{ route('customer_register')}}">{{__('website.User')}} </a>
                    </div>
                  </div>
                </li>
                <li> <a href="{{ route('login')}}" class="login-icon">{{__('website.Login')}}</a> </li>
                @else @if(Auth::user()->role_id == App\User::HOST_USER_ROLE_ID)
                <li> <a href="{{ route('host.my_account') }}" class="myaccount-icon">{{ Auth::user()->name }}</a> </li>
                @else
                <li> <a href="{{ route('my_account') }}" class="myaccount-icon">{{ Auth::user()->name }}</a> </li>
                @endif
                <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form2').submit();" class="login-icon">{{__('website.Logout')}}</a> </li>

                <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                @endguest

                <li>
                  <div class="dropdown language-icon simple-listbox">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false"> @if($lang=='en'){{__('website.English')}}@else {{__('website.Arabic')}} @endif </button>

                    <div class="dropdown-menu icon-link-drop" aria-labelledby="dropdownMenuButton" id="showlang">
                      @if($lang=='en')<a class="dropdown-item language-options" href="{{route('switch_lang' , 'ar')}}">{{__('website.Arabic')}} </a>@endif
                        @if($lang=='ar')<a class="dropdown-item language-options" href="{{route('switch_lang' , 'en')}}">{{__('website.English')}} </a>@endif                      </div>
                  </div>
                </li>
                <li>

                  <form action="/output/" name="InputCacheCheck" method="post">
                    <div class="input-prepend input-append">
                      <div class="btn-group location-flag">
                        <button class="btn btn-secondary dropdown-toggle location-icon simple-listbox" name="recordinput"
                          data-toggle="dropdown">
                           <img src="{{ asset('flags/'.strtolower($selected_currency->code).'.png') }}">  {{ $selected_currency['name_'.$lang] }}
                        </button>
                        <ul class="dropdown-menu " id="showprice">
                          @foreach ($currencies as $currency )
                          <li><a class="dropdown-item" href=" {{ route('change_currency' ,[$currency->code] )}}"> <img class="img" src="{{ asset('flags/'.strtolower($currency->code).'.png') }}"> {{$currency->symbol }}  </a></li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </form>
                </li>
                <li>


                  <div class="input-prepend input-append">
                    <div class="btn-group location-flag">

                      <button class="btn btn-secondary dropdown-toggle location-icon simple-listbox" name="recordinput"
                        data-toggle="dropdown">

                                        <img src="{{ asset('flags/'.strtolower($selectedcountry->code).'.png') }}">  {{ $selectedcountry['name_'.$lang] }}
                                    </button>
                      <ul class="dropdown-menu " id="showcountries">
                        @foreach ($countries as $country )
                        <li><a class="dropdown-item" href=" {{ route('change_country' ,[$country->code]) }} "> <img class="img" src="{{ asset('flags/'.strtolower($country->code).'.png') }}"> {{$country['name_' . $lang]}}  </a></li>
                        @endforeach
                      </ul>

                    </div>
                  </div>

                </li>

                <li>
                  <div class="search-hold">
                      <form id="demo-2" method="post" action="{{ route('search_filter') }}">
                          @csrf
                      <input class="search-icon" name="title"  type="search">
                    </form>

                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 navigation">
            <nav class="navbar navbar-default">
              <div class="container-fluid ">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse main-navigation" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li class="{{ (\Request::route()->getName() == 'home') ? 'active' : '' }}"><a href="{{ route('home') }}">{{__('website.Home')}} </a></li>
                    <li class="{{ (\Request::route()->getName() == 'thisweek') ? 'active' : '' }}"><a href="{{ route('thisweek') }}">{{__('website.This Week')}}</a></li>
                    <li class="{{ (\Request::route()->getName() == 'thisweekend') ? 'active' : '' }}"><a href="{{ route('thisweekend') }}">{{__('website.This Weekend')}} </a></li>
                    @foreach($menucategries as $menu)
                    <li class="{{ (\Request::route()->getName() == 'eventscategory') ? 'active' : '' }}"><a href="{{ route('eventscategory',['category_id'=>$menu->id]) }}"> {{ $menu['name_'.$lang] }} </a></li>
                    @endforeach
                    <li class="{{ (\Request::route()->getName() == 'hosts') ? 'active' : '' }}"><a href="{{ route('hosts') }}"> {{__('website.Hosts')}} </a></li>
                    <li class="{{ (\Request::route()->getName() == 'calendar') ? 'active' : '' }}"><a href="{{ route('calendar') }}"> {{__('website.Calendar')}} </a></li>
                  </ul>
                </div>
                <!-- /.navbar-collapse -->
              </div>
              <!-- /.container-fluid -->
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</header>
<!-- Header -->