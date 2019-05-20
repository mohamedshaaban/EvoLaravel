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
                    <h1> {{__('website.Balance')}} </h1>
                    <div class="balance-hold">
                        <div class="form-hold">
                            <div class="working-hours">{{__('website.Your Balance is')}}</div>
                            <ul>
                                <li class="fullwidth-li">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-types">
                                        <tr>
                                            <th class="balance-head">{{__('website.eas')}}</th>
                                            <th class="balance-head">{{__('website.Unit')}}' </th>
                                            <th class="balance-head">{{__('website.Duration')}}</th>
                                        </tr>
                                        <tr>
                                            <td><div class="type-icon"> <img src="{{ asset('images/event_icon.png')}}">
                                                    <div class="value-status"> {{__('website.Event')}}   </div>
                                                </div></td>
                                            <td><label class="checkbox-container"  >{{ $user->number_of_events }}

                                                </label></td>

                                            <td>
                                                @if($balance)
                                                    <label class="checkbox-container"  > {{date('d-m-Y', strtotime($balance->duration_date))   }}

                                                </label>  @endif</td>

                                        </tr>
                                        <tr>
                                            <td><div class="type-icon"> <img src="{{ asset('images/activity_icon.png')}}">
                                                    <div class="value-status"> {{__('website.Activity')}}   </div>
                                                </div></td>
                                            <td><label class="checkbox-container"  >{{ $user->number_of_activity }}

                                                </label> </td>
                                            <td>
                                                @if($balance)
                                                    <label class="checkbox-container"  >{{date('d-m-Y', strtotime($balance->duration_date))   }}

                                                </label> @endif</td>
                                        </tr>
                                        <tr>
                                            <td><div class="type-icon"> <img src="{{ asset('images/services_icon.png')}}">
                                                    <div class="value-status"> {{__('website.Service')}}   </div>
                                                </div></td>
                                            <td><label class="checkbox-container"  >{{ $user->number_of_services }}

                                                </label> </td>
                                            <td>
                                                @if($balance)
                                                    <label class="checkbox-container"  > {{date('d-m-Y', strtotime($balance->duration_date))   }}

                                                </label>@endif </td>
                                        </tr>


                                    </table>
                                </li>

                            </ul>
                        </div>
                    </div>








                    <div class="tab-hold balance-details">
                        <div class="balance-buying">
                            <h1> {{__('website.Know_what_you_are_buying')}}</h1>
                            <p> {{__('website.Before_you_buy_a_package,_know_the_type_of_event_you_are_trying_to_host_please_check_the_details_before_Proceeding_with_your_purchase')}}</p>
                        </div>


                        <div class="full-width tab_cov">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs search-tabs balance-tabs" role="tablist">
                                <li role="presentation"> <a href="#service" aria-controls="service" role="tab" data-toggle="tab">
                                        {{__('website.SERVICE PACKAGE')}}</a> </li>
                                <li role="presentation"  > <a href="#events" aria-controls="events" role="tab" data-toggle="tab">
                                       {{__('website.EVENT PACKAGE')}} </a> </li>

                                <li role="presentation"  class="active" > <a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">
                                        {{__('website.ACTIVITY PACKAGE')}}</a> </li>

                            </ul>
                            <!-- /.nav_tabs -->

                            <!-- Tab panes -->
                            <div class="tab-content balance-buy">

                                @foreach($services as $ae)
                                    {!! $ae->description; !!}
                                    @endforeach

                            </div>



                        </div>





                    </div>

                    <div class="button-hold" style="margin-top:30px;">
                       <form action="{{ route('host.select_plan') }}" method="post" >
                           {{ csrf_field() }}
                        <button class="btn btn-secondary dropdown-toggle big-button blue-btn" type="submit" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
    {{__('website.Set your Plan')}}
</button>
</form>
</div>




</div>

</div>
</section>
</div>
@endsection
