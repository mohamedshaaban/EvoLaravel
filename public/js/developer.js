
$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});



if($('#username').length)
{
    $('#username').editable({
        type: 'text',
        url: '/edit_username',
        title: 'Enter username'
    });
}
if($('#email').length)
{
    $('#email').editable({
        type: 'text',
        url: '/edit_username',
        title: 'Enter email'
    });
}
if($('#description').length)
{
    $('#description').editable({
        type: 'textarea',
        url: '/edit_username',
        title: 'Enter Description'
    });
}
if($('#hostwebsite').length)
{
    $('#hostwebsite').editable({
        type: 'text',
        url: '/edit_username',
        title: 'Enter Website'
    });
}
if($('#hostcontactemail').length)
{
    $('#hostcontactemail').editable({
        type: 'text',
        url: '/edit_username',
        title: 'Enter Contact Email'
    });
}
if($('#hostlandline').length)
{
    $('#hostlandline').editable({
        type: 'text',
        url: '/edit_username',
        title: 'Enter Landline'
    });
}
if($('#hostwhatsapp').length)
{
    $('#hostwhatsapp').editable({
        type: 'text',
        url: '/edit_username',
        title: 'Enter whatsapp'
    });
}if($('#hostlocation').length)
{
    $('#hostlocation').editable({
        type: 'text',
        url: '/edit_username',
        title: 'Enter location'
    });
}if($('#hostmobile').length)
{
    $('#hostmobile').editable({
        type: 'text',
        url: '/edit_username',
        title: 'Enter mobile'
    });
}
// $(".img").each(function() {
//
//     $(this).attr("data-src",$(this).attr("src"));
//     $(this).attr('src', '/images/loading.gif')
//
//
//     // console.log($(this)[0].outerHTML);
// });
// let images = document.querySelectorAll("img");
// lazyload(images);

$(window).load(function() {
    $('img').each(function() {
        if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
            // image was broken, replace with your new image
            this.src = '/uploads/Rizit_logo.png';
        }
    });
});