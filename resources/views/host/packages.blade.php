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


                        <div class="balance-buying">
                            <h1> {{__('website.Please select your plan')}}</h1>
                            <p> {{__('website.You_can_buy_more_than_one_service_at_a_time_with_a_specific_duration_for_each_one_based_on_your_selections._Check_out_the_box_below_for_a_multi_purchases')}}</p>
                        </div>



                        <div class="form-hold">
                        <form action="{{ route('host.add_new_eas') }}" method="post">
                            {{ csrf_field() }}
                            <ul>
                                <li class="fullwidth-li">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-types">
                                        <tr>
                                            <th class="balance-head">{{__('website.Package')}}</th>
                                            <th class="balance-head">{{__('website.Unit')}} </th>
                                            <th class="balance-head">{{__('website.Price')}}</th>
                                        </tr>
                                          @foreach($eas as $ea)
                                            <input type="hidden" name="price{{ $ea->id }}" id="price{{ $ea->id }}" value="{{ $ea->price}}" />
                                        <tr>
                                            <td><div class="type-icon">{{ HTML::image($ea->logo) }}
                                                    <div class="value-status"> {{ $ea['name_'.$lang] }} </div>
                                                </div></td>
                                            <td>
                                                <select name="amount[]" id="amount{{ $ea->id }}" class="priceselect selectpicker" style="max-width:200px;" onchange="calc_packages(this.value,{{ $ea->price }})">
                                                    
                                                    @for($i =0 ; $i<= $ea->max_amount ; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>

                                                        @endfor
                                                </select></td>
                                            <td><label class="checkbox-container"  >{{ $selected_currency->symbol }}  {{ $ea->price }}

                                                </label> </td>
                                        </tr>
                                       @endforeach

                                    </table>
                                </li>
                                <li class="fullwidth-li" style="min-height:0px;"> <div class="total-amt"> {{__('website.Total')}}: <span id="total_price"></span>  </div> <button type="submit" class="normal-btn blue-button big-button next-step"> {{__('website.Confirm')}} </button></li>

                            </ul>
                        </form>
                        </div>

                        <div class="host-pan-head">

                            <h1> {{__('website.Active Host Plans')}} </h1>
                            <p>{{__('website.You_can_try_our_active_host_packages,_check_them_below.')}} </p>
                        </div>

                        <div class="tab-pane "   >
                            <div class="form-hold">
                                <form action="{{ route('host.add_new_package') }}" method="post">
                                    {{ csrf_field() }}
                                <ul>
                                    <li class="fullwidth-li">

                                        @foreach($packages as $package)
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-types hostplan">
                                            <tr>
                                                <th>{{__('website.Package name')}}</th>
                                                <th> {{__('website.Pack')}}</th>
                                                <th>{{__('website.Duration/Unit')}}</th>
                                            </tr>
                                            <tr>
                                                <td><label class="checkbox-container"  >{{ $package['name_'.$lang] }}
                                                        <input type="checkbox" class="pChk" name="package_id" value="{{ $package->id }}">
                                                        <span class="checkmark"></span> </label></td>
                                                <td><label class="checkbox-container normal-label"  >{{ $package->description }}
                                                    </label></td>
                                                <td><label class="checkbox-container normal-label"  >{{ $package->price }}
                                                    </label></td>
                                            </tr>




                                        </table>
                                        @endforeach
                                    </li>
                                    <li class="fullwidth-li">
                                        <button type="submit" class="normal-btn blue-button big-button next-step"> {{__('website.Confirm')}} </button>
                                    </li>
                                </ul>
                                </form>
                            </div>
                        </div>


                    </div>














                </div>

            </div>
        </section>
    </div>
    <script>
        function calc_packages(count , price) {
            var total = 0 ;
            $('.priceselect').each(function(i, obj) {

                var amount = $("#amount"+(i+1)).chosen().val();
                var price = $("#price"+(i+1)).val();
                total += amount*price;

                console.log(amount+' '+price)

                //test
            });



            $("#total_price").html(total);


        }
    </script>
@endsection
