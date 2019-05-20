// JavaScript Document


// All Sliders Starts


$(function(){
	
	
	$('.relative-events-slider').slick({
			   
			  	infinite: true,
  				slidesToShow: 1,
  				slidesToScroll: 1,
				dots: false,
				arrows: false,
				autoplay: true,
  			  	autoplaySpeed: 2000,
			 	adaptiveHeight:true,
				responsive: [
    {
		
		
	
      breakpoint: 769,
      settings: {
         slidesToShow: 3,
  		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
       
      }
	  
	  
	  
	  
    },
	{
		
		
	
      breakpoint: 767,
      settings: {
         slidesToShow: 3,
  		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
       
      }
	  
	  
	  
	  
    },
	
	
	{
		
		
	
      breakpoint: 500,
      settings: {
         slidesToShow: 1,
  		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
       
      }
	  
	  
	  
	  
    }
	
	
	
	
    
 
  ]
		
			});
	
					$('.profile-event-list').slick({
			   
			  	infinite: true,
  				slidesToShow: 3,
  				slidesToScroll: 1,
				dots: false,
				arrows: true,
				autoplay: false,
  			  	autoplaySpeed: 2000,
				vertical:true,
				infinite:false,
			 	adaptiveHeight:true,
		
			});
			
			
			$('.profile-slider-slick').slick({
			   
			  	infinite: true,
  				dots: false,
				arrows: true,
				autoplay: false,
  			  	autoplaySpeed: 2000,
			 	adaptiveHeight:true,
				rows: 2,
				slidesPerRow: 6,
				responsive: [
    {
      breakpoint: 769,
     	 settings: {
		 rows: 2,
         slidesPerRow: 3,
		arrows: false,
		autoplay: true,
       
      }
    }
    
     
  ]
		
			});
		
		
		
		$('.banner-slider').slick({
			   
			  	infinite: true,
  				slidesToShow: 1,
  				slidesToScroll: 1,
				dots: false,
				arrows: true,
				autoplay: true,
  			  	autoplaySpeed: 2000,
			 	adaptiveHeight:true,
		
 });
 
 	$('.sub-banner-slider').slick({
			   
			  	infinite: true,
  				slidesToShow: 1,
  				slidesToScroll: 1,
				dots: false,
				arrows: true,
				autoplay: false,
  			  	autoplaySpeed: 2000,
			 	adaptiveHeight:true,
		
			});
			 
			
			
			$('.home-sub-section-slider').slick({
			   
			  	infinite: true,
  				slidesToShow: 3,
  				slidesToScroll: 1,
				dots: false,
				arrows: true,
				autoplay: false,
  			  	autoplaySpeed: 2000,
			 	adaptiveHeight:true,
				responsive: [
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
		arrows: false,
		autoplay: true,
       
      }
    }
    
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
		
			});
			
			
			
			$('.fav-hosts-user').slick({
			   
			  	infinite: true,
  				slidesToShow: 4,
  				slidesToScroll: 1,
				dots: false,
				arrows: true,
				autoplay: false,
  			  	autoplaySpeed: 2000,
			 	adaptiveHeight:true,
				responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
		arrows: false,
		autoplay: true
       
      }
    },
	{
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
		arrows: false,
		autoplay: true
       
      }
    }
    
     
  ]
				
			
			});
			
			
			
			
			
			
			
			
			
			$('.home-host-section-slider').slick({
			   
			  	infinite: true,
  				slidesToShow: 4,
  				slidesToScroll: 1,
				dots: false,
				arrows: true,
				autoplay: false,
  			  	autoplaySpeed: 2000,
			 	adaptiveHeight:true,
				responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
		arrows: false,
		autoplay: true
       
      }
    },
	{
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
		arrows: false,
		autoplay: true
       
      }
    }
    
     
  ]
				
			
			});
			
			
		 
		
	});
	
	
// All Sliders Ends



// chosen dropdown list starts	
	
function make_chosen(){
$(".selectpicker").chosen();   //selectpicker
 
 }
make_chosen();

// chosen dropdown list ends


// chosen dropdown menu button starts

 $(function(){

      $(".register-options").click(function(){
		  
		  
	 
	  $(this).parents("div.dropdown").find("#dropdownMenuButton").text($(this).text());
	  $(this).parents("div.dropdown").find("#dropdownMenuButton").val($(this).text());
	 });
	 
	 
	 $(".language-options").click(function(){
		  
		 
	 
	  $(this).parents("div.dropdown").find("#dropdownMenuButton").text($(this).text());
	  $(this).parents("div.dropdown").find("#dropdownMenuButton").val($(this).text());
	 });
   
   

});

// chosen dropdown menu button ends
 
 
 
 //------------
 
 var disabledDays = ["2018-8-21","2018-8-24","2018-8-27","2018-8-30"];
var date = new Date();
jQuery(document).ready(function() { 
    $( ".datepicker-display").datepicker({ 
        dateFormat: 'yy-mm-dd',
		numberOfMonths: 2,
        beforeShowDay: function(date) {
            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
            for (i = 0; i < disabledDays.length; i++) {
                if($.inArray(y + '-' + (m+1) + '-' + d,disabledDays) != -1) {
                    //return [false];
                    return [true, 'ui-state-active', 'Holiday'];
                }
            }
            return [true];

        }
    });
	
	
	
	var debounce;
  // Your window resize function
  $(window).resize(function() {
    // Clear the last timeout we set up.
    clearTimeout(debounce);
    // Your if statement
    if ($(window).width() < 768) {
      // Assign the debounce to a small timeout to "wait" until resize is over
      debounce = setTimeout(function() {
        // Here we're calling with the number of months you want - 1
        debounceDatepicker(1);
      }, 250);
    // Presumably you want it to go BACK to 2 or 3 months if big enough
    // So set up an "else" condition
    } else {
      debounce = setTimeout(function() {
        // Here we're calling with the number of months you want - 3?
        debounceDatepicker(2)
      }, 250);
    }
  // To be sure it's the right size on load, chain a "trigger" to the
  // window resize to cause the above code to run onload
  }).trigger('resize');

  // our function we call to resize the datepicker
  function debounceDatepicker(no) {
    $(".datepicker-display").datepicker("option", "numberOfMonths", no);
  }
	
	
});



var disabledDays = ["2018-8-21","2018-8-24","2018-8-27","2018-8-30"];
var date = new Date();
jQuery(document).ready(function() { 
    $( ".sub-datepicker-display").datepicker({ 
        dateFormat: 'yy-mm-dd',
		numberOfMonths: 1,
        beforeShowDay: function(date) {
            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
            for (i = 0; i < disabledDays.length; i++) {
                if($.inArray(y + '-' + (m+1) + '-' + d,disabledDays) != -1) {
                    //return [false];
                    return [true, 'ui-state-active', 'Holiday'];
                }
            }
            return [true];

        }
    });
});


 
 //--------
 
 //--------
 
 		// the selector will match all input controls of type :checkbox
// and attach a click event handler 


/*$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});*/





 //--------
 
 
 //--------
 
  
            $('#filter').accordion({
                canToggle: true,
                canOpenMultiple: true
            });
            $(".loading").removeClass("loading");
 
 //--------
 
 
  //--------
 
 lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
 
 //--------
 
 
 //--------
 
 var $tpl = $('#professionname').clone();
var num = 0

$('#clone').click(function () {
    num++;
    var $cloned = $tpl.clone();
	
    $cloned.attr('id', $tpl.attr('id') + '_' + num);
    $(':not([id=""])', $cloned).each(function(){
        $(this).attr('id', $(this).attr('id') + '_'+num); 
	
	


		
    });
	 
	 
    $cloned.appendTo('#appendtxt');
	
	

	
});
 //--------
 
 //--------
 
  var $tpls = $('#socialmedia_name2').clone();
var num = 0

$('#clone2').click(function () {
    num++;
    var $cloned = $tpls.clone();
    $cloned.attr('id', $tpl.attr('id') + '_' + num);
    $(':not([id=""])', $cloned).each(function(){
        $(this).attr('id', $(this).attr('id') + '_'+num); 
    });
    $cloned.appendTo('#appendtxt2');
});
 //--------
 
 //--------
 
    $('#filter').accordion({
                canToggle: true,
                canOpenMultiple: true
            });
            $(".loading").removeClass("loading");
			
			 $('#review').accordion({
                canToggle: true,
                canOpenMultiple: true
            });
            $(".loading").removeClass("loading");
 
 //--------
 
 
 //--------
 
 $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
		  numberOfMonths: 1,
		  minDate: 0
		  
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
 
 //--------
 
 
 
 
 
 //--------
 
 	$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
		 
		
		 
		$('.upto').click(function (){
			 
			var _currentItem = parseInt( $(this).find('a').attr("aria-controls").substr(-1));
			var _total = $(".nav.nav-tabs [role='presentation']").length;
			for	(var i = 0; i < _total; i++){
				if		(i >_currentItem )
				{
					 
					var _item =  $(".nav.nav-tabs").find("a[href='#step"+i+"']").parent();
					 _item.addClass("disabled").removeClass("upto")
					}
				
			}
			
			})
	
		
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
		$('.wizard .nav-tabs li.active').addClass('upto');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
		$('.wizard .nav-tabs li.active').removeClass('upto');
		$('.wizard .nav-tabs li.active').addClass('disabled');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
 //--------
 
 //---------
 
       $(function(){
        
        var options = {
          map: ".map_canvas",
          location: "Kuwait City",
		  country: 'kw'
        };
        
        $("#geocomplete").geocomplete(options);
		 
        
      });
 
 //---------
 
 
 
 
//---------
$('.upload').on('change',function(){
       	// output raw value of file input
      	 $('.filename').html($(this).val()); 
		
        // or, manipulate it further with regex etc.
        var filename = $(this).val();
        // .. do your magic
		 
        $('.filename').html(filename);
    });
	
	
	   	$('.upload-certificate').on('change',function(){
       	// output raw value of file input
      	 $('.filename-certificate').html($(this).val()); 
		
        // or, manipulate it further with regex etc.
        var filename = $(this).val();
        // .. do your magic
		 
        $('.filename-certificate').html(filename);
    });

  
//---------
 
 
 
 //--------
 	$('.pChk').click(function() {
    if( $(this).is(':checked')) {
        $("#optional-profession").show();
    } else {
        $("#optional-profession").hide();
    }
}); 
 //--------
 
 
 //--------
 
 var $tplsection = $('.repete-li').clone();
var num = 0;
var selvalue=$( ".section-select" ).val();

$('.section-select').change(function () {
	 
	$('.section-appendto ').empty();
	for(i=1; i<= $(this).val(); i++){
	var $cloned = $tplsection.clone();
    $cloned.attr('id', $tplsection.attr('id') + '_' + num);
   // $(':not([id=""])', $cloned).each(function(){
       // $(this).attr('id', $(this).attr('id') + '_'+num); 
    //});
	
	//$('.section-appendto').empty();
	 
    $cloned.appendTo('.section-appendto');
	}
    num++;
   
});
 
 //--------
 
 //--------
 
 var $tplimage = $('.repete-li3').clone();
var num = 0;
 

$('.add-pic').click(function () {
	 
	//$('.section-appendto3').empty();
	 
	var $cloned = $tplimage.clone();
   // $cloned.attr('id', $tplimage.attr('id') + '_' + num);
   // $(':not([id=""])', $cloned).each(function(){
       // $(this).attr('id', $(this).attr('id') + '_'+num); 
    //});
	
	//$('.section-appendto').empty();
	 
    $cloned.appendTo('.section-appendto3');
	 
    num++;
   
});
 
 //--------
 
 
 
 //--------
 
 var $tplvideo = $('.repete-li4').clone();
var num = 0;
 

$('.add-vid').click(function () {
	 
	//$('.section-appendto3').empty();
	 
	var $cloned = $tplvideo.clone();
   // $cloned.attr('id', $tplimage.attr('id') + '_' + num);
   // $(':not([id=""])', $cloned).each(function(){
       // $(this).attr('id', $(this).attr('id') + '_'+num); 
    //});
	
	//$('.section-appendto').empty();
	 
    $cloned.appendTo('.section-appendto4');
	 
    num++;
   
});
 
 //--------
 
 
  //--------
 var $tplgroup = $('.repete-li2').clone();
var num = 0;
var selvalue=$( ".group-select" ).val();

$('.group-select').change(function () {
	 
	$('.section-appendto2 ').empty();
	for(i=1; i<= $(this).val(); i++){
	
	var $cloned = $tplgroup.clone();
	
   // $cloned.attr('id', $tplgroup.attr('id') + '_' + num);
    // $(':not([id=""])', $cloned).each(function(){
     //    $(this).attr('id', $(this).attr('id') + '_'+num); 
    // });
	
	//$('.section-appendto').empty();
	 
    $cloned.appendTo('.section-appendto2');
	}
    num++;
   
});
 //--------
 
 
 //--------
 
 	$('.single-pattern').click(function() {
    if( $(this).is(':checked')) {
        $("#its-single").show();
		$("#its-multi").hide();
		$("#its-multi-group").hide();
    } else {
        $("#its-single").hide();
    }
}); 

$('.multi-pattern').click(function() {
    if( $(this).is(':checked')) {
        $("#its-multi").show();
		 $("#its-multi-group").show();
		$("#its-single").hide();
    } else {
        $("#its-multi").hide();
		$("#its-multi-group").hide();
    }
}); 

$('.fee-event').click(function() {
    if( $(this).is(':checked')) {
        $(".pattern-options").show();
		 
    } else {
        $(".pattern-options").hide();
    }
}); 

$('.free-event').click(function() {
    if( $(this).is(':checked')) {
       $(".pattern-options").hide();
		 
    } else {
         $(".pattern-options").show();
    }
}); 

 
 //--------
 
 
 //--------
 
   $(document).ready(function() {

    $('#calendar-booked').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: '2018-09-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2018-03-01'
        },
        {
          title: 'Long Event',
          start: '2018-09-07',
          end: '2018-09-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-03-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-09-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2018-03-11',
          end: '2018-03-13'
        },
        {
          title: 'Meeting',
          start: '2018-03-12T10:30:00',
          end: '2018-03-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2018-03-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2018-03-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2018-03-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2018-03-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2018-03-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2018-03-28'
        }
      ]
    });

  });
 //--------
 
 //--------
 
 
 $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: '2018-09-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2018-03-01'
        },
        {
          title: 'Long Event',
          start: '2018-09-07',
          end: '2018-09-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-03-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-09-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2018-03-11',
          end: '2018-03-13'
        },
        {
          title: 'Meeting',
          start: '2018-03-12T10:30:00',
          end: '2018-03-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2018-03-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2018-03-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2018-03-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2018-03-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2018-03-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2018-03-28'
        }
      ]
    });

  });
  
  
  
 //--------
 
 
