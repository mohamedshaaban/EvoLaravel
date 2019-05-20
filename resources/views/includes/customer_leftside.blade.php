<div  class="left-link">
    <ul>
        <li  class="{{ (\Request::route()->getName() == 'my_account') ? 'active' : '' }}"> <a href="{{ route('my_account') }}"> {{__('website.My Account')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'my_profile') ? 'active' : '' }}"> <a href="{{ route('my_profile') }}"> {{__('website.My Profile')}}  </a></li>
        <li class="{{ (\Request::route()->getName() == 'my_bookings') ? 'active' : '' }}" > <a href="{{ route('my_bookings') }}"> {{__('website.Booking History')}} </a></li>
        <li  class="{{ (\Request::route()->getName() == 'my_contacts') ? 'active' : '' }}"> <a href="{{ route('my_contacts') }}"> {{__('website.Contacts')}} </a></li>
        <!--<li  class="{{ (\Request::route()->getName() == 'my_badges') ? 'active' : '' }}"> <a href="{{ route('my_badges') }}"> {{__('website.Badges')}} </a></li>-->
        <li  class="{{ (\Request::route()->getName() == 'my_calendar') ? 'active' : '' }}"> <a href="{{ route('my_calendar') }}"> {{__('website.My Calendar')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'my_favorite_hosts') ? 'active' : '' }}" > <a href="{{ route('my_favorite_hosts') }}"> {{__('website.Favorite Hosts')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'my_invites') ? 'active' : '' }}"> <a href="{{ route('my_invites') }}"> {{__('website.My Invites')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'my_invitations') ? 'active' : '' }}"> <a href="{{ route('my_invitations') }}"> {{__('website.Invitations')}} </a></li>
        <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form2').submit();"> {{__('website.Logout')}} </a></li>
        <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</div>
