<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="Rizit">
    <meta name="keywords" content="HTML,CSS,Jquery,JavaScript">
    <meta name="author" content="Mawaqaa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <!-- Stylesheets -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="{{ asset('css/build/bootstrap.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('css/build/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/build/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/build/master.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/build/activity.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/build/chosen.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/build/rizit_responsive.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/build/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/build/accordion.css') }}">
    <!--<link href="{{ asset('css/developer.css') }}" rel="stylesheet">-->
    {{--<link href="{{ asset('css/style.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/bootstrap-editable.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/build/slick.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/build/mini-event-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/build/lightbox.css')}}">
    <link rel="stylesheet" href="{{ asset('css/build/TubePopUp.css')}}">
    <link rel="stylesheet" href="{{ asset('css/build/fullcalendar.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.4/css/bootstrap-select.min.css">
    {{--
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    @yield('css')

</head>

<body>
    <script>
        
@if(Session::has('success'))
    swal("{{ Session::get('title') }}", "{{ Session::get('success') }}", "success");
@endif
@if(Session::has('error'))
    swal("{{ Session::get('title') }}", "{{ Session::get('error') }}", "error");
@endif
@if(Session::has('info'))
    swal("{{ Session::get('title') }}", "{{ Session::get('info') }}", "info");
@endif




</script>
    <div class="outer-wrapper full-width">
    @include('includes.header')
    @yield('content')
    @include('includes.footer')
    </div>

</body>
<script>
    {{-- swal("Good job!", "dsadsa54", "success"); --}}
        {{-- swal("Good job!", "sdnsakd", "info"); --}}
    @if(Session::has('success'))
      swal("{{ Session::get('title') }}", "{{ Session::get('success') }}", "success");
    @endif
    @if(Session::has('error'))
    swal("{{ Session::get('title') }}", "{{ Session::get('error') }}", "error");
    @endif
    @if(Session::has('info'))
    swal("{{ Session::get('title') }}", "{{ Session::get('info') }}", "info");
    @endif

</script>
<script src="{{ asset('js/mixitup.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-beta.2/lazyload.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.multidatespicker.js') }}"></script>
{{--<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>--}}
<script src="{{ asset('js/slick.min.js') }}"></script>

<script src="{{ asset('js/chosen.jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('jshome/bootstrap.js') }}"></script>
{{--<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>--}}
<script src="{{ asset('jshome/bootstrap-editable.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/load-more-button.js') }}"></script>
<script src="{{ asset('js/lightbox.js') }}"></script>
<script src="{{ asset('js/TubePopUp.jquery.js') }}"></script>
<script src="{{ asset('js/jquery.geocomplete.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.accordion.2.0.js') }}" charset="utf-8"></script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAK-Gre9zWhmlucKa4LUpLao6ZT3AnW7Kk&libraries=places"></script>
<script src="{{ asset('js/rizit_custom.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.js') }}"></script>
<script src="{{ asset('js/developer.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

{{--<script>--}}
    {{--$(function() {--}}
        {{--$('#Container').mixItUp();--}}
    {{--});--}}

{{--</script>--}}
<script>
    var containerEl = document.querySelector('.mixContainer');


    // var containerEl = document.querySelector('.container');

    var mixer = mixitup(containerEl, {
        animation: {
            effects: 'fade scale stagger(50ms)' // Set a 'stagger' effect for the loading animation
        },
        load: {
            filter: 'none' // Ensure all targets start from hidden (i.e. display: none;)
        }
    });

    // Add a class to the container to remove 'visibility: hidden;' from targets. This
    // prevents any flickr of content before the page's JavaScript has loaded.

    containerEl.classList.add('mixitup-ready');

    // Show all targets in the container

    mixer.show()
        .then(function() {
            // Remove the stagger effect for any subsequent operations

            mixer.configure({
                animation: {
                    effects: 'fade scale'
                }
            });
        });
    // $("#sub_category1").selectpicker();
    function get_subcategory($val) {
       $('#sub_category1').empty(); //remove all child nodes
        console.log($('#categories').val());
        var mySelect = $('#sub_category1');
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ route('get_sub_categories') }}",
            type: 'POST',
            cache: false,
            data: {'category_id':$('#categories').val(), '_token': $_token }, //see the $_token
            // datatype: 'html',
            beforeSend: function() {
                //something before send



            },
            success: function(data) {
                data.forEach(function(entry) {

                    // console.log(data.name_e);
                    var newOption = $('<option value="'+entry.id+'">'+entry.name_en+'</option>');
                    $('#sub_category1').append(newOption);
                    console.log($('#sub_category1').trigger("liszt:updated"));
                        // $('<option></option>').val(entry.id).html(entry.name_en)
                    // $("#sub_category1").append('');

                });
            }
        });
        // $('#sub_category1').selectpicker('refresh');

    }
    function add_contact($val) {

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ route('add_contact') }}",
            type: 'POST',
            cache: false,
            data: {'user_id':$val, '_token': $_token }, //see the $_token
            // datatype: 'html',
            beforeSend: function() {
                //something before send



            },
            success: function(data) {
                $('.adduser-hold').hide();
            }
        });
    }
    function add_favorite($val) {

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ route('add_favorite') }}",
            type: 'POST',
            cache: false,
            data: {'host_id':$val, '_token': $_token }, //see the $_token
            // datatype: 'html',
            beforeSend: function() {
                //something before send



            },
            success: function(data) {
                $('.addfavorite-hold').hide();
            }
        });
    }    
function notifiy_host($val) {

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ route('notifiy_host') }}",
            type: 'POST',
            cache: false,
            data: {'host_id':$val, '_token': $_token }, //see the $_token
            // datatype: 'html',
            beforeSend: function() {
                //something before send

            },
            success: function(data) {
                $('.adduser-hold').hide();
            }
        });
    }
</script>

@yield('lower_javascript')


<script> 

$(function(){

$(".dropdown-menu li a").click(function(){
  var selText = $(this).html();
  $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
});

});

</script>


<script>

jQuery(document).ready(function() { 
	var date = new Date();
 $('.datepicker-display1').multiDatesPicker({
	maxPicks: 2,
	//pickableRange: 90,
	adjustRangeToDisabled: true,
	numberOfMonths: 2,
	altField: '.FromToDate'
});
});


</script>

<script type="text/javascript">

 jQuery(function(){

jQuery("a.bla-1").YouTubePopUp();

 });
 // $(document).on("click", function () {
 //     console.log($("#showfiltermenu").hide());
 //     console.log($("#showfilter").hide());
 // });
</script> 

</html>
