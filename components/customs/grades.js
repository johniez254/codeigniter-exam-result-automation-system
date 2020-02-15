
$(document).ready(function(){
	$("#gradeForm").unbind('submit').bind('submit', function() {
		
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
					$("#gradeMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						$("html, body").animate({scrollTop: '0px'}, 100);
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
	$('textarea').val('');
	$('select').val('');
	$(".form-group").removeClass('has-error').removeClass('has-success');
	$('.help-block').remove();	
}

//clear form input		
function resetUpdateForm(){
	$("#updateGradesForm")[0].reset();
	
	$(".form-group").removeClass('has-error').removeClass('has-success');
	$('.help-block').remove();	
	$(".text-danger").remove();
}

//reload page
function reLoad(){
	setTimeout(function(){location.reload();},1000);
	//window.location.reload(500);
	}



//validateupdategradeform
function updateGradesForm(){
	$(document).ready(function() {	

		// create order form function
		$("#updateGradesForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.help-block').remove();
				

			// array validation
			var grade = document.getElementsByName('ugrade[]');				
			var validateGrade;
			for (var x = 0; x < grade.length; x++) {       			
				var gradeId = grade[x].id;	    	
		    if(grade[x].value == ''){	    		    	
		    	$("#"+gradeId+"").after('<small class="text-danger"> <i>Grade Field is required! </i></small>');
		    	$("#"+gradeId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+gradeId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < grade.length; x++) {       						
		    if(grade[x].value){	    		    		    	
		    	validateGrade = true;
	      } else {      	
		    	validateGrade = false;
	      }          
	   	} // for  
		
			// array validation
			var umark = document.getElementsByName('usmark[]');				
			var validateStart;
			for (var x = 0; x < umark.length; x++) {       			
				var umarkId = umark[x].id;	    	
		    if(umark[x].value == ''){	    		    	
		    	$("#"+umarkId+"").after('<small class="text-danger"> <i>Start Mark Field is required! </i></small>');
		    	$("#"+umarkId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+umarkId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < umark.length; x++) {       						
		    if(umark[x].value){	    		    		    	
		    	validateStart = true;
	      } else {      	
		    	validateStart = false;
	      }          
	   	} // for      		   	
	   	
			// array validation
				var emark = document.getElementsByName('uemark[]');				
				var validateEnd;
				for (var x = 0; x < emark.length; x++) {       			
					var emarkId = emark[x].id;	    	
				if(emark[x].value == ''){	    		    	
					$("#"+emarkId+"").after('<small class="text-danger"> <i>End Mark Field is required! </i></small>');
					$("#"+emarkId+"").closest('.form-group').addClass('has-error');	    		    	    	
			  } else {      	
					$("#"+emarkId+"").closest('.form-group').addClass('has-success');	    		    		    	
			  }          
			} // for
	
			for (var x = 0; x < emark.length; x++) {       						
				if(emark[x].value){	    		    		    	
					validateEnd = true;
			  } else {      	
					validateEnd = false;
			  }          
			} // for      		   	
	   	
			// array validation
				var gdesk = document.getElementsByName('ugdesk[]');				
				var validateDesc;
				for (var x = 0; x < gdesk.length; x++) {       			
					var gdeskId = gdesk[x].id;	    	
				if(gdesk[x].value == ''){	    		    	
					$("#"+gdeskId+"").after('<small class="text-danger"> <i>Grade Description is required! </i></small>');
					$("#"+gdeskId+"").closest('.form-group').addClass('has-error');	    		    	    	
			  } else {      	
					$("#"+gdeskId+"").closest('.form-group').addClass('has-success');	    		    		    	
			  }          
			} // for
	
			for (var x = 0; x < gdesk.length; x++) {       						
				if(gdesk[x].value){	    		    		    	
					validateDesc = true;
			  } else {      	
					validateDesc = false;
			  }          
			} // for 


				if(validateGrade === true && validateStart === true && validateEnd===true && validateDesc===true){ 
					// create order button
					//$("#updateBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#updateBtn").button('reset');
							$(".text-danger").remove();
							
							$(".help-block").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success === true) {
								
								// create order button
								$(".success-mess").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="fa fa-check-circle"></i></strong> '+ response.messages +
	            	''+
	            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);
							
							setTimeout(function(){location.reload();},500);
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			///} // /if field validate is true
			

			return false;
		}); // /create order form function		

}); // /documernt
}//validateupgradeform

				



