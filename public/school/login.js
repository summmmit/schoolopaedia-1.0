var LoginAndRegister = function() {
	"use strict";

	var runSetDefaultValidation = function() {
		$.validator.setDefaults({
			errorElement : "span", // contain the error msg in a small tag
			errorClass : 'help-block',
			errorPlacement : function(error, element) {// render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {
				    // for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
					error.appendTo($(element).closest('.form-group').children('div'));
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore : ':hidden',
			success : function(label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error');
			},
			highlight : function(element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.form-group').addClass('has-error');
				// add the Bootstrap error class to the control group
			},
			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.form-group').removeClass('has-error');
				// set error class to the control group
			}
		});
	};
	var runLoginValidator = function() {
        console.log(window.location.href );
		var form = $('.form-login');
		var errorHandler = $('.errorHandler', form);
        var globalError = $('.global-error', form);
		form.validate({
			rules : {
                identity : {
                    required : true
                },
				email : {
					required : true
				},
				password : {
					minlength : 6,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler.hide();
				form.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
                globalError.hide();
				errorHandler.show();
			}
		});
	};
	var runForgotValidator = function() {
		var form2 = $('.form-forgot');
		var errorHandler2 = $('.errorHandler', form2);
		form2.validate({
			rules : {
				email : {
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler2.hide();
				form2.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler2.show();
			}
		});
	};
	var runRegisterValidator = function() {
		var form3 = $('.form-register');
		var errorHandler3 = $('.errorHandler', form3);
        var globalError = $('.global-error', form3);
		form3.validate({
			rules : {
				first_name : {
					minlength : 2,
					required : true
				},
				last_name : {
					minlength : 2,
					required : true
				},
                school_name : {
                    minlength : 3,
                    required : true
                },
                manager_name : {
                    minlength : 3,
                    required : true
                },
                phone_number : {
					minlength : 8,
					required : true
				},
                add_1 : {
                    minlength : 3,
                    required : true
                },
                add_2 : {
                    minlength : 3
                },
				city : {
					minlength : 2,
					required : true
				},
                state : {
                    minlength : 2,
                    required : true
                },
                country : {
                    minlength : 2,
                    required : true
                },
                pin_code : {
                    minlength : 4,
                    required : true
                },
				gender : {
					required : true
				},
                school_registration_code : {
                    required : true
                },
                admin_registration_code : {
                    required : true
                },
                user_registration_code : {
                    required : true
                },
				email : {
					required : true
				},
				password : {
					minlength : 6,
					required : true
				},
				password_again : {
					required : true,
					minlength : 5,
					equalTo : "#password"
				},
                group_to_register_in : {
                    required : true
                },
				agree : {
					minlength : 1,
					required : true
				}
			},
			submitHandler : function(form3) {
				errorHandler3.hide();
				//form3.submit();
                var data = {
                    email : $('input[name="email"]').val(),
                    password : $('input[name="password"]').val(),
                    password_again : $('input[name="password_again"]').val(),
                    group_to_register_in: $('#group_to_register_in').val(),
                    _token: $('input[name="_token"]').val()
                };
                callAjaxRequestOnRegisterButton(form3, data, errorHandler3, globalError);
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
                globalError.hide();
				errorHandler3.show();
			}
		});
	};
    function callAjaxRequestOnRegisterButton(form, data, errorHandler, globalError){

        var send_data_to = null;
        var url_change_page_to = null;
        if(window.location.href.match('/user/sign/in')){
            send_data_to = "http://localhost/projects/school/web/public/user/sign/in/post";
        }else if(window.location.href.match('/account/user/create')){
            send_data_to = "http://localhost/projects/school/web/public/account/user/create/post";
            url_change_page_to = "http://localhost/projects/school/web/public/account/sign/in";
        }

        sendRequest(form, data, errorHandler, globalError, send_data_to, url_change_page_to);
    }

    function errorHandlerShow(errors){
        for(var prop in errors) {
            $('input[name="'+ prop +'"]').closest('.form-group').addClass('has-error');
            $('input[name="'+ prop +'"]').parent().append('<span for="'+ prop +'" class="help-block">'+ errors[prop] +'</span>');
        }
    }

    function sendRequest(form, data, errorHandler, globalError, send_data_to, url_change_page_to){

        var errorHandler = $('.errorHandler', form);
        var globalError = $('.global-error', form);
        console.log(data);

        $.ajax({
            url: send_data_to,
            dataType: 'json',
            cache: false,
            method: 'POST',
            data: data,
            success: function(result, response) {
                console.log(result);

                if(result.status == "failed"){
                    globalError.hide();
                    errorHandler.show();
                    errorHandlerShow(result.error.result);
                }else if(result.status == "success"){
                    errorHandler.hide();
                    globalError.hide();
                    changeUrl(url_change_page_to);
                }
            }
        });
    }
	return {
		//main function to initiate template pages
		init : function() {
			//runBoxToShow();
			//runLoginButtons();
			runSetDefaultValidation();
			runLoginValidator();
			runForgotValidator();
			runRegisterValidator();
		}
	};
}();
