$(document).ready(function(){
	// user registration form
	$("#register_form").validate({
	rules:{
		first_name:{required: true},
		last_name:{required: true},
		country:{required:true},
		mobile_number:{required:true},
		email_address:{required: true, email: true},
		password:{required: true},
	},
	messages: {
		first_name:{required: "Please enter a Fist Name"},
		last_name:{required: "Please enter a Last Name"},
		country:{required:"Please choose a Country"},
		mobile_number:{required:"Please enter a Mobile Number"},
		email_address:{ required: "Please enter a Email Address", email: "Enter a Valid Email Address"},
		password:{required: "Please enter a Password"},
	},
	errorElement: 'span',
	errorPlacement: function(error, element) {
		error.addClass('error');
		error.insertAfter(element);
	},
	submitHandler: function(form){
		$.ajax({
			url: form.action,
			type: form.method,
			dataType: 'json',
			data: $(form).serialize(),
			success: function(response) {
				if(response.status == 1) {
					Swal.fire('Good job!','Signup Successful','success');
				} else if(response.status == 2) {
					$(".error_message").html(response.message);
				} else {
					Swal.fire('Opps!','Please try again','warning');
				}
			}            
		});		
	}
	});
	// user login
	$("#login_form").validate({
		rules:{
			email_address:{required: true, email: true},
			password:{required: true},
		},
		messages: {
			email_address:{ required: "Please enter a Email Address", email: "Enter a Valid Email Address"},
			password:{required: "Please enter a Password"},
		},
		errorElement: 'span',
		errorPlacement: function(error, element) {
			error.addClass('error');
			error.insertAfter(element);
		},
		submitHandler: function(form){
			$.ajax({
				url: form.action,
				type: form.method,
				dataType: 'json',
				data: $(form).serialize(),
				success: function(response) {
					if(response.status == 1) {
						window.location.assign('index.php');
					} else {
						Swal.fire('Opps!', response.message,'warning');
					}
				}            
			});		
		}
		});
});
