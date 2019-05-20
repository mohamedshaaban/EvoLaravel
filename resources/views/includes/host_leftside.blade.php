<div class="left-link">
    <ul>
        <li class="{{ (\Request::route()->getName() == 'host.my_account') ? 'active' : '' }}"> <a href="{{ route('host.my_account') }}"> {{__('website.My Account')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.my_profile') ? 'active' : '' }}"> <a href="{{ route('host.my_profile') }}"> {{__('website.My Profile')}}  </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.my_professions') ? 'active' : '' }}"> <a href="{{ route('host.my_professions') }}"> {{__('website.My Settings')}}  </a></li>
        <li class="{{ (\Request::route()->getName() == 'event.create') ? 'active' : '' }}"> <a href="{{ route('event.create') }}"> {{__('website.create_event')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.my_media') ? 'active' : '' }}"> <a href="{{ route('host.my_media') }}"> {{__('website.My Media')}}  </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.my_terms') ? 'active' : '' }}"> <a href="{{ route('host.my_terms') }}"> {{__('website.Terms & Conditions')}}  </a></li>
        <li class="{{ in_array(\Request::route()->getName(), [ 'host.my_history_hosted', 'host.my_history_booked']) ? 'active' : '' }}"><a href="{{ route('host.my_history_hosted') }}"> {{__('website.History')}} </a></li>

        <li class="{{ (\Request::route()->getName() == 'host.my_contacts') ? 'active' : '' }}"> <a href="{{ route('host.my_contacts') }}"> {{__('website.Contacts')}} </a></li>
        <!--<li class="{{ (\Request::route()->getName() == 'host.my_badges') ? 'active' : '' }}"> <a href="{{ route('host.my_badges') }}"> {{__('website.Badges')}} </a></li>-->
        <li class="{{ (\Request::route()->getName() == 'host.my_calendar') ? 'active' : '' }}"> <a href="{{ route('host.my_calendar') }}"> {{__('website.My Calendar')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.my_favorite_hosts') ? 'active' : '' }}"> <a href="{{ route('host.my_favorite_hosts') }}"> {{__('website.Favorite Hosts')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.my_invites') ? 'active' : '' }}"> <a href="{{ route('host.my_invites') }}"> {{__('website.My Invites')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.my_invitations') ? 'active' : '' }}"> <a href="{{ route('host.my_invitations') }}"> {{__('website.Invitations')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.my_ratings') ? 'active' : '' }}"> <a href="{{ route('host.my_ratings') }}"> {{__('website.My Ratings')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host.account_balance') ? 'active' : '' }}"> <a href="{{ route('host.account_balance')}}"> {{__('website.Balance')}} </a></li>
        <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form2').submit();"> {{__('website.Logout')}} </a></li>
        <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</div>
