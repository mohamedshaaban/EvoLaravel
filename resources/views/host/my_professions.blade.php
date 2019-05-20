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

        <h1> {{__('website.My Settings')}} </h1>
        <div class="steps-wrap">
          <div class="row steps-row">
            <section>
              <div class="wizard my_stetting_wizrd">
                <div class="wizard-inner">
                  <div class="connecting-line"></div>
                  <ul class="nav nav-tabs three-steps" role="tablist">
                    <li role="presentation" class="active"> <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"> <span class="round-tab"> <i class="glyphicon  "> {{__('website.Professional Experience')}}</i> </span> </a>                      </li>
                    <li role="presentation" > <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" > <span class="round-tab"> <i class="glyphicon  "> {{__('website.Contact Information')}}</i> </span> </a>                      </li>
                    <li role="presentation" > <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" > <span class="round-tab"> <i class="glyphicon  "> {{__('website.Social Media Links')}}</i> </span> </a>                      </li>
                  </ul>
                </div>


                <form action="{{ route('host.change_profile_picture') }}" id="formhost" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="tab-content">



                    <!--  Step 2-->

                    <div class="tab-pane active" role="tabpanel" id="step1">
                      <div class="form-hold">
                      <div class="step-head"> <h2>  Professional Experience </h2></div>
                        <span class="invalid-feedback" id="errors_step2" role="alert">
                            </span>
                        <ul>
                          <li class="fullwidth-li">
                            <div class="chkbox-label"> {{__('website.Profession')}}* </div>
                            <div class="profession-list-hold">


                              @foreach ($professions as $profession )
                              <label class="checkbox-container">{{ $profession->ar_name}}
                                  <input value="{{ $profession->id }}" name="professions[]" @if(in_array($profession->id, $host_pro)) checked @endif class="professions_select" type="checkbox" >
                                  <span  class="checkmark"></span>
                                 </label> @endforeach

                            </div>
                          </li>
                          <li class="fullwidth-li">
                            <label class="checkbox-container">{{__('website.Add_Profession_if_your_profession_is_not_in_the_above_list')}}
                              <input name="additional_profession" type="checkbox" class="pChk" >
                              <span class="checkmark"></span> </label>

                            <div id="optional-profession" class="fullwidth-li" style="min-height:auto; margin-bottom:20px;">
                              <label>{{__('website.Your Profession')}} </label>
                              <input type="text" class="normal-text-box" style="max-width:200px;">
                            </div>
                          </li>

                          <li class="height-limit-list">
                            <label>{{__('website.Since (starting year)')}}* </label>

                            <select name="host[starting_year]" class="selectpicker">
                              <option value="1">{{__('website.Select starting year')}}</option>
                              <?php $last= date('Y')-60; ?>
                              <?php $now = date('Y'); ?>
                              
                              @for ($i = $now; $i >= $last; $i--)
                                  <option value="{{ $i }}" @if($host->starting_year == $i) selected @endif>{{ $i }}</option>
                              @endfor
                             
                            </select>
                          </li>
                            @if(Auth()->user()->role_id == \App\User::COMPANY_USER_TYPE_ID)
                          <li>
                            <label>{{__('website.Company Certificate')}}*</label>
                            <div class="upload-btn-wrapper">
                              <button class="normal-btn blue-button">{{__('website.Browse')}} </button>
                              <input type="file" class="upload-certificate" name="host[certifcate_file]" />
                              <div class="filename-certificate"></div>
                            </div>
                          </li>
                                @endif
                        </ul>
                            @if($host->user->userCertificate)
                          @foreach($host->user->userCertificate as $userCertificate)
                        <div id="professionname{{ $userCertificate->id }}">

                          <ul class="add-certificate-section" id="{{ $userCertificate->id }}">
                            <li>
                              <label>{{__('website.Profession Name')}} </label>
                              <input type="text" name="company_certificate_profession_name[]" value="{{$userCertificate->name}}" class="normal-text-box">
                            </li>
                            <li class="half-half-li height-limit-list">
                              <label>{{__('website.From')}} </label>
                              <select name="company_certificate_profession_from[]" class="selectpicker">
                                <option value="">{{__('website.From')}}</option>
                                <?php $last= date('Y')-60; ?>
                                <?php $now = date('Y'); ?>
    
                                @for ($i = $now; $i >= $last; $i--)
                                    <option  value="{{ $i }}" @if($userCertificate->from == $i) selected @endif>{{ $i }}</option>
                                @endfor
                              </select>
                            </li>
                            <li class="half-half-li height-limit-list">
                              <label>{{__('website.To')}} </label>
                              <select name="company_certificate_profession_to[]" class="selectpicker">
                                <option value="">To</option>
                                <?php $last= date('Y')-60; ?>
                              <?php $now = date('Y'); ?>
                              
                              @for ($i = $now; $i >= $last; $i--)
                                  <option value="{{ $i }}" @if($userCertificate->to == $i) selected @endif>{{ $i }}</option>
                              @endfor
                              </select>
                            </li>
                              <li>
                                  <span onclick="delete_Certificate({{ $userCertificate->id }})">{{__('website.delete certificate')}} </span>
                              </li>
                          </ul>

                        </div>
                          @endforeach
                          @endif
                          <div id="professionname">

                              <ul class="add-certificate-section" >
                                  <li>
                                      <label>{{__('website.Profession Name')}} </label>
                                      <input type="text" name="company_certificate_profession_name[]" class="normal-text-box">
                                  </li>
                                  <li class="half-half-li height-limit-list">
                                      <label>{{__('website.From')}} </label>
                                      <select name="company_certificate_profession_from[]" id="company_certificate_profession_from" class="selectpicker">
                                          <option value="">{{__('website.From')}}</option>
                                          <?php $last= date('Y')-60; ?>
                                          <?php $now = date('Y'); ?>

                                          @for ($i = $now; $i >= $last; $i--)
                                              <option value="{{ $i }}">{{ $i }}</option>
                                          @endfor
                                      </select>
                                  </li>
                                  <li class="half-half-li height-limit-list">
                                      <label>{{__('website.To')}} </label>
                                      <select name="company_certificate_profession_to[]" id="company_certificate_profession_to" class="selectpicker">
                                          <option value="">To</option>
                                          <?php $last= date('Y')-60; ?>
                                          <?php $now = date('Y'); ?>

                                          @for ($i = $now; $i >= $last; $i--)
                                              <option value="{{ $i }}" >{{ $i }}</option>
                                          @endfor
                                      </select>
                                  </li>

                              </ul>

                          </div>
                          <div id="appendtxt"></div>
                        <ul>
                          <li class="fullwidth-li"> <a class="normal-btn violate-button" id="clone"> {{__('website.Add More years with Certificate')}} </a> </li>
                          <li class="fullwidth-li">
                            <button type="button" class="normal-btn grey-button big-button prev-step"> {{__('website.Back')}} </button>
                            <button type="button" class="normal-btn blue-button big-button next-step" id="step_2" onclick="move_tab()"> {{__('website.Next')}} </button>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <!--  Step 3-->

                    <div class="tab-pane" role="tabpanel" id="step2">
                      <div class="form-hold">
                      
                      <div class="step-head"> <h2>  Contact Information </h2></div>
                        <span class="invalid-feedback" id="errors_step3" role="alert">
                            </span>
                        <ul class="half-width">
                          <div class="chkbox-label"> {{__('website.Working Hours')}}* </div>
                          <li class="half-half-li height-limit-list">
                            <label> {{__('website.From')}}* </label>
                            <?php
//                              dd(new DateTime($host->work_from));


                              $breakfrom= null;
                              $breakto= null;

                              $workfrom= null;
                              $workto= null;

                              if($host->work_from && $host->work_from!=1)
                              {
                                  $workfrom = new \Carbon\Carbon($host->work_from);
                              }


                              if($host->work_to && $host->work_to !=1)
                              {
                                  $workto = new \Carbon\Carbon($host->work_to);
//
                              }

                              if($host->break_from)
                                  {
                                      $breakfrom = new \Carbon\Carbon($host->break_from);

                                  }

                                  if($host->break_to)
                                      {
                                          $breakto = new \Carbon\Carbon($host->break_to);

                                      }

                              ?>
                            <select name="host[work_from]" id="contact_working_from" onchange="convertTimeFormat('contact_working_from_format','contact_working_from')" class="selectpicker">
                                <option value="">{{__('website.From')}}</option>
                              @for($i=1 ; $i <= 12 ; $i += 0.5)

                              <option value="{{ sprintf('%02d', $i) }}:00:00" @if($workfrom && $workfrom->format('h:i:s')==sprintf('%02d', $i).':00:00') selected @endif>{{ $i }}</option>
                              @endfor
                            </select>
                          </li>
                          <li class="half-half-li">
                            <label> </label>
                            <select onchange="convertTimeFormat('contact_working_from_format','contact_working_from')" id="contact_working_from_format"
                              class="selectpicker">
                                <option value=""  @if(!$workfrom) selected @endif>{{__('website.Select')}}</option>
                              <option value="AM" @if($workfrom && $workfrom->format('A')=='AM') selected @endif>AM</option>
                              <option value="PM" @if($workfrom && $workfrom->format('A')=='PM') selected @endif>PM</option>
                            </select>
                          </li>
                          <li class="half-half-li height-limit-list">
                            <label> {{__('website.To')}} </label>
                            <select onchange="convertTimeFormat('contact_working_to_format','contact_working_to')" name="host[work_to]" id="contact_working_to"
                              class="selectpicker">
                                <option value="">{{__('website.To')}}</option>

                                @for($i=1 ; $i <= 12 ; $i += 0.5)

                                    <option  value="{{ sprintf('%02d', $i) }}:00:00" @if($workto && $workto->format('h:i:s')==sprintf('%02d', $i).':00:00') selected @endif>{{ $i }}</option>
                              @endfor
                            </select>
                          </li>
                          <li class="half-half-li">
                            <label> </label>
                            <select onchange="convertTimeFormat('contact_working_to_format','contact_working_to')" id="contact_working_to_format" name=""
                              class="selectpicker">

                                <option value=""  @if(!$workto) selected @endif>{{__('website.Select')}}</option>
                              <option value="AM" @if($workto && $workto->format('A')=='AM') selected @endif>AM</option>
                              <option value="PM" @if($workto && $workto->format('A')=='PM') selected @endif>PM</option>
                            </select>
                          </li>
                        </ul>
                        <ul class="half-width">
                          <div class="chkbox-label"> {{__('website.Break_Hours_if_you_have_any_break_period,_please_specify')}} </div>
                          <li class="half-half-li height-limit-list">
                            <label> {{__('website.From')}} </label>
                            <select id="contact_break_from" name="host[break_from]" class="selectpicker">
                                <option value="">{{__('website.From')}}</option>
                                @for($i=1 ; $i <= 12 ; $i++)
                                <option value="{{ sprintf('%02d', $i) }}:00:00" @if($breakfrom && $breakfrom->format('h:i:s')==sprintf('%02d', $i).':00:00') selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                          </li>
                          <li class="half-half-li ">
                            <label> </label>
                            <select onchange="convertTimeFormat('contact_break_from_format','contact_break_from')" id="contact_break_from_format" class="selectpicker">
                                <option value=""  @if(!$breakfrom) selected @endif>{{__('website.Select')}}</option>
                                <option value="AM" @if($breakfrom && $breakfrom->format('A')=='AM') selected @endif>AM</option>
                              <option value="PM" @if($breakfrom && $breakfrom->format('A')=='PM') selected @endif>PM</option>
                            </select>
                          </li>
                          <li class="half-half-li height-limit-list">
                            <label> {{__('website.To')}} </label>
                            <select onchange="convertTimeFormat('contact_break_to_format','contact_break_to')" name="host[break_to]" id="contact_break_to"
                              class="selectpicker">
                                <option value="">{{__('website.To')}}</option>
                              @for($i=1 ; $i <= 12 ; $i++)
                              <option value="{{ sprintf('%02d', $i) }}:00:00" @if($breakto && $breakto->format('h:i:s')==sprintf('%02d', $i).':00:00') selected @endif>{{ $i }}</option>
                              @endfor
                            </select>
                          </li>
                          <li class="half-half-li">
                            <label> </label>
                            <select onchange="convertTimeFormat('contact_break_to_format','contact_break_to')" id="contact_break_to_format" class="selectpicker">
                              <option value=""  @if(!$breakto) selected @endif>{{__('website.Select')}}</option>
                              <option value="AM" @if($breakto && $breakto->format('A')=='AM') selected @endif>AM</option>
                              <option value="PM" @if($breakto && $breakto->format('A')=='PM') selected @endif>PM</option>
                            </select>
                          </li>
                        </ul>
                        <ul>
                          <li class="height-limit-list">
                            <label> {{__('website.Country')}}* </label>
                            <select name="address[country]" class="selectpicker">
                              @foreach ($countries as $country )
                              <option value="{{$country->id}}:00:00" @if($host->user->country_id==$country->id) selected @endif>{{ $country['name_'.$lang] }} </option>
                              @endforeach
                            </select>
                          </li>
                          <li>
                            <label>{{__('website.Address')}}* </label>
                            <input name="address[address]" value="{{ $host->location }}" type="text" class="normal-text-box">
                          </li>
                        </ul>
                        <ul>
                          <li class="qtr-qtr-li">
                            <label> {{__('website.Code')}} </label>
                            <select class="selectpicker">
                              <option value="1">+965 </option>
                              <option value="2">+971</option>
                              <option value="2">+974</option>
                            </select>
                          </li>
                          <li>
                            <label>{{__('website.Phone - landline')}} </label>
                            <input name="host[landline]" value="{{ $host->landline }}" type="text" class="normal-text-box">
                          </li>
                          <li class="qtr-qtr-li">
                            <label> {{__('website.Code')}} </label>
                            <select name="" class="selectpicker">
                              <option value="1">+965 </option>
                              <option value="2">+971</option>
                              <option value="2">+974</option>
                            </select>
                          </li>
                          <li>
                            <label>{{__('website.Phone - Mobile')}} </label>
                            <input name="host[mobile]" type="text" value="{{ $host->mobile }}" class="normal-text-box">
                          </li>
                        </ul>
                        <ul>
                            <li class="qtr-qtr-li">
                                <label> {{__('website.Code')}} </label>
                                <select name="" class="selectpicker">
                                    <option value="1">+965 </option>
                                    <option value="2">+971</option>
                                    <option value="2">+974</option>
                                </select>
                            </li>
                          <li>
                            <label>{{__('website.Whatsapp')}}* </label>
                            <input name="host[whatsapp]" type="text" value="{{ $host->whatsapp }}" class="normal-text-box">
                          </li>
                          <li>
                            <label>{{__('website.Email')}}* </label>
                            <input name="host[email]" type="email" value="{{ $host->email }}"  class="normal-text-box">
                          </li>
                          <li>
                            <label>{{__('website.Company name')}}* </label>
                            <input name="host[company_name]" type="text" value="{{ $host->company_name }}" class="normal-text-box">
                          </li>
                        </ul>
                        <ul>
                          <li class="fullwidth-li">
                            <button type="button" class="normal-btn grey-button big-button prev-step"> {{__('website.Back')}} </button>
                            <button id="step_3" type="button" class="normal-btn blue-button big-button next-step"> {{__('website.Next')}} </button>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <!--  Step 4-->

                    <div class="tab-pane" role="tabpanel" id="complete">
                     <div class="step-head"> <h2>  Social media Links </h2></div>
                      <div class="form-hold">
                      
                        <ul>
                          <li>
                            <label>{{__('website.Website')}} </label>
                            <input name="host[website]"  value="{{ $host->website }}" type="text" class="normal-text-box">
                          </li>
                        </ul>
                        <div id="appendtxt2">
                            @foreach($host->user->socailMedia as $social)
                                <input type="hidden" name="socialid{{ $social->id }}" value="{{ $social->id }}">
                          <ul id="socialmedia_name{{ $social->id }}">
                            <li>
                              <label> </label>
                              <select name="social[type][]" class="selectpicker">
                                <option value="1" @if($social->type ==1) selected @endif> {{__('website.Instagram')}} </option>
                                <option value="2" @if($social->type ==2) selected @endif>{{__('website.Facebook')}}</option>
                                <option value="3" @if($social->type ==3) selected @endif>{{__('website.Linkedin')}}</option>
                                <option value="3" @if($social->type ==4) selected @endif>{{__('website.Twitter')}}</option>
                                <option value="3" @if($social->type ==5) selected @endif>{{__('website.Youtube')}}</option>
                              </select>
                            </li>
                            <li>
                              <label> {{__('website.Your page link')}} </label>
                              <input name="social[link][]" type="text" value="{{ $social->link }}" class="normal-text-box">
                            </li>
                              <li>
                                  <span onclick="delete_social({{ $social->id }})">{{__('website.delete social')}} </span>
                              </li>
                          </ul>
                                @endforeach
                                <ul id="socialmedia_name">
                                    <li>
                                        <label> </label>
                                        <select name="social[type][]" class="selectpicker">
                                            <option value="1" > {{__('website.Instagram')}} </option>
                                            <option value="2" >{{__('website.Facebook')}}</option>
                                            <option value="3" >{{__('website.Linkedin')}}</option>
                                            <option value="4" >{{__('website.Twitter')}}</option>
                                            <option value="5" >{{__('website.Youtube')}}</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label> {{__('website.Your page link')}} </label>
                                        <input name="social[link][]" type="text"  class="normal-text-box">
                                    </li>

                                </ul>
                        </div>
                        <ul>
                          <li> <a class="normal-btn violate-button" id="clone2"> {{__('website.Add more links')}} </a> </li>
                          <li class="fullwidth-li">
                            <button type="button" class="normal-btn grey-button big-button prev-step"> {{__('website.Back')}} </button>
                            <button type="submit" class="normal-btn blue-button big-button next-step"> {{__('website.Submit Form')}} </button>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                </form>

              </div>
            </section>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
 
@section('lower_javascript') //convert time to 24 hours in step 3
<script>
  function convertTimeFormat(selectedFormat , selectedTime){
      $("#" + selectedTime + " option:selected").val($("#" + selectedTime + " option:selected").text());

      if($('#' + selectedFormat ).val() == 'PM'){
        val =  parseInt($('#' + selectedTime ).val() )+ 12 + ':00:00' ;
        if(val.length<8)
        {
            val='0'+val;
        }
        $("#" + selectedTime + " option:selected").val(val);
      }
      else{
        val =  parseInt($('#' + selectedTime ).val()) + ':00:00' ;
          if(val.length<8)
          {
              val='0'+val;
          }
        $("#" + selectedTime + " option:selected").val(val);
      }

    }

</script>

// #validation steps
<script>
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var url = '{{ route('host_register.validation')}}';
  // step 1
  $('#upload_from').click(function(){
      $('#formhost').attr('action', '{{ route('host.change_profile_picture') }}');

      $('#formhost').submit();
  });
  $('#step_0').click(function() {
      alert('243');
      $('#formhost').attr('action', '{{ route('host.change_profile_picture') }}');
      nextStep();
  });
  $('#step_1').click(function(){
      alert('243567');
     console.log($('#formhost').attr('action', '{{ route('host_edit_profile') }}'));
    var step1_data = $('form').serialize();
        
        $.ajax({
            url: url,
            type: 'POST',
            data: {
              _token: CSRF_TOKEN,
              user_type:$("input[name='user_type']:checked").val(),
              name:$("input[name='name']").val(),
              password:$("input[name='password']").val(),
              password_confirmation:$("input[name='password_confirmation']").val(),
              email:$("input[name='email']").val(),
              step:1
            },
            dataType: 'JSON',
            success: function (data) { 
            
              if(data.error){
                $('#errors_step1').html('');
                $.each( data.error, function( key, value ) {
                  $('#errors_step1').append('<strong>'+ value  +'</strong><br />');
                  swal("", "Please fill in the required fields", "error");
                });
              }else{
                $('#errors_step1').html('');
                nextStep();
              }
            }
          
        }); 
     
      });
      // step 2 
      $("#step_2").click(function(){


          var professions= [];
        $("input:checkbox[class=professions_select]:checked").each(function(){
          professions.push($(this).val());
        });

        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: CSRF_TOKEN,
            starting_year : $("select[name='host[starting_year]']").val(),
            certifcate_file:$("input[name='host[certifcate_file]']").val(),
            professions:$("input[name='professions[]']").val(), 
            user_type:$("input[name='user_type']").val(),
            professions:professions,
            step: 2,
          },
          dataType: 'JSON',
          success: function (data) { 
            if(data.error){
              $('#errors_step2').html('');
              $.each( data.error, function( key, value ) {
                $('#errors_step2').append('<strong>'+ value  +'</strong><br />');
              });
              swal("", "Please fill in the required fields", "error");
            }else{
              $('#errors_step2').html('');
              nextStep();
            }
          }
      }); 
      // step 3
      $("#step_3").click(function(){
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            _token: CSRF_TOKEN,
           starting_year : $("select[name='host[starting_year]']").val(),
           work_from : $("select[name='host[work_from]']").val(),
           work_to : $("select[name='host[work_to]']").val(),
           break_from : $("select[name='host[break_from]']").val(),
           break_to : $("select[name='host[break_to]']").val(),
           landline : $("input[name='host[landline]']").val(),
           mobile : $("input[name='host[mobile]']").val(),
           whatsapp : $("input[name='host[whatsapp]']").val(),
           email : $("input[name='host[email]']").val(),
           company_name : $("input[name='host[company_name]']").val(),
            step: 3,
          },
          dataType: 'JSON',
          success: function (data) { 
            if(data.error){
              $('#errors_step3').html('');
              $.each( data.error, function( key, value ) {
                $('#errors_step3').append('<strong>'+ value  +'</strong><br />');
              });
              swal("", "Please fill in the required fields", "error");
            }else{
              $('#errors_step3').html('');
              nextStep();
            }
          }          
      }); 
    }); 
        
      });
      function move_tab() {
          $('#formhost').attr('action', '{{ route('host_edit_profile') }}');
      }
  function delete_social(id)
  {
      $_token = "{{ csrf_token() }}";
      $.ajax({
          headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
          url: "{{ route('host.deletesocial') }}",
          type: 'POST',
          cache: false,
          data: {'social_id':id, '_token': $_token }, //see the $_token
          // datatype: 'html',
          beforeSend: function() {
              //something before send



          },
          success: function(data) {
              $( "#socialmedia_name"+id ).empty();
          }
      });

  }
  function delete_Certificate(id)
  {
      $_token = "{{ csrf_token() }}";
      $.ajax({
          headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
          url: "{{ route('host.deletecertificate') }}",
          type: 'POST',
          cache: false,
          data: {'certiificate_id':id, '_token': $_token }, //see the $_token
          // datatype: 'html',
          beforeSend: function() {
              //something before send



          },
          success: function(data) {
              $( "#professionname"+id ).empty();
          }
      });

  }
</script>
@endsection