
$(document).ready(function(){
	$("#schoolForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success == true) {
					$("#schoolMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						clearForm()
						reLoad()
						
				}
				else {
					
						$.each(response.messages, function(index, value) {
							var key = $("#" + index);

							key.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.help-block').remove();							

							key.after(value);

						});
					}
				} // /success
			}); // /ajax

		return false;
	});
});// JavaScript Document


//update units
$(document).ready(function(){
	$("#schoolUpdateForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success == true) {
					$("#schoolUpdateMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						clearForm()
						reLoad()
						
				}
				else {
					
						$.each(response.messages, function(index, value) {
							var key = $("#" + index);

							key.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.help-block').remove();							

							key.after(value);

						});
					}
				} // /success
			}); // /ajax

		return false;
	});
});// JavaScript Document

//clear form input		
function clearForm()
{
	$('input[type="text"]').val('');
	$('select').val('');
	$(".form-group").removeClass('has-error').removeClass('has-success');
	$('.help-block').remove();	
}

//clear form input		
function resetUpdateForm(){
	$("#schoolUpdateForm")[0].reset();
	
	$(".form-group").removeClass('has-error').removeClass('has-success');
	$('.help-block').remove();	
}

//reload page
function reLoad(){
	window.location.reload(500);
	}

