(function ($) {
	"use strict";

	$(document).ready(function() {
		$.validator.addMethod(
		    /* The value you can use inside the email object in the validator. */
		    "regex",

		    /* The function that tests a given string against a given regEx. */
		    function(value, element, regexp)  {
		        /* Check if the value is truthy (avoid null.constructor) & if it's not a RegEx. (Edited: regex --> regexp)*/

		        if (regexp && regexp.constructor != RegExp) {
		           /* Create a new regular expression using the regex argument. */
		           regexp = new RegExp(regexp);
		        }

		        /* Check whether the argument is global and, if so set its last index to 0. */
		        else if (regexp.global) regexp.lastIndex = 0;

		        /* Return whether the element is optional or the result of the validation. */
		        return this.optional(element) || regexp.test(value);
		    }
		);

		$("#sa-form").validate({
			onfocusout: false,
			onkeyup: false,
			onclick: false,
			rules: {
				"sa_name": {
					required: true,
					maxlength: 15
				},
				"sa_phone": {
					required: true,
					regex: /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/i
				},
				"sa_birth": {
					required: true,
					date: true
				},
				"sa_testday": {
					required: true,
					date: true
				},
				"sa_area": {
					required: true,
				},
			},
			messages: {
				"sa_phone": {
					required: sconnect_sa_form.string.warning_required,
					regex: sconnect_sa_form.string.warning_wrong_phone
				},
				"sa_name": {
					required: sconnect_sa_form.string.warning_required,
				},
				"sa_birth": {
					required: sconnect_sa_form.string.warning_required,
				},
				"sa_testday": {
					required: sconnect_sa_form.string.warning_required,
				},
				"sa_area": {
					required: sconnect_sa_form.string.warning_required,
				},
			},
			submitHandler: function(form, event) {
                // form.submit();
				event.preventDefault();

				var formData = {
					sa_name: $('#sa-form input[name="sa_name"]').val(),
					sa_phone: $('#sa-form input[name="sa_phone"]').val(),
					sa_birth: $('#sa-form input[name="sa_birth"]').val(),
					sa_testday: $('#sa-form input[name="sa_testday"]').val(),
					sa_area: $('#sa-form select[name="sa_area"]').val(),

					action: 'sconnect_handle_sa_form',
					ajax_nonce_parameter: sconnect_sa_form.security_nonce,
				};

				$.ajax({
					type: "POST",
					url : sconnect_sa_form.ajaxurl,
					data: formData,
					dataType: "json",
					encode: true,
					beforeSend: function(){
					    
					},
					success: function(response) {
						console.log(response);
					    // if(!response.success) {
					    //     alert(response.error);
					    // }
					},
				});
				return false;  //This doesn't prevent the form from submitting.
            }
		});

		$("#sa-form").submit(function (e) {
	        e.preventDefault();
		});
	});

})(jQuery);