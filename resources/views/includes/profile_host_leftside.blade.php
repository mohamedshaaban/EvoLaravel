<div  class="left-link">
    <ul>
        <li  class="{{ (\Request::route()->getName() == 'host_profile') ? 'active' : '' }}"> <a href="{{ route('host_profile',['host_name'=>$host->user->name]) }}"> {{__('website.Info')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host_media') ? 'active' : '' }}"> <a href="{{ route('host_media',['host_id'=>$host->id]) }}"> {{__('website.Media')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'hosted_items') ? 'active' : '' }}"> <a href="{{ route('hosted_items',['host_id'=>$host->id]) }}"> {{__('website.Hosted Items')}} </a></li>
        <li class="{{ (\Request::route()->getName() == 'host_rating') ? 'active' : '' }}"> <a href="{{ route('host_rating',['host_id'=>$host->id]) }}"> {{__('website.Rating and Reviews')}} </a></li>
        <!--<li class="{{ (\Request::route()->getName() == 'host_badges') ? 'active' : '' }}"> <a href="{{ route('host_badges',['host_id'=>$host->id]) }}"> {{__('website.Badges')}} </a></li>-->
    </ul>
</div>
