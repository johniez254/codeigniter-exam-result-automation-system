/*
*-------------------------------
* add result row
*-------------------------------
*/

var base_url = $("#base_url").val();



//remove selected row
	function removeResultRow(row=null) {
	if(row) {
		$("#tr"+row).remove();
		//subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}


                   
  //get students
	function get_students(id) {
		
	var courses = $("#s2example-7").val();
	var units = $("#s2example-8").val();
	var lecturer = $("#lect_id").val();

    	$.ajax({
            url: base_url+'lecturer/attendance_crud/get_student/'+id+'/'+courses+'/'+units+'/'+lecturer,
            success: function(response)
            {
                jQuery('.display').html(response);
            }
        });

    }
	
//get semester
	function get_semester(id) {

    	$.ajax({
            url: base_url+'student/result_crud/get_semester/'+id ,
            success: function(response)
            {
                jQuery('#s2example-1').html(response);
            }
        });

    }
	
	//get result
	function get_result(id) {

    	$.ajax({
            url: base_url+'student/result_crud/get_result/'+id ,
            success: function(response)
            {
                jQuery('.result').html(response);
            }
        });

    }
	
	
 

function getPercentage(row = null) {
    if(row) {
		
		$("#orderbuttonsdisabled").remove();
		$("#orderbuttons").show(100);
		
	  var attendance=Number($("#att"+row).val());
	  if(attendance>=100){
		  
		  $("#att"+row).val("0");

	  }
    } else {
      alert('no row !! please refresh the page');
    }
  }
  
  	//add attendance
		function validateResult(){
		$(document).ready(function() {	

		// create order form function
		$("#createAttendanceForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$(".help-block").remove();
				
			var course = $("#s2example-7").val();
			var units = $("#s2example-8").val();
			//var ac_year = $("#s2example-6").val();		

			// form validation 
			if(course == "") {
				$("#s2example-7").after('<p class="help-block"> Select Course! </p>');
				$('#s2example-7').closest('.form-group').addClass('has-error');
			} else {
				$('#s2example-7').closest('.form-group').addClass('has-success');
			} // /else
			
			if(units == "") {
				$("#s2example-8").after('<p class="help-block"> Please select Unit! </p>');
				$('#s2example-8').closest('.form-group').addClass('has-error');
			}else {
				$('#s2example-8').closest('.form-group').addClass('has-success');
			} // /else


			
			if(course && units) {
				//if(validateCat == true && validateFinal == true) {
					// create order button
					$("#createResultBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createResultBtn").button('reset');
							
							$(".help-block").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".createAttendanceMessage").html('<div class="alert alert-success">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="fa fa-check-circle"></i></strong> <b>'+ response.messages +
								   '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							document.getElementById("orderbuttons").style.display="none";
							// remove the product row
							$(".removeResultRowBtn").addClass('disabled');
							
							reLoad()
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				//} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /create order form function		

}); // /documernt
}//validateresult


  	//validate update result form
				function validateUpdateResult(){
				$(document).ready(function() {	

		// create order form function
		$("#updateResultForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$(".help-block").remove();
				
			//var course = $("#s2example-7").val();
			var units = $("#s2example-8").val();
			var ac_year = $("#s2example-6").val();		

			// form validation 
			if(units == "") {
				$("#s2example-8").after('<p class="help-block"> Please select Unit! </p>');
				$('#s2example-8').closest('.form-group').addClass('has-error');
			}else {
				$('#s2example-8').closest('.form-group').addClass('has-success');
			} // /else

			if(ac_year == "") {
				$("#s2example-6").after('<p class="help-block"> Please select Academic Year </p>');
				$('#s2example-6').closest('.form-group').addClass('has-error');
			} else {
				$('#s2example-6').closest('.form-group').addClass('has-success');
			} // /else/ 


			// array validation
			var cats = document.getElementsByName('cat[]');				
			var validateCat;
			for (var x = 0; x < cats.length; x++) {       			
				var catId = cats[x].id;	    	
		    if(cats[x].value == ''){	    		    	
		    	$("#"+catId+"").after('<p class="text-danger"> CAT Field is required!! </p>');
		    	$("#"+catId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+catId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < cats.length; x++) {       						
		    if(cats[x].value){	    		    		    	
		    	validateCat = true;
	      } else {      	
		    	validateCat = false;
	      }          
	   	} // for       		   	
	   	
	   	var finals = document.getElementsByName('final[]');		   	
	   	var validateFinal;
	   	for (var x = 0; x < finals.length; x++) {       
	 			var finalId = finals[x].id;
		    if(finals[x].value == ''){	    	
		    	$("#"+finalId+"").after('<p class="help-block"> <i>The final Field is required!! </i></p>');
		    	$("#"+finalId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+finalId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < finals.length; x++) {       						
		    if(finals[x].value){	    		    		    	
		    	validateFinal = true;
	      } else {      	
		    	validateFinal = false;
	      }          
	   	} // for       	
	   	

			if(units && ac_year) {
				if(validateCat == true && validateFinal == true) {
					// create order button
					$("#createResultBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createResultBtn").button('reset');
							
							$(".help-block").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="fa fa-check-circle"></i></strong> <b>'+ response.messages +
								   '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							document.getElementById("orderbuttons").style.display="none";
							// remove the product row
							$(".removeResultRowBtn").addClass('disabled');
							
							reLoad()
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /create order form function		

}); // /documernt
}//validate update result

function get_unit(){
	document.getElementById("displayUnit").style.display="block";
}

function get_year(){
	document.getElementById("displayYear").style.display="block";
}

//reload page
function reLoad(){
	window.location.reload(500);
	}
