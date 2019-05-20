// JavaScript Document

$(document).ready(function(){






 
	$('#addbtn-pro').click(function(){
		var newitem = $('#add-pro').val();
		var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));
		$('#list-pro').append('<a   id="'+uniqid+'"> <li id="'+uniqid+'" class="list-group-item"><input type="button" data-id="'+uniqid+'" class="listelement" value="X" /> '+newitem+'<input type="hidden" name="listed[]" value="'+newitem+'"></li> </a>');
		$('#add').val('');
		return false;
	});
    $('#list-pro').delegate(".listelement", "click", function() {
		var elemid = $(this).attr('data-id');
		$("#"+elemid).remove();
    });
 

	



	
	
	
	
	
	
	
	
});







