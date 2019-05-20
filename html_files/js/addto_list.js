// JavaScript Document

$(document).ready(function(){
	$('#addbtn').click(function(){
		var newitem = $('#add').val();
		var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));
		$('#list').append('<a   id="'+uniqid+'"> <li id="'+uniqid+'" class="list-group-item"><input type="button" data-id="'+uniqid+'" class="listelement" value="X" /> '+newitem+'<input type="hidden" name="listed[]" value="'+newitem+'"></li> </a>');
		$('#add').val('');
		return false;
	});
    $('#list').delegate(".listelement", "click", function() {
		var elemid = $(this).attr('data-id');
		$("#"+elemid).remove();
    });
 





 
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
 


 
	$('#addbtn-pro-new').click(function(){
		var newitem = $('#add-pro-new').val();
		var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));
		$('#list-pro').append('<a   id="'+uniqid+'"> <li id="'+uniqid+'" class="list-group-item"><input type="button" data-id="'+uniqid+'" class="listelement" value="X" /> '+newitem+'<input type="hidden" name="listed[]" value="'+newitem+'"></li> </a>');
		$('#add').val('');
		return false;
	});
    $('#list-pro').delegate(".listelement", "click", function() {
		var elemid = $(this).attr('data-id');
		$("#"+elemid).remove();
    });
	
	


 
	$('#addbtn-gro').click(function(){
		var newitem = $('#add-gro').val();
		var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));
		$('#list-gro').append('<a   id="'+uniqid+'"> <li id="'+uniqid+'" class="list-group-item"><input type="button" data-id="'+uniqid+'" class="listelement" value="X" /> '+newitem+'<input type="hidden" name="listed[]" value="'+newitem+'"></li> </a>');
		$('#add').val('');
		return false;
	});
    $('#list-gro').delegate(".listelement", "click", function() {
		var elemid = $(this).attr('data-id');
		$("#"+elemid).remove();
    });
 


 
	$('#addbtn-gro-new').click(function(){
		var newitem = $('#add-gro-new').val();
		var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));
		$('#list-gro').append('<a  id="'+uniqid+'"> <li id="'+uniqid+'" class="list-group-item"><input type="button" data-id="'+uniqid+'" class="listelement" value="X" /> '+newitem+'<input type="hidden" name="listed[]" value="'+newitem+'"></li> </a>');
		$('#add').val('');
		return false;
	});
    $('#list-gro').delegate(".listelement", "click", function() {
		var elemid = $(this).attr('data-id');
		$("#"+elemid).remove();
    });
	
	
	
	
	
	$('#addbtn-spo').click(function(){
		var newitem = $('#add-spo').val();
		var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));
		$('#list-spo').append('<a   id="'+uniqid+'"> <li id="'+uniqid+'" class="list-group-item"><input type="button" data-id="'+uniqid+'" class="listelement" value="X" /> '+newitem+'<input type="hidden" name="listed[]" value="'+newitem+'"></li> </a>');
		$('#add').val('');
		return false;
	});
    $('#list-gro').delegate(".listelement", "click", function() {
		var elemid = $(this).attr('data-id');
		$("#"+elemid).remove();
    });
 


 
	$('#addbtn-spo-new').click(function(){
		var newitem = $('#add-spo-new').val();
		var uniqid = Math.round(new Date().getTime() + (Math.random() * 100));
		$('#list-spo').append('<a   id="'+uniqid+'"> <li id="'+uniqid+'" class="list-group-item"><input type="button" data-id="'+uniqid+'" class="listelement" value="X" /> '+newitem+'<input type="hidden" name="listed[]" value="'+newitem+'"></li> </a>');
		$('#add').val('');
		return false;
	});
    $('#list-spo').delegate(".listelement", "click", function() {
		var elemid = $(this).attr('data-id');
		$("#"+elemid).remove();
    });
	
	
	
	
	
	
	
	
	
});







