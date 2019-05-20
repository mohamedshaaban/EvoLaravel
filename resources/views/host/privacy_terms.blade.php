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
                    <h1> @if($type == 1 )
                            {{__('website.PRIVACY POLICY')}}
                        @else
                            {{__('website.TERMS & CONDITIONS')}}
                        @endif</h1>
                    <div class="listing-title blue-title">

                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}"
                               style="width: 100%;">{{ Session::get('message') }}</p>
                        @elseif(Session::has('alert'))
                            <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}"
                               style="width: 100%;">{{ Session::get('alert') }}</p>
                        @endif
                    </div>

                    <div class="review-list">

                        @if(Auth::User())
                            <form action="{{ route('host.add_terms_privacy') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="type" value="{{$type}}">
                                <div class="profile-review">


                                    </a>
                                </div>

                                <div style="clear:both;"></div>

                                <div class="cmnt-box">
                                    <label>  </label>
                                    <textarea name="desc" required> @if($data) {{ $data->content }}@endif </textarea>
                                </div>

                                <div  class="full-width">
                                    <button type="submit" class="normal-btn blue-button big-button next-step"> {{__('website.Submit')}} </button>
                                </div>

                    </div>
                    </form>
                            @endif
                    </div>
                </div>
                <div class="row"></div>
            </div>
        </section>
    </div>

@endsection
