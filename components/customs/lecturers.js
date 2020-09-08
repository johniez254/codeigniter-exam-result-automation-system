
var option_rand=$("#reg_no").val();

$(document).ready(function(){
	$("#lecturerForm").unbind('submit').bind('submit', function() {
		
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
					$("#lecturerMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						$("html, body").animate({scrollTop: '0px'}, 100);
						clearForm();
						reLoad();
						
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


//update lecturers
$(document).ready(function(){
	$("#lecturerUpdateForm").unbind('submit').bind('submit', function() {
		
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
					$("#lecturerUpdateMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						$("html, body").animate({scrollTop: '0px'}, 100);
						reLoad();
						
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
	$("#reg_no").val(option_rand);
	$('textarea').val('');
	$('select').val('');
	$(".form-group").removeClass('has-error').removeClass('has-success');
	$('.help-block').remove();	
}

//clear form input		
function resetUpdateForm(){
	//$("#lecturerUpdateForm")[0].reset();
	$("#lecturerForm")[0].reset();
	$("#lecturerUpdateForm")[0].reset();
	
	$(".form-group").removeClass('has-error').removeClass('has-success');
	$('.help-block').remove();	
}

//reload page
function reLoad(){
	setTimeout(function(){location.reload();},1000);
	//window.location.reload(500);
	}

