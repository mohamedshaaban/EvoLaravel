<footer class="full-width footer-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 quick-links">
        <h2>{{__('website.Quick links')}}</h2>
        <ul>
          <li><a href="{{route('pages' , 'faq')}}">{{__('website.FAQs')}}</a></li>
          <li><a href="{{route('pages' , 'about_us')}}">{{__('website.About Us')}} </a></li>
          <li><a href="{{route('pages' , 'contact_us')}}">{{__('website.contact us')}}</a></li>
          <li><a href="{{route('pages' , 'privacy_policy')}}">{{__('website.Privacy Policy')}}</a></li>
          <li><a href="{{route('pages' , 'terms_and_conditions')}}">{{__('website.Terms and Conditions')}}</a></li>

        </ul>

      </div>
      <!-- /.col-lg-4 -->

      <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-6 footer-right-part ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 for-small text-center right-side-footer">
          <h2>{{__('website.Payment Methods')}}</h2>
          <div class="icon_container full-width payment-icons"> <a href="#"><img src="{{ asset('images/kent_card.jpg')}}" alt="Knet"> <span>  {{__('website.Knet')}}</span>  </a> <a href="#"><img src="{{ asset('images/visa_card.jpg') }}" alt="Visa card"> <span>  {{__('website.Visa Card')}} </span></a>            <a href="#"><img src="{{ asset('images/master_card.jpg') }}"  alt="Master card"> <span>  {{__('website.Master Card')}}  </span> </a>            </div>
          <!-- /.icon_container -->

        </div>
        <!-- /.col-lg-4 -->

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 for-small text-center right-side-footer">
          <h2>{{__('website.Download App')}}</h2>
          <div class="icon_container full-width payment-icons">
            <a href="{{ $setting['app_store_link']}}"><img src="{{ asset('images/ios_download.png') }}" alt="Ios App"> 
              </a> <a href="{{ $setting['google_store_link']}}"><img src="{{ asset('images/android_download.png') }}" alt="Android App"> </a>
          </div>
          <!-- /.icon_container -->

        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 for-small text-center right-side-footer">
          <h2>{{__('website.Social media')}}</h2>
          <div class="icon_container full-width social-media">
            <a href="{{ $setting['twitter']}} "><img src="{{ asset('images/twiter.png') }}" alt="Twiter">   </a>
            <a href="{{ $setting['facebook']}} "><img src="{{ asset('images/fb.png')}}" alt="Facebook"> </a>
            <a href="{{ $setting['instgram']}} "><img src="{{ asset('images/instagram.png') }}" alt="Instagram"> </a>
          </div>
          <!-- /.icon_container -->

        </div>


      </div>

      <!-- /.col-lg-4 -->

      <div class="col-xs-12 copy-hold">
        <div class="col-xs-6 copytext">
          <p class="copy_right">{{ $setting['copy_right_'. $lang]}} </p>
        </div>

        <div class="col-xs-6 power ">
          <a href="http://www.mawaqaa.com"> <img src="{{ asset('images/power.png')}}">  </a>
        </div>

      </div>

      <!-- /.col-xs-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</footer>
<!-- /#footer -->