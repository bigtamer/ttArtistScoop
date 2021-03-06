/* found at: http://css-tricks.com/examples/SeminarRegTutorial */
// When the DOM is ready...
$(function(){
	
	// Hide stuff with the JavaScript. If JS is disabled, the form will still be useable.
	// NOTE:
	// Sometimes using the .hide(); function isn't as ideal as it uses display: none; 
	// which has problems with some screen readers. Applying a CSS class to kick it off the
	// screen is usually prefered, but since we will be UNhiding these as well, this works.
	$(".name_wrap").hide();
	$("#company_name_wrap").hide();
	$("#special_accommodations_wrap").hide();
	$("#terms_wrap").hide();
	
	// Reset form elements back to default values
	$("#submit_button").attr("disabled",true);
	$("#num_attendees").val('Please Choose');
	$("#step_2 input[type=radio]").each(function(){
		this.checked = false;
	});
	$("#rock").each(function(){
		this.checked = false;
	});
	
	// Fade out steps 2 and 3 until ready
	$("#step_2").css({ opacity: 0.3 });
	$("#step_3").css({ opacity: 0.3 });
	
	$.stepTwoComplete_one = "not complete";
	$.stepTwoComplete_two = "not complete"; 
		
	// When a dropdown selection is made
	$("#user_type").change(function() {

		$(".name_wrap").slideUp().find("input").removeClass("active_name_field");
		
		switch ($("#user_type option:selected").text()) {
			case 'An Artist':
				$("#User_wrap").slideDown().find("input").addClass("active_name_field");
				break;
			case 'A Label':
				$("#User_wrap").slideDown().find("input").addClass("active_name_field");
				break;
			}
	});
	
	$(".name_input").blur(function(){
	
		var all_complete = true;
				
		$(".active_name_field").each(function(){
			
			$(".eerror").hide();
			var emailaddressVal = $("#email").val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			
			if(!emailReg.test(emailaddressVal)) {
				$("#email").after('<span class="eerror">Please enter a valid email</span>');
				all_complete = false;
			}
			else if ($(this).val() == '' ) {
				all_complete = false;
			};	
			
		});
		
		
		$('#btn-submit').click(function() {  
 
        $(".error").hide();
        var hasError = false;
 
		});
		
		if (all_complete) {
			$("#step_1")
			.animate({
				paddingBottom: "120px"
			})
			.css({
				"background-image": "url(images/check.png)",
				"background-position": "bottom center",
				"background-repeat": "no-repeat"
			});
			$("#step_2").css({
				opacity: 1.0
			});
			$("#step_2 legend").css({
				opacity: 1.0 // For dumb Internet Explorer
			});
		};
	});
	
	function stepTwoTest() {
		if (($.stepTwoComplete_one == "complete") && ($.stepTwoComplete_two == "complete")) {
			$("#terms_wrap").slideDown();
			$("#step_2")
			.animate({
				paddingBottom: "120px"
			})
			.css({
				"background-image": "url(images/check.png)",
				"background-position": "bottom center",
				"background-repeat": "no-repeat"
			});
			$("#step_3").css({
				opacity: 1.0
			});
			$("#step_3 legend").css({
				opacity: 1.0 // For dumb Internet Explorer
			});
		}
	};
	
	$("#step_2 input[name=company_name_toggle_group]").click(function(){
		$.stepTwoComplete_one = "complete"; 
		if ($("#company_name_toggle_on:checked").val() == 'on') {
			$("#company_name_wrap").slideDown();
			
			if ($("#user_type option:selected").text() == 'An Artist')
			{
				$("#artist_wrap").slideDown().find("input").addClass("active_name_field");
				
					$("#profilePic").blur(function(){
						var ext = $('#profilePic').val().split('.').pop().toLowerCase();
						if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
						alert('invalid extension!');
						}
					});
					
			}else {
			    $("#label_wrap").slideDown().find("input").addClass("active_name_field");
			};
		
		} else {
			$("#company_name_wrap").slideUp();
		};
		stepTwoTest();
	});
	
	
	$("#step_2 input[name=special_accommodations_toggle]").click(function(){
		$.stepTwoComplete_two = "complete"; 
		if ($("#special_accommodations_toggle_on:checked").val() == 'on') {
			$("#special_accommodations_wrap").slideDown();
		} else {
			$("#special_accommodations_wrap").slideUp();
		};
		stepTwoTest();
	});
		
	$("#agree").click(function(){
		if (this.checked && $("#user_type option:selected").text() != 'Please Choose'
		  	&& $.stepTwoComplete_one == 'complete' && $.stepTwoComplete_two == 'complete') {
				$("#submit_button").attr("disabled",false);
			} else {
				$("#submit_button").attr("disabled",true);
				alert("need to complete step 1 & 2 before submitting.");

		}
	});
	
});