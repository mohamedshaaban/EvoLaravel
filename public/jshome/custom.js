/*================================
	Author 		 : Jishnu Vs
	Project		 : Swan
	Start-Date   : 21 / Aug / 2017
  ================================ */



(function($, window, document) {
	
"use strict";

$(function() {
	
	$('#bannerSlide').owlCarousel({
		loop:true,
		margin:30,
		nav:true,
		autoPlay: true,
		navText: ["<img src='images/icons/ban_prev.png'>","<img src='images/icons/ban_next.png'>"],
		responsive:{
			0:{
				items:1
			}
		}
	});
	
	$('#slideFirst').owlCarousel({
		loop:true,
		nav:false,
		dots:true,
		autoPlay: true,
		responsive:{
			0:{
				items:1
			}
		}
	});
	$('#slideTwo').owlCarousel({
		loop:true,
		nav:false,
		dots:true,
		autoPlay: true,
		responsive:{
			0:{
				items:1
			}
		}
	});
	
	
	$('.owl-carousel_main2').owlCarousel({
		loop:true,
		margin:30,
		nav:true,
		autoPlay: true,
		navText: ["<img src='images/icons/main_prev.png'>","<img src='images/icons/main_next.png'>"],
		responsive:{
			0:{
				items:1
			},
			490:{
				items:2
			},
			992:{
				items:3
			},
			1000:{
				items:5
			}
		}
	});
	
	$('.owl-carousel_second').owlCarousel({
		loop:true,
		margin:30,
		nav:false,
		autoPlay: true,
		responsive:{
			0:{
				items:2
			},
			490:{
				items:3
			},
			992:{
				items:3
			},
			1000:{
				items:4
			}
		}
	});
	
	
var select = document.getElementById('input-select');

// Append the option elements
for ( var i = 200; i <= 1000; i++ ){

	var option = document.createElement("option");
		option.text = i;
		option.value = i;

	select.appendChild(option);
}


var html5Slider = document.getElementById('html5');

noUiSlider.create(html5Slider, {
	start: [ 0, 1000 ],
	connect: true,
	range: {
		'min': 200,
		'max': 1000
	}
});

var inputNumber = document.getElementById('input-number');

html5Slider.noUiSlider.on('update', function( values, handle ) {

	var value = values[handle];

	if ( handle ) {
		inputNumber.value = value;
	} else {
		select.value = Math.round(value);
	}
});

select.addEventListener('change', function(){
	html5Slider.noUiSlider.set([this.value, null]);
});

inputNumber.addEventListener('change', function(){
	html5Slider.noUiSlider.set([null, this.value]);
});


	
		
});
        //


	
}(window.jQuery, window, document));
