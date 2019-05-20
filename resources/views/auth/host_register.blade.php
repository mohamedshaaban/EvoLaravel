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
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 right-contents-hold">

        <h1> {{__('website.Host Registration')}} </h1>
        <div class="steps-wrap">
          <div class="row steps-row">
            <section>
              <div class="wizard">
                <div class="wizard-inner">
                  <div class="connecting-line"></div>
                  <ul class="nav nav-tabs 4-steps" role="tablist">
                    <li role="presentation" class="active"> <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" > <span class="round-tab"> <i class="glyphicon  "> {{__('website.Host Type and  Identification')}}</i> </span> </a>                      </li>
                    <li role="presentation" class="disabled"> <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" > <span class="round-tab"> <i class="glyphicon  "> {{__('website.Professional Experience')}}</i> </span> </a>                      </li>
                    <li role="presentation" class="disabled"> <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" > <span class="round-tab"> <i class="glyphicon  "> {{__('website.Contact Information')}}</i> </span> </a>                      </li>
                    <li role="presentation" class="disabled"> <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" > <span class="round-tab"> <i class="glyphicon  "> {{__('website.Social Media Links')}}</i> </span> </a>                      </li>
                  </ul>
                </div>
                <form action="{{ route('host_register') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                      <div class="form-hold">
                        <span class="invalid-feedback" id="errors_step1" role="alert">
                            </span>
                        <ul>

                          <li class="fullwidth-li">
                            <div class="chkbox-label"> {{__('website.Register as')}}*: </div>
                            <div class="chkbox-container-hold" id="user_type">
                              <label class="checkbox-container">{{__('website.Professional')}}
                                <input type="radio" onclick="display_certificate(this.value)" name="user_type" value="{{ App\User::PROFESSIONAL_USER_TYPE_ID }}">
                                <span class="checkmark"></span> 
                              </label>
                              <label class="checkbox-container">{{__('website.Group')}}
                                <input type="radio" name="user_type" onclick="display_certificate(this.value)" value="{{ App\User::GROUP_USER_TYPE_ID }}">
                                <span class="checkmark"></span> 
                              </label>
                              <label class="checkbox-container">{{__('website.Company')}}
                                <input type="radio" name="user_type" onclick="display_certificate(this.value)" value="{{ App\User::COMPANY_USER_TYPE_ID }}">
                                <span class="checkmark"></span> 
                              </label>
                            </div>
                          </li>
                          <li>
                            <label>{{__('website.Email')}}* </label>
                            <input type="email" name="email" class="normal-text-box" required>
                          </li>
                          <li>
                            <label>{{__('website.Name')}}* </label>
                            <input type="text" id="name" name="name" class="normal-text-box" required>
                          </li>
                          <li>
                            <label>{{__('website.User Name')}}* </label>
                            <input type="text" id="name" name="name" class="normal-text-box" required>
                          </li>
                          <li>
                            <label>{{__('website.Password')}}* </label>
                            <input type="password" name="password" class="normal-text-box" required>
                          </li>
                          <li>
                            <label>{{__('website.Re-Enter Password')}}* </label>
                            <input type="password" id="" name="password_confirmation" class="normal-text-box" required>
                          </li>

                          <li>
                            <label>{{__('website.Profile Image')}} </label>
                            <div class="upload-btn-wrapper">
                              <button class="normal-btn blue-button">{{__('website.Browse')}} </button>

                              <input type="file" class="upload" name="avator" />
                              <div class="filename"></div>
                            </div>
                          </li>
                          <li class="fullwidth-li">
                            <button id="step_1" type="button" class="normal-btn blue-button big-button"> {{__('website.Next')}} </button>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <!--  Step 2-->

                    <div class="tab-pane" role="tabpanel" id="step2">
                      <div class="form-hold">
                        <span class="invalid-feedback" id="errors_step2" role="alert">
                            </span>
                        <ul>
                          <li class="fullwidth-li">
                            <div class="chkbox-label"> {{__('website.Profession')}}* </div>
                            <div class="profession-list-hold">
                              @foreach ($professions as $profession )
                              <label class="checkbox-container">{{ $profession->ar_name}}
                                  <input value="{{ $profession->id }}" name="professions[]"  class="professions_select" type="checkbox" >
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
                                  <option value="{{ $i }}">{{ $i }}</option>
                              @endfor
                             
                            </select>
                          </li>
                          <li id="co_certifiacate">
                            <label>{{__('website.Company Certificate')}}*</label>
                            <div class="upload-btn-wrapper">
                              <button class="normal-btn blue-button">{{__('website.Browse')}} </button>
                              <input type="file" class="upload-certificate" name="host[certifcate_file]" />
                              <div class="filename-certificate"></div>
                            </div>
                          </li>
                        </ul>
                        <div id="appendtxt">
                          <ul class="add-certificate-section ican-edit" id="professionname">
                            <li>
                              <label>{{__('website.Profession Name')}} </label>
                              <input type="text" name="company_certificate_profession_name[]" class="normal-text-box">
                            </li>
                            <li class="half-half-li height-limit-list">
                              <label>{{__('website.From')}} </label>
                              <select name="company_certificate_profession_from[]" class="selectpicker_1">
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
                              <select name="company_certificate_profession_to[]" class="selectpicker_1">
                                <option value="">To</option>
                                <?php $last= date('Y')-60; ?>
                              <?php $now = date('Y'); ?>
                              
                              @for ($i = $now; $i >= $last; $i--)
                                  <option value="{{ $i }}">{{ $i }}</option>
                              @endfor
                              </select>
                            </li>
                            <li>
                              <label>{{__('website.Certificate')}}</label>
                              <div class="upload-btn-wrapper">
                                <button class="normal-btn blue-button">{{__('website.Browse')}} </button>
                                <input type="file" name="company_profession_file[]" />
                              </div>							 
                            </li>
                          </ul>
                        </div>
                        <ul>
                          <li class="fullwidth-li"> <a class="normal-btn violate-button" id="clone"> {{__('website.Add More years with Certificate')}} </a> </li>
                          <li class="fullwidth-li">
                            <button type="button" class="normal-btn grey-button big-button prev-step"> {{__('website.Back')}} </button>
                            <button type="button" class="normal-btn blue-button big-button next-step" id="step_2"> {{__('website.Next')}} </button>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <!--  Step 3-->

                    <div class="tab-pane" role="tabpanel" id="step3">
                      <div class="form-hold">
                        <span class="invalid-feedback" id="errors_step3" role="alert">
                            </span>
                        <ul class="half-width">
                          <div class="chkbox-label"> {{__('website.Working Hours')}}* </div>
                          <li class="half-half-li height-limit-list">
                            <label> {{__('website.From')}}* </label>
                            <select name="host[work_from]" id="contact_working_from" class="selectpicker">
                              @for($i=1 ; $i <= 12 ; $i++)
                              <option value="{{ $i }}:00:00">{{ $i }}</option>
                              @endfor
                            </select>
                          </li>
                          <li class="half-half-li">
                            <label> </label>
                            <select onchange="convertTimeFormat('contact_working_from_format','contact_working_from')" id="contact_working_from_format"
                              class="selectpicker">
                              <option value="AM">AM</option>
                              <option value="PM">PM</option>
                            </select>
                          </li>
                          <li class="half-half-li height-limit-list">
                            <label> {{__('website.To')}} </label>
                            <select onchange="convertTimeFormat('contact_working_to_format','contact_working_to')" name="host[work_to]" id="contact_working_to"
                              class="selectpicker">
                                @for($i=1 ; $i <= 12 ; $i++)
                              <option value="{{ $i }}:00:00">{{ $i }}</option>
                              @endfor
                            </select>
                          </li>
                          <li class="half-half-li">
                            <label> </label>
                            <select onchange="convertTimeFormat('contact_working_to_format','contact_working_to')" id="contact_working_to_format" name=""
                              class="selectpicker">
                              <option value="AM">AM</option>
                              <option value="PM">PM</option>
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
                                <option value="{{ $i }}:00:00">{{ $i }}</option>
                                @endfor
                            </select>
                          </li>
                          <li class="half-half-li ">
                            <label> </label>
                            <select onchange="convertTimeFormat('contact_break_from_format','contact_break_from')" id="contact_break_from_format" class="selectpicker">
                              <option value="AM">AM</option>
                              <option value="PM">PM</option>
                            </select>
                          </li>
                          <li class="half-half-li height-limit-list">
                            <label> {{__('website.To')}} </label>
                            <select onchange="convertTimeFormat('contact_break_to_format','contact_break_to')" name="host[break_to]" id="contact_break_to"
                              class="selectpicker">
                              <option value="">{{__('website.To')}}</option>
                              @for($i=1 ; $i <= 12 ; $i++)
                              <option value="{{ $i }}:00:00">{{ $i }}</option>
                              @endfor
                            </select>
                          </li>
                          <li class="half-half-li">
                            <label> </label>
                            <select onchange="convertTimeFormat('contact_break_to_format','contact_break_to')" id="contact_break_to_format" class="selectpicker">
                              <option value="AM">AM</option>
                              <option value="PM">PM</option>
                            </select>
                          </li>
                        </ul>
                        <ul>
                          <li class="height-limit-list">
                            <label> {{__('website.Country')}}* </label>
                            <select name="address[country]" class="selectpicker">
                              @foreach ($countries as $country )
                              <option value="{{$country->id}}">{{ $country['name_'.$lang] }} </option>
                              @endforeach
                            </select>
                          </li>
                          <li>
                            <label>{{__('website.Address')}}* </label>
                            <input name="address[address]" type="text" class="normal-text-box">
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
                            <input name="host[landline]" type="text" class="normal-text-box">
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
                            <input name="host[mobile]" type="text" class="normal-text-box">
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
                            <input name="host[whatsapp]" type="text" class="normal-text-box">
                          </li>
                          <li>
                            <label>{{__('website.Email')}}* </label>
                            <input name="host[email]" type="email" class="normal-text-box">
                          </li>
                          <li>
                            <label>{{__('website.name')}}* </label>
                            <input name="host[company_name]" type="text" class="normal-text-box">
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
                      <div class="form-hold">
                        <ul>
                          <li>
                            <label>{{__('website.Website')}} </label>
                            <input name="host[website]" type="text" class="normal-text-box">
                          </li>
                        </ul>
                        <div id="appendtxt2">
                          <ul id="socialmedia_name2" class="ican-edit">
                            <li>
                              <label> </label>
                              <select name="social[type][]" class="selectpicker_1">
                                <option value="1"> {{__('website.Instagram')}} </option>
                                <option value="2">{{__('website.Facebook')}}</option>
                                <option value="3">{{__('website.Linkedin')}}</option>
                                <option value="4">{{__('website.Twitter')}}</option>
                                <option value="5">{{__('website.Youtube')}}</option>
                              </select>
                            </li>
                            <li>
                              <label> {{__('website.Your page link')}} </label>
                              <input name="social[link][]" type="text" class="normal-text-box">
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
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 left-links-hold">
        <div class="benifits-content">
          <h2>{{__('website.Benefits of Registering as a Host')}} </h2>
          <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae lectus elementum, accumsan nibh at, tempor
            lectus. Etiam fermentum, dolor vel mollis consectetur, purus libero vulputate turpis, id interdum libero tortor
            id orci. Cras euismod sapien est, eget bibendum leo ultrices a. </p>

        </div>
      </div>
    </div>
  </section>
</div>
@endsection
 
@section('lower_javascript') // #convert time to 24 hours in step 3
<script>
  function display_certificate(val)
  {
      if(val==3)
      {
          $('#co_certifiacate').show();
      }
      else
      {

          $('#co_certifiacate').hide();
      }
  }

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
  $('#step_1').click(function(){
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
           // break_from : $("select[name='host[break_from]']").val(),
           // break_to : $("select[name='host[break_to]']").val(),
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

</script>
@endsection