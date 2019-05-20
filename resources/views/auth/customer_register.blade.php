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

        <h1> {{__('website.Customer Registration')}} </h1>
        <div class="steps-wrap">
          <div class="row steps-row">
            <section>
              <div class="wizard">

                <form action="{{ route('customer_register') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                      <div class="form-hold">
                        <span class="invalid-feedback" id="errors_step1" role="alert">
                            </span>
                        <ul>

                            <li>
                                <label>{{__('website.Email')}}* </label>
                                <input type="email" name="email" class="normal-text-box" required>
                            </li>
                          <li>
                            <label>{{__('website.User Name')}}* </label>
                            <input type="text" id="name" name="name" class="normal-text-box" required>
                          </li>
                            <li>
                                <label>{{__('website.Full Name')}}* </label>
                                <input type="text" id="full_name" name="full_name" class="normal-text-box" required>
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
                                <label>{{__('website.Date of Birth')}}* </label>
                                <input type="text" name="date_of_birth" id="date_of_birth" class="normal-text-box" required>


                            </li>
                            <li class="height-limit-list">
                                <label> {{__('website.Gender')}}* </label>
                                <select name="gender" class="selectpicker">
                                    <option value="m">{{__('website.male')}}</option>
                                    <option value="f">{{__('website.female')}}</option>
                                </select>
                            </li>

                            <li class="height-limit-list">
                                <label> Country* </label>
                                <select name="country_id" class="selectpicker">
                                    @foreach ($countries as $country )
                                        <option value="{{$country->id}}">{{ $country['name_'.$lang] }} </option>
                                    @endforeach
                                </select>

                            </li>
                            <li class="height-limit-list">
                                <label> Notification* </label>
                                <select name="notification_type" class="selectpicker">

                                    <option value="{{ \App\User::All_NOTIFICATION_TYPE }}">{{__('website.Email & Mobile')}}</option>
                                    <option value="{{ \App\User::EMAIL_NOTIFICATION_TYPE }}">{{__('website.Email')}} </option>
                                    <option value="{{ \App\User::SITE_NOTIFICATION_TYPE }}">{{__('website.Mobile')}}</option>

                                </select>
                            </li>
                          <li>
                            <label>{{__('website.Profile Image')}} </label>
                            <div class="upload-btn-wrapper">
                              <button class="normal-btn blue-button">{{__('website.Browse')}} </button>

                              <input type="file" class="upload" name="avator" required />
                              <div class="filename"></div>
                            </div>
                          </li>
                            <li>
                                <label>{{__('website.Description')}}</label>
                                <textarea name="description" id="descriptionn" class="normal-text-box" required></textarea>

                            </li>
                            <div id="appendtxt2">
                                <ul id="socialmedia_name2">
                                    <li>
                                        <label> </label>
                                        <select name="social[type][]" class="selectpicker">
                                            <option value="1"> {{__('website.Instagram')}} </option>
                                            <option value="2">{{__('website.Facebook')}}</option>
                                            <option value="3">{{__('website.Linkedin')}}</option>
                                            <option value="4">{{__('website.Tiwtter')}}</option>
                                            <option value="5">{{__('website.Youtube')}}</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label> {{__('website.Your page link')}} </label>
                                        <input name="social[link][]" type="text" class="normal-text-box" required>
                                    </li>
                                </ul>
                            </div>
                          <li class="fullwidth-li">
                            <button id="step_1" type="submit" class="normal-btn blue-button big-button"> {{__('website.Next')}} </button>
                          </li>

                        </ul>

                      </div>
                    </div>

                    <!--  Step 2-->


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
          <h2>{{__('website.Benefits of Registering as a Customer')}} </h2>
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
              user_type:$("input[name='user_type']").val(),
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
