// JavaScript Document

// All Sliders Starts

$(function() {
    $(".relative-events-slider").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        adaptiveHeight: true,
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
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true
                }
            },

            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true
                }
            }
        ]
    });

    $(".profile-event-list").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        vertical: true,
        infinite: false,
        adaptiveHeight: true
    });

    $(".profile-slider-slick").slick({
        infinite: true,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        adaptiveHeight: true,
        rows: 2,
        slidesPerRow: 6,
        responsive: [
            {
                breakpoint: 769,
                settings: {
                    rows: 2,
                    slidesPerRow: 3,
                    arrows: false,
                    autoplay: true
                }
            }
        ]
    });

    $(".banner-slider").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        adaptiveHeight: true
    });

    $(".sub-banner-slider").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        adaptiveHeight: true
    });

    $(".home-sub-section-slider").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true
                }
            }

            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $(".fav-hosts-user").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        adaptiveHeight: true,
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

    $(".home-host-section-slider").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: false,
        autoplaySpeed: 2000,
        adaptiveHeight: true,
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

function make_chosen() {
    $(".selectpicker").chosen(); //selectpicker
}
make_chosen();

 
 

// chosen dropdown list ends

// chosen dropdown menu button starts

$(function() {
    $(".register-options").click(function() {
        $(this)
            .parents("div.dropdown")
            .find("#dropdownMenuButton")
            .text($(this).text());
        $(this)
            .parents("div.dropdown")
            .find("#dropdownMenuButton")
            .val($(this).text());
    });

    $(".language-options").click(function() {
        $(this)
            .parents("div.dropdown")
            .find("#dropdownMenuButton")
            .text($(this).text());
        $(this)
            .parents("div.dropdown")
            .find("#dropdownMenuButton")
            .val($(this).text());
    });
});

// chosen dropdown menu button ends

//------------

if(disabledDays == '') {
   var  disabledDays = ["2018-8-21", "2018-8-24", "2018-8-27", "2018-8-30"];
}

if(disabledDays != '') {
    var date = new Date();
    jQuery(document).ready(function () {
        $(".datepicker-display").datepicker({
            dateFormat: "yy-mm-dd",
            numberOfMonths: 2,
            beforeShowDay: function (date) {
                var m = date.getMonth(),
                    d = date.getDate(),
                    y = date.getFullYear();
                for (i = 0; i < disabledDays.length; i++) {
                    if (
                        $.inArray(y + "-" + (m + 1) + "-" + d, disabledDays) != -1
                    ) {
                        //return [false];
                        return [true, "ui-state-active", "Holiday"];
                    }
                }

                return [true];
            },
            onSelect: function(dateText, inst) {
                // alert(dateText);

               $("input[name='date']").val(dateText);
            }

        });

        var debounce;
        // Your window resize function
        $(window)
            .resize(function () {
                // Clear the last timeout we set up.
                clearTimeout(debounce);
                // Your if statement
                if ($(window).width() < 768) {
                    // Assign the debounce to a small timeout to "wait" until resize is over
                    debounce = setTimeout(function () {
                        // Here we're calling with the number of months you want - 1
                        debounceDatepicker(1);
                    }, 250);
                    // Presumably you want it to go BACK to 2 or 3 months if big enough
                    // So set up an "else" condition
                } else {
                    debounce = setTimeout(function () {
                        // Here we're calling with the number of months you want - 3?
                        debounceDatepicker(2);
                    }, 250);
                }
                // To be sure it's the right size on load, chain a "trigger" to the
                // window resize to cause the above code to run onload
            })
            .trigger("resize");

        // our function we call to resize the datepicker
        function debounceDatepicker(no) {
            $(".datepicker-display").datepicker("option", "numberOfMonths", no);
        }
    });
}
// var disabledDays = ["2018-8-21", "2018-8-24", "2018-8-27", "2018-8-30"];
if(disabledDays != '') {
    var date = new Date();
    jQuery(document).ready(function () {
        $(".sub-datepicker-display").datepicker({
            dateFormat: "yy-mm-dd",
            numberOfMonths: 1,
            beforeShowDay: function (date) {
                var m = date.getMonth(),
                    d = date.getDate(),
                    y = date.getFullYear();

                for (i = 0; i < disabledDays.length; i++) {
                    if (
                        $.inArray(y + "-" + (m + 1) + "-" + d, disabledDays) != -1
                    ) {
                        //return [false];
                        return [true, "ui-state-active", "Holiday"];
                    }
                }
                return [true];
            },
            onSelect: function(dateText, inst) {
                $("input[name='date']").val(dateText);
            }

        });
    });
}
//--------

//--------

// the selector will match all input controls of type :checkbox
// and attach a click event handler
//$("input:checkbox").on("click", function() {
//    // in the handler, 'this' refers to the box clicked on
//    var $box = $(this);
//    if ($box.is(":checked")) {
//        // the name of the box is retrieved using the .attr() method
//        // as it is assumed and expected to be immutable
//        var group = "input:checkbox[name='" + $box.attr("name") + "']";
//        // the checked state of the group/box on the other hand will change
//        // and the current value is retrieved using .prop() method
//        $(group).prop("checked", false);
//        $box.prop("checked", true);
//    } else {
//        $box.prop("checked", false);
//    }
//});

//--------

//--------

$("#filter").accordion({
    canToggle: true,
    canOpenMultiple: true
});
$(".loading").removeClass("loading");

//--------

//--------

lightbox.option({
    resizeDuration: 200,
    wrapAround: true
});

//--------

//--------

var $tpl = $("#professionname").clone(true);
$("#professionname select.selectpicker_1").chosen();
var num = 0;

$("#clone").click(function() {
    num++;
    var $cloned = $tpl.clone(true);
    $cloned.attr("id", $tpl.attr("id") + "_" + num);
    //$(':not([id=""])', $cloned).each(function() {
    //    $(this).attr("id", $(this).attr("id") + "_" + num);
    //});
    $cloned.appendTo("#appendtxt");
    $cloned.append('<div class="edit-btn remove-btn">X</div>');
    $cloned.find("select.selectpicker_1").chosen();
    $('#company_certificate_profession_from').trigger('liszt:updated');
    $('#company_certificate_profession_to').trigger('liszt:updated');
});

//--------

//--------

var $tpls = $("#socialmedia_name2").clone(true);
$("#socialmedia_name2 select.selectpicker_1").chosen();
var num = 0;

$("#clone2").click(function() {
    num++;
    var $cloned = $tpls.clone(true);
    $cloned.attr("id", $tpls.attr("id") + "_" + num);
    //$(':not([id=""])', $cloned).each(function() {
    //    $(this).attr("id", $(this).attr("id") + "_" + num);
    //});
    $cloned.appendTo("#appendtxt2");
    $cloned.append('<div class="edit-btn remove-btn">X</div>');
    $cloned.find("select.selectpicker_1").chosen();
});
//--------


//----------
$(document).delegate(".remove-btn", "click", function () {
    $(this).parent().remove();
});
//----------



//--------

$("#filter").accordion({
    canToggle: true,
    canOpenMultiple: true
});
// $(".loading").removeClass("loading");

$("#review").accordion({
    canToggle: true,
    canOpenMultiple: true
});

// $(".loading").removeClass("loading");

//--------

//--------

$(function() {
    var dateFormat = "mm/dd/yy",
        from = $("#from")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                minDate: 0
            })
            .on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
        to = $("#to")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1
            })
            .on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));
            });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }
});
$(function() {
    var dateFormat = "mm/dd/yy",
        from = $("#date_of_birth")
            .datepicker({
				
				
		dateFormat: 'yy-mm-dd',		      
        yearRange: '1970:c+1',
        changeMonth: true,
        changeYear: true,
	    minDate: new Date(1970, 10 - 1, 25),
        maxDate: '-5Y',
       
				
				
				
			
			}
			)
            
/*			.on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }*/
			
			
});
//--------

//--------
function nextStep() {
    var $active = $(".wizard .nav-tabs li.active");
    $active.next().removeClass("disabled");
    $(".wizard .nav-tabs li.active").addClass("upto");
    nextTab($active);
}
$(document).ready(function() {
    //Initialize tooltips
    $(".nav-tabs > li a[title]").tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on("show.bs.tab", function(e) {
        var $target = $(e.target);

        if ($target.parent().hasClass("disabled")) {
            return false;
        }
    });

    $(".next-stepxxx").click(function(e) {
        $(".upto").click(function() {
            var _currentItem = parseInt(
                $(this)
                    .find("a")
                    .attr("aria-controls")
                    .substr(-1)
            );
            var _total = $(".nav.nav-tabs [role='presentation']").length;
            for (var i = 0; i < _total; i++) {
                if (i > _currentItem) {
                    var _item = $(".nav.nav-tabs")
                        .find("a[href='#step" + i + "']")
                        .parent();
                    _item.addClass("disabled").removeClass("upto");
                }
            }
        });

        var $active = $(".wizard .nav-tabs li.active");
        $active.next().removeClass("disabled");
        $(".wizard .nav-tabs li.active").addClass("upto");
        nextTab($active);
    });
    $(".prev-step").click(function(e) {
        var $active = $(".wizard .nav-tabs li.active");
        $(".wizard .nav-tabs li.active").removeClass("upto");
        $(".wizard .nav-tabs li.active").addClass("disabled");
        prevTab($active);
    });
});

function nextTab(elem) {
    $(elem)
        .next()
        .find('a[data-toggle="tab"]')
        .click();
}
function prevTab(elem) {
    $(elem)
        .prev()
        .find('a[data-toggle="tab"]')
        .click();
}
//--------

//---------

$(function() {
    var options = {
        map: ".map_canvas",
        location: "Kuwait City",
        // country: "kw",
        mapOptions: {
            zoom: 10
        }
    };

    $("#geocomplete").geocomplete(options);
});

//---------


//--------
$(".pChk").click(function() {
    if ($(this).is(":checked")) {
        $("#optional-profession").show();
    } else {
        $("#optional-profession").hide();
    }
});
//--------

//--------

var $tplsection = $(".repete-li").clone(true);
var num = 0;
var selvalue = $(".section-select").val();

$(".section-select").change(function() {
    $(".section-appendto ").empty();

    $('select[name*="event_group_price_price_type_id["]').each(function(){
        $(this).empty();
    });

    var optionAppend = [];


    for (i = 1; i <= $(this).val(); i++) {
        var $cloned = $tplsection.clone(true);
        $cloned.attr("id", $tplsection.attr("id") + "_" + num);

        $cloned.find('[name]').each(function(){
            $(this).attr('name', String($(this).attr('name')).replace('[1]', '['+i+']'));
        });

        optionAppend.push(new Option(i, i, i==1, i==1));

        $cloned.appendTo(".section-appendto");
    }

    $('select[name*="event_group_price_price_type_id["]').each(function(){
        $(this).empty();
        $(this).append($(optionAppend).clone());
        $(this).chosen().trigger('liszt:updated');
    });

    $('select[name*="event_group_price_ticket_no["]').each(function(){
        $(this).chosen();
    });

    num++;
});

//--------

//--------

var $tplimage = $(".repete-li3").clone(true);
var num = 0;

$(".add-pic").click(function() {
    //$('.section-appendto3').empty();

    var $cloned = $tplimage.clone(true);
    // $cloned.attr('id', $tplimage.attr('id') + '_' + num);
    // $(':not([id=""])', $cloned).each(function(){
    // $(this).attr('id', $(this).attr('id') + '_'+num);
    //});

    //$('.section-appendto').empty();

    $cloned.appendTo(".section-appendto3");
    $cloned.addClass("ican-edit");
    $cloned.append('<div class="edit-btn remove-btn">X</div>');
    num++;
});

//--------

//--------

var $tplvideo = $(".repete-li4").clone();
var num = 0;

$(".add-vid").click(function() {
    var $cloned = $tplvideo.clone();
    // $cloned.attr('id', $tplimage.attr('id') + '_' + num);
    // $(':not([id=""])', $cloned).each(function(){
    // $(this).attr('id', $(this).attr('id') + '_'+num);
    //});

    //$('.section-appendto').empty();

    $cloned.appendTo(".section-appendto4");
    $cloned.addClass("ican-edit");
    $cloned.append('<div class="edit-btn remove-btn">X</div>');
    num++;
});

//--------

//--------
var $tplgroup =
    $('<div class="pricing-row">')
        .append($('<div class="pricing-item">')
            .append('<label> Select Price </label>')
            .append($('<select name="event_group_price_price_type_id[0]" class="selectpicker">')
                .append(new Option(0, 0, true, true))
            )
        )
        .append($('<div class="pricing-item">')
            .append('<label> Number of Tickets </label>')
            .append($('<select name="event_group_price_ticket_no[0]" class="selectpicker">')
                .append(function() {
                    var appendArr = [];

                    for(i=2; i<=100; i++){
                        appendArr.push($('<option>').val(i).text(i));
                    }

                    return appendArr;
                })
            )
        )
        .append($('<div class="pricing-item kwd-before">')
            .append('<label> Group Price </label>')
            .append($('<input type="text" name="event_group_price_price[0]" class="normal-text-box decimal">'))
        );

var num = 0;
var selvalue = $(".group-select").val();

$(".group-select").change(function() {
    $(".section-appendto2 ").empty();


    var optionAppend = [];
    $('.section-appendto .repete-li input[name*="event_multiple_price_name_en["]').each(function(index){
        optionAppend.push(new Option(String($(this).val())==''? index+1: $(this).val(), index+1, index==0, index==0));
    });

    for (i = 1; i <= $(this).val(); i++) {
        var $cloned = $tplgroup.clone();

        $cloned.find('[name]').each(function(){
            $(this).attr('name', String($(this).attr('name')).replace('[0]', '['+i+']'));
        });

        $cloned.find('select[name*="event_group_price_price_type_id["]').each(function(){
            $(this).empty();
            $(this).append($(optionAppend).clone());
        });

        $cloned.appendTo(".section-appendto2");
    }

    $('select').each(function(){
        $(this).chosen().trigger('liszt:updated');
    });

    num++;
});

//--------


//--------
$(document).on('change', 'input[name*="event_multiple_price_name_en["]', function(){

    var $text = $(this).val(),
    $id = String($(this).attr('name')).match(/\d+/);

    if($id.length>0){
        $id=$id[0];
    }
    else {
        $id=0;
    }

    $('select[name*="event_group_price_price_type_id["] option[value="'+$id+'"]').each(function () {
        $(this).text($text);
    });

    $('select[name*="event_group_price_price_type_id["]').each(function () {
        $(this).trigger('liszt:updated');
    });
});
//--------


//--------

$(".single-pattern").click(function() {
    if ($(this).is(":checked")) {
        $("#its-single").show();
        $("#its-multi").hide();
        $("#its-multi-group").hide();
    } else {
        $("#its-single").hide();
    }
});

$(".multi-pattern").click(function() {
    if ($(this).is(":checked")) {
        $("#its-multi").show();
        $("#its-multi-group").show();
        $("#its-single").hide();
    } else {
        $("#its-multi").hide();
        $("#its-multi-group").hide();
    }
});

$(".fee-event").click(function() {
    if ($(this).is(":checked")) {
        $(".pattern-options").show();

          if($('.multi-pattern').is(':checked')) {
            $("#its-single").hide();
            $("#its-multi").show();
            $("#its-multi-group").show();
          }
          else {
            $("#its-single").show();
            $("#its-multi").hide();
            $("#its-multi-group").hide();
          }
    } else {
        $(".pattern-options").hide();
        $("#its-multi").hide();
        $("#its-multi-group").hide();
    }
});

$(".free-event").click(function() {
    if ($(this).is(":checked")) {
        $(".pattern-options").hide();
        $("#its-multi").hide();
        $("#its-multi-group").hide();

    } else {
        $(".pattern-options").show();

      if($('.multi-pattern').is(':checked')) {
        $("#its-single").hide();
        $("#its-multi").show();
        $("#its-multi-group").show();
      }
      else {
        $("#its-single").show();
        $("#its-multi").hide();
        $("#its-multi-group").hide();
      }

    }
});

//--------

//--------

$(document).ready(function() {
    $("#calendar-booked").fullCalendar({
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,basicWeek,basicDay"
        },
        defaultDate: "2018-09-12",
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: "All Day Event",
                start: "2018-03-01"
            },
            {
                title: "Long Event",
                start: "2018-09-07",
                end: "2018-09-10"
            },
            {
                id: 999,
                title: "Repeating Event",
                start: "2018-03-09T16:00:00"
            },
            {
                id: 999,
                title: "Repeating Event",
                start: "2018-09-16T16:00:00"
            },
            {
                title: "Conference",
                start: "2018-03-11",
                end: "2018-03-13"
            },
            {
                title: "Meeting",
                start: "2018-03-12T10:30:00",
                end: "2018-03-12T12:30:00"
            },
            {
                title: "Lunch",
                start: "2018-03-12T12:00:00"
            },
            {
                title: "Meeting",
                start: "2018-03-12T14:30:00"
            },
            {
                title: "Happy Hour",
                start: "2018-03-12T17:30:00"
            },
            {
                title: "Dinner",
                start: "2018-03-12T20:00:00"
            },
            {
                title: "Birthday Party",
                start: "2018-03-13T07:00:00"
            },
            {
                title: "Click for Google",
                url: "http://google.com/",
                start: "2018-03-28"
            }
        ]
    });
});
//--------


$(document).on('keypress', 'input.numeric', function(e) {

    var key = e.which || e.charCode;
    if(key < 20){
        return false;
    }
    if(!/\d/.test(String.fromCharCode(key))){
        return false;
    }
});

$(document).on('keyup', 'input.numeric', function() {
    var $this = $(this);

    $this.val(String($this.val()).replace(/[^\d]/g,''))
});

$(document).on('keypress', 'input.decimal', function(e) {

    var key = e.which || e.charCode;
    if(key < 20){
        return false;
    }
    if(!/[\d.]/.test(String.fromCharCode(key))){
        return false;
    }

    if(String($(this).val()).indexOf('.')>-1 && String.fromCharCode(key)=='.') {
        return false
    }

});

$(document).on('keyup', 'input.decimal', function() {
    var $this = $(this);
    var $value = String($this.val());
    var posDot = $value.indexOf('.')+1;

    $this.val($value.substring(0, posDot).replace(/[^\d\.]/g,'')+$value.substring(posDot).replace(/[^\d]/g,''))
});


//--------


//--------
